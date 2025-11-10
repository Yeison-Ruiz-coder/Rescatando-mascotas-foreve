@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #e9f4fb;
        font-family: 'Poppins', sans-serif;
    }

    /* Encabezado rosa */
    .navbar-custom {
        background-color: #ff4f8b;
    }

    .navbar-custom .nav-link, 
    .navbar-custom .navbar-brand {
        color: white !important;
        font-weight: 600;
    }

    .navbar-custom .nav-link:hover {
        text-decoration: underline;
    }

    /* Fondo celeste de eventos */
    .eventos-bg {
        background: url('https://img.freepik.com/foto-gratis/fondo-azul-acuarela-pintado-mano_23-2148965120.jpg') no-repeat center center;
        background-size: cover;
        padding: 50px 0;
    }

    .card-evento {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        transition: transform 0.3s ease;
    }

    .card-evento:hover {
        transform: translateY(-5px);
    }

    .card-evento img {
        height: 180px;
        object-fit: cover;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
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

    footer {
        background: linear-gradient(135deg, #1ca58f 50%, #ff4f8b 50%);
        color: white;
        padding: 40px 0;
    }

    .footer-icon {
        font-size: 1.5rem;
        margin-right: 10px;
        color: white;
    }

    .footer-icon:hover {
        color: #d1e7dd;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="#">🐾 Rescatando Mascotas Forever</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="#" class="nav-link">Inicio</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Reporta</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Adopta</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Rescata</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Solicitudes</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Suscríbete</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Nosotros</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="eventos-bg">
    <div class="container text-center mb-4">
        <h2 class="fw-bold text-dark mb-4">🐶 Eventos</h2>
        <input type="text" class="form-control w-50 mx-auto mb-5" placeholder="🔍 Busca tu evento">
    </div>

    <div class="container">
        <div class="row g-4 justify-content-center">
            <!-- Tarjetas -->
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
                        <button class="btn btn-outline-primary btn-sm">❤️</button>
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

<footer class="text-center mt-5">
    <div class="container">
        <p class="fw-bold mb-1">Rescatando Mascotas Forever</p>
        <p>Transformando vidas de animales con amor y esperanza 🐾</p>
        <div class="mt-3">
            <a href="#" class="footer-icon"><i class="fab fa-facebook"></i></a>
            <a href="#" class="footer-icon"><i class="fab fa-whatsapp"></i></a>
            <a href="#" class="footer-icon"><i class="fab fa-instagram"></i></a>
            <a href="#" class="footer-icon"><i class="fab fa-tiktok"></i></a>
        </div>
    </div>
</footer>

<!-- FontAwesome -->
<script src="https://kit.fontawesome.com/a2d0b5f6a4.js" crossorigin="anonymous"></script>
@endsection
