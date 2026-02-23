{{-- resources/views/public/partials/sidebar/public-sidebar.blade.php --}}

<!-- Sidebar Público -->
<aside class="public-sidebar" id="publicSidebar">
    
    {{-- Header del Sidebar --}}
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

    {{-- Buscador rápido --}}
    <div class="public-sidebar-search">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Buscar en el menú..." id="publicSidebarSearch">
    </div>

    {{-- Navegación Principal --}}
    <nav class="public-sidebar-nav">
        
        {{-- SECCIÓN 1: ALERTAS Y RESCATES --}}
        <div class="public-sidebar-section">
            <div class="public-section-title">
                <i class="fas fa-exclamation-triangle me-1"></i> ALERTAS Y RESCATES
            </div>
            
            {{-- Rescates - Item destacado --}}
            <a href="{{ url('/rescates') }}" class="public-sidebar-item public-rescate-item {{ request()->is('rescates*') ? 'active' : '' }}">
                <i class="fas fa-paw"></i>
                <span>Reportar Rescate</span>
                <span class="public-sidebar-badge">URGENTE</span>
            </a>
            
            {{-- Rescates activos --}}
            <a href="{{ url('/rescates/activos') }}" class="public-sidebar-subitem {{ request()->is('rescates/activos') ? 'active' : '' }}">
                <i class="fas fa-map-marker-alt"></i>
                <span>Rescates activos</span>
            </a>
            
            {{-- Mi historial de reportes --}}
            <a href="{{ url('/rescates/historial') }}" class="public-sidebar-subitem {{ request()->is('rescates/historial') ? 'active' : '' }}">
                <i class="fas fa-history"></i>
                <span>Mi historial</span>
            </a>
            
            {{-- Reportes --}}
            <a href="{{ url('/reportes') }}" class="public-sidebar-item {{ request()->is('reportes*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i>
                <span>Reportes generales</span>
            </a>
        </div>

        {{-- SECCIÓN 2: MASCOTAS --}}
        <div class="public-sidebar-section">
            <div class="public-section-title">
                <i class="fas fa-dog me-1"></i> MASCOTAS
            </div>
            
            {{-- Mascotas --}}
            <a href="{{ url('/mascotas') }}" class="public-sidebar-item {{ request()->is('mascotas*') ? 'active' : '' }}">
                <i class="fas fa-dog"></i>
                <span>Mascotas</span>
            </a>
            
            {{-- Adopciones con submenú --}}
            <div class="public-sidebar-item has-submenu {{ request()->is('adopciones*') ? 'open' : '' }}">
                <i class="fas fa-home"></i>
                <span>Adopciones</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="public-sidebar-submenu {{ request()->is('adopciones*') ? 'open' : '' }}">
                <a href="{{ url('/adopciones/disponibles') }}" class="public-sidebar-subitem {{ request()->is('adopciones/disponibles') ? 'active' : '' }}">
                    <i class="fas fa-list"></i>
                    <span>Disponibles</span>
                </a>
                <a href="{{ url('/adopciones/solicitudes') }}" class="public-sidebar-subitem {{ request()->is('adopciones/solicitudes') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Mis solicitudes</span>
                </a>
                <a href="{{ url('/adopciones/proceso') }}" class="public-sidebar-subitem {{ request()->is('adopciones/proceso') ? 'active' : '' }}">
                    <i class="fas fa-clock"></i>
                    <span>En proceso</span>
                </a>
            </div>
            
            {{-- Apadrinamientos --}}
            <a href="{{ url('/apadrinamientos') }}" class="public-sidebar-item {{ request()->is('apadrinamientos*') ? 'active' : '' }}">
                <i class="fas fa-heart"></i>
                <span>Apadrinamientos</span>
            </a>
        </div>

        {{-- SECCIÓN 3: COLABORACIÓN --}}
        <div class="public-sidebar-section">
            <div class="public-section-title">
                <i class="fas fa-hand-holding-heart me-1"></i> COLABORACIÓN
            </div>
            
            {{-- Donaciones --}}
            <a href="{{ url('/donaciones') }}" class="public-sidebar-item {{ request()->is('donaciones*') ? 'active' : '' }}">
                <i class="fas fa-donate"></i>
                <span>Donaciones</span>
            </a>
            
            {{-- Suscripciones --}}
            <a href="{{ url('/suscripciones') }}" class="public-sidebar-item {{ request()->is('suscripciones*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span>Suscripciones</span>
            </a>
            
            {{-- Eventos --}}
            <a href="{{ url('/eventos') }}" class="public-sidebar-item {{ request()->is('eventos*') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i>
                <span>Eventos</span>
            </a>
        </div>

        {{-- SECCIÓN 4: SERVICIOS --}}
        <div class="public-sidebar-section">
            <div class="public-section-title">
                <i class="fas fa-store me-1"></i> SERVICIOS
            </div>
            
            {{-- Tiendas --}}
            <a href="{{ url('/tiendas') }}" class="public-sidebar-item {{ request()->is('tiendas*') ? 'active' : '' }}">
                <i class="fas fa-store"></i>
                <span>Tiendas</span>
            </a>
            
            {{-- Veterinarias con submenú --}}
            <div class="public-sidebar-item has-submenu {{ request()->is('veterinarias*') ? 'open' : '' }}">
                <i class="fas fa-clinic-medical"></i>
                <span>Veterinarias</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="public-sidebar-submenu {{ request()->is('veterinarias*') ? 'open' : '' }}">
                <a href="{{ url('/veterinarias') }}" class="public-sidebar-subitem {{ request()->is('veterinarias') ? 'active' : '' }}">
                    <i class="fas fa-list"></i>
                    <span>Todas</span>
                </a>
                <a href="{{ url('/veterinarias/urgencias') }}" class="public-sidebar-subitem {{ request()->is('veterinarias/urgencias') ? 'active' : '' }}">
                    <i class="fas fa-ambulance"></i>
                    <span>Urgencias 24/7</span>
                    <span class="badge bg-danger">24h</span>
                </a>
                <a href="{{ url('/veterinarias/mapa') }}" class="public-sidebar-subitem {{ request()->is('veterinarias/mapa') ? 'active' : '' }}">
                    <i class="fas fa-map"></i>
                    <span>Ver mapa</span>
                </a>
            </div>
        </div>

        {{-- SECCIÓN 5: COMUNIDAD --}}
        <div class="public-sidebar-section">
            <div class="public-section-title">
                <i class="fas fa-users me-1"></i> COMUNIDAD
            </div>
            
            {{-- Fundaciones --}}
            <a href="{{ url('/fundaciones') }}" class="public-sidebar-item {{ request()->is('fundaciones*') ? 'active' : '' }}">
                <i class="fas fa-building"></i>
                <span>Fundaciones</span>
            </a>
            
            {{-- Usuarios --}}
            <a href="{{ url('/usuarios') }}" class="public-sidebar-item {{ request()->is('usuarios*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Usuarios</span>
            </a>
            
            {{-- Comentarios --}}
            <a href="{{ url('/comentarios') }}" class="public-sidebar-item {{ request()->is('comentarios*') ? 'active' : '' }}">
                <i class="fas fa-comments"></i>
                <span>Comentarios</span>
            </a>
        </div>

        {{-- SECCIÓN 6: INFORMACIÓN --}}
        <div class="public-sidebar-section">
            <div class="public-section-title">
                <i class="fas fa-info-circle me-1"></i> INFORMACIÓN
            </div>
            
            {{-- Nosotros --}}
            <a href="{{ url('/nosotros') }}" class="public-sidebar-item {{ request()->is('nosotros') ? 'active' : '' }}">
                <i class="fas fa-info-circle"></i>
                <span>Nosotros</span>
            </a>
            
            {{-- Notificaciones con badge --}}
            <a href="{{ url('/notificaciones') }}" class="public-sidebar-item {{ request()->is('notificaciones*') ? 'active' : '' }}">
                <i class="fas fa-bell"></i>
                <span>Notificaciones</span>
                @php
                    $notificacionesNoLeidas = 3; // Esto vendría de tu controlador
                @endphp
                @if($notificacionesNoLeidas > 0)
                    <span class="public-sidebar-badge">{{ $notificacionesNoLeidas }}</span>
                @endif
            </a>
            
            {{-- Blog/Recursos --}}
            <a href="{{ url('/blog') }}" class="public-sidebar-item {{ request()->is('blog*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i>
                <span>Blog</span>
            </a>
            
            {{-- Preguntas Frecuentes --}}
            <a href="{{ url('/faq') }}" class="public-sidebar-item {{ request()->is('faq') ? 'active' : '' }}">
                <i class="fas fa-question-circle"></i>
                <span>FAQ</span>
            </a>
        </div>
    </nav>

    {{-- Footer del Sidebar --}}
    <div class="public-sidebar-footer">
        {{-- Contacto --}}
        <a href="{{ url('/contacto') }}" class="public-sidebar-item">
            <i class="fas fa-envelope"></i>
            <span>Contacto</span>
        </a>
        
        {{-- Términos y condiciones --}}
        <a href="{{ url('/terminos') }}" class="public-sidebar-item">
            <i class="fas fa-file-contract"></i>
            <span>Términos y condiciones</span>
        </a>
        
        {{-- Privacidad --}}
        <a href="{{ url('/privacidad') }}" class="public-sidebar-item">
            <i class="fas fa-shield-alt"></i>
            <span>Política de privacidad</span>
        </a>
        
        {{-- Cerrar sesión (si está logueado) --}}
        @auth
        <a href="{{ url('/logout') }}" class="public-sidebar-item text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Cerrar sesión</span>
        </a>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        @endauth
    </div>
</aside>

{{-- Overlay para cerrar sidebar al hacer clic fuera --}}
<div class="public-sidebar-overlay" id="publicSidebarOverlay"></div>