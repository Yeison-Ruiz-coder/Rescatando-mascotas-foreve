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
</nav><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/public/adopciones/partials/breadcrumb.blade.php ENDPATH**/ ?>