<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Rutas de invitado (para loguearse)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Rutas protegidas (solo para usuarios que ya iniciaron sesión)
Route::middleware('auth')->group(function () {
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
// Cambiamos el retorno de texto por la vista que creaste
Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});