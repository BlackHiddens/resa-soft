@extends('layouts.admin')

@section('title', $reservation->reservation_code)

@section('content')
<div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-3">
    <div>
        <h1 class="h3 fw-bold mb-1">Reservation {{ $reservation->reservation_code }}</h1>
        <p class="text-muted mb-0">Partie: {{ $reservation->game?->name }}</p>
    </div>
    <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-secondary">Retour liste</a>
</div>

<div class="row g-3">
    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <tbody>
                            <tr><th>Nom</th><td>{{ $reservation->full_name }}</td></tr>
                            <tr><th>Telephone</th><td>{{ $reservation->phone }}</td></tr>
                            <tr><th>E-mail</th><td>{{ $reservation->email ?: '-' }}</td></tr>
                            <tr><th>Type</th><td>{{ $reservation->type_label }}</td></tr>
                            <tr><th>Quantite</th><td>{{ $reservation->quantity }}</td></tr>
                            <tr><th>Prix unitaire</th><td>{{ number_format($reservation->unit_price, 2, ',', ' ') }} EUR</td></tr>
                            <tr><th>Total</th><td>{{ number_format($reservation->total_price, 2, ',', ' ') }} EUR</td></tr>
                            <tr><th>Date reservation</th><td>{{ $reservation->created_at?->format('d/m/Y H:i') }}</td></tr>
                            <tr><th>Notes</th><td>{{ $reservation->notes ?: '-' }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body p-4">
                <h2 class="h6 fw-semibold mb-3">Modifier le statut</h2>
                <form method="POST" action="{{ route('admin.reservations.update-status', $reservation) }}" class="vstack gap-3">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label class="form-label" for="status">Statut</label>
                        <select class="form-select" id="status" name="status" required>
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}" @selected($reservation->status === $status)>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="notes">Notes admin</label>
                        <textarea id="notes" name="notes" rows="4" class="form-control">{{ old('notes', $reservation->notes) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-admin-primary">Enregistrer</button>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h2 class="h6 fw-semibold mb-3">Suppression</h2>
                <form method="POST" action="{{ route('admin.reservations.destroy', $reservation) }}" onsubmit="return confirm('Supprimer cette reservation ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100">Supprimer la reservation</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
