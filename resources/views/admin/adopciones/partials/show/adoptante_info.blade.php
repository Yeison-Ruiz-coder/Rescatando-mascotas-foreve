{{-- resources/views/admin/adopciones/partials/show/_adoptante_info.blade.php --}}
<div class="seccion-info h-100">
    <div class="d-flex align-items-center mb-3">
        <div class="icono-seccion icono-usuario">
            <i class="fas fa-user fa-lg"></i>
        </div>
        <h5 class="mb-0">Información del Adoptante</h5>
    </div>
    
    @if($adopcion->usuario)
        <div class="info-item">
            <strong>Nombre completo:</strong>
            <span class="valor">{{ $adopcion->usuario->Nombre_1 }} {{ $adopcion->usuario->Apellido_1 }}</span>
        </div>
        @if($adopcion->usuario->Nombre_2 || $adopcion->usuario->Apellido_2)
        <div class="info-item">
            <strong>Nombres adicionales:</strong>
            <span class="valor">{{ $adopcion->usuario->Nombre_2 }} {{ $adopcion->usuario->Apellido_2 }}</span>
        </div>
        @endif
        <div class="info-item">
            <strong>Email:</strong>
            <span class="valor">{{ $adopcion->usuario->Email }}</span>
        </div>
        <div class="info-item">
            <strong>Teléfono:</strong>
            <span class="valor">{{ $adopcion->usuario->Telefono }}</span>
        </div>
        <div class="info-item">
            <strong>Dirección:</strong>
            <span class="valor">{{ $adopcion->usuario->Direccion }}</span>
        </div>
        <div class="info-item">
            <strong>Tipo de usuario:</strong>
            <span class="valor">
                <span class="badge badge-estado-detalle bg-secondary">
                    {{ $adopcion->usuario->tipo }}
                </span>
            </span>
        </div>
    @else
        <div class="alerta-informativa">
            <i class="fas fa-exclamation-triangle me-2"></i>
            Usuario adoptante no encontrado en el sistema
        </div>
    @endif
</div>