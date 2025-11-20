
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<script src="<?php echo e(asset('js/app.js')); ?>"></script>


<?php if(request()->is('mascotas/*')): ?>
    <script src="<?php echo e(asset('js/mascotas-public.js')); ?>"></script>
<?php endif; ?>


<script src="<?php echo e(asset('js/animations.js')); ?>"></script><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/partials/public/scripts.blade.php ENDPATH**/ ?>