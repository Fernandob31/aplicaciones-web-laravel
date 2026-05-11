@extends('layouts.admin')

@section('titulo', 'Crear Producto')

@section('contenido')

<div class="max-w-4xl">

    <h1 class="text-3xl font-bold text-white mb-6">
        Nuevo Producto
    </h1>

    <div class="bg-[#121212]/80 p-6 rounded-lg border border-gray-800 shadow-lg">

        <form action="/productos" method="POST">

            @csrf

            <div class="grid grid-cols-2 gap-6">

                <div>
                    <label class="block mb-2 text-gray-300">
                        Modelo
                    </label>

                    <input 
                        type="text"
                        name="modelo"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                    >
                </div>

                <div>
                    <label class="block mb-2 text-gray-300">
                        Marca
                    </label>

                    <input 
                        type="text"
                        name="marca"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                    >
                </div>

                <div>
                    <label class="block mb-2 text-gray-300">
                        Categoría
                    </label>

                    <select 
                        name="categoria_id"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                    >

                        @foreach($categorias as $categoria)

                            <option value="{{ $categoria->id }}">
                                {{ $categoria->nombre }}
                            </option>

                        @endforeach

                    </select>
                </div>

                <div>
                    <label class="block mb-2 text-gray-300">
                        Género
                    </label>

                    <select 
                        name="genero"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                    >
                        <option value="Hombre">Hombre</option>
                        <option value="Mujer">Mujer</option>
                        <option value="Unisex">Unisex</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-2 text-gray-300">
                        Precio
                    </label>

                    <input 
                        type="number"
                        step="0.01"
                        name="precio"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                    >
                </div>
                <div>
                    <label class="block mb-2 text-gray-300"> Colores </label>
                    <input 
                        type="text"
                        name="colores"
                        placeholder="#000000,#FFFFFF"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                    >
                    <p class="text-sm text-gray-500 mt-1">
                        Separar colores por coma.
                    </p>
                </div>

            </div>

            <div class="mt-6">

                <label class="block mb-2 text-gray-300">
                    Descripción
                </label>

                <textarea 
                    name="descripcion"
                    rows="4"
                    class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                ></textarea>

            </div>

            <div class="space-y-4">

                <label class="block text-gray-300">
                    Talles y Stock
                </label>

                <div id="contenedor-talles">

                    <div class="flex gap-4 mb-4">

                        <input
                            type="text"
                            name="talles[]"
                            placeholder="Talle"
                            class="w-1/2 bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                        >

                        <input
                            type="number"
                            name="stocks[]"
                            placeholder="Stock"
                            class="w-1/2 bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                        >

                    </div>

                </div>

                <button
                    type="button"
                    onclick="agregarTalle()"
                    class="px-4 py-2 bg-[#25a5be]/10 text-[#25a5be] rounded border border-[#25a5be]/30"
                >
                    + Agregar talle
                </button>

            </div>
            <div class="mt-8">
                <button 
                    type="submit"
                    class="px-6 py-3 bg-[#25a5be] hover:bg-[#1d8fa5] text-white rounded-lg transition"
                >
                    Guardar Producto
                </button>
            </div>
        </form>
    </div>
</div>

<script>

function agregarTalle() {

    let html = `

        <div class="flex gap-4 mb-4">

            <input
                type="text"
                name="talles[]"
                placeholder="Talle"
                class="w-1/2 bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
            >

            <input
                type="number"
                name="stocks[]"
                placeholder="Stock"
                class="w-1/2 bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
            >

        </div>
    `;

    document
        .getElementById('contenedor-talles')
        .insertAdjacentHTML('beforeend', html);
}

</script>

@endsection