@extends('admin.layouts.app')

@section('title', 'Detalles de Solicitud #' . $solicitud->id)

@section('content')
<section class="admin-panel">

    <!-- Header -->
    @include('admin.solicitud.partials.show.header')

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

    <!-- Detalles de la Solicitud -->
    @include('admin.solicitud.partials.show.details')

    <!-- Acciones -->
    @include('admin.solicitud.partials.show.actions')

</section>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/solicitud/show.css') }}">
@endpush
