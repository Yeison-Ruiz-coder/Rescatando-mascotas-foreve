@extends('portals.public.layouts.app')

@section('title', 'Suscripción - Rescatando Mascotas Forever')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Suscribirse</h1>
            
            <form action="{{ route('suscripciones.store') }}" method="POST">
                @csrf
                {{-- Campos del formulario --}}
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Suscribirse</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection