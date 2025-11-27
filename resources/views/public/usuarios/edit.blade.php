@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/mascotas/edit.css') }}">
@endpush

@section('content')
<div class="container-fluid px-3 px-lg-5 py-4">

    <!-- Cards de mensajes -->
    @if(session('success'))
        @include('cards.registro-exitoso')
    @endif

    @if(session('error'))
        @include('cards.error-registro')
    @endif

    <!-- Header Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="edit-mascota-header text-center">
                <h1 class="display-5 fw-bold">
                    <i class="fas fa-edit me-3"></i>Editar Mascota
                </h1>
                <p class="lead text-muted">Actualiza la información de <strong class="text-turquesa">{{ $mascota->Nombre_mascota }}</strong></p>
            </div>
        </div>
    </div>

    <!-- Formulario -->
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="card form-mascota-card shadow-lg border-0">
                <div class="card-header form-mascota-header">
                    <h3 class="mb-0">
                        <i class="fas fa-paw me-2"></i>Formulario de Edición
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('mascotas.update', $mascota) }}" method="POST" enctype="multipart/form-data" id="mascotaForm">
                        @csrf
                        @method('PUT')

                        <!-- Sección 1: Información Básica -->
                        <div class="form-section">
                            <h4 class="section-title">
                                <i class="fas fa-info-circle me-2"></i>Información Básica
                            </h4>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="Nombre_mascota" class="form-label">
                                        Nombre de la Mascota <span class="required">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-custom" 
                                           id="Nombre_mascota" 
                                           name="Nombre_mascota" 
                                           value="{{ old('Nombre_mascota', $mascota->Nombre_mascota) }}"
                                           placeholder="Ej: Max, Luna, Toby..."
                                           required>
                                </div>

                                <div class="col-md-6">
                                    <label for="Especie" class="form-label">
                                        Especie <span class="required">*</span>
                                    </label>
                                    <select class="form-select form-select-custom" 
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

                                <!-- Campo para Razas (selección múltiple mejorada) -->
                                <div class="col-md-6">
                                    <label for="razas" class="form-label">
                                        Razas <span class="required">*</span>
                                    </label>
                                    <div class="multi-select-container">
                                        <select class="form-select form-select-custom multi-select" 
                                                id="razas" 
                                                name="razas[]" 
                                                multiple
                                                size="3"
                                                required>
                                            <option value="">Selecciona una o más razas</option>
                                            @foreach($razas as $raza)
                                                <option value="{{ $raza->id }}" 
                                                    {{ in_array($raza->id, old('razas', $mascota->razas->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                    {{ $raza->nombre_raza }} ({{ $raza->especie }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-help">
                                        <i class="fas fa-info-circle"></i> Mantén presionada la tecla Ctrl para seleccionar múltiples razas
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="Edad_aprox" class="form-label">
                                        Edad Aproximada (años) <span class="required">*</span>
                                    </label>
                                    <input type="number" 
                                           class="form-control form-control-custom" 
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
                                    <label class="form-label">Género <span class="required">*</span></label>
                                    <div class="radio-group">
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                   type="radio" 
                                                   name="Genero" 
                                                   id="GeneroMacho" 
                                                   value="Macho" 
                                                   {{ old('Genero', $mascota->Genero) == 'Macho' ? 'checked' : '' }}
                                                   required>
                                            <label class="form-check-label" for="GeneroMacho">
                                                <i class="fas fa-mars me-1"></i>Macho
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
                                                <i class="fas fa-venus me-1"></i>Hembra
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="estado" class="form-label">
                                        Estado Actual <span class="required">*</span>
                                    </label>
                                    <select class="form-select form-select-custom" 
                                            id="estado" 
                                            name="estado" 
                                            required>
                                        <option value="">Selecciona un estado</option>
                                        <option value="En adopcion" {{ old('estado', $mascota->estado) == 'En adopcion' ? 'selected' : '' }}>
                                            <i class="fas fa-heart me-1"></i>En adopción
                                        </option>
                                        <option value="Rescatada" {{ old('estado', $mascota->estado) == 'Rescatada' ? 'selected' : '' }}>
                                            <i class="fas fa-shield-alt me-1"></i>Rescatada
                                        </option>
                                        <option value="Adoptado" {{ old('estado', $mascota->estado) == 'Adoptado' ? 'selected' : '' }}>
                                            <i class="fas fa-home me-1"></i>Adoptado
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Sección 2: Ubicación y Descripción -->
                        <div class="form-section">
                            <h4 class="section-title">
                                <i class="fas fa-map-marker-alt me-2"></i>Ubicación y Descripción
                            </h4>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="Lugar_rescate" class="form-label">
                                        Lugar donde se encuentra <span class="required">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-custom" 
                                           id="Lugar_rescate" 
                                           name="Lugar_rescate" 
                                           value="{{ old('Lugar_rescate', $mascota->Lugar_rescate) }}"
                                           placeholder="Ej: Parque Central, Calle Principal #123..."
                                           required>
                                </div>

                                <div class="col-12">
                                    <label for="Descripcion" class="form-label">
                                        Descripción <span class="required">*</span>
                                    </label>
                                    <textarea class="form-control form-control-custom" 
                                              id="Descripcion" 
                                              name="Descripcion" 
                                              rows="5"
                                              placeholder="Describe a la mascota: carácter, comportamiento, condición de salud, necesidades especiales..."
                                              required>{{ old('Descripcion', $mascota->Descripcion) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Sección 3: Salud y Vacunas -->
                        <div class="form-section">
                            <h4 class="section-title">
                                <i class="fas fa-syringe me-2"></i>Salud y Vacunas
                            </h4>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="vacunas_aplicadas" class="form-label">
                                        Vacunas Aplicadas
                                    </label>
                                    <div class="multi-select-container">
                                        <select class="form-select form-select-custom multi-select" 
                                                id="vacunas_aplicadas" 
                                                name="vacunas_aplicadas[]" 
                                                multiple
                                                size="3">
                                            <option value="">Selecciona las vacunas aplicadas</option>
                                            @foreach($vacunas as $vacuna)
                                                <option value="{{ $vacuna->id }}" 
                                                    {{ in_array($vacuna->id, old('vacunas_aplicadas', $mascota->tiposVacunas->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                    {{ $vacuna->nombre_vacuna }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-help">
                                        <i class="fas fa-info-circle"></i> Mantén presionada la tecla Ctrl para seleccionar múltiples vacunas
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sección 4: Fotografía -->
                        <div class="form-section">
                            <h4 class="section-title">
                                <i class="fas fa-camera me-2"></i>Fotografía
                            </h4>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="Foto" class="form-label">
                                        Foto Principal
                                    </label>
                                    
                                    <!-- Mostrar imagen actual -->
                                    @if($mascota->Foto)
                                    <div class="current-image mb-3">
                                        <p class="text-muted small mb-2">Imagen actual:</p>
                                        <img src="{{ Storage::url($mascota->Foto) }}" 
                                             alt="{{ $mascota->Nombre_mascota }}" 
                                             class="img-thumbnail current-img">
                                    </div>
                                    @endif
                                    
                                    <input type="file" 
                                           class="form-control form-control-custom" 
                                           id="Foto" 
                                           name="Foto" 
                                           accept="image/*">
                                    <div class="form-help">
                                        <i class="fas fa-info-circle"></i> Deja vacío para mantener la imagen actual • Formatos: JPG, PNG, GIF • Máx. 2MB
                                    </div>
                                    @error('Foto')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Galería de Fotos -->
                                <div class="col-12">
                                    <label class="form-label">
                                        Galería de Fotos (Máximo 3 imágenes)
                                    </label>
                                    <div class="gallery-upload-container">
                                        <input type="file" 
                                               class="form-control form-control-custom" 
                                               id="galeria_fotos" 
                                               name="galeria_fotos[]" 
                                               multiple
                                               accept="image/*"
                                               max="3">
                                        <div class="form-help">
                                            <i class="fas fa-info-circle"></i> Puedes seleccionar hasta 3 imágenes adicionales para la galería
                                        </div>
                                        
                                        <!-- Mostrar galería actual -->
                                        @if($mascota->galeria_fotos && count($mascota->galeria_fotos) > 0)
                                        <div class="current-gallery mt-3">
                                            <p class="text-muted small mb-2">Galería actual:</p>
                                            <div class="row g-2">
                                                @foreach($mascota->galeria_fotos as $index => $foto)
                                                <div class="col-4">
                                                    <div class="gallery-item position-relative">
                                                        <img src="{{ Storage::url($foto['ruta']) }}" 
                                                             alt="Foto {{ $index + 1 }}" 
                                                             class="img-thumbnail w-100">
                                                        <div class="gallery-overlay">
                                                            <small>Foto {{ $index + 1 }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sección 5: Fechas y Fundación -->
                        <div class="form-section">
                            <h4 class="section-title">
                                <i class="fas fa-calendar-alt me-2"></i>Fechas y Organización
                            </h4>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="Fecha_ingreso" class="form-label">
                                        Fecha de Ingreso <span class="required">*</span>
                                    </label>
                                    <input type="date" 
                                           class="form-control form-control-custom" 
                                           id="Fecha_ingreso" 
                                           name="Fecha_ingreso" 
                                           value="{{ old('Fecha_ingreso', $mascota->Fecha_ingreso) }}"
                                           required>
                                </div>
                                <div class="col-md-6">
                                    <label for="Fecha_salida" class="form-label">
                                        Fecha de Salida (si aplica)
                                    </label>
                                    <input type="date" 
                                           class="form-control form-control-custom" 
                                           id="Fecha_salida" 
                                           name="Fecha_salida" 
                                           value="{{ old('Fecha_salida', $mascota->Fecha_salida) }}">
                                </div>
                                <div class="col-12">
                                    <label for="fundacion_id" class="form-label">
                                        Fundación (opcional)
                                    </label>
                                    <select class="form-select form-select-custom" 
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
                        <div class="form-actions">
                            <button type="submit" class="btn btn-submit">
                                <i class="fas fa-save me-2"></i>Actualizar Mascota
                            </button>
                            <a href="{{ route('admin.mascotas.show', $mascota) }}" class="btn btn-cancel">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection