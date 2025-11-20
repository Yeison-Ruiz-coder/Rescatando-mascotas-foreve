<div class="sidebar-user">
    <div class="user-avatar">
        <img src="{{ Auth::user()->avatar ?? asset('img/perfil-usuario.png') }}" alt="User Avatar">
    </div>
    <div class="user-info">
        <div class="user-name">{{ Auth::user()->name ?? 'Administrador' }}</div>
        <div class="user-role">{{ Auth::user()->role ?? 'Admin' }}</div>
    </div>
</div>