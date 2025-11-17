<link rel="stylesheet" href="{{ asset('css/mascotas/index.css') }}">

@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/mascotas/index.css') }}">
@endsection

@section('content')
    <div class="container-fluid px-3 px-lg-5">

        <!-- Hero Section -->
        <div class="row">
            <div class="col-12">
                <div class="mascotas-hero text-center">
                    <h1>🐾 Encuentra a tu Compañero Perfecto</h1>
                    <p class="lead">Descubre mascotas increíbles esperando un hogar lleno de amor</p>
                </div>
            </div>
        </div>

        <!-- Filtros -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="filtros-mascotas">
                    <form action="{{ route('mascotas.index') }}" method="GET" class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label for="especie" class="form-label">🐕 Especie</label>
                            <select name="especie" id="especie" class="form-select">
                                <option value="">Todas las especies</option>
                                @foreach ($especies as $especie)
                                    <option value="{{ $especie }}"
                                        {{ request('especie') == $especie ? 'selected' : '' }}>
                                        {{ $especie }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="estado" class="form-label">📊 Estado</label>
                            <select name="estado" id="estado" class="form-select">
                                <option value="">Todos los estados</option>
                                @foreach ($estados as $estado)
                                    <option value="{{ $estado }}"
                                        {{ request('estado') == $estado ? 'selected' : '' }}>
                                        {{ $estado }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="raza" class="form-label">🏷️ Raza</label>
                            <input type="text" name="raza" id="raza" class="form-control"
                                placeholder="Ej: Labrador, Siames..." value="{{ request('raza') }}">
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-adoptar w-100">
                                <i class="fas fa-search me-2"></i>Buscar Mascotas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Grid de Mascotas -->
        <div class="row">
            @forelse($mascotas as $mascota)
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="card card-mascota">
                        <!-- Imagen con Badge -->
                        <div class="position-relative overflow-hidden">
                            <img src="{{ $mascota->Foto ? Storage::url($mascota->Foto) : asset('img/mascota-placeholder.jpg') }}"
                                class="card-mascota-img" alt="{{ $mascota->Nombre_mascota }}"
                                onerror="this.onerror=null; this.src='{{ asset('img/mascota-placeholder.jpg') }}'">

                            <div
                                class="badge-estado 
                            @if ($mascota->estado == 'En adopcion') badge-disponible
                            @elseif($mascota->estado == 'Rescatada') badge-rescatada
                            @else badge-adoptado @endif">
                                {{ $mascota->estado }}
                            </div>
                        </div>

                        <div class="card-mascota-body">
                            <!-- Información básica -->
                            <h5 class="card-mascota-title">{{ $mascota->Nombre_mascota }}</h5>

                            <div class="card-mascota-meta">
                                <div>
                                    <i class="fas fa-paw"></i>
                                    {{ $mascota->Especie }} | {{ $mascota->Raza }}
                                </div>
                                <div>
                                    <i class="fas fa-birthday-cake"></i>
                                    {{ $mascota->Edad_aprox }} años |
                                    <i class="fas fa-venus-mars"></i>
                                    {{ $mascota->Genero }}
                                </div>
                            </div>

                            <!-- Descripción -->
                            <p class="card-mascota-desc">
                                {{ Str::limit($mascota->Descripcion, 100) }}
                            </p>

                            <!-- Vacunas -->
                            @if ($mascota->tiposVacunas && $mascota->tiposVacunas->count() > 0)
                                <div class="vacunas-info">
                                    <small>
                                        <i class="fas fa-syringe me-1"></i>
                                        <strong>{{ $mascota->tiposVacunas->count() }}</strong> vacuna(s) al día
                                    </small>
                                </div>
                            @else
                                <div class="vacunas-info">
                                    <small class="text-muted">
                                        <i class="fas fa-syringe me-1"></i>
                                        Sin vacunas registradas
                                    </small>
                                </div>
                            @endif

                            <!-- Botón de acción -->
                            <a href="{{ route('mascotas.show', $mascota) }}" class="btn btn-adoptar">
                                <i class="fas fa-heart me-2"></i>
                                Conocer y Adoptar
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="estado-vacio">
                        <i class="fas fa-paw"></i>
                        <h4 class="text-muted mb-3">No se encontraron mascotas</h4>
                        <p class="text-muted mb-4">Intenta ajustar los filtros de búsqueda</p>
                        <a href="{{ route('mascotas.index') }}" class="btn btn-adoptar"
                            style="width: auto; padding: 0.75rem 2rem;">
                            <i class="fas fa-redo me-2"></i>Ver todas las mascotas
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Paginación -->
        @if ($mascotas->hasPages())
            <div class="row mt-5">
                <div class="col-12 paginacion-mascotas">
                    {{ $mascotas->links() }}
                </div>
            </div>
        @endif
    </div>
@endsection
