<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\Api\ProductoApiController;
use App\Http\Controllers\Api\VentaApiController;
use App\Http\Controllers\Api\CategoriaApiController;
use App\Http\Controllers\Api\PedidoApiController;
use App\Http\Controllers\VentaController;


// Rutas de invitado (para loguearse)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::get('/', function () {
    return redirect('/login');
});

// Api Publica
Route::get('/api-public/productos', [ProductoApiController::class, 'index'])->middleware('cors');
Route::get('/api-public/productos/{id}', [ProductoApiController::class, 'show'])->middleware('cors');
Route::get('/api-public/categorias', [CategoriaApiController::class, 'index'])->middleware('cors');
Route::get('/api-public/marcas', [ProductoApiController::class, 'marcas'])->middleware('cors');
//Ventas
Route::post('/api-public/ventas', [VentaApiController::class, 'store'])->middleware('cors');
Route::post('/api-public/pedidos', [PedidoApiController::class, 'store'])->middleware('cors');
Route::post('/api-public/pedidos/webhook', [PedidoApiController::class, 'webhook'])->middleware('cors');
Route::options('/api-public/{any}', function() {
    return response('', 200);
})->where('any', '.*')->middleware('cors');

// Rutas protegidas (solo para usuarios que ya iniciaron sesión)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Grupa para acceder CRUD usuarios
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('usuarios', UserController::class);

    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
    Route::get('/ventas/{id}', [VentaController::class, 'show'])->name('ventas.show');
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
    Route::get('/productos', [ProductoController::class, 'index']);
    Route::get('/productos/create', [ProductoController::class, 'create']);
    Route::post('/productos', [ProductoController::class, 'store']);
    Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');
    Route::get('/promociones/productos-filtrados', [PromocionController::class, 'productosFiltrados'])->name('promociones.productos');
    Route::get('/productos/{id}/edit', [ProductoController::class, 'edit']);
    Route::put('/productos/{id}', [ProductoController::class, 'update']);
    Route::delete('/productos/{id}', [ProductoController::class, 'destroy']);
});

// Grupa para acceder CRUD promociones 
Route::middleware(['auth', 'role:admin,gestor_stock'])->group(function () {
    // Promociones
    Route::get('/promociones', [PromocionController::class, 'index']);
    Route::get('/promociones/create', [PromocionController::class, 'create']);
    Route::post('/promociones', [PromocionController::class, 'store']);
    Route::get('/promociones/{id}', [PromocionController::class, 'show'])->name('promociones.show');
    //Route::get('/promociones/productos-filtrados', [PromocionController::class, 'productosFiltrados'])->name('promociones.productos');
    Route::get('/promociones/{id}/edit', [PromocionController::class, 'edit']);
    Route::put('/promociones/{id}', [PromocionController::class, 'update']);
    Route::delete('/promociones/{id}', [PromocionController::class, 'destroy']);
});

