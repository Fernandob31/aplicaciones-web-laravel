<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener los datos de la base de datos
        $totalProductos = Producto::count();
        $totalCategorias = Categoria::count();
        $totalUsuarios = User::count();

        return view('dashboard', compact('totalProductos', 'totalCategorias', 'totalUsuarios'));
    }
}