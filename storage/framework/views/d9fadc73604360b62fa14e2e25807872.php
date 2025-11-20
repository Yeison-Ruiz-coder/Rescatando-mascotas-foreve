<?php $__env->startSection('content'); ?>
    <div class="container py-5">

        
        <div class="d-flex gap-2 mb-4">
            
            <a href="<?php echo e(route('mascotas.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Volver al Listado
            </a>
        </div>

        <div class="row">
            
            <div class="col-lg-5 mb-4">
                
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
                                Haz clic en la foto para ver la galería completa (<?php echo e(count($mascota->galeria_fotos)); ?>

                                fotos)
                            </small>
                        <?php endif; ?>
                    </div>
                </div>

                
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
                <?php endif; ?>

                
                <div class="card shadow gestion-card">
                    <div class="card-header fw-bold">
                        <i class="fas fa-cog me-2"></i>Información de Gestión
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>ID de Mascota:</strong>
                            <span class="badge bg-secondary"><?php echo e($mascota->id); ?></span>
                        </div>
                        <div class="mb-3">
                            <strong>Fecha de Creación:</strong>
                            <br><?php echo e($mascota->created_at->format('d/m/Y H:i')); ?>

                        </div>
                        <div class="mb-3">
                            <strong>Última Actualización:</strong>
                            <br><?php echo e($mascota->updated_at->format('d/m/Y H:i')); ?>

                        </div>
                        <?php if($mascota->Fecha_salida): ?>
                            <div class="mb-3">
                                <strong>Fecha de Salida:</strong>
                                <br><?php echo e(\Carbon\Carbon::parse($mascota->Fecha_salida)->format('d/m/Y')); ?>

                            </div>
                        <?php endif; ?>

                        <div class="d-flex gap-2 mb-4">
                            <a href="<?php echo e(route('mascotas.edit', $mascota)); ?>" class="btn btn-warning">
                                <i class="fas fa-edit me-2"></i>Editar Mascota
                            </a>

                            
                            <form action="<?php echo e(route('mascotas.destroy', $mascota)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar a <?php echo e($mascota->Nombre_mascota); ?>? Esta acción no se puede deshacer.')">
                                    <i class="fas fa-trash me-2"></i>Eliminar Mascota
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            
            <div class="col-lg-7">

                
                <div class="mb-4">
                    <h2 class="fw-bold">
                        <i class="fas fa-heart me-2"></i>Sobre Mí
                    </h2>
                    <p class="fs-5 descripcion-texto"><?php echo e($mascota->Descripcion); ?></p>
                </div>

                
                <div class="card shadow mb-4">
                    <div class="card-header fw-bold">
                        <i class="fas fa-info-circle me-2"></i>Ficha Técnica
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Especie:</strong>
                            <span class="badge"><?php echo e($mascota->Especie); ?></span>
                        </li>
                        <li class="list-group-item">
                            <strong>Género:</strong>
                            <span class="badge"><?php echo e($mascota->Genero); ?></span>
                        </li>
                        <li class="list-group-item">
                            <strong>Lugar de Rescate:</strong> <?php echo e($mascota->Lugar_rescate); ?>

                        </li>
                        <li class="list-group-item">
                            <strong>Fecha de Ingreso:</strong>
                            <?php echo e(\Carbon\Carbon::parse($mascota->Fecha_ingreso)->format('d/m/Y')); ?>

                        </li>
                        <li class="list-group-item">
                            <strong>Responsable (Fundación):</strong>
                            <?php echo e($mascota->fundacion ? $mascota->fundacion->Nombre_1 : 'No asignada'); ?>

                        </li>
                    </ul>
                </div>

                
                <div class="card shadow mb-4">
                    <div class="card-header fw-bold">
                        <i class="fas fa-paw me-2"></i>Raza / Cruce
                    </div>
                    <div class="card-body">
                        <?php $__empty_1 = true; $__currentLoopData = $mascota->razas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $raza): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <span class="badge raza-badge fs-6 me-2 mb-2"><?php echo e($raza->nombre_raza); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-muted">No hay información de raza registrada.</p>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div class="card shadow">
                    <div class="card-header fw-bold">
                        <i class="fas fa-syringe me-2"></i>Historial de Vacunación
                    </div>
                    <div class="card-body">
                        <?php if($mascota->vacunas && $mascota->vacunas !== 'No especificado'): ?>
                            <p class="fs-5 text-success">
                                <i class="fas fa-check-circle me-2"></i>
                                <?php echo e($mascota->vacunas); ?>

                            </p>
                        <?php else: ?>
                            <p class="text-muted">
                                <i class="fas fa-info-circle me-2"></i>
                                Aún no se ha registrado el historial de vacunas detallado.
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
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
                                        <img src="<?php echo e(Storage::url($foto['ruta'])); ?>" class="d-block w-100 rounded"
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
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/pages/mascotas/show.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        function cambiarFotoPrincipal(rutaImagen, index) {
            // Cambiar la foto principal
            document.getElementById('foto-principal').src = rutaImagen;

            // Actualizar miniaturas activas
            document.querySelectorAll('.gallery-thumbnail').forEach(thumb => {
                thumb.classList.remove('active');
            });
            document.querySelectorAll('.gallery-thumbnail')[index].classList.add('active');
        }

        // Actualizar contador en el modal
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('carouselGaleria');
            if (carousel) {
                carousel.addEventListener('slid.bs.carousel', function(e) {
                    const activeIndex = e.to;
                    document.getElementById('current-photo').textContent = activeIndex + 1;
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/mascotas/show.blade.php ENDPATH**/ ?>