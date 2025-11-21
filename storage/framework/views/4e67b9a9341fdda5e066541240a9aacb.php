<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php echo $__env->yieldContent('title'); ?>
    </title>
</head>
<body>

   
    <h1>Desde esta plantilla realizo cambios a las otras vistas</h1>
    <?php echo $__env->make('layouts1._partials.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
</body>
</html><?php /**PATH C:\Users\Juanda\Desktop\Rescatando-mascotas-foreve\resources\views/layouts1/landing.blade.php ENDPATH**/ ?>