<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductoApiController;
use App\Http\Controllers\Api\CategoriaApiController;

Route::get('/productos', [ProductoApiController::class, 'index']);
Route::get('/productos/{id}', [ProductoApiController::class, 'show']);
Route::get('/categorias', [CategoriaApiController::class, 'index']);
Route::get('/marcas', [ProductoApiController::class, 'marcas']);
Route::post('/pedidos', [PedidoApiController::class, 'store']);
Route::post('/pedidos/webhook', [PedidoApiController::class, 'webhook']);