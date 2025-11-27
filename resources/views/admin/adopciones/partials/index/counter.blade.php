{{-- resources/views/admin/adopciones/partials/index/_counter.blade.php --}}
<div class="contador-resultados">
    <div class="d-flex justify-content-between align-items-center">
        <p class="mb-0">
            Mostrando <strong class="text-fucsia">{{ $adopciones->count() }}</strong> de 
            <strong class="text-turquesa">{{ $adopciones->total() }}</strong> adopciones
        </p>
        
        @if(request()->anyFilled(['estado', 'mascota_id', 'usuario_id', 'busqueda', 'fecha_desde', 'fecha_hasta']))
        <div class="alert alert-info py-2 mb-0">
            <small>
                <i class="fas fa-info-circle me-1"></i> 
                Filtros aplicados. 
                <a href="{{ route('admin.adopciones.index') }}" class="alert-link">Ver todas</a>
            </small>
        </div>
        @endif
    </div>
</div>