@extends('layouts.admin')

@section('title', 'Connexion admin')

@section('content')
<div class="row justify-content-center align-items-center min-vh-75">
    <div class="col-12 col-md-8 col-lg-5">
        <div class="card border-0 shadow-lg admin-login-card">
            <div class="card-body p-4 p-md-5">
                <h1 class="h4 fw-bold mb-1">Connexion administrateur</h1>
                <p class="text-muted mb-4">Acces securise au back-office de reservation.</p>

                <form method="POST" action="{{ route('admin.login.submit') }}" class="vstack gap-3">
                    @csrf
                    <div>
                        <label class="form-label" for="email">Adresse e-mail</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div>
                        <label class="form-label" for="password">Mot de passe</label>
                        <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember" value="1">
                        <label class="form-check-label" for="remember">Se souvenir de moi</label>
                    </div>

                    <button class="btn btn-admin-primary w-100" type="submit">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
