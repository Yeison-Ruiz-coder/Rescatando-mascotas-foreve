

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/pages/adopciones/solicitudes.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- BREADCRUMB -->
            <?php echo $__env->make('public.adopciones.partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- CARD PRINCIPAL -->
            <div class="card card-solicitud animacion-entrada">
                <!-- HEADER -->
                <?php echo $__env->make('public.adopciones.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                
                <div class="card-body p-4">
                    <!-- INFORMACIÓN DE LA MASCOTA -->
                    <?php echo $__env->make('public.adopciones.partials.mascota_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    
                    <!-- SEPARADOR -->
                    <hr class="separador-seccion">

                    <!-- FORMULARIO DE SOLICITUD -->
                    <form action="<?php echo e(route('adopciones.solicitar.store')); ?>" method="POST" id="formSolicitud">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="mascota_id" value="<?php echo e($mascota->id); ?>">

                        <!-- SECCIÓN DATOS PERSONALES -->
                        <?php echo $__env->make('public.adopciones.partials.form_datos_personales', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        
                        <!-- SECCIÓN INFORMACIÓN ADICIONAL -->
                        <?php echo $__env->make('public.adopciones.partials.form_informacion_adicional', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        
                        <!-- COMPROMISOS DE ADOPCIÓN -->
                        <?php echo $__env->make('public.adopciones.partials.compromisos', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        
                        <!-- BOTONES DE ACCIÓN -->
                        <?php echo $__env->make('public.adopciones.partials.acciones', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </form>
                </div>
            </div>

            <!-- INFORMACIÓN DEL PROCESO -->
            <?php echo $__env->make('public.adopciones.partials.proceso_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formSolicitud');
    const btnEnviar = document.getElementById('btnEnviarSolicitud');
    const checkboxes = [
        'compromiso_cuidado',
        'compromiso_esterilizacion', 
        'compromiso_seguimiento'
    ];
    
    // Validación de checkboxes
    form.addEventListener('submit', function(e) {
        let todosMarcados = true;
        
        for (let checkboxId of checkboxes) {
            const checkbox = document.getElementById(checkboxId);
            if (!checkbox.checked) {
                todosMarcados = false;
                break;
            }
        }
        
        if (!todosMarcados) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Compromisos pendientes',
                text: 'Debes aceptar todos los compromisos de adopción para continuar',
                confirmButtonColor: '#1B8E95'
            });
            return;
        }
        
        // Mostrar estado de carga
        btnEnviar.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Enviando...';
        btnEnviar.classList.add('cargando');
        btnEnviar.disabled = true;
    });
    
    // Restaurar estado del formulario si hay errores
    <?php if($errors->any()): ?>
        const firstError = document.querySelector('.is-invalid');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstError.focus();
        }
    <?php endif; ?>
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('portals.public.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/public/adopciones/solicitar.blade.php ENDPATH**/ ?>