
<div class="card shadow gestion-card">
    <div class="card-header fw-bold">
        <i class="fas fa-cog me-2"></i>Información de Gestión
    </div>
    <div class="card-body">
        <div class="mb-3">
            <strong>ID de Mascota:</strong>
            <span class="badge bg-secondary"><?php echo e($mascota->id); ?></span>
        </div>
        <div class="mb-3">
            <strong>Fecha de Creación:</strong>
            <br><?php echo e($mascota->created_at->format('d/m/Y H:i')); ?>

        </div>
        <div class="mb-3">
            <strong>Última Actualización:</strong>
            <br><?php echo e($mascota->updated_at->format('d/m/Y H:i')); ?>

        </div>
        <?php if($mascota->Fecha_salida): ?>
            <div class="mb-3">
                <strong>Fecha de Salida:</strong>
                <br><?php echo e(\Carbon\Carbon::parse($mascota->Fecha_salida)->format('d/m/Y')); ?>

            </div>
        <?php endif; ?>

        <div class="d-flex gap-2 mb-4">
            <a href="<?php echo e(route('admin.mascotas.edit', $mascota)); ?>" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>Editar Mascota
            </a>

            
            <form action="<?php echo e(route('admin.mascotas.destroy', $mascota)); ?>" method="POST" class="d-inline">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger"
                    onclick="return confirm('¿Estás seguro de que deseas eliminar a <?php echo e($mascota->Nombre_mascota); ?>? Esta acción no se puede deshacer.')">
                    <i class="fas fa-trash me-2"></i>Eliminar Mascota
                </button>
            </form>
        </div>
    </div>
</div><?php /**PATH C:\Users\Dan\Desktop\Rescatando-mascotas-foreve\resources\views/admin/mascotas/partials/show/management-info.blade.php ENDPATH**/ ?>