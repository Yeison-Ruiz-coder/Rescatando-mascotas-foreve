@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/pages/mascotas/public-show.css') }}">
@endsection

@section('content')
<div class="container py-4 fade-in">
    <!-- BREADCRUMB -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb breadcrumb-mascota">
            <li class="breadcrumb-item">
                <a href="{{ route('mascotas.public.index') }}" class="text-decoration-none">
                    <i class="fas fa-arrow-left me-2"></i>Volver a Mascotas
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $mascota->Nombre_mascota }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- COLUMNA IZQUIERDA - IMÁGENES -->
        <div class="col-lg-6 mb-4">
            <!-- IMAGEN PRINCIPAL -->
            <div class="card card-mascota mb-4">
                <div class="card-body p-0">
                    @if($mascota->Foto)
                    <img src="{{ asset('storage/' . $mascota->Foto) }}" 
                         class="img-fluid imagen-principal w-100" 
                         alt="{{ $mascota->Nombre_mascota }}"
                         id="imagenPrincipal">
                    @else
                    <div class="d-flex align-items-center justify-content-center bg-gris-claro" 
                         style="height: 400px;">
                        <i class="fas fa-paw fa-5x text-turquesa opacity-50"></i>
                    </div>
                    @endif
                </div>
            </div>

            <!-- GALERÍA -->
            @if($mascota->galeria_fotos && count($mascota->galeria_fotos) > 0)
            <div class="card card-mascota mb-4">
                <div class="card-header card-header-turquesa">
                    <h6 class="mb-0"><i class="fas fa-images me-2"></i>Más Fotos</h6>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        @foreach($mascota->galeria_fotos as $foto)
                        <div class="col-4">
                            <img src="{{ asset('storage/' . $foto['ruta']) }}" 
                                 class="gallery-thumb" 
                                 alt="{{ $foto['titulo'] ?? 'Foto' }}"
                                 onclick="cambiarImagenPrincipal('{{ asset('storage/' . $foto['ruta']) }}')">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- BOTÓN DE ADOPCIÓN -->
            <div class="card card-mascota">
                <div class="card-body text-center py-4">
                    <h5 class="card-title text-fucsia mb-3">
                        <i class="fas fa-heart me-2"></i>¿Te enamoraste de {{ $mascota->Nombre_mascota }}?
                    </h5>
                    <p class="card-text text-muted mb-4">Da el primer paso para darle un hogar lleno de amor</p>
                    <a href="{{ route('adopciones.solicitar', $mascota->id) }}" 
                       class="btn btn-fucsia btn-lg px-4 py-2 mb-2">
                        <i class="fas fa-heart me-2"></i>Solicitar Adopción
                    </a>
                    <p class="text-muted small">
                        <i class="fas fa-shield-alt me-1"></i>Proceso 100% gratuito y responsable
                    </p>
                </div>
            </div>
        </div>

        <!-- COLUMNA DERECHA - INFORMACIÓN -->
        <div class="col-lg-6">
            <div class="card card-mascota">
                <div class="card-header card-header-turquesa">
                    <h3 class="mb-0 fw-bold">{{ $mascota->Nombre_mascota }}</h3>
                </div>
                <div class="card-body p-4">
                    <!-- BADGES INFORMATIVOS -->
                    <div class="mb-4">
                        <span class="badge badge-especie me-2 mb-2">
                            <i class="fas fa-paw me-1"></i>{{ $mascota->Especie }}
                        </span>
                        <span class="badge badge-genero me-2 mb-2">
                            <i class="fas fa-venus-mars me-1"></i>{{ $mascota->Genero }}
                        </span>
                        <span class="badge bg-secondary me-2 mb-2 px-3 py-2">
                            <i class="fas fa-birthday-cake me-1"></i>{{ $mascota->Edad_aprox }} años
                        </span>
                    </div>

                    <!-- INFORMACIÓN BÁSICA -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <div class="info-circle d-flex align-items-center">
                                <i class="fas fa-paw icono me-3"></i>
                                <div>
                                    <small class="text-muted d-block">Especie</small>
                                    <strong class="text-turquesa">{{ $mascota->Especie }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-circle d-flex align-items-center">
                                <i class="fas fa-venus-mars icono me-3"></i>
                                <div>
                                    <small class="text-muted d-block">Género</small>
                                    <strong class="text-turquesa">{{ $mascota->Genero }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-circle d-flex align-items-center">
                                <i class="fas fa-birthday-cake icono me-3"></i>
                                <div>
                                    <small class="text-muted d-block">Edad</small>
                                    <strong class="text-turquesa">{{ $mascota->Edad_aprox }} años</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-circle d-flex align-items-center">
                                <i class="fas fa-dna icono me-3"></i>
                                <div>
                                    <small class="text-muted d-block">Raza</small>
                                    <strong class="text-turquesa">{{ $mascota->Raza }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DESCRIPCIÓN -->
                    <div class="mb-4">
                        <h5 class="text-turquesa mb-3 fw-bold">
                            <i class="fas fa-file-alt me-2"></i>Su Historia
                        </h5>
                        <div class="info-circle">
                            <p class="text-muted mb-0" style="line-height: 1.6;">
                                {{ $mascota->Descripcion }}
                            </p>
                        </div>
                    </div>

                    <!-- INFORMACIÓN DE SALUD -->
                    <div class="mb-4">
                        <h5 class="text-turquesa mb-3 fw-bold">
                            <i class="fas fa-heartbeat me-2"></i>Salud y Cuidados
                        </h5>
                        <div class="estado-vacunas d-flex align-items-center mb-3 p-3">
                            <i class="fas fa-syringe text-turquesa me-3 fs-5"></i>
                            <div>
                                <small class="text-muted d-block">Vacunas</small>
                                <strong class="text-turquesa">{{ $mascota->vacunas ?: 'En proceso' }}</strong>
                            </div>
                        </div>
                        <div class="estado-salud d-flex align-items-center p-3">
                            <i class="fas fa-map-marker-alt text-turquesa me-3 fs-5"></i>
                            <div>
                                <small class="text-muted d-block">Rescatado en</small>
                                <strong class="text-turquesa">{{ $mascota->Lugar_rescate }}</strong>
                            </div>
                        </div>
                    </div>

                    <!-- INFORMACIÓN DE LA FUNDACIÓN -->
                    @if($mascota->fundacion)
                    <div class="mb-4">
                        <h5 class="text-turquesa mb-3 fw-bold">
                            <i class="fas fa-home me-2"></i>Fundación Responsable
                        </h5>
                        <div class="card border-turquesa hover-lift">
                            <div class="card-header bg-turquesa text-white py-2">
                                <h6 class="mb-0">{{ $mascota->fundacion->Nombre_1 }}</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-map-marker-alt text-fucsia me-3"></i>
                                    <span class="text-muted">{{ $mascota->fundacion->Direccion }}</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-phone text-fucsia me-3"></i>
                                    <span class="text-muted">{{ $mascota->fundacion->Telefono }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-envelope text-fucsia me-3"></i>
                                    <span class="text-muted">{{ $mascota->fundacion->Email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- BOTONES DE ACCIÓN -->
                    <div class="d-grid gap-3 mt-4">
                        <button class="btn btn-fucsia btn-lg py-3 fw-bold" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalAdopcion">
                            <i class="fas fa-heart me-2"></i>¡Quiero Adoptar!
                        </button>
                        <a href="{{ route('mascotas.public.index') }}" 
                           class="btn btn-outline-turquesa btn-lg py-3">
                            <i class="fas fa-paw me-2"></i>Ver Otras Mascotas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BOTÓN FLOTANTE PARA MÓVIL -->
<a href="{{ route('adopciones.solicitar', $mascota->id) }}" 
   class="btn btn-adopcion-flotante d-lg-none">
    <i class="fas fa-heart me-2"></i>Adoptar
</a>

<!-- MODAL DE ADOPCIÓN -->
<div class="modal fade modal-mascota" id="modalAdopcion" tabindex="-1" aria-labelledby="modalAdopcionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-white" id="modalAdopcionLabel">
                    <i class="fas fa-heart me-2"></i>Solicitar Adopción de {{ $mascota->Nombre_mascota }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="alert bg-light-info border-0 mb-4">
                    <i class="fas fa-info-circle text-turquesa me-2"></i>
                    Para solicitar la adopción, por favor contacta directamente a la fundación.
                </div>
                
                @if($mascota->fundacion)
                <div class="card border-turquesa mb-4">
                    <div class="card-header bg-light py-2">
                        <h6 class="mb-0 text-turquesa fw-bold">Información de Contacto</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong class="text-turquesa d-block mb-1">Fundación:</strong>
                                <span class="text-muted">{{ $mascota->fundacion->Nombre_1 }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong class="text-turquesa d-block mb-1">Teléfono:</strong>
                                <span class="text-muted">{{ $mascota->fundacion->Telefono }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong class="text-turquesa d-block mb-1">Email:</strong>
                                <span class="text-muted">{{ $mascota->fundacion->Email }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong class="text-turquesa d-block mb-1">Dirección:</strong>
                                <span class="text-muted">{{ $mascota->fundacion->Direccion }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="p-3 bg-gris-claro rounded">
                    <p class="text-muted mb-2 small">
                        <i class="fas fa-clock text-fucsia me-2"></i>
                        <strong>Proceso de adopción:</strong>
                    </p>
                    <ul class="text-muted small mb-0 ps-3">
                        <li>Entrevista personal</li>
                        <li>Visita domiciliaria</li>
                        <li>Seguimiento post-adopción</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-turquesa" data-bs-dismiss="modal">Cerrar</button>
                @if($mascota->fundacion)
                <a href="tel:{{ $mascota->fundacion->Telefono }}" class="btn btn-fucsia">
                    <i class="fas fa-phone me-2"></i>Llamar Ahora
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function cambiarImagenPrincipal(nuevaSrc) {
    const imagenPrincipal = document.getElementById('imagenPrincipal');
    imagenPrincipal.style.opacity = '0.7';
    
    setTimeout(() => {
        imagenPrincipal.src = nuevaSrc;
        imagenPrincipal.style.opacity = '1';
    }, 200);
}

// Efecto hover para imágenes
document.addEventListener('DOMContentLoaded', function() {
    const imagenPrincipal = document.getElementById('imagenPrincipal');
    if (imagenPrincipal) {
        imagenPrincipal.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.02)';
        });
        
        imagenPrincipal.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    }
});
</script>
@endsection