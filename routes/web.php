<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\ContactController;

// Page d'accueil — français (défaut)
Route::get('/', [RoutingController::class, 'root'])->name('root');

// Page d'accueil — anglais
Route::get('/en', [RoutingController::class, 'root'])->name('root.en');

Route::post('contact-email', [ContactController::class, 'send'])->name('contact.email');

// Politique de confidentialité / Privacy policy
Route::get('/politique-confidentialite', [RoutingController::class, 'privacy'])->name('privacy.fr');
Route::get('/en/privacy-policy', [RoutingController::class, 'privacyEn'])->name('privacy.en');

Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
Route::get('{any}', [RoutingController::class, 'root'])->name('any');
