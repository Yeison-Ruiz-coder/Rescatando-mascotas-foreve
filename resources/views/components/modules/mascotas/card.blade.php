<!-- Card de Mascota -->
<div class="card mascota-card shadow-sm h-100">
    <!-- Imagen con Badge de Estado -->
    <div class="mascota-img-container position-relative overflow-hidden">
        <img src="{{ $mascota->Foto ? Storage::url($mascota->Foto) : asset('img/mascota-placeholder.jpg') }}"
             class="mascota-card-img"
             alt="{{ $mascota->Nombre_mascota }}"
             onerror="this.onerror=null; this.src='{{ asset('img/mascota-placeholder.jpg') }}'">
        
        <div class="mascota-badge 
            @if($mascota->estado == 'En adopcion') badge-adopcion
            @elseif($mascota->estado == 'Adoptado') badge-adoptado
            @else badge-rescatada @endif">
            <i class="fas 
                @if($mascota->estado == 'En adopcion') fa-heart
                @elseif($mascota->estado == 'Adoptado') fa-home
                @else fa-shield-alt @endif me-1">
            </i>
            {{ $mascota->estado }}
        </div>
    </div>

    <!-- Contenido de la Card -->
    <div class="card-body d-flex flex-column">
        <!-- Nombre y Especie -->
        <div class="mb-3">
            <h5 class="mascota-nombre">{{ $mascota->Nombre_mascota }}</h5>
            <div class="mascota-especie">
                <i class="fas fa-paw me-1"></i>
                {{ $mascota->Especie }}
                @if($mascota->Raza)
                <span class="text-muted">• {{ $mascota->Raza }}</span>
                @endif
            </div>
        </div>

        <!-- Información Detallada -->
        <div class="mascota-info mb-3">
            <div class="info-item">
                <i class="fas fa-birthday-cake text-fucsia"></i>
                <span>{{ $mascota->Edad_aprox }} años</span>
            </div>
            <div class="info-item">
                <i class="fas fa-venus-mars text-fucsia"></i>
                <span>{{ $mascota->Genero }}</span>
            </div>
            <div class="info-item">
                <i class="fas fa-map-marker-alt text-fucsia"></i>
                <span>{{ Str::limit($mascota->Lugar_rescate, 20) }}</span>
            </div>
        </div>

        <!-- Descripción -->
        <div class="mascota-descripcion mb-3 flex-grow-1">
            <p class="text-muted small">
                {{ Str::limit($mascota->Descripcion, 120) }}
            </p>
        </div>

        <!-- Botones de Acción -->
        <div class="mascota-actions mt-auto">
            <div class="d-grid gap-2">
                <a href="{{ route('mascotas.show', $mascota) }}" 
                   class="btn btn-primary btn-sm">
                    <i class="fas fa-eye me-1"></i>Ver Detalles
                </a>
                <a href="{{ route('mascotas.edit', $mascota) }}" 
                   class="btn btn-outline-warning btn-sm">
                    <i class="fas fa-edit me-1"></i>Editar
                </a>
            </div>
        </div>
    </div>
</div>