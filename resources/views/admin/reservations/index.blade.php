@extends('layouts.admin')

@section('title', 'Reservations')

@section('content')
<div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-3">
    <div>
        <h1 class="h3 fw-bold mb-1">Reservations</h1>
        <p class="text-muted mb-0">Recherche, filtres et suivi des statuts.</p>
    </div>
</div>

<div class="card border-0 shadow-sm mb-3">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-12 col-md-4">
                <label class="form-label small" for="search">Recherche</label>
                <input id="search" name="search" value="{{ request('search') }}" class="form-control" placeholder="Nom, tel, email, code...">
            </div>
            <div class="col-12 col-md-2">
                <label class="form-label small" for="game_id">ID partie</label>
                <input id="game_id" name="game_id" value="{{ request('game_id') }}" class="form-control" placeholder="ex: 12">
            </div>
            <div class="col-6 col-md-2">
                <label class="form-label small" for="status">Statut</label>
                <select id="status" name="status" class="form-select">
                    <option value="">Tous</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" @selected(request('status') === $status)>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-2">
                <label class="form-label small" for="reservation_type">Type</label>
                <select id="reservation_type" name="reservation_type" class="form-select">
                    <option value="">Tous</option>
                    @foreach ($types as $type => $label)
                        <option value="{{ $type }}" @selected(request('reservation_type') === $type)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-2 d-flex gap-2">
                <button class="btn btn-outline-secondary" type="submit">Filtrer</button>
                <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-dark">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Partie</th>
                    <th>Code</th>
                    <th>Nom</th>
                    <th>Telephone</th>
                    <th>E-mail</th>
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
                        <td>{{ $reservation->game?->name }}</td>
                        <td>{{ $reservation->reservation_code }}</td>
                        <td>{{ $reservation->full_name }}</td>
                        <td>{{ $reservation->phone }}</td>
                        <td>{{ $reservation->email ?: '-' }}</td>
                        <td>{{ $reservation->type_label }}</td>
                        <td>{{ number_format($reservation->total_price, 2, ',', ' ') }} EUR</td>
                        <td><span class="badge text-bg-light">{{ $reservation->status_label }}</span></td>
                        <td>{{ $reservation->created_at?->format('d/m/Y H:i') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.reservations.show', $reservation) }}" class="btn btn-sm btn-outline-secondary">Voir</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="10" class="text-center text-muted py-4">Aucune reservation trouvee.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $reservations->links() }}</div>
@endsection
