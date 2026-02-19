@extends('admin.layouts.app')



@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/adopciones/edit.css') }}">
@endpush

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <!-- Header -->
            @include('admin.adopciones.partials.edit.header')

            <!-- Alertas -->
            @if (session('success'))
                @include('cards.registro-exitoso')
            @endif

            @if (session('error'))
                @include('cards.error-registro')
            @endif

            <!-- Formulario -->
            @include('admin.adopciones.partials.edit.form')

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const estadoSelect = document.getElementById('estado');
    const razonContainer = document.getElementById('razon_rechazo_container');

    function toggleRazonRechazo() {
        if (estadoSelect.value === 'Rechazado') {
            razonContainer.style.display = 'block';
        } else {
            razonContainer.style.display = 'none';
        }
    }

    // Ejecutar al cargar la página
    toggleRazonRechazo();

    // Ejecutar cuando cambie el estado
    estadoSelect.addEventListener('change', toggleRazonRechazo);
});
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
