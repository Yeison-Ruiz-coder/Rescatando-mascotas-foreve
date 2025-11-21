<div class="mb-4">
    <h5 class="text-turquesa mb-3 fw-bold">
        <i class="fas fa-heartbeat me-2"></i>Salud y Cuidados
    </h5>
    <div class="estado-vacunas d-flex align-items-center mb-3 p-3">
        <i class="fas fa-syringe text-turquesa me-3 fs-5"></i>
        <div>
            <small class="text-muted d-block">Vacunas</small>
            <strong class="text-turquesa"><?php echo e($mascota->vacunas ?: 'En proceso'); ?></strong>
        </div>
    </div>
    <div class="estado-salud d-flex align-items-center p-3">
        <i class="fas fa-map-marker-alt text-turquesa me-3 fs-5"></i>
        <div>
            <small class="text-muted d-block">Rescatado en</small>
            <strong class="text-turquesa"><?php echo e($mascota->Lugar_rescate); ?></strong>
        </div>
    </div>
</div><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/public/mascotas/partials/show/health-info.blade.php ENDPATH**/ ?>