@extends('public.layouts.app')

@section('title', 'Mis Solicitudes de Adopción')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Mis Solicitudes de Adopción</h1>

    @if($solicitudes->count() > 0)
        <div class="row">
            @foreach($solicitudes as $solicitud)
                <div class="col-md-6 mb-4">
                    <div class="card solicitud-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                @if($solicitud->solicitable && $solicitud->solicitable->foto_principal)
                                    <img src="{{ Storage::url($solicitud->solicitable->foto_principal) }}"
                                         class="solicitud-mascota-img me-3"
                                         alt="{{ $solicitud->solicitable->nombre_mascota }}">
                                @else
                                    <div class="solicitud-mascota-placeholder me-3">
                                        <i class="fas fa-paw"></i>
                                    </div>
                                @endif
                                <div>
                                    <h5 class="mb-1">{{ $solicitud->solicitable->nombre_mascota ?? 'Mascota' }}</h5>
                                    <p class="text-muted mb-0">Solicitud #{{ $solicitud->id }}</p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <span class="badge bg-{{ $solicitud->estado == 'pendiente' ? 'warning' : ($solicitud->estado == 'aprobada' ? 'success' : ($solicitud->estado == 'rechazada' ? 'danger' : 'info')) }}">
                                    {{ ucfirst(str_replace('_', ' ', $solicitud->estado)) }}
                                </span>
                                <span class="badge bg-secondary ms-2">
                                    {{ $solicitud->created_at->format('d/m/Y') }}
                                </span>
                            </div>

                            <p class="card-text">{{ Str::limit($solicitud->contenido, 100) }}</p>

                            <a href="{{ route('public.adopciones.solicitud-detalle', $solicitud->id) }}"
                               class="btn btn-turquesa btn-sm">
                                Ver detalles
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $solicitudes->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-clipboard-list fa-4x text-muted mb-3"></i>
            <h3 class="text-muted">No tienes solicitudes</h3>
            <p class="text-muted">Aún no has solicitado ninguna adopción</p>
            <a href="{{ route('public.adopciones.index') }}" class="btn btn-turquesa mt-3">
                <i class="fas fa-paw me-2"></i>Ver mascotas disponibles
            </a>
        </div>
    @endif
</div>
@endsection
