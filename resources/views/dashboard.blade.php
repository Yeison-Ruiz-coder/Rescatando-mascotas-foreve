@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
</div>

<!-- Estadísticas -->
<div class="row">
    <div class="col-xl-2 col-md-4 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Mascotas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_mascotas'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-paw fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            En Adopción</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['mascotas_adopcion'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-home fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Usuarios</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_usuarios'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Adopciones Pendientes</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['adopciones_pendientes'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Donaciones Totales</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($stats['total_donaciones'], 2) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                            Rescates</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_rescates'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-life-ring fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Acciones Rápidas -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-bolt"></i> Acciones Rápidas</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 mb-2">
                        <a href="{{ route('mascotas.create') }}" class="btn btn-primary btn-block">
                            <i class="fas fa-plus"></i> Nueva Mascota
                        </a>
                    </div>
                    <div class="col-md-2 mb-2">
                        <a href="{{ route('usuarios.create') }}" class="btn btn-success btn-block">
                            <i class="fas fa-user-plus"></i> Nuevo Usuario
                        </a>
                    </div>
                    <div class="col-md-2 mb-2">
                        <a href="{{ route('adopciones.create') }}" class="btn btn-info btn-block">
                            <i class="fas fa-home"></i> Nueva Adopción
                        </a>
                    </div>
                    <div class="col-md-2 mb-2">
                        <a href="{{ route('rescates.create') }}" class="btn btn-warning btn-block">
                            <i class="fas fa-life-ring"></i> Nuevo Rescate
                        </a>
                    </div>
                    <div class="col-md-2 mb-2">
                        <a href="{{ route('donaciones.create') }}" class="btn btn-danger btn-block">
                            <i class="fas fa-donate"></i> Nueva Donación
                        </a>
                    </div>
                    <div class="col-md-2 mb-2">
                        <a href="{{ route('reportes.create') }}" class="btn btn-secondary btn-block">
                            <i class="fas fa-chart-bar"></i> Nuevo Reporte
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mascotas Recientes -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-clock"></i> Mascotas Recientes</h5>
                <a href="{{ route('mascotas.index') }}" class="btn btn-sm btn-outline-primary">Ver Todas</a>
            </div>
            <div class="card-body">
                @if($mascotas_recientes->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Raza</th>
                                <th>Edad</th>
                                <th>Estado</th>
                                <th>Fundación</th>
                                <th>Fecha Ingreso</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mascotas_recientes as $mascota)
                            <tr>
                                <td>{{ $mascota->Nombre_mascota }}</td>
                                <td>{{ $mascota->Raza }}</td>
                                <td>{{ $mascota->Edad_aprox }} años</td>
                                <td>
                                    <span class="badge 
                                        @if($mascota->estado == 'Adoptado') bg-success
                                        @elseif($mascota->estado == 'En adopcion') bg-warning
                                        @else bg-info @endif">
                                        {{ $mascota->estado }}
                                    </span>
                                </td>
                                <td>{{ $mascota->fundacion->Nombre_1 ?? 'Sin fundación' }}</td>
                                <td>{{ $mascota->Fecha_ingreso }}</td>
                                <td class="table-actions">
                                    <a href="{{ route('mascotas.show', $mascota->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted">No hay mascotas registradas.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection