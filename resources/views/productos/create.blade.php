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
                        Modelo <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text"
                        name="modelo"
                        value="{{ old('modelo') }}"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white @error('modelo') border-red-500 @enderror"
                    >
                    @error('modelo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 text-gray-300">
                        Marca <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text"
                        name="marca"
                        value="{{ old('marca') }}"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white @error('marca') border-red-500 @enderror"
                    >
                    @error('marca')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 text-gray-300">
                        Categoría <span class="text-red-500">*</span>
                    </label>
                    <select 
                        name="categoria_id"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white @error('categoria_id') border-red-500 @enderror"
                    >
                        <option value="">Seleccione una categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 text-gray-300">
                        Género <span class="text-red-500">*</span>
                    </label>
                    <select 
                        name="genero"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white @error('genero') border-red-500 @enderror"
                    >
                        <option value="Hombre" {{ old('genero') == 'Hombre' ? 'selected' : '' }}>Hombre</option>
                        <option value="Mujer" {{ old('genero') == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                        <option value="Unisex" {{ old('genero') == 'Unisex' ? 'selected' : '' }}>Unisex</option>
                    </select>
                    @error('genero')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 text-gray-300">
                        Precio <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="number"
                        step="0.01"
                        name="precio"
                        value="{{ old('precio') }}"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white @error('precio') border-red-500 @enderror"
                    >
                    @error('precio')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 text-gray-300"> 
                        Colores <span class="text-red-500">*</span> 
                    </label>
                    <input 
                        type="text"
                        name="colores"
                        value="{{ old('colores') }}"
                        placeholder="#000000,#FFFFFF"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white @error('colores') border-red-500 @enderror"
                    >
                    <p class="text-sm text-gray-500 mt-1">Separar colores por coma.</p>
                    @error('colores')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="mt-6">
                <label class="block mb-2 text-gray-300">
                    Descripción <span class="text-red-500">*</span>
                </label>
                <textarea 
                    name="descripcion"
                    rows="4"
                    class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white @error('descripcion') border-red-500 @enderror"
                >{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8 p-6 bg-black/20 rounded-xl border border-gray-800">
    
            {{-- PORTADA / IMAGEN PRINCIPAL --}}
            <div class="space-y-4">
                <label class="text-gray-400 text-xs uppercase tracking-widest font-bold">Imagen Principal <span class="text-red-500">*</span></label>
                
                <label id="dropzone-principal" class="relative flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-700 rounded-2xl cursor-pointer bg-[#121212] hover:border-[#25a5be]/50 hover:bg-[#25a5be]/5 transition-all @error('imagen_principal') border-red-500 @enderror">
                    
                    {{-- Contenedor de Vista Previa (Oculto por defecto si no hay imagen previa de la BD) --}}
                    <div id="container-preview-principal" class="absolute inset-0 w-full h-full p-2 hidden">
                        <img id="preview-principal" src="" class="w-full h-full object-contain rounded-xl">
                        <div class="absolute bottom-3 right-3 bg-black/80 text-[#25a5be] text-xs px-2 py-1 rounded border border-[#25a5be]/30 backdrop-blur-sm font-semibold">
                            Cambiar imagen
                        </div>
                    </div>

                    {{-- Estado Vacío / Placeholder --}}
                    <div id="placeholder-principal" class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                        <svg class="w-10 h-10 mb-3 text-[#25a5be]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p class="mb-1 text-sm text-gray-400 font-bold">Subir portada</p>
                        <p class="text-xs text-gray-500 uppercase tracking-tighter">Click para examinar</p>
                    </div>

                    <input type="file" id="input-principal" name="imagen_principal" class="hidden" accept="image/*" />
                </label>
                @error('imagen_principal')
                    <p class="text-red-500 text-sm mt-1 text-center">{{ $message }}</p>
                @enderror
            </div>

            {{-- GALERÍA PROMOCIONAL --}}
            <div class="space-y-4">
                <label class="text-gray-400 text-xs uppercase tracking-widest font-bold">Galería Promocional</label>
                
                <label id="dropzone-galeria" class="relative flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-700 rounded-2xl cursor-pointer bg-[#121212] hover:border-[#25a5be]/50 hover:bg-[#25a5be]/5 transition-all @error('galeria.*') border-red-500 @enderror">
                    
                    {{-- Indicador de éxito dinámico --}}
                    <div id="status-galeria" class="absolute inset-0 flex flex-col items-center justify-center bg-[#25a5be]/5 rounded-2xl border-2 border-solid border-[#25a5be] hidden">
                        <svg class="w-12 h-12 text-[#25a5be] mb-2 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p id="text-galeria-status" class="text-white font-bold text-sm"></p>
                        <p class="text-xs text-gray-400 mt-1">Haga click para reemplazar la selección</p>
                    </div>

                    {{-- Placeholder por defecto --}}
                    <div id="placeholder-galeria" class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                        <svg class="w-10 h-10 mb-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path></svg>
                        <p class="mb-1 text-sm text-gray-400 font-bold">Galería de Imágenes</p>
                        <p class="text-xs text-gray-500 uppercase tracking-tighter">Puedes seleccionar varias</p>
                    </div>

                    <input type="file" id="input-galeria" name="galeria[]" class="hidden" multiple accept="image/*" />
                </label>
                @error('galeria.*')
                    <p class="text-red-500 text-sm mt-1 text-center">{{ $message }}</p>
                @enderror
            </div>
        </div>

            <div class="space-y-4 mt-8">

                <label class="block text-gray-300">
                    Talles y Stock
                </label>

                @error('talles')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
                @error('stocks')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

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
            <div class="mt-10 border-t border-gray-800 pt-6 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-gray-400">
                    <span class="text-red-500 text-lg">*</span> Indica un campo obligatorio.
                </p>
                {{-- Contenedor que agrupa los botones --}}
                <div class="flex gap-4">
                    <button 
                        type="submit"
                        class="px-6 py-3 bg-[#25a5be] hover:bg-[#1d8fa5] text-white rounded-lg transition"
                    >
                        Guardar Producto
                    </button>
                    <a href="{{ url('/productos') }}" class="px-6 py-3 border border-gray-700 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">
                        Cancelar
                    </a>
                </div>
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
document.getElementById('input-principal').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const containerPreview = document.getElementById('container-preview-principal');
    const previewImg = document.getElementById('preview-principal');
    const placeholder = document.getElementById('placeholder-principal');
    const dropzone = document.getElementById('dropzone-principal');

    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(event) {
            previewImg.src = event.target.result;
            containerPreview.classList.remove('hidden');
            placeholder.classList.add('hidden');
            
            // Cambia el diseño del recuadro a un estado activo/exitoso
            dropzone.classList.remove('border-dashed', 'border-gray-700');
            dropzone.classList.add('border-solid', 'border-[#25a5be]');
        }
        
        reader.readAsDataURL(file);
    }
});

document.getElementById('input-galeria').addEventListener('change', function(e) {
    const files = e.target.files;
    const statusDiv = document.getElementById('status-galeria');
    const statusText = document.getElementById('text-galeria-status');
    const placeholder = document.getElementById('placeholder-galeria');

    if (files.length > 0) {
        // Muestra cuántos archivos seleccionó el usuario
        statusText.innerText = files.length === 1 
            ? '¡1 imagen lista para subir!' 
            : `¡${files.length} imágenes listas para subir!`;
            
        statusDiv.classList.remove('hidden');
        placeholder.classList.add('hidden');
    } else {
        statusDiv.classList.add('hidden');
        placeholder.classList.remove('hidden');
    }
});
</script>

@endsection