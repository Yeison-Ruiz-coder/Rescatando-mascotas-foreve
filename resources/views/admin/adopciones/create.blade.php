{{-- resources/views/admin/adopciones/create.blade.php --}}
@extends('portals.admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/adopciones/create.css') }}">
@endpush

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <!-- Header -->
            @include('admin.adopciones.partials.create.header')
            
            <!-- Alertas -->
            @if ($errors->any())
                <div class="alertas-error mb-4 animacion-entrada">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-exclamation-triangle me-2 text-danger"></i>
                        <h5 class="mb-0 text-danger">Por favor corrige los siguientes errores:</h5>
                    </div>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulario -->
            @include('admin.adopciones.partials.create.form')

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
@endsection
