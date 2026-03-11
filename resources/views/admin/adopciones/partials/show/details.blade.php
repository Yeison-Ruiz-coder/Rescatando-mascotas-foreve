{{-- resources/views/admin/adopciones/partials/show/_actions.blade.php --}}
<div class="botones-accion">
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.adopciones.index') }}" class="btn btn-volver">
            <i class="fas fa-arrow-left me-2"></i>Volver al Listado
        </a>
        <div class="btn-group-acciones-detalle">
            <a href="{{ route('admin.adopciones.edit', $adopcion->id) }}" class="btn btn-editar-detalle">
                <i class="fas fa-edit me-2"></i>Editar Adopción
            </a>
            <form action="{{ route('admin.adopciones.destroy', $adopcion->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-eliminar-detalle" 
                        onclick="return confirm('¿Estás seguro de eliminar esta adopción? Esta acción no se puede deshacer.')">
                    <i class="fas fa-trash me-2"></i>Eliminar
                </button>
            </form>
        </div>
    </div>
</div>