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
            <?php if($mascota->Foto): ?>
            <div class="current-image mb-3">
                <p class="text-muted small mb-2">Imagen actual:</p>
                <img src="<?php echo e(Storage::url($mascota->Foto)); ?>" 
                     alt="<?php echo e($mascota->Nombre_mascota); ?>" 
                     class="img-thumbnail current-img">
            </div>
            <?php endif; ?>
            
            <input type="file" 
                   class="form-control form-control-custom" 
                   id="Foto" 
                   name="Foto" 
                   accept="image/*">
            <div class="form-help">
                <i class="fas fa-info-circle"></i> Deja vacío para mantener la imagen actual • Formatos: JPG, PNG, GIF • Máx. 2MB
            </div>
            <?php $__errorArgs = ['Foto'];
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
                <?php if($mascota->galeria_fotos && count($mascota->galeria_fotos) > 0): ?>
                <div class="current-gallery mt-3">
                    <p class="text-muted small mb-2">Galería actual:</p>
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
            </div>
        </div>
    </div>
</div><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/admin/mascotas/partials/edit/form-gallery.blade.php ENDPATH**/ ?>