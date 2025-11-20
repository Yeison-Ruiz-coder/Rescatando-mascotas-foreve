{{-- Sidebar Admin --}}
<aside class="admin-sidebar">
    <div class="sidebar-header">
        <h5 class="sidebar-title">Navegación</h5>
    </div>
    
    <nav class="sidebar-nav">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                   href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.mascotas.*') ? 'active' : '' }}" 
                   href="{{ route('admin.mascotas.index') }}">
                    <i class="fas fa-paw me-2"></i>Mascotas
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.adopciones.*') ? 'active' : '' }}" 
                   href="{{ route('admin.adopciones.index') }}">
                    <i class="fas fa-heart me-2"></i>Adopciones
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}" 
                   href="{{ route('admin.usuarios.index') }}">
                    <i class="fas fa-users me-2"></i>Usuarios
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.fundaciones.*') ? 'active' : '' }}" 
                   href="{{ route('admin.fundaciones.index') }}">
                    <i class="fas fa-home me-2"></i>Fundaciones
                </a>
            </li>

            <li class="nav-item mt-3">
                <a class="nav-link text-primary" href="{{ route('inicio') }}" target="_blank">
                    <i class="fas fa-external-link-alt me-2"></i>Ir al Sitio Público
                </a>
            </li>
        </ul>
    </nav>
</aside>