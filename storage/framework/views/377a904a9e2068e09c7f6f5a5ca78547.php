<nav class="sidebar-nav">
    <ul class="sidebar-menu">
        <li class="menu-item">
            <a href="<?php echo e(route('dashboard')); ?>" class="menu-link">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        
        <li class="menu-item has-submenu">
            <a href="#" class="menu-link">
                <i class="fas fa-paw"></i>
                <span>Mascotas</span>
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="<?php echo e(route('admin.mascotas.index')); ?>">Todas las Mascotas</a></li>
                <li><a href="<?php echo e(route('admin.mascotas.create')); ?>">Agregar Mascota</a></li>
                <li><a href="#">En Adopción</a></li>
            </ul>
        </li>
        
        <li class="menu-item">
            <a href="<?php echo e(route('adopciones.index')); ?>" class="menu-link">
                <i class="fas fa-hand-holding-heart"></i>
                <span>Adopciones</span>
            </a>
        </li>
        
        <!-- Más items del menú -->
    </ul>
</nav><?php /**PATH C:\Users\Dan\Desktop\Rescatando-mascotas-foreve\resources\views/portals/admin/partials/sidebar/main-menu.blade.php ENDPATH**/ ?>