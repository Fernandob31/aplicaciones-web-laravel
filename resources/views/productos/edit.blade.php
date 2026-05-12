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
            enctype="multipart/form-data"
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
                        value="{{ is_array($producto->colores) ? implode(',', $producto->colores) : $producto->colores }}"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                    >
                </div>    
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8 p-6 bg-black/20 rounded-xl border border-gray-800">
                
                <div class="space-y-4">
                    <label class="text-gray-400 text-xs uppercase tracking-widest font-bold">Imagen de Portada Actual</label>
                    
                    <div class="relative aspect-video rounded-xl overflow-hidden border border-gray-800 bg-black/40">
                        @if($producto->imagen)
                            <img src="{{ $producto->imagen }}" class="w-full h-full object-contain">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-600 italic">Sin portada</div>
                        @endif
                    </div>

                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-700 rounded-2xl cursor-pointer bg-[#121212] hover:border-[#25a5be]/50 hover:bg-[#25a5be]/5 transition-all">
                        <div class="flex flex-col items-center justify-center">
                            <p class="text-sm text-gray-400 font-bold">Reemplazar Portada</p>
                            <p class="text-[10px] text-gray-500 uppercase">Click para cambiar imagen</p>
                        </div>
                        <input type="file" name="imagen_principal" class="hidden" accept="image/*" />
                    </label>
                </div>

                <div class="space-y-4">
                    <label class="text-gray-400 text-xs uppercase tracking-widest font-bold">Fotos en Galería</label>
                    
                    <div class="grid grid-cols-4 gap-2 overflow-y-auto max-h-32 p-2 bg-black/20 rounded-lg">
                        @foreach($producto->imagenes as $foto)
                            <div class="aspect-square rounded-lg overflow-hidden border border-gray-800">
                                <img src="{{ $foto->url_imagen }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                        @if($producto->imagenes->count() == 0)
                            <div class="col-span-4 text-center text-gray-600 text-xs py-4">No hay fotos adicionales</div>
                        @endif
                    </div>

                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-700 rounded-2xl cursor-pointer bg-[#121212] hover:border-[#25a5be]/50 hover:bg-[#25a5be]/5 transition-all">
                        <div class="flex flex-col items-center justify-center">
                            <p class="text-sm text-gray-400 font-bold">Añadir a la Galería</p>
                            <p class="text-[10px] text-gray-500 uppercase">Selecciona nuevas fotos</p>
                        </div>
                        <input type="file" name="galeria[]" class="hidden" multiple accept="image/*" />
                    </label>
                </div>
            </div>
            <div class="mt-8">

                <label class="block mb-2 text-gray-300">
                    Descripción
                </label>

                <textarea 
                    name="descripcion"
                    rows="4"
                    class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                >{{ $producto->descripcion }}</textarea>

            </div>

            <div class="space-y-4 mt-6">

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

            <div class="mt-8 flex gap-4">

                <button 
                    type="submit"
                    class="px-6 py-3 bg-[#25a5be] hover:bg-[#1d8fa5] text-white rounded-lg transition"
                >
                    Actualizar Producto
                </button>
                
                <a href="{{ url('/productos') }}" class="px-6 py-3 border border-gray-700 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">
                    Cancelar
                </a>

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