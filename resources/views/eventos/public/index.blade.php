<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos para Mascotas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --color-turquesa: #1B8E95;
            --color-fucsia: #FD4586;
            --color-gris-claro: #f4f4f4;
            --color-texto-claro: #fff;
            --color-texto-oscuro: #333;
        }

        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: var(--color-gris-claro);
        }

        .event-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            color: var(--color-turquesa);
            font-weight: 700;
        }

        .event-date {
            background-color: var(--color-turquesa);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .btn-primary {
            background-color: var(--color-turquesa);
            border-color: var(--color-turquesa);
        }

        .btn-primary:hover {
            background-color: #14747a;
            border-color: #14747a;
        }
    </style>
</head>
<body>
    @extends('layouts.app') <!-- O tu layout público -->

    @section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h1 class="text-turquesa">Eventos para Mascotas</h1>
                <p class="lead">Descubre los mejores eventos para ti y tu mascota</p>
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
                                 alt="{{ $evento->Nombre_evento }}"
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/300x200/1B8E95/FFFFFF?text=Evento+Mascotas" 
                                 class="card-img-top" 
                                 alt="Imagen por defecto"
                                 style="height: 200px; object-fit: cover;">
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
                                
                                <a href="{{ route('eventos.public.show', $evento) }}" class="btn btn-primary btn-sm w-100">
                                    <i class="fas fa-eye"></i> Ver Detalles
                                </a>
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
                        <p>Próximamente tendremos nuevos eventos para ti y tu mascota.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>