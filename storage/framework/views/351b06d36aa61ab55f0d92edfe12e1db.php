<div class="sidebar-user">
    <div class="user-avatar">
        <img src="<?php echo e(Auth::user()->avatar ?? asset('img/perfil-usuario.png')); ?>" alt="User Avatar">
    </div>
    <div class="user-info">
        <div class="user-name"><?php echo e(Auth::user()->name ?? 'Administrador'); ?></div>
        <div class="user-role"><?php echo e(Auth::user()->role ?? 'Admin'); ?></div>
    </div>
</div><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/portals/admin/partials/sidebar/user-info.blade.php ENDPATH**/ ?>