@extends('layouts.public')

@section('title', 'Confirmation reservation')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 p-md-5">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-circle bg-success-subtle text-success d-inline-flex align-items-center justify-content-center" style="width: 52px;height:52px;">
                        <i class="bi bi-check2-circle fs-3"></i>
                    </div>
                    <div>
                        <h1 class="h4 fw-bold mb-1">Reservation enregistree</h1>
                        <p class="text-muted mb-0">Votre demande est bien prise en compte.</p>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-12 col-md-6">
                        <div class="bg-light rounded-3 p-3 h-100">
                            <div class="small text-muted">Code reservation</div>
                            <div class="fw-bold fs-5">{{ $reservation->reservation_code }}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="bg-light rounded-3 p-3 h-100">
                            <div class="small text-muted">Partie</div>
                            <div class="fw-semibold">{{ $reservation->game?->name }}</div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive mt-4">
                    <table class="table table-sm align-middle">
                        <tbody>
                            <tr><th>Nom</th><td>{{ $reservation->full_name }}</td></tr>
                            <tr><th>Telephone</th><td>{{ $reservation->phone }}</td></tr>
                            <tr><th>Type</th><td>{{ $reservation->type_label }}</td></tr>
                            <tr><th>Quantite</th><td>{{ $reservation->quantity }}</td></tr>
                            <tr><th>Total</th><td>{{ number_format($reservation->total_price, 2, ',', ' ') }} EUR</td></tr>
                            <tr><th>Statut</th><td><span class="badge text-bg-success">{{ $reservation->status_label }}</span></td></tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex flex-wrap gap-2 mt-3">
                    <a href="{{ route('public.games.show', ['game' => $reservation->game?->slug]) }}" class="btn btn-outline-secondary">Retour a la partie</a>
                    <a href="{{ route('public.games.index') }}" class="btn btn-public-primary">Voir les autres parties</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
