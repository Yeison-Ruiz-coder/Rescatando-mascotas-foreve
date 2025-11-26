@extends('portals.public.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/adopciones/solicitudes.css') }}">
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
                    <form action="{{ route('adopciones.solicitar.store', $mascota->id) }}" method="POST" id="formSolicitud">
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

@section('scripts')
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
    @if($errors->any())
        const firstError = document.querySelector('.is-invalid');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstError.focus();
        }
    @endif
});
</script>
@endsection