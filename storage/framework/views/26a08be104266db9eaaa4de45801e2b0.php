

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6">Crear nuevo evento</h1>

    <form action="<?php echo e(route('eventos.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="mb-4">
            <label class="block font-semibold">Nombre del evento:</label>
            <input type="text" name="Nombre_evento" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Lugar del evento:</label>
            <input type="text" name="Lugar_evento" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Descripción:</label>
            <textarea name="Descripcion" class="w-full border p-2 rounded" rows="4" required></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Imagen del evento (opcional):</label>
            <input type="file" name="imagen" class="w-full border p-2 rounded">
        </div>

        <button class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">
            Guardar Evento
        </button>

    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Juanda\Desktop\Rescatando-mascotas-foreve\resources\views/eventos/create.blade.php ENDPATH**/ ?>