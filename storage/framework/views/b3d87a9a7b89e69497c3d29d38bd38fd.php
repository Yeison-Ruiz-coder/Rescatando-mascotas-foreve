<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container-fluid">
        <?php echo $__env->make('portals.admin.partials.navbar.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <?php echo $__env->make('portals.admin.partials.navbar.main-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('portals.admin.partials.navbar.profile-dropdown', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</nav>

<?php echo $__env->make('portals.admin.partials.navbar.secondary-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Rescatando-mascotas-foreve\resources\views/portals/admin/partials/navbar/navbar.blade.php ENDPATH**/ ?>