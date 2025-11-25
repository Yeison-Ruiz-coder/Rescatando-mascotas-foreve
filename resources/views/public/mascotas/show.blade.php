@extends('portals.public.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/mascotas/public-show.css') }}">
@endpush

@section('content')
<div class="container py-4 fade-in">
    
    <!-- Breadcrumb -->
    @include('public.mascotas.partials.show.breadcrumb')
    
    <div class="row">
        <!-- Columna izquierda - Imágenes -->
        <div class="col-lg-6 mb-4">
            <!-- Galería de imágenes -->
            @include('public.mascotas.partials.show.gallery')
            
            <!-- Botón de adopción -->
            @include('public.mascotas.partials.show.action-buttons', ['position' => 'sidebar'])
        </div>
        
        <!-- Columna derecha - Información -->
        <div class="col-lg-6">
            <div class="card card-mascota">
                <div class="card-header card-header-turquesa">
                    <h3 class="mb-0 fw-bold">{{ $mascota->Nombre_mascota }}</h3>
                </div>
                <div class="card-body p-4">
                    <!-- Información básica -->
                    @include('public.mascotas.partials.show.basic-info')
                    
                    <!-- Descripción -->
                    @include('public.mascotas.partials.show.description')
                    
                    <!-- Información de salud -->
                    @include('public.mascotas.partials.show.health-info')
                    
                    <!-- Información de la fundación -->
                    @include('public.mascotas.partials.show.foundation-info')
                    
                    <!-- Botones de acción -->
                    @include('public.mascotas.partials.show.action-buttons', ['position' => 'main'])
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Botón flotante para móvil -->
@include('public.mascotas.partials.show.floating-button')

<!-- Modal de adopción -->
@include('public.mascotas.partials.show.adoption-modal')

@push('scripts')
<script src="{{ asset('js/pages/mascotas/public-show.js') }}"></script>
@endpush

@endsection