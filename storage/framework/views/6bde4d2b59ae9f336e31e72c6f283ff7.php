<?php $__env->startSection('titulo', 'Dashboard'); ?>

<?php $__env->startSection('contenido'); ?>
<div class="max-w-7xl mx-auto">
    
    <h1 class="text-3xl font-bold text-white mb-8">
        Dashboard
    </h1>

    <?php if(auth()->user()->rol == 'admin' || auth()->user()->rol == 'gestor_productos'): ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-[#121212]/80 p-6 rounded-xl border border-gray-800 shadow-lg">
                <p class="text-gray-400 text-sm uppercase tracking-wider font-semibold mb-2">Ventas de Hoy</p>
                <h3 class="text-3xl font-bold text-white">$<?php echo e(number_format($montoHoy, 2)); ?></h3>
                <p class="text-[#25a5be] text-sm mt-2 font-medium"><?php echo e($cantidadHoy); ?> transacciones</p>
            </div>
            <div class="bg-[#121212]/80 p-6 rounded-xl border border-gray-800 shadow-lg">
                <p class="text-gray-400 text-sm uppercase tracking-wider font-semibold mb-2">Ventas de la Semana</p>
                <h3 class="text-3xl font-bold text-white">$<?php echo e(number_format($montoSemana, 2)); ?></h3>
                <p class="text-[#25a5be] text-sm mt-2 font-medium"><?php echo e($cantidadSemana); ?> transacciones</p>
            </div>
            <div class="bg-[#121212]/80 p-6 rounded-xl border border-gray-800 shadow-lg">
                <p class="text-gray-400 text-sm uppercase tracking-wider font-semibold mb-2">Ventas del Mes</p>
                <h3 class="text-3xl font-bold text-white">$<?php echo e(number_format($montoMes, 2)); ?></h3>
                <p class="text-[#25a5be] text-sm mt-2 font-medium"><?php echo e($cantidadMes); ?> transacciones</p>
            </div>
        </div>
    <?php endif; ?>

    <?php if(auth()->user()->rol == 'gestor_stock'): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-[#121212]/80 p-6 rounded-xl border border-gray-800 shadow-lg flex flex-col justify-center">
                <p class="text-gray-400 text-sm uppercase tracking-wider font-semibold mb-2">Unidades Disponibles</p>
                <h3 class="text-5xl font-bold text-white"><?php echo e($totalProductosDisponibles); ?></h3>
                <p class="text-gray-500 text-xs mt-2">Suma total de stock actual en el sistema</p>
            </div>

            <div class="bg-[#121212]/80 p-6 rounded-xl border border-gray-800 shadow-lg">
                <p class="text-gray-400 text-sm uppercase tracking-wider font-semibold mb-2">Producto con Más Stock</p>
                <?php if($productoMasStock): ?>
                    <h3 class="text-xl font-bold text-white mb-1"><?php echo e($productoMasStock->modelo); ?></h3>
                    <p class="text-gray-500 text-xs mb-3"><?php echo e($productoMasStock->marca); ?></p>
                    <div class="text-2xl font-bold text-[#25a5be] mb-4"><?php echo e($totalStockMasStock); ?> unidades totales</div>
                    <div class="border-t border-gray-800/60 pt-3">
                        <div class="grid grid-cols-3 gap-2">
                            <?php $__currentLoopData = $detalleTallesStock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bg-black/20 border border-gray-800 px-2 py-1 rounded text-center">
                                    <span class="text-[11px] text-gray-400 block">Talle <?php echo e($variant->talle); ?></span>
                                    <span class="text-xs font-bold text-white"><?php echo e($variant->stock); ?> u.</span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if(auth()->user()->rol == 'admin' || auth()->user()->rol == 'gestor_productos'): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-[#121212]/80 p-6 rounded-xl border border-gray-800 shadow-lg">
                <p class="text-gray-400 text-sm uppercase tracking-wider font-semibold mb-2">Producto con Más Stock</p>
                <?php if($productoMasStock): ?>
                    <h3 class="text-xl font-bold text-white mb-1"><?php echo e($productoMasStock->modelo); ?></h3>
                    <p class="text-gray-500 text-xs mb-3"><?php echo e($productoMasStock->marca); ?></p>
                    <div class="text-2xl font-bold text-[#25a5be] mb-4"><?php echo e($totalStockMasStock); ?> unidades totales</div>
                    <div class="border-t border-gray-800/60 pt-3">
                        <div class="grid grid-cols-3 gap-2">
                            <?php $__currentLoopData = $detalleTallesStock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bg-black/20 border border-gray-800 px-2 py-1 rounded text-center">
                                    <span class="text-[11px] text-gray-400 block">Talle <?php echo e($variant->talle); ?></span>
                                    <span class="text-xs font-bold text-white"><?php echo e($variant->stock); ?> u.</span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="bg-[#121212]/80 p-6 rounded-xl border border-gray-800 shadow-lg flex flex-col justify-between">
                <div>
                    <p class="text-gray-400 text-sm uppercase tracking-wider font-semibold mb-2">Producto Más Vendido</p>
                    <?php if($productoMasVendido): ?>
                        <h3 class="text-xl font-bold text-white mb-1"><?php echo e($productoMasVendido->modelo); ?></h3>
                        <p class="text-gray-500 text-xs mb-4"><?php echo e($productoMasVendido->marca); ?></p>
                    <?php else: ?>
                        <p class="text-gray-500 italic text-sm py-4">No se registran transacciones.</p>
                    <?php endif; ?>
                </div>
                <?php if($productoMasVendido): ?>
                    <div>
                        <div class="text-5xl font-extrabold text-[#25a5be]"><?php echo e($cantidadMasVendido); ?></div>
                        <p class="text-gray-500 text-xs mt-1 uppercase tracking-wider font-semibold">Unidades despachadas en la tienda</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if(auth()->user()->rol == 'admin' || auth()->user()->rol == 'gestor_productos' || auth()->user()->rol == 'gestor_stock'): ?>
        <h2 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
            Productos Sin Stock
        </h2>

        <div class="bg-[#121212]/80 rounded-xl border border-gray-800 shadow-lg overflow-hidden mb-8">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-800 bg-black/20 text-gray-400 text-xs uppercase tracking-wider font-bold">
                            <th class="px-6 py-4">Modelo</th>
                            <th class="px-6 py-4">Marca</th>
                            <th class="px-6 py-4">Talles Agotados</th>
                            <th class="px-6 py-4 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800 text-gray-300 text-sm">
                        <?php $__empty_1 = true; $__currentLoopData = $productosSinStock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productoId => $tallesOos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php 
                                $primerItem = $tallesOos->first(); 
                            ?>
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4 font-semibold text-white"><?php echo e($primerItem->producto->modelo); ?></td>
                                <td class="px-6 py-4"><?php echo e($primerItem->producto->marca); ?></td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        <?php $__currentLoopData = $tallesOos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="bg-red-500/10 text-red-400 border border-red-500/20 px-2 py-0.5 rounded text-xs font-semibold">
                                                <?php echo e($variant->talle); ?>

                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center align-middle">
                                    <a href="<?php echo e(route('productos.show', $productoId)); ?>" 
                                    class="inline-flex items-center justify-center px-3 py-1 text-xs font-bold bg-[#25a5be]/10 text-[#25a5be] rounded border border-[#25a5be]/30 hover:bg-[#25a5be]/20 transition-colors whitespace-nowrap">
                                        Ver detalle
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500 italic">
                                    No hay variantes sin stock actualmente. Todo el inventario se encuentra disponible.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USUARIO\Desktop\Aplicaciones Web\Boyz in the Sneaker\aplicaciones-web-laravel\resources\views/dashboard.blade.php ENDPATH**/ ?>