<!-- Sección 1: Información Básica -->
<div class="form-section">
    <h4 class="section-title">
        <i class="fas fa-info-circle me-2"></i>Información Básica
    </h4>
    <div class="row g-3">
        <div class="col-md-6">
            <label for="nombre_mascota" class="form-label">
                Nombre de la Mascota <span class="required">*</span>
            </label>
            <input type="text"
                   class="form-control form-control-custom @error('nombre_mascota') is-invalid @enderror"
                   id="nombre_mascota"
                   name="nombre_mascota"
                   value="{{ old('nombre_mascota', $mascota->nombre_mascota) }}"
                   placeholder="Ej: Max, Luna, Toby..."
                   required>
            @error('nombre_mascota')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="especie" class="form-label">
                Especie <span class="required">*</span>
            </label>
            <select class="form-select form-select-custom @error('especie') is-invalid @enderror"
                    id="especie"
                    name="especie"
                    required>
                <option value="">Selecciona una especie</option>
                <option value="Perro" {{ old('especie', $mascota->especie) == 'Perro' ? 'selected' : '' }}>Perro</option>
                <option value="Gato" {{ old('especie', $mascota->especie) == 'Gato' ? 'selected' : '' }}>Gato</option>
                <option value="Conejo" {{ old('especie', $mascota->especie) == 'Conejo' ? 'selected' : '' }}>Conejo</option>
                <option value="Otro" {{ old('especie', $mascota->especie) == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
            @error('especie')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo para Razas (selección múltiple) -->
        <div class="col-md-6">
            <label for="razas" class="form-label">
                Razas <span class="required">*</span>
            </label>
            <div class="multi-select-container">
                <select class="form-select form-select-custom multi-select @error('razas') is-invalid @enderror"
                        id="razas"
                        name="razas[]"
                        multiple
                        size="3"
                        required>
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
            @error('razas')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="edad_aprox" class="form-label">
                Edad Aproximada (años) <span class="required">*</span>
            </label>
            <input type="number"
                   class="form-control form-control-custom @error('edad_aprox') is-invalid @enderror"
                   id="edad_aprox"
                   name="edad_aprox"
                   value="{{ old('edad_aprox', $mascota->edad_aprox) }}"
                   min="0"
                   max="30"
                   step="0.5"
                   placeholder="Ej: 2.5"
                   required>
            @error('edad_aprox')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Género <span class="required">*</span></label>
            <div class="radio-group">
                <div class="form-check">
                    <input class="form-check-input @error('genero') is-invalid @enderror"
                           type="radio"
                           name="genero"
                           id="genero_macho"
                           value="Macho"
                           {{ old('genero', $mascota->genero) == 'Macho' ? 'checked' : '' }}
                           required>
                    <label class="form-check-label" for="genero_macho">
                        <i class="fas fa-mars me-1"></i>Macho
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input @error('genero') is-invalid @enderror"
                           type="radio"
                           name="genero"
                           id="genero_hembra"
                           value="Hembra"
                           {{ old('genero', $mascota->genero) == 'Hembra' ? 'checked' : '' }}>
                    <label class="form-check-label" for="genero_hembra">
                        <i class="fas fa-venus me-1"></i>Hembra
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input @error('genero') is-invalid @enderror"
                           type="radio"
                           name="genero"
                           id="genero_desconocido"
                           value="Desconocido"
                           {{ old('genero', $mascota->genero) == 'Desconocido' ? 'checked' : '' }}>
                    <label class="form-check-label" for="genero_desconocido">
                        <i class="fas fa-question me-1"></i>Desconocido
                    </label>
                </div>
            </div>
            @error('genero')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="estado" class="form-label">
                Estado Actual <span class="required">*</span>
            </label>
            <select class="form-select form-select-custom @error('estado') is-invalid @enderror"
                    id="estado"
                    name="estado"
                    required>
                <option value="">Selecciona un estado</option>
                <option value="En adopcion" {{ old('estado', $mascota->estado) == 'En adopcion' ? 'selected' : '' }}>
                    En adopción
                </option>
                <option value="Rescatada" {{ old('estado', $mascota->estado) == 'Rescatada' ? 'selected' : '' }}>
                    Rescatada
                </option>
                <option value="En acogida" {{ old('estado', $mascota->estado) == 'En acogida' ? 'selected' : '' }}>
                    En acogida
                </option>
                <option value="Adoptado" {{ old('estado', $mascota->estado) == 'Adoptado' ? 'selected' : '' }}>
                    Adoptado
                </option>
            </select>
            @error('estado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
