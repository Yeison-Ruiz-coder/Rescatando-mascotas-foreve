{{-- GALERÍA DE FOTOS --}}
<!-- Foto Principal Grande -->
<div class="card shadow-lg border-0 mb-3">
    @if ($mascota->galeria_fotos && count($mascota->galeria_fotos) > 0)
        <img src="{{ asset('storage/' . $mascota->galeria_fotos[0]['ruta']) }}"
            class="card-img-top gallery-main-img" alt="Foto de {{ $mascota->Nombre_mascota }}"
            id="foto-principal" data-bs-toggle="modal" data-bs-target="#galeriaModal">
    @else
        <img src="{{ asset('storage/' . $mascota->Foto) }}" class="card-img-top gallery-main-img"
            alt="Foto de {{ $mascota->Nombre_mascota }}">
    @endif

    <div class="card-body bg-light text-center">
        <h1 class="card-title display-4 fw-bolder mb-0">{{ $mascota->Nombre_mascota }}</h1>
        <p class="text-muted lead">{{ $mascota->Especie }} - {{ $mascota->estado }}</p>
        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <span class="badge estado-badge fs-6">{{ $mascota->estado }}</span>
            <span class="text-secondary fw-bold">{{ $mascota->Edad_aprox }} años</span>
        </div>
        @if ($mascota->galeria_fotos && count($mascota->galeria_fotos) > 1)
            <small class="text-muted mt-2 d-block">
                <i class="fas fa-images me-1"></i>
                Haz clic en la foto para ver la galería completa ({{ count($mascota->galeria_fotos) }} fotos)
            </small>
        @endif
    </div>
</div>

<!-- Miniaturas de la Galería -->
@if ($mascota->galeria_fotos && count($mascota->galeria_fotos) > 1)
    <div class="row g-2 mb-4">
        <div class="col-12">
            <h5 class="mb-3">
                <i class="fas fa-th me-2"></i>Galería de Fotos
            </h5>
        </div>
        @foreach ($mascota->galeria_fotos as $index => $foto)
            <div class="col-3">
                <div class="thumbnail-container position-relative">
                    <img src="{{ asset('storage/' . $foto['ruta']) }}"
                        class="img-thumbnail gallery-thumbnail {{ $index === 0 ? 'active' : '' }}"
                        onclick="cambiarFotoPrincipal('{{ asset('storage/' . $foto['ruta']) }}', {{ $index }})"
                        alt="{{ $foto['titulo'] ?? 'Foto ' . ($index + 1) }}" data-bs-toggle="modal"
                        data-bs-target="#galeriaModal" data-index="{{ $index }}">
                    @if ($index === 0)
                        <span class="badge position-absolute top-0 start-0">Principal</span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endif