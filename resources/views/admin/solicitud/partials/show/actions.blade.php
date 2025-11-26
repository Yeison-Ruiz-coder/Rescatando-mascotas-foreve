{{-- resources/views/admin/solicitud/partials/show/_actions.blade.php --}}
<div class="action-buttons-group">
    <a href="{{ route('solicitud.index') }}" class="btn-action back-btn">
        <i class="fa-solid fa-arrow-left"></i> Volver al Listado
    </a>
    <a href="{{ route('solicitud.edit', $solicitud) }}" class="btn-action edit-btn">
        <i class="fa-solid fa-pen-to-square"></i> Editar Solicitud
    </a>
</div>
