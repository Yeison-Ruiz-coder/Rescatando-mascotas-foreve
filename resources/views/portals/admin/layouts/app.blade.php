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
    {{-- Estilos --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/admin-navbar.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}"> 
    
    @stack('styles')
</head>

<body class="admin-layout">
    
    {{-- Contenedor Principal --}}
    <div class="admin-container">
        
        {{-- Contenido Principal --}}
        <div class="admin-main-container">
            
            {{-- Navbar --}}
            <div class="admin-navbar-container">
                {{-- Header Principal --}}
                @include('portals.admin.partials.navbar.header-main')
            </div>

            {{-- Contenido de la Página --}}
            <main class="admin-content-container">
                @yield('content')
            </main>

            {{-- Footer Admin --}}
            @include('portals.admin.partials.footer.footer')

        </div>
    </div>

    {{-- Modales --}}
    @include('portals.admin.partials.navbar.modals')
    
    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/components/navbar-admin.js') }}"></script>
    @stack('scripts')
</body>
</html>