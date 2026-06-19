<?php $__env->startSection('titulo', 'Detalle de Producto'); ?>

<?php $__env->startSection('contenido'); ?>
<div class="bg-[#121212]/80 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl backdrop-blur-sm">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 p-8">
        
        <div class="space-y-6">
            <div class="aspect-square rounded-xl overflow-hidden border border-[#25a5be]/30 bg-black/40 flex items-center justify-center">
                <?php if($producto->imagen): ?>
                    <img src="<?php echo e($producto->imagen); ?>" alt="<?php echo e($producto->modelo); ?>" class="w-full h-full object-contain">
                <?php else: ?>
                    <div class="text-center p-8">
                        <svg class="w-16 h-16 text-gray-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p class="text-gray-500 font-bold uppercase tracking-widest text-sm">Sin imagen de portada</p>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php if($producto->imagenes->count() > 0): ?>
            <div>
                <h3 class="text-gray-400 text-xs uppercase tracking-widest mb-3">Galería de Fotos</h3>
                <div class="grid grid-cols-4 gap-4">
                    <?php $__currentLoopData = $producto->imagenes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="aspect-square rounded-lg overflow-hidden border border-gray-800 hover:border-[#25a5be] transition-colors cursor-pointer bg-black/20">
                        <img src="<?php echo e($foto->url_imagen); ?>" class="w-full h-full object-cover">
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="flex flex-col justify-between">
            <div class="space-y-8">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <span class="text-[#25a5be] text-sm font-bold tracking-widest uppercase"><?php echo e($producto->marca); ?></span>
                            <h1 class="text-4xl font-extrabold text-white mt-1"><?php echo e($producto->modelo); ?></h1>
                        </div>
                        <div class="text-right">
                            <?php if($producto->tiene_descuento): ?>
                                <p class="text-sm text-gray-500 line-through">
                                    $<?php echo e(number_format($producto->precio, 0, ',', '.')); ?>

                                </p>
                                <p class="text-sm font-bold text-red-400">
                                    <?php echo e($producto->descuento); ?>% OFF
                                </p>
                                <p class="text-3xl font-light text-[#25a5be]">
                                    $<?php echo e(number_format($producto->precio_final, 0, ',', '.')); ?>

                                </p>
                            <?php else: ?>
                                <p class="text-3xl font-light text-[#25a5be]">
                                    $<?php echo e(number_format($producto->precio, 0, ',', '.')); ?>

                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            <div class="mt-4">
                <h3 class="text-sm font-semibold text-gray-400 mb-2">Colores Disponibles:</h3>
                
                <div class="flex flex-wrap gap-3">
                    <?php $__currentLoopData = $producto->colores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center gap-2 bg-[#1a1a1a] px-3 py-1.5 rounded-full border border-gray-700 shadow-sm">
                            
                            <span 
                                class="w-4 h-4 rounded-full border border-gray-500/50" 
                                style="background-color: <?php echo e($color); ?>;"
                            ></span>
                            
                            <span class="text-sm text-gray-300 font-mono">
                                <?php echo e(strtoupper($color)); ?>

                            </span>
                            
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div>
                    <h3 class="text-gray-400 text-xs uppercase tracking-widest mb-3">Descripción</h3>
                    <p class="text-gray-300 leading-relaxed"><?php echo e($producto->descripcion); ?></p>
                </div>

                <div>
                    <h3 class="text-gray-400 text-xs uppercase tracking-widest mb-4">Stock por Talle</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <?php $__currentLoopData = $producto->talles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center justify-between bg-[#1a1a1a] border <?php echo e($item->stock > 0 ? 'border-gray-800' : 'border-red-900/30'); ?> p-4 rounded-xl">
                            <div class="flex items-center gap-3">
                                <span class="text-[#25a5be] font-bold text-lg">Talle <?php echo e($item->talle); ?></span>
                            </div>
                            <div class="text-right">
                                <?php if($item->stock > 0): ?>
                                    <span class="text-white font-medium block"><?php echo e($item->stock); ?> unidades</span>
                                    <span class="text-[10px] text-green-500 uppercase tracking-tighter">Disponible</span>
                                <?php else: ?>
                                    <span class="text-gray-600 font-medium block">Sin stock</span>
                                    <span class="text-[10px] text-red-500 uppercase tracking-tighter">Agotado</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <div class="mt-12 flex gap-4">
                <a href="<?php echo e(url('/productos/'.$producto->id.'/edit')); ?>" class="flex-1 bg-[#25a5be] hover:bg-[#1d8fa6] text-black font-bold py-4 rounded-xl text-center transition-all shadow-[0_0_20px_rgba(37,165,190,0.2)]">
                    Editar Producto
                </a>
                <a href="<?php echo e(url('/productos')); ?>" class="px-8 py-4 border border-gray-700 text-gray-400 hover:text-white hover:bg-gray-800 rounded-xl transition-all text-center">
                    Volver
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php if(session('success')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000, // Desaparece a los 3 segundos
                timerProgressBar: true,
                background: '#1a1a1a', // Fondo oscuro del panel
                color: '#ffffff',      // Texto blanco
                iconColor: '#25a5be',  // Color de acento
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            // Disparamos el cartel usando el mensaje que mandó el Controlador
            Toast.fire({
                icon: 'success',
                title: '<?php echo e(session('success')); ?>'
            });
        });
    </script>
<?php endif; ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USUARIO\Desktop\Aplicaciones Web\Boyz in the Sneaker\aplicaciones-web-laravel\resources\views/productos/show.blade.php ENDPATH**/ ?>