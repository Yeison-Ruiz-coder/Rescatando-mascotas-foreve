<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container-fluid">
        <?php echo $__env->make('portals.public.partials.navbar.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <?php echo $__env->make('portals.public.partials.navbar.main-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('portals.public.partials.navbar.profile-dropdown', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</nav>

<?php echo $__env->make('portals.public.partials.navbar.secondary-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Dan\Desktop\Rescatando-mascotas-foreve\resources\views/portals/public/partials/navbar/navbar.blade.php ENDPATH**/ ?>