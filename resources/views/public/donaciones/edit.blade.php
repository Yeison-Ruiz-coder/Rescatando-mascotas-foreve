@extends('layouts.app') 

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <h2 class="mb-4">Gestionar Donación Mensual</h2>
            <p class="lead">Modifica la información de tu donación periódica (ID: {{ $donation->id ?? 'N/A' }})</p>
            
            {{-- INCLUYE EL FORMULARIO REAL --}}
            {{-- Se asume que la variable $donation está definida por el controlador --}}
            @include('donaciones.partials.form')
        </div>
    </div>
</div>
@endsection