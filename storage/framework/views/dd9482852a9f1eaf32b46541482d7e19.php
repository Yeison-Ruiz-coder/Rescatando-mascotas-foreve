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
                   required
                   onchange="previewGalleryImages(this)">
            <div class="form-help">
                <i class="fas fa-info-circle"></i> Selecciona una o más fotos • La primera será la principal • Formatos: JPG, PNG, GIF • Máx. 2MB cada una
            </div>

            <!-- Preview de imágenes seleccionadas -->
            <div id="preview-galeria" class="preview-container" style="display: none;">
                <h6 class="preview-title">Vista previa de las imágenes:</h6>
                <div class="gallery-preview" id="galleryPreview"></div>
            </div>

            <?php $__errorArgs = ['fotos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-message"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php $__errorArgs = ['fotos.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-message"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>
</div>

<script>
function previewGalleryImages(input) {
    const previewContainer = document.getElementById('preview-galeria');
    const galleryPreview = document.getElementById('galleryPreview');
    
    // Limpiar preview anterior
    galleryPreview.innerHTML = '';
    
    if (input.files && input.files.length > 0) {
        // Mostrar contenedor de preview
        previewContainer.style.display = 'block';
        
        // Procesar cada archivo
        Array.from(input.files).forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'gallery-preview-item';
                    previewItem.innerHTML = `
                        <span class="preview-badge">${index + 1}</span>
                        <img src="${e.target.result}" alt="Preview ${index + 1}">
                        <button type="button" class="remove-preview" onclick="removeImagePreview(this, ${index})">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                    galleryPreview.appendChild(previewItem);
                };
                
                reader.readAsDataURL(file);
            }
        });
    } else {
        // Ocultar contenedor si no hay archivos
        previewContainer.style.display = 'none';
    }
}

function removeImagePreview(button, index) {
    const input = document.getElementById('fotos');
    const files = Array.from(input.files);
    
    // Remover archivo del array
    files.splice(index, 1);
    
    // Crear nuevo DataTransfer y actualizar input
    const dt = new DataTransfer();
    files.forEach(file => dt.items.add(file));
    input.files = dt.files;
    
    // Volver a generar el preview
    previewGalleryImages(input);
    
    // Disparar evento change para actualizar validación
    const event = new Event('change', { bubbles: true });
    input.dispatchEvent(event);
}
</script><?php /**PATH C:\Users\Dan\Desktop\Rescatando-mascotas-foreve\resources\views/admin/mascotas/partials/create/form-gallery.blade.php ENDPATH**/ ?>