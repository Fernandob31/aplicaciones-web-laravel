@extends('layouts.admin')

@section('titulo', 'Detalle de Venta')

@section('contenido')
<div class="max-w-5xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-white">Factura: <span class="text-[#25a5be]">{{ $venta->codigo_compra }}</span></h1>
        <a href="{{ route('ventas.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm font-semibold flex items-center gap-2">
            ← Volver al listado
        </a>
    </div>

    <div class="bg-[#121212]/80 rounded-xl border border-gray-800 shadow-lg p-6 mb-8">
        <h2 class="text-lg font-bold text-white mb-4 border-b border-gray-800 pb-2">Información del Cliente</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
            <div>
                <p class="text-gray-500 uppercase tracking-wider text-xs font-bold mb-1">Nombre Completo</p>
                <p class="text-gray-200">{{ $venta->nombre }} {{ $venta->apellido }}</p>
            </div>
            <div>
                <p class="text-gray-500 uppercase tracking-wider text-xs font-bold mb-1">Correo Electrónico</p>
                <p class="text-gray-200">{{ $venta->email }}</p>
            </div>
            <div>
                <p class="text-gray-500 uppercase tracking-wider text-xs font-bold mb-1">Fecha de Transacción</p>
                <p class="text-gray-200">{{ $venta->created_at->format('d/m/Y H:i:s') }}</p>
            </div>
            <div>
                <p class="text-gray-500 uppercase tracking-wider text-xs font-bold mb-1">Estado</p>
                <span class="inline-block px-2 py-1 text-xs font-bold text-green-500 bg-green-500/10 rounded border border-green-500/20 capitalize">
                    {{ $venta->estado }}
                </span>
            </div>
        </div>
    </div>

    <div class="bg-[#121212]/80 rounded-xl border border-gray-800 shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-800">
            <h2 class="text-lg font-bold text-white">Detalle de la Compra</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-black/20 text-gray-400 text-xs uppercase tracking-wider font-bold border-b border-gray-800">
                        <th class="px-6 py-4">Producto</th>
                        <th class="px-6 py-4">Talle</th>
                        <th class="px-6 py-4 text-center">Cantidad</th>
                        <th class="px-6 py-4 text-right">Precio Unitario</th>
                        <th class="px-6 py-4 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800 text-gray-300 text-sm">
                    @foreach($venta->detalles as $detalle)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-bold text-white">{{ $detalle->producto->modelo ?? 'Producto Eliminado' }}</span>
                                <span class="block text-xs text-gray-500">{{ $detalle->producto->marca ?? '' }}</span>
                            </td>
                            <td class="px-6 py-4 font-semibold">
                                {{ $detalle->productoTalle->talle ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $detalle->cantidad }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                ${{ number_format($detalle->precio_unitario, 2) }}
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-white">
                                ${{ number_format($detalle->subtotal, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-black/40">
                        <td colspan="4" class="px-6 py-4 text-right text-sm uppercase tracking-wider font-bold text-gray-400">Total Pagado:</td>
                        <td class="px-6 py-4 text-right text-xl font-extrabold text-[#25a5be]">${{ number_format($venta->total, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection