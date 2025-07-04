<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TireStationController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/tire-station', [TireStationController::class, 'index'])->name('tire-service.index');
    Route::get('/tire-station/{tireService}', [TireStationController::class, 'show'])->name('tire-service.show');
    Route::post('/tire-station/{id}', [TireStationController::class, 'update'])->name('tire-service.update');

});
