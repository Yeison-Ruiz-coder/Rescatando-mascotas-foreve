@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/adopciones/show.css') }}">
@endpush

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- CARD PRINCIPAL -->
            <div class="card card-detalle-adopcion animate-slide-in">
                <!-- HEADER -->
                <div class="card-header card-header-detalle d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-paw me-3 fa-lg"></i>
                        <div>
                            <h4 class="mb-0">Detalle de Adopción</h4>
                            <small class="opacity-75">ID: #{{ $adopcion->id }}</small>
                        </div>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('adopciones.edit', $adopcion->id) }}" class="btn btn-light btn-sm">
                            <i class="fas fa-edit me-2"></i>Editar
                        </a>
                        <a href="{{ route('adopciones.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-2"></i>Volver
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- ALERTAS -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                            <i class="fas fa-check-circle me-2 fa-lg"></i>
                            <div class="flex-grow-1">{{ session('success') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row">
                        <!-- INFORMACIÓN DE LA MASCOTA -->
                        <div class="col-md-6 mb-4">
                            <div class="seccion-info h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icono-seccion icono-mascota">
                                        <i class="fas fa-paw fa-lg"></i>
                                    </div>
                                    <h5 class="mb-0">Información de la Mascota</h5>
                                </div>
                                
                                @if($adopcion->mascota)
                                    <div class="info-item">
                                        <strong>Nombre:</strong>
                                        <span class="valor">{{ $adopcion->mascota->Nombre_mascota }}</span>
                                    </div>
                                    <div class="info-item">
                                        <strong>Especie:</strong>
                                        <span class="valor">{{ $adopcion->mascota->Especie }}</span>
                                    </div>
                                    <div class="info-item">
                                        <strong>Raza:</strong>
                                        <span class="valor">{{ $adopcion->mascota->Raza }}</span>
                                    </div>
                                    <div class="info-item">
                                        <strong>Edad:</strong>
                                        <span class="valor">{{ $adopcion->mascota->Edad_aprox }} años</span>
                                    </div>
                                    <div class="info-item">
                                        <strong>Género:</strong>
                                        <span class="valor">{{ $adopcion->mascota->Genero }}</span>
                                    </div>
                                    <div class="info-item">
                                        <strong>Estado:</strong>
                                        <span class="valor">
                                            <span class="badge badge-estado-detalle 
                                                @if($adopcion->mascota->estado == 'Adoptado') bg-success
                                                @elseif($adopcion->mascota->estado == 'En adopcion') bg-warning
                                                @else bg-info
                                                @endif">
                                                {{ $adopcion->mascota->estado }}
                                            </span>
                                        </span>
                                    </div>
                                @else
                                    <div class="alerta-informativa">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Mascota no encontrada en el sistema
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- INFORMACIÓN DEL ADOPTANTE -->
                        <div class="col-md-6 mb-4">
                            <div class="seccion-info h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icono-seccion icono-usuario">
                                        <i class="fas fa-user fa-lg"></i>
                                    </div>
                                    <h5 class="mb-0">Información del Adoptante</h5>
                                </div>
                                
                                @if($adopcion->usuario)
                                    <div class="info-item">
                                        <strong>Nombre completo:</strong>
                                        <span class="valor">{{ $adopcion->usuario->Nombre_1 }} {{ $adopcion->usuario->Apellido_1 }}</span>
                                    </div>
                                    @if($adopcion->usuario->Nombre_2 || $adopcion->usuario->Apellido_2)
                                    <div class="info-item">
                                        <strong>Nombres adicionales:</strong>
                                        <span class="valor">{{ $adopcion->usuario->Nombre_2 }} {{ $adopcion->usuario->Apellido_2 }}</span>
                                    </div>
                                    @endif
                                    <div class="info-item">
                                        <strong>Email:</strong>
                                        <span class="valor">{{ $adopcion->usuario->Email }}</span>
                                    </div>
                                    <div class="info-item">
                                        <strong>Teléfono:</strong>
                                        <span class="valor">{{ $adopcion->usuario->Telefono }}</span>
                                    </div>
                                    <div class="info-item">
                                        <strong>Dirección:</strong>
                                        <span class="valor">{{ $adopcion->usuario->Direccion }}</span>
                                    </div>
                                    <div class="info-item">
                                        <strong>Tipo de usuario:</strong>
                                        <span class="valor">
                                            <span class="badge badge-estado-detalle bg-secondary">
                                                {{ $adopcion->usuario->tipo }}
                                            </span>
                                        </span>
                                    </div>
                                @else
                                    <div class="alerta-informativa">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Usuario adoptante no encontrado en el sistema
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- SEPARADOR -->
                    <hr class="separador-seccion">

                    <!-- INFORMACIÓN DE LA ADOPCIÓN -->
                    <div class="seccion-info">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icono-seccion icono-adopcion">
                                <i class="fas fa-file-contract fa-lg"></i>
                            </div>
                            <h5 class="mb-0">Información de la Adopción</h5>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <strong>Fecha de Adopción:</strong>
                                    <span class="valor">{{ $adopcion->Fecha_adopcion->format('d/m/Y') }}</span>
                                </div>
                                <div class="info-item">
                                    <strong>Lugar de Adopción:</strong>
                                    <span class="valor">{{ $adopcion->Lugar_adopcion }}</span>
                                </div>
                                <div class="info-item">
                                    <strong>Estado del proceso:</strong>
                                    <span class="valor">
                                        <span class="badge badge-estado-detalle 
                                            @if($adopcion->estado == 'Aprobado') bg-success
                                            @elseif($adopcion->estado == 'En proceso') bg-warning
                                            @else bg-danger
                                            @endif">
                                            {{ $adopcion->estado }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <strong>Fecha de Registro:</strong>
                                    <span class="valor">{{ $adopcion->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="info-item">
                                    <strong>Última Actualización:</strong>
                                    <span class="valor">{{ $adopcion->updated_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- INFORMACIÓN ADICIONAL -->
                        @if($adopcion->fundacion)
                        <div class="info-adicional mt-3">
                            <div class="info-item">
                                <strong>Fundación:</strong>
                                <span class="valor">{{ $adopcion->fundacion->Nombre_1 }}</span>
                            </div>
                            <div class="info-item">
                                <strong>Dirección de la Fundación:</strong>
                                <span class="valor">{{ $adopcion->fundacion->Direccion }}</span>
                            </div>
                        </div>
                        @endif

                        @if($adopcion->administrador)
                        <div class="info-adicional mt-3">
                            <div class="info-item">
                                <strong>Administrador Responsable:</strong>
                                <span class="valor">{{ $adopcion->administrador->Nombre_1 }} {{ $adopcion->administrador->Apellido_1 }}</span>
                            </div>
                        </div>
                        @endif

                        @if($adopcion->razon_rechazo)
                        <div class="alerta-rechazo mt-3">
                            <div class="info-item">
                                <strong>Razón de Rechazo:</strong>
                                <span class="valor">{{ $adopcion->razon_rechazo }}</span>
                            </div>
                        </div>
                        @endif

                        @if($adopcion->fecha_cierre)
                        <div class="info-adicional mt-3">
                            <div class="info-item">
                                <strong>Fecha de Cierre:</strong>
                                <span class="valor">{{ $adopcion->fecha_cierre->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- BOTONES DE ACCIÓN -->
                    <div class="botones-accion">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('adopciones.index') }}" class="btn btn-volver">
                                <i class="fas fa-arrow-left me-2"></i>Volver al Listado
                            </a>
                            <div class="btn-group-acciones-detalle">
                                <a href="{{ route('adopciones.edit', $adopcion->id) }}" class="btn btn-editar-detalle">
                                    <i class="fas fa-edit me-2"></i>Editar Adopción
                                </a>
                                <form action="{{ route('adopciones.destroy', $adopcion->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-eliminar-detalle" 
                                            onclick="return confirm('¿Estás seguro de eliminar esta adopción? Esta acción no se puede deshacer.')">
                                        <i class="fas fa-trash me-2"></i>Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection