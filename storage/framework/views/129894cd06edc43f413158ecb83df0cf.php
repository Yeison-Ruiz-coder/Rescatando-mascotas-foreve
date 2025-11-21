<!-- Badges informativos -->
<div class="mb-4">
    <span class="badge badge-especie me-2 mb-2">
        <i class="fas fa-paw me-1"></i><?php echo e($mascota->Especie); ?>

    </span>
    <span class="badge badge-genero me-2 mb-2">
        <i class="fas fa-venus-mars me-1"></i><?php echo e($mascota->Genero); ?>

    </span>
    <span class="badge bg-secondary me-2 mb-2 px-3 py-2">
        <i class="fas fa-birthday-cake me-1"></i><?php echo e($mascota->Edad_aprox); ?> años
    </span>
</div>

<!-- Información básica -->
<div class="row mb-4">
    <div class="col-md-6 mb-3">
        <div class="info-circle d-flex align-items-center">
            <i class="fas fa-paw icono me-3"></i>
            <div>
                <small class="text-muted d-block">Especie</small>
                <strong class="text-turquesa"><?php echo e($mascota->Especie); ?></strong>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="info-circle d-flex align-items-center">
            <i class="fas fa-venus-mars icono me-3"></i>
            <div>
                <small class="text-muted d-block">Género</small>
                <strong class="text-turquesa"><?php echo e($mascota->Genero); ?></strong>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="info-circle d-flex align-items-center">
            <i class="fas fa-birthday-cake icono me-3"></i>
            <div>
                <small class="text-muted d-block">Edad</small>
                <strong class="text-turquesa"><?php echo e($mascota->Edad_aprox); ?> años</strong>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="info-circle d-flex align-items-center">
            <i class="fas fa-dna icono me-3"></i>
            <div>
                <small class="text-muted d-block">Raza</small>
                <strong class="text-turquesa"><?php echo e($mascota->Raza); ?></strong>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/public/mascotas/partials/show/basic-info.blade.php ENDPATH**/ ?>