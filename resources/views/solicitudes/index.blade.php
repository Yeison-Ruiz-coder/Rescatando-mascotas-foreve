<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestión de Solicitudes') - Rescatando Mascotas</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @stack('styles')
</head>
<body>
    <header>
        <div class="top-bar">
            <div class="logo-container">
                <img src="{{ asset('img/logo.png') }}" alt="Rescatando Mascotas Logo" class="logo">
            </div>

            <nav class="main-nav">
                <ul class="nav-links">
                    <li><a href="#">INICIO</a></li>
                    <li><a href="#">REPORTA</a></li>
                    <li><a href="#">ADOPTA</a></li>
                    <li><a href="#">RESCATA</a></li>
                    {{-- CORRECCIÓN: Usar 'solicitud.index' en singular --}}
                    <li><a href="{{ route('solicitud.index') }}">SOLICITUDES</a></li>
                    <li><a href="#">SUSCRIBETE</a></li>
                    <li><a href="#">NOSOTROS</a></li>
                </ul>
                
                <div class="user-icon">
                    <i class="fa-solid fa-user"></i>
                </div>
            </nav>
        </div>

        <div class="bottom-bar">
            <ul class="sub-menu">
                <li>Rescatistas <span class="triangle">▼</span></li>
                <li>Mascotas <span class="triangle">▼</span></li>
                <li>Rescates <span class="triangle">▼</span></li>
                <li>Formularios <span class="triangle">▼</span></li>
                <li>Dona <span class="triangle">▼</span></li>
            </ul>
        </div>
    </header>
    
    <main>
        <!-- Contenido principal específico de la página -->
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="wave-container">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 60C240 140 480 20 720 60C960 100 1200 0 1440 40V0H0V60Z" fill="#dbe2ef"/> 
            </svg>
        </div>

        <div class="footer-content">
            <div class="footer-col logo-col">
                <div class="footer-logo">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo">
                </div>
                <p class="slogan">
                    Transformando vidas de mascotas abandonadas, creando familias felices desde 2025.
                </p>
            </div>

            <div class="footer-col">
                <h3>Contacto</h3>
                <ul class="contact-list">
                    <li>+57 324 864 234</li>
                    <li>contacto.rescatandomascotasforever@.org</li>
                    <li>Calle 6 # 234 - 234 Bello Horizonte, Popayán Cauca Colombia</li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Formularios</h3>
                <ul class="footer-links">
                    <li><a href="#">Adopción</a></li>
                    <li><a href="#">Rescates</a></li>
                    <li><a href="#">Rescatistas</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Servicios</h3>
                <ul class="footer-links">
                    <li><a href="#">Proceso de Adopción</a></li>
                    <li><a href="#">Donación</a></li>
                    <li><a href="#">Donación de suministros</a></li>
                    <li><a href="#">Suscripción</a></li>
                    <li><a href="#">Rescatistas</a></li>
                    <li><a href="#">Eventos</a></li>
                    <li><a href="#">Calificación</a></li>
                </ul>
            </div>

            <div class="footer-col social-col">
                <h3>Siguenos</h3>
                <div class="social-icons">
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#"><i class="fa-brands fa-x-twitter"></i></a> <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>
        </div>
    </footer>
    @stack('scripts')
</body>
</html>