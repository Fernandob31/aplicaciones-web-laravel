<?php $__env->startSection('titulo', 'Categorías'); ?>

<?php $__env->startSection('contenido'); ?>

<div class="flex items-center justify-between mb-6">

    <div>
        <h1 class="text-3xl font-bold text-white">
            Gestión de Categorías
        </h1>

        <p class="text-gray-400 mt-1">
            Administra las categorías de productos de la tienda.
        </p>
    </div>

    <a 
        href="/categorias/create"
        class="px-5 py-2 bg-[#25a5be] hover:bg-[#1d8fa5] text-white rounded-lg transition shadow-lg"
    >
        + Nueva Categoría
    </a>

</div>

<div class="bg-[#121212]/80 rounded-lg border border-gray-800 shadow-lg overflow-hidden">

    <table class="w-full text-left">

        <thead class="bg-[#1a1a1a] border-b border-gray-700">
            <tr>
                <th class="p-4 text-gray-300">ID</th>
                <th class="p-4 text-gray-300">Nombre</th>
                <th class="p-4 text-gray-300">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php $__empty_1 = true; $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <tr class="border-b border-gray-800 hover:bg-[#1a1a1a]/50 transition">

                    <td class="p-4 text-gray-400">
                        <?php echo e($categoria->id); ?>

                    </td>

                    <td class="p-4 text-white font-medium">
                        <?php echo e($categoria->nombre); ?>

                    </td>

                    <td class="p-4 flex gap-2">

                        <a 
                            href="/categorias/<?php echo e($categoria->id); ?>/edit"
                            class="px-3 py-1 bg-yellow-500/10 text-yellow-400 rounded border border-yellow-500/30 hover:bg-yellow-500/20 transition"
                        >
                            Editar
                        </a>

                        <form action="/categorias/<?php echo e($categoria->id); ?>" method="POST" class="form-eliminar" >
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="px-3 py-1.5 text-sm font-medium bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white rounded-lg border border-red-500/30 transition-colors flex items-center justify-center">
                                Eliminar
                            </button>
                        </form>

                    </td>

                </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <tr>
                    <td colspan="3" class="p-6 text-center text-gray-500">
                        No hay categorías registradas.
                    </td>
                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>

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
        iconColor: '#25a5be',
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    <?php if(session('success')): ?>
        Toast.fire({
            icon: 'success',
            title: '<?php echo e(session('success')); ?>'
        });
    <?php endif; ?>

    const formularios = document.querySelectorAll('.form-eliminar');
    
    formularios.forEach(formulario => {
        formulario.addEventListener('submit', function (e) {
            e.preventDefault();
            
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción borrará la categoría de forma permanente.",
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
                    this.submit();
                }
            });
        });
    });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USUARIO\Desktop\Aplicaciones Web\Boyz in the Sneaker\aplicaciones-web-laravel\resources\views/categorias/index.blade.php ENDPATH**/ ?>