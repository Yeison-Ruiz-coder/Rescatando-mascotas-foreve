{{-- resources/views/admin/adopciones/index.blade.php --}}
@extends('portals.admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/adopciones/index.css') }}">
@endpush

@section('content')
<div class="container fade-in py-4 mb-5">
    <div class="row">
        <div class="col-12">
            
            <!-- Header -->
            @include('admin.adopciones.partials.index.header')
            
            <!-- Filtros -->
            @include('admin.adopciones.partials.index.filters')
            
            <!-- Alertas -->
            @include('admin.adopciones.partials.index.alerts')
            
            <!-- Contador -->
            @include('admin.adopciones.partials.index.counter')
            
            <!-- Tabla o Estado Vacío -->
            @if($adopciones->count() > 0)
                @include('admin.adopciones.partials.index.table')
                @include('admin.adopciones.partials.index.pagination')
            @else
                @include('admin.adopciones.partials.index.empty_state')
            @endif

        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection