@extends('layouts.admin')

@section('title', 'Dashboard admin')

@section('content')
<div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Tableau de bord</h1>
        <p class="text-muted mb-0">Vue synthese des parties et des reservations.</p>
    </div>
    <a href="{{ route('admin.games.create') }}" class="btn btn-admin-primary">
        <i class="bi bi-plus-circle me-1"></i>Nouvelle partie
    </a>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <div class="stat-card h-100">
            <div class="stat-label">Total parties</div>
            <div class="stat-value">{{ $gamesTotal }}</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card h-100">
            <div class="stat-label">Parties completes</div>
            <div class="stat-value">{{ $fullGames }}</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card h-100">
            <div class="stat-label">Reservations totales</div>
            <div class="stat-value">{{ $reservationsTotal }}</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card h-100">
            <div class="stat-label">Prochaines parties</div>
            <div class="stat-value">{{ $upcomingGames->count() }}</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12 col-xl-7">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0 py-3">
                <h2 class="h6 fw-semibold mb-0">Taux de remplissage</h2>
            </div>
            <div class="card-body pt-0">
                @forelse ($fillRates as $game)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1 small">
                            <span class="fw-semibold">{{ $game->name }}</span>
                            <span>{{ $game->fillRate() }}%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar" role="progressbar" style="width: {{ $game->fillRate() }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted mb-0">Aucune partie a afficher.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-5">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0 py-3">
                <h2 class="h6 fw-semibold mb-0">Repartition des types</h2>
            </div>
            <div class="card-body pt-0">
                @php
                    $labels = \App\Models\Reservation::typeLabels();
                @endphp
                @foreach ($labels as $type => $label)
                    <div class="d-flex justify-content-between py-2 border-bottom small">
                        <span>{{ $label }}</span>
                        <span class="fw-semibold">{{ $typeBreakdown[$type] ?? 0 }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mt-4">
    <div class="card-header bg-transparent border-0 py-3">
        <h2 class="h6 fw-semibold mb-0">Prochaines parties</h2>
    </div>
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Partie</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($upcomingGames as $game)
                    <tr>
                        <td>{{ $game->name }}</td>
                        <td>{{ $game->scheduled_at?->format('d/m/Y H:i') }}</td>
                        <td><span class="badge text-bg-secondary">{{ $game->status }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('admin.games.show', $game) }}" class="btn btn-sm btn-outline-secondary">Voir</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Aucune partie planifiee.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
