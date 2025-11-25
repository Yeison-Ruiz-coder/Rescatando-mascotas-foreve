<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/pages/adopciones/solicitudes.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- BREADCRUMB MEJORADO -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb breadcrumb-solicitud">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('public.mascotas.index')); ?>">
                            <i class="fas fa-paw me-1"></i>Mascotas
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('public.mascotas.show', $mascota->id)); ?>">
                            <?php echo e($mascota->Nombre_mascota); ?>

                        </a>
                    </li>
                    <li class="breadcrumb-item active">Solicitar Adopción</li>
                </ol>
            </nav>

            <!-- CARD PRINCIPAL -->
            <div class="card card-solicitud animacion-entrada">
                <!-- HEADER -->
                <div class="header-solicitud">
                    <h3 class="mb-0">
                        <i class="fas fa-heart corazon-latido me-2"></i>Solicitar Adopción
                    </h3>
                    <p class="mb-0 mt-2">
                        Estás a un paso de darle un hogar a <strong><?php echo e($mascota->Nombre_mascota); ?></strong>
                    </p>
                </div>
                
                <div class="card-body p-4">
                    <!-- INFORMACIÓN DE LA MASCOTA -->
                    <div class="info-mascota-solicitud animacion-entrada">
                        <div class="row align-items-center">
                            <div class="col-md-3 text-center mb-3 mb-md-0">
                                <?php if($mascota->Foto): ?>
                                <img src="<?php echo e(asset('storage/' . $mascota->Foto)); ?>" 
                                     class="foto-mascota-solicitud" 
                                     alt="<?php echo e($mascota->Nombre_mascota); ?>">
                                <?php else: ?>
                                <div class="placeholder-foto-mascota">
                                    <i class="fas fa-paw"></i>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-9">
                                <h4 class="nombre-mascota-solicitud"><?php echo e($mascota->Nombre_mascota); ?></h4>
                                <div class="mb-3">
                                    <span class="badge badge-especie me-1"><?php echo e($mascota->Especie); ?></span>
                                    <span class="badge badge-genero me-1"><?php echo e($mascota->Genero); ?></span>
                                    <span class="badge badge-edad"><?php echo e($mascota->Edad_aprox); ?> años</span>
                                </div>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-quote-left me-1 text-turquesa"></i>
                                    <?php echo e(Str::limit($mascota->Descripcion, 200)); ?>

                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- SEPARADOR -->
                    <hr class="separador-seccion">

                    <!-- FORMULARIO DE SOLICITUD -->
                    <form action="<?php echo e(route('adopciones.solicitar.store', $mascota->id)); ?>" method="POST" id="formSolicitud">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="mascota_id" value="<?php echo e($mascota->id); ?>">

                        <!-- SECCIÓN DATOS PERSONALES -->
                        <div class="seccion-formulario animacion-entrada">
                            <h5>
                                <i class="fas fa-user-circle"></i>Tus Datos Personales
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label-solicitud">
                                        <i class="fas fa-signature"></i>Nombre
                                    </label>
                                    <input type="text" class="form-control-solicitud <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="nombre" name="nombre" 
                                           value="<?php echo e(old('nombre')); ?>" 
                                           placeholder="Ingresa tu nombre" required>
                                    <?php $__errorArgs = ['nombre'];
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
                                    <label for="apellido" class="form-label-solicitud">
                                        <i class="fas fa-signature"></i>Apellido
                                    </label>
                                    <input type="text" class="form-control-solicitud <?php $__errorArgs = ['apellido'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="apellido" name="apellido" 
                                           value="<?php echo e(old('apellido')); ?>" 
                                           placeholder="Ingresa tu apellido" required>
                                    <?php $__errorArgs = ['apellido'];
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

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label-solicitud">
                                        <i class="fas fa-envelope"></i>Email
                                    </label>
                                    <input type="email" class="form-control-solicitud <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="email" name="email" 
                                           value="<?php echo e(old('email')); ?>" 
                                           placeholder="tu@email.com" required>
                                    <?php $__errorArgs = ['email'];
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
                                    <label for="telefono" class="form-label-solicitud">
                                        <i class="fas fa-phone"></i>Teléfono
                                    </label>
                                    <input type="tel" class="form-control-solicitud <?php $__errorArgs = ['telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="telefono" name="telefono" 
                                           value="<?php echo e(old('telefono')); ?>" 
                                           placeholder="+57 300 123 4567" required>
                                    <?php $__errorArgs = ['telefono'];
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

                            <div class="mb-3">
                                <label for="direccion" class="form-label-solicitud">
                                    <i class="fas fa-map-marker-alt"></i>Dirección Completa
                                </label>
                                <textarea class="form-control-solicitud <?php $__errorArgs = ['direccion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                          id="direccion" name="direccion" 
                                          rows="3" 
                                          placeholder="Ingresa tu dirección completa (ciudad, barrio, dirección)" 
                                          required><?php echo e(old('direccion')); ?></textarea>
                                <?php $__errorArgs = ['direccion'];
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

                        <!-- SECCIÓN INFORMACIÓN ADICIONAL -->
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
                        </div>

                        <!-- COMPROMISOS DE ADOPCIÓN -->
                        <div class="card card-compromisos animacion-entrada">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <i class="fas fa-handshake"></i>Compromisos de Adopción
                                </h6>
                                
                                <div class="form-check-compromiso">
                                    <input class="form-check-input" type="checkbox" id="compromiso_cuidado" name="compromiso_cuidado" required
                                           <?php echo e(old('compromiso_cuidado') ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="compromiso_cuidado">
                                        <strong>Cuidado responsable:</strong> Me comprometo a proporcionar todos los cuidados necesarios incluyendo alimentación adecuada, atención veterinaria regular, ejercicio y mucho amor.
                                    </label>
                                </div>
                                
                                <div class="form-check-compromiso">
                                    <input class="form-check-input" type="checkbox" id="compromiso_esterilizacion" name="compromiso_esterilizacion" required
                                           <?php echo e(old('compromiso_esterilizacion') ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="compromiso_esterilizacion">
                                        <strong>Esterilización:</strong> Acepto esterilizar a la mascota si no lo está, de acuerdo con las políticas de la fundación para controlar la población animal.
                                    </label>
                                </div>
                                
                                <div class="form-check-compromiso">
                                    <input class="form-check-input" type="checkbox" id="compromiso_seguimiento" name="compromiso_seguimiento" required
                                           <?php echo e(old('compromiso_seguimiento') ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="compromiso_seguimiento">
                                        <strong>Seguimiento:</strong> Permito visitas de seguimiento por parte de la fundación para verificar el bienestar de la mascota y proporcionaré actualizaciones periódicas.
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- BOTONES DE ACCIÓN -->
                        <div class="botones-accion-solicitud">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="<?php echo e(route('public.mascotas.show', $mascota->id)); ?>" class="btn btn-cancelar-solicitud">
                                    <i class="fas fa-arrow-left me-2"></i>Cancelar
                                </a>
                                <button type="submit" class="btn btn-enviar-solicitud" id="btnEnviarSolicitud">
                                    <i class="fas fa-paper-plane me-2"></i>Enviar Solicitud
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- INFORMACIÓN DEL PROCESO -->
            <div class="info-proceso mt-4 animacion-entrada">
                <h6 class="card-title">
                    <i class="fas fa-info-circle"></i>Proceso de Adopción
                </h6>
                <ol class="mb-0">
                    <li><strong>Solicitud:</strong> Completa y envía este formulario</li>
                    <li><strong>Revisión:</strong> La fundación revisará tu solicitud (2-3 días hábiles)</li>
                    <li><strong>Entrevista:</strong> Contactaremos para una entrevista telefónica o virtual</li>
                    <li><strong>Evaluación:</strong> Análisis de compatibilidad y condiciones del hogar</li>
                    <li><strong>Decisión:</strong> Te informaremos la decisión final por email</li>
                    <li><strong>Adopción:</strong> Si es aprobada, coordinaremos la entrega de la mascota</li>
                </ol>
                <div class="mt-3 p-3 bg-light rounded">
                    <small class="text-muted">
                        <i class="fas fa-clock me-1"></i>
                        <strong>Tiempo estimado del proceso:</strong> 5-7 días hábiles
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formSolicitud');
    const btnEnviar = document.getElementById('btnEnviarSolicitud');
    const checkboxes = [
        'compromiso_cuidado',
        'compromiso_esterilizacion', 
        'compromiso_seguimiento'
    ];
    
    // Validación de checkboxes
    form.addEventListener('submit', function(e) {
        let todosMarcados = true;
        
        for (let checkboxId of checkboxes) {
            const checkbox = document.getElementById(checkboxId);
            if (!checkbox.checked) {
                todosMarcados = false;
                break;
            }
        }
        
        if (!todosMarcados) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Compromisos pendientes',
                text: 'Debes aceptar todos los compromisos de adopción para continuar',
                confirmButtonColor: '#1B8E95'
            });
            return;
        }
        
        // Mostrar estado de carga
        btnEnviar.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Enviando...';
        btnEnviar.classList.add('cargando');
        btnEnviar.disabled = true;
    });
    
    // Restaurar estado del formulario si hay errores
    <?php if($errors->any()): ?>
        // Scroll suave al primer error
        const firstError = document.querySelector('.is-invalid');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstError.focus();
        }
    <?php endif; ?>
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('portals.public.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Dan\Desktop\Rescatando-mascotas-foreve\resources\views/adopciones/solicitar.blade.php ENDPATH**/ ?>