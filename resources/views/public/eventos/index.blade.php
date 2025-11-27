<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Eventos para Mascotas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/pages/eventos/index.css') }}">

</head>
<body>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h1 class="text-primary">Eventos para Mascotas</h1>
                <p class="lead">Descubre eventos especiales para ti y tu mascota</p>
=======
    <title>Eventos de Mascotas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/pages/eventos/index.css') }}" rel="stylesheet">
    <!-- Agregar Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    @extends('portals.public.layouts.app')
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
                <div class="text-center mb-4">
                    <h1 class="text-turquesa">Eventos para Mascotas</h1>
                    <p class="lead text-muted">Descubre los próximos eventos y actividades para mascotas</p>
                </div>
>>>>>>> 1274db8634a24c3548de392f474346b559fedcbe
            </div>
        </div>

        @if($eventos->count() > 0)
            <div class="row">
                @foreach($eventos as $evento)
                <div class="col-md-6 col-lg-4 mb-4">
<<<<<<< HEAD
                    <div class="card event-card h-100">
                        @if($evento->imagen_url)
                            <img src="{{ asset($evento->imagen_url) }}" 
                                 class="card-img-top" 
=======
                    <div class="card event-card h-100 shadow-sm">
                        @if($evento->imagen_url)
                            <img src="{{ asset('storage' . str_replace('/storage', '', $evento->imagen_url)) }}" 
                                 class="card-img-top event-image" 
>>>>>>> 1274db8634a24c3548de392f474346b559fedcbe
                                 alt="{{ $evento->Nombre_evento }}"
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/300x200/1B8E95/FFFFFF?text=Evento+Mascotas" 
<<<<<<< HEAD
                                 class="card-img-top" 
=======
                                 class="card-img-top event-image" 
>>>>>>> 1274db8634a24c3548de392f474346b559fedcbe
                                 alt="Imagen por defecto"
                                 style="height: 200px; object-fit: cover;">
                        @endif
                        
                        <div class="card-body d-flex flex-column">
<<<<<<< HEAD
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
                                
                                <a href="{{ route('eventos.public.show', $evento->id) }}" class="btn btn-primary btn-sm w-100">
                                    <i class="fas fa-eye"></i> Ver Detalles
                                </a>
=======
                            <h5 class="card-title text-turquesa">{{ $evento->Nombre_evento }}</h5>
                            <p class="card-text flex-grow-1 text-muted">
                                {{ Str::limit($evento->Descripcion, 100) }}
                            </p>
                            
                            <div class="mt-auto">
                                <div class="event-info mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-map-marker-alt text-fucsia me-2"></i>
                                        <small class="text-dark">{{ $evento->Lugar_evento }}</small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-alt text-fucsia me-2"></i>
                                        <small class="text-dark">
                                            {{ \Carbon\Carbon::parse($evento->created_at)->format('d M Y') }}
                                        </small>
                                    </div>
                                </div>
                                
                                <div class="d-grid">
                                    <a href="{{ route('public.eventos.show', $evento) }}" 
                                       class="btn btn-turquesa btn-sm">
                                        <i class="fas fa-eye me-1"></i> Ver Detalles del Evento
                                    </a>
                                </div>
>>>>>>> 1274db8634a24c3548de392f474346b559fedcbe
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="row">
                <div class="col-12">
<<<<<<< HEAD
                    <div class="alert alert-info text-center">
                        <h4>No hay eventos programados</h4>
                        <p>Próximamente tendremos eventos especiales para ti y tu mascota.</p>
=======
                    <div class="alert alert-info text-center py-5">
                        <i class="fas fa-calendar-times fa-3x text-turquesa mb-3"></i>
                        <h4 class="text-turquesa">No hay eventos programados</h4>
                        <p class="text-muted">Próximamente tendremos eventos para mascotas. ¡Mantente atento!</p>
>>>>>>> 1274db8634a24c3548de392f474346b559fedcbe
                    </div>
                </div>
            </div>
        @endif
    </div>
<<<<<<< HEAD

=======
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
>>>>>>> 1274db8634a24c3548de392f474346b559fedcbe
</body>
</html>