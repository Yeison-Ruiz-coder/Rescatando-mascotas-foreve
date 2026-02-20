
<div class="create-form-container">
    <form action="<?php echo e(route('admin.solicitudes.store')); ?>" method="POST" class="solicitud-form">
        <?php echo csrf_field(); ?>

        <div class="form-grid">
            <!-- Información del Solicitante -->
            <div class="form-group">
                <label for="usuario_id">
                    <i class="fa-solid fa-user"></i> Solicitante:
                </label>
                <select id="usuario_id" name="usuario_id" required class="form-control <?php $__errorArgs = ['usuario_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <option value="">Selecciona un usuario</option>
                    <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($usuario->id); ?>" <?php echo e(old('usuario_id') == $usuario->id ? 'selected' : ''); ?>>
                            <?php echo e($usuario->email); ?>

                            <?php if($usuario->nombre || $usuario->Nombre_1 || $usuario->name): ?>
                                - <?php echo e($usuario->nombre ?? $usuario->nombre_completo ?? $usuario->name ?? ''); ?>


                            <?php endif; ?>
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['usuario_id'];
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

            <!-- Resto del formulario se mantiene igual -->
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
                    <option value="Para Adoptar" <?php echo e(old('tipo') == 'Para Adoptar' ? 'selected' : ''); ?>>Para Adoptar</option>
                    <option value="Para Rescatar" <?php echo e(old('tipo') == 'Para Rescatar' ? 'selected' : ''); ?>>Para Rescatar</option>
                    <option value="Para Apadrinar" <?php echo e(old('tipo') == 'Para Apadrinar' ? 'selected' : ''); ?>>Para Apadrinar</option>
                    <option value="Para Donar" <?php echo e(old('tipo') == 'Para Donar' ? 'selected' : ''); ?>>Para Donar</option>
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
                    <option value="En Revisión" <?php echo e(old('estado', 'En Revisión') == 'En Revisión' ? 'selected' : ''); ?>>En Revisión</option>
                    <option value="Aprobada" <?php echo e(old('estado') == 'Aprobada' ? 'selected' : ''); ?>>Aprobada</option>
                    <option value="Rechazada" <?php echo e(old('estado') == 'Rechazada' ? 'selected' : ''); ?>>Rechazada</option>
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
                       value="<?php echo e(old('fecha_solicitud', now()->format('Y-m-d\TH:i'))); ?>"
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
                <div class="help-text">
                    <i class="fa-solid fa-info-circle"></i> Se autocompletará con la fecha y hora actual
                </div>
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
                      placeholder="Describe los detalles de la solicitud, justificación, observaciones..."><?php echo e(old('contenido')); ?></textarea>
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
                <i class="fa-solid fa-info-circle"></i> Describe detalladamente la solicitud. Mínimo 10 caracteres.
            </div>
        </div>

        <!-- Información Adicional -->
        <div class="info-card">
            <h5><i class="fa-solid fa-lightbulb"></i> Información Importante</h5>
            <ul>
                <li>Las solicitudes creadas aparecerán en el listado principal</li>
                <li>El estado por defecto es "En Revisión"</li>
                <li>Puedes editar la solicitud después de crearla</li>
                <li>Verifica que todos los datos sean correctos antes de guardar</li>
            </ul>
        </div>

        <!-- Botones de Acción -->
        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-plus"></i> Crear Solicitud
            </button>
            <a href="<?php echo e(route('admin.solicitudes.index')); ?>" class="btn-cancel">
                <i class="fa-solid fa-times"></i> Cancelar
            </a>
        </div>
    </form>
</div>
<?php /**PATH C:\xampp\htdocs\Rescatando-mascotas-foreve\resources\views/admin/solicitud/partials/create/form.blade.php ENDPATH**/ ?>