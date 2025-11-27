<!-- Header Admin Unificado -->
<header class="am-glass-header">
    <!-- Header Principal -->
    <div class="am-header-main">
        <div class="container-fluid">
            <div class="am-header-content">
                <!-- Logo Animado -->
                <div class="am-logo-section">
                    <a href="{{ route('dashboard') }}" class="am-logo-container am-floating">
                        <div class="am-logo-icon">
                            <i class="fas fa-paw"></i>
                        </div>
                        <span class="am-logo-text">Admin Mascotas</span>
                        <div class="am-logo-sparkle">
                            <i class="fas fa-sparkle"></i>
                        </div>
                    </a>
                </div>

                <!-- Navegación Principal Mejorada -->
                <nav class="am-main-nav">
                    <div class="am-nav-container">
                        <ul class="am-nav-links">
                            <li class="am-nav-item">
                                <a href="{{ route('dashboard') }}" class="am-nav-link {{ request()->routeIs('admin.dashboard') ? 'am-active' : '' }}" data-text="Dashboard">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Dashboard</span>
                                    <div class="am-link-underline"></div>
                                </a>
                            </li>
                           
                            <li class="am-nav-item">
                                <a href="{{ route('admin.mascotas.index') }}" class="am-nav-link {{ request()->routeIs('admin.mascotas.*') ? 'am-active' : '' }}" data-text="Mascotas">
                                    <i class="fas fa-paw"></i>
                                    <span>Mascotas</span>
                                    <div class="am-link-underline"></div>
                                </a>
                            </li>

                            <li class="am-nav-item">
                                <a href="{{ route('admin.adopciones.index') }}" class="am-nav-link {{ request()->routeIs('admin.adopciones.*') ? 'am-active' : '' }}" data-text="Adopciones">
                                    <i class="fas fa-heart"></i>
                                    <span>Adopciones</span>
                                    <div class="am-link-underline"></div>
                                </a>
                            </li>

                            <li class="am-nav-item">
                                <a href="{{ route('solicitud.index') }}" class="am-nav-link {{ request()->routeIs('solicitud.*') ? 'am-active' : '' }}" data-text="Solicitudes">
                                    <i class="fas fa-clipboard-list"></i>
                                    <span>Solicitudes</span>
                                    <div class="am-link-underline"></div>
                                </a>
                            </li>

                            <li class="am-nav-item">
                                <a href="{{ route('suscripciones.index') }}" class="am-nav-link {{ request()->routeIs('admin.suscripciones.*') ? 'am-active' : '' }}" data-text="Suscripciones">
                                    <i class="fas fa-star"></i>
                                    <span>Suscripciones</span>
                                    <div class="am-link-underline"></div>
                                </a>
                            </li>
                           
                            <li class="am-nav-item">
                                <a href="{{ route('donaciones.index') }}" class="am-nav-link am-donate-btn {{ request()->routeIs('admin.donaciones.*') ? 'am-active' : '' }}" data-text="Donaciones">
                                    <i class="fas fa-hand-holding-heart"></i>    
                                    <span>Donaciones</span>
                                    <div class="am-pulse-effect"></div>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Usuario Mejorado -->
                    <div class="am-user-section">
                        <div class="am-user-container am-floating" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <div class="am-user-avatar">
                                <i class="fas fa-user-shield"></i>
                                <div class="am-user-glow"></div>
                            </div>
                            <div class="am-user-info">
                                <span class="am-user-name">Administrador</span>
                                <span class="am-user-status">Conectado</span>
                            </div>
                            <div class="am-user-indicator">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Menú Hamburguesa para móviles -->
                    <div class="am-mobile-toggle">
                        <div class="am-hamburger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <!-- Header Bottom - Submenú -->
    <div class="am-header-bottom">
        <div class="container-fluid">
            <div class="am-sub-nav-container">
                <ul class="am-sub-menu">
                    <li class="am-sub-item am-dropdown">
                        <div class="am-sub-link">
                            <i class="fas fa-users"></i>
                            <span>Usuarios</span>
                            <i class="fas fa-chevron-down am-dropdown-arrow"></i>
                        </div>
                        <div class="am-glass-dropdown">
                            <a href="{{ route('usuarios.index') }}" class="am-dropdown-item">
                                <i class="fas fa-list"></i>
                                <span>Ver Usuarios</span>
                            </a>
                            <a href="{{ route('usuarios.create') }}" class="am-dropdown-item">
                                <i class="fas fa-user-plus"></i>
                                <span>Registrar Usuario</span>
                            </a>
                            <a href="{{ route('administradores.index') }}" class="am-dropdown-item">
                                <i class="fas fa-user-shield"></i>
                                <span>Administradores</span>
                            </a>
                        </div>
                    </li>

                    <li class="am-sub-item am-dropdown">
                        <div class="am-sub-link">
                            <i class="fas fa-paw"></i>
                            <span>Mascotas</span>
                            <i class="fas fa-chevron-down am-dropdown-arrow"></i>
                        </div>
                        <div class="am-glass-dropdown">
                            <a href="{{ route('admin.mascotas.index') }}" class="am-dropdown-item">
                                <i class="fas fa-list"></i>
                                <span>Ver Mascotas</span>
                            </a>
                            <a href="{{ route('admin.mascotas.create') }}" class="am-dropdown-item">
                                <i class="fas fa-plus-circle"></i>
                                <span>Registrar Mascota</span>
                            </a>
                            <a href="{{ route('razas.index') }}" class="am-dropdown-item">
                                <i class="fas fa-dna"></i>
                                <span>Razas</span>
                            </a>
                        </div>
                    </li>

                    <li class="am-sub-item am-dropdown">
                        <div class="am-sub-link">
                            <i class="fas fa-first-aid"></i>
                            <span>Rescates & Salud</span>
                            <i class="fas fa-chevron-down am-dropdown-arrow"></i>
                        </div>
                        <div class="am-glass-dropdown">
                            <a href="{{ route('rescates.index') }}" class="am-dropdown-item">
                                <i class="fas fa-list"></i>
                                <span>Ver Rescates</span>
                            </a>
                            <a href="{{ route('rescates.create') }}" class="am-dropdown-item">
                                <i class="fas fa-plus"></i>
                                <span>Nuevo Rescate</span>
                            </a>
                            <a href="{{ route('veterinarias.index') }}" class="am-dropdown-item">
                                <i class="fas fa-clinic-medical"></i>
                                <span>Veterinarias</span>
                            </a>
                            <a href="{{ route('tipos-vacunas.index') }}" class="am-dropdown-item">
                                <i class="fas fa-syringe"></i>
                                <span>Tipos de Vacunas</span>
                            </a>
                        </div>
                    </li>

                    <li class="am-sub-item am-dropdown">
                        <div class="am-sub-link">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Eventos</span>
                            <i class="fas fa-chevron-down am-dropdown-arrow"></i>
                        </div>
                        <div class="am-glass-dropdown">
                            <a href="{{ route('admin.eventos.index') }}" class="am-dropdown-item">
                                <i class="fas fa-list"></i>
                                <span>Ver Eventos</span>
                            </a>
                            <a href="{{ route('admin.eventos.create') }}" class="am-dropdown-item">
                                <i class="fas fa-plus"></i>
                                <span>Crear Evento</span>
                            </a>
                        </div>
                    </li>

                    <li class="am-sub-item am-dropdown">
                        <div class="am-sub-link">
                            <i class="fas fa-chart-bar"></i>
                            <span>Reportes</span>
                            <i class="fas fa-chevron-down am-dropdown-arrow"></i>
                        </div>
                        <div class="am-glass-dropdown">
                            <a href="{{ route('reportes.index') }}" class="am-dropdown-item">
                                <i class="fas fa-list"></i>
                                <span>Ver Reportes</span>
                            </a>
                            <a href="{{ route('reportes.create') }}" class="am-dropdown-item">
                                <i class="fas fa-plus"></i>
                                <span>Crear Reporte</span>
                            </a>
                        </div>
                    </li>

                    <li class="am-sub-item">
                        <a href="{{ route('inicio') }}" class="am-sub-link am-donate-cta" target="_blank">
                            <i class="fas fa-external-link-alt"></i>
                            <span>Ir al Sitio Público</span>
                            <div class="am-pulse-effect"></div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function setHeaderSpace() {
        const header = document.querySelector('.am-glass-header');
        if (header) {
            let headerHeight = header.offsetHeight;
            
            // AJUSTES MANUALES - MODIFICA ESTOS VALORES
            const minHeight = 120;   // Altura mínima en px
            const maxHeight = 180;   // Altura máxima en px
            const extraSpace = 10;   // Espacio extra adicional
            
            // Aplicar límites
            headerHeight = Math.max(minHeight, Math.min(headerHeight, maxHeight));
            
            // Agregar espacio extra si quieres
            const totalSpace = headerHeight + extraSpace;
            
            // Aplicar al body
            document.body.style.paddingTop = totalSpace + 'px';
            
            console.log('Header height:', headerHeight, 'Total space:', totalSpace);
        }
    }

    setHeaderSpace();
    window.addEventListener('resize', setHeaderSpace);
});
</script>