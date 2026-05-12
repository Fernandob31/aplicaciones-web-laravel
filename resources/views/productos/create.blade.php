@extends('layouts.admin')

@section('titulo', 'Crear Producto')

@section('contenido')

<div class="max-w-4xl">

    <h1 class="text-3xl font-bold text-white mb-6">
        Nuevo Producto
    </h1>

    <div class="bg-[#121212]/80 p-6 rounded-lg border border-gray-800 shadow-lg">

        <form action="/productos" method="POST" enctype="multipart/form-data">

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
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8 p-6 bg-black/20 rounded-xl border border-gray-800">
                <div class="space-y-4">
                    <label class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-700 rounded-2xl cursor-pointer bg-[#121212] hover:border-[#25a5be]/50 hover:bg-[#25a5be]/5 transition-all">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-10 h-10 mb-3 text-[#25a5be]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="mb-2 text-sm text-gray-400 font-bold">Imagen Principal</p>
                            <p class="text-xs text-gray-500 uppercase tracking-tighter">Click para subir portada</p>
                        </div>
                        <input type="file" name="imagen_principal" class="hidden" accept="image/*" required />
                    </label>
                </div>

                <div class="space-y-4">
                    <label class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-700 rounded-2xl cursor-pointer bg-[#121212] hover:border-[#25a5be]/50 hover:bg-[#25a5be]/5 transition-all">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-10 h-10 mb-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path></svg>
                            <p class="mb-2 text-sm text-gray-400 font-bold">Galería Promocional</p>
                            <p class="text-xs text-gray-500 uppercase tracking-tighter">Selecciona varias imágenes</p>
                        </div>
                        <input type="file" name="galeria[]" class="hidden" multiple accept="image/*" />
                    </label>
                </div>
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