@extends('layouts.admin')

@section('titulo', 'Usuarios')

@section('contenido')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-white">Gestión de Usuarios</h2>

    <a href="/usuarios/create"
       class="px-4 py-2 bg-[#25a5be] text-white rounded-lg hover:bg-[#1e8ca0]">
        Nuevo Usuario
    </a>
</div>

@if(session('success'))
    <div class="mb-4 p-4 bg-green-500/20 border border-green-500 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="bg-[#121212]/80 rounded-lg border border-gray-800 overflow-hidden">

    <table class="w-full">

        <thead class="bg-[#1a1a1a]">
            <tr>
                <th class="p-4 text-left">ID</th>
                <th class="p-4 text-left">Usuario</th>
                <th class="p-4 text-left">Rol</th>
                <th class="p-4 text-left">Acciones</th>
            </tr>
        </thead>

        <tbody>

            @foreach($usuarios as $usuario)

                <tr class="border-t border-gray-800">

                    <td class="p-4">
                        {{ $usuario->id }}
                    </td>

                    <td class="p-4">
                        {{ $usuario->username }}
                    </td>

                    <td class="p-4">
                        {{ $usuario->rol_nombre }}
                    </td>

                    <td class="p-4 flex gap-2">

                        <a href="/usuarios/{{ $usuario->id }}/edit"
                           class="px-3 py-1 bg-yellow-500 rounded">
                            Editar
                        </a>

                        <form action="/usuarios/{{ $usuario->id }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                class="px-3 py-1 bg-red-600 rounded">
                                Eliminar
                            </button>

                        </form>

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection