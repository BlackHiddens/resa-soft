@extends('layouts.public')

@section('title', 'Retrouver une reservation')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h1 class="h5 fw-bold mb-1">Retrouver ma reservation</h1>
                <p class="text-muted mb-4">Saisissez votre code (ex: RES-2026-ABC123).</p>

                <form method="POST" action="{{ route('public.reservations.lookup') }}" class="vstack gap-3">
                    @csrf
                    <div>
                        <label class="form-label" for="reservation_code">Code reservation</label>
                        <input type="text" id="reservation_code" name="reservation_code" class="form-control @error('reservation_code') is-invalid @enderror" value="{{ old('reservation_code') }}" required>
                        @error('reservation_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <button class="btn btn-public-primary" type="submit">Rechercher</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
