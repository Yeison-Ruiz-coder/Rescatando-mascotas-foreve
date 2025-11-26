
<div class="card-details">

    <!-- Estado Actual -->
    <div class="detail-group status-group">
        <label>Estado Actual:</label>
        <?php
            $estado_class = strtolower(str_replace(' ', '-', $solicitud->estado ?? 'revision'));
        ?>
        <span class="status-badge large <?php echo e($estado_class); ?>">
            <?php echo e($solicitud->estado ?? 'Sin Estado'); ?>

        </span>
    </div>

    <!-- Información Básica -->
    <div class="details-grid">
        <div class="detail-group">
            <label><i class="fa-solid fa-tag"></i> Tipo de Solicitud:</label>
            <p><?php echo e($solicitud->tipo); ?></p>
        </div>

        <div class="detail-group">
            <label><i class="fa-solid fa-calendar"></i> Fecha de Solicitud:</label>
            <p><?php echo e($solicitud->fecha_solicitud->format('d/m/Y H:i')); ?></p>
        </div>

        <div class="detail-group">
            <label><i class="fa-solid fa-user"></i> Solicitante:</label>
            <td>
                <?php if($solicitud->usuario): ?>
                    <?php echo e($solicitud->usuario->Nombre_1); ?>

                    <?php echo e($solicitud->usuario->Apellido_1); ?>

                <?php else: ?>
                    Usuario #<?php echo e($solicitud->usuario_id); ?>

                <?php endif; ?>
            </td>
        </div>

        <div class="detail-group">
            <label><i class="fa-solid fa-clock"></i> Creada el:</label>
            <p><?php echo e($solicitud->created_at->format('d/m/Y H:i')); ?></p>
        </div>
    </div>

    <!-- Contenido / Justificación -->
    <div class="detail-group full-width">
        <label><i class="fa-solid fa-file-lines"></i> Contenido / Justificación:</label>
        <div class="content-box">
            <?php echo e($solicitud->contenido); ?>

        </div>
    </div>

</div>
<?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/admin/solicitud/partials/show/details.blade.php ENDPATH**/ ?>