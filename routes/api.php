<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductoApiController;

Route::get('/productos', [ProductoApiController::class, 'index']);

Route::get('/productos/{id}', [ProductoApiController::class, 'show']);