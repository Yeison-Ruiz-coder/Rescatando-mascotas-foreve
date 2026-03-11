@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/adopciones/create.css') }}">
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Crear Nueva Adopción
                    </h3>
                </div>
                <div class="card-body">
                    @include('admin.adopciones.partials.create.form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
