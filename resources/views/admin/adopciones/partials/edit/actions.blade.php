{{-- resources/views/admin/adopciones/partials/edit/_actions.blade.php --}}
<div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
    <div>
        <a href="{{ route('admin.adopciones.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Volver al Listado
        </a>
        <a href="{{ route('admin.adopciones.show', $adopcion->id) }}" class="btn btn-outline-secondary me-2">
            <i class="fas fa-eye me-2"></i>Ver Detalles
        </a>
    </div>
    <div>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-2"></i>Actualizar Adopción
        </button>
    </div>
</div>