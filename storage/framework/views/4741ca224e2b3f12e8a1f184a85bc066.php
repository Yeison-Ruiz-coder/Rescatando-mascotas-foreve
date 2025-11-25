<?php $__env->startSection('content'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h2>Historial de Donaciones</h2>
            <p class="lead">Aquí verías un listado de las donaciones realizadas.</p>
            <a href="<?php echo e(route('donaciones.create')); ?>" class="btn btn-primary btn-lg">
                Hacer una Nueva Donación
            </a>
        </div>
    </div>
    
    
    
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('portals.admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/donaciones/index.blade.php ENDPATH**/ ?>