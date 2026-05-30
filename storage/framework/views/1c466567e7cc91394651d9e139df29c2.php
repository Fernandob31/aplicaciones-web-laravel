

<?php $__env->startSection('titulo', 'Editar Usuario'); ?>

<?php $__env->startSection('contenido'); ?>

<div class="max-w-2xl">

    <form method="POST" action="/usuarios/<?php echo e($usuario->id); ?>">

        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-4">

            <label class="block mb-2">
                Usuario
            </label>

            <input
                type="text"
                name="username"
                value="<?php echo e($usuario->username); ?>"
                required
                class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
            >

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Nueva Contraseña (opcional)
            </label>

            <input
                type="password"
                name="password"
                class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
            >

        </div>

        <div class="mb-6">

            <label class="block mb-2">
                Rol
            </label>

            <select
                name="rol"
                class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white"
            >

                <option value="admin"
                    <?php echo e($usuario->rol == 'admin' ? 'selected' : ''); ?>>
                    Admin
                </option>

                <option value="gestor_productos"
                    <?php echo e($usuario->rol == 'gestor_productos' ? 'selected' : ''); ?>>
                    Gestor Productos
                </option>

                <option value="gestor_stock"
                    <?php echo e($usuario->rol == 'gestor_stock' ? 'selected' : ''); ?>>
                    Gestor Stock
                </option>

            </select>

        </div>

        <button
            type="submit"
            class="px-6 py-3 bg-[#25a5be] rounded-lg text-white"
        >
            Guardar Cambios
        </button>

    </form>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USUARIO\Desktop\Aplicaciones Web\Boyz in the Sneaker\aplicaciones-web-laravel\resources\views/usuarios/edit.blade.php ENDPATH**/ ?>