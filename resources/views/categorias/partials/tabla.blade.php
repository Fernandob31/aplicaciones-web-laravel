<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="border-b border-gray-800 bg-black/20 text-gray-400 text-xs uppercase tracking-wider font-bold">
            <tr>
                <th class="px-6 py-4">ID</th>
                <th class="px-6 py-4">Nombre</th>
                <th class="px-6 py-4 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-800 text-gray-300 text-sm">
            @forelse($categorias as $categoria)
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-3 text-gray-400">{{ $categoria->id }}</td>
                    <td class="px-6 py-3 font-medium text-white">{{ $categoria->nombre }}</td>
                    <td class="px-6 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <a href="/categorias/{{ $categoria->id }}/edit" 
                               class="inline-flex items-center justify-center px-3 py-1 text-xs font-bold bg-yellow-500/10 text-yellow-400 rounded border border-yellow-500/30 hover:bg-yellow-500/20 transition-colors whitespace-nowrap">
                                Editar
                            </a>
                            <form action="/categorias/{{ $categoria->id }}" method="POST" class="form-eliminar flex m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center justify-center px-3 py-1 text-xs font-bold bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white rounded border border-red-500/30 transition-colors whitespace-nowrap">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-8 text-center text-gray-500 italic">
                        No se encontraron categorías.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

    <div id="pagination-container" class="bg-[#1a1a1a] p-4 border-t border-gray-800 flex justify-between items-center text-sm text-gray-400">
        <div>
            Mostrando registros del {{ $categorias->firstItem() ?? 0 }} al {{ $categorias->lastItem() ?? 0 }} de un total de {{ $categorias->total() }}
        </div>
        <div class="flex enlaces-paginacion">
            {{ $categorias->links() }}
        </div>
    </div>
