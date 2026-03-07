<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Contracts\View\View;

class PublicGameController extends Controller
{
    public function index(): View
    {
        $games = Game::query()
            ->where('is_published', true)
            ->whereIn('status', [Game::STATUS_PUBLISHED, Game::STATUS_FULL, Game::STATUS_CLOSED])
            ->where('scheduled_at', '>=', now())
            ->orderBy('scheduled_at')
            ->paginate(9);

        return view('public.games.index', compact('games'));
    }

    public function show(Game $game): View
    {
        abort_unless($game->is_published, 404);

        return view('public.games.show', [
            'game' => $game,
            'remainingSlots' => $game->remainingSlotsByType(),
            'slotLabels' => Game::slotLabels(),
        ]);
    }
}
