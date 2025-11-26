{{-- resources/views/admin/adopciones/partials/create/_actions.blade.php --}}
<div class="botones-creacion">
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.adopciones.index') }}" class="btn btn-cancelar-crear">
            <i class="fas fa-arrow-left me-2"></i>Cancelar y Volver
        </a>
        <button type="submit" class="btn btn-crear" id="btnSubmit">
            <i class="fas fa-save me-2"></i>Registrar Adopción
        </button>
    </div>
</div>