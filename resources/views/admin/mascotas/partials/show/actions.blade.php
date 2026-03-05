{{-- BOTONES DE ACCIÓN --}}
<div class="d-flex gap-2 mb-4">
    <a href="{{ route('admin.mascotas.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Volver al Listado
    </a>
    <a href="{{ route('admin.mascotas.edit', $mascota) }}" class="btn btn-warning">
        <i class="fas fa-edit me-2"></i>Editar
    </a>
</div>
