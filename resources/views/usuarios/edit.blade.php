@extends('layouts.admin')

@section('titulo', 'Editar Usuario')

@section('contenido')

<div class="max-w-2xl">

    <form method="POST" action="/usuarios/{{ $usuario->id }}">

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="block mb-2">
                Usuario
            </label>

            <input
                type="text"
                name="username"
                value="{{ $usuario->username }}"
                required
                class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
            >

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Nueva Contraseña (opcional)
            </label>

            <input
                type="password"
                name="password"
                class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
            >

        </div>

        <div class="mb-6">

            <label class="block mb-2">
                Rol
            </label>

            <select
                name="rol"
                class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
            >

                <option value="admin"
                    {{ $usuario->rol == 'admin' ? 'selected' : '' }}>
                    Admin
                </option>

                <option value="gestor_productos"
                    {{ $usuario->rol == 'gestor_productos' ? 'selected' : '' }}>
                    Gestor Productos
                </option>

                <option value="gestor_stock"
                    {{ $usuario->rol == 'gestor_stock' ? 'selected' : '' }}>
                    Gestor Stock
                </option>

            </select>

        </div>

        <button
            type="submit"
            class="px-6 py-3 bg-[#25a5be] rounded-lg text-white"
        >
            Guardar Cambios
        </button>

    </form>

</div>

@endsection