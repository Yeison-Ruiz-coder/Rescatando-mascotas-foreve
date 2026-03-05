{{-- DETALLES TÉCNICOS --}}
<div class="card shadow mb-4">
    <div class="card-header fw-bold bg-turquesa text-white">
        <i class="fas fa-info-circle me-2"></i>Ficha Técnica
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Especie:</strong>
            <span class="badge bg-info text-white p-2">{{ $mascota->especie ?? 'No especificada' }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Género:</strong>
            <span class="badge bg-secondary p-2">{{ $mascota->genero ?? 'No especificado' }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Edad:</strong>
            <span>{{ $mascota->edad_aprox ?? 'No especificada' }} años</span>
        </li>
        <li class="list-group-item">
            <strong>Lugar de Rescate:</strong>
            <span class="float-end">{{ $mascota->lugar_rescate ?? 'No especificado' }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Fecha de Ingreso:</strong>
            <span>{{ $mascota->fecha_ingreso ? \Carbon\Carbon::parse($mascota->fecha_ingreso)->format('d/m/Y') : 'No registrada' }}</span>
        </li>
        @if($mascota->fecha_salida)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Fecha de Salida:</strong>
            <span>{{ \Carbon\Carbon::parse($mascota->fecha_salida)->format('d/m/Y') }}</span>
        </li>
        @endif
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Responsable (Fundación):</strong>
            <span>{{ $mascota->fundacion ? $mascota->fundacion->Nombre_1 : 'No asignada' }}</span>
        </li>
    </ul>
</div>
