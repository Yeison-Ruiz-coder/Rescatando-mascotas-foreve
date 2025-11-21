<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/pages/mascotas/public-index.css')); ?>?v=2.0">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <!-- HERO MODERNO -->
    <div class="hero-mascotas text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1> Encuentra a tu Compañero Ideal</h1>
                <p class="lead">Descubre mascotas increíbles esperando por un hogar lleno de amor</p>
            </div>
        </div>
    </div>

    <!-- FILTROS MODERNOS -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="filtros-modernos">
                <form action="<?php echo e(route('mascotas.public.index')); ?>" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label text-turquesa fw-bold">Especie</label>
                        <select name="especie" class="form-select">
                            <option value="">Todas las especies</option>
                            <?php $__currentLoopData = $especies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $especie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($especie); ?>" <?php echo e(request('especie') == $especie ? 'selected' : ''); ?>>
                                    <?php echo e($especie); ?>s
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-turquesa fw-bold">Género</label>
                        <select name="genero" class="form-select">
                            <option value="">Todos los géneros</option>
                            <option value="Macho" <?php echo e(request('genero') == 'Macho' ? 'selected' : ''); ?>>Machos</option>
                            <option value="Hembra" <?php echo e(request('genero') == 'Hembra' ? 'selected' : ''); ?>>Hembras</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn-buscar-moderno">
                            <i class="fas fa-search me-2"></i> Buscar Mascotas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- CONTADOR MODERNO -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="contador-mascotas">
                <i class="fas fa-paw me-2"></i>
                <strong><?php echo e($mascotas->total()); ?></strong> amigos peludos esperando por ti
            </div>
        </div>
    </div>

    <!-- GRID DE MASCOTAS MODERNO -->
    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $mascotas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mascota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card-mascota-moderna">
                <!-- Imagen con overlay -->
                <div class="card-imagen-container">
                    <?php if($mascota->Foto): ?>
                    <img src="<?php echo e(asset('storage/' . $mascota->Foto)); ?>" 
                         alt="<?php echo e($mascota->Nombre_mascota); ?>">
                    <?php else: ?>
                    <div class="w-100 h-100 bg-gris-claro d-flex align-items-center justify-content-center">
                        <i class="fas fa-paw fa-4x text-turquesa opacity-50"></i>
                    </div>
                    <?php endif; ?>
                    <div class="overlay-mascota"></div>
                    
                    <!-- Badges flotantes -->
                    <div class="badges-container">
                        <span class="badge-moderno badge-especie-moderno">
                            <?php echo e($mascota->Especie); ?>

                        </span>
                        <span class="badge-moderno badge-genero-moderno">
                            <?php echo e($mascota->Genero); ?>

                        </span>
                        <span class="badge-moderno badge-edad-moderno">
                            <?php echo e($mascota->Edad_aprox); ?> años
                        </span>
                    </div>
                </div>
                
                <!-- Contenido -->
                <div class="card-body-moderno">
                    <h3 class="nombre-mascota"><?php echo e($mascota->Nombre_mascota); ?></h3>
                    
                    <p class="descripcion-mascota">
                        <?php echo e(Str::limit($mascota->Descripcion, 150)); ?>

                    </p>
                    
                    <!-- Información de fundación -->
                    <?php if($mascota->fundacion): ?>
                    <div class="info-fundacion">
                        <i class="fas fa-home"></i>
                        <span>Rescatado por: <?php echo e($mascota->fundacion->Nombre_1); ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Botón -->
                    <a href="<?php echo e(route('mascotas.public.show', $mascota->id)); ?>" 
                       class="btn-conocer-mas">
                       <i class="fas fa-heart me-2"></i>Conocer a <?php echo e($mascota->Nombre_mascota); ?>

                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <!-- ESTADO VACÍO -->
        <div class="col-12">
            <div class="estado-vacio">
                <i class="fas fa-search fa-4x mb-3"></i>
                <h4>No encontramos mascotas</h4>
                <p class="text-muted mb-4">Intenta ajustar los filtros de búsqueda</p>
                <a href="<?php echo e(route('mascotas.public.index')); ?>" class="btn-conocer-mas" style="width: auto; display: inline-block;">
                    <i class="fas fa-redo me-2"></i>Ver Todas las Mascotas
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>


    <!-- PAGINACIÓN MODERNA -->
    <?php if($mascotas->hasPages()): ?>
    <div class="row mt-5">
        <div class="col-12 paginacion-moderna">
            <?php echo e($mascotas->links()); ?>

        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/mascotas/public-index.blade.php ENDPATH**/ ?>