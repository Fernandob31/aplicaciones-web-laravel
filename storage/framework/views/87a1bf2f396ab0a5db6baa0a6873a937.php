

<?php $__env->startSection('titulo', 'Editar Producto'); ?>

<?php $__env->startSection('contenido'); ?>

<div class="max-w-4xl">

    <h1 class="text-3xl font-bold text-white mb-6">
        Editar Producto
    </h1>

    <div class="bg-[#121212]/80 p-6 rounded-lg border border-gray-800 shadow-lg">

        <form 
            action="/productos/<?php echo e($producto->id); ?>"
            method="POST"
        >

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="grid grid-cols-2 gap-6">

                <div>

                    <label class="block mb-2 text-gray-300">
                        Modelo
                    </label>

                    <input 
                        type="text"
                        name="modelo"
                        value="<?php echo e($producto->modelo); ?>"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                    >

                </div>

                <div>

                    <label class="block mb-2 text-gray-300">
                        Marca
                    </label>

                    <input 
                        type="text"
                        name="marca"
                        value="<?php echo e($producto->marca); ?>"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                    >

                </div>

                <div>

                    <label class="block mb-2 text-gray-300">
                        Categoría
                    </label>

                    <select 
                        name="categoria_id"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                    >

                        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option 
                                value="<?php echo e($categoria->id); ?>"
                                <?php echo e($producto->categoria_id == $categoria->id ? 'selected' : ''); ?>

                            >
                                <?php echo e($categoria->nombre); ?>

                            </option>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>

                </div>

                <div>

                    <label class="block mb-2 text-gray-300">
                        Género
                    </label>

                    <select 
                        name="genero"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                    >

                        <option 
                            value="Hombre"
                            <?php echo e($producto->genero == 'Hombre' ? 'selected' : ''); ?>

                        >
                            Hombre
                        </option>

                        <option 
                            value="Mujer"
                            <?php echo e($producto->genero == 'Mujer' ? 'selected' : ''); ?>

                        >
                            Mujer
                        </option>

                        <option 
                            value="Unisex"
                            <?php echo e($producto->genero == 'Unisex' ? 'selected' : ''); ?>

                        >
                            Unisex
                        </option>

                    </select>

                </div>

                <div>

                    <label class="block mb-2 text-gray-300">
                        Precio
                    </label>

                    <input 
                        type="number"
                        step="0.01"
                        name="precio"
                        value="<?php echo e($producto->precio); ?>"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                    >

                </div>
                <div>
                    <label class="block mb-2 text-gray-300">
                        Colores
                    </label>
                    <input 
                        type="text"
                        name="colores"
                        value="<?php echo e(implode(',', $producto->colores)); ?>"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                    >
                </div>    
            </div>

            <div class="mt-6">

                <label class="block mb-2 text-gray-300">
                    Descripción
                </label>

                <textarea 
                    name="descripcion"
                    rows="4"
                    class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                ><?php echo e($producto->descripcion); ?></textarea>

            </div>

            <div class="space-y-4">

                <label class="block text-gray-300">
                    Talles y Stock
                </label>

                <div id="contenedor-talles">

                    <?php $__currentLoopData = $producto->talles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $talle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="flex gap-4 mb-4">

                            <input
                                type="text"
                                name="talles[]"
                                value="<?php echo e($talle->talle); ?>"
                                class="w-1/2 bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                            >

                            <input
                                type="number"
                                name="stocks[]"
                                value="<?php echo e($talle->stock); ?>"
                                class="w-1/2 bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
                            >

                        </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

                <button
                    type="button"
                    onclick="agregarTalle()"
                    class="px-4 py-2 bg-[#25a5be]/10 text-[#25a5be] rounded border border-[#25a5be]/30"
                >
                    + Agregar talle
                </button>

            </div>

            <div class="mt-8">

                <button 
                    type="submit"
                    class="px-6 py-3 bg-[#25a5be] hover:bg-[#1d8fa5] text-white rounded-lg transition"
                >
                    Actualizar Producto
                </button>

            </div>

        </form>

    </div>

</div>

<script>

function agregarTalle() {

    let html = `

        <div class="flex gap-4 mb-4">

            <input
                type="text"
                name="talles[]"
                placeholder="Talle"
                class="w-1/2 bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
            >

            <input
                type="number"
                name="stocks[]"
                placeholder="Stock"
                class="w-1/2 bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
            >

        </div>
    `;

    document
        .getElementById('contenedor-talles')
        .insertAdjacentHTML('beforeend', html);
}

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USUARIO\Desktop\Aplicaciones Web\Boyz in the Sneaker\aplicaciones-web-laravel\resources\views/productos/edit.blade.php ENDPATH**/ ?>