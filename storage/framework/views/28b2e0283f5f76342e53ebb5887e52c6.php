 <!-- Usa el nuevo layout del home -->

<?php $__env->startSection('title', 'Rescatando Mascotas - Inicio'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <?php echo $__env->make('home.partials.hero', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <!-- Stats Section -->
    <?php echo $__env->make('home.partials.stats', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <!-- Mascotas Section -->
    <?php echo $__env->make('home.partials.mascotas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    

    <!-- Proceso Section -->
    <?php echo $__env->make('home.partials.proceso', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Testimonios Section -->
    <?php echo $__env->make('home.partials.testimonios', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <!-- CTA Section -->
    <?php echo $__env->make('home.partials.cta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/home/index.blade.php ENDPATH**/ ?>