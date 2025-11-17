@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/pages/mascotas/create.css') }}">
@endsection

@section('content')
<div class="container-fluid px-3 px-lg-5">

    <!-- Cards de mensajes -->
    @if(session('success'))
        @include('cards.registro-exitoso')
    @endif

    @if(session('error'))
        @include('cards.error-registro')
    @endif

    <!-- Hero Section -->
    <div class="row">
        <div class="col-12">
            <div class="create-mascota-hero text-center rounded-3">
                <h1>✏️ Editar Mascota: {{ $mascota->Nombre_mascota }}</h1>
                <p class="lead">Actualiza la información de {{ $mascota->Nombre_mascota }}</p>
            </div>
        </div>
    </div>

    <!-- Formulario -->
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="form-mascota-container">
                <form action="{{ route('mascotas.update', $mascota) }}" method="POST" enctype="multipart/form-data" id="mascotaForm">
                    @csrf
                    @method('PUT')

                    <!-- Sección 1: Información Básica -->
                    <div class="form-mascota-section">
                        <h3>📋 Información Básica</h3>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="Nombre_mascota" class="form-mascota-label">
                                    Nombre de la Mascota <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control form-mascota-control" 
                                       id="Nombre_mascota" 
                                       name="Nombre_mascota" 
                                       value="{{ old('Nombre_mascota', $mascota->Nombre_mascota) }}"
                                       placeholder="Ej: Max, Luna, Toby..."
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label for="Especie" class="form-mascota-label">
                                    Especie <span class="required">*</span>
                                </label>
                                <select class="form-select form-mascota-control select-control" 
                                        id="Especie" 
                                        name="Especie" 
                                        required>
                                    <option value="">Selecciona una especie</option>
                                    <option value="Perro" {{ old('Especie', $mascota->Especie) == 'Perro' ? 'selected' : '' }}>🐕 Perro</option>
                                    <option value="Gato" {{ old('Especie', $mascota->Especie) == 'Gato' ? 'selected' : '' }}>🐈 Gato</option>
                                    <option value="Conejo" {{ old('Especie', $mascota->Especie) == 'Conejo' ? 'selected' : '' }}>🐇 Conejo</option>
                                    <option value="Otro" {{ old('Especie', $mascota->Especie) == 'Otro' ? 'selected' : '' }}>🐾 Otro</option>
                                </select>
                            </div>

                            <!-- Campo para Razas (selección múltiple) -->
                            <div class="col-md-6">
                                <label for="razas" class="form-mascota-label">
                                    Razas <span class="required">*</span>
                                </label>
                                <select class="form-select form-mascota-control select-control" 
                                        id="razas" 
                                        name="razas[]" 
                                        multiple
                                        required>
                                    <option value="">Selecciona una o más razas</option>
                                    @foreach($razas as $raza)
                                        <option value="{{ $raza->id }}" 
                                            {{ in_array($raza->id, old('razas', $mascota->razas->pluck('id')->toArray())) ? 'selected' : '' }}>
                                            {{ $raza->nombre_raza }} ({{ $raza->especie }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-help-text">
                                    <i class="fas fa-info-circle"></i> Mantén presionada la tecla Ctrl para seleccionar múltiples razas
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="Edad_aprox" class="form-mascota-label">
                                    Edad Aproximada (años) <span class="required">*</span>
                                </label>
                                <input type="number" 
                                       class="form-control form-mascota-control" 
                                       id="Edad_aprox" 
                                       name="Edad_aprox" 
                                       value="{{ old('Edad_aprox', $mascota->Edad_aprox) }}"
                                       min="0" 
                                       max="30" 
                                       step="0.5"
                                       placeholder="Ej: 2.5"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-mascota-label">Género <span class="required">*</span></label>
                                <div class="d-flex gap-4">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="Genero" 
                                               id="GeneroMacho" 
                                               value="Macho" 
                                               {{ old('Genero', $mascota->Genero) == 'Macho' ? 'checked' : '' }}
                                               required>
                                        <label class="form-check-label" for="GeneroMacho">
                                            🐕‍🦺 Macho
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="Genero" 
                                               id="GeneroHembra" 
                                               value="Hembra" 
                                               {{ old('Genero', $mascota->Genero) == 'Hembra' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="GeneroHembra">
                                            🐈‍⬛ Hembra
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="estado" class="form-mascota-label">
                                    Estado Actual <span class="required">*</span>
                                </label>
                                <select class="form-select form-mascota-control select-control" 
                                        id="estado" 
                                        name="estado" 
                                        required>
                                    <option value="">Selecciona un estado</option>
                                    <option value="En adopcion" {{ old('estado', $mascota->estado) == 'En adopcion' ? 'selected' : '' }}>🟢 En adopción</option>
                                    <option value="Rescatada" {{ old('estado', $mascota->estado) == 'Rescatada' ? 'selected' : '' }}>🟡 Rescatada</option>
                                    <option value="Adoptado" {{ old('estado', $mascota->estado) == 'Adoptado' ? 'selected' : '' }}>🔴 Adoptado</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Sección 2: Ubicación y Descripción -->
                    <div class="form-mascota-section">
                        <h3>📍 Ubicación y Descripción</h3>
                        <div class="row g-4">
                            <div class="col-12">
                                <label for="Lugar_rescate" class="form-mascota-label">
                                    Lugar donde se encuentra <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control form-mascota-control" 
                                       id="Lugar_rescate" 
                                       name="Lugar_rescate" 
                                       value="{{ old('Lugar_rescate', $mascota->Lugar_rescate) }}"
                                       placeholder="Ej: Parque Central, Calle Principal #123..."
                                       required>
                            </div>

                            <div class="col-12">
                                <label for="Descripcion" class="form-mascota-label">
                                    Descripción <span class="required">*</span>
                                </label>
                                <textarea class="form-control form-mascota-control" 
                                          id="Descripcion" 
                                          name="Descripcion" 
                                          rows="5"
                                          placeholder="Describe a la mascota: carácter, comportamiento, condición de salud, necesidades especiales..."
                                          required>{{ old('Descripcion', $mascota->Descripcion) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Sección 3: Salud y Vacunas -->
                    <div class="form-mascota-section">
                        <h3>💉 Salud y Vacunas</h3>
                        <div class="row g-4">
                            <!-- Campo para Vacunas (selección múltiple) -->
                            <div class="col-12">
                                <label for="vacunas_aplicadas" class="form-mascota-label">
                                    Vacunas Aplicadas
                                </label>
                                <select class="form-select form-mascota-control select-control" 
                                        id="vacunas_aplicadas" 
                                        name="vacunas_aplicadas[]" 
                                        multiple>
                                    <option value="">Selecciona las vacunas aplicadas</option>
                                    @foreach($vacunas as $vacuna)
                                        <option value="{{ $vacuna->id }}" 
                                            {{ in_array($vacuna->id, old('vacunas_aplicadas', $mascota->tiposVacunas->pluck('id')->toArray())) ? 'selected' : '' }}>
                                            {{ $vacuna->nombre_vacuna }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-help-text">
                                    <i class="fas fa-info-circle"></i> Mantén presionada la tecla Ctrl para seleccionar múltiples vacunas
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección 4: Fotografía -->
                    <div class="form-mascota-section">
                        <h3>📸 Fotografía</h3>
                        <div class="row g-4">
                            <div class="col-12">
                                <label for="Foto" class="form-mascota-label">
                                    Foto de la Mascota
                                </label>
                                
                                <!-- Mostrar imagen actual -->
                                @if($mascota->Foto)
                                <div class="mb-3">
                                    <p class="text-muted">Imagen actual:</p>
                                    <img src="{{ Storage::url($mascota->Foto) }}" 
                                         alt="{{ $mascota->Nombre_mascota }}" 
                                         class="img-thumbnail"
                                         style="max-height: 200px;">
                                </div>
                                @endif
                                
                                <input type="file" 
                                       class="form-control form-mascota-control" 
                                       id="Foto" 
                                       name="Foto" 
                                       accept="image/*">
                                <div class="form-help-text">
                                    <i class="fas fa-info-circle"></i> Deja vacío para mantener la imagen actual • Formatos: JPG, PNG, GIF • Máx. 2MB
                                </div>
                                @error('Foto')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Sección 5: Fechas y Fundación -->
                    <div class="form-mascota-section">
                        <h3>📅 Fechas y Organización</h3>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="Fecha_ingreso" class="form-mascota-label">
                                    Fecha de Ingreso <span class="required">*</span>
                                </label>
                                <input type="date" 
                                       class="form-control form-mascota-control" 
                                       id="Fecha_ingreso" 
                                       name="Fecha_ingreso" 
                                       value="{{ old('Fecha_ingreso', $mascota->Fecha_ingreso) }}"
                                       required>
                            </div>
                            <div class="col-md-6">
                                <label for="Fecha_salida" class="form-mascota-label">
                                    Fecha de Salida (si aplica)
                                </label>
                                <input type="date" 
                                       class="form-control form-mascota-control" 
                                       id="Fecha_salida" 
                                       name="Fecha_salida" 
                                       value="{{ old('Fecha_salida', $mascota->Fecha_salida) }}">
                            </div>
                            <div class="col-12">
                                <label for="fundacion_id" class="form-mascota-label">
                                    Fundación (opcional)
                                </label>
                                <select class="form-select form-mascota-control select-control" 
                                        id="fundacion_id" 
                                        name="fundacion_id">
                                    <option value="">Sin fundación asignada</option>
                                    @foreach($fundaciones as $fundacion)
                                        <option value="{{ $fundacion->id }}" 
                                            {{ old('fundacion_id', $mascota->fundacion_id) == $fundacion->id ? 'selected' : '' }}>
                                            {{ $fundacion->Nombre_1 }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="form-mascota-buttons">
                        <button type="submit" class="btn btn-form-submit">
                            <i class="fas fa-save me-2"></i>Actualizar Mascota
                        </button>
                        <a href="{{ route('mascotas.show', $mascota) }}" class="btn btn-form-cancel">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection