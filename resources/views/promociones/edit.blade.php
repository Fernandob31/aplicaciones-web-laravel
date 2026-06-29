@extends('layouts.admin')

@section('titulo', 'Promociones')

@section('contenido')

<div class="max-w-5xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white"> Editar Promoción </h1>
        <p class="text-gray-400 mt-1"> Configura una nueva promoción para los productos seleccionados. </p>
    </div>

    <form action="/promociones/{{ $promocion->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="bg-[#121212]/80 rounded-xl border border-gray-800 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Tipo --}}
                <div>
                    <label class="block mb-2 text-gray-300">
                        Tipo de Promoción <span class="text-red-500">*</span>
                    </label>
                    <select name="tipo" id="tipo" disabled class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white">
                        <option value="categoria" {{ $promocion->tipo == 'categoria' ? 'selected' : '' }}>
                            Categoría 
                        </option>
                        <option value="marca" {{ $promocion->tipo == 'marca' ? 'selected' : '' }}>
                            Marca 
                        </option>
                        <option value="personalizada" {{ $promocion->tipo == 'personalizada' ? 'selected' : '' }}>
                            Personalizada
                        </option>
                    </select>
                </div>
                
                {{-- Nombre --}}
                <div>
                    <label class="block mb-2 text-gray-300">
                        Nombre de la Promoción <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nombre" value="{{ old('nombre', $promocion->nombre) }}" disabled class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white">
                </div>
                {{-- Descuento --}}
                <div>
                    <label class="block mb-2 text-gray-300">
                        Descuento (%) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" min="1" max="99" name="descuento" value="{{ old('descuento', $promocion->descuento) }}" disabled 
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white" >
                </div>
                {{-- Fecha Inicio --}}
                <div>
                    <label class="block mb-2 text-gray-300">
                        Fecha Inicio <span class="text-red-500">*</span>
                    </label>

                    <input type="date" value="{{ $promocion->fecha_inicio }}" disabled
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                    >
                </div>
                {{-- Fecha fin --}}
                <div>
                    <label class="block mb-2 text-gray-300">
                        Fecha Fin <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="fecha_fin" value="{{ old('fecha_fin', $promocion->fecha_fin) }}"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white">
                    @error('fecha_fin')
                        <p class="mt-2 text-sm text-red-500"> {{ $message }} </p>
                    @enderror
                </div>
                {{-- Estado --}}
                <div>
                    <label class="block mb-2 text-gray-300"> 
                        Estado
                    </label>

                    <input type="text" value="{{ ucfirst($promocion->estado) }}" disabled
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                    >
                </div>
                <div class="mt-10 mb-6">
                    <h2 class="text-xl font-bold text-white"> Productos Afectados </h2>
                    <div class="max-h-96 overflow-y-auto border border-gray-700 rounded-lg">
                        <table class="w-full text-sm">
                            <thead class="bg-[#1a1a1a] text-gray-300">
                                <tr>
                                    <th class="p-3">ID</th>
                                    <th class="p-3">Marca</th>
                                    <th class="p-3">Modelo</th>
                                    <th class="p-3">Precio</th>
                                </tr>
                            </thead>
                            <tbody id="tabla-productos-body">
                                @foreach($promocion->productos as $producto)
                                    <tr class="fila-producto border-t border-gray-800">
                                        <td class="p-3"> {{ $producto->id }} </td>
                                        <td class="p-3"> {{ $producto->marca }} </td>
                                        <td class="p-3"> {{ $producto->modelo }} </td>
                                        <td class="p-3"> ${{ number_format($producto->precio, 0, ',', '.') }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-800 flex gap-4">
                <button type="submit" class="px-6 py-3 bg-[#25a5be] hover:bg-[#1d8fa5] text-white rounded-lg transition">
                    Guardar Promoción
                </button>
                <a href="/promociones" class="px-6 py-3 border border-gray-700 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">
                    Cancelar
                </a>
            </div>
        </div>
    </form>
</div>


@endsection