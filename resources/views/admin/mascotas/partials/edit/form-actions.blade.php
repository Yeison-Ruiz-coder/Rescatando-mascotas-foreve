<!-- Botones de acción -->
<div class="form-actions mt-4">
    <button type="submit" class="btn btn-submit">
        <i class="fas fa-save me-2"></i>Actualizar Mascota
    </button>
    <a href="{{ route('admin.mascotas.show', $mascota) }}" class="btn btn-cancel">
        <i class="fas fa-times me-2"></i>Cancelar
    </a>
</div>
