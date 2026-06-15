

<?php $__env->startSection('titulo', 'Detalle de Promocion'); ?>

<?php $__env->startSection('contenido'); ?>
<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white"> <?php echo e($promocion->nombre); ?> </h1>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
        <div class="bg-[#121212]/80 border border-gray-800 rounded-xl p-4">
            <p class="text-gray-400 text-sm">Tipo</p>
            <p class="text-white font-semibold"> <?php echo e(ucfirst($promocion->tipo)); ?> </p>
        </div>
        <div class="bg-[#121212]/80 border border-gray-800 rounded-xl p-4">
            <p class="text-gray-400 text-sm">Descuento</p>
            <p class="text-red-400 font-semibold"> <?php echo e($promocion->descuento); ?>% </p>
        </div>
        <div class="bg-[#121212]/80 border border-gray-800 rounded-xl p-4">
            <p class="text-gray-400 text-sm">Estado</p>
            <p class="text-green-400 font-semibold"> <?php echo e(ucfirst($promocion->estado)); ?> </p>
        </div>
        <div class="bg-[#121212]/80 border border-gray-800 rounded-xl p-4">
            <p class="text-gray-400 text-sm">Fecha Inicio</p>
            <p class="text-white"> <?php echo e(\Carbon\Carbon::parse($promocion->fecha_inicio)->format('d/m/Y')); ?> </p>
        </div>
        <div class="bg-[#121212]/80 border border-gray-800 rounded-xl p-4">
            <p class="text-gray-400 text-sm">Fecha Fin</p>
            <p class="text-white"> <?php echo e(\Carbon\Carbon::parse($promocion->fecha_fin)->format('d/m/Y')); ?> </p>
        </div>
    </div>

    
    <div class="bg-[#121212]/80 border border-gray-800 rounded-xl overflow-hidden">
        <div class="p-6 border-b border-gray-800">
            <h2 class="text-xl font-bold text-white"> Productos afectados </h2>
            <p class="text-gray-400 text-sm mt-1"> Total: <?php echo e($promocion->productos->count()); ?> productos </p>
        </div>
        <table class="w-full text-sm">
            <thead class="bg-[#1a1a1a] text-gray-300">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Marca</th>
                    <th class="p-3 text-left">Modelo</th>
                    <th class="p-3 text-left">Precio Original</th>
                    <th class="p-3 text-left">Precio Final</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $promocion->productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-t border-gray-800">
                        <td class="p-3"> <?php echo e($producto->id); ?> </td>
                        <td class="p-3"> <?php echo e($producto->marca); ?> </td>
                        <td class="p-3"> <?php echo e($producto->modelo); ?> </td>
                        <td class="p-3"> $<?php echo e(number_format($producto->precio, 0, ',', '.')); ?> </td>
                        <td class="p-3 text-[#25a5be] font-semibold"> 
                            $<?php echo e(number_format($producto->precio - ($producto->precio * $promocion->descuento / 100),0,',','.')); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="mt-8 flex gap-4">
        <a href="/promociones/<?php echo e($promocion->id); ?>/edit" class="flex-1 bg-[#25a5be] hover:bg-[#1d8fa6] text-black font-bold py-4 rounded-xl text-center">
            Editar Promoción
        </a>
        <a href="/promociones" class="px-8 py-4 border border-gray-700 text-gray-400 hover:text-white hover:bg-gray-800 rounded-xl text-center">
            Volver
        </a>
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
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USUARIO\Desktop\Aplicaciones Web\Boyz in the Sneaker\aplicaciones-web-laravel\resources\views/promociones/show.blade.php ENDPATH**/ ?>