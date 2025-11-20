
<header class="admin-header">
    <nav class="navbar navbar-dark bg-dark border-bottom">
        <div class="container-fluid">
            
            <button class="btn btn-dark sidebar-toggle" type="button">
                <i class="fas fa-bars"></i>
            </button>

            
            <a class="navbar-brand mx-auto" href="<?php echo e(route('admin.dashboard')); ?>">
                <img src="<?php echo e(asset('img/logo-admin.png')); ?>" alt="Admin Logo" height="30" class="d-inline-block align-text-top me-2">
                <span class="d-none d-md-inline">Panel Administrativo</span>
            </a>

            
            <div class="navbar-nav ms-auto">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i>
                        <span class="d-none d-md-inline"><?php echo e(Auth::user()->name); ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?php echo e(route('perfil.edit')); ?>"><i class="fas fa-user me-2"></i>Mi Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/partials/admin/header.blade.php ENDPATH**/ ?>