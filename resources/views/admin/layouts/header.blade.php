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
            <img src="{{ asset('img/logo-azul.png') }}" alt="Logo Fundación" class="header-logo">

            <div class="brand-text">
                <h1 class="brand-title">Panel Administrativo</h1>
                <span class="brand-subtitle">Fundación Mascotas</span>
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
