<ul class="navbar-nav mx-auto admin-main-menu-modern">
    <li class="nav-item">
        <a class="nav-link admin-nav-link-modern <?php echo e(request()->routeIs('inicio') ? 'active' : ''); ?>" href="<?php echo e(route('inicio')); ?>">
            <i class="fas fa-home"></i>
            <span>Inicio</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link admin-nav-link-modern <?php echo e(request()->routeIs('reportes.*') ? 'active' : ''); ?>" href="<?php echo e(route('reportes.create')); ?>">
            <i class="fas fa-flag"></i>
            <span>Reporta</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link admin-nav-link-modern <?php echo e(request()->routeIs('adopciones.*') ? 'active' : ''); ?>" href="<?php echo e(route('adopciones.index')); ?>">
            <i class="fas fa-paw"></i>
            <span>Adopta</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link admin-nav-link-modern <?php echo e(request()->routeIs('rescates.*') ? 'active' : ''); ?>" href="<?php echo e(route('rescates.index')); ?>">
            <i class="fas fa-heart"></i>
            <span>Rescata</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link admin-nav-link-modern <?php echo e(request()->routeIs('solicitudes.*') ? 'active' : ''); ?>" href="<?php echo e(route('solicitudes.index')); ?>">
            <i class="fas fa-clipboard-list"></i>
            <span>Solicitudes</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link admin-nav-link-modern <?php echo e(request()->routeIs('suscripciones.*') ? 'active' : ''); ?>" href="<?php echo e(route('suscripciones.create')); ?>">
            <i class="fas fa-bell"></i>
            <span>Suscríbete</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link admin-nav-link-modern <?php echo e(request()->is('nosotros') ? 'active' : ''); ?>" href="<?php echo e(url('/nosotros')); ?>">
            <i class="fas fa-users"></i>
            <span>Nosotros</span>
        </a>
    </li>
</ul><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/portals/admin/partials/navbar/main-menu-modern.blade.php ENDPATH**/ ?>