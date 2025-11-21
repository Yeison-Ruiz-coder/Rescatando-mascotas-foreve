
<!-- Foto Principal Grande -->
<div class="card shadow-lg border-0 mb-3">
    <?php if($mascota->galeria_fotos && count($mascota->galeria_fotos) > 0): ?>
        <img src="<?php echo e(Storage::url($mascota->galeria_fotos[0]['ruta'])); ?>"
            class="card-img-top gallery-main-img" alt="Foto de <?php echo e($mascota->Nombre_mascota); ?>"
            id="foto-principal" data-bs-toggle="modal" data-bs-target="#galeriaModal">
    <?php else: ?>
        <img src="<?php echo e(Storage::url($mascota->Foto)); ?>" class="card-img-top gallery-main-img"
            alt="Foto de <?php echo e($mascota->Nombre_mascota); ?>">
    <?php endif; ?>

    <div class="card-body bg-light text-center">
        <h1 class="card-title display-4 fw-bolder mb-0"><?php echo e($mascota->Nombre_mascota); ?></h1>
        <p class="text-muted lead"><?php echo e($mascota->Especie); ?> - <?php echo e($mascota->estado); ?></p>
        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <span class="badge estado-badge fs-6"><?php echo e($mascota->estado); ?></span>
            <span class="text-secondary fw-bold"><?php echo e($mascota->Edad_aprox); ?> años</span>
        </div>
        <?php if($mascota->galeria_fotos && count($mascota->galeria_fotos) > 1): ?>
            <small class="text-muted mt-2 d-block">
                <i class="fas fa-images me-1"></i>
                Haz clic en la foto para ver la galería completa (<?php echo e(count($mascota->galeria_fotos)); ?> fotos)
            </small>
        <?php endif; ?>
    </div>
</div>

<!-- Miniaturas de la Galería -->
<?php if($mascota->galeria_fotos && count($mascota->galeria_fotos) > 1): ?>
    <div class="row g-2 mb-4">
        <div class="col-12">
            <h5 class="mb-3">
                <i class="fas fa-th me-2"></i>Galería de Fotos
            </h5>
        </div>
        <?php $__currentLoopData = $mascota->galeria_fotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-3">
                <div class="thumbnail-container position-relative">
                    <img src="<?php echo e(Storage::url($foto['ruta'])); ?>"
                        class="img-thumbnail gallery-thumbnail <?php echo e($index === 0 ? 'active' : ''); ?>"
                        onclick="cambiarFotoPrincipal('<?php echo e(Storage::url($foto['ruta'])); ?>', <?php echo e($index); ?>)"
                        alt="<?php echo e($foto['titulo'] ?? 'Foto ' . ($index + 1)); ?>" data-bs-toggle="modal"
                        data-bs-target="#galeriaModal" data-index="<?php echo e($index); ?>">
                    <?php if($index === 0): ?>
                        <span class="badge position-absolute top-0 start-0">Principal</span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/admin/mascotas/partials/show/gallery.blade.php ENDPATH**/ ?>