<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        $query = Venta::query();

        if ($request->filled('codigo')) {
            $query->where('codigo_compra', 'LIKE', '%' . $request->codigo . '%');
        }

        if ($request->filled('fecha')) {
            $query->whereDate('created_at', $request->fecha);
        }

        $ventas = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        
        if ($request->ajax()) {
            return view('ventas.partials.tabla', compact('ventas'))->render();
        }

        return view('ventas.index', compact('ventas'));
    }

    public function show($id)
    {
        $venta = Venta::with(['detalles.producto', 'detalles.productoTalle'])->findOrFail($id);
        
        return view('ventas.show', compact('venta'));
    }
}