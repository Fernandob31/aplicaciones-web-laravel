@extends('layouts.admin')

@section('titulo', 'Ventas')

@section('contenido')
<div class="max-w-7xl mx-auto">
    
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-white"> Gestión de Ventas </h1>
            <p class="text-gray-400 mt-1"> Administra y audita el historial de facturación. </p>
        </div>
    </div>

    <div class="mb-6 flex flex-wrap items-end gap-4 bg-[#121212]/80 p-4 rounded-xl border border-gray-800 shadow-lg">
        <div class="flex-1 min-w-[200px]">
            <label for="codigo" class="block text-xs uppercase text-gray-500 font-bold tracking-wider mb-2">
                Buscar por Código
            </label>
            <input type="text" id="codigo" value="{{ request('codigo') }}" placeholder="Ej: FAC-XXXXXX"
                   class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-[#25a5be]/50 transition-colors">
        </div>

        <div class="min-w-[180px]">
            <label for="fecha" class="block text-xs uppercase text-gray-500 font-bold tracking-wider mb-2">
                Filtrar por Fecha
            </label>
            <input type="date" id="fecha" value="{{ request('fecha') }}"
                   class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#25a5be]/50 transition-colors scheme-dark cursor-pointer">
        </div>
    </div>

    <div class="bg-[#121212]/80 rounded-xl border border-gray-800 shadow-lg overflow-hidden relative">
        {{-- Spinner AJAX --}}
        <div id="loading-overlay" class="absolute inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center hidden z-20">
            <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-[#25a5be]"></div>
        </div>

        <div id="tabla-ventas">
            @include('ventas.partials.tabla')
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const codigoInput = document.getElementById('codigo');
    const fechaInput = document.getElementById('fecha');
    const tablaVentas = document.getElementById('tabla-ventas');
    const loading = document.getElementById('loading-overlay');

    function fetchVentas(url = null) {
        const codigo = codigoInput.value;
        const fecha = fechaInput.value;
        
        if (!url) {
            url = `{{ route('ventas.index') }}?codigo=${codigo}&fecha=${fecha}`;
        }

        loading.classList.remove('hidden');

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            tablaVentas.innerHTML = html;
            loading.classList.add('hidden');
        })
        .catch(error => {
            console.error('Error cargando las ventas:', error);
            loading.classList.add('hidden');
        });
    }

    codigoInput.addEventListener('keyup', () => fetchVentas());
    fechaInput.addEventListener('change', () => fetchVentas());

    tablaVentas.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        if (link && link.href && link.href.includes('page=')) {
            e.preventDefault(); 
            fetchVentas(link.href); 
        }
    });
});
</script>
@endsection