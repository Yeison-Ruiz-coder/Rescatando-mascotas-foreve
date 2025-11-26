{{-- resources/views/admin/adopciones/partials/show/_adopcion_info.blade.php --}}
<div class="seccion-info">
    <div class="d-flex align-items-center mb-3">
        <div class="icono-seccion icono-adopcion">
            <i class="fas fa-file-contract fa-lg"></i>
        </div>
        <h5 class="mb-0">Información de la Adopción</h5>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="info-item">
                <strong>Fecha de Adopción:</strong>
                <span class="valor">{{ $adopcion->Fecha_adopcion->format('d/m/Y') }}</span>
            </div>
            <div class="info-item">
                <strong>Lugar de Adopción:</strong>
                <span class="valor">{{ $adopcion->Lugar_adopcion }}</span>
            </div>
            <div class="info-item">
                <strong>Estado del proceso:</strong>
                <span class="valor">
                    <span class="badge badge-estado-detalle 
                        @if($adopcion->estado == 'Aprobado') bg-success
                        @elseif($adopcion->estado == 'En proceso') bg-warning
                        @else bg-danger
                        @endif">
                        {{ $adopcion->estado }}
                    </span>
                </span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="info-item">
                <strong>Fecha de Registro:</strong>
                <span class="valor">{{ $adopcion->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="info-item">
                <strong>Última Actualización:</strong>
                <span class="valor">{{ $adopcion->updated_at->format('d/m/Y H:i') }}</span>
            </div>
        </div>
    </div>

    <!-- Información Adicional -->
    @if($adopcion->fundacion)
    <div class="info-adicional mt-3">
        <div class="info-item">
            <strong>Fundación:</strong>
            <span class="valor">{{ $adopcion->fundacion->Nombre_1 }}</span>
        </div>
        <div class="info-item">
            <strong>Dirección de la Fundación:</strong>
            <span class="valor">{{ $adopcion->fundacion->Direccion }}</span>
        </div>
    </div>
    @endif

    @if($adopcion->administrador)
    <div class="info-adicional mt-3">
        <div class="info-item">
            <strong>Administrador Responsable:</strong>
            <span class="valor">{{ $adopcion->administrador->Nombre_1 }} {{ $adopcion->administrador->Apellido_1 }}</span>
        </div>
    </div>
    @endif

    @if($adopcion->razon_rechazo)
    <div class="alerta-rechazo mt-3">
        <div class="info-item">
            <strong>Razón de Rechazo:</strong>
            <span class="valor">{{ $adopcion->razon_rechazo }}</span>
        </div>
    </div>
    @endif

    @if($adopcion->fecha_cierre)
    <div class="info-adicional mt-3">
        <div class="info-item">
            <strong>Fecha de Cierre:</strong>
            <span class="valor">{{ $adopcion->fecha_cierre->format('d/m/Y') }}</span>
        </div>
    </div>
    @endif
</div>