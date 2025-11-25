<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos de Mascotas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/pages/eventos/index.css') }}" rel="stylesheet">
    <!-- Agregar Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    @extends('portals.admin.layouts.app')
    @section('content')
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="text-white">Eventos para Mascotas</h1> 
                    <a href="{{ route('eventos.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Crear Nuevo Evento
                    </a>
                </div>
            </div>
        </div>

        @if($eventos->count() > 0)
            <div class="row">
                @foreach($eventos as $evento)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card event-card h-100">
                        @if($evento->imagen_url)
                            <img src="{{ asset('storage' . str_replace('/storage', '', $evento->imagen_url)) }}" 
                                 class="card-img-top" 
                                 alt="{{ $evento->Nombre_evento }}">
                        @else
                            <img src="https://via.placeholder.com/300x200/4F46E5/FFFFFF?text=Evento+Mascotas" 
                                 class="card-img-top" 
                                 alt="Imagen por defecto">
                        @endif
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $evento->Nombre_evento }}</h5>
                            <p class="card-text flex-grow-1">{{ Str::limit($evento->Descripcion, 100) }}</p>
                            
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt"></i> {{ $evento->Lugar_evento }}
                                    </small>
                                    <span class="event-date">
                                        {{ \Carbon\Carbon::parse($evento->Fecha_evento)->format('d M Y') }}
                                    </span>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <a href="{{ route('eventos.show', $evento) }}" class="btn btn-outline-primary btn-sm flex-fill">
                                        <i class="fas fa-eye"></i> Ver Detalles
                                    </a>
                                    
                                    <!-- Botón Eliminar con confirmación -->
                                    <form action="{{ route('eventos.destroy', $evento) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" 
                                                onclick="return confirm('¿Estás seguro de que quieres eliminar este evento?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <h4>No hay eventos programados</h4>
                        <p>¡Crea el primer evento para mascotas!</p>
                        <a href="{{ route('eventos.create') }}" class="btn btn-primary">
                            Crear Primer Evento
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>