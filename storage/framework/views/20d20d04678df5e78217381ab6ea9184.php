<!-- Sección 1: Información Básica -->
<div class="form-section">
    <h4 class="section-title">
        <i class="fas fa-info-circle me-2"></i>Información Básica
    </h4>
    <div class="row g-3">
        <div class="col-md-6">
            <label for="Nombre_mascota" class="form-label">
                Nombre de la Mascota <span class="required">*</span>
            </label>
            <input type="text" 
                   class="form-control form-control-custom" 
                   id="Nombre_mascota" 
                   name="Nombre_mascota" 
                   value="<?php echo e(old('Nombre_mascota')); ?>"
                   placeholder="Ej: Max, Luna, Toby..."
                   required>
        </div>

        <div class="col-md-6">
            <label for="Especie" class="form-label">
                Especie <span class="required">*</span>
            </label>
            <select class="form-select form-select-custom" 
                    id="Especie" 
                    name="Especie" 
                    required>
                <option value="">Selecciona una especie</option>
                <option value="Perro" <?php echo e(old('Especie') == 'Perro' ? 'selected' : ''); ?>>Perro</option>
                <option value="Gato" <?php echo e(old('Especie') == 'Gato' ? 'selected' : ''); ?>>Gato</option>
                <option value="Conejo" <?php echo e(old('Especie') == 'Conejo' ? 'selected' : ''); ?>>Conejo</option>
                <option value="Otro" <?php echo e(old('Especie') == 'Otro' ? 'selected' : ''); ?>>Otro</option>
            </select>
        </div>

        <!-- Campo para Razas (selección múltiple) -->
        <div class="col-md-6">
            <label for="razas" class="form-label">
                Razas <span class="required">*</span>
            </label>
            <div class="multi-select-container">
                <select class="form-select form-select-custom multi-select" 
                        id="razas" 
                        name="razas[]" 
                        multiple
                        size="3"
                        required>
                    <option value="">Selecciona una o más razas</option>
                    <?php $__currentLoopData = $razas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $raza): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($raza->id); ?>"
                            <?php echo e(in_array($raza->id, old('razas', [])) ? 'selected' : ''); ?>>
                            <?php echo e($raza->nombre_raza); ?> (<?php echo e($raza->especie); ?>)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-help">
                <i class="fas fa-info-circle"></i> Mantén presionada la tecla Ctrl para seleccionar múltiples razas
            </div>
        </div>

        <div class="col-md-6">
            <label for="Edad_aprox" class="form-label">
                Edad Aproximada (años) <span class="required">*</span>
            </label>
            <input type="number" 
                   class="form-control form-control-custom" 
                   id="Edad_aprox" 
                   name="Edad_aprox" 
                   value="<?php echo e(old('Edad_aprox')); ?>"
                   min="0" 
                   max="30" 
                   step="0.5"
                   placeholder="Ej: 2.5"
                   required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Género <span class="required">*</span></label>
            <div class="radio-group">
                <div class="form-check">
                    <input class="form-check-input" 
                           type="radio" 
                           name="Genero" 
                           id="GeneroMacho" 
                           value="Macho" 
                           <?php echo e(old('Genero') == 'Macho' ? 'checked' : ''); ?>

                           required>
                    <label class="form-check-label" for="GeneroMacho">
                        <i class="fas fa-mars me-1"></i>Macho
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" 
                           type="radio" 
                           name="Genero" 
                           id="GeneroHembra" 
                           value="Hembra" 
                           <?php echo e(old('Genero') == 'Hembra' ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="GeneroHembra">
                        <i class="fas fa-venus me-1"></i>Hembra
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <label for="estado" class="form-label">
                Estado Actual <span class="required">*</span>
            </label>
            <select class="form-select form-select-custom" 
                    id="estado" 
                    name="estado" 
                    required>
                <option value="">Selecciona un estado</option>
                <option value="En adopcion" <?php echo e(old('estado') == 'En adopcion' ? 'selected' : ''); ?>>
                    <i class="fas fa-heart me-1"></i>En adopción
                </option>
                <option value="Rescatada" <?php echo e(old('estado') == 'Rescatada' ? 'selected' : ''); ?>>
                    <i class="fas fa-shield-alt me-1"></i>Rescatada
                </option>
                <option value="Adoptado" <?php echo e(old('estado') == 'Adoptado' ? 'selected' : ''); ?>>
                    <i class="fas fa-home me-1"></i>Adoptado
                </option>
            </select>
        </div>
    </div>
</div><?php /**PATH C:\Users\Dan\Desktop\Rescatando-mascotas-foreve\resources\views/admin/mascotas/partials/create/form-basic-info.blade.php ENDPATH**/ ?>