
<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?><?php /**PATH C:\Users\Juanda\Desktop\Rescatando-mascotas-foreve\resources\views/admin/adopciones/partials/index/alerts.blade.php ENDPATH**/ ?>