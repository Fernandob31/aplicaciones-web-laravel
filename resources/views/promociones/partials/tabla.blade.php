<table class="w-full text-sm">
    <thead class="bg-[#1a1a1a] text-gray-300">
        <tr>
            <th class="p-4 text-left text-gray-300">Nombre</th>
            <th class="p-4 text-left text-gray-300">Tipo</th>
            <th class="p-4 text-left text-gray-300">Desc.</th>
            <th class="p-4 text-left text-gray-300">Cant Productos</th>
            <th class="p-4 text-left text-gray-300">Inicio</th>
            <th class="p-4 text-left text-gray-300">Fin</th>
            <th class="p-4 text-left text-gray-300">Estado</th>
            <th class="p-4 text-left text-gray-300">Acciones</th>
        </tr>
    </thead>

    <tbody>
        @forelse($promociones as $promocion)
            <tr class="border-b border-gray-800 hover:bg-[#1a1a1a]/50">
                <td class="p-4 text-white"> {{ $promocion->nombre }} </td>
                <td class="p-4 text-gray-300 capitalize"> {{ $promocion->tipo }} </td>
                <td class="p-4 text-green-400 font-semibold"> {{ $promocion->descuento }}% </td>
                <td class="p-4 text-gray-300"> {{ $promocion->productos->count() }} </td>
                <td class="p-4 text-gray-300"> {{ \Carbon\Carbon::parse($promocion->fecha_inicio)->format('d/m/Y') }} </td>
                <td class="p-4 text-gray-300"> {{ \Carbon\Carbon::parse($promocion->fecha_fin)->format('d/m/Y') }} </td>
                <td class="p-4">
                    @if($promocion->estado == 'activa')
                        <span class="px-3 py-1 text-xs rounded-full bg-green-500/20 text-green-400">
                            Activa
                        </span>
                    @else
                        <span class="px-3 py-1 text-xs rounded-full bg-gray-500/20 text-gray-400">
                            Finalizada
                        </span>
                    @endif
                </td>
                <td class="p-4">
                    <div class="flex gap-2">
                        <a href="/promociones/{{ $promocion->id }}" class="px-3 py-1.5 text-sm bg-[#25a5be]/10 text-[#25a5be] rounded-lg border border-[#25a5be]/30">
                            Ver
                        </a>
                        <a href="/promociones/{{ $promocion->id }}/edit" class="px-3 py-1.5 text-sm bg-yellow-500/10 text-yellow-400 rounded-lg border border-yellow-500/30">
                            Editar
                        </a>
                        <form action="/promociones/{{ $promocion->id }}" method="POST" class="form-eliminar flex m-0"> 
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1.5 text-sm font-medium bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white 
                                    rounded-lg border border-red-500/30 transition-colors flex items-center justify-center">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="p-6 text-center text-gray-500">
                    No hay promociones registradas.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Elemento de Paginación Asíncrona --}}
<div id="pagination-container" class="bg-[#1a1a1a] p-4 border-t border-gray-800 flex justify-between items-center text-sm text-gray-400">
    <div>
        Mostrando registros del {{ $promociones->firstItem() ?? 0 }}
        al {{ $promociones->lastItem() ?? 0 }}
        de un total de {{ $promociones->total() }}
    </div>
    <div class="flex enlaces-paginacion">
        {{ $promociones->links() }}
    </div>
</div>
