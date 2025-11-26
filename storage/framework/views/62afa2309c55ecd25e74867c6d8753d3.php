
<div class="table-container">
    <table class="solicitudes-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Solicitante</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $solicitudes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $solicitud): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>#<?php echo e($solicitud->id); ?></td>
                    <td>
                        <span class="tipo-badge"><?php echo e($solicitud->tipo); ?></span>
                    </td>
                    <td><?php echo e($solicitud->usuario->nombre ?? 'N/A'); ?></td>
                    <td><?php echo e($solicitud->fecha_solicitud->format('d/m/Y')); ?></td>
                    <td>
                        <?php
                            $estado_class = strtolower(str_replace(' ', '-', $solicitud->estado ?? 'revision'));
                        ?>
                        <span class="status-badge <?php echo e($estado_class); ?>">
                            <?php echo e($solicitud->estado ?? 'Sin Estado'); ?>

                        </span>
                    </td>
                    <td class="actions">
                        <a href="<?php echo e(route('solicitud.show', $solicitud)); ?>" class="btn-action view-btn" title="Ver">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="<?php echo e(route('solicitud.edit', $solicitud)); ?>" class="btn-action edit-btn" title="Editar">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="<?php echo e(route('solicitud.destroy', $solicitud)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn-action delete-btn" title="Eliminar" onclick="return confirm('¿Estás seguro?')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center no-data">
                        <i class="fa-solid fa-clipboard-list fa-3x"></i>
                        <p>No hay solicitudes registradas</p>
                        <a href="<?php echo e(route('solicitud.create')); ?>" class="btn-action primary-btn">
                            Crear Primera Solicitud
                        </a>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/admin/solicitud/partials/index/table.blade.php ENDPATH**/ ?>