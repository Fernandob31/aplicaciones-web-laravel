<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promocion;
use App\Models\Producto;
use App\Models\Categoria;
use Carbon\Carbon;

class PromocionController extends Controller
{
    public function index(Request $request) {
        $query = Promocion::with('productos');

        if ($request->filled('buscar')) {
            $query->where(
                'nombre',
                'like',
                '%' . $request->buscar . '%'
            );
        }

        if ($request->filled('estado')) {
            $query->where(
                'estado',
                $request->estado
            );
        }

        $promociones = $query->latest()->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return view('promociones.partials.tabla', compact('promociones'))->render();
        }

        return view('promociones.index', compact('promociones'));
    }

    public function create()    {
        $categorias = Categoria::orderBy('nombre')->get();
        // marcas disponibles
        $marcas = Producto::where('descuento', 0)->select('marca')->distinct()->orderBy('marca')->pluck('marca');
        // productos disponibles
        $productos = Producto::where('descuento', 0)->orderBy('marca')->orderBy('modelo')->get();

        return view('promociones.create', compact('categorias','marcas','productos'));
    }

    public function store(Request $request)    {
        $idsProductos = []; // para los decuentos
    
        $mensajes = [
            'required' => 'Este campo es obligatorio.',
            'numeric' => 'Debe ser un número válido.',
            'min' => 'El valor mínimo es :min.',
            'max' => 'El valor máximo es :max.',
            'date' => 'Debe ingresar una fecha válida.',
            'after' => 'La fecha debe ser posterior a hoy.'
        ];

        $request->validate([
            'tipo' => 'required|in:categoria,marca,personalizada',
            'nombre' => 'required|string|max:255',
            'descuento' => 'required|numeric|min:1|max:99',
            'fecha_fin' => 'required|date|after_or_equal:today'
        ], $mensajes);

        if ($request->tipo == 'categoria' && empty($request->categorias)) {
            return back()->withErrors(['categorias' => 'Debe seleccionar al menos una categoría.'])->withInput();
        }
        if ($request->tipo == 'marca' && empty($request->marca)) {
            return back()->withErrors(['marca' => 'Debe seleccionar al menos una marca.'])->withInput();
        }
        if ($request->tipo == 'personalizada' && empty($request->productos)) {
            return back()->withErrors(['productos' => 'Debe seleccionar al menos un producto.'])->withInput();
        }

        // Obtenes producto afectados segun el tipo
        $productos = collect();
        if ($request->tipo == 'categoria') {
            $request->validate(['categorias' => 'required|array|min:1']);
            $productos = Producto::whereIn('categoria_id', $request->categorias)->where('descuento', 0)->get();
        }
        if ($request->tipo == 'marca') {
            $request->validate(['marca' => 'required|string']);
            $productos = Producto::where('marca', $request->marca)->where('descuento', 0)->get();
        }
        if ($request->tipo == 'personalizada') {
            $request->validate(['productos' => 'required|array|min:1']);
            $productos = Producto::whereIn('id', $request->productos)->where('descuento', 0)->get();
        }

        if ($productos->isEmpty()) {
            return back()->withErrors(['productos' => 'No se encontraron productos disponibles para esta promoción.'])->withInput();
        }
        $promocion = Promocion::create([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'descuento' => $request->descuento,
            'fecha_inicio' => Carbon::today(),
            'fecha_fin' => $request->fecha_fin,
            'estado' => 'activa'
        ]);
        
        // Aplicar el descuento
        foreach ($productos as $producto) {
            // $promocion->productos()->attach($producto->id);
            $producto->update(['descuento' => $request->descuento]);
            $idsProductos[] = $producto->id;
        }
        $promocion->productos()->attach($idsProductos);

        return redirect('/promociones')
            ->with('success', 'Promoción creada correctamente');
    }

    public function productosFiltrados(Request $request)    {
        $query = Producto::where('descuento', 0);

        if ($request->filled('marca')) {
            $query->where('marca', $request->marca);
        }

        if ($request->has('categorias')) {
            $query->whereIn('categoria_id', $request->categorias);
        }

        return response()->json($query->get());
    }

    public function show($id) {
        $promocion = Promocion::with('productos')->findOrFail($id);
        return view('promociones.show', compact('promocion'));
    }

    public function update(Request $request, $id) {
        $promocion = Promocion::findOrFail($id);
        $request->validate([
            'fecha_fin' => 'required|date|after_or_equal:today'],
            [
                'fecha_fin.after_or_equal' => 'La fecha de finalización debe ser hoy o una fecha futura.',
                'fecha_fin.required' => 'Debe ingresar una fecha de finalización.',
                'fecha_fin.date' => 'Debe ingresar una fecha válida.'
        ]);

        $promocion->update([
            'fecha_fin' => $request->fecha_fin
        ]);

        return redirect('/promociones/' . $promocion->id)->with('success', 'Promocion actualizada correctamente');
    }

    public function edit($id) {
        $promocion = Promocion::with('productos')->findOrFail($id);
        return view('promociones.edit', compact('promocion'));
    }

    public function destroy($id) {
        $promocion = Promocion::findOrFail($id);
        // Quitar descuento a todos los productos, Laravel permite actualizar en lote
        Producto::whereIn('id', $promocion->productos->pluck('id'))->update(['descuento' => 0]);
        // Eliminar relaciones tabla pivote
        $promocion->productos()->detach();
        // Eliminar promoción
        $promocion->delete();

        return response()->json(['message' => 'Promoción eliminada correctamente.']);
    }
}
