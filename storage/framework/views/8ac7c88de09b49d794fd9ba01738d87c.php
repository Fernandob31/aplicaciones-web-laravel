

<?php $__env->startSection('titulo', 'Editar Promoción'); ?>

<?php $__env->startSection('contenido'); ?>

<div class="max-w-5xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white"> Editar Promoción </h1>
        <p class="text-gray-400 mt-1"> Configura una nueva promoción para los productos seleccionados. </p>
    </div>

    <form action="/promociones/<?php echo e($promocion->id); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="bg-[#121212]/80 rounded-xl border border-gray-800 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div>
                    <label class="block mb-2 text-gray-300">
                        Tipo de Promoción <span class="text-red-500">*</span>
                    </label>
                    <select name="tipo" id="tipo" disabled class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white">
                        <option value="categoria" <?php echo e($promocion->tipo == 'categoria' ? 'selected' : ''); ?>>
                            Categoría 
                        </option>
                        <option value="marca" <?php echo e($promocion->tipo == 'marca' ? 'selected' : ''); ?>>
                            Marca 
                        </option>
                        <option value="personalizada" <?php echo e($promocion->tipo == 'personalizada' ? 'selected' : ''); ?>>
                            Personalizada
                        </option>
                    </select>
                </div>
                
                
                <div>
                    <label class="block mb-2 text-gray-300">
                        Nombre de la Promoción <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nombre" value="<?php echo e(old('nombre', $promocion->nombre)); ?>" disabled class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white">
                </div>
                
                <div>
                    <label class="block mb-2 text-gray-300">
                        Descuento (%) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" min="1" max="99" name="descuento" value="<?php echo e(old('descuento', $promocion->descuento)); ?>" disabled 
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white" >
                </div>
                
                <div>
                    <label class="block mb-2 text-gray-300">
                        Fecha Inicio <span class="text-red-500">*</span>
                    </label>

                    <input type="date" value="<?php echo e($promocion->fecha_inicio); ?>" disabled
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                    >
                </div>
                
                <div>
                    <label class="block mb-2 text-gray-300">
                        Fecha Fin <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="fecha_fin" value="<?php echo e(old('fecha_fin', $promocion->fecha_fin)); ?>"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white">
                    <?php $__errorArgs = ['fecha_fin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-500"> <?php echo e($message); ?> </p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div>
                    <label class="block mb-2 text-gray-300"> 
                        Estado
                    </label>

                    <input type="text" value="<?php echo e(ucfirst($promocion->estado)); ?>" disabled
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                    >
                </div>
                <div class="mt-10 mb-6">
                    <h2 class="text-xl font-bold text-white"> Productos Afectados </h2>
                    <div class="max-h-96 overflow-y-auto border border-gray-700 rounded-lg">
                        <table class="w-full text-sm">
                            <thead class="bg-[#1a1a1a] text-gray-300">
                                <tr>
                                    <th class="p-3">ID</th>
                                    <th class="p-3">Marca</th>
                                    <th class="p-3">Modelo</th>
                                    <th class="p-3">Precio</th>
                                </tr>
                            </thead>
                            <tbody id="tabla-productos-body">
                                <?php $__currentLoopData = $promocion->productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="fila-producto border-t border-gray-800">
                                        <td class="p-3"> <?php echo e($producto->id); ?> </td>
                                        <td class="p-3"> <?php echo e($producto->marca); ?> </td>
                                        <td class="p-3"> <?php echo e($producto->modelo); ?> </td>
                                        <td class="p-3"> $<?php echo e(number_format($producto->precio, 0, ',', '.')); ?> </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-800 flex gap-4">
                <button type="submit" class="px-6 py-3 bg-[#25a5be] hover:bg-[#1d8fa5] text-white rounded-lg transition">
                    Guardar Promoción
                </button>
                <a href="/promociones" class="px-6 py-3 border border-gray-700 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">
                    Cancelar
                </a>
            </div>
        </div>
    </form>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USUARIO\Desktop\Aplicaciones Web\Boyz in the Sneaker\aplicaciones-web-laravel\resources\views/promociones/edit.blade.php ENDPATH**/ ?>