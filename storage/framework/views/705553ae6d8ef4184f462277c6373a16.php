
<div class="edit-form-container">
    <form action="<?php echo e(route('solicitud.update', $solicitud)); ?>" method="POST" class="solicitud-form">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- INFORMACIÓN DE SOLICITANTE (Solo lectura) -->
<div class="edit-form-container">
    <form action="<?php echo e(route('solicitud.update', $solicitud)); ?>" method="POST" class="solicitud-form">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- CAMPO OCULTO PARA usuario_id -->
        <input type="hidden" name="usuario_id" value="<?php echo e($solicitud->usuario_id); ?>">

        <!-- INFORMACIÓN DE SOLICITANTE (Solo lectura) -->
        <div class="info-card">
            <div class="info-grid">
                <div class="info-item">
                
                <?php if($solicitud->mascota): ?>
                <div class="info-item">
                    <strong>Nombre del solicitante:</strong>
                    <span><?php echo e($solicitud->usuario->nombre_completo); ?></span>
                </div>
                <?php endif; ?>
                <?php if($solicitud->mascota): ?>
                <div class="info-item">
                    <strong>Mascota solicitada:</strong>
                    <span><?php echo e($solicitud->mascota->Nombre_mascota); ?> (<?php echo e($solicitud->mascota->Especie); ?>)</span>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-grid">
            <!-- Tipo de Solicitud -->
            <div class="form-group">
                <label for="tipo">
                    <i class="fa-solid fa-tag"></i> Tipo de Solicitud:
                </label>
                <select id="tipo" name="tipo" required class="form-control <?php $__errorArgs = ['tipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <option value="">Selecciona un tipo</option>
                    <option value="Para Adoptar" <?php echo e(old('tipo', $solicitud->tipo) == 'Para Adoptar' ? 'selected' : ''); ?>>Para Adoptar</option>
                    <option value="Para Rescatar" <?php echo e(old('tipo', $solicitud->tipo) == 'Para Rescatar' ? 'selected' : ''); ?>>Para Rescatar</option>
                    <option value="Para Apadrinar" <?php echo e(old('tipo', $solicitud->tipo) == 'Para Apadrinar' ? 'selected' : ''); ?>>Para Apadrinar</option>
                    <option value="Para Donar" <?php echo e(old('tipo', $solicitud->tipo) == 'Para Donar' ? 'selected' : ''); ?>>Para Donar</option>
                </select>
                <?php $__errorArgs = ['tipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error-message"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Estado -->
            <div class="form-group">
                <label for="estado">
                    <i class="fa-solid fa-circle-check"></i> Estado:
                </label>
                <select id="estado" name="estado" required class="form-control <?php $__errorArgs = ['estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <option value="En Revisión" <?php echo e(old('estado', $solicitud->estado) == 'En Revisión' ? 'selected' : ''); ?>>En Revisión</option>
                    <option value="Aprobada" <?php echo e(old('estado', $solicitud->estado) == 'Aprobada' ? 'selected' : ''); ?>>Aprobada</option>
                    <option value="Rechazada" <?php echo e(old('estado', $solicitud->estado) == 'Rechazada' ? 'selected' : ''); ?>>Rechazada</option>
                </select>
                <?php $__errorArgs = ['estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error-message"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Fecha de Solicitud -->
            <div class="form-group">
                <label for="fecha_solicitud">
                    <i class="fa-solid fa-calendar"></i> Fecha de Solicitud:
                </label>
                <input type="datetime-local" id="fecha_solicitud" name="fecha_solicitud" 
                       value="<?php echo e(old('fecha_solicitud', $solicitud->fecha_solicitud->format('Y-m-d\TH:i'))); ?>" 
                       required class="form-control <?php $__errorArgs = ['fecha_solicitud'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php $__errorArgs = ['fecha_solicitud'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error-message"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Contenido / Justificación -->
        <div class="form-group full-width">
            <label for="contenido">
                <i class="fa-solid fa-file-lines"></i> Contenido / Justificación:
            </label>
            <textarea id="contenido" name="contenido" rows="10" required 
                      class="form-control <?php $__errorArgs = ['contenido'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                      placeholder="Describe los detalles de la solicitud..."><?php echo e(old('contenido', $solicitud->contenido)); ?></textarea>
            <?php $__errorArgs = ['contenido'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error-message"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <div class="help-text">
                <i class="fa-solid fa-info-circle"></i> Aquí puedes modificar o añadir notas internas sobre la justificación del solicitante.
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-save"></i> Guardar Cambios
            </button>
            <a href="<?php echo e(route('solicitud.show', $solicitud)); ?>" class="btn-cancel">
                <i class="fa-solid fa-times"></i> Cancelar
            </a>
            <a href="<?php echo e(route('solicitud.index')); ?>" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Volver al Listado
            </a>
        </div>
    </form>
</div><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/admin/solicitud/partials/edit/form.blade.php ENDPATH**/ ?>