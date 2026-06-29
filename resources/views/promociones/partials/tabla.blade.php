<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="border-b border-gray-800 bg-black/20 text-gray-400 text-xs uppercase tracking-wider font-bold">
            <tr>
                <th class="px-6 py-4">Nombre</th>
                <th class="px-6 py-4">Tipo</th>
                <th class="px-6 py-4">Desc.</th>
                <th class="px-6 py-4">Cant Productos</th>
                <th class="px-6 py-4">Inicio</th>
                <th class="px-6 py-4">Fin</th>
                <th class="px-6 py-4">Estado</th>
                <th class="px-6 py-4 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-800 text-gray-300 text-sm">
            @forelse($promociones as $promocion)
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4 font-semibold text-white"> {{ $promocion->nombre }} </td>
                    <td class="px-6 py-4 capitalize"> {{ $promocion->tipo }} </td>
                    <td class="px-6 py-4 text-green-400 font-semibold"> {{ $promocion->descuento }}% </td>
                    <td class="px-6 py-4"> {{ $promocion->productos->count() }} </td>
                    <td class="px-6 py-4"> {{ \Carbon\Carbon::parse($promocion->fecha_inicio)->format('d/m/Y') }} </td>
                    <td class="px-6 py-4"> {{ \Carbon\Carbon::parse($promocion->fecha_fin)->format('d/m/Y') }} </td>
                    <td class="px-6 py-4">
                        @if($promocion->estado == 'activa')
                            <span class="px-3 py-1 text-xs rounded-full bg-green-500/20 text-green-400 border border-green-500/30">
                                Activa
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs rounded-full bg-gray-500/20 text-gray-400 border border-gray-500/30">
                                Finalizada
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                        <a href="/promociones/{{ $promocion->id }}" 
                        class="px-3 py-1.5 text-sm font-medium bg-[#25a5be]/10 text-[#25a5be] rounded-lg border border-[#25a5be]/30 hover:bg-[#25a5be]/20 transition-colors flex items-center justify-center">
                            Ver Detalles
                        </a>
                        
                        {{-- Condición para ocultar el botón si está finalizada --}}
                        @if($promocion->estado == 'activa')
                            <a href="/promociones/{{ $promocion->id }}/edit" 
                            class="px-3 py-1.5 text-sm font-medium bg-yellow-500/10 text-yellow-400 rounded-lg border border-yellow-500/30 hover:bg-yellow-500/20 transition-colors flex items-center justify-center">
                                Editar
                            </a>
                        @endif

                        <form action="/promociones/{{ $promocion->id }}" method="POST" class="form-eliminar flex m-0"> 
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-3 py-1.5 text-sm font-medium bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white rounded-lg border border-red-500/30 transition-colors flex items-center justify-center">
                                Eliminar
                            </button>
                        </form>
                    </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-gray-500 italic">
                        No hay promociones registradas.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="pagination-container" class="bg-[#1a1a1a] p-4 border-t border-gray-800 flex justify-between items-center text-sm text-gray-400">
    <div>
        Mostrando registros del {{ $promociones->firstItem() ?? 0 }} al {{ $promociones->lastItem() ?? 0 }} de un total de {{ $promociones->total() }}
    </div>
    <div class="flex enlaces-paginacion">
        {{ $promociones->links() }}
    </div>
</div>