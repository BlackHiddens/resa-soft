<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateReservationStatusRequest;
use App\Models\Reservation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
    public function index(Request $request): View
    {
        $reservations = Reservation::query()
            ->with('game')
            ->when($request->filled('game_id'), fn ($query) => $query->where('game_id', $request->integer('game_id')))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->when($request->filled('reservation_type'), fn ($query) => $query->where('reservation_type', $request->string('reservation_type')->toString()))
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('full_name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('reservation_code', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.reservations.index', [
            'reservations' => $reservations,
            'statuses' => Reservation::statuses(),
            'types' => Reservation::typeLabels(),
        ]);
    }

    public function show(Reservation $reservation): View
    {
        $reservation->load('game');

        return view('admin.reservations.show', [
            'reservation' => $reservation,
            'statuses' => Reservation::statuses(),
        ]);
    }

    public function updateStatus(UpdateReservationStatusRequest $request, Reservation $reservation): RedirectResponse
    {
        try {
            DB::transaction(function () use ($request, $reservation): void {
                $lockedReservation = Reservation::query()->whereKey($reservation->id)->lockForUpdate()->firstOrFail();
                $lockedGame = $lockedReservation->game()->lockForUpdate()->firstOrFail();

                $newStatus = $request->string('status')->toString();
                $currentStatus = $lockedReservation->status;

                $currentlyConsumes = in_array($currentStatus, Reservation::consumingStatuses(), true);
                $nextConsumes = in_array($newStatus, Reservation::consumingStatuses(), true);

                if (! $currentlyConsumes && $nextConsumes) {
                    if (! $lockedGame->isTypeAvailable($lockedReservation->reservation_type, $lockedReservation->quantity)) {
                        throw ValidationException::withMessages([
                            'status' => 'Impossible de confirmer: quota atteint.',
                        ]);
                    }
                }

                $payload = [
                    'status' => $newStatus,
                    'notes' => $request->validated('notes'),
                ];

                if ($newStatus === Reservation::STATUS_CANCELLED) {
                    $payload['cancelled_at'] = now();
                }

                if (in_array($newStatus, [Reservation::STATUS_CONFIRMED, Reservation::STATUS_PRESENT, Reservation::STATUS_ABSENT], true)
                    && ! $lockedReservation->confirmed_at) {
                    $payload['confirmed_at'] = now();
                }

                $lockedReservation->update($payload);
                $lockedGame->syncAvailabilityStatus();
            });
        } catch (ValidationException $exception) {
            return back()->withErrors($exception->errors())->withInput();
        }

        return back()->with('success', 'Statut de reservation mis a jour.');
    }

    public function destroy(Reservation $reservation): RedirectResponse
    {
        DB::transaction(function () use ($reservation): void {
            $lockedReservation = Reservation::query()->whereKey($reservation->id)->lockForUpdate()->firstOrFail();
            $lockedGame = $lockedReservation->game()->lockForUpdate()->firstOrFail();

            $lockedReservation->delete();
            $lockedGame->syncAvailabilityStatus();
        });

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservation supprimee.');
    }
}
