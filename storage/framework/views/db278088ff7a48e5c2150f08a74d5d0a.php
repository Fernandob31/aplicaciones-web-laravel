

<?php $__env->startSection('titulo', 'Usuarios'); ?>

<?php $__env->startSection('contenido'); ?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-white">Gestión de Usuarios</h2>

    <a href="/usuarios/create"
       class="px-4 py-2 bg-[#25a5be] text-white rounded-lg hover:bg-[#1e8ca0]">
        Nuevo Usuario
    </a>
</div>

<?php if(session('success')): ?>
    <div class="mb-4 p-4 bg-green-500/20 border border-green-500 rounded">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="bg-[#121212]/80 rounded-lg border border-gray-800 overflow-hidden">

    <table class="w-full">

        <thead class="bg-[#1a1a1a]">
            <tr>
                <th class="p-4 text-left">ID</th>
                <th class="p-4 text-left">Usuario</th>
                <th class="p-4 text-left">Rol</th>
                <th class="p-4 text-left">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr class="border-t border-gray-800">

                    <td class="p-4">
                        <?php echo e($usuario->id); ?>

                    </td>

                    <td class="p-4">
                        <?php echo e($usuario->username); ?>

                    </td>

                    <td class="p-4">
                        <?php echo e($usuario->rol_nombre); ?>

                    </td>

                    <td class="p-4 flex gap-2">

                        <a href="/usuarios/<?php echo e($usuario->id); ?>/edit"
                           class="px-3 py-1 bg-yellow-500 rounded">
                            Editar
                        </a>

                        <form action="/usuarios/<?php echo e($usuario->id); ?>"
                              method="POST">

                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>

                            <button
                                class="px-3 py-1 bg-red-600 rounded">
                                Eliminar
                            </button>

                        </form>

                    </td>

                </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>

    </table>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USUARIO\Desktop\Aplicaciones Web\Boyz in the Sneaker\aplicaciones-web-laravel\resources\views/usuarios/index.blade.php ENDPATH**/ ?>