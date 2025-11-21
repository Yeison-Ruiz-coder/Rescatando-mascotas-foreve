
<div class="card shadow">
    <div class="card-header fw-bold">
        <i class="fas fa-syringe me-2"></i>Historial de Vacunación
    </div>
    <div class="card-body">
        <?php if($mascota->vacunas && $mascota->vacunas !== 'No especificado'): ?>
            <p class="fs-5 text-success">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo e($mascota->vacunas); ?>

            </p>
        <?php else: ?>
            <p class="text-muted">
                <i class="fas fa-info-circle me-2"></i>
                Aún no se ha registrado el historial de vacunas detallado.
            </p>
        <?php endif; ?>
    </div>
</div><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/admin/mascotas/partials/show/vaccines.blade.php ENDPATH**/ ?>