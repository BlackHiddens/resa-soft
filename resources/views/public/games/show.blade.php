@extends('layouts.public')

@section('title', $game->name)

@section('content')
<div class="row g-4">
    <div class="col-12 col-lg-7">
        <div class="hero-card p-4 mb-3">
            <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                <h1 class="h3 fw-bold mb-0">{{ $game->name }}</h1>
                <span class="badge text-bg-light text-dark">{{ $game->status }}</span>
            </div>
            <p class="mb-2"><i class="bi bi-clock me-1"></i>{{ $game->scheduled_at?->translatedFormat('l d F Y \a H:i') }}</p>
            <p class="mb-0 opacity-75">{{ $game->description }}</p>
        </div>

        <div class="row g-3">
            @foreach ($slotLabels as $type => $label)
                @php
                    $quota = $game->quotaForType($type);
                    $remaining = $remainingSlots[$type] ?? 0;
                    $price = $game->priceForType($type);
                    $cardClass = $type === \App\Models\Game::SLOT_MEMBER ? 'member' : ($type === \App\Models\Game::SLOT_GUEST_OWN_GEAR ? 'own-gear' : 'rental');
                @endphp
                <div class="col-12 col-md-6">
                    <div class="slot-card {{ $cardClass }}">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h2 class="h6 fw-semibold mb-0">{{ $label }}</h2>
                            <span class="availability-pill text-bg-light">{{ $remaining }}/{{ $quota }}</span>
                        </div>
                        <p class="mb-1 small text-muted">Prix: <strong>{{ number_format($price, 2, ',', ' ') }} EUR</strong></p>
                        @if ($remaining <= 2 && $remaining > 0)
                            <p class="mb-0 small rare">Plus que {{ $remaining }} place(s)</p>
                        @elseif ($remaining === 0)
                            <p class="mb-0 small text-danger fw-semibold">Complet</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-12 col-lg-5">
        <div class="card public-form-card">
            <div class="card-body p-4">
                <h2 class="h5 fw-semibold mb-1">Formulaire express</h2>
                <p class="text-muted small mb-3">Nom ou pseudo, type de place, et c est reserve.</p>

                @if (! $game->isReservable())
                    <div class="alert alert-warning mb-0">
                        Les reservations sont fermees pour cette partie.
                    </div>
                @else
                    <form method="POST" action="{{ route('public.reservations.store', $game) }}" class="vstack gap-3">
                        @csrf

                        <div>
                            <label class="form-label" for="reservation_type">Type de reservation</label>
                            <select id="reservation_type" name="reservation_type" class="form-select @error('reservation_type') is-invalid @enderror" required>
                                <option value="">Choisir...</option>
                                @foreach ($slotLabels as $type => $label)
                                    @php $isFull = ($remainingSlots[$type] ?? 0) <= 0; @endphp
                                    <option value="{{ $type }}" @selected(old('reservation_type') === $type) @disabled($isFull)>
                                        {{ $label }} ({{ number_format($game->priceForType($type), 2, ',', ' ') }} EUR)
                                        @if ($isFull) - Complet @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('reservation_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div>
                            <label class="form-label" for="full_name">Nom ou pseudo</label>
                            <input id="full_name" name="full_name" type="text" value="{{ old('full_name') }}" class="form-control @error('full_name') is-invalid @enderror" required>
                            @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <input type="hidden" name="quantity" value="1">

                        <div>
                            <label class="form-label" for="notes">Commentaire (optionnel)</label>
                            <textarea id="notes" name="notes" rows="3" class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
                            @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <button class="btn btn-public-primary w-100" type="submit">Confirmer ma reservation</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
