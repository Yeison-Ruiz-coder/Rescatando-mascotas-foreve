@extends('portals.admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/mascotas/index.css') }}">
@endpush

@section('content')
<div class="container-fluid px-3 px-lg-5 py-4">
    <!-- Header -->
    @include('admin.mascotas.partials.index.header')
    
    <!-- Acciones Principales -->
    @include('admin.mascotas.partials.index.actions')
    
    <!-- Panel de Filtros -->
    @include('components.modules.mascotas.filters')
    
    <!-- Estadísticas Rápidas -->
    @if(!request()->anyFilled(['especie', 'estado', 'raza']))
        @include('admin.mascotas.partials.index.stats')
    @endif

    <!-- Grid de Mascotas -->
    <div class="row">
        @forelse($mascotas as $mascota)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                @include('components.modules.mascotas.card', ['mascota' => $mascota])
            </div>
        @empty
            @include('admin.mascotas.partials.index.empty-state')
        @endforelse
    </div>

    <!-- Paginación -->
    @if($mascotas->hasPages())
        @include('admin.mascotas.partials.index.pagination')
    @endif
</div>
@endsection