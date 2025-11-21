

<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    <div class="row">
        <?php $__currentLoopData = $eventos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm" style="height: 100%;">

                <?php if($evento->imagen): ?>
                <img src="<?php echo e(asset('storage/'.$evento->imagen)); ?>" 
                     class="card-img-top" 
                     alt="Imagen del evento"
                     style="height:180px; object-fit:cover;">
                <?php else: ?>
                <img src="https://via.placeholder.com/300x180?text=Sin+Imagen" 
                     class="card-img-top"
                     style="height:180px; object-fit:cover;">
                <?php endif; ?>

                <div class="card-body">
                    <h5 class="card-title"><?php echo e($evento->titulo); ?></h5>
                    <p class="card-text text-muted">
                        <?php echo e(Str::limit($evento->descripcion, 80)); ?>

                    </p>

                    <a href="<?php echo e(route('eventos.show', $evento->id)); ?>" class="btn btn-primary btn-sm w-100">
                        Ver evento
                    </a>
                </div>

            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Juanda\Desktop\Rescatando-mascotas-foreve\resources\views/eventos/index.blade.php ENDPATH**/ ?>