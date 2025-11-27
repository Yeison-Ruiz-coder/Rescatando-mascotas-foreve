@extends('portals.public.layouts.app')

@section('title', 'Rescate #{{ $rescate->id }} - Rescatando Mascotas Forever')

@section('content')
<div class="container py-5">
    <h1>Rescate #{{ $rescate->id }}</h1>
    <div class="row">
        <div class="col-md-8">
            {{-- Detalles del rescate --}}
        </div>
    </div>
</div>
@endsection