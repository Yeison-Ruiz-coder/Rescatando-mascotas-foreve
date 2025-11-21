@extends('portals.public.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/mascotas/public-index.css') }}?v=2.0">
@endpush

@section('content')
<div class="container py-4">
    <!-- Hero Section -->
    @include('public.mascotas.partials.index.hero')
    
    <!-- Filtros -->
    @include('public.mascotas.partials.index.filters')
    
    <!-- Contador -->
    @include('public.mascotas.partials.index.counter')
    
    <!-- Grid de Mascotas -->
    @include('public.mascotas.partials.index.mascotas-grid')
    
    <!-- Paginación -->
    @include('public.mascotas.partials.index.pagination')
</div>
@endsection