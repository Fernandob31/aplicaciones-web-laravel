@extends('layouts.admin')

@section('titulo', 'Categorías')

@section('contenido')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">Nueva Categoría</h1>
        <p class="text-gray-400 mt-1">Crea una nueva clasificación para el catálogo.</p>
    </div>

    <div class="bg-[#121212]/80 p-6 rounded-xl border border-gray-800 shadow-lg">
        <form action="/categorias" method="POST">
            @csrf
            <div class="mb-6">
                <label class="block text-gray-300 mb-2">Nombre <span class="text-red-500">*</span></label>
                <input type="text" name="nombre" class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#25a5be]" required>
            </div>
            
            <div class="mt-8 pt-6 border-t border-gray-800 flex gap-4">
                <button type="submit" class="px-6 py-3 bg-[#25a5be] hover:bg-[#1d8fa5] text-white rounded-lg transition shadow-lg">
                    Guardar Categoría
                </button>
                <a href="/categorias" class="px-6 py-3 border border-gray-700 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection