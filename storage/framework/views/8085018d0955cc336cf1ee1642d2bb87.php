<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/pages/adopciones/create.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <!-- Header -->
            <?php echo $__env->make('admin.adopciones.partials.create.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- Alertas -->
            <?php if($errors->any()): ?>
                <div class="alertas-error mb-4 animacion-entrada">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-exclamation-triangle me-2 text-danger"></i>
                        <h5 class="mb-0 text-danger">Por favor corrige los siguientes errores:</h5>
                    </div>
                    <ul class="mb-0 ps-3">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Formulario -->
            <?php echo $__env->make('admin.adopciones.partials.create.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const estadoSelect = document.getElementById('estado');
    const razonContainer = document.getElementById('razon_rechazo_container');
    const razonTextarea = document.getElementById('razon_rechazo');
    const form = document.getElementById('formAdopcion');
    const btnSubmit = document.getElementById('btnSubmit');

    function toggleRazonRechazo() {
        if (estadoSelect.value === 'Rechazado') {
            razonContainer.classList.add('mostrar');
            razonTextarea.required = true;
        } else {
            razonContainer.classList.remove('mostrar');
            razonTextarea.required = false;
        }
    }

    // Ejecutar al cargar la página
    toggleRazonRechazo();

    // Ejecutar cuando cambie el estado
    estadoSelect.addEventListener('change', toggleRazonRechazo);

    // Validación antes de enviar el formulario
    form.addEventListener('submit', function(e) {
        if (estadoSelect.value === 'Rechazado' && !razonTextarea.value.trim()) {
            e.preventDefault();
            alert('Por favor, proporciona una razón de rechazo cuando el estado es "Rechazado"');
            razonTextarea.focus();
            return;
        }

        // Mostrar estado de carga
        btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Registrando...';
        btnSubmit.disabled = true;
    });
});
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Rescatando-mascotas-foreve\resources\views/admin/adopciones/create.blade.php ENDPATH**/ ?>