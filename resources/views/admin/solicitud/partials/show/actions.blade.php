{{-- resources/views/admin/solicitud/partials/show/_actions.blade.php --}}
<div class="action-buttons-group">
    <a href="{{ route('admin.solicitudes.index') }}" class="btn-action back-btn">
        <i class="fa-solid fa-arrow-left"></i> Volver al Listado
    </a>

    @if($solicitud->isPendiente() || $solicitud->isEnRevision())
    <button type="button" class="btn-action review-btn" onclick="openStatusModal()">
        <i class="fa-solid fa-check-circle"></i> Revisar Solicitud
    </button>
    @endif

    <a href="{{ route('admin.solicitudes.edit', $solicitud) }}" class="btn-action edit-btn">
        <i class="fa-solid fa-pen-to-square"></i> Editar Solicitud
    </a>

    @if($solicitud->isRechazada() && $solicitud->razon_rechazo)
    <button type="button" class="btn-action info-btn" onclick="showRejectionReason()">
        <i class="fa-solid fa-info-circle"></i> Ver Razón
    </button>
    @endif
</div>
