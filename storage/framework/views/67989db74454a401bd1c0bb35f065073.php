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
                    <form action="<?php echo e(route('adopciones.solicitar.store')); ?>" method="POST" id="formSolicitud">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="mascota_id" value="<?php echo e($mascota->id); ?>">

                        <!-- ... (el resto del formulario se mantiene igual) ... -->

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

            <!-- ... (resto del código se mantiene igual) ... -->
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/home/home.blade.php ENDPATH**/ ?>