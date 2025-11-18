
@extends('layouts1.landing')

@section('title','Contacto')
@section('content')

<div class="page-container">
    <!-- Hero Section -->
    <section class="hero-section text-center text-white py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 300px; display: flex; align-items: center; justify-content: center;">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">📞 Contáctanos</h1>
            <p class="lead">Estamos aquí para ayudarte</p>
        </div>
    </section>

    <!-- Contacto Section -->
    <section class="contacto-section py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Formulario -->
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-4">Envíanos tu Mensaje</h2>
                    <form class="contacto-form">
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-500">Nombre Completo</label>
                            <input type="text" class="form-control form-control-lg" id="nombre" placeholder="Tu nombre" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-500">Correo Electrónico</label>
                                <input type="email" class="form-control form-control-lg" id="email" placeholder="tu@email.com" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telefono" class="form-label fw-500">Teléfono</label>
                                <input type="tel" class="form-control form-control-lg" id="telefono" placeholder="+34 600 123 456" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="asunto" class="form-label fw-500">Asunto</label>
                            <input type="text" class="form-control form-control-lg" id="asunto" placeholder="¿En qué podemos ayudarte?" required>
                        </div>

                        <div class="mb-3">
                            <label for="mensaje" class="form-label fw-500">Mensaje</label>
                            <textarea class="form-control form-control-lg" id="mensaje" rows="5" placeholder="Cuéntanos tu mensaje..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg w-100">
                            <i class="fas fa-paper-plane"></i> Enviar Mensaje
                        </button>
                    </form>
                </div>

                <!-- Información de Contacto -->
                <div class="col-lg-4">
                    <div class="contacto-info">
                        <div class="info-card mb-4 p-4 bg-light rounded-3 border-start border-success border-5">
                            <h5 class="fw-bold mb-2">
                                <i class="fas fa-map-marker-alt text-success"></i> Dirección
                            </h5>
                            <p>Calle Principal, 123<br>Ciudad, 28001</p>
                        </div>

                        <div class="info-card mb-4 p-4 bg-light rounded-3 border-start border-success border-5">
                            <h5 class="fw-bold mb-2">
                                <i class="fas fa-phone text-success"></i> Teléfono
                            </h5>
                            <p>
                                <a href="tel:+34123456789">+34 123 456 789</a>
                            </p>
                        </div>

                        <div class="info-card mb-4 p-4 bg-light rounded-3 border-start border-success border-5">
                            <h5 class="fw-bold mb-2">
                                <i class="fas fa-envelope text-success"></i> Email
                            </h5>
                            <p>
                                <a href="mailto:info@rescatandomascotas.local">info@rescatandomascotas.local</a>
                            </p>
                        </div>

                        <div class="info-card p-4 bg-light rounded-3 border-start border-success border-5">
                            <h5 class="fw-bold mb-3">
                                <i class="fas fa-clock text-success"></i> Horario
                            </h5>
                            <p class="mb-1">Lunes - Viernes: 9:00 - 18:00</p>
                            <p class="mb-1">Sábado: 10:00 - 14:00</p>
                            <p>Domingo: Cerrado</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Redes Sociales Section -->
    <section class="redes-section py-5 bg-light">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Síguenos en Redes Sociales</h2>
            <div class="social-links">
                <a href="#" class="social-btn facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-btn instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="social-btn twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="social-btn whatsapp">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
        </div>
    </section>
</div>

@endsection
