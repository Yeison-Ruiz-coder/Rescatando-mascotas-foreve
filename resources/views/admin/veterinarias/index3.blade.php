@extends('portals.admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/veterinarias/index.css') }}">
@endpush

@section('content')
<div class="container-fluid px-3 px-lg-5 py-4">
    <!-- Header -->
    @include('admin.veterinarias.partials.index.header')
    
    <!-- Acciones Principales -->
    @include('admin.veterinarias.partials.index.actions')
    
    <!-- Panel de Filtros -->
    @include('components.modules.veterinarias.filters')
    
    <!-- Estadísticas Rápidas -->
    @if(!request()->anyFilled(['tipo', 'lugar', 'servcios']))
        @include('admin.veterinarias.partials.index.stats')
    @endif

    <!-- Grid de veterinarias -->
    <div class="row">
        @forelse($veterinarias as $veterinaria)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                @include('components.modules.veterinarias.card', ['veterinaria' => $veterinaria])
            </div>
        @empty
            @include('admin.veterinarias.partials.index.empty-state')
        @endforelse
    </div>

    <!-- Paginación -->
    @if($veterinarias->hasPages())
        @include('admin.veterinarias.partials.index.pagination')
    @endif
</div>
@endsection