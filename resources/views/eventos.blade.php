@extends('layouts.app')

@section('title', 'Eventos')

@section('content')
<style>
    .eventos-fondo {
        background: url('https://img.freepik.com/foto-gratis/fondo-azul-acuarela-pintado-mano_23-2148965120.jpg') no-repeat center center;
        background-size: cover;
        border-radius: 15px;
        padding: 40px 20px;
    }

    .eventos-titulo {
        font-weight: 700;
        color: #333;
        text-align: center;
        margin-bottom: 30px;
    }

    .buscador-eventos {
        width: 60%;
        margin: 0 auto 40px auto;
    }

    .card-evento {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .card-evento:hover {
        transform: translateY(-5px);
    }

    .card-evento img {
        height: 180px;
        object-fit: cover;
    }

    .btn-volver {
        background-color: #1ca58f;
        color: white;
        border-radius: 30px;
        padding: 10px 25px;
        font-weight: 500;
        border: none;
        transition: 0.3s;
    }

    .btn-volver:hover {
        background-color: #14826f;
    }
</style>

<div class="eventos-fondo">
    <div class="container">
        <h2 class="eventos-titulo">🐶 Eventos de Rescatando Mascotas Forever</h2>

        <input type="text" class="form-control buscador-eventos" placeholder="🔍 Buscar evento...">

        <div class="row g-4 justify-content-center mt-4">
            @php
                $eventos = [
                    ['titulo'=>'🐾 Patas al Parque','fecha'=>'10 de enero de 2025','img'=>'https://images.unsplash.com/photo-1558944351-c69d3a19d4b0'],
                    ['titulo'=>'💖 Adopta con Amor','fecha'=>'15 de febrero de 2025','img'=>'https://images.unsplash.com/photo-1596495577886-d920f1fb7238'],
                    ['titulo'=>'🐕 PetFest','fecha'=>'27 de febrero de 2025','img'=>'https://images.unsplash.com/photo-1518717758536-85ae29035b6d'],
                    ['titulo'=>'🐱 Festival Huellitas','fecha'=>'28 de marzo de 2025','img'=>'https://images.unsplash.com/photo-1517849845537-4d257902454a'],
                    ['titulo'=>'🎉 PatiFiesta','fecha'=>'10 de enero de 2025','img'=>'https://images.unsplash.com/photo-1558944351-c69d3a19d4b0'],
                    ['titulo'=>'🐾 Peluditos','fecha'=>'15 de febrero de 2025','img'=>'https://images.unsplash.com/photo-1596495577886-d920f1fb7238'],
                    ['titulo'=>'🐕 LadraFest','fecha'=>'27 de febrero de 2025','img'=>'https://images.unsplash.com/photo-1518717758536-85ae29035b6d'],
                    ['titulo'=>'🐱 RonroneoFest','fecha'=>'28 de marzo de 2025','img'=>'https://images.unsplash.com/photo-1517849845537-4d257902454a'],
                ];
            @endphp

            @foreach ($eventos as $evento)
                <div class="col-md-3 col-sm-6">
                    <div class="card card-evento">
                        <img src="{{ $evento['img'] }}" alt="{{ $evento['titulo'] }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $evento['titulo'] }}</h5>
                            <p class="text-muted">{{ $evento['fecha'] }}</p>
                            <button class="btn btn-outline-danger btn-sm"><i class="fas fa-heart"></i></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('dashboard') }}" class="btn-volver"><i class="fas fa-arrow-left"></i> Volver al inicio</a>
        </div>
    </div>
</div>
@endsection
