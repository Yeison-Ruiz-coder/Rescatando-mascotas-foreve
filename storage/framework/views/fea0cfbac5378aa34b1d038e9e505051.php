
<header class="public-header">
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo e(route('inicio')); ?>">
                <img src="<?php echo e(asset('img/logo-oscuro.png')); ?>" alt="Rescatando Mascotas Forever Logo" class="navbar-logo">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            
            <?php echo $__env->make('partials.public.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </nav>
</header><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/partials/public/header.blade.php ENDPATH**/ ?>