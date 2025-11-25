<div class="navbar-profile dropdown">
    <a href="#" class="profile-icon-link" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="<?php echo e(asset('img/perfil.png')); ?>" alt="Perfil" class="profile-icon">
    </a>
    <ul class="dropdown-menu dropdown-menu-end profile-dropdown" aria-labelledby="profileDropdown">
        <li><a class="dropdown-item" href="<?php echo e(route('usuarios.edit', Auth::user()->id ?? 0)); ?>">Editar perfil</a></li>
        <li><a class="dropdown-item" href="#">Cambiar foto</a></li>
        <li><a class="dropdown-item" href="#">Cambiar contraseña</a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="dropdown-item">Cerrar sesión</button>
            </form>
        </li>
    </ul>
</div><?php /**PATH C:\Users\Dan\Desktop\Rescatando-mascotas-foreve\resources\views/portals/admin/partials/navbar/profile-dropdown.blade.php ENDPATH**/ ?>