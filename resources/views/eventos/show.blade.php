<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $evento->Nombre_evento }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/pages/eventos/show.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        @if($evento->imagen_url)
                            <img src="{{ asset('storage' . str_replace('/storage', '', $evento->imagen_url)) }}" 
                                 class="event-image mb-4" 
                                 alt="{{ $evento->Nombre_evento }}">
                        @endif
                        
                        <h1 class="card-title">{{ $evento->Nombre_evento }}</h1>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <strong class="me-2"><i class="bi bi-geo-alt"></i> Lugar:</strong>
                                    <span class="text-muted">{{ $evento->Lugar_evento }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <strong class="me-2"><i class="bi bi-calendar-event"></i> Fecha:</strong>
                                    <span class="text-muted">{{ \Carbon\Carbon::parse($evento->Fecha_evento)->format('d M Y, h:i A') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>Descripción del Evento:</h5>
                            <p class="card-text">{{ $evento->Descripcion }}</p>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('eventos.index') }}" class="btn btn-secondary">
                                Volver a Eventos
                            </a>
                            <small class="text-muted">
                                Creado el: {{ $evento->created_at->format('d M Y') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>