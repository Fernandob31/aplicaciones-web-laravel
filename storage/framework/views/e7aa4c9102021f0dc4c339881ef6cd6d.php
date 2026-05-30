

<?php $__env->startSection('titulo', 'Nuevo Usuario'); ?>

<?php $__env->startSection('contenido'); ?>

// temporal 
<?php if($errors->any()): ?>
    <div class="mb-4 p-4 bg-red-500/20 border border-red-500 rounded">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<div class="max-w-2xl">

    <form method="POST" action="/usuarios">

        <?php echo csrf_field(); ?>

        <div class="mb-4">

            <label class="block mb-2">
                Usuario
            </label>

            <input
                type="text"
                name="username"
                required
                class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
            >

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Contraseña
            </label>

            <input
                type="password"
                name="password"
                required
                class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
            >

        </div>

        <div class="mb-6">

            <label class="block mb-2">
                Rol
            </label>

            <select
                name="rol"
                required
                class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
            >
                <option value="admin">
                    Admin
                </option>

                <option value="gestor_productos">
                    Gestor Productos
                </option>

                <option value="gestor_stock">
                    Gestor Stock
                </option>

            </select>

        </div>

        <button
            type="submit"
            class="px-6 py-3 bg-[#25a5be] rounded-lg text-white"
        >
            Guardar Usuario
        </button>

    </form>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USUARIO\Desktop\Aplicaciones Web\Boyz in the Sneaker\aplicaciones-web-laravel\resources\views/usuarios/create.blade.php ENDPATH**/ ?>