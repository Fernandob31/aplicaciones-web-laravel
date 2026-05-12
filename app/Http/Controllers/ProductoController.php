<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto;
use App\Models\ProductoTalle;
use App\Models\Categoria;
use App\Models\ImagenProducto;
use Cloudinary\Cloudinary;

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
        $cloudinary = new Cloudinary(env('CLOUDINARY_URL'));

        $urlPrincipal = null;
        if ($request->hasFile('imagen_principal')) {
            $upload = $cloudinary->uploadApi()->upload(
                $request->file('imagen_principal')->getRealPath(),
                ['folder' => 'sneakers/principal']
            );
            $urlPrincipal = $upload['secure_url'];
        }

        $producto = Producto::create([
            'categoria_id' => $request->categoria_id,
            'modelo' => $request->modelo,
            'marca' => $request->marca,
            'precio' => $request->precio,
            'colores' => explode(',', $request->colores),
            'genero' => $request->genero,
            'descripcion' => $request->descripcion,
            'imagen' => $urlPrincipal,
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
        // 4. Subir la galería de imágenes
        if ($request->hasFile('galeria')) {
            foreach ($request->file('galeria') as $img) {
                $uploadGaleria = $cloudinary->uploadApi()->upload(
                    $img->getRealPath(),
                    ['folder' => 'sneakers/galeria']
                );
                
                ImagenProducto::create([
                    'producto_id' => $producto->id,
                    'url_imagen' => $uploadGaleria['secure_url']
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
        $cloudinary = new Cloudinary(env('CLOUDINARY_URL'));
        $datosActualizar = [
            'categoria_id' => $request->categoria_id,
            'modelo' => $request->modelo,
            'marca' => $request->marca,
            'precio' => $request->precio,
            'colores' => explode(',', $request->colores),
            'genero' => $request->genero,
            'descripcion' => $request->descripcion
        ];
        // Si la imagen principal cambio, se actualiza
        if ($request->hasFile('imagen_principal')) {
            $upload = $cloudinary->uploadApi()->upload(
                $request->file('imagen_principal')->getRealPath(),
                ['folder' => 'sneakers/principal']
            );
            $datosActualizar['imagen'] = $upload['secure_url'];
        }

        $producto->update($datosActualizar);
        
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
        // Si se agregaron nuevas imagenes a la galeria, se actualiza
        if ($request->hasFile('galeria')) {
            foreach ($request->file('galeria') as $img) {
                $uploadGaleria = $cloudinary->uploadApi()->upload(
                    $img->getRealPath(),
                    ['folder' => 'sneakers/galeria']
                );
                
                ImagenProducto::create([
                    'producto_id' => $producto->id,
                    'url_imagen' => $uploadGaleria['secure_url']
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

    public function show($id) {
        // Cargamos el producto con sus relaciones para que no falte nada
        $producto = Producto::with(['categoria', 'talles', 'imagenes'])->findOrFail($id);
        return view('productos.show', compact('producto'));
    }
}
