@extends('layouts.admin')

@section('title', $game->name)

@section('content')
<div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-3">
    <div>
        <h1 class="h3 fw-bold mb-1">{{ $game->name }}</h1>
        <p class="text-muted mb-0">{{ $game->scheduled_at?->format('d/m/Y H:i') }} - <span class="badge text-bg-secondary">{{ $game->status }}</span></p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('public.games.show', ['game' => $game->slug]) }}" target="_blank" class="btn btn-outline-secondary">Voir page publique</a>
        <a href="{{ route('admin.games.edit', $game) }}" class="btn btn-outline-primary">Editer</a>
        <a href="{{ route('admin.games.export-csv', $game) }}" class="btn btn-outline-dark">Export CSV</a>
    </div>
</div>

<div class="row g-3 mb-3">
    @foreach ($slotLabels as $type => $label)
        @php
            $quota = $game->quotaForType($type);
            $remaining = $remainingSlots[$type] ?? 0;
            $used = max(0, $quota - $remaining);
            $rate = $quota > 0 ? round(($used / $quota) * 100) : 0;
        @endphp
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="small text-muted">{{ $label }}</div>
                    <div class="d-flex justify-content-between align-items-end mt-1">
                        <div class="fw-semibold">{{ $remaining }}/{{ $quota }} restantes</div>
                        <div class="small text-muted">{{ number_format($game->priceForType($type), 2, ',', ' ') }} EUR</div>
                    </div>
                    <div class="progress mt-2" style="height: 8px;">
                        <div class="progress-bar" style="width: {{ $rate }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="card border-0 shadow-sm mb-3">
    <div class="card-body d-flex flex-wrap gap-2">
        <form method="POST" action="{{ route('admin.games.publish', $game) }}">
            @csrf
            <button class="btn btn-success btn-sm" type="submit">Publier</button>
        </form>

        <form method="POST" action="{{ route('admin.games.unpublish', $game) }}">
            @csrf
            <button class="btn btn-warning btn-sm" type="submit">Depublier</button>
        </form>

        <form method="POST" action="{{ route('admin.games.toggle-reservations', $game) }}">
            @csrf
            <button class="btn btn-outline-primary btn-sm" type="submit">{{ $game->reservations_open ? 'Fermer les reservations' : 'Ouvrir les reservations' }}</button>
        </form>

        <form method="POST" action="{{ route('admin.games.duplicate', $game) }}">
            @csrf
            <button class="btn btn-outline-secondary btn-sm" type="submit">Dupliquer</button>
        </form>

        <form method="POST" action="{{ route('admin.games.archive', $game) }}">
            @csrf
            <button class="btn btn-outline-dark btn-sm" type="submit">Archiver</button>
        </form>

        <form method="POST" action="{{ route('admin.games.destroy', $game) }}" onsubmit="return confirm('Supprimer cette partie ?');">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger btn-sm" type="submit">Supprimer</button>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-transparent border-0 py-3 d-flex justify-content-between align-items-center">
        <h2 class="h6 fw-semibold mb-0">Reservations associees</h2>
        <a href="{{ route('admin.reservations.index', ['game_id' => $game->id]) }}" class="btn btn-sm btn-outline-secondary">Filtrer dans la liste globale</a>
    </div>
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Prix</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->reservation_code }}</td>
                        <td>{{ $reservation->full_name }}</td>
                        <td>{{ $reservation->type_label }}</td>
                        <td>{{ number_format($reservation->total_price, 2, ',', ' ') }} EUR</td>
                        <td><span class="badge text-bg-light">{{ $reservation->status_label }}</span></td>
                        <td>{{ $reservation->created_at?->format('d/m/Y H:i') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.reservations.show', $reservation) }}" class="btn btn-sm btn-outline-secondary">Voir</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Aucune reservation pour cette partie.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-body">{{ $reservations->links() }}</div>
</div>
@endsection
