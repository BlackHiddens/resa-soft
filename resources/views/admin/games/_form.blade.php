@php
    $statusBadges = [
        \App\Models\Game::STATUS_DRAFT => 'secondary',
        \App\Models\Game::STATUS_PUBLISHED => 'success',
        \App\Models\Game::STATUS_FULL => 'danger',
        \App\Models\Game::STATUS_CLOSED => 'warning',
        \App\Models\Game::STATUS_ARCHIVED => 'dark',
    ];
@endphp

<div class="row g-3">
    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" for="name">Nom de la partie</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $game->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="scheduled_at">Date et heure</label>
                        <input id="scheduled_at" name="scheduled_at" type="datetime-local" value="{{ old('scheduled_at', optional($game->scheduled_at)->format('Y-m-d\TH:i')) }}" class="form-control @error('scheduled_at') is-invalid @enderror" required>
                        @error('scheduled_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="status">Statut</label>
                        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}" @selected(old('status', $game->status) === $status)>{{ $status }}</option>
                            @endforeach
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="description">Description publique</label>
                        <textarea id="description" name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $game->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="admin_notes">Notes internes administrateur</label>
                        <textarea id="admin_notes" name="admin_notes" rows="3" class="form-control @error('admin_notes') is-invalid @enderror">{{ old('admin_notes', $game->admin_notes) }}</textarea>
                        @error('admin_notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body p-4">
                <h2 class="h6 fw-semibold mb-3">Quotas et tarifs</h2>

                <div class="vstack gap-3">
                    @foreach ($slotLabels as $type => $label)
                        <div class="border rounded-3 p-3">
                            <div class="fw-semibold small mb-2">{{ $label }}</div>
                            @php
                                $slotsField = $type.'_slots';
                                $priceField = $type.'_price';
                            @endphp
                            <div class="row g-2">
                                <div class="col-6">
                                    <label class="form-label small mb-1" for="{{ $slotsField }}">Places</label>
                                    <input type="number" min="0" id="{{ $slotsField }}" name="{{ $slotsField }}" value="{{ old($slotsField, $game->{$slotsField}) }}" class="form-control @error($slotsField) is-invalid @enderror" required>
                                    @error($slotsField)<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label small mb-1" for="{{ $priceField }}">Prix EUR</label>
                                    <input type="number" step="0.01" min="0" id="{{ $priceField }}" name="{{ $priceField }}" value="{{ old($priceField, $game->{$priceField}) }}" class="form-control @error($priceField) is-invalid @enderror" required>
                                    @error($priceField)<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <hr>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="is_published" name="is_published" value="1" @checked(old('is_published', $game->is_published))>
                    <label class="form-check-label" for="is_published">Partie publiee</label>
                </div>

                <div class="form-check form-switch mt-2">
                    <input class="form-check-input" type="checkbox" role="switch" id="reservations_open" name="reservations_open" value="1" @checked(old('reservations_open', $game->reservations_open))>
                    <label class="form-check-label" for="reservations_open">Reservations ouvertes</label>
                </div>
            </div>
        </div>

        @if ($game->exists)
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3 d-flex justify-content-between align-items-center">
                    <span class="small text-muted">Statut actuel</span>
                    <span class="badge text-bg-{{ $statusBadges[$game->status] ?? 'secondary' }}">{{ $game->status }}</span>
                </div>
            </div>
        @endif
    </div>
</div>
