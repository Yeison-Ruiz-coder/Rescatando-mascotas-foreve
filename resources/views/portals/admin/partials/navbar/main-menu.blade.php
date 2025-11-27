<ul class="navbar-nav mx-auto first-row-nav">
    <li class="nav-item">
        <a class="nav-link main-btn" href="{{ route('inicio') }}">Inicio</a>
    </li>
    <li class="nav-item">
        <a class="nav-link main-btn" href="{{ route('reportes.create') }}">Reporta</a> 
    </li>
    <li class="nav-item">
        <a class="nav-link main-btn" href="{{ route('admin.adopciones.index') }}">Adopta</a>
    </li>
    <li class="nav-item">
        <a class="nav-link main-btn" href="{{ route('rescates.index') }}">Rescata</a>
    </li>
    <li class="nav-item">
        <a class="nav-link main-btn" href="{{ route('solicitud.index') }}">Solicitudes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link main-btn" href="{{ route('admin.eventos.index') }}">Eventos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link main-btn" href="{{ url('/nosotros') }}">Nosotros</a>
    </li>
</ul>