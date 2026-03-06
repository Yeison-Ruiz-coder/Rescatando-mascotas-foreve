{{-- resources/views/admin/solicitud/partials/show/_details.blade.php --}}
<div class="card-details">

    <!-- Estado Actual con botón de cambio rápido -->
    <div class="detail-group status-group">
        <label>Estado Actual:</label>
        <div class="status-with-actions">
            @php
                $estado_class = strtolower(str_replace('_', '-', $solicitud->estado ?? 'pendiente'));
                $estado_texto = str_replace('_', ' ', ucfirst($solicitud->estado ?? 'pendiente'));
            @endphp
            <span class="status-badge large {{ $estado_class }}">
                {{ $estado_texto }}
            </span>

            @if($solicitud->isPendiente() || $solicitud->isEnRevision())
            <button type="button" class="btn-action quick-status-btn" onclick="openStatusModal()">
                <i class="fa-solid fa-pen"></i> Cambiar Estado
            </button>
            @endif
        </div>
    </div>

    <!-- Información Básica -->
    <div class="details-grid">
        <div class="detail-group">
            <label><i class="fa-solid fa-tag"></i> Tipo de Solicitud:</label>
            <p>
                <span class="tipo-badge {{ $solicitud->tipo_solicitud }}">
                    {{ ucfirst($solicitud->tipo_solicitud) }}
                </span>
            </p>
        </div>

        <div class="detail-group">
            <label><i class="fa-solid fa-calendar"></i> Fecha de Solicitud:</label>
            <p>{{ $solicitud->fecha_solicitud->format('d/m/Y H:i') }}</p>
        </div>

        <div class="detail-group">
            <label><i class="fa-solid fa-user"></i> Solicitante:</label>
            @if ($solicitud->usuario)
                <p>
                    <strong>{{ $solicitud->usuario->name ?? $solicitud->usuario->nombre_completo }}</strong>
                    <br>
                    <small class="text-muted">(Usuario registrado)</small>
                </p>
            @else
                <p>
                    <strong>{{ $solicitud->nombre_solicitante }}</strong>
                    @if($solicitud->esAdopcion() && $apellido = $solicitud->getDatoAdopcion('apellido_solicitante'))
                        <strong> {{ $apellido }}</strong>
                    @endif
                    <br>
                    <small>{{ $solicitud->email_solicitante }} | {{ $solicitud->telefono_solicitante }}</small>
                </p>
            @endif
        </div>

        <div class="detail-group">
            <label><i class="fa-solid fa-clock"></i> Creada el:</label>
            <p>{{ $solicitud->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <!-- Información del Item Solicitado -->
    @if($solicitud->solicitable)
    <div class="detail-group full-width">
        <label><i class="fa-solid fa-paw"></i> Item Solicitado:</label>
        <div class="solicitable-info">
            @if($solicitud->solicitable_type == 'App\Models\Mascota')
                <p>
                    <strong>Mascota:</strong>
                    <a href="{{ route('admin.mascotas.show', $solicitud->solicitable_id) }}">
                        {{ $solicitud->solicitable->nombre ?? 'Mascota #' . $solicitud->solicitable_id }}
                    </a>
                </p>
            @else
                <p><strong>Tipo:</strong> {{ class_basename($solicitud->solicitable_type) }}</p>
                <p><strong>ID:</strong> #{{ $solicitud->solicitable_id }}</p>
            @endif
        </div>
    </div>
    @endif

    <!-- Datos Específicos de Adopción (si aplica) -->
    @if($solicitud->esAdopcion() && $solicitud->datos_adicionales)
    <div class="detail-group full-width">
        <label><i class="fa-solid fa-file-signature"></i> Detalles de Adopción:</label>
        <div class="adopcion-details-grid">
            @if($direccion = $solicitud->getDatoAdopcion('direccion'))
            <div class="detail-item">
                <span class="detail-label">Dirección:</span>
                <span class="detail-value">{{ $direccion }}</span>
            </div>
            @endif

            @if($experiencia = $solicitud->getDatoAdopcion('experiencia_mascotas'))
            <div class="detail-item">
                <span class="detail-label">Experiencia con mascotas:</span>
                <span class="detail-value">{{ $experiencia }}</span>
            </div>
            @endif

            @if($vivienda = $solicitud->getDatoAdopcion('tipo_vivienda'))
            <div class="detail-item">
                <span class="detail-label">Tipo de vivienda:</span>
                <span class="detail-value">{{ $vivienda }}</span>
            </div>
            @endif

            @if($motivo = $solicitud->getDatoAdopcion('motivo_adopcion'))
            <div class="detail-item">
                <span class="detail-label">Motivo de adopción:</span>
                <span class="detail-value">{{ $motivo }}</span>
            </div>
            @endif

            <!-- Compromisos -->
            <div class="detail-item compromisos">
                <span class="detail-label">Compromisos:</span>
                <div class="compromisos-list">
                    @if($solicitud->getDatoAdopcion('compromiso_cuidado'))
                    <span class="compromiso-badge cumplido">
                        <i class="fa-solid fa-check"></i> Cuidado responsable
                    </span>
                    @endif
                    @if($solicitud->getDatoAdopcion('compromiso_esterilizacion'))
                    <span class="compromiso-badge cumplido">
                        <i class="fa-solid fa-check"></i> Esterilización
                    </span>
                    @endif
                    @if($solicitud->getDatoAdopcion('compromiso_seguimiento'))
                    <span class="compromiso-badge cumplido">
                        <i class="fa-solid fa-check"></i> Seguimiento
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Contenido / Justificación -->
    <div class="detail-group full-width">
        <label><i class="fa-solid fa-file-lines"></i> Contenido / Justificación:</label>
        <div class="content-box">
            {{ $solicitud->contenido ?: 'Sin contenido adicional' }}
        </div>
    </div>

    <!-- Notas Internas (solo visible para admin) -->
    @if($solicitud->notas_internas)
    <div class="detail-group full-width">
        <label><i class="fa-solid fa-lock"></i> Notas Internas:</label>
        <div class="content-box internal-notes">
            {{ $solicitud->notas_internas }}
        </div>
    </div>
    @endif

    <!-- Información de Revisión -->
    @if($solicitud->revisado_por || $solicitud->razon_rechazo)
    <div class="detail-group full-width revision-info">
        <label><i class="fa-solid fa-clipboard-check"></i> Información de Revisión:</label>
        @if($solicitud->revisor)
        <p><strong>Revisado por:</strong> {{ $solicitud->revisor->name }}</p>
        @endif
        @if($solicitud->fecha_revision)
        <p><strong>Fecha de revisión:</strong> {{ $solicitud->fecha_revision->format('d/m/Y H:i') }}</p>
        @endif
        @if($solicitud->razon_rechazo)
        <div class="razon-rechazo">
            <strong>Razón de rechazo:</strong>
            <p>{{ $solicitud->razon_rechazo }}</p>
        </div>
        @endif
    </div>
    @endif

</div>

<!-- Modal para cambiar estado (incluirlo al final) -->
@include('admin.solicitud.partials.show.status-modal')
