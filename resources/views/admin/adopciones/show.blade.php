@extends('admin.layouts.app')


@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/adopciones/show.css') }}">
@endpush

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- CARD PRINCIPAL -->
            <div class="card card-detalle-adopcion animate-slide-in">

                <!-- Header -->
                @include('admin.adopciones.partials.show.header')

                <div class="card-body p-4">

                    <!-- Alertas -->
                    @include('admin.adopciones.partials.show.alerts')

                    <div class="row">
                        <!-- Información de la Mascota -->
                        <div class="col-md-6 mb-4">
                            @include('admin.adopciones.partials.show.mascota_info')
                        </div>

                        <!-- Información del Adoptante -->
                        <div class="col-md-6 mb-4">
                            @include('admin.adopciones.partials.show.adoptante_info')
                        </div>
                    </div>

                    <!-- Separador -->
                    <hr class="separador-seccion">

                    <!-- Información de la Adopción -->
                    @include('admin.adopciones.partials.show.adopcion_info')

                    <!-- Botones de Acción -->
                    @include('admin.adopciones.partials.show.actions')

                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
