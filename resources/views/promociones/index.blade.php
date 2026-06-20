@extends('layouts.admin')

@section('titulo', 'Promociones')

@section('contenido')

<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-3xl font-bold text-white"> Gestión de Promociones </h1>
        <p class="text-gray-400 mt-1"> Administra las promociones activas y vencidas. </p>
    </div>
    <a href="/promociones/create" class="px-5 py-2 bg-[#25a5be] hover:bg-[#1d8fa5] text-white rounded-lg transition shadow-lg">
        + Nueva Promoción
    </a>
</div>

<div class="bg-[#121212]/80 p-4 rounded-lg border border-gray-800 shadow-lg mb-6">
    <form id="form-filtros" action="{{ url('/promociones') }}" method="GET" class="flex flex-col md:flex-row gap-4">

        {{-- Buscador por texto --}}
        <div class="flex-1">
            <input 
                type="text" 
                id="input-buscar"
                name="buscar" 
                value="{{ request('buscar') }}" 
                placeholder="Buscar promoción..." 
                class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-2.5 text-white text-sm focus:border-[#25a5be] focus:ring-1 focus:ring-[#25a5be] transition-colors"
                autocomplete="off"
            >
        </div>

        {{-- Filtro por Estado --}}
        <div class="w-full md:w-48">
            <select id="select-estado" name="estado" class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-2.5 text-white text-sm focus:border-[#25a5be] focus:ring-1 focus:ring-[#25a5be]">
                <option value=""> Todos los estados </option>
                <option value="activa" {{ request('estado') == 'activa' ? 'selected' : '' }}> Activas </option>
                <option value="finalizada" {{ request('estado') == 'finalizada' ? 'selected' : '' }}> Finalizadas </option>
            </select>
        </div>

        {{-- Botones de Acción --}}
        <div class="flex gap-2">
            <a href="{{ url('/promociones') }}" id="btn-limpiar" class="px-4 py-2.5 bg-gray-800 hover:bg-gray-700 text-gray-300 text-sm font-semibold rounded-lg border border-gray-700 transition-colors flex items-center {{ request()->anyFilled(['buscar', 'estado']) ? '' : 'hidden' }}">
                Limpiar
            </a>
        </div>

    </form>
</div>

<div class="bg-[#121212]/80 rounded-lg border border-gray-800 shadow-lg overflow-hidden relative">
    
    {{-- Spinner de carga invisible por defecto --}}
    <div id="loading-overlay" class="absolute inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center hidden z-20">
        <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-[#25a5be]"></div>
    </div>

    <div id="tabla-renderizada">
        @include('promociones.partials.tabla')
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-filtros');
    const selectEstado = document.getElementById('select-estado');
    const inputBuscar = document.getElementById('input-buscar');
    const container = document.getElementById('tabla-renderizada');
    const btnLimpiar = document.getElementById('btn-limpiar');
    const loading = document.getElementById('loading-overlay');    
    
    // Variable para recordar en qué página exacta estamos
    let urlActual = window.location.href;

    // --- CONFIGURACIÓN DEL TOAST (Swal.mixin) ---
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        background: '#1a1a1a',
        color: '#ffffff',
        iconColor: '#25a5be',
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    function obtenerPromociones(url) {
        urlActual = url;
        loading.classList.remove('hidden');

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            container.innerHTML = html;
            loading.classList.add('hidden');
            inicializarEventosEliminar(); // Re-vincula los eventos a la nueva tabla
        })
        .catch(error => {
            console.error('Error:', error);
            loading.classList.add('hidden');
        });
    }

    function aplicarFiltros() {
        const formData = new FormData(form);
        const params = new URLSearchParams(formData).toString();
        const url = `${form.action}?${params}`;
        
        // Mostrar u ocultar el botón Limpiar
        if (inputBuscar.value || selectEstado.value) {
            btnLimpiar.classList.remove('hidden');
        } else {
            btnLimpiar.classList.add('hidden');
        }

        obtenerPromociones(url);
    }

    // Disparar cuando se cambie el select
    if (selectEstado) selectEstado.addEventListener('change', aplicarFiltros);

    // Disparar mientras se escribe (con un pequeño delay para no saturar el servidor)
    if (inputBuscar) {
        let temporizador;
        inputBuscar.addEventListener('input', function() {
            clearTimeout(temporizador);
            temporizador = setTimeout(aplicarFiltros, 400);
        });
    }

    // Paginación asíncrona (Event Delegation)
    container.addEventListener('click', function(e) {
        const enlacePaginacion = e.target.closest('.enlaces-paginacion a');
        if (enlacePaginacion) {
            e.preventDefault();
            obtenerPromociones(enlacePaginacion.href);
        }
    });

    // --- FUNCIÓN DE ELIMINACIÓN ASÍNCRONA ---
    function inicializarEventosEliminar() {
        const formularios = document.querySelectorAll('.form-eliminar');
        
        formularios.forEach(formulario => {
            formulario.addEventListener('submit', function (e) {
                e.preventDefault();
                
                const formEl = this;
                const urlEliminar = formEl.action;
                const token = formEl.querySelector('input[name="_token"]').value;

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción borrará la promoción de forma permanente.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#f41e1e',
                    cancelButtonColor: '#303640',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    background: '#121212',
                    color: '#ffffff'
                }).then((result) => {
                    if (result.isConfirmed) {
                        
                        loading.classList.remove('hidden');

                        fetch(urlEliminar, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': token,
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            Toast.fire({
                                icon: 'success',
                                title: data.message || 'Promoción eliminada'
                            });
                            obtenerPromociones(urlActual); 
                        })
                        .catch(error => {
                            console.error('Error al eliminar:', error);
                            loading.classList.add('hidden');
                            Toast.fire({
                                icon: 'error',
                                title: 'Hubo un error al eliminar'
                            });
                        });
                    }
                });
            });
        });
    }

    inicializarEventosEliminar();
});
</script>

@endsection