<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index(Request $request) {
        $query = Categoria::query();

        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        $categorias = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return view('categorias.partials.tabla', compact('categorias'))->render();
        }

        return view('categorias.index', compact('categorias')); 
    }

    public function create() {
        return view('categorias.create');
    }
    // recibe datos del formulario
    public function store(Request $request) {
        // inserta en la BD
        Categoria::create([
            'nombre' => $request->nombre
        ]);

        return redirect('/categorias')->with('success', 'Categoría creada exitosamente');; // redirige 
    }

    public function edit($id) {
        $categoria = Categoria::findOrFail($id);    // Busca por ID 

        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id) {
        $categoria = Categoria::findOrFail($id);

        $categoria->update([
            'nombre' => $request->nombre
        ]);

        return redirect('/categorias')->with('success', 'Categoría actualizada exitosamente');;
    }

    public function destroy($id) {
        $categoria = Categoria::findOrFail($id);

        $categoria->delete();

        return redirect('/categorias')->with('success', 'Categoría eliminada exitosamente');;
    }
}
