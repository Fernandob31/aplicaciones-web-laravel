@extends('layouts.admin')

@section('titulo', 'Editar Producto')

@section('contenido')

<div class="max-w-4xl">

    <h1 class="text-3xl font-bold text-white mb-6">
        Editar Producto
    </h1>

    <div class="bg-[#121212]/80 p-6 rounded-lg border border-gray-800 shadow-lg">

        <form 
            action="/productos/{{ $producto->id }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-6">

                <div>

                    <label class="block mb-2 text-gray-300">
                        Modelo
                    </label>

                    <input 
                        type="text"
                        name="modelo"
                        value="{{ $producto->modelo }}"
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
                        value="{{ $producto->marca }}"
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

                            <option 
                                value="{{ $categoria->id }}"
                                {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}
                            >
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

                        <option 
                            value="Hombre"
                            {{ $producto->genero == 'Hombre' ? 'selected' : '' }}
                        >
                            Hombre
                        </option>

                        <option 
                            value="Mujer"
                            {{ $producto->genero == 'Mujer' ? 'selected' : '' }}
                        >
                            Mujer
                        </option>

                        <option 
                            value="Unisex"
                            {{ $producto->genero == 'Unisex' ? 'selected' : '' }}
                        >
                            Unisex
                        </option>

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
                        value="{{ $producto->precio }}"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                    >

                </div>
                <div>
                    <label class="block mb-2 text-gray-300">
                        Colores
                    </label>
                    <input 
                        type="text"
                        name="colores"
                        value="{{ implode(',', $producto->colores) }}"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                    >
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
                >{{ $producto->descripcion }}</textarea>

            </div>

            <div class="space-y-4">

                <label class="block text-gray-300">
                    Talles y Stock
                </label>

                <div id="contenedor-talles">

                    @foreach($producto->talles as $talle)

                        <div class="flex gap-4 mb-4">

                            <input
                                type="text"
                                name="talles[]"
                                value="{{ $talle->talle }}"
                                class="w-1/2 bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                            >

                            <input
                                type="number"
                                name="stocks[]"
                                value="{{ $talle->stock }}"
                                class="w-1/2 bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                            >

                        </div>

                    @endforeach

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
                    Actualizar Producto
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