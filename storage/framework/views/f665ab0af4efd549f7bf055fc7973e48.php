

<?php $__env->startSection('titulo', 'Promociones'); ?>

<?php $__env->startSection('contenido'); ?>

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
    <form id="form-filtros" action="<?php echo e(url('/promociones')); ?>" method="GET" class="flex flex-col md:flex-row gap-4">

        
        <div class="flex-1">
            <input 
                type="text"
                id="input-buscar"
                name="buscar"
                value="<?php echo e(request('buscar')); ?>"
                placeholder="Buscar promoción..."
                class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-2.5 text-white">
        </div>

        
        <div class="w-full md:w-48">
            <select id="select-estado" name="estado" class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-2.5 text-white">
                <option value=""> Todos los estados </option>
                <option value="activa" <?php echo e(request('estado') == 'activa' ? 'selected' : ''); ?>> Activas </option>
                <option value="finalizada" <?php echo e(request('estado') == 'finalizada' ? 'selected' : ''); ?>> Finalizadas </option>
            </select>
        </div>
        
        <div class="flex gap-2">
            <a href="<?php echo e(url('/promociones')); ?>" id="btn-limpiar" class="px-4 py-2.5 bg-gray-800 text-gray-300 rounded-lg">
                Limpiar
            </a>
        </div>
    </form>
</div>

<div class="bg-[#121212]/80 rounded-lg border border-gray-800 shadow-lg overflow-hidden">
    
    <div id="contenedor-tabla" class="bg-[#121212]/80 rounded-lg border border-gray-800 shadow-lg overflow-hidden relative">
        
        
        <div id="loading-overlay" class="absolute inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center hidden z-20">
            <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-[#25a5be]"></div>
        </div>

        <div id="tabla-renderizada">
            <?php echo $__env->make('promociones.partials.tabla', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
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
        timer: 3000, // 3 segundos y se cierra
        timerProgressBar: true,
        background: '#1a1a1a', // Fondo oscuro
        color: '#ffffff',      // Texto blanco
        iconColor: '#25a5be',  // Tu color de acento
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    function obtenerProductos(url) {
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
        
        if (inputBuscar.value || selectEstado.value) {
            btnLimpiar.classList.remove('hidden');
        } else {
            btnLimpiar.classList.add('hidden');
        }

        obtenerProductos(url);
    }

    if (selectEstado) selectEstado.addEventListener('change', aplicarFiltros);

    if (inputBuscar) {
        let temporizador;
        inputBuscar.addEventListener('input', function() {
            clearTimeout(temporizador);
            temporizador = setTimeout(aplicarFiltros, 400);
        });
    }

    container.addEventListener('click', function(e) {
        const enlacePaginacion = e.target.closest('.enlaces-paginacion a');
        if (enlacePaginacion) {
            e.preventDefault();
            obtenerProductos(enlacePaginacion.href);
        }
    });

    // --- NUEVA FUNCIÓN DE ELIMINACIÓN ASÍNCRONA ---
    function inicializarEventosEliminar() {
        const formularios = document.querySelectorAll('.form-eliminar');
        
        formularios.forEach(formulario => {
            formulario.addEventListener('submit', function (e) {
                e.preventDefault();
                
                // Obtenemos la URL del action del form y el token de seguridad de Laravel
                const formEl = this;
                const urlEliminar = formEl.action;
                const token = formEl.querySelector('input[name="_token"]').value;

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción borrará el producto de forma permanente.",
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
                        
                        // Mostramos el spinner de la tabla mientras borra
                        loading.classList.remove('hidden');

                        // Enviamos la petición DELETE por detrás
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
                            // Disparamos el cartelito de éxito en la esquina
                            Toast.fire({
                                icon: 'success',
                                title: data.message || 'Producto eliminado'
                            });
                            
                            // Recargamos solo la tabla de forma fluida
                            obtenerProductos(urlActual); 
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USUARIO\Desktop\Aplicaciones Web\Boyz in the Sneaker\aplicaciones-web-laravel\resources\views/promociones/index.blade.php ENDPATH**/ ?>