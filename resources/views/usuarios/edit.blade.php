@extends('layouts.admin')

@section('titulo', 'Usuarios')

@section('contenido')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">Editar Usuario</h1>
        <p class="text-gray-400 mt-1">Modifica los permisos o contraseña de este usuario.</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-500/20 border border-red-500/50 rounded-lg text-red-200">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-[#121212]/80 p-6 rounded-xl border border-gray-800 shadow-lg">
        <form method="POST" action="/usuarios/{{ $usuario->id }}">
            @csrf
            @method('PUT')
            
            <div class="mb-5">
                <label class="block text-gray-300 mb-2">Usuario <span class="text-red-500">*</span></label>
                <input type="text" name="username" value="{{ $usuario->username }}" required class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#25a5be]">
            </div>

            <div class="mb-5">
                <label class="block text-gray-300 mb-2">Nueva Contraseña <span class="text-gray-500 text-sm">(opcional)</span></label>
                <input type="password" name="password" class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#25a5be]">
            </div>

            <div class="mb-6">
                <label class="block text-gray-300 mb-2">Rol <span class="text-red-500">*</span></label>
                <select name="rol" required class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#25a5be]">
                    <option value="admin" {{ $usuario->rol == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="gestor_productos" {{ $usuario->rol == 'gestor_productos' ? 'selected' : '' }}>Gestor Productos</option>
                    <option value="gestor_stock" {{ $usuario->rol == 'gestor_stock' ? 'selected' : '' }}>Gestor Stock</option>
                </select>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-800 flex gap-4">
                <button type="submit" class="px-6 py-3 bg-[#25a5be] hover:bg-[#1d8fa5] text-white rounded-lg transition shadow-lg">
                    Guardar Cambios
                </button>
                <a href="/usuarios" class="px-6 py-3 border border-gray-700 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection