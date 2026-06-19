<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\ProductoTalle;

class VentaApiController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'required|string|max:50',
            'direccion' => 'required|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.producto_id' => 'required|exists:productos,id',
            'items.*.talle'         => 'required|string',
            'items.*.cantidad' => 'required|integer|min:1',
        ]);

        try {
            $resultado = DB::transaction(function () use ($request) {
                $codigoCompra = 'FAC-' . strtoupper(Str::random(8));

                $venta = Venta::create([
                    'codigo_compra' => $codigoCompra,
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                    'email' => $request->email,
                    'telefono'      => $request->telefono,
                    'direccion'     => $request->direccion,
                    'total' => 0,
                    'estado' => 'pendiente',
                ]);

                $totalVenta = 0;

                foreach ($request->items as $item) {
                    $producto = Producto::findOrFail($item['producto_id']);
                    $productoTalle = null;

                    // Buscar por producto_id y talle directo
                    $productoTalle = ProductoTalle::where('producto_id', $item['producto_id'])
                        ->where('talle', $item['talle'])
                        ->first();

                    if (!$productoTalle || $productoTalle->stock < $item['cantidad']) {
                        throw new \Exception("Stock insuficiente para {$producto->marca} {$producto->modelo} talle {$item['talle']}");
                    }

                    $productoTalle->decrement('stock', $item['cantidad']);

                    // Aplicamos descuento si tiene 
                    $precioUnitario = $producto->descuento > 0
                        ? round($producto->precio * (1 - $producto->descuento / 100))
                        : $producto->precio;
                    
                    $subtotal = $precioUnitario * $item['cantidad'];
                    $totalVenta += $subtotal;

                    DetalleVenta::create([
                        'venta_id' => $venta->id,
                        'producto_id' => $producto->id,
                        'producto_talle_id' => $productoTalle->id,
                        'cantidad' => $item['cantidad'],
                        'precio_unitario' => $producto->precio,
                        'subtotal' => $subtotal,
                    ]);
                }

                $venta->update(['total' => $totalVenta]);

                return $venta;
            });

            return response()->json([
                'success' => true,
                'pedido_id'     => $resultado->id,
                'message' => 'Venta procesada con éxito',
                'codigo_compra' => $resultado->codigo_compra,
                'total' => $resultado->total
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}