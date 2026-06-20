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
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;

class PedidoApiController extends Controller
{
    public function __construct() {
        MercadoPagoConfig::setAccessToken(env('MP_ACCESS_TOKEN'));
    }

    public function store(Request $request) {
        $request->validate([
            'nombre'                => 'required|string|max:255',
            'apellido'              => 'required|string|max:255',
            'email'                 => 'required|email|max:255',
            'telefono'              => 'required|string|max:50',
            'direccion'             => 'required|string|max:255',
            'items'                 => 'required|array|min:1',
            'items.*.producto_id'   => 'required|exists:productos,id',
            'items.*.talle'         => 'required|string',
            'items.*.cantidad'      => 'required|integer|min:1',
        ]);

        try {
            $resultado = DB::transaction(function () use ($request) {
                $codigoCompra = 'FAC-' . strtoupper(Str::random(8));

                $venta = Venta::create([
                    'codigo_compra' => $codigoCompra,
                    'nombre'        => $request->nombre,
                    'apellido'      => $request->apellido,
                    'email'         => $request->email,
                    'telefono'      => $request->telefono,
                    'direccion'     => $request->direccion,
                    'total'         => 0,
                    'estado'        => 'pendiente',
                ]);

                $totalVenta = 0;
                $itemsMP = [];

                foreach ($request->items as $item) {
                    $producto = Producto::findOrFail($item['producto_id']);

                    $productoTalle = ProductoTalle::where('producto_id', $item['producto_id'])
                        ->where('talle', $item['talle'])
                        ->first();

                    if (!$productoTalle || $productoTalle->stock < $item['cantidad']) {
                        throw new \Exception("Stock insuficiente para {$producto->marca} {$producto->modelo} talle {$item['talle']}");
                    }

                    $productoTalle->decrement('stock', $item['cantidad']);

                    $precioUnitario = $producto->descuento > 0
                        ? round($producto->precio * (1 - $producto->descuento / 100))
                        : $producto->precio;

                    $subtotal = $precioUnitario * $item['cantidad'];
                    $totalVenta += $subtotal;

                    DetalleVenta::create([
                        'venta_id'          => $venta->id,
                        'producto_id'       => $producto->id,
                        'producto_talle_id' => $productoTalle->id,
                        'cantidad'          => $item['cantidad'],
                        'precio_unitario'   => $precioUnitario,
                        'subtotal'          => $subtotal,
                    ]);

                    $itemsMP[] = [
                        'id'          => (string) $producto->id,
                        'title'       => "{$producto->marca} {$producto->modelo} - Talle {$item['talle']}",
                        'quantity'    => (int) $item['cantidad'],
                        'unit_price'  => (float) $precioUnitario,
                        'currency_id' => 'ARS',
                    ];
                }

                $venta->update(['total' => $totalVenta]);

                // Crear preferencia en MercadoPago
                $client = new PreferenceClient();

                $preference = $client->create([
                    'items'               => $itemsMP,
                    'payer'               => [
                        'name'    => $request->nombre,
                        'surname' => $request->apellido,
                        'email'   => $request->email,
                    ],
                    'back_urls'           => [
                        'success' => env('FRONTEND_URL') . '/pago/exitoso',
                        'failure' => env('FRONTEND_URL') . '/pago/fallido',
                        'pending' => env('FRONTEND_URL') . '/pago/exitoso',
                    ],
                    'auto_return'         => 'approved',
                    'external_reference'  => $codigoCompra,
                ]);

                $venta->update(['mp_payment_id' => $preference->id]);

                return [
                    'venta'      => $venta,
                    'mp_init_point' => $preference->init_point,
                ];
            });

            return response()->json([
                'success'       => true,
                'pedido_id'     => $resultado['venta']->id,
                'codigo_compra' => $resultado['venta']->codigo_compra,
                'mp_init_point' => $resultado['mp_init_point'],
            ], 201);

        } catch (MPApiException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error con MercadoPago: ' . $e->getMessage()
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function webhook(Request $request)
    {
        $paymentId = $request->input('data.id');

        if (!$paymentId) {
            return response()->json(['ok' => true]);
        }

        try {
            MercadoPagoConfig::setAccessToken(env('MP_ACCESS_TOKEN'));

            $client = new \MercadoPago\Client\Payment\PaymentClient();
            $payment = $client->get($paymentId);

            $externalReference = $payment->external_reference;
            $estado = $payment->status;

            $venta = Venta::where('codigo_compra', $externalReference)->first();

            if ($venta) {
                $nuevoEstado = match($estado) {
                    'approved' => 'completada',
                    'rejected' => 'rechazada',
                    default    => 'pendiente',
                };

                $venta->update([
                    'estado'        => $nuevoEstado,
                    'mp_payment_id' => $paymentId,
                ]);
            }

        } catch (\Exception $e) {
            \Log::error('Webhook MP error: ' . $e->getMessage());
        }

        return response()->json(['ok' => true]);
    }
}