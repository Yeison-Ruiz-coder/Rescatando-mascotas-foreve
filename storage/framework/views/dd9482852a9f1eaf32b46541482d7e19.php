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
</div><?php /**PATH C:\Users\Dan\Desktop\Rescatando-mascotas-foreve\resources\views/admin/mascotas/partials/create/form-gallery.blade.php ENDPATH**/ ?>