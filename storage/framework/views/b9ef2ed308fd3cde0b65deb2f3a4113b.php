

<?php $__env->startSection('titulo', 'Productos'); ?>

<?php $__env->startSection('contenido'); ?>

<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-3xl font-bold text-white">
            Gestión de Productos
        </h1>
        <p class="text-gray-400 mt-1">
            Administra el catálogo de zapatillas.
        </p>
    </div>
    <a 
        href="/productos/create"
        class="px-5 py-2 bg-[#25a5be] hover:bg-[#1d8fa5] text-white rounded-lg transition shadow-lg"
    >
        + Nuevo Producto
    </a>
</div>

<div class="bg-[#121212]/80 rounded-lg border border-gray-800 shadow-lg overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-[#1a1a1a] border-b border-gray-700">
            <tr>
                <th class="p-4 text-gray-300">
                    ID
                </th>
                <th class="p-4 text-gray-300">
                    Modelo
                </th>
                <th class="p-4 text-gray-300">
                    Marca
                </th>
                <th class="p-4 text-gray-300">
                    Categoría
                </th>
                <th class="p-4 text-gray-300">
                    Precio
                </th>
                <th class="p-4 text-gray-300">
                    Stock Total
                </th>
                <th class="p-4 text-gray-300">
                    Género
                </th>
                <th class="p-4 text-gray-300">
                    Acciones
                </th>
            </tr>

        </thead>

        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b border-gray-800 hover:bg-[#1a1a1a]/50 transition">
                    <td class="p-4 text-gray-400">
                        <?php echo e($producto->id); ?>

                    </td>
                    <td class="p-4 text-white font-medium">
                        <?php echo e($producto->modelo); ?>

                    </td>
                    <td class="p-4 text-gray-300">
                        <?php echo e($producto->marca); ?>

                    </td>
                    <td class="p-4 text-gray-300">
                        <?php echo e($producto->categoria->nombre); ?>

                    </td>
                    <td class="p-4 text-[#25a5be] font-semibold">
                        $ <?php echo e(number_format($producto->precio, 0, ',', '.')); ?>

                    </td>
                    <td class="p-4 text-gray-300">
                        <?php echo e($producto->talles->sum('stock')); ?>

                    </td>
                    <td class="p-4 text-gray-300">
                        <?php echo e($producto->genero); ?>

                    </td>
                    <td class="p-4 flex gap-2">
                        <a 
                            href="/productos/<?php echo e($producto->id); ?>/edit"
                            class="px-3 py-1 bg-yellow-500/10 text-yellow-400 rounded border border-yellow-500/30 hover:bg-yellow-500/20 transition">
                            Editar
                        </a>
                        <form action="/productos/<?php echo e($producto->id); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button 
                                type="submit"
                                class="px-3 py-1 bg-red-500/10 text-red-400 rounded border border-red-500/30 hover:bg-red-500/20 transition"
                            >
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <tr>

                    <td colspan="7" class="p-6 text-center text-gray-500">

                        No hay productos registrados.

                    </td>

                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USUARIO\Desktop\Aplicaciones Web\Boyz in the Sneaker\aplicaciones-web-laravel\resources\views/productos/index.blade.php ENDPATH**/ ?>