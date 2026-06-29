@extends('layouts.admin')

@section('titulo', 'Promociones')

@section('contenido')
<div class="max-w-7xl mx-auto">
    
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-white">{{ $promocion->nombre }}</h1>
        <a href="/promociones" class="px-4 py-2 bg-[#1a1a1a] hover:bg-gray-800 text-gray-300 hover:text-white border border-gray-700 rounded-lg transition-all text-sm font-semibold flex items-center gap-2 shadow-sm">
            &larr; Volver al listado
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
        <div class="bg-[#121212]/80 border border-gray-800 rounded-xl p-4">
            <p class="text-gray-400 text-sm">Tipo</p>
            <p class="text-white font-semibold"> {{ ucfirst($promocion->tipo) }} </p>
        </div>
        <div class="bg-[#121212]/80 border border-gray-800 rounded-xl p-4">
            <p class="text-gray-400 text-sm">Descuento</p>
            <p class="text-red-400 font-semibold"> {{ $promocion->descuento }}% </p>
        </div>
        <div class="bg-[#121212]/80 border border-gray-800 rounded-xl p-4">
            <p class="text-gray-400 text-sm">Estado</p>
            <p class="text-green-400 font-semibold"> {{ ucfirst($promocion->estado) }} </p>
        </div>
        <div class="bg-[#121212]/80 border border-gray-800 rounded-xl p-4">
            <p class="text-gray-400 text-sm">Fecha Inicio</p>
            <p class="text-white"> {{ \Carbon\Carbon::parse($promocion->fecha_inicio)->format('d/m/Y') }} </p>
        </div>
        <div class="bg-[#121212]/80 border border-gray-800 rounded-xl p-4">
            <p class="text-gray-400 text-sm">Fecha Fin</p>
            <p class="text-white"> {{ \Carbon\Carbon::parse($promocion->fecha_fin)->format('d/m/Y') }} </p>
        </div>
    </div>

    <div class="bg-[#121212]/80 border border-gray-800 rounded-xl overflow-hidden">
        <div class="p-6 border-b border-gray-800">
            <h2 class="text-xl font-bold text-white"> Productos afectados </h2>
            <p class="text-gray-400 text-sm mt-1"> Total: {{ $promocion->productos->count() }} productos </p>
        </div>
        <table class="w-full text-sm">
            <thead class="bg-[#1a1a1a] text-gray-300">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Marca</th>
                    <th class="p-3 text-left">Modelo</th>
                    <th class="p-3 text-left">Precio Original</th>
                    <th class="p-3 text-left">Precio Final</th>
                </tr>
            </thead>
            <tbody>
                @foreach($promocion->productos as $producto)
                    <tr class="border-t border-gray-800">
                        <td class="p-3"> {{ $producto->id }} </td>
                        <td class="p-3"> {{ $producto->marca }} </td>
                        <td class="p-3"> {{ $producto->modelo }} </td>
                        <td class="p-3"> ${{ number_format($producto->precio, 0, ',', '.') }} </td>
                        <td class="p-3 text-[#25a5be] font-semibold"> 
                            ${{ number_format($producto->precio - ($producto->precio * $promocion->descuento / 100),0,',','.')}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($promocion->estado == 'activa')
        <div class="mt-8 flex gap-4">
            <a href="/promociones/{{ $promocion->id }}/edit" class="flex-1 bg-[#25a5be] hover:bg-[#1d8fa6] text-black font-bold py-4 rounded-xl text-center shadow-[0_0_20px_rgba(37,165,190,0.2)] transition-all">
                Editar Promoción
            </a>
        </div>
    @endif
</div>
@endsection

@if(session('success') || session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#1a1a1a',
                color: '#ffffff',
                iconColor: '{{ session("error") ? "#f41e1e" : "#25a5be" }}',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: '{{ session("error") ? "error" : "success" }}',
                title: '{{ session("error") ?? session("success") }}'
            });
        });
    </script>
@endif