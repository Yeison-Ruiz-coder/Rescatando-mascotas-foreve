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
</div><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/portals/admin/partials/navbar/admin-breadcrumb-modern.blade.php ENDPATH**/ ?>