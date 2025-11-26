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
</div><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/public/adopciones/partials/mascota_info.blade.php ENDPATH**/ ?>