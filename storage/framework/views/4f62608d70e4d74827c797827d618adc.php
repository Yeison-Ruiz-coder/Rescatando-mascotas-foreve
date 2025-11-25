<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/pages/adopciones/create.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- HEADER -->
            <div class="create-adopcion-header animacion-entrada">
                <h1 class="display-5 fw-bold">
                    <i class="fas fa-paw me-3"></i>Registrar Nueva Adopción
                </h1>
                <p class="lead">
                    Completa el formulario para registrar un nuevo proceso de adopción en el sistema
                </p>
            </div>

            <!-- ALERTAS DE ERROR -->
            <?php if($errors->any()): ?>
                <div class="alertas-error mb-4 animacion-entrada">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-exclamation-triangle me-2 text-danger"></i>
                        <h5 class="mb-0 text-danger">Por favor corrige los siguientes errores:</h5>
                    </div>
                    <ul class="mb-0 ps-3">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- FORMULARIO PRINCIPAL -->
            <div class="card card-formulario-adopcion animacion-entrada">
                <div class="card-header card-header-formulario">
                    <h4 class="mb-0">
                        <i class="fas fa-file-contract"></i>
                        Formulario de Registro de Adopción
                    </h4>
                </div>
                
                <div class="card-body p-4">
                    <form action="<?php echo e(route('adopciones.store')); ?>" method="POST" id="formAdopcion">
                        <?php echo csrf_field(); ?>

                        <!-- INFORMACIÓN PRINCIPAL -->
                        <div class="grupo-formulario transicion-suave">
                            <h5>
                                <i class="fas fa-info-circle"></i>
                                Información Principal
                            </h5>
                            
                            <div class="row">
                                <!-- Mascota -->
                                <div class="col-md-6 mb-4">
                                    <label for="mascota_id" class="form-label-crear" required>
                                        <i class="fas fa-paw"></i>Mascota
                                    </label>
                                    <select class="form-select-crear <?php $__errorArgs = ['mascota_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                            id="mascota_id" name="mascota_id" required>
                                        <option value="">Selecciona una mascota</option>
                                        <?php $__currentLoopData = $mascotas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mascota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($mascota->id); ?>"
                                                <?php echo e(old('mascota_id') == $mascota->id ? 'selected' : ''); ?>>
                                                <?php echo e($mascota->Nombre_mascota); ?> - <?php echo e($mascota->Especie); ?> 
                                                (<?php echo e($mascota->Raza); ?>) - <?php echo e($mascota->estado); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['mascota_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <small class="form-text text-muted mt-1">
                                        Solo se muestran mascotas disponibles para adopción
                                    </small>
                                </div>

                                <!-- Usuario Adoptante -->
                                <div class="col-md-6 mb-4">
                                    <label for="usuario_id" class="form-label-crear" required>
                                        <i class="fas fa-user"></i>Adoptante
                                    </label>
                                    <select class="form-select-crear <?php $__errorArgs = ['usuario_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                            id="usuario_id" name="usuario_id" required>
                                        <option value="">Selecciona un adoptante</option>
                                        <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($usuario->id); ?>"
                                                <?php echo e(old('usuario_id') == $usuario->id ? 'selected' : ''); ?>>
                                                <?php echo e($usuario->Nombre_1); ?> <?php echo e($usuario->Apellido_1); ?>

                                                <?php if($usuario->Nombre_2 || $usuario->Apellido_2): ?>
                                                    (<?php echo e($usuario->Nombre_2); ?> <?php echo e($usuario->Apellido_2); ?>)
                                                <?php endif; ?>
                                                - <?php echo e($usuario->Email); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['usuario_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <small class="form-text text-muted mt-1">
                                        Solo se muestran usuarios registrados como clientes
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- DETALLES DE LA ADOPCIÓN -->
                        <div class="grupo-formulario transicion-suave">
                            <h5>
                                <i class="fas fa-calendar-alt"></i>
                                Detalles de la Adopción
                            </h5>
                            
                            <div class="row">
                                <!-- Fecha Adopción -->
                                <div class="col-md-6 mb-4">
                                    <label for="Fecha_adopcion" class="form-label-crear" required>
                                        <i class="fas fa-calendar"></i>Fecha de Adopción
                                    </label>
                                    <input type="date" class="form-control-crear <?php $__errorArgs = ['Fecha_adopcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="Fecha_adopcion" name="Fecha_adopcion"
                                           value="<?php echo e(old('Fecha_adopcion')); ?>" required>
                                    <?php $__errorArgs = ['Fecha_adopcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <!-- Lugar Adopción -->
                                <div class="col-md-6 mb-4">
                                    <label for="Lugar_adopcion" class="form-label-crear" required>
                                        <i class="fas fa-map-marker-alt"></i>Lugar de Adopción
                                    </label>
                                    <input type="text" class="form-control-crear <?php $__errorArgs = ['Lugar_adopcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="Lugar_adopcion" name="Lugar_adopcion"
                                           value="<?php echo e(old('Lugar_adopcion')); ?>" 
                                           placeholder="Ej: Fundación Mi Mascota, Bogotá" required>
                                    <?php $__errorArgs = ['Lugar_adopcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        <!-- INFORMACIÓN ADICIONAL -->
                        <div class="grupo-formulario transicion-suave">
                            <h5>
                                <i class="fas fa-cogs"></i>
                                Información Adicional
                            </h5>
                            
                            <div class="row">
                                <!-- Estado -->
                                <div class="col-md-6 mb-4">
                                    <label for="estado" class="form-label-crear" required>
                                        <i class="fas fa-tasks"></i>Estado del Proceso
                                    </label>
                                    <select class="form-select-crear <?php $__errorArgs = ['estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                            id="estado" name="estado" required>
                                        <option value="">Selecciona un estado</option>
                                        <option value="En proceso" <?php echo e(old('estado') == 'En proceso' ? 'selected' : ''); ?>>
                                            En proceso
                                        </option>
                                        <option value="Aprobado" <?php echo e(old('estado') == 'Aprobado' ? 'selected' : ''); ?>>
                                            Aprobado
                                        </option>
                                        <option value="Rechazado" <?php echo e(old('estado') == 'Rechazado' ? 'selected' : ''); ?>>
                                            Rechazado
                                        </option>
                                    </select>
                                    <?php $__errorArgs = ['estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <!-- Administrador -->
                                <div class="col-md-6 mb-4">
                                    <label for="administrador_id" class="form-label-crear">
                                        <i class="fas fa-user-shield"></i>Administrador Responsable
                                    </label>
                                    <select class="form-select-crear <?php $__errorArgs = ['administrador_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                            id="administrador_id" name="administrador_id">
                                        <option value="">Selecciona un administrador</option>
                                        <?php $__currentLoopData = $administradores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($admin->id); ?>"
                                                <?php echo e(old('administrador_id') == $admin->id ? 'selected' : ''); ?>>
                                                <?php echo e($admin->Nombre_1); ?> <?php echo e($admin->Apellido_1); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['administrador_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <!-- Fundación -->
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="fundacion_id" class="form-label-crear">
                                        <i class="fas fa-home"></i>Fundación
                                    </label>
                                    <select class="form-select-crear <?php $__errorArgs = ['fundacion_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                            id="fundacion_id" name="fundacion_id">
                                        <option value="">Selecciona una fundación</option>
                                        <?php $__currentLoopData = $fundaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fundacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($fundacion->id); ?>"
                                                <?php echo e(old('fundacion_id') == $fundacion->id ? 'selected' : ''); ?>>
                                                <?php echo e($fundacion->Nombre_1); ?> - <?php echo e($fundacion->Direccion); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['fundacion_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        <!-- RAZÓN DE RECHAZO (CONDICIONAL) -->
                        <div class="razon-rechazo-container <?php if(old('estado') == 'Rechazado'): ?> mostrar <?php endif; ?>" 
                             id="razon_rechazo_container">
                            <div class="mb-3">
                                <label for="razon_rechazo" class="form-label-crear">
                                    <i class="fas fa-exclamation-triangle"></i>Razón de Rechazo
                                </label>
                                <textarea class="form-control-crear <?php $__errorArgs = ['razon_rechazo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                          id="razon_rechazo" name="razon_rechazo" 
                                          rows="4" 
                                          placeholder="Describe detalladamente la razón del rechazo de esta adopción..."><?php echo e(old('razon_rechazo')); ?></textarea>
                                <?php $__errorArgs = ['razon_rechazo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <small class="form-text text-muted">
                                    Este campo es obligatorio cuando el estado es "Rechazado"
                                </small>
                            </div>
                        </div>

                        <!-- BOTONES DE ACCIÓN -->
                        <div class="botones-creacion">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="<?php echo e(route('adopciones.index')); ?>" class="btn btn-cancelar-crear">
                                    <i class="fas fa-arrow-left me-2"></i>Cancelar y Volver
                                </a>
                                <button type="submit" class="btn btn-crear" id="btnSubmit">
                                    <i class="fas fa-save me-2"></i>Registrar Adopción
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const estadoSelect = document.getElementById('estado');
    const razonContainer = document.getElementById('razon_rechazo_container');
    const razonTextarea = document.getElementById('razon_rechazo');
    const form = document.getElementById('formAdopcion');
    const btnSubmit = document.getElementById('btnSubmit');
    
    function toggleRazonRechazo() {
        if (estadoSelect.value === 'Rechazado') {
            razonContainer.classList.add('mostrar');
            razonTextarea.required = true;
        } else {
            razonContainer.classList.remove('mostrar');
            razonTextarea.required = false;
        }
    }
    
    // Ejecutar al cargar la página
    toggleRazonRechazo();
    
    // Ejecutar cuando cambie el estado
    estadoSelect.addEventListener('change', toggleRazonRechazo);
    
    // Validación antes de enviar el formulario
    form.addEventListener('submit', function(e) {
        if (estadoSelect.value === 'Rechazado' && !razonTextarea.value.trim()) {
            e.preventDefault();
            alert('Por favor, proporciona una razón de rechazo cuando el estado es "Rechazado"');
            razonTextarea.focus();
            return;
        }
        
        // Mostrar estado de carga
        btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Registrando...';
        btnSubmit.disabled = true;
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('portals.public.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Dan\Desktop\Rescatando-mascotas-foreve\resources\views/adopciones/create.blade.php ENDPATH**/ ?>