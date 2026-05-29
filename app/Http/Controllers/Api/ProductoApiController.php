<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Http\Resources\ProductoResource;
use Illuminate\Http\Request;

class ProductoApiController extends Controller
{
    // Devuelve el listado completo de productos
    public function index()
    {
        // Traemos los productos junto con sus imágenes y talles usando "Eager Loading"
        // para que la base de datos no sufra haciendo múltiples consultas
        $productos = Producto::with(['imagenes', 'talles'])->get();

        // Según las buenas prácticas de Azure, devolvemos un código 200 (OK)
        return response()->json(ProductoResource::collection($productos));
    }

    // Devuelve un solo producto específico
    public function show($id)
    {
        $producto = Producto::with(['imagenes', 'talles'])->find($id);

        if (!$producto) {
            // Azure recomienda devolver código 404 estructurado cuando algo no existe
            return response()->json([
                'status' => 'error',
                'message' => 'Producto no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $producto
        ], 200);
    }
}