<!-- Header Profesional con Hamburguesa Integrada -->
<header class="admin-header">
    <div class="header-container">
        <!-- Botón Hamburguesa -->
        <button class="hamburger-btn" id="hamburgerBtn">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- Logo y Título (AHORA CON IMAGEN) -->
        <div class="header-brand">
            <!-- CAMBIO AQUÍ: Eliminamos el icono y ponemos la imagen -->
            <img src="{{ asset('img/logo-oscuro.png') }}" alt="Logo Fundación" class="header-logo">
            <img src="{{ asset('img/texto-logo-oscuro.png') }}" alt="Logo Fundación" class="header-logo-texto">

            <div class="brand-text">
            </div>
        </div>

        <!-- Botón de Perfil Simple -->
        <a href="{{ route('admin.administradores.index') }}" class="profile-btn">
            <div class="profile-avatar">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="profile-text">
                <span class="profile-name">{{ auth()->user()->name ?? 'Admin' }}</span>
                <span class="profile-role">Administrador</span>
            </div>
        </a>
    </div>
</header>
