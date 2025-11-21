<!-- Sección 4: Galería de Fotos -->
<div class="form-section">
    <h4 class="section-title">
        <i class="fas fa-camera me-2"></i>Galería de Fotos
    </h4>
    <div class="row g-3">
        <div class="col-12">
            <label for="fotos" class="form-label">
                Fotos de la Mascota <span class="required">*</span>
            </label>
            <input type="file" 
                   class="form-control form-control-custom" 
                   id="fotos" 
                   name="fotos[]" 
                   multiple 
                   accept="image/*" 
                   required>
            <div class="form-help">
                <i class="fas fa-info-circle"></i> Selecciona una o más fotos • La primera será la principal • Formatos: JPG, PNG, GIF • Máx. 2MB cada una
            </div>

            <!-- Preview de imágenes seleccionadas -->
            <div id="preview-galeria" class="preview-container mt-3"></div>

            @error('fotos')
                <div class="error-message">{{ $message }}</div>
            @enderror
            @error('fotos.*')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>