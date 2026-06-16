<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaApiController extends Controller
{
    public function index() {
        $categorias = Categoria::orderBy('nombre')->get(['id', 'nombre']);

        return response()->json(['data' => $categorias]);
    }
}
