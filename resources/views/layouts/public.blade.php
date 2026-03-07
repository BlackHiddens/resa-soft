<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Reservation de parties')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="public-body">
<nav class="navbar navbar-expand-lg navbar-dark public-nav shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="{{ route('public.games.index') }}">
            <i class="bi bi-calendar2-check me-2"></i>Airsoft Booking
        </a>
        <a class="btn btn-outline-light btn-sm" href="{{ route('admin.login') }}">Administration</a>
    </div>
</nav>

<main class="py-4 py-md-5">
    <div class="container">
        @include('partials.flash')
        @yield('content')
    </div>
</main>

<footer class="py-4 border-top bg-white mt-5">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 text-muted small">
        <span>Plateforme de reservation de parties</span>
        <a href="{{ route('public.reservations.lookup.form') }}" class="link-secondary text-decoration-none">
            Retrouver ma reservation
        </a>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
