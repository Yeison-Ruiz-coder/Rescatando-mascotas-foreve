<div class="mb-4">
    <h5 class="text-turquesa mb-3 fw-bold">
        <i class="fas fa-heartbeat me-2"></i>Salud y Cuidados
    </h5>

    <!-- Vacunas -->
    <div class="estado-vacunas d-flex align-items-center mb-3 p-3">
        <i class="fas fa-syringe text-turquesa me-3 fs-5"></i>
        <div>
            <small class="text-muted d-block">Vacunas</small>
            <strong class="text-turquesa">
                @if($mascota->vacunas && $mascota->vacunas->count() > 0)
                    {{ $mascota->vacunas->count() }} vacunas registradas
                @else
                    En proceso
                @endif
            </strong>
        </div>
    </div>

    <!-- Lugar de rescate -->
    <div class="estado-salud d-flex align-items-center p-3">
        <i class="fas fa-map-marker-alt text-turquesa me-3 fs-5"></i>
        <div>
            <small class="text-muted d-block">Rescatado en</small>
            <strong class="text-turquesa">{{ $mascota->lugar_rescate ?? 'No especificado' }}</strong>
        </div>
    </div>

    <!-- Condiciones especiales (si aplica) -->
    @if($mascota->condiciones_especiales)
    <div class="estado-salud d-flex align-items-center p-3 mt-3 bg-light-info">
        <i class="fas fa-exclamation-triangle text-warning me-3 fs-5"></i>
        <div>
            <small class="text-muted d-block">Cuidados especiales</small>
            <strong class="text-turquesa">{{ $mascota->condiciones_especiales }}</strong>
        </div>
    </div>
    @endif

    <!-- Apto con niños y otros animales -->
    <div class="row mt-3">
        @if($mascota->apto_con_ninos)
        <div class="col-6">
            <span class="badge bg-success p-2 w-100">
                <i class="fas fa-child me-1"></i>Apto con niños
            </span>
        </div>
        @endif
        @if($mascota->apto_con_otros_animales)
        <div class="col-6">
            <span class="badge bg-success p-2 w-100">
                <i class="fas fa-dog me-1"></i>Apto con otros animales
            </span>
        </div>
        @endif
    </div>
</div>
