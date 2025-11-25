
<div class="card shadow mb-4">
    <div class="card-header fw-bold">
        <i class="fas fa-info-circle me-2"></i>Ficha Técnica
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <strong>Especie:</strong>
            <span class="badge"><?php echo e($mascota->Especie); ?></span>
        </li>
        <li class="list-group-item">
            <strong>Género:</strong>
            <span class="badge"><?php echo e($mascota->Genero); ?></span>
        </li>
        <li class="list-group-item">
            <strong>Lugar de Rescate:</strong> <?php echo e($mascota->Lugar_rescate); ?>

        </li>
        <li class="list-group-item">
            <strong>Fecha de Ingreso:</strong>
            <?php echo e(\Carbon\Carbon::parse($mascota->Fecha_ingreso)->format('d/m/Y')); ?>

        </li>
        <li class="list-group-item">
            <strong>Responsable (Fundación):</strong>
            <?php echo e($mascota->fundacion ? $mascota->fundacion->Nombre_1 : 'No asignada'); ?>

        </li>
    </ul>
</div><?php /**PATH C:\Users\Dan\Desktop\Rescatando-mascotas-foreve\resources\views/admin/mascotas/partials/show/technical-details.blade.php ENDPATH**/ ?>