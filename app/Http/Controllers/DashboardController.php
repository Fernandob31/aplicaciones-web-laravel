<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\ProductoTalle;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $rol = $user->rol;

        $montoHoy = 0; $cantidadHoy = 0;
        $montoSemana = 0; $cantidadSemana = 0;
        $montoMes = 0; $cantidadMes = 0;
        $productoMasStock = null; $totalStockMasStock = 0; $detalleTallesStock = collect();
        $productoMasVendido = null; $cantidadMasVendido = 0;
        $totalProductosDisponibles = 0;
        $productosSinStock = collect();

        if (in_array($rol, ['admin', 'gestor_productos', 'gestor_stock'])) {
            $productosSinStock = ProductoTalle::with('producto')
                ->where('stock', 0)
                ->get()
                ->groupBy('producto_id');

            $subQueryStock = ProductoTalle::select('producto_id', DB::raw('SUM(stock) as total_stock'))
                ->groupBy('producto_id')
                ->orderByDesc('total_stock')
                ->first();

            if ($subQueryStock) {
                $productoMasStock = Producto::find($subQueryStock->producto_id);
                $totalStockMasStock = $subQueryStock->total_stock;
                $detalleTallesStock = ProductoTalle::where('producto_id', $subQueryStock->producto_id)->get();
            }
        }

        if (in_array($rol, ['admin', 'gestor_productos'])) {
            $hoy = Carbon::today();
            $inicioSemana = Carbon::now()->startOfWeek();
            $finSemana = Carbon::now()->endOfWeek();
            $mesActual = Carbon::now()->month;
            $anioActual = Carbon::now()->year;

            $montoHoy = Venta::whereDate('created_at', $hoy)->sum('total');
            $cantidadHoy = Venta::whereDate('created_at', $hoy)->count();

            $montoSemana = Venta::whereBetween('created_at', [$inicioSemana, $finSemana])->sum('total');
            $cantidadSemana = Venta::whereBetween('created_at', [$inicioSemana, $finSemana])->count();

            $montoMes = Venta::whereMonth('created_at', $mesActual)->whereYear('created_at', $anioActual)->sum('total');
            $cantidadMes = Venta::whereMonth('created_at', $mesActual)->whereYear('created_at', $anioActual)->count();

            $subQueryVendido = DB::table('detalle_ventas')
                ->select('producto_id', DB::raw('SUM(cantidad) as total_vendido'))
                ->groupBy('producto_id')
                ->orderByDesc('total_vendido')
                ->first();

            if ($subQueryVendido) {
                $productoMasVendido = Producto::find($subQueryVendido->producto_id);
                $cantidadMasVendido = $subQueryVendido->total_vendido;
            }
        }

        if ($rol === 'gestor_stock') {   
            $totalProductosDisponibles = ProductoTalle::sum('stock');
        }

        return view('dashboard', compact(
            'montoHoy', 'cantidadHoy', 
            'montoSemana', 'cantidadSemana', 
            'montoMes', 'cantidadMes',
            'productoMasStock', 'totalStockMasStock', 'detalleTallesStock',
            'productoMasVendido', 'cantidadMasVendido',
            'totalProductosDisponibles', 'productosSinStock'
        ));
    }
}