<table class="w-full text-left">
    <thead class="bg-[#1a1a1a] border-b border-gray-700">
        <tr>
            <th class="p-4 text-gray-300">ID</th>
            <th class="p-4 text-gray-300">Modelo</th>
            <th class="p-4 text-gray-300">Marca</th>
            <th class="p-4 text-gray-300">Categoría</th>
            <th class="p-4 text-gray-300">Precio</th>
            <th class="p-4 text-gray-300">Stock Total</th>
            <th class="p-4 text-gray-300">Género</th>
            <th class="p-4 text-gray-300">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($productos as $producto)
            <tr class="border-b border-gray-800 hover:bg-[#1a1a1a]/50 transition">
                <td class="p-4 text-gray-400">{{ $producto->id }}</td>
                <td class="p-4 text-white font-medium">{{ $producto->modelo }}</td>
                <td class="p-4 text-gray-300">{{ $producto->marca }}</td>
                <td class="p-4 text-gray-300">{{ $producto->categoria->nombre }}</td>
                <td class="p-4 text-[#25a5be] font-semibold">$ {{ number_format($producto->precio, 0, ',', '.') }}</td>
                <td class="p-4 text-gray-300">{{ $producto->talles->sum('stock') }}</td>
                <td class="p-4 text-gray-300">{{ $producto->genero }}</td>
                <td class="p-4">
                <div class="flex items-center gap-2">
                    <a href="/productos/{{ $producto->id }}/edit" 
                    class="px-3 py-1.5 text-sm font-medium bg-yellow-500/10 text-yellow-400 rounded-lg border border-yellow-500/30 hover:bg-yellow-500/20 transition-colors flex items-center justify-center">
                        Editar
                    </a>
                    <form action="/productos/{{ $producto->id }}" method="POST" class="form-eliminar flex m-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-3 py-1.5 text-sm font-medium bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white rounded-lg border border-red-500/30 transition-colors flex items-center justify-center">
                            Eliminar
                        </button>
                    </form>
                    <a href="/productos/{{ $producto->id }}" 
                    class="px-3 py-1.5 text-sm font-medium bg-[#25a5be]/10 text-[#25a5be] rounded-lg border border-[#25a5be]/30 hover:bg-[#25a5be]/20 transition-colors flex items-center justify-center">
                        Ver Detalles
                    </a>
                </div>
            </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="p-6 text-center text-gray-500">No hay productos registrados con esos filtros.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Elemento de Paginación Asíncrona --}}
<div id="pagination-container" class="bg-[#1a1a1a] p-4 border-t border-gray-800 flex justify-between items-center text-sm text-gray-400">
    <div>
        Mostrando registros del {{ $productos->firstItem() ?? 0 }} al {{ $productos->lastItem() ?? 0 }} de un total de {{ $productos->total() }}
    </div>
    <div class="flex enlaces-paginacion">
        {{ $productos->links() }}
    </div>
</div>