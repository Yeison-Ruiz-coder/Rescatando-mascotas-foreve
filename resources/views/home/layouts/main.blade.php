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
    <link rel="stylesheet" href="{{ asset('css/components/admin-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">

    

    @stack('styles')
</head>

<body>
    {{-- Navbar (usa SOLO los estilos globales) --}}
    @extends('public.layouts.app')

    {{-- Contenido del Home - AISLADO --}}
    <div id="home-content-wrapper">
        @yield('content')
    </div>

    {{-- Footer (usa SOLO los estilos globales) --}}
    @include('public.layouts.partials.footer.footer')

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
