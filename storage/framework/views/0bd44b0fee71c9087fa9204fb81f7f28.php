<div class="navbar-profile dropdown">
    <a href="#" class="profile-icon-link" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="<?php echo e(asset('img/perfil.png')); ?>" alt="Perfil" class="profile-icon">
        <i class="fas fa-caret-down profile-arrow"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end profile-dropdown" aria-labelledby="profileDropdown">
        <li><a class="dropdown-item" href="<?php echo e(route('usuarios.edit', Auth::user()->id ?? 0)); ?>">
            <i class="fas fa-user-edit me-2"></i>Editar perfil
        </a></li>
        <li><a class="dropdown-item" href="#">
            <i class="fas fa-camera me-2"></i>Cambiar foto
        </a></li>
        <li><a class="dropdown-item" href="#">
            <i class="fas fa-lock me-2"></i>Cambiar contraseña
        </a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="dropdown-item">
                    <i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión
                </button>
            </form>
        </li>
    </ul>
</div><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/portals/admin/partials/navbar/admin-nav-controls-modern.blade.php ENDPATH**/ ?>