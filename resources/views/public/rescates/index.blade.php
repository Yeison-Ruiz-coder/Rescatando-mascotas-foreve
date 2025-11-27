@extends('portals.public.layouts.app')

@section('title', 'Rescates - Rescatando Mascotas Forever')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Nuestros Rescates</h1>
    
    <div class="row">
        @foreach($rescates as $rescate)
            <div class="col-md-4 mb-4">
                <div class="card">
                    {{-- Contenido del rescate --}}
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection