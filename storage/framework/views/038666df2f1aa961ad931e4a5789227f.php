
<?php if($mascota->galeria_fotos && count($mascota->galeria_fotos) > 0): ?>
    <div class="modal fade" id="galeriaModal" tabindex="-1" aria-labelledby="galeriaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-white">
                    <h5 class="modal-title" id="galeriaModalLabel">
                        Galería de <?php echo e($mascota->Nombre_mascota); ?>

                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="carouselGaleria" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php $__currentLoopData = $mascota->galeria_fotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="carousel-item <?php echo e($index === 0 ? 'active' : ''); ?>">
                                    <img src="<?php echo e(asset('storage/' . $foto['ruta'])); ?>" 
                                         class="d-block w-100 rounded"
                                         alt="<?php echo e($foto['titulo'] ?? 'Foto ' . ($index + 1)); ?>">
                                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                                        <h5><?php echo e($foto['titulo'] ?? 'Foto ' . ($index + 1)); ?></h5>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php if(count($mascota->galeria_fotos) > 1): ?>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselGaleria"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Anterior</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselGaleria"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Siguiente</span>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <small class="text-muted">
                        Foto <span id="current-photo">1</span> de <?php echo e(count($mascota->galeria_fotos)); ?>

                    </small>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/admin/mascotas/partials/show/gallery-modal.blade.php ENDPATH**/ ?>