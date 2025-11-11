@extends('layouts.app') 

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h2>Historial de Donaciones</h2>
            <p class="lead">Aquí verías un listado de las donaciones realizadas.</p>
            <a href="{{ route('donaciones.create') }}" class="btn btn-primary btn-lg">
                Hacer una Nueva Donación
            </a>
        </div>
    </div>
    
    {{-- Aquí iría la tabla con el historial de donaciones si existiera una --}}
    {{-- @include('donaciones.partials.table') --}}
</div>

@endsection