<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Http\Resources\ProductoResource;
use Illuminate\Http\Request;
class ProductoApiController extends Controller
{

    public function index()
    {
        $productos = Producto::with(['categoria', 'talles', 'imagenes'])->paginate(10);
        return ProductoResource::collection($productos);
    }

    public function show($id)
    {
        $producto = Producto::with(['categoria', 'talles', 'imagenes'])->findOrFail($id);
        return new ProductoResource($producto);
    }
}
