@extends('portals.admin.layouts.app')

@section('title', 'Gestión de Solicitudes - Admin')


@section('content')
<section class="admin-panel">
    
    <!-- Header -->
    @include('admin.solicitud.partials.index.header')
    
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

    <!-- Acciones -->
    @include('admin.solicitud.partials.index.actions')
    
    <!-- Tabla -->
    @include('admin.solicitud.partials.index.table')
    
    <!-- Paginación -->
    @include('admin.solicitud.partials.index.pagination')

</section>

@push('scripts')
<script src="{{ asset('js/pages/solicitud/index.js') }}"></script>
@endpush
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/solicitud/index.css') }}">
@endpush