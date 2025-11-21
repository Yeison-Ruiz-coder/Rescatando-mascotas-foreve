<div class="sidebar-footer">
    <div class="version-info">
        v1.0.0
    </div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </button>
    </form>
</div>