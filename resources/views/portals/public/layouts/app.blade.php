{{-- resources/views/public/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rescatando Mascotas Forever')</title>
    
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    {{-- Estilos --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/public-navbar.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}"> 
    
    @stack('styles')
</head>

<body class="public-layout">
    
    {{-- Sidebar Público --}}
    @include('public.partials.sidebar.public-sidebar')
    
    {{-- Contenido Principal --}}
    <div class="public-main-content" id="publicMainContent">
        
        {{-- Navbar --}}
        @include('public.partials.navbar.public-navbar')

        {{-- Contenido de la Página --}}
        <main>
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('public.partials.footer.footer')

    </div>
    
    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/public-navbar.js') }}"></script>
    @stack('scripts')
</body>
</html>