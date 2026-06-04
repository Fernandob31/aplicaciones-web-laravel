<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index() {
        $categorias = Categoria::all(); // Traemos todas las categoras de la BD
        // compact(...) envia esa variable a la vista
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
