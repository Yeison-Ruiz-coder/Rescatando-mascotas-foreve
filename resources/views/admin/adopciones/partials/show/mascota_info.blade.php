{{-- resources/views/admin/adopciones/partials/show/_mascota_info.blade.php --}}
<div class="seccion-info h-100">
    <div class="d-flex align-items-center mb-3">
        <div class="icono-seccion icono-mascota">
            <i class="fas fa-paw fa-lg"></i>
        </div>
        <h5 class="mb-0">Información de la Mascota</h5>
    </div>
    
    @if($adopcion->mascota)
        <div class="info-item">
            <strong>Nombre:</strong>
            <span class="valor">{{ $adopcion->mascota->Nombre_mascota }}</span>
        </div>
        <div class="info-item">
            <strong>Especie:</strong>
            <span class="valor">{{ $adopcion->mascota->Especie }}</span>
        </div>
        <div class="info-item">
            <strong>Raza:</strong>
            <span class="valor">{{ $adopcion->mascota->Raza }}</span>
        </div>
        <div class="info-item">
            <strong>Edad:</strong>
            <span class="valor">{{ $adopcion->mascota->Edad_aprox }} años</span>
        </div>
        <div class="info-item">
            <strong>Género:</strong>
            <span class="valor">{{ $adopcion->mascota->Genero }}</span>
        </div>
        <div class="info-item">
            <strong>Estado:</strong>
            <span class="valor">
                <span class="badge badge-estado-detalle 
                    @if($adopcion->mascota->estado == 'Adoptado') bg-success
                    @elseif($adopcion->mascota->estado == 'En adopcion') bg-warning
                    @else bg-info
                    @endif">
                    {{ $adopcion->mascota->estado }}
                </span>
            </span>
        </div>
    @else
        <div class="alerta-informativa">
            <i class="fas fa-exclamation-triangle me-2"></i>
            Mascota no encontrada en el sistema
        </div>
    @endif
</div>