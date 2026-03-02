{{-- resources/views/public/partials/navbar/public-navbar.blade.php --}}
<nav class="public-navbar">
    <div class="public-navbar-container">
        {{-- Botón hamburguesa --}}
        <button class="public-hamburger-btn" id="publicHamburgerBtn">
            <span></span>
            <span></span>
            <span></span>
        </button>

        {{-- Logo y marca --}}
        <a href="{{ url('/') }}" class="public-navbar-brand">
            <img src="{{ asset('img/logo-oscuro.png') }}" alt="Logo Fundación" class="header-logo">
            <img src="{{ asset('img/texto-logo-oscuro.png') }}" alt="Logo Fundación" class="header-logo-texto">

        </a>

        {{-- Botón de reporte urgente --}}
        <a href="{{ url('/rescates/crear') }}" class="public-urgent-btn">
            <i class="fas fa-paw"></i>
            <span>Reportar Rescate</span>
        </a>

        {{-- Perfil de usuario --}}
        @auth
        <div class="public-profile-btn dropdown" data-bs-toggle="dropdown">
            <div class="public-profile-avatar">
                @if(Auth::user()->avatar)
                    <img src="{{ Auth::user()->avatar }}" alt="Avatar">
                @else
                    <i class="fas fa-user"></i>
                @endif
            </div>
            <div class="public-profile-info">
                <span class="public-profile-name">{{ Auth::user()->name }}</span>
                <span class="public-profile-role">{{ Auth::user()->role ?? 'Usuario' }}</span>
            </div>
        </div>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ url('/perfil') }}"><i class="fas fa-user me-2"></i>Mi Perfil</a></li>
            <li><a class="dropdown-item" href="{{ url('/mis-rescates') }}"><i class="fas fa-paw me-2"></i>Mis Rescates</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión</a></li>
        </ul>
        @else
        <a href="{{ url('/login') }}" class="public-profile-btn">
            <div class="public-profile-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="public-profile-info">
                <span class="public-profile-name">Iniciar sesión</span>
                <span class="public-profile-role">Registrarse</span>
            </div>
        </a>
        @endauth
    </div>
</nav>
