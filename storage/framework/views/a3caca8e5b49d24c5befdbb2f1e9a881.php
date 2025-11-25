<!-- Sección 4: Fotografía -->
<div class="form-section">
    <h4 class="section-title">
        <i class="fas fa-camera me-2"></i>Fotografía
    </h4>
    <div class="row g-3">
        <div class="col-12">
            <label for="galeria_fotos" class="form-label">
                Fotos de la Mascota (Máximo 3 imágenes)
            </label>
            
            <!-- Mostrar galería actual -->
            <?php if($mascota->galeria_fotos && count($mascota->galeria_fotos) > 0): ?>
            <div class="current-gallery mb-3">
                <p class="text-muted small mb-2">Fotos actuales:</p>
                <div class="row g-2">
                    <?php $__currentLoopData = $mascota->galeria_fotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-4">
                        <div class="gallery-item position-relative">
                            <img src="<?php echo e(Storage::url($foto['ruta'])); ?>" 
                                 alt="Foto <?php echo e($index + 1); ?>" 
                                 class="img-thumbnail w-100">
                            <div class="gallery-overlay">
                                <small>Foto <?php echo e($index + 1); ?></small>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="gallery-upload-container">
                <input type="file" 
                       class="form-control form-control-custom" 
                       id="galeria_fotos" 
                       name="galeria_fotos[]" 
                       multiple
                       accept="image/*"
                       max="3">
                <div class="form-help">
                    <i class="fas fa-info-circle"></i> Puedes seleccionar hasta 3 imágenes • Cualquier formato de imagen • Máx. 2MB cada una
                </div>
            </div>
            <?php $__errorArgs = ['galeria_fotos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-message"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php $__errorArgs = ['galeria_fotos.*'];
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

<!-- JavaScript directamente en el blade -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('galeria_fotos');
    
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            // Validar máximo 3 imágenes
            if (this.files.length > 3) {
                alert('Máximo 3 imágenes permitidas');
                this.value = '';
                return;
            }
            
            // Validar que sean imágenes
            for (let file of this.files) {
                if (!file.type.startsWith('image/')) {
                    alert('Solo se permiten archivos de imagen: ' + file.name);
                    this.value = '';
                    return;
                }
                
                // Validar tamaño (2MB = 2 * 1024 * 1024 bytes)
                if (file.size > 2 * 1024 * 1024) {
                    alert('La imagen "' + file.name + '" excede el tamaño máximo de 2MB');
                    this.value = '';
                    return;
                }
            }
            
            // Mostrar preview de imágenes (opcional)
            mostrarPreview(this.files);
        });
    }
    
    function mostrarPreview(files) {
        // Opcional: agregar preview de imágenes seleccionadas
        const previewContainer = document.createElement('div');
        previewContainer.className = 'image-preview mt-3';
        previewContainer.innerHTML = '<p class="small text-muted">Vista previa:</p><div class="row g-2" id="preview-images"></div>';
        
        // Remover preview anterior si existe
        const existingPreview = document.querySelector('.image-preview');
        if (existingPreview) {
            existingPreview.remove();
        }
        
        fileInput.parentNode.appendChild(previewContainer);
        const previewImages = document.getElementById('preview-images');
        
        Array.from(files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-4';
                col.innerHTML = `
                    <div class="position-relative">
                        <img src="${e.target.result}" class="img-thumbnail w-100" alt="Preview ${index + 1}">
                        <small class="position-absolute top-0 start-0 bg-dark text-white px-1">${index + 1}</small>
                    </div>
                `;
                previewImages.appendChild(col);
            };
            reader.readAsDataURL(file);
        });
    }
});
</script><?php /**PATH C:\Users\Dan\Desktop\Rescatando-mascotas-foreve\resources\views/admin/mascotas/partials/edit/form-gallery.blade.php ENDPATH**/ ?>