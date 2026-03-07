@extends('layouts.public')

@section('title', 'Parties ouvertes a la reservation')

@section('content')
<div class="hero-card p-4 p-md-5 mb-4">
    <div class="row g-3 align-items-center">
        <div class="col-12 col-md-8">
            <h1 class="display-6 fw-bold mb-2">Reservez votre place en quelques secondes</h1>
            <p class="mb-0 opacity-75">Choisissez votre type de slot, confirmez, et recevez un recapitulatif immediat.</p>
        </div>
        <div class="col-12 col-md-4 text-md-end">
            <span class="badge rounded-pill text-bg-light px-3 py-2">Compatible mobile / WhatsApp</span>
        </div>
    </div>
</div>

<div class="row g-4">
    @forelse ($games as $game)
        @php
            $remaining = $game->remainingSlotsByType();
            $totalRemaining = array_sum($remaining);
        @endphp
        <div class="col-12 col-md-6 col-xl-4">
            <div class="game-card p-3 p-md-4 h-100 d-flex flex-column">
                <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                    <h2 class="h5 fw-semibold mb-0">{{ $game->name }}</h2>
                    <span class="badge text-bg-{{ $game->status === \App\Models\Game::STATUS_FULL ? 'danger' : 'secondary' }}">{{ $game->status }}</span>
                </div>

                <p class="text-muted small mb-2">
                    <i class="bi bi-calendar-event me-1"></i>{{ $game->scheduled_at?->translatedFormat('l d F Y \a H:i') }}
                </p>

                <p class="text-muted flex-grow-1 mb-3">{{ \Illuminate\Support\Str::limit($game->description, 120) }}</p>

                <div class="d-flex justify-content-between small mb-2">
                    <span>Places restantes</span>
                    <strong>{{ $totalRemaining }}</strong>
                </div>
                <div class="progress mb-3" style="height: 8px;">
                    <div class="progress-bar" style="width: {{ $game->fillRate() }}%"></div>
                </div>

                <div class="d-grid">
                    <a href="{{ route('public.games.show', ['game' => $game->slug]) }}" class="btn btn-public-primary">
                        Reserver
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4 text-center">
                <h2 class="h5 fw-semibold">Aucune partie disponible</h2>
                <p class="text-muted mb-0">Revenez bientot pour les prochaines ouvertures.</p>
            </div>
        </div>
    @endforelse
</div>

<div class="mt-4">{{ $games->links() }}</div>
@endsection
