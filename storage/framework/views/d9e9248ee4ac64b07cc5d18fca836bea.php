<div class="admin-top-navbar">
    <div class="admin-navbar-left">
        <!-- Botón para toggle del sidebar -->
        <button class="sidebar-toggle-btn" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- Logo compacto -->
        <a class="admin-navbar-brand" href="<?php echo e(route('inicio')); ?>">
            <img src="<?php echo e(asset('img/logo-blanco.png')); ?>" alt="Admin Panel" class="admin-navbar-logo">
            <span class="admin-brand-text">Admin</span>
        </a>
    </div>

    <div class="admin-navbar-right">
        <!-- Información del usuario -->
        <div class="admin-user-info">
            <span class="user-name">Hola, <?php echo e(Auth::user()->name ?? 'Admin'); ?></span>
            <span class="user-role">Administrador</span>
        </div>

        <!-- Controles -->
        <?php echo $__env->make('portals.admin.partials.navbar.admin-nav-controls-modern', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/portals/admin/partials/navbar/header-modern.blade.php ENDPATH**/ ?>