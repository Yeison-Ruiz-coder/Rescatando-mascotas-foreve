{{-- resources/views/admin/solicitud/partials/index/_actions.blade.php --}}
<div class="card-actions">
    <a href="{{ route('admin.solicitudes.create') }}" class="btn-action primary-btn">
        <i class="fa-solid fa-plus"></i> Nueva Solicitud
    </a>

    <div class="search-box">
        <input type="text" placeholder="Buscar solicitudes..." class="search-input">
        <button class="search-btn">
            <i class="fa-solid fa-search"></i>
        </button>
    </div>
</div>
