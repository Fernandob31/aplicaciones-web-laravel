@extends('layouts.admin')

@section('titulo', 'Crear Categoría')

@section('contenido')

<div class="max-w-xl">

    <h1 class="text-3xl font-bold text-white mb-6">
        Nueva Categoría
    </h1>

    <div class="bg-[#121212]/80 p-6 rounded-lg border border-gray-800 shadow-lg">

        <form action="/categorias" method="POST">

            @csrf

            <div class="mb-5">

                <label class="block text-gray-300 mb-2">
                    Nombre
                </label>

                <input 
                    type="text"
                    name="nombre"
                    class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#25a5be]"
                >

            </div>

            <button 
                type="submit"
                class="px-5 py-2 bg-[#25a5be] hover:bg-[#1d8fa5] text-white rounded-lg transition shadow-lg"
            >
                Guardar Categoría
            </button>

        </form>

    </div>

</div>

@endsection