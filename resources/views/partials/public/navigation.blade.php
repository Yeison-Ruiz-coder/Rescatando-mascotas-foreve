{{-- Navegación pública - Separada del header --}}
<div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mx-auto first-row-nav">
        <li class="nav-item">
            <a class="nav-link main-btn" href="{{ route('inicio') }}">INICIO</a>
        </li>
        <li class="nav-item">
            <a class="nav-link main-btn" href="{{ route('reportes.create') }}">REPORTA</a> 
        </li>
        <li class="nav-item">
            <a class="nav-link main-btn" href="{{ route('mascotas.public.index') }}">ADOPTA</a>
        </li>
        <li class="nav-item">
            <a class="nav-link main-btn" href="{{ route('rescates.index') }}">RESCATA</a>
        </li>
        <li class="nav-item">
            <a class="nav-link main-btn" href="{{ route('solicitudes.index') }}">SOLICITUDES</a>
        </li>
        <li class="nav-item">
            <a class="nav-link main-btn" href="{{ route('suscripciones.create') }}">SUSCRÍBETE</a>
        </li>
        <li class="nav-item">
            <a class="nav-link main-btn" href="{{ url('/nosotros') }}">NOSOTROS</a>
        </li>
    </ul>
    
    <div class="navbar-profile dropdown">
        <a href="#" class="profile-icon-link" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('img/perfil.png') }}" alt="Perfil" class="profile-icon">
        </a>
        <ul class="dropdown-menu dropdown-menu-end profile-dropdown" aria-labelledby="profileDropdown">
            <li><a class="dropdown-item" href="{{ route('usuarios.edit', Auth::user()->id ?? 0) }}">Editar perfil</a></li>
            <li><a class="dropdown-item" href="#">Cambiar foto</a></li>
            <li><a class="dropdown-item" href="#">Cambiar contraseña</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">Cerrar sesión</button>
                </form>
            </li>
        </ul>
    </div>
</div>

{{-- Segunda fila de navegación --}}
<div class="second-row-nav-wrapper">
    <div class="container-fluid">
        <ul class="nav second-row-nav">
            {{-- ... tu segunda fila de navegación actual ... --}}
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
            {{-- ... resto de tu segunda fila ... --}}
        </ul>
    </div>
</div>