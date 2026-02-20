
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
                    <td>
                        <?php if($solicitud->usuario): ?>
                            <?php echo e($solicitud->usuario->Nombre_1); ?>

                            <?php echo e($solicitud->usuario->Apellido_1); ?>

                        <?php else: ?>
                            Usuario #<?php echo e($solicitud->usuario_id); ?>

                        <?php endif; ?>
                    </td>
                    <td><?php echo e($solicitud->fecha_solicitud->format('d/m/Y')); ?></td>
                    <td>
                        <?php
                            $estado = $solicitud->estado ?? 'Sin Estado';
                            $estado_class = strtolower(str_replace(' ', '-', $estado));
                        ?>
                        <span class="status-badge <?php echo e($estado_class); ?>">
                            <?php echo e($estado); ?>

                        </span>
                    </td>
                    <td class="actions">
                        <a href="<?php echo e(route('admin.solicitudes.show', $solicitud)); ?>" class="btn-action view-btn" title="Ver">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="<?php echo e(route('admin.solicitudes.edit', $solicitud)); ?>" class="btn-action edit-btn" title="Editar">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="<?php echo e(route('admin.solicitudes.destroy', $solicitud)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn-action delete-btn" title="Eliminar"
                                onclick="return confirm('¿Estás seguro?')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="card-actions no-data">
                        <i class="fa-solid fa-clipboard-list fa-3x"></i>
                        <p>No hay solicitudes registradas</p>
                        <a href="<?php echo e(route('admin.solicitudes.create')); ?>" class="btn-action primary-btn ">
                            Crear Primera Solicitud
                        </a>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php /**PATH C:\xampp\htdocs\Rescatando-mascotas-foreve\resources\views/admin/solicitud/partials/index/table.blade.php ENDPATH**/ ?>