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