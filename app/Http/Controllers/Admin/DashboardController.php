<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Reservation;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(): View
    {
        $gamesTotal = Game::query()->count();
        $upcomingGames = Game::query()->where('scheduled_at', '>=', now())->orderBy('scheduled_at')->limit(5)->get();
        $fullGames = Game::query()->where('status', Game::STATUS_FULL)->count();
        $reservationsTotal = Reservation::query()->count();

        $typeBreakdown = Reservation::query()
            ->select('reservation_type', DB::raw('COUNT(*) as total'))
            ->groupBy('reservation_type')
            ->pluck('total', 'reservation_type');

        $fillRates = Game::query()
            ->where('scheduled_at', '>=', now())
            ->orderBy('scheduled_at')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact(
            'gamesTotal',
            'upcomingGames',
            'fullGames',
            'reservationsTotal',
            'typeBreakdown',
            'fillRates',
        ));
    }
}
