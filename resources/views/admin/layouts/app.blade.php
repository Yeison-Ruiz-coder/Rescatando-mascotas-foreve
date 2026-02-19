<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Panel Admin') - Mascotas</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Tus estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body>
    <!-- Header (el actual pero mejorado) -->
    @include('admin.layouts.header')

    <!-- Menú Hamburguesa -->
    @include('admin.layouts.navigation')

    <!-- Overlay para cuando el menú está abierto -->
    <div class="menu-overlay" id="menuOverlay"></div>

    <!-- Contenido Principal -->
    <main class="main-content" id="mainContent">
        <div class="container-fluid py-4">
            <!-- Título de la página -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3">@yield('page-title')</h1>
                @yield('page-actions')
            </div>

            <!-- Mensajes de sesión -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Contenido de la página -->
            @yield('content')
        </div>
    </main>

    @include('portals.admin.partials.footer.footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    @stack('scripts')
</body>

</html>
