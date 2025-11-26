{{-- resources/views/admin/solicitud/partials/show/_details.blade.php --}}
<div class="card-details">
    
    <!-- Estado Actual -->
    <div class="detail-group status-group">
        <label>Estado Actual:</label>
        @php
            $estado_class = strtolower(str_replace(' ', '-', $solicitud->estado ?? 'revision'));
        @endphp
        <span class="status-badge large {{ $estado_class }}">
            {{ $solicitud->estado ?? 'Sin Estado' }}
        </span>
    </div>

    <!-- Información Básica -->
    <div class="details-grid">
        <div class="detail-group">
            <label><i class="fa-solid fa-tag"></i> Tipo de Solicitud:</label>
            <p>{{ $solicitud->tipo }}</p>
        </div>

        <div class="detail-group">
            <label><i class="fa-solid fa-calendar"></i> Fecha de Solicitud:</label>
            <p>{{ $solicitud->fecha_solicitud->format('d/m/Y H:i') }}</p>
        </div>

        <div class="detail-group">
            <label><i class="fa-solid fa-user"></i> Solicitante:</label>
            <p>{{ $solicitud->usuario->nombre ?? 'Usuario ID: ' . ($solicitud->usuario_id ?? 'N/A') }}</p>
        </div>
        
        <div class="detail-group">
            <label><i class="fa-solid fa-clock"></i> Creada el:</label>
            <p>{{ $solicitud->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>
    
    <!-- Contenido / Justificación -->
    <div class="detail-group full-width">
        <label><i class="fa-solid fa-file-lines"></i> Contenido / Justificación:</label>
        <div class="content-box">
            {{ $solicitud->contenido }}
        </div>
    </div>

</div>