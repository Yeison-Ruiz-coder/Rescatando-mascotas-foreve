@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f4faff;
        font-family: 'Poppins', sans-serif;
    }

    /* NAVBAR PRINCIPAL */
    .navbar-custom {
        background-color: #ff4f8b;
        padding: 12px 0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .navbar-custom .nav-link,
    .navbar-custom .navbar-brand {
        color: white !important;
        font-weight: 600;
        transition: 0.3s;
    }

    .navbar-custom .nav-link:hover {
        color: #ffe6f0 !important;
        transform: translateY(-2px);
    }

    /* FONDO DE EVENTOS */
    .eventos-bg {
        background: url('/images/mi-nuevo-fondo.jpg') center center / cover no-repeat;
        padding: 60px 0;
        backdrop-filter: blur(2px);
    }

    /* TARJETAS */
    .card-evento {
        border-radius: 18px;
        overflow: hidden;
        background: white;
        box-shadow: 0 5px 18px rgba(0,0,0,0.12);
        transition: 0.25s ease-in-out;
    }

    .card-evento:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 22px rgba(0,0,0,0.18);
    }

    .card-evento img {
        height: 200px;
        object-fit: cover;
        width: 100%;
        border-bottom: 1px solid #eee;
    }

    .card-evento .card-body {
        padding: 18px;
    }

    .card-title {
        font-size: 1.15rem;
        font-weight: 700;
        margin-bottom: 5px;
        color: #333;
    }

    .text-muted {
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    /* Botón del corazón */
    .btn-like {
        border: none;
        background: #ffe1ec;
        color: #ff4f8b;
        border-radius: 50%;
        width: 38px;
        height: 38px;
        transition: 0.3s;
        font-size: 1.2rem;
    }

    .btn-like:hover {
        background: #ff4f8b;
        color: white;
        transform: scale(1.1);
    }

    /* BOTÓN VOLVER */
    .btn-volver {
        background-color: #1ca58f;
        color: white;
        border-radius: 28px;
        padding: 12px 30px;
        font-weight: 600;
        font-size: 1rem;
        border: none;
        transition: 0.3s;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .btn-volver:hover {
        background-color: #14826f;
        transform: translateY(-3px);
    }

    /* INPUT BUSCADOR */
    .buscador {
        border-radius: 25px;
        padding: 12px 20px;
        border: 2px solid #d1dbe8;
        transition: 0.3s;
        box-shadow: 0 3px 8px rgba(0,0,0,0.08);
    }

    .buscador:focus {
        border-color: #ff4f8b;
        box-shadow: 0 0 12px rgba(255,79,139,0.3);
    }
</style>


<!-- CONTENIDO -->
<div class="eventos-bg">
    <div class="container text-center mb-5">
        <h2 class="fw-bold text-dark mb-4">🐶 Eventos</h2>
        <input type="text" class="form-control w-50 mx-auto buscador" placeholder="🔍 Busca tu evento">
    </div>

    <div class="container">
        <div class="row g-4 justify-content-center">

            @php
                $eventos = [
                    ['titulo'=>'🐾 Patas al Parque','fecha'=>'10 de enero de 2025','img'=>'https://i.pinimg.com/736x/0d/8f/47/0d8f476ec54c3d67413784fa1ff08894.jpg'],
                    ['titulo'=>'💖 Adopta con Amor','fecha'=>'15 de febrero de 2025','img'=>'https://i.pinimg.com/736x/ac/f5/f3/acf5f33b8f4e377f5c43450b489249df.jpg'],
                    ['titulo'=>'🐕 PetFest','fecha'=>'27 de febrero de 2025','img'=>'https://images.unsplash.com/photo-1518717758536-85ae29035b6d'],
                    ['titulo'=>'🐱 Festival Huellitas','fecha'=>'28 de marzo de 2025','img'=>'https://i.pinimg.com/1200x/35/97/0e/35970ebc4f444ecfccdb3590d06d6340.jpg'],
                    ['titulo'=>'🎉 PatiFiesta','fecha'=>'10 de enero de 2025','img'=>'https://i.pinimg.com/1200x/37/51/54/3751548eb0139e8cb47b998adf13bb1b.jpg'],
                    ['titulo'=>'🐾 Peluditos','fecha'=>'15 de febrero de 2025','img'=>'https://i.pinimg.com/736x/04/3f/ba/043fba8fb61d54adbcf71487eba6a2e5.jpg'],
                    ['titulo'=>'🐕 LadraFest','fecha'=>'27 de febrero de 2025','img'=>'https://i.pinimg.com/1200x/f0/e0/01/f0e001756646fb72a9cf3e8bd8c74c26.jpg'],
                    ['titulo'=>'🐱 RonroneoFest','fecha'=>'28 de marzo de 2025','img'=>'https://i.pinimg.com/1200x/c6/3b/c2/c63bc2eb656f85421a7dddb98c065b08.jpg'],
                ];
            @endphp

            @foreach ($eventos as $evento)
            <div class="col-md-3 col-sm-6">
                <div class="card card-evento">
                    <img src="{{ $evento['img'] }}" alt="{{ $evento['titulo'] }}">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $evento['titulo'] }}</h5>
                        <p class="text-muted">{{ $evento['fecha'] }}</p>
                        <button class="btn-like">❤️</button>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <div class="text-center mt-5">
            <button class="btn-volver">Volver al inicio</button>
        </div>
    </div>
</div>

<script src="https://kit.fontawesome.com/a2d0b5f6a4.js" crossorigin="anonymous"></script>
@endsection
