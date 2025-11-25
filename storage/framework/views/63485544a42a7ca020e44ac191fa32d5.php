<!-- Sección 3: Salud y Vacunas -->
<div class="form-section">
    <h4 class="section-title">
        <i class="fas fa-syringe me-2"></i>Salud y Vacunas
    </h4>
    <div class="row g-3">
        <div class="col-12">
            <label for="vacunas_aplicadas" class="form-label">
                Vacunas Aplicadas
            </label>
            <div class="multi-select-container">
                <select class="form-select form-select-custom multi-select" 
                        id="vacunas_aplicadas" 
                        name="vacunas_aplicadas[]" 
                        multiple
                        size="3">
                    <option value="">Selecciona las vacunas aplicadas</option>
                    <?php $__currentLoopData = $vacunas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vacuna): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($vacuna->id); ?>"
                            <?php echo e(in_array($vacuna->id, old('vacunas_aplicadas', [])) ? 'selected' : ''); ?>>
                            <?php echo e($vacuna->nombre_vacuna); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-help">
                <i class="fas fa-info-circle"></i> Mantén presionada la tecla Ctrl para seleccionar múltiples vacunas
            </div>
        </div>
    </div>
</div><?php /**PATH C:\Users\Dan\Desktop\Rescatando-mascotas-foreve\resources\views/admin/mascotas/partials/create/form-health.blade.php ENDPATH**/ ?>