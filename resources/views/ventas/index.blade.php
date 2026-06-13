@extends('layouts.admin')

@section('titulo', 'Gestión de Ventas')

@section('contenido')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-white">Listado de Ventas</h1>
    </div>

    <div class="mb-8 flex flex-wrap items-end gap-4 bg-[#121212]/60 p-4 rounded-xl border border-gray-800/60">
        
        <div class="flex-1 min-w-[200px]">
            <label for="codigo" class="block text-xs uppercase text-gray-500 font-bold tracking-wider mb-2">
                Buscar por Código
            </label>
            <input type="text" id="codigo" value="{{ request('codigo') }}" placeholder="Ej: FAC-XXXXXX"
                   class="w-full bg-black/40 border border-gray-800 rounded-lg px-3 py-1.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-[#25a5be]/50 transition-colors">
        </div>

        <div class="min-w-[180px]">
            <label for="fecha" class="block text-xs uppercase text-gray-500 font-bold tracking-wider mb-2">
                Filtrar por Fecha
            </label>
            <input type="date" id="fecha" value="{{ request('fecha') }}"
                   class="w-full bg-black/40 border border-gray-800 rounded-lg px-3 py-1.5 text-sm text-white focus:outline-none focus:border-[#25a5be]/50 transition-colors scheme-dark cursor-pointer">
        </div>
        
    </div>

    <div id="tabla-ventas" class="bg-[#121212]/80 rounded-xl border border-gray-800 shadow-lg overflow-hidden">
        @include('ventas.partials.tabla')
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const codigoInput = document.getElementById('codigo');
    const fechaInput = document.getElementById('fecha');
    const tablaVentas = document.getElementById('tabla-ventas');

    function fetchVentas(url = null) {
        const codigo = codigoInput.value;
        const fecha = fechaInput.value;
        
        // Si no mandamos una URL exacta (ej: desde la paginación), armamos la URL base
        if (!url) {
            url = `{{ route('ventas.index') }}?codigo=${codigo}&fecha=${fecha}`;
        }

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            tablaVentas.innerHTML = html;
        })
        .catch(error => console.error('Error cargando las ventas:', error));
    }

    // Escuchamos cuando el usuario teclea o elige fecha
    codigoInput.addEventListener('keyup', () => fetchVentas());
    fechaInput.addEventListener('change', () => fetchVentas());

    // Event Delegation: Escuchamos los clics en los números de página de la tabla
    tablaVentas.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        // Si hicieron clic en un enlace de paginación
        if (link && link.href) {
            e.preventDefault(); 
            fetchVentas(link.href); 
        }
    });
});
</script>
@endsection