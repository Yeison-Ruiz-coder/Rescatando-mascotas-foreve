@extends('portals.admin.layouts.app')

@section('title', 'Editar Solicitud #' . $solicitud->id)

@section('content')
<section class="admin-panel">
    
    <!-- Header -->
    @include('admin.solicitud.partials.edit.header')
    
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

    <!-- Formulario de Edición -->
    @include('admin.solicitud.partials.edit.form')

</section>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/solicitud/edit.css') }}">
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
});
</script>
@endpush