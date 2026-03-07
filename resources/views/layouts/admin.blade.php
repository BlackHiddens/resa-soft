<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Administration')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="admin-body">
<nav class="navbar navbar-expand-lg navbar-dark admin-nav shadow-sm">
    <div class="container-fluid px-3 px-md-4">
        <a class="navbar-brand fw-semibold" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-shield-check me-2"></i>Back-office Parties
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminMenu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.games.index') }}">Parties</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.reservations.index') }}">Reservations</a></li>
            </ul>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="btn btn-outline-light btn-sm" type="submit">Deconnexion</button>
            </form>
        </div>
    </div>
</nav>

<main class="py-4 py-md-4">
    <div class="container-fluid px-3 px-md-4">
        @include('partials.flash')
        @yield('content')
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
