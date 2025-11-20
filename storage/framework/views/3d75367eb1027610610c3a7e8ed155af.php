
<div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mx-auto first-row-nav">
        <li class="nav-item">
            <a class="nav-link main-btn" href="<?php echo e(route('inicio')); ?>">INICIO</a>
        </li>
        <li class="nav-item">
            <a class="nav-link main-btn" href="<?php echo e(route('reportes.create')); ?>">REPORTA</a> 
        </li>
        <li class="nav-item">
            <a class="nav-link main-btn" href="<?php echo e(route('mascotas.public.index')); ?>">ADOPTA</a>
        </li>
        <li class="nav-item">
            <a class="nav-link main-btn" href="<?php echo e(route('rescates.index')); ?>">RESCATA</a>
        </li>
        <li class="nav-item">
            <a class="nav-link main-btn" href="<?php echo e(route('solicitudes.index')); ?>">SOLICITUDES</a>
        </li>
        <li class="nav-item">
            <a class="nav-link main-btn" href="<?php echo e(route('suscripciones.create')); ?>">SUSCRÍBETE</a>
        </li>
        <li class="nav-item">
            <a class="nav-link main-btn" href="<?php echo e(url('/nosotros')); ?>">NOSOTROS</a>
        </li>
    </ul>
    
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
    </div>
</div>


<div class="second-row-nav-wrapper">
    <div class="container-fluid">
        <ul class="nav second-row-nav">
            
            <li class="nav-item dropdown">
                <a class="nav-link second-dropdown-toggle" href="#" id="dropdownRescatistas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Rescatistas <i class="fas fa-caret-up second-dropdown-arrow"></i>
                </a>
                <ul class="dropdown-menu second-row-menu" aria-labelledby="dropdownRescatistas">
                    <li><a class="dropdown-item" href="#">Registrarse</a></li>
                    <li><a class="dropdown-item" href="#">Formulario</a></li>
                    <li><a class="dropdown-item" href="#">Contactos</a></li>
                </ul>
            </li>
            
        </ul>
    </div>
</div><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/partials/public/navigation.blade.php ENDPATH**/ ?>