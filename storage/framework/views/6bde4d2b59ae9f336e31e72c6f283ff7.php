<?php $__env->startSection('titulo', 'Resumen General'); ?>

<?php $__env->startSection('contenido'); ?>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-[#121212]/80 p-6 rounded-lg border border-[#25a5be]/30 shadow-lg backdrop-blur-sm">
            <h3 class="text-gray-400 text-xs uppercase tracking-widest mb-2">Total Productos</h3>
            <p class="text-4xl font-bold text-[#25a5be]"><?php echo e($totalProductos); ?></p>
        </div>
        
        <div class="bg-[#121212]/80 p-6 rounded-lg border border-[#25a5be]/30 shadow-lg backdrop-blur-sm">
            <h3 class="text-gray-400 text-xs uppercase tracking-widest mb-2">Categorías Activas</h3>
            <p class="text-4xl font-bold text-[#25a5be]"><?php echo e($totalCategorias); ?></p>
        </div>
        
        <div class="bg-[#121212]/80 p-6 rounded-lg border border-[#25a5be]/30 shadow-lg backdrop-blur-sm">
            <h3 class="text-gray-400 text-xs uppercase tracking-widest mb-2">Ventas del dia</h3>
            <p class="text-4xl font-bold text-[#25a5be]">0</p>
        </div>
    </div>

    <div class="bg-[#121212]/80 p-8 rounded-lg border border-gray-800 shadow-lg backdrop-blur-sm">
        <h3 class="text-xl text-gray-200 mb-4 border-b border-gray-700 pb-2">Bienvenido al Panel de Administración</h3>
        <p class="text-gray-400 leading-relaxed">
            Desde aquí podrás gestionar todo el catálogo de la tienda. Selecciona una opción
        </p>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USUARIO\Desktop\Aplicaciones Web\Boyz in the Sneaker\aplicaciones-web-laravel\resources\views/dashboard.blade.php ENDPATH**/ ?>