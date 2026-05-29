<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductoApiController;

// URL final: tusitio.com/api/productos
Route::get('/productos', [ProductoApiController::class, 'index']);

// URL final: tusitio.com/api/productos/90001
Route::get('/productos/{id}', [ProductoApiController::class, 'show']);