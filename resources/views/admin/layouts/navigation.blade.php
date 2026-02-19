<!-- Menú Lateral -->
<nav class="side-menu" id="sideMenu">
    <div class="menu-header">
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="user-details">
                <h5>{{ auth()->user()->name ?? 'Administrador' }}</h5>
                <span class="user-role">Admin</span>
            </div>
        </div>
        <button class="close-menu" id="closeMenu">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="menu-search">
        <i class="fas fa-search"></i>
        <input type="text" id="menuSearch" placeholder="Buscar en el panel...">
    </div>

    <div class="menu-sections">
        <!-- Dashboard -->
        <div class="menu-section">
            <a href="{{ route('admin.dashboard.index') }}" class="menu-item {{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </div>

        <!-- Mascotas -->
        <div class="menu-section">
            <div class="menu-item has-submenu {{ request()->routeIs('admin.mascotas.*') ? 'active' : '' }}">
                <i class="fas fa-paw"></i>
                <span>Mascotas</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="submenu">
                <a href="{{ route('admin.mascotas.index') }}" class="submenu-item">
                    <i class="fas fa-list"></i> Todas las Mascotas
                </a>
                <a href="{{ route('admin.mascotas.create') }}" class="submenu-item">
                    <i class="fas fa-plus-circle"></i> Registrar Mascota
                </a>
                <a href="{{ route('admin.rescates.index') }}" class="submenu-item">
                    <i class="fas fa-ambulance"></i> Rescates
                </a>
                <a href="{{ route('admin.razas.index') }}" class="submenu-item">
                    <i class="fas fa-dna"></i> Razas
                </a>
                <a href="{{ route('admin.veterinarias.index') }}" class="submenu-item">
                    <i class="fas fa-clinic-medical"></i> Veterinarias
                </a>
            </div>
        </div>

        <!-- Adopciones -->
        <div class="menu-section">
            <div class="menu-item has-submenu {{ request()->routeIs('admin.adopciones.*') ? 'active' : '' }}">
                <i class="fas fa-heart"></i>
                <span>Adopciones</span>
                <i class="fas fa-chevron-right arrow"></i>
                @php $solicitudesPendientes = 5; @endphp
                @if($solicitudesPendientes > 0)
                    <span class="menu-badge">{{ $solicitudesPendientes }}</span>
                @endif
            </div>
            <div class="submenu">
                <a href="{{ route('admin.adopciones.index') }}" class="submenu-item">
                    <i class="fas fa-list"></i> Todas las Adopciones
                </a>
                <a href="{{ route('admin.solicitudes.index') }}" class="submenu-item">
                    <i class="fas fa-clipboard-list"></i> Solicitudes
                    @if($solicitudesPendientes > 0)
                        <span class="badge bg-danger">{{ $solicitudesPendientes }}</span>
                    @endif
                </a>
            </div>
        </div>

        <!-- Finanzas -->
        <div class="menu-section">
            <div class="menu-item has-submenu">
                <i class="fas fa-hand-holding-heart"></i>
                <span>Donaciones</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="submenu">
                <a href="{{ route('admin.donaciones.index') }}" class="submenu-item">
                    <i class="fas fa-list"></i> Ver Donaciones
                </a>
                <a href="{{ route('admin.donaciones.reportes') }}" class="submenu-item">
                    <i class="fas fa-chart-line"></i> Reportes
                </a>
            </div>
        </div>

        <!-- Suscripciones -->
        <div class="menu-section">
            <div class="menu-item has-submenu">
                <i class="fas fa-star"></i>
                <span>Apadrinamientos</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="submenu">
                <a href="{{ route('admin.apadrinamientos.index') }}" class="submenu-item">
                    <i class="fas fa-list"></i> Ver Apadrinamientos
                </a>
            </div>
        </div>

        <!-- Eventos -->
        <div class="menu-section">
            <div class="menu-item has-submenu">
                <i class="fas fa-calendar-alt"></i>
                <span>Eventos</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="submenu">
                <a href="{{ route('admin.eventos.index') }}" class="submenu-item">
                    <i class="fas fa-list"></i> Todos los Eventos
                </a>
                <a href="{{ route('admin.eventos.create') }}" class="submenu-item">
                    <i class="fas fa-plus"></i> Crear Evento
                </a>
                <a href="{{ route('admin.eventos.calendar') }}" class="submenu-item">
                    <i class="fas fa-calendar"></i> Calendario
                </a>
            </div>
        </div>

        <!-- Reportes -->
        <div class="menu-section">
            <div class="menu-item has-submenu">
                <i class="fas fa-chart-bar"></i>
                <span>Reportes</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="submenu">
                <a href="{{ route('admin.reportes.index') }}" class="submenu-item">
                    <i class="fas fa-list"></i> Todos los Reportes
                </a>
                <a href="{{ route('admin.reportes.generales') }}" class="submenu-item">
                    <i class="fas fa-chart-pie"></i> Reportes Generales
                </a>
                <a href="{{ route('admin.reportes.exportar') }}" class="submenu-item">
                    <i class="fas fa-file-export"></i> Exportar Datos
                </a>
            </div>
        </div>

        <!-- Tienda -->
        <div class="menu-section">
            <div class="menu-item has-submenu">
                <i class="fas fa-store"></i>
                <span>Tienda</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="submenu">
                <a href="{{ route('admin.tiendas.index') }}" class="submenu-item">
                    <i class="fas fa-box"></i> Productos
                </a>
                <a href="{{ route('admin.tiendas.ventas') }}" class="submenu-item">
                    <i class="fas fa-shopping-cart"></i> Ventas
                </a>
                <a href="{{ route('admin.tiendas.inventario') }}" class="submenu-item">
                    <i class="fas fa-warehouse"></i> Inventario
                </a>
            </div>
        </div>

        <!-- Fundaciones -->
        <div class="menu-section">
            <a href="{{ route('admin.fundaciones.index') }}" class="menu-item">
                <i class="fas fa-building"></i>
                <span>Fundaciones</span>
            </a>
        </div>

        <!-- Notificaciones -->
        <div class="menu-section">
            <a href="{{ route('admin.notificaciones.index') }}" class="menu-item">
                <i class="fas fa-bell"></i>
                <span>Notificaciones</span>
                @php $notificacionesNoLeidas = 3; @endphp
                @if($notificacionesNoLeidas > 0)
                    <span class="menu-badge">{{ $notificacionesNoLeidas }}</span>
                @endif
            </a>
        </div>

        <!-- Comentarios -->
        <div class="menu-section">
            <a href="{{ route('admin.comentarios.index') }}" class="menu-item">
                <i class="fas fa-comments"></i>
                <span>Comentarios</span>
                @php $comentariosPendientes = 2; @endphp
                @if($comentariosPendientes > 0)
                    <span class="menu-badge">{{ $comentariosPendientes }}</span>
                @endif
            </a>
        </div>
    </div>

    <!-- Footer del menú -->
    <div class="menu-footer">
        <a href="{{ route('admin.configuracion') }}" class="menu-item">
            <i class="fas fa-cog"></i>
            <span>Configuración</span>
        </a>
        <a href="{{ route('logout') }}" class="menu-item text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Cerrar Sesión</span>
        </a>
    </div>
</nav>
