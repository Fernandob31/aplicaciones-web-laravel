<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="border-b border-gray-800 bg-black/20 text-gray-400 text-xs uppercase tracking-wider font-bold">
            <tr>
                <th class="px-6 py-4">ID</th>
                <th class="px-6 py-4">Usuario</th>
                <th class="px-6 py-4">Rol</th>
                <th class="px-6 py-4 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-800 text-gray-300 text-sm">
            @forelse($usuarios as $usuario)
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-3 text-gray-400">{{ $usuario->id }}</td>
                    <td class="px-6 py-3 font-medium text-white">{{ $usuario->username }}</td>
                    <td class="px-6 py-3">{{ $usuario->rol_nombre }}</td>
                    <td class="px-6 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <a href="/usuarios/{{ $usuario->id }}/edit" 
                               class="inline-flex items-center justify-center px-3 py-1 text-xs font-bold bg-yellow-500/10 text-yellow-400 rounded border border-yellow-500/30 hover:bg-yellow-500/20 transition-colors whitespace-nowrap">
                                Editar
                            </a>
                            @if(auth()->id() !== $usuario->id)
                                <form action="/usuarios/{{ $usuario->id }}" method="POST" class="form-eliminar flex m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center justify-center px-3 py-1 text-xs font-bold bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white rounded border border-red-500/30 transition-colors whitespace-nowrap">
                                        Eliminar
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500 italic">
                        No se encontraron usuarios.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


    <div id="pagination-container" class="bg-[#1a1a1a] p-4 border-t border-gray-800 flex justify-between items-center text-sm text-gray-400">
        <div>
            Mostrando registros del {{ $usuarios->firstItem() ?? 0 }} al {{ $usuarios->lastItem() ?? 0 }} de un total de {{ $usuarios->total() }}
        </div>
        <div class="flex enlaces-paginacion">
            {{ $usuarios->links() }}
        </div>
    </div>
