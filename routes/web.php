<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\ProductoApiController;


// Rutas de invitado (para loguearse)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::get('/', function () {
    return redirect('/login');
});

// Api Publica
Route::get('/api-public/productos', [ProductoApiController::class, 'index']);
Route::get('/api-public/productos/{id}', [ProductoApiController::class, 'show']);

// Rutas protegidas (solo para usuarios que ya iniciaron sesión)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Grupa para acceder CRUD usuarios
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('usuarios', UserController::class);
});

// Grupa para acceder CRUD caregorias
Route::middleware(['auth', 'role:admin,gestor_productos'])->group(function () {
    // Categorias 
    // Route::resource('categorias', CategoriaController::class);
    Route::get('/categorias', [CategoriaController::class, 'index']);
    Route::get('/categorias/create', [CategoriaController::class, 'create']);
    Route::post('/categorias', [CategoriaController::class, 'store']);
    Route::get('/categorias/{id}/edit', [CategoriaController::class, 'edit']);
    Route::put('/categorias/{id}', [CategoriaController::class, 'update']);
    Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy']);
});

// Grupa para acceder CRUD productos 
Route::middleware(['auth', 'role:admin,gestor_productos,gestor_stock'])->group(function () {
    // Productos
    // Route::resource('productos', ProductoController::class);   
    Route::get('/productos', [ProductoController::class, 'index']);
    Route::get('/productos/create', [ProductoController::class, 'create']);
    Route::post('/productos', [ProductoController::class, 'store']);
    Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');
    Route::get('/productos/{id}/edit', [ProductoController::class, 'edit']);
    Route::put('/productos/{id}', [ProductoController::class, 'update']);
    Route::delete('/productos/{id}', [ProductoController::class, 'destroy']);
});
