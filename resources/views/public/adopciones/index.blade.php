@extends('public.layouts.app')
@section('title', 'Adopciones')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
<link rel="stylesheet" href="{{ asset('css/pages/adopciones/public-index.css') }}">
@endpush

@section('content')
<div class="container py-5">
    <h1 class="text-center">Listado de mascotas en adopción</h1>

    @if(isset($mascotas) && $mascotas->count() > 0)
        <div class="row mt-4">
            @foreach($mascotas as $mascota)
                <div class="col-md-4 mb-4">
                    @include('public.adopciones.partials.mascota-card', ['mascota' => $mascota])
                </div>
            @endforeach
        </div>
    @else
        <div class="sin-mascotas-container">
            <i class="fas fa-paw"></i>
            <h3>No hay mascotas en adopción</h3>
            <p>Pronto tendremos nuevos amigos buscando hogar</p>
            <a href="{{ route('public.mascotas.index') }}" class="btn-volver-mascotas">
                <i class="fas fa-arrow-left"></i>
                Ver todas las mascotas
            </a>
        </div>
    @endif
</div>
@endsection

@section('content')
<style>
    /* TUS ESTILOS DIRECTOS AQUÍ - COPIA TODO EL CSS QUE TE DI */
    :root {
        --color-turquesa: #764ba2;
        --color-fucsia: #667eea;
        /* ... resto de variables ... */
    }

    .card-mascota-moderna {
        background: rgba(255,255,255,0.05);
        border-radius: 20px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .badge-moderno {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 15px;
        background: var(--color-turquesa);
        color: white;
        margin-right: 5px;
    }
    /* ... más estilos ... */
</style>

<!-- resto de tu contenido -->
@endsection
