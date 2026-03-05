<!-- Sección 2: Ubicación y Descripción -->
<div class="form-section">
    <h4 class="section-title">
        <i class="fas fa-map-marker-alt me-2"></i>Ubicación y Descripción
    </h4>
    <div class="row g-3">
        <div class="col-12">
            <label for="lugar_rescate" class="form-label">
                Lugar donde se encuentra <span class="required">*</span>
            </label>
            <input type="text"
                   class="form-control form-control-custom @error('lugar_rescate') is-invalid @enderror"
                   id="lugar_rescate"
                   name="lugar_rescate"
                   value="{{ old('lugar_rescate') }}"
                   placeholder="Ej: Parque Central, Calle Principal #123..."
                   required>
            @error('lugar_rescate')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label for="descripcion" class="form-label">
                Descripción <span class="required">*</span>
            </label>
            <textarea class="form-control form-control-custom @error('descripcion') is-invalid @enderror"
                      id="descripcion"
                      name="descripcion"
                      rows="5"
                      placeholder="Describe a la mascota: carácter, comportamiento, condición de salud, necesidades especiales..."
                      required>{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- NUEVO: Campo para condiciones especiales (enfermedades crónicas, discapacidades) -->
        <div class="col-12">
            <label for="condiciones_especiales" class="form-label">
                Condiciones Especiales
            </label>
            <textarea class="form-control form-control-custom @error('condiciones_especiales') is-invalid @enderror"
                      id="condiciones_especiales"
                      name="condiciones_especiales"
                      rows="3"
                      placeholder="Enfermedades crónicas, discapacidades, cuidados especiales...">{{ old('condiciones_especiales') }}</textarea>
            @error('condiciones_especiales')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
