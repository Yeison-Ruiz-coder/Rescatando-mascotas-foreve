<nav class="navbar navbar-expand-xl custom-navbar" data-bs-theme="dark">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="<?php echo e(route('inicio')); ?>">
            <img src="<?php echo e(asset('img/logo-blanco.png')); ?>" alt="Rescatando Mascotas Forever" class="navbar-logo">
        </a>

        <!-- Botón hamburguesa -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMainContent" aria-controls="navbarMainContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenido principal del navbar -->
        <div class="collapse navbar-collapse" id="navbarMainContent">
            <!-- Menú principal -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link main-link" href="<?php echo e(route('inicio')); ?>">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link main-link" href="<?php echo e(route('reportes.create')); ?>">Reporta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link main-link" href="<?php echo e(route('public.mascotas.index')); ?>">Adopta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link main-link" href="<?php echo e(route('rescates.index')); ?>">Rescates</a>
                </li>

                </li>
                <li class="nav-item">
                    <a class="nav-link main-link" href="<?php echo e(route('public.eventos.index')); ?>">Eventos</a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle main-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Más
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo e(route('suscripciones.create')); ?>">Suscríbete</a></li>
                        <li><a class="dropdown-item" href="<?php echo e(route('donaciones.create')); ?>">Donaciones</a></li>
                        <li><a class="dropdown-item" href="<?php echo e(url('/nosotros')); ?>">Nosotros</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Menú secundario (solo desktop) -->
            <ul class="navbar-nav secondary-menu d-none d-xl-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle secondary-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Rescatistas
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Registrarse</a></li>
                        <li><a class="dropdown-item" href="#">Formulario</a></li>
                        <li><a class="dropdown-item" href="#">Contactos</a></li>
                    </ul>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle secondary-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Rescates
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Acerca de...</a></li>
                        <li><a class="dropdown-item" href="<?php echo e(route('rescates.index')); ?>">Últimos rescates</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle secondary-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Formularios
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo e(route('public.mascotas.index')); ?>">Adopción</a></li>
                        <li><a class="dropdown-item" href="<?php echo e(route('rescates.create')); ?>">Rescates</a></li>
                        <li><a class="dropdown-item" href="#">Rescatista</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Botones de Login y Registro -->
            <div class="navbar-actions ms-3">
                <button class="btn btn-outline-light btn-sm me-2" onclick="window.location.href='<?php echo e(route('login')); ?>'">
                    <i class="fas fa-sign-in-alt me-1"></i>Login
                </button>
                <button class="btn btn-primary btn-sm" onclick="window.location.href='<?php echo e(route('register')); ?>'">
                    <i class="fas fa-user-plus me-1"></i>Registrarse
                </button>
            </div>
        </div>
    </div>
</nav><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/portals/public/partials/navbar/navbar.blade.php ENDPATH**/ ?>