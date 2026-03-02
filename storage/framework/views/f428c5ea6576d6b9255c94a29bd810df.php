

<!-- Sidebar Público -->
<aside class="public-sidebar" id="publicSidebar">

    
    <div class="public-sidebar-header">
        <div class="public-sidebar-user">
            <div class="public-sidebar-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="public-sidebar-user-info">
                <h5>Invitado</h5>
                <span class="public-sidebar-user-role">Bienvenido</span>
            </div>
        </div>
        <button class="public-sidebar-close" id="publicSidebarClose">
            <i class="fas fa-times"></i>
        </button>
    </div>

    
    <div class="public-sidebar-search">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Buscar en el menú..." id="publicSidebarSearch">
    </div>

    
    <nav class="public-sidebar-nav">

        
        <div class="public-sidebar-section">
            <div class="public-section-title">
                <i class="fas fa-exclamation-triangle me-1"></i> ALERTAS Y RESCATES
            </div>

            
            <a href="<?php echo e(url('/rescates')); ?>" class="public-sidebar-item public-rescate-item <?php echo e(request()->is('rescates*') ? 'active' : ''); ?>">
                <i class="fas fa-paw"></i>
                <span>Reportar Rescate</span>
                <span class="public-sidebar-badge">URGENTE</span>
            </a>

            
            <a href="<?php echo e(url('/rescates/activos')); ?>" class="public-sidebar-subitem <?php echo e(request()->is('rescates/activos') ? 'active' : ''); ?>">
                <i class="fas fa-map-marker-alt"></i>
                <span>Rescates activos</span>
            </a>

            
            <a href="<?php echo e(url('/rescates/historial')); ?>" class="public-sidebar-subitem <?php echo e(request()->is('rescates/historial') ? 'active' : ''); ?>">
                <i class="fas fa-history"></i>
                <span>Mi historial</span>
            </a>

            
            <a href="<?php echo e(url('/reportes')); ?>" class="public-sidebar-item <?php echo e(request()->is('reportes*') ? 'active' : ''); ?>">
                <i class="fas fa-file-alt"></i>
                <span>Reportes generales</span>
            </a>
        </div>

        
        <div class="public-sidebar-section">
            <div class="public-section-title">
                <i class="fas fa-dog me-1"></i> MASCOTAS
            </div>

            
            <a href="<?php echo e(url('/mascotas')); ?>" class="public-sidebar-item <?php echo e(request()->is('mascotas*') ? 'active' : ''); ?>">
                <i class="fas fa-dog"></i>
                <span>Mascotas</span>
            </a>

            
            <div class="public-sidebar-item has-submenu <?php echo e(request()->is('adopciones*') ? 'open' : ''); ?>">
                <i class="fas fa-home"></i>
                <span>Adopciones</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="public-sidebar-submenu <?php echo e(request()->is('adopciones*') ? 'open' : ''); ?>">
                <a href="<?php echo e(url('/adopciones/disponibles')); ?>" class="public-sidebar-subitem <?php echo e(request()->is('adopciones/disponibles') ? 'active' : ''); ?>">
                    <i class="fas fa-list"></i>
                    <span>Disponibles</span>
                </a>
                <a href="<?php echo e(url('/adopciones/solicitudes')); ?>" class="public-sidebar-subitem <?php echo e(request()->is('adopciones/solicitudes') ? 'active' : ''); ?>">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Mis solicitudes</span>
                </a>
                <a href="<?php echo e(url('/adopciones/proceso')); ?>" class="public-sidebar-subitem <?php echo e(request()->is('adopciones/proceso') ? 'active' : ''); ?>">
                    <i class="fas fa-clock"></i>
                    <span>En proceso</span>
                </a>
            </div>

            
            <a href="<?php echo e(url('/apadrinamientos')); ?>" class="public-sidebar-item <?php echo e(request()->is('apadrinamientos*') ? 'active' : ''); ?>">
                <i class="fas fa-heart"></i>
                <span>Apadrinamientos</span>
            </a>
        </div>

        
        <div class="public-sidebar-section">
            <div class="public-section-title">
                <i class="fas fa-hand-holding-heart me-1"></i> COLABORACIÓN
            </div>

            
            <a href="<?php echo e(url('/donaciones')); ?>" class="public-sidebar-item <?php echo e(request()->is('donaciones*') ? 'active' : ''); ?>">
                <i class="fas fa-donate"></i>
                <span>Donaciones</span>
            </a>

            
            <a href="<?php echo e(url('/suscripciones')); ?>" class="public-sidebar-item <?php echo e(request()->is('suscripciones*') ? 'active' : ''); ?>">
                <i class="fas fa-calendar-check"></i>
                <span>Suscripciones</span>
            </a>

            
            <a href="<?php echo e(url('/eventos')); ?>" class="public-sidebar-item <?php echo e(request()->is('eventos*') ? 'active' : ''); ?>">
                <i class="fas fa-calendar-alt"></i>
                <span>Eventos</span>
            </a>
        </div>

        
        <div class="public-sidebar-section">
            <div class="public-section-title">
                <i class="fas fa-store me-1"></i> SERVICIOS
            </div>

            
            <a href="<?php echo e(url('/tiendas')); ?>" class="public-sidebar-item <?php echo e(request()->is('tiendas*') ? 'active' : ''); ?>">
                <i class="fas fa-store"></i>
                <span>Tiendas</span>
            </a>

            
            <div class="public-sidebar-item has-submenu <?php echo e(request()->is('veterinarias*') ? 'open' : ''); ?>">
                <i class="fas fa-clinic-medical"></i>
                <span>Veterinarias</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="public-sidebar-submenu <?php echo e(request()->is('veterinarias*') ? 'open' : ''); ?>">
                <a href="<?php echo e(url('/veterinarias')); ?>" class="public-sidebar-subitem <?php echo e(request()->is('veterinarias') ? 'active' : ''); ?>">
                    <i class="fas fa-list"></i>
                    <span>Todas</span>
                </a>
                <a href="<?php echo e(url('/veterinarias/urgencias')); ?>" class="public-sidebar-subitem <?php echo e(request()->is('veterinarias/urgencias') ? 'active' : ''); ?>">
                    <i class="fas fa-ambulance"></i>
                    <span>Urgencias 24/7</span>
                    <span class="badge bg-danger">24h</span>
                </a>
                <a href="<?php echo e(url('/veterinarias/mapa')); ?>" class="public-sidebar-subitem <?php echo e(request()->is('veterinarias/mapa') ? 'active' : ''); ?>">
                    <i class="fas fa-map"></i>
                    <span>Ver mapa</span>
                </a>
            </div>
        </div>

        
        <div class="public-sidebar-section">
            <div class="public-section-title">
                <i class="fas fa-users me-1"></i> COMUNIDAD
            </div>

            
            <a href="<?php echo e(url('/fundaciones')); ?>" class="public-sidebar-item <?php echo e(request()->is('fundaciones*') ? 'active' : ''); ?>">
                <i class="fas fa-building"></i>
                <span>Fundaciones</span>
            </a>

            
            <a href="<?php echo e(url('/usuarios')); ?>" class="public-sidebar-item <?php echo e(request()->is('usuarios*') ? 'active' : ''); ?>">
                <i class="fas fa-users"></i>
                <span>Usuarios</span>
            </a>

            
            <a href="<?php echo e(url('/comentarios')); ?>" class="public-sidebar-item <?php echo e(request()->is('comentarios*') ? 'active' : ''); ?>">
                <i class="fas fa-comments"></i>
                <span>Comentarios</span>
            </a>
        </div>

        
        <div class="public-sidebar-section">
            <div class="public-section-title">
                <i class="fas fa-info-circle me-1"></i> INFORMACIÓN
            </div>

            
            <a href="<?php echo e(url('/nosotros')); ?>" class="public-sidebar-item <?php echo e(request()->is('nosotros') ? 'active' : ''); ?>">
                <i class="fas fa-info-circle"></i>
                <span>Nosotros</span>
            </a>

            
            <a href="<?php echo e(url('/notificaciones')); ?>" class="public-sidebar-item <?php echo e(request()->is('notificaciones*') ? 'active' : ''); ?>">
                <i class="fas fa-bell"></i>
                <span>Notificaciones</span>
                <?php
                    $notificacionesNoLeidas = 3; // Esto vendría de tu controlador
                ?>
                <?php if($notificacionesNoLeidas > 0): ?>
                    <span class="public-sidebar-badge"><?php echo e($notificacionesNoLeidas); ?></span>
                <?php endif; ?>
            </a>

            
            <a href="<?php echo e(url('/blog')); ?>" class="public-sidebar-item <?php echo e(request()->is('blog*') ? 'active' : ''); ?>">
                <i class="fas fa-newspaper"></i>
                <span>Blog</span>
            </a>

            
            <a href="<?php echo e(url('/faq')); ?>" class="public-sidebar-item <?php echo e(request()->is('faq') ? 'active' : ''); ?>">
                <i class="fas fa-question-circle"></i>
                <span>FAQ</span>
            </a>
        </div>
    </nav>

    
    <div class="public-sidebar-footer">
        
        <a href="<?php echo e(url('/contacto')); ?>" class="public-sidebar-item">
            <i class="fas fa-envelope"></i>
            <span>Contacto</span>
        </a>

        
        <a href="<?php echo e(url('/terminos')); ?>" class="public-sidebar-item">
            <i class="fas fa-file-contract"></i>
            <span>Términos y condiciones</span>
        </a>

        
        <a href="<?php echo e(url('/privacidad')); ?>" class="public-sidebar-item">
            <i class="fas fa-shield-alt"></i>
            <span>Política de privacidad</span>
        </a>

        
        <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(url('/logout')); ?>" class="public-sidebar-item text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Cerrar sesión</span>
        </a>
        <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" class="d-none">
            <?php echo csrf_field(); ?>
        </form>
        <?php endif; ?>
    </div>
</aside>


<div class="public-sidebar-overlay" id="publicSidebarOverlay"></div>
<?php /**PATH C:\xampp\htdocs\Rescatando-mascotas-foreve\resources\views/public/layouts/navigation.blade.php ENDPATH**/ ?>