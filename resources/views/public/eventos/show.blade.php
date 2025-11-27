@extends('portals.public.layouts.app')

@section('title', '{{ $evento->titulo }} - Rescatando Mascotas Forever')

@section('content')
<div class="container py-5">
    <h1>{{ $evento->titulo }}</h1>
    <div class="row">
        <div class="col-md-8">
            {{-- Detalles del evento --}}
        </div>
    </div>
</div>
@endsection