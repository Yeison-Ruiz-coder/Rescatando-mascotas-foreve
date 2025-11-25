<ul class="navbar-nav mx-auto first-row-nav">
    <li class="nav-item">
        <a class="nav-link main-btn" href="{{ route('inicio') }}">Inicio</a>
    </li>
    <li class="nav-item">
        <a class="nav-link main-btn" href="{{ route('reportes.create') }}">Reporta</a> 
    </li>
    <li class="nav-item">
        <a class="nav-link main-btn" href="{{ route('adopciones.index') }}">Adopta</a>
    </li>
    <li class="nav-item">
        <a class="nav-link main-btn" href="{{ route('rescates.index') }}">Rescata</a>
    </li>
    <li class="nav-item">
        <a class="nav-link main-btn" href="{{ route('solicitudes.index') }}">Solicitudes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link main-btn" href="{{ route('suscripciones.create') }}">Suscríbete</a>
    </li>
    <li class="nav-item">
        <a class="nav-link main-btn" href="{{ url('/nosotros') }}">Nosotros</a>
    </li>
</ul>