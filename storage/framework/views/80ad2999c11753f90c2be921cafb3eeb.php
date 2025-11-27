<div class="sidebar-footer">
    <div class="version-info">
        v1.0.0
    </div>
    <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </button>
    </form>
</div><?php /**PATH C:\Users\Juanda\Desktop\Rescatando-mascotas-foreve\resources\views/portals/admin/partials/sidebar/footer.blade.php ENDPATH**/ ?>