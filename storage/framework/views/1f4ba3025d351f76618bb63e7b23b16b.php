<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos para Mascotas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/pages/eventos/index.css')); ?>">

</head>
<body>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h1 class="text-primary">Eventos para Mascotas</h1>
                <p class="lead">Descubre eventos especiales para ti y tu mascota</p>
            </div>
        </div>

        <?php if($eventos->count() > 0): ?>
            <div class="row">
                <?php $__currentLoopData = $eventos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card event-card h-100">
                        <?php if($evento->imagen_url): ?>
                            <img src="<?php echo e(asset($evento->imagen_url)); ?>" 
                                 class="card-img-top" 
                                 alt="<?php echo e($evento->Nombre_evento); ?>"
                                 style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/300x200/1B8E95/FFFFFF?text=Evento+Mascotas" 
                                 class="card-img-top" 
                                 alt="Imagen por defecto"
                                 style="height: 200px; object-fit: cover;">
                        <?php endif; ?>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo e($evento->Nombre_evento); ?></h5>
                            <p class="card-text flex-grow-1"><?php echo e(Str::limit($evento->Descripcion, 100)); ?></p>
                            
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt"></i> <?php echo e($evento->Lugar_evento); ?>

                                    </small>
                                    <span class="event-date">
                                        <?php echo e(\Carbon\Carbon::parse($evento->Fecha_evento)->format('d M Y')); ?>

                                    </span>
                                </div>
                                
                                <a href="<?php echo e(route('eventos.public.show', $evento->id)); ?>" class="btn btn-primary btn-sm w-100">
                                    <i class="fas fa-eye"></i> Ver Detalles
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <h4>No hay eventos programados</h4>
                        <p>Próximamente tendremos eventos especiales para ti y tu mascota.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

</body>
</html><?php /**PATH C:\Users\Juanda\Desktop\Rescatando-mascotas-foreve\resources\views/public/eventos/index.blade.php ENDPATH**/ ?>