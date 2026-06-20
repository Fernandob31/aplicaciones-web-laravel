<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('buscar')) {
            $query->where('username', 'like', '%' . $request->buscar . '%');
        }

        $usuarios = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return view('usuarios.partials.tabla', compact('usuarios'))->render();
        }

        return view('usuarios.index', compact('usuarios'));
    }
    
    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'rol' => 'required'
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'rol' => $request->rol
        ]);

        return redirect('/usuarios')
            ->with('success', 'Usuario creado correctamente');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $usuario = User::findOrFail($id);

        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, string $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:users,username,' . $usuario->id,
            'rol' => 'required'
        ]);

        $usuario->username = $request->username;
        $usuario->rol = $request->rol;

        // Solo actualiza contraseña si se escribió una nueva
        if ($request->password) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect('/usuarios')
            ->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(string $id)
    {
        if (auth()->id() == $id) {

            return redirect('/usuarios')
                ->with('error', 'No puedes eliminar tu propio usuario');
        }

        $usuario = User::findOrFail($id);

        $usuario->delete();

        return redirect('/usuarios')
            ->with('success', 'Usuario eliminado correctamente');
    }

}
