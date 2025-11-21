<!-- Sección 5: Fechas y Fundación -->
<div class="form-section">
    <h4 class="section-title">
        <i class="fas fa-calendar-alt me-2"></i>Fechas y Organización
    </h4>
    <div class="row g-3">
        <div class="col-md-6">
            <label for="Fecha_ingreso" class="form-label">
                Fecha de Ingreso <span class="required">*</span>
            </label>
            <input type="date" 
                   class="form-control form-control-custom" 
                   id="Fecha_ingreso" 
                   name="Fecha_ingreso" 
                   value="<?php echo e(old('Fecha_ingreso', $mascota->Fecha_ingreso)); ?>"
                   required>
        </div>
        <div class="col-md-6">
            <label for="Fecha_salida" class="form-label">
                Fecha de Salida (si aplica)
            </label>
            <input type="date" 
                   class="form-control form-control-custom" 
                   id="Fecha_salida" 
                   name="Fecha_salida" 
                   value="<?php echo e(old('Fecha_salida', $mascota->Fecha_salida)); ?>">
        </div>
        <div class="col-12">
            <label for="fundacion_id" class="form-label">
                Fundación (opcional)
            </label>
            <select class="form-select form-select-custom" 
                    id="fundacion_id" 
                    name="fundacion_id">
                <option value="">Sin fundación asignada</option>
                <?php $__currentLoopData = $fundaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fundacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($fundacion->id); ?>" 
                        <?php echo e(old('fundacion_id', $mascota->fundacion_id) == $fundacion->id ? 'selected' : ''); ?>>
                        <?php echo e($fundacion->Nombre_1); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
</div><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/admin/mascotas/partials/edit/form-dates-foundation.blade.php ENDPATH**/ ?>