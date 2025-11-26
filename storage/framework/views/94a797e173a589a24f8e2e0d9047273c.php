<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo e(route('inicio')); ?>">
            <img src="<?php echo e(asset('img/logo-oscuro.png')); ?>" alt="Rescatando Mascotas Forever Logo" class="navbar-logo">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
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
    </div>
</nav>

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

            <li class="nav-item dropdown">
                <a class="nav-link second-dropdown-toggle" href="#" id="dropdownMascotas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Mascotas <i class="fas fa-caret-up second-dropdown-arrow"></i>
                </a>
                <ul class="dropdown-menu second-row-menu" aria-labelledby="dropdownMascotas">
                    <li><a class="dropdown-item" href="<?php echo e(route('admin.mascotas.create')); ?>">Reportar</a></li>
                    <li><a class="dropdown-item" href="<?php echo e(route('admin.mascotas.index')); ?>">Buscar</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link second-dropdown-toggle" href="#" id="dropdownRescates" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Rescates <i class="fas fa-caret-up second-dropdown-arrow"></i>
                </a>
                <ul class="dropdown-menu second-row-menu" aria-labelledby="dropdownRescates">
                    <li><a class="dropdown-item" href="#">Acerca de...</a></li>
                    <li><a class="dropdown-item" href="<?php echo e(route('rescates.index')); ?>">Últimos rescates</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link second-dropdown-toggle" href="#" id="dropdownFormularios" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Formularios <i class="fas fa-caret-up second-dropdown-arrow"></i>
                </a>
                <ul class="dropdown-menu second-row-menu" aria-labelledby="dropdownFormularios">
                    <li><a class="dropdown-item" href="<?php echo e(route('adopciones.create')); ?>">Adopción</a></li>
                    <li><a class="dropdown-item" href="<?php echo e(route('rescates.create')); ?>">Rescates</a></li>
                    <li><a class="dropdown-item" href="#">Rescatista</a></li>
                </ul>
            </li>
            
            <li class="nav-item dropdown">
                <a class="nav-link second-dropdown-toggle" href="#" id="dropdownDona" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dona <i class="fas fa-caret-up second-dropdown-arrow"></i>
                </a>
                <ul class="dropdown-menu second-row-menu" aria-labelledby="dropdownDona">
                    <li><a class="dropdown-item" href="<?php echo e(route('donaciones.create')); ?>">Donación única</a></li>
                    <li><a class="dropdown-item" href="#">Suministros</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/layouts/includes/public/navbar.blade.php ENDPATH**/ ?>