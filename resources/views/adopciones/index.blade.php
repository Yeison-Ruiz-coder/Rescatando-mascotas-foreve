@extends('layouts.app')

@section('content')
<div class="container py-5">
    
    <header class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary">Gestión de Solicitudes de Adopción</h1>
        {{-- Si el admin necesita crear una solicitud manualmente --}}
        <a href="{{ route('adopciones.create') }}" class="btn btn-success">
            + Nueva Solicitud Manual
        </a>
    </header>

    {{-- Mensajes de éxito o error --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>ID</th>
                            <th>Mascota</th>
                            <th>Solicitante</th>
                            <th>Fecha</th>
                            <th>Lugar</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($adopciones as $adopcion)
                            <tr>
                                <td>{{ $adopcion->id }}</td>
                                {{-- Usamos las relaciones cargadas por el controlador --}}
                                <td>
                                    <span class="fw-bold">{{ $adopcion->mascota->Nombre_mascota }}</span> 
                                    ({{ $adopcion->mascota->Especie }})
                                </td>
                                <td>
                                    {{ $adopcion->usuario->Nombre_1 }} {{ $adopcion->usuario->Apellido_1 }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($adopcion->Fecha_adopcion)->format('d/m/Y') }}</td>
                                <td>{{ $adopcion->Lugar_adopcion }}</td>
                                <td>
                                    {{-- Estilos visuales basados en el estado --}}
                                    @php
                                        $badgeClass = match ($adopcion->estado) {
                                            'Aprobado' => 'bg-success',
                                            'Rechazado' => 'bg-danger',
                                            default => 'bg-warning text-dark', // En proceso
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $adopcion->estado }}</span>
                                </td>
                                <td>
                                    {{-- Botón para ver el detalle y gestionar el proceso --}}
                                    <a href="{{ route('adopciones.show', $adopcion->id) }}" class="btn btn-sm btn-info text-white">
                                        Gestionar
                                    </a>
                                    
                                    {{-- Botón de eliminación (solo visible si tiene permisos) --}}
                                    <form action="{{ route('adopciones.destroy', $adopcion->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar esta solicitud?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">X</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    No hay solicitudes de adopción registradas aún.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection