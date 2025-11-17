@extends('layouts.app')

@section('content')
<div class="container py-5">
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error:</strong> Por favor, revisa los campos del formulario de Entrevista/Actualización.
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary">Gestión de Adopción #{{ $adopcion->id }}</h1>
        <a href="{{ route('adopciones.index') }}" class="btn btn-secondary">
            ← Volver a Solicitudes
        </a>
    </div>

    <div class="row">
        {{-- COLUMNA IZQUIERDA: DETALLES Y CAMBIO DE ESTADO --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow-lg mb-4">
                <div class="card-header bg-info text-white">
                    <h4 class="fw-bold mb-0">Detalle de la Solicitud</h4>
                </div>
                <div class="card-body">
                    
                    {{-- Información de Mascota --}}
                    <h5 class="text-success fw-bold">Mascota Solicitada:</h5>
                    <p class="mb-1">
                        <a href="{{ route('mascotas.show', $adopcion->mascota->id) }}" target="_blank" class="fw-bold text-decoration-none">
                            {{ $adopcion->mascota->Nombre_mascota }} ({{ $adopcion->mascota->Especie }})
                        </a>
                    </p>
                    <p class="mb-3"><img src="{{ asset('storage/' . $adopcion->mascota->Foto) }}" alt="Mascota" style="width: 80px; height: 80px; object-fit: cover;" class="rounded-circle"></p>

                    {{-- Información de Solicitante --}}
                    <h5 class="text-success fw-bold mt-3">Datos del Solicitante:</h5>
                    <p class="mb-1"><strong>Nombre:</strong> {{ $adopcion->usuario->Nombre_1 }} {{ $adopcion->usuario->Apellido_1 }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $adopcion->usuario->Email }}</p>
                    <p class="mb-1"><strong>Teléfono:</strong> {{ $adopcion->usuario->Telefono }}</p>
                    <p class="mb-1"><strong>Dirección Registrada:</strong> {{ $adopcion->usuario->Direccion }}</p>

                    <hr>

                    {{-- Datos de la Adopción --}}
                    <p class="mb-1"><strong>Lugar de Adopción:</strong> {{ $adopcion->Lugar_adopcion }}</p>
                    <p class="mb-1"><strong>Fecha de Solicitud:</strong> {{ \Carbon\Carbon::parse($adopcion->Fecha_adopcion)->format('d/m/Y') }}</p>
                    <p class="mb-1"><strong>Estado Actual:</strong> 
                        @php
                            $badgeClass = match ($adopcion->estado) {
                                'Aprobado' => 'bg-success',
                                'Rechazado' => 'bg-danger',
                                default => 'bg-warning text-dark',
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }} fs-6">{{ $adopcion->estado }}</span>
                    </p>
                </div>
            </div>

            {{-- FORMULARIO DE CAMBIO DE ESTADO --}}
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h4 class="fw-bold mb-0">Actualizar Estado de la Adopción</h4>
                </div>
                <div class="card-body">
                    {{-- La ruta update usa el método PUT/PATCH --}}
                    <form action="{{ route('adopciones.update', $adopcion->id) }}" method="POST">
                        @csrf
                        @method('PUT') 
                        
                        <div class="mb-3">
                            <label for="estado" class="form-label">Nuevo Estado:</label>
                            <select name="estado" id="estado" class="form-select" required>
                                <option value="En proceso" {{ $adopcion->estado == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                                <option value="Aprobado" {{ $adopcion->estado == 'Aprobado' ? 'selected' : '' }}>Aprobado</option>
                                <option value="Rechazado" {{ $adopcion->estado == 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
                            </select>
                        </div>
                        
                        {{-- Opcional: Campos ocultos necesarios para el update del controlador --}}
                        <input type="hidden" name="Lugar_adopcion" value="{{ $adopcion->Lugar_adopcion }}">
                        <input type="hidden" name="Fecha_adopcion" value="{{ $adopcion->Fecha_adopcion }}">
                        <input type="hidden" name="usuario_id" value="{{ $adopcion->usuario_id }}">
                        <input type="hidden" name="mascota_id" value="{{ $adopcion->mascota_id }}">

                        <button type="submit" class="btn btn-danger w-100 fw-bold">Guardar Cambio de Estado</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- COLUMNA DERECHA: HISTORIAL Y NUEVA ENTREVISTA --}}
        <div class="col-lg-6">
            
            {{-- HISTORIAL DE ENTREVISTAS --}}
            <div class="card shadow mb-4">
                <div class="card-header bg-secondary text-white">
                    <h4 class="fw-bold mb-0">Historial de Seguimiento (Entrevistas)</h4>
                </div>
                <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                    @forelse ($adopcion->entrevistas as $entrevista)
                        <div class="border-start border-3 p-3 mb-3 
                            @if($entrevista->resultado == 'Aprobado') border-success bg-light-success @elseif($entrevista->resultado == 'Rechazado') border-danger bg-light-danger @else border-warning bg-light @endif">
                            <p class="small text-muted mb-1">
                                <span class="fw-bold">Fecha:</span> {{ \Carbon\Carbon::parse($entrevista->fecha_entrevista)->format('d/m/Y') }} 
                                | <span class="fw-bold">Resultado:</span> {{ $entrevista->resultado }}
                            </p>
                            <p class="mb-1">
                                <strong>Notas:</strong> {{ $entrevista->notas }}
                            </p>
                            <p class="mb-0 small text-end">
                                <small>Realizada por: {{ $entrevista->administrador ? $entrevista->administrador->Nombre_1 : 'Administrador Desconocido' }}</small>
                            </p>
                        </div>
                    @empty
                        <p class="text-muted text-center">Aún no hay registros de seguimiento para esta solicitud.</p>
                    @endforelse
                </div>
            </div>
            
            {{-- FORMULARIO PARA AGREGAR NUEVA ENTREVISTA --}}
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="fw-bold mb-0">Registrar Nuevo Seguimiento</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('entrevistas.store') }}" method="POST">
                        @csrf
                        
                        {{-- Clave foránea oculta --}}
                        <input type="hidden" name="adopcion_id" value="{{ $adopcion->id }}">
                        
                        {{-- Asumimos que el admin logueado es ID 1 para este ejemplo. Debes cambiarlo por Auth::id() --}}
                        <input type="hidden" name="admin_id" value="1"> 
                        
                        <div class="mb-3">
                            <label for="fecha_entrevista" class="form-label">Fecha de Seguimiento:</label>
                            <input type="date" name="fecha_entrevista" id="fecha_entrevista" 
                                   class="form-control" value="{{ old('fecha_entrevista', date('Y-m-d')) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="resultado" class="form-label">Resultado:</label>
                            <select name="resultado" id="resultado" class="form-select" required>
                                <option value="Pendiente">Pendiente (Aún en evaluación)</option>
                                <option value="Aprobado">Aprobado (Pasa a la siguiente fase)</option>
                                <option value="Rechazado">Rechazado (No cumplió requisitos)</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="notas" class="form-label">Notas / Comentarios:</label>
                            <textarea name="notas" id="notas" class="form-control" rows="3" required>{{ old('notas') }}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-success w-100 fw-bold">Guardar Seguimiento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection