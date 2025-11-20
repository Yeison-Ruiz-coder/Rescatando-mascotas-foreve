@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/adopciones/create.css') }}">
@endpush

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- HEADER -->
            <div class="create-adopcion-header animacion-entrada">
                <h1 class="display-5 fw-bold">
                    <i class="fas fa-paw me-3"></i>Registrar Nueva Adopción
                </h1>
                <p class="lead">
                    Completa el formulario para registrar un nuevo proceso de adopción en el sistema
                </p>
            </div>

            <!-- ALERTAS DE ERROR -->
            @if ($errors->any())
                <div class="alertas-error mb-4 animacion-entrada">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-exclamation-triangle me-2 text-danger"></i>
                        <h5 class="mb-0 text-danger">Por favor corrige los siguientes errores:</h5>
                    </div>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- FORMULARIO PRINCIPAL -->
            <div class="card card-formulario-adopcion animacion-entrada">
                <div class="card-header card-header-formulario">
                    <h4 class="mb-0">
                        <i class="fas fa-file-contract"></i>
                        Formulario de Registro de Adopción
                    </h4>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('adopciones.store') }}" method="POST" id="formAdopcion">
                        @csrf

                        <!-- INFORMACIÓN PRINCIPAL -->
                        <div class="grupo-formulario transicion-suave">
                            <h5>
                                <i class="fas fa-info-circle"></i>
                                Información Principal
                            </h5>
                            
                            <div class="row">
                                <!-- Mascota -->
                                <div class="col-md-6 mb-4">
                                    <label for="mascota_id" class="form-label-crear" required>
                                        <i class="fas fa-paw"></i>Mascota
                                    </label>
                                    <select class="form-select-crear @error('mascota_id') is-invalid @enderror" 
                                            id="mascota_id" name="mascota_id" required>
                                        <option value="">Selecciona una mascota</option>
                                        @foreach ($mascotas as $mascota)
                                            <option value="{{ $mascota->id }}"
                                                {{ old('mascota_id') == $mascota->id ? 'selected' : '' }}>
                                                {{ $mascota->Nombre_mascota }} - {{ $mascota->Especie }} 
                                                ({{ $mascota->Raza }}) - {{ $mascota->estado }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('mascota_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted mt-1">
                                        Solo se muestran mascotas disponibles para adopción
                                    </small>
                                </div>

                                <!-- Usuario Adoptante -->
                                <div class="col-md-6 mb-4">
                                    <label for="usuario_id" class="form-label-crear" required>
                                        <i class="fas fa-user"></i>Adoptante
                                    </label>
                                    <select class="form-select-crear @error('usuario_id') is-invalid @enderror" 
                                            id="usuario_id" name="usuario_id" required>
                                        <option value="">Selecciona un adoptante</option>
                                        @foreach ($usuarios as $usuario)
                                            <option value="{{ $usuario->id }}"
                                                {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
                                                {{ $usuario->Nombre_1 }} {{ $usuario->Apellido_1 }}
                                                @if ($usuario->Nombre_2 || $usuario->Apellido_2)
                                                    ({{ $usuario->Nombre_2 }} {{ $usuario->Apellido_2 }})
                                                @endif
                                                - {{ $usuario->Email }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('usuario_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted mt-1">
                                        Solo se muestran usuarios registrados como clientes
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- DETALLES DE LA ADOPCIÓN -->
                        <div class="grupo-formulario transicion-suave">
                            <h5>
                                <i class="fas fa-calendar-alt"></i>
                                Detalles de la Adopción
                            </h5>
                            
                            <div class="row">
                                <!-- Fecha Adopción -->
                                <div class="col-md-6 mb-4">
                                    <label for="Fecha_adopcion" class="form-label-crear" required>
                                        <i class="fas fa-calendar"></i>Fecha de Adopción
                                    </label>
                                    <input type="date" class="form-control-crear @error('Fecha_adopcion') is-invalid @enderror" 
                                           id="Fecha_adopcion" name="Fecha_adopcion"
                                           value="{{ old('Fecha_adopcion') }}" required>
                                    @error('Fecha_adopcion')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Lugar Adopción -->
                                <div class="col-md-6 mb-4">
                                    <label for="Lugar_adopcion" class="form-label-crear" required>
                                        <i class="fas fa-map-marker-alt"></i>Lugar de Adopción
                                    </label>
                                    <input type="text" class="form-control-crear @error('Lugar_adopcion') is-invalid @enderror" 
                                           id="Lugar_adopcion" name="Lugar_adopcion"
                                           value="{{ old('Lugar_adopcion') }}" 
                                           placeholder="Ej: Fundación Mi Mascota, Bogotá" required>
                                    @error('Lugar_adopcion')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- INFORMACIÓN ADICIONAL -->
                        <div class="grupo-formulario transicion-suave">
                            <h5>
                                <i class="fas fa-cogs"></i>
                                Información Adicional
                            </h5>
                            
                            <div class="row">
                                <!-- Estado -->
                                <div class="col-md-6 mb-4">
                                    <label for="estado" class="form-label-crear" required>
                                        <i class="fas fa-tasks"></i>Estado del Proceso
                                    </label>
                                    <select class="form-select-crear @error('estado') is-invalid @enderror" 
                                            id="estado" name="estado" required>
                                        <option value="">Selecciona un estado</option>
                                        <option value="En proceso" {{ old('estado') == 'En proceso' ? 'selected' : '' }}>
                                            En proceso
                                        </option>
                                        <option value="Aprobado" {{ old('estado') == 'Aprobado' ? 'selected' : '' }}>
                                            Aprobado
                                        </option>
                                        <option value="Rechazado" {{ old('estado') == 'Rechazado' ? 'selected' : '' }}>
                                            Rechazado
                                        </option>
                                    </select>
                                    @error('estado')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Administrador -->
                                <div class="col-md-6 mb-4">
                                    <label for="administrador_id" class="form-label-crear">
                                        <i class="fas fa-user-shield"></i>Administrador Responsable
                                    </label>
                                    <select class="form-select-crear @error('administrador_id') is-invalid @enderror" 
                                            id="administrador_id" name="administrador_id">
                                        <option value="">Selecciona un administrador</option>
                                        @foreach ($administradores as $admin)
                                            <option value="{{ $admin->id }}"
                                                {{ old('administrador_id') == $admin->id ? 'selected' : '' }}>
                                                {{ $admin->Nombre_1 }} {{ $admin->Apellido_1 }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('administrador_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Fundación -->
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="fundacion_id" class="form-label-crear">
                                        <i class="fas fa-home"></i>Fundación
                                    </label>
                                    <select class="form-select-crear @error('fundacion_id') is-invalid @enderror" 
                                            id="fundacion_id" name="fundacion_id">
                                        <option value="">Selecciona una fundación</option>
                                        @foreach ($fundaciones as $fundacion)
                                            <option value="{{ $fundacion->id }}"
                                                {{ old('fundacion_id') == $fundacion->id ? 'selected' : '' }}>
                                                {{ $fundacion->Nombre_1 }} - {{ $fundacion->Direccion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('fundacion_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- RAZÓN DE RECHAZO (CONDICIONAL) -->
                        <div class="razon-rechazo-container @if(old('estado') == 'Rechazado') mostrar @endif" 
                             id="razon_rechazo_container">
                            <div class="mb-3">
                                <label for="razon_rechazo" class="form-label-crear">
                                    <i class="fas fa-exclamation-triangle"></i>Razón de Rechazo
                                </label>
                                <textarea class="form-control-crear @error('razon_rechazo') is-invalid @enderror" 
                                          id="razon_rechazo" name="razon_rechazo" 
                                          rows="4" 
                                          placeholder="Describe detalladamente la razón del rechazo de esta adopción...">{{ old('razon_rechazo') }}</textarea>
                                @error('razon_rechazo')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Este campo es obligatorio cuando el estado es "Rechazado"
                                </small>
                            </div>
                        </div>

                        <!-- BOTONES DE ACCIÓN -->
                        <div class="botones-creacion">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('adopciones.index') }}" class="btn btn-cancelar-crear">
                                    <i class="fas fa-arrow-left me-2"></i>Cancelar y Volver
                                </a>
                                <button type="submit" class="btn btn-crear" id="btnSubmit">
                                    <i class="fas fa-save me-2"></i>Registrar Adopción
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const estadoSelect = document.getElementById('estado');
    const razonContainer = document.getElementById('razon_rechazo_container');
    const razonTextarea = document.getElementById('razon_rechazo');
    const form = document.getElementById('formAdopcion');
    const btnSubmit = document.getElementById('btnSubmit');
    
    function toggleRazonRechazo() {
        if (estadoSelect.value === 'Rechazado') {
            razonContainer.classList.add('mostrar');
            razonTextarea.required = true;
        } else {
            razonContainer.classList.remove('mostrar');
            razonTextarea.required = false;
        }
    }
    
    // Ejecutar al cargar la página
    toggleRazonRechazo();
    
    // Ejecutar cuando cambie el estado
    estadoSelect.addEventListener('change', toggleRazonRechazo);
    
    // Validación antes de enviar el formulario
    form.addEventListener('submit', function(e) {
        if (estadoSelect.value === 'Rechazado' && !razonTextarea.value.trim()) {
            e.preventDefault();
            alert('Por favor, proporciona una razón de rechazo cuando el estado es "Rechazado"');
            razonTextarea.focus();
            return;
        }
        
        // Mostrar estado de carga
        btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Registrando...';
        btnSubmit.disabled = true;
    });
});
</script>
@endsection
