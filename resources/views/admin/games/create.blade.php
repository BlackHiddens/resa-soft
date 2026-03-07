@extends('layouts.admin')

@section('title', 'Creer une partie')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 fw-bold mb-0">Creer une partie</h1>
    <a href="{{ route('admin.games.index') }}" class="btn btn-outline-secondary">Retour</a>
</div>

<form method="POST" action="{{ route('admin.games.store') }}">
    @csrf
    @include('admin.games._form')
    <div class="mt-3 d-flex gap-2">
        <button type="submit" class="btn btn-admin-primary">Enregistrer</button>
        <a href="{{ route('admin.games.index') }}" class="btn btn-outline-secondary">Annuler</a>
    </div>
</form>
@endsection
