@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/mascotas/create.css') }}">
@endpush

@section('content')
<div class="container-fluid px-3 px-lg-5 py-4">

    <!-- Alertas -->
    @include('partials.alerts.error')
    @include('partials.alerts.success')


    <!-- Header Section -->
    @include('admin.mascotas.partials.create.header')

    <!-- Formulario -->
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="card form-mascota-card shadow-lg border-0">
                <div class="card-header form-mascota-header">
                    <h3 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Formulario de Registro
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.mascotas.store') }}" method="POST" enctype="multipart/form-data" id="mascotaForm">
                        @csrf

                        <!-- Sección 1: Información Básica -->
                        @include('admin.mascotas.partials.create.form-basic-info')

                        <!-- Sección 2: Ubicación y Descripción -->
                        @include('admin.mascotas.partials.create.form-location-description')

                        <!-- Sección 3: Salud y Vacunas -->
                        @include('admin.mascotas.partials.create.form-health')

                        <!-- Sección 4: Galería de Fotos -->
                        @include('admin.mascotas.partials.create.form-gallery')

                        <!-- Sección 5: Fechas y Fundación -->
                        @include('admin.mascotas.partials.create.form-dates-foundation')

                        <!-- Botones de acción -->
                        @include('admin.mascotas.partials.create.form-actions')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/pages/mascotas/create.js') }}"></script>
@endsection
