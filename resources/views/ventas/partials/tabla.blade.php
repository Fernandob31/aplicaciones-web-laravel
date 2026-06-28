<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="border-b border-gray-800 bg-black/20 text-gray-400 text-xs uppercase tracking-wider font-bold">
            <tr>
                <th class="px-6 py-4">Código de Compra</th>
                <th class="px-6 py-4">Fecha</th>
                <th class="px-6 py-4">Cliente</th>
                <th class="px-6 py-4">Total</th>
                <th class="px-6 py-4 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-800 text-gray-300 text-sm">
            @forelse($ventas as $venta)
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4 font-semibold text-[#25a5be]">{{ $venta->codigo_compra }}</td>
                    <td class="px-6 py-4">{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4">
                        {{ $venta->nombre }} {{ $venta->apellido }}
                        <span class="block text-xs text-gray-500">{{ $venta->email }}</span>
                    </td>
                    <td class="px-6 py-4 font-bold text-white">${{ number_format($venta->total, 2) }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('ventas.show', $venta->id) }}" 
                               class="px-3 py-1.5 text-sm font-medium bg-[#25a5be]/10 text-[#25a5be] rounded-lg border border-[#25a5be]/30 hover:bg-[#25a5be]/20 transition-colors flex items-center justify-center">
                                Ver Detalles
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">
                        No se encontraron ventas que coincidan con los filtros aplicados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


    <div id="pagination-container" class="bg-[#1a1a1a] p-4 border-t border-gray-800 flex justify-between items-center text-sm text-gray-400">
        <div>
            Mostrando registros del {{ $ventas->firstItem() ?? 0 }} al {{ $ventas->lastItem() ?? 0 }} de un total de {{ $ventas->total() }}
        </div>
        <div class="flex enlaces-paginacion">
            {{ $ventas->links() }}
        </div>
    </div>
