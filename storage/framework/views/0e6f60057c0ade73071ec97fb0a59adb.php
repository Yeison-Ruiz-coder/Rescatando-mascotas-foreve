<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/pages/mascotas/index.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 px-lg-5 py-4">

    <!-- Header Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="mascotas-header">
                <h1 class="display-5 fw-bold text-center">
                    <i class="fas fa-paw me-3"></i>Gestión de Mascotas
                </h1>
                <p class="lead text-center text-muted">Administra y busca todas las mascotas del sistema</p>
            </div>
        </div>
    </div>

    <!-- Acciones Principales -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <a href="<?php echo e(route('mascotas.create')); ?>" class="btn btn-success btn-lg">
                    <i class="fas fa-plus-circle me-2"></i>Nueva Mascota
                </a>
                
                <div class="d-flex gap-2 flex-wrap">
                    <span class="badge bg-turquesa fs-6 p-2">
                        <i class="fas fa-paw me-1"></i>
                        Total: <?php echo e($mascotas->total()); ?> mascotas
                    </span>
                    <?php if(request()->anyFilled(['especie', 'estado', 'raza'])): ?>
                    <a href="<?php echo e(route('mascotas.index')); ?>" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-times me-1"></i>Limpiar Filtros
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Panel de Filtros -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-turquesa text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-filter me-2"></i>Filtros de Búsqueda
                    </h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('mascotas.index')); ?>" method="GET" class="row g-3 align-items-end">
                        <!-- Filtro por Especie -->
                        <div class="col-md-3">
                            <label for="especie" class="form-label fw-semibold">
                                <i class="fas fa-dog me-1"></i>Especie
                            </label>
                            <select name="especie" id="especie" class="form-select">
                                <option value="">Todas las especies</option>
                                <?php $__currentLoopData = $especies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $especie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($especie); ?>"
                                        <?php echo e(request('especie') == $especie ? 'selected' : ''); ?>>
                                        <?php echo e($especie); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Filtro por Estado -->
                        <div class="col-md-3">
                            <label for="estado" class="form-label fw-semibold">
                                <i class="fas fa-chart-bar me-1"></i>Estado
                            </label>
                            <select name="estado" id="estado" class="form-select">
                                <option value="">Todos los estados</option>
                                <?php $__currentLoopData = $estados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($estado); ?>"
                                        <?php echo e(request('estado') == $estado ? 'selected' : ''); ?>>
                                        <?php echo e($estado); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Filtro por Raza -->
                        <div class="col-md-3">
                            <label for="raza" class="form-label fw-semibold">
                                <i class="fas fa-tag me-1"></i>Raza
                            </label>
                            <input type="text" name="raza" id="raza" class="form-control"
                                placeholder="Ej: Labrador, Siames, Persa..."
                                value="<?php echo e(request('raza')); ?>">
                        </div>

                        <!-- Botones de Acción -->
                        <div class="col-md-3">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search me-2"></i>Buscar Mascotas
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas Rápidas -->
    <?php if(!request()->anyFilled(['especie', 'estado', 'raza'])): ?>
    <div class="row mb-4">
        <div class="col-12">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="stat-card bg-success text-white">
                        <div class="stat-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div class="stat-info">
                            <h4><?php echo e($mascotas->where('estado', 'En adopcion')->count()); ?></h4>
                            <p>En Adopción</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card bg-info text-white">
                        <div class="stat-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="stat-info">
                            <h4><?php echo e($mascotas->where('estado', 'Adoptado')->count()); ?></h4>
                            <p>Adoptados</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card bg-warning text-dark">
                        <div class="stat-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="stat-info">
                            <h4><?php echo e($mascotas->where('estado', 'Rescatada')->count()); ?></h4>
                            <p>Rescatadas</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card bg-secondary text-white">
                        <div class="stat-icon">
                            <i class="fas fa-paw"></i>
                        </div>
                        <div class="stat-info">
                            <h4><?php echo e($mascotas->count()); ?></h4>
                            <p>Total Mostrado</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Grid de Mascotas -->
    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $mascotas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mascota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
            <div class="card mascota-card shadow-sm h-100">
                <!-- Imagen con Badge de Estado -->
                <div class="mascota-img-container position-relative overflow-hidden">
                    <img src="<?php echo e($mascota->Foto ? Storage::url($mascota->Foto) : asset('img/mascota-placeholder.jpg')); ?>"
                         class="mascota-card-img"
                         alt="<?php echo e($mascota->Nombre_mascota); ?>"
                         onerror="this.onerror=null; this.src='<?php echo e(asset('img/mascota-placeholder.jpg')); ?>'">
                    
                    <div class="mascota-badge 
                        <?php if($mascota->estado == 'En adopcion'): ?> badge-adopcion
                        <?php elseif($mascota->estado == 'Adoptado'): ?> badge-adoptado
                        <?php else: ?> badge-rescatada <?php endif; ?>">
                        <i class="fas 
                            <?php if($mascota->estado == 'En adopcion'): ?> fa-heart
                            <?php elseif($mascota->estado == 'Adoptado'): ?> fa-home
                            <?php else: ?> fa-shield-alt <?php endif; ?> me-1">
                        </i>
                        <?php echo e($mascota->estado); ?>

                    </div>
                </div>

                <!-- Contenido de la Card -->
                <div class="card-body d-flex flex-column">
                    <!-- Nombre y Especie -->
                    <div class="mb-3">
                        <h5 class="mascota-nombre"><?php echo e($mascota->Nombre_mascota); ?></h5>
                        <div class="mascota-especie">
                            <i class="fas fa-paw me-1"></i>
                            <?php echo e($mascota->Especie); ?>

                            <?php if($mascota->Raza): ?>
                            <span class="text-muted">• <?php echo e($mascota->Raza); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Información Detallada -->
                    <div class="mascota-info mb-3">
                        <div class="info-item">
                            <i class="fas fa-birthday-cake text-fucsia"></i>
                            <span><?php echo e($mascota->Edad_aprox); ?> años</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-venus-mars text-fucsia"></i>
                            <span><?php echo e($mascota->Genero); ?></span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt text-fucsia"></i>
                            <span><?php echo e(Str::limit($mascota->Lugar_rescate, 20)); ?></span>
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="mascota-descripcion mb-3 flex-grow-1">
                        <p class="text-muted small">
                            <?php echo e(Str::limit($mascota->Descripcion, 120)); ?>

                        </p>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="mascota-actions mt-auto">
                        <div class="d-grid gap-2">
                            <a href="<?php echo e(route('mascotas.show', $mascota)); ?>" 
                               class="btn btn-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>Ver Detalles
                            </a>
                            <a href="<?php echo e(route('mascotas.edit', $mascota)); ?>" 
                               class="btn btn-outline-warning btn-sm">
                                <i class="fas fa-edit me-1"></i>Editar
                            </a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <!-- Estado Vacío -->
        <div class="col-12">
            <div class="empty-state text-center py-5">
                <div class="empty-icon mb-4">
                    <i class="fas fa-paw fa-4x text-muted"></i>
                </div>
                <h3 class="text-muted mb-3">No se encontraron mascotas</h3>
                <p class="text-muted mb-4">Intenta ajustar los filtros de búsqueda o crear una nueva mascota.</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="<?php echo e(route('mascotas.index')); ?>" class="btn btn-primary">
                        <i class="fas fa-redo me-2"></i>Ver todas las mascotas
                    </a>
                    <a href="<?php echo e(route('mascotas.create')); ?>" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>Crear Nueva Mascota
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Paginación -->
    <?php if($mascotas->hasPages()): ?>
    <div class="row mt-5">
        <div class="col-12">
            <div class="mascotas-pagination">
                <?php echo e($mascotas->links()); ?>

            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/mascotas/index.blade.php ENDPATH**/ ?>