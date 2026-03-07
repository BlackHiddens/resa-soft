<?php

namespace App\Http\Controllers;

use App\Http\Requests\Front\StoreReservationRequest;
use App\Mail\ReservationConfirmationMail;
use App\Models\Game;
use App\Models\Reservation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
    public function store(StoreReservationRequest $request, Game $game): RedirectResponse
    {
        if (! $game->isReservable()) {
            return back()->withErrors([
                'reservation_type' => 'Cette partie est fermee ou non reservable.',
            ])->withInput();
        }

        $validated = $request->validated();

        try {
            $reservation = DB::transaction(function () use ($validated, $game) {
                $lockedGame = Game::query()->whereKey($game->id)->lockForUpdate()->firstOrFail();

                if (! $lockedGame->isReservable()) {
                    throw ValidationException::withMessages([
                        'reservation_type' => 'La partie n est plus reservable.',
                    ]);
                }

                if (! $lockedGame->isTypeAvailable($validated['reservation_type'], (int) $validated['quantity'])) {
                    throw ValidationException::withMessages([
                        'reservation_type' => 'Le quota selectionne est atteint.',
                    ]);
                }

                $unitPrice = $lockedGame->priceForType($validated['reservation_type']);
                $quantity = (int) $validated['quantity'];

                $reservation = Reservation::query()->create([
                    'game_id' => $lockedGame->id,
                    'full_name' => $validated['full_name'],
                    'phone' => $validated['phone'],
                    'email' => $validated['email'] ?? null,
                    'reservation_type' => $validated['reservation_type'],
                    'unit_price' => $unitPrice,
                    'quantity' => $quantity,
                    'total_price' => $unitPrice * $quantity,
                    'status' => Reservation::STATUS_CONFIRMED,
                    'notes' => $validated['notes'] ?? null,
                    'confirmed_at' => now(),
                ]);

                $lockedGame->syncAvailabilityStatus();

                return $reservation;
            });
        } catch (ValidationException $exception) {
            return back()->withErrors($exception->errors())->withInput();
        }

        if ($reservation->email) {
            try {
                Mail::to($reservation->email)->send(new ReservationConfirmationMail($reservation));
            } catch (\Throwable $throwable) {
                Log::warning('Email confirmation reservation non envoye', [
                    'reservation_id' => $reservation->id,
                    'error' => $throwable->getMessage(),
                ]);
            }
        }

        return redirect()->route('public.reservations.confirmation', ['reservation' => $reservation->reservation_code])
            ->with('success', 'Reservation enregistree avec succes.');
    }

    public function confirmation(Reservation $reservation): View
    {
        return view('public.reservations.confirmation', compact('reservation'));
    }

    public function lookupForm(): View
    {
        return view('public.reservations.lookup');
    }

    public function lookup(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'reservation_code' => ['required', 'string'],
        ]);

        $reservation = Reservation::query()
            ->where('reservation_code', strtoupper(trim($validated['reservation_code'])))
            ->first();

        if (! $reservation) {
            return back()->withErrors([
                'reservation_code' => 'Code introuvable.',
            ])->withInput();
        }

        return redirect()->route('public.reservations.confirmation', ['reservation' => $reservation->reservation_code]);
    }
}
