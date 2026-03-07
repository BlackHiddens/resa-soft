<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGameRequest;
use App\Http\Requests\Admin\UpdateGameRequest;
use App\Models\Game;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class GameController extends Controller
{
    public function index(Request $request): View
    {
        $games = Game::query()
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('scheduled_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.games.index', [
            'games' => $games,
            'statuses' => Game::statuses(),
        ]);
    }

    public function create(): View
    {
        return view('admin.games.create', [
            'game' => new Game([
                'status' => Game::STATUS_DRAFT,
                'scheduled_at' => now()->addWeek(),
                'is_published' => false,
                'reservations_open' => true,
            ]),
            'statuses' => Game::statuses(),
            'slotLabels' => Game::slotLabels(),
        ]);
    }

    public function store(StoreGameRequest $request): RedirectResponse
    {
        $game = Game::query()->create($request->validated());

        $game->syncAvailabilityStatus();

        return redirect()->route('admin.games.show', $game)
            ->with('success', 'Partie creee avec succes.');
    }

    public function show(Game $game): View
    {
        $reservations = $game->reservations()
            ->latest()
            ->paginate(10);

        return view('admin.games.show', [
            'game' => $game,
            'reservations' => $reservations,
            'remainingSlots' => $game->remainingSlotsByType(),
            'slotLabels' => Game::slotLabels(),
        ]);
    }

    public function edit(Game $game): View
    {
        return view('admin.games.edit', [
            'game' => $game,
            'statuses' => Game::statuses(),
            'slotLabels' => Game::slotLabels(),
        ]);
    }

    public function update(UpdateGameRequest $request, Game $game): RedirectResponse
    {
        $game->update($request->validated());
        $game->syncAvailabilityStatus();

        return redirect()->route('admin.games.show', $game)
            ->with('success', 'Partie mise a jour.');
    }

    public function destroy(Game $game): RedirectResponse
    {
        $game->delete();

        return redirect()->route('admin.games.index')
            ->with('success', 'Partie supprimee.');
    }

    public function archive(Game $game): RedirectResponse
    {
        $game->update([
            'status' => Game::STATUS_ARCHIVED,
            'reservations_open' => false,
            'is_published' => false,
        ]);

        return back()->with('success', 'Partie archivee.');
    }

    public function duplicate(Game $game): RedirectResponse
    {
        $copy = $game->replicate([
            'slug',
            'created_at',
            'updated_at',
            'deleted_at',
        ]);

        $copy->scheduled_at = $game->scheduled_at?->copy()->addWeek() ?? now()->addWeek();
        $copy->status = Game::STATUS_DRAFT;
        $copy->is_published = false;
        $copy->reservations_open = true;
        $copy->slug = null;
        $copy->save();

        return redirect()->route('admin.games.edit', $copy)
            ->with('success', 'Partie dupliquee.');
    }

    public function publish(Game $game): RedirectResponse
    {
        if ($game->status !== Game::STATUS_FULL) {
            $game->status = Game::STATUS_PUBLISHED;
        }

        $game->is_published = true;
        $game->reservations_open = true;
        $game->save();
        $game->syncAvailabilityStatus();

        return back()->with('success', 'Partie publiee.');
    }

    public function unpublish(Game $game): RedirectResponse
    {
        $game->update([
            'is_published' => false,
            'status' => Game::STATUS_DRAFT,
            'reservations_open' => false,
        ]);

        return back()->with('success', 'Partie depubliee.');
    }

    public function toggleReservations(Game $game): RedirectResponse
    {
        $newValue = ! $game->reservations_open;

        $game->reservations_open = $newValue;
        if (! $newValue) {
            $game->status = Game::STATUS_CLOSED;
        } elseif ($game->status === Game::STATUS_CLOSED) {
            $game->status = Game::STATUS_PUBLISHED;
        }

        $game->save();
        $game->syncAvailabilityStatus();

        return back()->with('success', 'Parametre des reservations mis a jour.');
    }

    public function exportCsv(Game $game): StreamedResponse
    {
        $filename = 'reservations-'.$game->slug.'.csv';

        return response()->streamDownload(function () use ($game) {
            $stream = fopen('php://output', 'w');
            fputcsv($stream, [
                'Code',
                'Partie',
                'Nom',
                'Telephone',
                'Email',
                'Type',
                'Quantite',
                'Prix unitaire',
                'Total',
                'Statut',
                'Date reservation',
            ], ';');

            $game->reservations()->orderBy('created_at')->chunk(200, function ($rows) use ($stream) {
                foreach ($rows as $reservation) {
                    fputcsv($stream, [
                        $reservation->reservation_code,
                        $reservation->game?->name,
                        $reservation->full_name,
                        $reservation->phone,
                        $reservation->email,
                        $reservation->type_label,
                        $reservation->quantity,
                        $reservation->unit_price,
                        $reservation->total_price,
                        $reservation->status_label,
                        $reservation->created_at,
                    ], ';');
                }
            });

            fclose($stream);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
