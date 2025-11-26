@extends('portals.admin.layouts.app')

@section('title', 'Crear Nueva Solicitud')

@section('content')
<section class="admin-panel">
    
    <!-- Header -->
    @include('admin.solicitud.partials.create.header')
    
    <!-- Alertas -->
    @if (session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error">
            <i class="fa-solid fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Formulario de Creación -->
    @include('admin.solicitud.partials.create.form')

</section>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/solicitud/create.css') }}">
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validación del formulario
    const form = document.querySelector('.solicitud-form');
    const contenido = document.getElementById('contenido');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            if (contenido.value.trim().length < 10) {
                e.preventDefault();
                alert('El contenido debe tener al menos 10 caracteres.');
                contenido.focus();
            }
        });
    }

    // Auto-seleccionar fecha actual
    const fechaInput = document.getElementById('fecha_solicitud');
    if (fechaInput && !fechaInput.value) {
        const now = new Date();
        const localDateTime = now.toISOString().slice(0, 16);
        fechaInput.value = localDateTime;
    }
});
</script>
@endpush