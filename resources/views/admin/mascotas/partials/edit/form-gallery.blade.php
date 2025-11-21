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