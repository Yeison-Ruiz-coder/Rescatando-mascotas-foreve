@extends('public.layouts.app')

@section('title', 'Solicitar Adopción - ' . $mascota->nombre_mascota)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
<link rel="stylesheet" href="{{ asset('css/pages/adopciones/solicitudes.css') }}?v={{ time() }}">
<style>
    /* Estilos de respaldo por si el CSS no carga */
    :root {
        --color-turquesa: #1B8E95;
        --color-fucsia: #D94A8B;
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- BREADCRUMB -->
            @include('public.adopciones.partials.breadcrumb')

            <!-- CARD PRINCIPAL -->
            <div class="card card-solicitud animacion-entrada">
                <!-- HEADER -->
                @include('public.adopciones.partials.header')

                <div class="card-body p-4">
                    <!-- INFORMACIÓN DE LA MASCOTA -->
                    @include('public.adopciones.partials.mascota_info')

                    <!-- SEPARADOR -->
                    <hr class="separador-seccion">

                    <!-- FORMULARIO DE SOLICITUD -->
                    <form action="{{ route('public.adopciones.solicitar.store') }}" method="POST" id="formSolicitud">
                        @csrf
                        <input type="hidden" name="mascota_id" value="{{ $mascota->id }}">

                        <!-- SECCIÓN DATOS PERSONALES -->
                        @include('public.adopciones.partials.form_datos_personales')

                        <!-- SECCIÓN INFORMACIÓN ADICIONAL -->
                        @include('public.adopciones.partials.form_informacion_adicional')

                        <!-- COMPROMISOS DE ADOPCIÓN -->
                        @include('public.adopciones.partials.compromisos')

                        <!-- BOTONES DE ACCIÓN -->
                        @include('public.adopciones.partials.acciones')
                    </form>
                </div>
            </div>

            <!-- INFORMACIÓN DEL PROCESO -->
            @include('public.adopciones.partials.proceso_info')
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formSolicitud');
    const btnEnviar = document.getElementById('btnEnviarSolicitud');
    const checkboxes = [
        'compromiso_cuidado',
        'compromiso_esterilizacion',
        'compromiso_seguimiento'
    ];

    if (form) {
        form.addEventListener('submit', function(e) {
            let todosMarcados = true;
            let errores = [];

            // Validar checkboxes
            for (let checkboxId of checkboxes) {
                const checkbox = document.getElementById(checkboxId);
                if (!checkbox || !checkbox.checked) {
                    todosMarcados = false;
                    break;
                }
            }

            if (!todosMarcados) {
                e.preventDefault();
                errores.push('Debes aceptar todos los compromisos de adopción');
            }

            // Validar motivo
            const motivo = document.getElementById('motivo_adopcion');
            if (motivo && motivo.value.trim().length < 20) {
                e.preventDefault();
                errores.push('El motivo debe tener al menos 20 caracteres');
                motivo.focus();
            }

            // Validar campos requeridos
            const requiredFields = form.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    e.preventDefault();
                    const label = field.previousElementSibling?.innerText || 'Campo';
                    errores.push(`El campo ${label} es requerido`);
                }
            });

            // Mostrar errores con SweetAlert
            if (errores.length > 0) {
                e.preventDefault();
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Verifica los siguientes puntos:',
                        html: '<ul style="text-align: left;">' +
                              errores.map(err => `<li>${err}</li>`).join('') +
                              '</ul>',
                        confirmButtonColor: '#1B8E95',
                        confirmButtonText: 'Entendido'
                    });
                } else {
                    alert('Por favor, completa todos los campos requeridos:\n\n' + errores.join('\n'));
                }
                return;
            }

            // Cambiar estado del botón al enviar
            if (btnEnviar && errores.length === 0) {
                btnEnviar.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Enviando solicitud...';
                btnEnviar.classList.add('cargando');
                btnEnviar.disabled = true;
            }
        });
    }

    // Debug: Verificar si el CSS está cargando
    console.log('CSS loaded:', document.styleSheets.length);
});
</script>
@endpush
