@extends('layouts.admin')

@section('titulo', 'Categorías')

@section('contenido')

<div class="flex items-center justify-between mb-6">

    <div>
        <h1 class="text-3xl font-bold text-white">
            Gestión de Categorías
        </h1>

        <p class="text-gray-400 mt-1">
            Administra las categorías de productos de la tienda.
        </p>
    </div>

    <a 
        href="/categorias/create"
        class="px-5 py-2 bg-[#25a5be] hover:bg-[#1d8fa5] text-white rounded-lg transition shadow-lg"
    >
        + Nueva Categoría
    </a>

</div>

<div class="bg-[#121212]/80 rounded-lg border border-gray-800 shadow-lg overflow-hidden">

    <table class="w-full text-left">

        <thead class="bg-[#1a1a1a] border-b border-gray-700">
            <tr>
                <th class="p-4 text-gray-300">ID</th>
                <th class="p-4 text-gray-300">Nombre</th>
                <th class="p-4 text-gray-300">Acciones</th>
            </tr>
        </thead>

        <tbody>

            @forelse($categorias as $categoria)

                <tr class="border-b border-gray-800 hover:bg-[#1a1a1a]/50 transition">

                    <td class="p-4 text-gray-400">
                        {{ $categoria->id }}
                    </td>

                    <td class="p-4 text-white font-medium">
                        {{ $categoria->nombre }}
                    </td>

                    <td class="p-4 flex gap-2">

                        <a 
                            href="/categorias/{{ $categoria->id }}/edit"
                            class="px-3 py-1 bg-yellow-500/10 text-yellow-400 rounded border border-yellow-500/30 hover:bg-yellow-500/20 transition"
                        >
                            Editar
                        </a>

                        <form 
                            action="/categorias/{{ $categoria->id }}"
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')

                            <button 
                                type="submit"
                                class="px-3 py-1 bg-red-500/10 text-red-400 rounded border border-red-500/30 hover:bg-red-500/20 transition"
                            >
                                Eliminar
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="3" class="p-6 text-center text-gray-500">
                        No hay categorías registradas.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection