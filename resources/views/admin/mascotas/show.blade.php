@extends('portals.admin.layouts.app')


@section('content')
<div class="container py-5">
    <!-- Botones de acción -->
    @include('admin.mascotas.partials.show.actions')
    
    <div class="row">
        <!-- Columna izquierda: Galería de fotos -->
        <div class="col-lg-5 mb-4">
            @include('admin.mascotas.partials.show.gallery')
            @include('admin.mascotas.partials.show.management-info')
        </div>

        <!-- Columna derecha: Información detallada -->
        <div class="col-lg-7">
            @include('admin.mascotas.partials.show.description')
            @include('admin.mascotas.partials.show.technical-details')
            @include('admin.mascotas.partials.show.breeds')
            @include('admin.mascotas.partials.show.vaccines')
        </div>
    </div>
</div>

<!-- Modal para galería completa -->
@include('admin.mascotas.partials.show.gallery-modal')
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/mascotas/show.css') }}">
@endpush

@section('scripts')
<script src="{{ asset('js/pages/mascotas/show.js') }}"></script>
@endsection