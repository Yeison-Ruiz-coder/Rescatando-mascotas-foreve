@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/adopciones/edit.css') }}">
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Editar Adopción #{{ $adopcion->id }}
                    </h3>
                </div>
                <div class="card-body">
                    @include('admin.adopciones.partials.edit.form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
