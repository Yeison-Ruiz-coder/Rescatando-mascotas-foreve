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
                   value="{{ old('Lugar_rescate') }}"
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
                      required>{{ old('Descripcion') }}</textarea>
        </div>
    </div>
</div>