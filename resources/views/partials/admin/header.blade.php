{{-- Header Admin - Navbar superior --}}
<header class="admin-header">
    <nav class="navbar navbar-dark bg-dark border-bottom">
        <div class="container-fluid">
            {{-- Botón para toggle sidebar --}}
            <button class="btn btn-dark sidebar-toggle" type="button">
                <i class="fas fa-bars"></i>
            </button>

            {{-- Brand --}}
            <a class="navbar-brand mx-auto" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('img/logo-admin.png') }}" alt="Admin Logo" height="30" class="d-inline-block align-text-top me-2">
                <span class="d-none d-md-inline">Panel Administrativo</span>
            </a>

            {{-- Menú usuario --}}
            <div class="navbar-nav ms-auto">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i>
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('perfil.edit') }}"><i class="fas fa-user me-2"></i>Mi Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>