<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="border-b border-gray-800 bg-black/20 text-gray-400 text-xs uppercase tracking-wider font-bold">
            <tr>
                <th class="px-6 py-4">ID</th>
                <th class="px-6 py-4">Modelo</th>
                <th class="px-6 py-4">Marca</th>
                <th class="px-6 py-4">Categoría</th>
                <th class="px-6 py-4">Precio</th>
                <th class="px-6 py-4 text-center">Stock</th>
                <th class="px-6 py-4 text-center">Género</th>
                <th class="px-6 py-4 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-800 text-gray-300 text-sm">
            @forelse($productos as $producto)
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-3 text-gray-400">{{ $producto->id }}</td>
                    <td class="px-6 py-3 text-white font-medium">{{ $producto->modelo }}</td>
                    <td class="px-6 py-3">{{ $producto->marca }}</td>
                    <td class="px-6 py-3">{{ $producto->categoria->nombre }}</td>
                    <td class="px-6 py-3">
                        @if($producto->tiene_descuento)
                            <div class="flex flex-col">
                                <div class="flex items-center gap-1.5">
                                    <span class="text-xs text-gray-500 line-through whitespace-nowrap">
                                        $ {{ number_format($producto->precio, 0, ',', '.') }}
                                    </span>
                                    <span class="text-xs font-bold text-red-500 whitespace-nowrap">
                                        (-{{ $producto->descuento }}%)
                                    </span>
                                </div>
                                <span class="text-[#25a5be] font-semibold whitespace-nowrap mt-0.5">
                                    $ {{ number_format($producto->precio_final, 0, ',', '.') }}
                                </span>
                            </div>
                        @else
                            <span class="text-[#25a5be] font-semibold whitespace-nowrap">
                                $ {{ number_format($producto->precio, 0, ',', '.') }}
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-3 text-center">{{ $producto->talles->sum('stock') }}</td>
                    <td class="px-6 py-3 text-center capitalize">{{ $producto->genero }}</td>
                    <td class="px-6 py-3">
                        <div class="flex items-center justify-center gap-2">
                            
                            <a href="/productos/{{ $producto->id }}" 
                            class="inline-flex items-center justify-center px-3 py-1 text-xs font-bold bg-[#25a5be]/10 text-[#25a5be] rounded border border-[#25a5be]/30 hover:bg-[#25a5be]/20 transition-colors whitespace-nowrap">
                                Ver Detalles
                            </a>
                            
                            <a href="/productos/{{ $producto->id }}/edit" 
                            class="inline-flex items-center justify-center px-3 py-1 text-xs font-bold bg-yellow-500/10 text-yellow-400 rounded border border-yellow-500/30 hover:bg-yellow-500/20 transition-colors whitespace-nowrap">
                                Editar
                            </a>
                            
                            @if(auth()->user()->rol != 'gestor_stock')
                                <form action="/productos/{{ $producto->id }}" method="POST" class="form-eliminar flex m-0">
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
                    <td colspan="8" class="px-6 py-8 text-center text-gray-500 italic">No hay productos registrados con esos filtros.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

    <div id="pagination-container" class="bg-[#1a1a1a] p-4 border-t border-gray-800 flex justify-between items-center text-sm text-gray-400">
        <div>
            Mostrando registros del {{ $productos->firstItem() ?? 0 }} al {{ $productos->lastItem() ?? 0 }} de un total de {{ $productos->total() }}
        </div>
        <div class="flex enlaces-paginacion">
            {{ $productos->links() }}
        </div>
    </div>