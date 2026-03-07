<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GameController as AdminGameController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\PublicGameController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicGameController::class, 'index'])->name('public.games.index');
Route::get('/parties/{game:slug}', [PublicGameController::class, 'show'])->name('public.games.show');
Route::post('/parties/{game:slug}/reserve', [ReservationController::class, 'store'])->name('public.reservations.store');
Route::get('/reservation/confirmation/{reservation:reservation_code}', [ReservationController::class, 'confirmation'])->name('public.reservations.confirmation');
Route::get('/reservation/retrouver', [ReservationController::class, 'lookupForm'])->name('public.reservations.lookup.form');
Route::post('/reservation/retrouver', [ReservationController::class, 'lookup'])->name('public.reservations.lookup');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::middleware('guest')->group(function (): void {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware(['auth', 'admin'])->group(function (): void {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::post('/parties/{game}/archive', [AdminGameController::class, 'archive'])->name('games.archive');
        Route::post('/parties/{game}/duplicate', [AdminGameController::class, 'duplicate'])->name('games.duplicate');
        Route::post('/parties/{game}/publish', [AdminGameController::class, 'publish'])->name('games.publish');
        Route::post('/parties/{game}/unpublish', [AdminGameController::class, 'unpublish'])->name('games.unpublish');
        Route::post('/parties/{game}/toggle-reservations', [AdminGameController::class, 'toggleReservations'])->name('games.toggle-reservations');
        Route::get('/parties/{game}/export-csv', [AdminGameController::class, 'exportCsv'])->name('games.export-csv');

        Route::resource('parties', AdminGameController::class)
            ->parameters(['parties' => 'game'])
            ->names('games');

        Route::get('reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
        Route::get('reservations/{reservation}', [AdminReservationController::class, 'show'])->name('reservations.show');
        Route::patch('reservations/{reservation}/status', [AdminReservationController::class, 'updateStatus'])->name('reservations.update-status');
        Route::delete('reservations/{reservation}', [AdminReservationController::class, 'destroy'])->name('reservations.destroy');
    });
});
