@extends('public.layouts.app')

@section('title', 'Detalle de Solicitud #' . $solicitud->id)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-turquesa text-white">
                    <h4 class="mb-0">Detalle de Solicitud #{{ $solicitud->id }}</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Información de la Mascota</h5>
                            <p><strong>Nombre:</strong> {{ $solicitud->solicitable->nombre_mascota ?? 'N/A' }}</p>
                            <p><strong>Especie:</strong> {{ $solicitud->solicitable->especie ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Estado de la Solicitud</h5>
                            @php
                                $estadoClass = [
                                    'pendiente' => 'warning',
                                    'en_revision' => 'info',
                                    'aprobada' => 'success',
                                    'rechazada' => 'danger',
                                    'completada' => 'secondary'
                                ][$solicitud->estado] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $estadoClass }} p-2">
                                {{ ucfirst(str_replace('_', ' ', $solicitud->estado)) }}
                            </span>
                            <p class="mt-2"><small>Creada: {{ $solicitud->created_at->format('d/m/Y H:i') }}</small></p>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-3">Tus Datos</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nombre:</strong> {{ $solicitud->nombre_solicitante }} {{ $solicitud->getDatoAdopcion('apellido_solicitante') }}</p>
                            <p><strong>Email:</strong> {{ $solicitud->email_solicitante }}</p>
                            <p><strong>Teléfono:</strong> {{ $solicitud->telefono_solicitante }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Documento:</strong> {{ $solicitud->getDatoAdopcion('documento_identidad') }}</p>
                            <p><strong>Dirección:</strong> {{ $solicitud->getDatoAdopcion('direccion') }}</p>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-3">Detalles de la Solicitud</h5>
                    <p><strong>Experiencia con mascotas:</strong> {{ $solicitud->getDatoAdopcion('experiencia_mascotas') }}</p>
                    <p><strong>Tipo de vivienda:</strong> {{ $solicitud->getDatoAdopcion('tipo_vivienda') }}</p>
                    <p><strong>Motivo:</strong></p>
                    <div class="p-3 bg-light rounded">
                        {{ $solicitud->contenido }}
                    </div>

                    <hr>

                    <h5 class="mb-3">Compromisos</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <span class="badge bg-{{ $solicitud->getDatoAdopcion('compromiso_cuidado') ? 'success' : 'danger' }}">
                                Cuidado responsable
                            </span>
                        </div>
                        <div class="col-md-4">
                            <span class="badge bg-{{ $solicitud->getDatoAdopcion('compromiso_esterilizacion') ? 'success' : 'danger' }}">
                                Esterilización
                            </span>
                        </div>
                        <div class="col-md-4">
                            <span class="badge bg-{{ $solicitud->getDatoAdopcion('compromiso_seguimiento') ? 'success' : 'danger' }}">
                                Seguimiento
                            </span>
                        </div>
                    </div>

                    @if($solicitud->estado === 'rechazada' && $solicitud->razon_rechazo)
                        <hr>
                        <div class="alert alert-danger">
                            <h5>Razón del rechazo:</h5>
                            <p>{{ $solicitud->razon_rechazo }}</p>
                        </div>
                    @endif

                    @if($solicitud->estado === 'aprobada')
                        <hr>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            ¡Tu solicitud ha sido aprobada! Pronto te contactarán para coordinar la adopción.
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('public.adopciones.mis-solicitudes') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Volver a mis solicitudes
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
