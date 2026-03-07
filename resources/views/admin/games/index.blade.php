@extends('layouts.admin')

@section('title', 'Parties')

@section('content')
<div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-3">
    <div>
        <h1 class="h3 fw-bold mb-1">Gestion des parties</h1>
        <p class="text-muted mb-0">Creation, publication, archivage et suivi des quotas.</p>
    </div>
    <a href="{{ route('admin.games.create') }}" class="btn btn-admin-primary">
        <i class="bi bi-plus-circle me-1"></i>Nouvelle partie
    </a>
</div>

<div class="card border-0 shadow-sm mb-3">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-12 col-md-5">
                <label class="form-label small" for="search">Recherche</label>
                <input id="search" name="search" value="{{ request('search') }}" class="form-control" placeholder="Nom, slug...">
            </div>
            <div class="col-12 col-md-3">
                <label class="form-label small" for="status">Statut</label>
                <select id="status" name="status" class="form-select">
                    <option value="">Tous</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" @selected(request('status') === $status)>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-4 d-flex gap-2">
                <button class="btn btn-outline-secondary" type="submit">Filtrer</button>
                <a href="{{ route('admin.games.index') }}" class="btn btn-outline-dark">Reset</a>
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
                    <th>Date</th>
                    <th>Places restantes</th>
                    <th>Statut</th>
                    <th>Publication</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($games as $game)
                    @php
                        $remaining = array_sum($game->remainingSlotsByType());
                        $whatsappUrl = 'https://wa.me/?text='.urlencode('Rejoins la partie '.$game->name.' : '.route('public.games.show', ['game' => $game->slug]));
                    @endphp
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $game->name }}</div>
                            <div class="small text-muted">{{ $game->slug }}</div>
                        </td>
                        <td>{{ $game->scheduled_at?->format('d/m/Y H:i') }}</td>
                        <td>{{ $remaining }}</td>
                        <td><span class="badge text-bg-secondary">{{ $game->status }}</span></td>
                        <td>
                            @if ($game->is_published)
                                <span class="badge text-bg-success">Publiee</span>
                            @else
                                <span class="badge text-bg-light">Brouillon</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-end gap-1 flex-wrap">
                                <a href="{{ route('admin.games.show', $game) }}" class="btn btn-sm btn-outline-secondary">Voir</a>
                                <a href="{{ route('admin.games.edit', $game) }}" class="btn btn-sm btn-outline-primary">Editer</a>
                                <a target="_blank" href="{{ $whatsappUrl }}" class="btn btn-sm btn-outline-success" title="Partager WhatsApp"><i class="bi bi-whatsapp"></i></a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Aucune partie.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $games->links() }}</div>
@endsection
