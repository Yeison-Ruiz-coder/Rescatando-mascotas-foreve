<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Admin - Rescatando Mascotas Forever')</title>
    
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    {{-- Estilos globales --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    {{-- Componentes --}}
    <link rel="stylesheet" href="{{ asset('css/components/navbar.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}"> 
    
    {{-- Estilos específicos de cada página --}}
    @stack('styles')
</head>

<body class="bg-light">
    {{-- Navbar Privado --}}
    @include('layouts.includes.private.navbar')

    {{-- Contenido principal --}}
    <main class="container-fluid px-0">
        @yield('content')
    </main>

    {{-- Footer Privado --}}
    @include('layouts.includes.private.footer')
    
    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- Scripts específicos de cada página --}}
    @stack('scripts')
</body>
</html>