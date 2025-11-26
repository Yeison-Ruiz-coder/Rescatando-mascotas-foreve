{{-- resources/views/admin/solicitud/partials/show/_actions.blade.php --}}
<div class="action-buttons-group">
    <a href="{{ route('solicitud.edit', $solicitud) }}" class="btn-action edit-btn">
        <i class="fa-solid fa-pen-to-square"></i> Editar Solicitud
    </a>
    
    <form action="{{ route('solicitud.status.update', $solicitud) }}" method="POST" class="status-form">
        @csrf
        @method('PUT')
        <select name="estado" class="status-select" onchange="this.form.submit()">
            <option value="En Revisión" {{ $solicitud->estado == 'En Revisión' ? 'selected' : '' }}>En Revisión</option>
            <option value="Aprobada" {{ $solicitud->estado == 'Aprobada' ? 'selected' : '' }}>Aprobada</option>
            <option value="Rechazada" {{ $solicitud->estado == 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
        </select>
    </form>
    
    <a href="{{ route('solicitud.index') }}" class="btn-action back-btn">
        <i class="fa-solid fa-arrow-left"></i> Volver al Listado
    </a>

    <form action="{{ route('solicitud.destroy', $solicitud) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-action delete-btn" onclick="return confirm('¿Estás seguro de eliminar esta solicitud?')">
            <i class="fa-solid fa-trash"></i> Eliminar
        </button>
    </form>
</div>