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
        $mensajes = [
            'required' => 'Este campo es obligatorio.',
            'numeric'  => 'Debe ser un número válido.',
            'min'      => 'El valor mínimo es :min.',
            'image'    => 'El archivo debe ser una imagen.',
            'mimes'    => 'La imagen debe ser jpeg, png, jpg o webp.',
            'max'      => 'El archivo no debe pesar más de 2MB.',
            'exists'   => 'La opción seleccionada no es válida.'
        ];
        $request->validate([
            'categoria_id'     => 'required|exists:categorias,id',
            'modelo'           => 'required|string|max:255',
            'marca'            => 'required|string|max:255',
            'precio'           => 'required|numeric|min:0',
            'colores'          => 'required|string',
            'genero'           => 'required|string',
            'descripcion'      => 'required|string',
            'imagen_principal' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'talles'           => 'nullable|array',
            'talles.*'         => 'nullable|string',
            'stocks'           => 'nullable|array',
            'stocks.*'         => 'nullable|numeric|min:0',
            'galeria'          => 'nullable|array',
            'galeria.*'        => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ], $mensajes);
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
        if ($request->has('talles') && is_array($request->talles)) {
            foreach ($request->talles as $index => $talle) {
                if ($talle) {
                    ProductoTalle::create([
                        'producto_id' => $producto->id,
                        'talle' => $talle,
                        'stock' => $request->stocks[$index]
                    ]);
                }
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
        return redirect('/productos')->with('success', 'Producto creado exitosamente');
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
        $mensajes = [
            'required' => 'Este campo es obligatorio.',
            'numeric'  => 'Debe ser un número válido.',
            'min'      => 'El valor mínimo es :min.',
            'image'    => 'El archivo debe ser una imagen.',
            'mimes'    => 'La imagen debe ser jpeg, png, jpg o webp.',
            'max'      => 'El archivo no debe pesar más de 2MB.',
            'exists'   => 'La opción seleccionada no es válida.'
        ];

        // Validacion
        if (auth()->user()->rol == 'gestor_stock') {
            $request->validate([
                'talles'           => 'nullable|array',
                'talles.*'         => 'nullable|string',
                'stocks'           => 'nullable|array',
                'stocks.*'         => 'nullable|numeric|min:0'
            ], $mensajes);
        } else {
            $request->validate([
                'categoria_id'     => 'required|exists:categorias,id',
                'modelo'           => 'required|string|max:255',
                'marca'            => 'required|string|max:255',
                'precio'           => 'required|numeric|min:0',
                'colores'          => 'required|string',
                'genero'           => 'required|string',
                'descripcion'      => 'required|string',
                'imagen_principal' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'talles'           => 'nullable|array',
                'talles.*'         => 'nullable|string',
                'stocks'           => 'nullable|array',
                'stocks.*'         => 'nullable|numeric|min:0',
                'galeria'          => 'nullable|array',
                'galeria.*'        => 'image|mimes:jpeg,png,jpg,webp|max:2048'
            ], $mensajes);
        }

        $producto = Producto::findOrFail($id);
        if (auth()->user()->rol == 'gestor_stock') {
            // Solo actualiza talles y stock
            $producto->talles()->delete();
            if ($request->has('talles') && is_array($request->talles)) {
                foreach ($request->talles as $index => $talle) {
                    if ($talle) {
                        ProductoTalle::create([
                            'producto_id' => $producto->id,
                            'talle' => $talle,
                            'stock' => $request->stocks[$index]
                        ]);
                    }
                }
            }
            return redirect('/productos/' . $producto->id)
                ->with('success', 'Stock actualizado correctamente');
        }

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

        // Si se agregaron nuevos talles, se actualiza
        if ($request->has('talles') && is_array($request->talles)) {
            $producto->talles()->delete();
            foreach ($request->talles as $index => $talle) {
                if ($talle) {
                    ProductoTalle::create([
                        'producto_id' => $producto->id,
                        'talle' => $talle,
                        'stock' => $request->stocks[$index]
                    ]);
                }
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
        return redirect('/productos/' . $producto->id)->with('success', 'Producto actualizado correctamente');
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
