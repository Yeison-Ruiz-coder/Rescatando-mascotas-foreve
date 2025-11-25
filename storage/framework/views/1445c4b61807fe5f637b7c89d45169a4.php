<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Panel Admin - Rescatando Mascotas Forever'); ?></title>
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/components/navbar.css')); ?>"> 
    <link rel="stylesheet" href="<?php echo e(asset('css/components/footer.css')); ?>"> 
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="admin-layout">
    
    
    <div class="admin-container">
        
        
        <div class="admin-main-container">
            
            
            <div class="admin-navbar-container">
                
                <?php echo $__env->make('portals.public.partials.navbar.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            
            <main class="admin-content-container">
                <?php echo $__env->yieldContent('content'); ?>
            </main>

            
            <?php echo $__env->make('portals.public.partials.footer.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\Dan\Desktop\Rescatando-mascotas-foreve\resources\views/portals/public/layouts/app.blade.php ENDPATH**/ ?>