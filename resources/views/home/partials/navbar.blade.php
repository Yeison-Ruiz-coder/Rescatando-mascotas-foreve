<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            <i class="fas fa-paw text-primary me-2"></i>
            Rescatando Mascotas
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}#mascotas">Mascotas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}#proceso">Proceso</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('public.mascotas.index') }}">Adoptar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rescates.create') }}">Rescatar</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Más
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('donaciones.create') }}">Donaciones</a></li>
                        <li><a class="dropdown-item" href="#">Voluntariado</a></li>
                        <li><a class="dropdown-item" href="#">Servicios</a></li>
                    </ul>
                </li>
            </ul>
            
            <div class="d-flex">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary me-2">
                        <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary">
                            <i class="fas fa-sign-out-alt me-1"></i>Salir
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">
                        <i class="fas fa-sign-in-alt me-1"></i>Ingresar
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        <i class="fas fa-user-plus me-1"></i>Registrarse
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>