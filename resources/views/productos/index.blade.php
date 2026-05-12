@extends('layouts.admin')

@section('titulo', 'Productos')

@section('contenido')

<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-3xl font-bold text-white">
            Gestión de Productos
        </h1>
        <p class="text-gray-400 mt-1">
            Administra el catálogo de zapatillas.
        </p>
    </div>
    <a 
        href="/productos/create"
        class="px-5 py-2 bg-[#25a5be] hover:bg-[#1d8fa5] text-white rounded-lg transition shadow-lg"
    >
        + Nuevo Producto
    </a>
</div>

<div class="bg-[#121212]/80 rounded-lg border border-gray-800 shadow-lg overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-[#1a1a1a] border-b border-gray-700">
            <tr>
                <th class="p-4 text-gray-300">
                    ID
                </th>
                <th class="p-4 text-gray-300">
                    Modelo
                </th>
                <th class="p-4 text-gray-300">
                    Marca
                </th>
                <th class="p-4 text-gray-300">
                    Categoría
                </th>
                <th class="p-4 text-gray-300">
                    Precio
                </th>
                <th class="p-4 text-gray-300">
                    Stock Total
                </th>
                <th class="p-4 text-gray-300">
                    Género
                </th>
                <th class="p-4 text-gray-300">
                    Acciones
                </th>
            </tr>

        </thead>

        <tbody>
            @forelse($productos as $producto)
                <tr class="border-b border-gray-800 hover:bg-[#1a1a1a]/50 transition">
                    <td class="p-4 text-gray-400">
                        {{ $producto->id }}
                    </td>
                    <td class="p-4 text-white font-medium">
                        {{ $producto->modelo }}
                    </td>
                    <td class="p-4 text-gray-300">
                        {{ $producto->marca }}
                    </td>
                    <td class="p-4 text-gray-300">
                        {{ $producto->categoria->nombre }}
                    </td>
                    <td class="p-4 text-[#25a5be] font-semibold">
                        $ {{ number_format($producto->precio, 0, ',', '.') }}
                    </td>
                    <td class="p-4 text-gray-300">
                        {{ $producto->talles->sum('stock') }}
                    </td>
                    <td class="p-4 text-gray-300">
                        {{ $producto->genero }}
                    </td>
                    <td class="p-4 flex gap-2">
                        <a 
                            href="/productos/{{ $producto->id }}/edit"
                            class="px-3 py-1 bg-yellow-500/10 text-yellow-400 rounded border border-yellow-500/30 hover:bg-yellow-500/20 transition">
                            Editar
                        </a>
                        <form action="/productos/{{ $producto->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit"
                                class="px-3 py-1 bg-red-500/10 text-red-400 rounded border border-red-500/30 hover:bg-red-500/20 transition"
                            >
                                Eliminar
                            </button>
                        </form>
                        <a 
                            href="/productos/{{ $producto->id }}"
                            class="px-3 py-1 bg-[#25a5be]/10 text-[#25a5be] rounded border border-[#25a5be]/30 hover:bg-[#25a5be]/20 transition"
                        >
                            Ver Detalles
                        </a>
                    </td>
                </tr>

            @empty

                <tr>

                    <td colspan="7" class="p-6 text-center text-gray-500">

                        No hay productos registrados.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection