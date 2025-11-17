@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- BOTONES DE ACCIÓN --}}
    <div class="d-flex gap-2 mb-4">
        <a href="{{ route('mascotas.edit', $mascota) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Editar Mascota
        </a>
        <a href="{{ route('mascotas.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Volver al Listado
        </a>
    </div>

    <div class="row">
        {{-- COLUMNA IZQUIERDA: GALERÍA DE FOTOS --}}
        <div class="col-lg-5 mb-4">
            {{-- Foto Principal Grande --}}
            <div class="card shadow-lg border-0 mb-3">
                @if($mascota->galeria_fotos && count($mascota->galeria_fotos) > 0)
                    <img src="{{ Storage::url($mascota->galeria_fotos[0]['ruta']) }}" 
                         class="card-img-top gallery-main-img"
                         alt="Foto de {{ $mascota->Nombre_mascota }}" 
                         id="foto-principal"
                         style="height: 400px; object-fit: cover; cursor: pointer;"
                         data-bs-toggle="modal" 
                         data-bs-target="#galeriaModal">
                @else
                    <img src="{{ Storage::url($mascota->Foto) }}" 
                         class="card-img-top"
                         alt="Foto de {{ $mascota->Nombre_mascota }}" 
                         style="height: 400px; object-fit: cover;">
                @endif
                
                <div class="card-body bg-light text-center">
                    <h1 class="card-title text-primary display-4 fw-bolder mb-0">{{ $mascota->Nombre_mascota }}</h1>
                    <p class="text-muted lead">{{ $mascota->Especie }} en Adopción</p>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-success fs-6">{{ $mascota->estado }}</span>
                        <span class="text-secondary fw-bold">{{ $mascota->Edad_aprox }} años</span>
                    </div>
                    @if($mascota->galeria_fotos && count($mascota->galeria_fotos) > 1)
                        <small class="text-muted mt-2 d-block">
                            <i class="fas fa-images me-1"></i>
                            Haz clic en la foto para ver la galería completa ({{ count($mascota->galeria_fotos) }} fotos)
                        </small>
                    @endif
                </div>
            </div>

            {{-- Miniaturas de la Galería --}}
            @if($mascota->galeria_fotos && count($mascota->galeria_fotos) > 1)
            <div class="row g-2 mb-4">
                <div class="col-12">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-th me-2"></i>Galería de Fotos
                    </h5>
                </div>
                @foreach($mascota->galeria_fotos as $index => $foto)
                <div class="col-3">
                    <div class="thumbnail-container position-relative">
                        <img src="{{ Storage::url($foto['ruta']) }}" 
                             class="img-thumbnail gallery-thumbnail {{ $index === 0 ? 'active' : '' }}"
                             style="height: 80px; object-fit: cover; width: 100%; cursor: pointer;"
                             onclick="cambiarFotoPrincipal('{{ Storage::url($foto['ruta']) }}', {{ $index }})"
                             alt="{{ $foto['titulo'] ?? 'Foto ' . ($index + 1) }}"
                             data-bs-toggle="modal" 
                             data-bs-target="#galeriaModal"
                             data-index="{{ $index }}">
                        @if($index === 0)
                            <span class="badge bg-primary position-absolute top-0 start-0">Principal</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- Sección de Adopción --}}
            <div class="mt-4 p-4 bg-primary text-white rounded shadow">
                <h3 class="fw-bold">¿Listo para Adoptar?</h3>
                <p>Si {{ $mascota->Nombre_mascota }} te ha robado el corazón, ¡inicia el proceso de solicitud ahora!</p>
                
                <a href="{{ route('adopciones.create') }}?mascota_id={{ $mascota->id }}" class="btn btn-warning btn-lg w-100 fw-bold">
                    Iniciar Solicitud de Adopción
                </a>
                <small class="d-block mt-2 text-center text-light">Serás redirigido a un formulario de registro/inicio de sesión.</small>
            </div>
        </div>

        {{-- COLUMNA DERECHA: INFORMACIÓN DETALLADA --}}
        <div class="col-lg-7">
            
            {{-- Descripción --}}
            <div class="mb-4">
                <h2 class="text-primary fw-bold">
                    <i class="fas fa-heart me-2"></i>Sobre Mí
                </h2>
                <p class="fs-5">{{ $mascota->Descripcion }}</p>
            </div>

            {{-- Detalles Técnicos --}}
            <div class="card shadow mb-4">
                <div class="card-header bg-secondary text-white fw-bold">
                    <i class="fas fa-info-circle me-2"></i>Ficha Técnica
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Género:</strong> 
                        <span class="badge bg-info">{{ $mascota->Genero }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Lugar de Rescate:</strong> {{ $mascota->Lugar_rescate }}
                    </li>
                    <li class="list-group-item">
                        <strong>Fecha de Ingreso:</strong> 
                        {{ \Carbon\Carbon::parse($mascota->Fecha_ingreso)->format('d/m/Y') }}
                    </li>
                    <li class="list-group-item">
                        <strong>Responsable (Fundación):</strong> 
                        {{ $mascota->fundacion ? $mascota->fundacion->Nombre_1 : 'No asignada' }}
                    </li>
                </ul>
            </div>
            
            {{-- Razas --}}
            <div class="card shadow mb-4">
                <div class="card-header bg-secondary text-white fw-bold">
                    <i class="fas fa-paw me-2"></i>Raza / Cruce
                </div>
                <div class="card-body">
                    @forelse ($mascota->razas as $raza)
                        <span class="badge bg-info text-dark fs-6 me-2 mb-2">{{ $raza->nombre_raza }}</span>
                    @empty
                        <p class="text-muted">No hay información de raza registrada.</p>
                    @endforelse
                </div>
            </div>

            {{-- Vacunas --}}
            <div class="card shadow">
                <div class="card-header bg-secondary text-white fw-bold">
                    <i class="fas fa-syringe me-2"></i>Historial de Vacunación
                </div>
                <div class="card-body">
                    @if($mascota->vacunas && $mascota->vacunas !== 'No especificado')
                        <p class="fs-5 text-success">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ $mascota->vacunas }}
                        </p>
                    @else
                        <p class="text-muted">
                            <i class="fas fa-info-circle me-2"></i>
                            Aún no se ha registrado el historial de vacunas detallado.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL PARA GALERÍA COMPLETA --}}
@if($mascota->galeria_fotos && count($mascota->galeria_fotos) > 0)
<div class="modal fade" id="galeriaModal" tabindex="-1" aria-labelledby="galeriaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="galeriaModalLabel">
                    Galería de {{ $mascota->Nombre_mascota }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="carouselGaleria" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($mascota->galeria_fotos as $index => $foto)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ Storage::url($foto['ruta']) }}" 
                                 class="d-block w-100 rounded"
                                 style="max-height: 500px; object-fit: contain;"
                                 alt="{{ $foto['titulo'] ?? 'Foto ' . ($index + 1) }}">
                            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                                <h5>{{ $foto['titulo'] ?? 'Foto ' . ($index + 1) }}</h5>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @if(count($mascota->galeria_fotos) > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselGaleria" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselGaleria" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <small class="text-muted">
                    Foto <span id="current-photo">1</span> de {{ count($mascota->galeria_fotos) }}
                </small>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@section('styles')
<style>
.gallery-thumbnail {
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.gallery-thumbnail:hover, 
.gallery-thumbnail.active {
    border-color: #007bff;
    transform: scale(1.05);
}

.thumbnail-container {
    transition: all 0.3s ease;
}

.gallery-main-img:hover {
    opacity: 0.9;
}

.carousel-item {
    text-align: center;
    background: #f8f9fa;
}
</style>
@endsection

@section('scripts')
<script>
function cambiarFotoPrincipal(rutaImagen, index) {
    // Cambiar la foto principal
    document.getElementById('foto-principal').src = rutaImagen;
    
    // Actualizar miniaturas activas
    document.querySelectorAll('.gallery-thumbnail').forEach(thumb => {
        thumb.classList.remove('active');
    });
    document.querySelectorAll('.gallery-thumbnail')[index].classList.add('active');
}

// Actualizar contador en el modal
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('carouselGaleria');
    if (carousel) {
        carousel.addEventListener('slid.bs.carousel', function (e) {
            const activeIndex = e.to;
            document.getElementById('current-photo').textContent = activeIndex + 1;
        });
    }
});
</script>
@endsection