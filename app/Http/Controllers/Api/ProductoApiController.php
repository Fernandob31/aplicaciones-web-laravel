<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

use App\Http\Resources\ProductoResource;

class ProductoApiController extends Controller
{
    public function index(Request $request) {
        $query = Producto::with(['categoria', 'talles', 'imagenes']);

        if ($request->query('con_descuento') == 'true') {
            $query->where('descuento', '>', 0);
        }
        
        // Búsqueda por texto libre
        if ($request->filled('busqueda')) {
            $busqueda = $request->busqueda;
            $query->where(function ($q) use ($busqueda) {
                $q->where('marca', 'like', "%$busqueda%")
                  ->orWhere('modelo', 'like', "%$busqueda%")
                  ->orWhere('descripcion', 'like', "%$busqueda%");
            });
        }

        // Filtro por categoría
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        // Filtro por marca
        if ($request->filled('marca')) {
            $query->where('marca', $request->marca);
        }

        // Filtro por rango de precio
        if ($request->filled('precio_min')) {
            $query->where('precio', '>=', $request->precio_min);
        }
        if ($request->filled('precio_max')) {
            $query->where('precio', '<=', $request->precio_max);
        }

        $productos = $query->paginate($request->input('per_page', 12));

        return response()->json([
            'data' => $productos->map(function ($producto) {
                return $this->formatearProductoListado($producto);
            }),
            'meta' => [
                'current_page' => $productos->currentPage(),
                'last_page'    => $productos->lastPage(),
                'per_page'     => $productos->perPage(),
                'total'        => $productos->total(),
            ]
        ]);
    }

    public function show($id) {
        $producto = Producto::with(['categoria', 'talles', 'imagenes'])->findOrFail($id);

        $talles = $producto->talles->map(function ($t) {return ['talle' => $t->talle,'stock' => $t->stock,];});

        $imagenes = $producto->imagenes->pluck('url_imagen');

        return response()->json([
            'data' => [
                'id'               => $producto->id,
                'marca'            => $producto->marca,
                'modelo'           => $producto->modelo,
                'descripcion'      => $producto->descripcion,
                'precio'           => $producto->precio,
                'descuento'        => $producto->descuento,
                'precio_final'     => $this->calcularPrecioFinal($producto),
                'categoria'        => [
                    'id'     => $producto->categoria->id,
                    'nombre' => $producto->categoria->nombre,
                ],
                'imagen_principal' => $producto->imagen,
                'imagenes'         => $imagenes,
                'talles'           => $talles,
            ]
        ]);
    }

    public function marcas() {
        $marcas = Producto::select('marca')->distinct()->orderBy('marca')->pluck('marca');

        return response()->json(['data' => $marcas]);
    }

    // --- Helpers privados ---
    private function formatearProductoListado($producto) {
        $tallesDisponibles = $producto->talles->where('stock', '>', 0)->pluck('talle')->values();

        return [
            'id'                => $producto->id,
            'marca'             => $producto->marca,
            'modelo'            => $producto->modelo,
            'descripcion'       => $producto->descripcion,
            'precio'            => $producto->precio,
            'descuento'         => $producto->descuento,
            'precio_final'      => $this->calcularPrecioFinal($producto),
            'categoria'         => [
                'id'     => $producto->categoria->id,
                'nombre' => $producto->categoria->nombre,
            ],
            'imagen_principal'  => $producto->imagen,
            'talles_disponibles' => $tallesDisponibles,
        ];
    }

    private function calcularPrecioFinal($producto) {
        if ($producto->descuento > 0) {
            return round($producto->precio * (1 - $producto->descuento / 100));
        }
        return $producto->precio;
    }
}
