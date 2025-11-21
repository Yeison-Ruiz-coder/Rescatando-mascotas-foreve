<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rescatando Mascotas - Hogar de Esperanza')</title>
    
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    {{-- Estilos Globales PRIMERO (navbar y footer) --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/navbar.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}"> 
    
    {{-- Estilos del Home DESPUÉS --}}
    <link rel="stylesheet" href="{{ asset('css/home/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/hero.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/mascotas.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/proceso.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/testimonios.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/cta.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/responsive.css') }}">
    
    @stack('styles')
</head>

<body>
    {{-- Navbar (usa SOLO los estilos globales) --}}
    @include('portals.public.partials.navbar.navbar')

    {{-- Contenido del Home - AISLADO --}}
    <div id="home-content-wrapper">
        @yield('content')
    </div>

    {{-- Footer (usa SOLO los estilos globales) --}}
    @include('portals.public.partials.footer.footer')
    
    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>