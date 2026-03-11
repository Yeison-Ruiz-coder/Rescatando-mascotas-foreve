<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Historial de Seguimientos</h5>
    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalSeguimiento">
        <i class="fas fa-plus me-1"></i>Nuevo Seguimiento
    </button>
</div>

@if($adopcion->seguimientos->count() > 0)
    <div class="timeline">
        @foreach($adopcion->seguimientos as $seguimiento)
            <div class="timeline-item">
                <div class="timeline-badge
                    @if($seguimiento->estado_mascota == 'excelente') bg-success
                    @elseif($seguimiento->estado_mascota == 'bueno') bg-info
                    @elseif($seguimiento->estado_mascota == 'regular') bg-warning
                    @else bg-danger
                    @endif">
                    <i class="fas fa-paw"></i>
                </div>
                <div class="timeline-content card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="card-subtitle mb-2 text-muted">
                                {{ $seguimiento->fecha_seguimiento->format('d/m/Y') }}
                            </h6>
                            <span class="badge
                                @if($seguimiento->estado_mascota == 'excelente') bg-success
                                @elseif($seguimiento->estado_mascota == 'bueno') bg-info
                                @elseif($seguimiento->estado_mascota == 'regular') bg-warning
                                @else bg-danger
                                @endif">
                                {{ ucfirst($seguimiento->estado_mascota) }}
                            </span>
                        </div>
                        <p class="card-text">{{ $seguimiento->observaciones }}</p>
                        <small class="text-muted">
                            Registrado por: {{ $seguimiento->realizadoPor->name ?? 'Sistema' }}
                        </small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center py-5">
        <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
        <h6 class="text-muted">No hay seguimientos registrados</h6>
        <p class="text-muted small">Agrega el primer seguimiento usando el botón superior</p>
    </div>
@endif

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}
.timeline:before {
    content: '';
    position: absolute;
    left: 10px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}
.timeline-item {
    position: relative;
    margin-bottom: 20px;
}
.timeline-badge {
    position: absolute;
    left: -30px;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    z-index: 1;
}
.timeline-content {
    margin-left: 20px;
}
</style>
