<!-- Imagen principal -->
<div class="card card-mascota mb-4">
    <div class="card-body p-0">
        <?php if($mascota->Foto): ?>
        <img src="<?php echo e(asset('storage/' . $mascota->Foto)); ?>" 
             class="img-fluid imagen-principal w-100" 
             alt="<?php echo e($mascota->Nombre_mascota); ?>"
             id="imagenPrincipal">
        <?php else: ?>
        <div class="d-flex align-items-center justify-content-center bg-gris-claro" 
             style="height: 400px;">
            <i class="fas fa-paw fa-5x text-turquesa opacity-50"></i>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Galería de fotos -->
<?php if($mascota->galeria_fotos && count($mascota->galeria_fotos) > 0): ?>
<div class="card card-mascota mb-4">
    <div class="card-header card-header-turquesa">
        <h6 class="mb-0"><i class="fas fa-images me-2"></i>Más Fotos</h6>
    </div>
    <div class="card-body">
        <div class="row g-2">
            <?php $__currentLoopData = $mascota->galeria_fotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-4">
                <img src="<?php echo e(asset('storage/' . $foto['ruta'])); ?>" 
                     class="gallery-thumb" 
                     alt="<?php echo e($foto['titulo'] ?? 'Foto'); ?>"
                     onclick="cambiarImagenPrincipal('<?php echo e(asset('storage/' . $foto['ruta'])); ?>')">
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endif; ?><?php /**PATH C:\Users\Dan\Desktop\Rescatando-mascotas-foreve\resources\views/public/mascotas/partials/show/gallery.blade.php ENDPATH**/ ?>