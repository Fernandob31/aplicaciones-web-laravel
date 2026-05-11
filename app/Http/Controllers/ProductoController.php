<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto;
use App\Models\ProductoTalle;
use App\Models\Categoria;

class ProductoController extends Controller
{
    public function index() {
        $productos = Producto::with(['categoria', 'talles'])->get();
        return view('productos.index', compact('productos'));
    }

    public function create() {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request) {
        // crea el producto
        $producto = Producto::create([
            'categoria_id' => $request->categoria_id,
            'modelo' => $request->modelo,
            'marca' => $request->marca,
            'precio' => $request->precio,
            'colores' => explode(',', $request->colores),
            'genero' => $request->genero,
            'descripcion' => $request->descripcion,
            'imagen' => null,
            'resena' => 0
        ]);
        // crea los talles
        foreach ($request->talles as $index => $talle) {
            if ($talle) {
                ProductoTalle::create([
                    'producto_id' => $producto->id,
                    'talle' => $talle,
                    'stock' => $request->stocks[$index]
                ]);
            }
        }
        return redirect('/productos');
    }
    
    public function edit($id) {
        $producto = Producto::with('talles')->findOrFail($id); // trae producot y talles asociados
        $categorias = Categoria::all(); // trae categorias

        return view('productos.edit', compact(
            'producto',
            'categorias'
        ));
    }
    // delete + create
    public function update(Request $request, $id) {
        $producto = Producto::findOrFail($id);
        $producto->update([
            'categoria_id' => $request->categoria_id,
            'modelo' => $request->modelo,
            'marca' => $request->marca,
            'precio' => $request->precio,
            'colores' => explode(',', $request->colores),
            'genero' => $request->genero,
            'descripcion' => $request->descripcion
        ]);
        // Borra talles viejos
        $producto->talles()->delete();
        // Crea talles nuevos
        foreach ($request->talles as $index => $talle) {
            if ($talle) {
                ProductoTalle::create([
                    'producto_id' => $producto->id,
                    'talle' => $talle,
                    'stock' => $request->stocks[$index]
                ]);
            }
        }
        return redirect('/productos');
    }

    public function destroy($id) {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect('/productos');
    }
}
