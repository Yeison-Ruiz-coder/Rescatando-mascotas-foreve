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