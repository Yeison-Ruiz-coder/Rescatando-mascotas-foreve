<div class="seccion-formulario animacion-entrada">
    <h5>
        <i class="fas fa-clipboard-check"></i>Información Adicional
    </h5>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="experiencia_mascotas" class="form-label-solicitud">
                <i class="fas fa-paw"></i>Experiencia con Mascotas
            </label>
            <select class="form-select-solicitud <?php $__errorArgs = ['experiencia_mascotas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    id="experiencia_mascotas" name="experiencia_mascotas" required>
                <option value="">Selecciona una opción</option>
                <option value="Si, he tenido mascotas antes" <?php echo e(old('experiencia_mascotas') == 'Si, he tenido mascotas antes' ? 'selected' : ''); ?>>
                    Sí, he tenido mascotas antes
                </option>
                <option value="Si, actualmente tengo mascotas" <?php echo e(old('experiencia_mascotas') == 'Si, actualmente tengo mascotas' ? 'selected' : ''); ?>>
                    Sí, actualmente tengo mascotas
                </option>
                <option value="No, sería mi primera mascota" <?php echo e(old('experiencia_mascotas') == 'No, sería mi primera mascota' ? 'selected' : ''); ?>>
                    No, sería mi primera mascota
                </option>
            </select>
            <?php $__errorArgs = ['experiencia_mascotas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="mensaje-error">
                    <i class="fas fa-exclamation-circle"></i><?php echo e($message); ?>

                </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="col-md-6 mb-3">
            <label for="tipo_vivienda" class="form-label-solicitud">
                <i class="fas fa-home"></i>Tipo de Vivienda
            </label>
            <select class="form-select-solicitud <?php $__errorArgs = ['tipo_vivienda'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    id="tipo_vivienda" name="tipo_vivienda" required>
                <option value="">Selecciona una opción</option>
                <option value="Casa con patio" <?php echo e(old('tipo_vivienda') == 'Casa con patio' ? 'selected' : ''); ?>>
                    Casa con patio
                </option>
                <option value="Casa sin patio" <?php echo e(old('tipo_vivienda') == 'Casa sin patio' ? 'selected' : ''); ?>>
                    Casa sin patio
                </option>
                <option value="Apartamento" <?php echo e(old('tipo_vivienda') == 'Apartamento' ? 'selected' : ''); ?>>
                    Apartamento
                </option>
                <option value="Finca" <?php echo e(old('tipo_vivienda') == 'Finca' ? 'selected' : ''); ?>>
                    Finca
                </option>
                <option value="Otro" <?php echo e(old('tipo_vivienda') == 'Otro' ? 'selected' : ''); ?>>
                    Otro
                </option>
            </select>
            <?php $__errorArgs = ['tipo_vivienda'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="mensaje-error">
                    <i class="fas fa-exclamation-circle"></i><?php echo e($message); ?>

                </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    <div class="mb-0">
        <label for="motivo_adopcion" class="form-label-solicitud">
            <i class="fas fa-heart"></i>¿Por qué quieres adoptar a <?php echo e($mascota->Nombre_mascota); ?>?
        </label>
        <textarea class="form-control-solicitud <?php $__errorArgs = ['motivo_adopcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                  id="motivo_adopcion" name="motivo_adopcion" 
                  rows="4" 
                  placeholder="Cuéntanos por qué serías un buen hogar para <?php echo e($mascota->Nombre_mascota); ?>. Comparte tu motivación, experiencia y cómo planeas cuidarlo..." 
                  required><?php echo e(old('motivo_adopcion')); ?></textarea>
        <?php $__errorArgs = ['motivo_adopcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="mensaje-error">
                <i class="fas fa-exclamation-circle"></i><?php echo e($message); ?>

            </div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/public/adopciones/partials/form_informacion_adicional.blade.php ENDPATH**/ ?>