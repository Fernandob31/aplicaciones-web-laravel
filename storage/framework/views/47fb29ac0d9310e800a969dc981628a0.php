<table class="w-full text-left">
    <thead class="bg-[#1a1a1a] border-b border-gray-700">
        <tr>
            <th class="p-4 text-gray-300">ID</th>
            <th class="p-4 text-gray-300">Modelo</th>
            <th class="p-4 text-gray-300">Marca</th>
            <th class="p-4 text-gray-300">Categoría</th>
            <th class="p-4 text-gray-300">Precio</th>
            <th class="p-4 text-gray-300">Stock Total</th>
            <th class="p-4 text-gray-300">Género</th>
            <th class="p-4 text-gray-300">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="border-b border-gray-800 hover:bg-[#1a1a1a]/50 transition">
                <td class="p-4 text-gray-400"><?php echo e($producto->id); ?></td>
                <td class="p-4 text-white font-medium"><?php echo e($producto->modelo); ?></td>
                <td class="p-4 text-gray-300"><?php echo e($producto->marca); ?></td>
                <td class="p-4 text-gray-300"><?php echo e($producto->categoria->nombre); ?></td>
                <td class="p-4 text-[#25a5be] font-semibold">
                    <?php if($producto->tiene_descuento): ?>
                        <div class="flex flex-col">
                            <span class="text-sm text-gray-500 line-through">
                                $ <?php echo e(number_format($producto->precio, 0, ',', '.')); ?>

                            </span>
                            <span class="text-xs font-bold text-red-400">
                                <?php echo e($producto->descuento); ?>% OFF
                            </span>
                            <span class="text-[#25a5be] font-semibold">
                                $ <?php echo e(number_format($producto->precio_final, 0, ',', '.')); ?>

                            </span>
                        </div>
                    <?php else: ?>
                        <span class="text-[#25a5be] font-semibold">
                            $ <?php echo e(number_format($producto->precio, 0, ',', '.')); ?>

                        </span>
                    <?php endif; ?>
                </td>
                <td class="p-4 text-gray-300"><?php echo e($producto->talles->sum('stock')); ?></td>
                <td class="p-4 text-gray-300"><?php echo e($producto->genero); ?></td>
                <td class="p-4">
                <div class="flex items-center gap-2">
                    <a href="/productos/<?php echo e($producto->id); ?>/edit" 
                    class="px-3 py-1.5 text-sm font-medium bg-yellow-500/10 text-yellow-400 rounded-lg border border-yellow-500/30 hover:bg-yellow-500/20 transition-colors flex items-center justify-center">
                        Editar
                    </a>
                    <?php if(auth()->user()->rol != 'gestor_stock'): ?>
                        <form action="/productos/<?php echo e($producto->id); ?>" method="POST" class="form-eliminar flex m-0">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" 
                                    class="px-3 py-1.5 text-sm font-medium bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white rounded-lg border border-red-500/30 transition-colors flex items-center justify-center">
                                Eliminar
                            </button>
                        </form>
                    <?php endif; ?>
                    <a href="/productos/<?php echo e($producto->id); ?>" 
                    class="px-3 py-1.5 text-sm font-medium bg-[#25a5be]/10 text-[#25a5be] rounded-lg border border-[#25a5be]/30 hover:bg-[#25a5be]/20 transition-colors flex items-center justify-center">
                        Ver Detalles
                    </a>
                </div>
            </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="8" class="p-6 text-center text-gray-500">No hay productos registrados con esos filtros.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


<div id="pagination-container" class="bg-[#1a1a1a] p-4 border-t border-gray-800 flex justify-between items-center text-sm text-gray-400">
    <div>
        Mostrando registros del <?php echo e($productos->firstItem() ?? 0); ?> al <?php echo e($productos->lastItem() ?? 0); ?> de un total de <?php echo e($productos->total()); ?>

    </div>
    <div class="flex enlaces-paginacion">
        <?php echo e($productos->links()); ?>

    </div>
</div><?php /**PATH C:\Users\USUARIO\Desktop\Aplicaciones Web\Boyz in the Sneaker\aplicaciones-web-laravel\resources\views/productos/partials/tabla.blade.php ENDPATH**/ ?>