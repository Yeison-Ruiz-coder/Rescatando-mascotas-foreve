@extends('layouts1.landing')

@section('title','Services')
@section('content')

<div class="page-container">
    <!-- Hero Section -->
    <section class="hero-section text-center text-white py-5" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); min-height: 300px; display: flex; align-items: center; justify-content: center;">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">🎯 Nuestros Servicios</h1>
            <p class="lead">Conoce todas las formas en que podemos ayudarte y a nuestros amigos peludos</p>
        </div>
    </section>

    <!-- Servicios Principales -->
    <section class="servicios-section py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Servicios Disponibles</h2>
            
            <div class="row g-4">
                <!-- Servicio 1: Adopción -->
                <div class="col-md-6 col-lg-4">
                    <div class="service-card h-100 shadow-sm border-0 rounded-3 overflow-hidden hover-lift">
                        <div class="service-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 120px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-home text-white" style="font-size: 3rem;"></i>
                        </div>
                        <div class="service-body p-4">
                            <h5 class="fw-bold mb-2">Adopción de Mascotas</h5>
                            <p class="text-muted mb-3">Encuentra tu compañero ideal. Ofrecemos mascotas vacunadas y desparasitadas listas para un nuevo hogar.</p>
                            <ul class="service-features list-unstyled">
                                <li><i class="fas fa-check-circle text-success me-2"></i>Mascotas verificadas</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Apoyo post-adopción</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Garantía sanitaria</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Servicio 2: Rescate -->
                <div class="col-md-6 col-lg-4">
                    <div class="service-card h-100 shadow-sm border-0 rounded-3 overflow-hidden hover-lift">
                        <div class="service-header" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); height: 120px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-life-ring text-white" style="font-size: 3rem;"></i>
                        </div>
                        <div class="service-body p-4">
                            <h5 class="fw-bold mb-2">Rescate de Animales</h5>
                            <p class="text-muted mb-3">Rescatamos animales en situación de calle y ofrecemos cuidado veterinario y rehabilitación.</p>
                            <ul class="service-features list-unstyled">
                                <li><i class="fas fa-check-circle text-success me-2"></i>Atención 24/7</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Veterinario especializado</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Rehabilitación</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Servicio 3: Consulta Veterinaria -->
                <div class="col-md-6 col-lg-4">
                    <div class="service-card h-100 shadow-sm border-0 rounded-3 overflow-hidden hover-lift">
                        <div class="service-header" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); height: 120px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-stethoscope text-white" style="font-size: 3rem;"></i>
                        </div>
                        <div class="service-body p-4">
                            <h5 class="fw-bold mb-2">Consulta Veterinaria</h5>
                            <p class="text-muted mb-3">Acceso a consultas veterinarias a precios accesibles para el bienestar de tu mascota.</p>
                            <ul class="service-features list-unstyled">
                                <li><i class="fas fa-check-circle text-success me-2"></i>Precios accesibles</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Diagnóstico completo</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Medicinas incluidas</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Servicio 4: Voluntariado -->
                <div class="col-md-6 col-lg-4">
                    <div class="service-card h-100 shadow-sm border-0 rounded-3 overflow-hidden hover-lift">
                        <div class="service-header" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); height: 120px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-hands-helping text-white" style="font-size: 3rem;"></i>
                        </div>
                        <div class="service-body p-4">
                            <h5 class="fw-bold mb-2">Voluntariado</h5>
                            <p class="text-muted mb-3">Únete a nuestro equipo de voluntarios y sé parte del cambio en la vida de miles de animales.</p>
                            <ul class="service-features list-unstyled">
                                <li><i class="fas fa-check-circle text-success me-2"></i>Flexibilidad horaria</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Capacitación gratuita</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Impacto social</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Servicio 5: Donaciones -->
                <div class="col-md-6 col-lg-4">
                    <div class="service-card h-100 shadow-sm border-0 rounded-3 overflow-hidden hover-lift">
                        <div class="service-header" style="background: linear-gradient(135deg, #30cfd0 0%, #330867 100%); height: 120px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-donate text-white" style="font-size: 3rem;"></i>
                        </div>
                        <div class="service-body p-4">
                            <h5 class="fw-bold mb-2">Sistema de Donaciones</h5>
                            <p class="text-muted mb-3">Contribuye económicamente para mantener nuestras operaciones de rescate y cuidado animal.</p>
                            <ul class="service-features list-unstyled">
                                <li><i class="fas fa-check-circle text-success me-2"></i>Donaciones seguras</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Transparencia total</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Recibos fiscales</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Servicio 6: Tienda Online -->
                <div class="col-md-6 col-lg-4">
                    <div class="service-card h-100 shadow-sm border-0 rounded-3 overflow-hidden hover-lift">
                        <div class="service-header" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); height: 120px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-shopping-cart text-white" style="font-size: 3rem;"></i>
                        </div>
                        <div class="service-body p-4">
                            <h5 class="fw-bold mb-2">Tienda Online</h5>
                            <p class="text-muted mb-3">Compra productos y accesorios para mascotas con precios especiales. Las ganancias van al rescate.</p>
                            <ul class="service-features list-unstyled">
                                <li><i class="fas fa-check-circle text-success me-2"></i>Productos de calidad</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Envío rápido</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Causa social</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Proceso de Servicios -->
    <section class="proceso-servicios py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">¿Cómo Acceder a Nuestros Servicios?</h2>
            
            <div class="row">
                <div class="col-md-6 col-lg-3 text-center mb-4">
                    <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px; font-size: 28px;">
                        <i class="fas fa-search"></i>
                    </div>
                    <h5 class="fw-bold">Explora</h5>
                    <p class="text-muted">Navega nuestros servicios y encuentra lo que necesitas</p>
                </div>

                <div class="col-md-6 col-lg-3 text-center mb-4">
                    <div class="step-number bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px; font-size: 28px;">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <h5 class="fw-bold">Regístrate</h5>
                    <p class="text-muted">Crea tu cuenta de forma rápida y segura</p>
                </div>

                <div class="col-md-6 col-lg-3 text-center mb-4">
                    <div class="step-number bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px; font-size: 28px;">
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="fw-bold">Accede</h5>
                    <p class="text-muted">Disfruta de todos nuestros servicios premium</p>
                </div>

                <div class="col-md-6 col-lg-3 text-center mb-4">
                    <div class="step-number bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px; font-size: 28px;">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h5 class="fw-bold">Contribuye</h5>
                    <p class="text-muted">Sé parte de nuestro movimiento de cambio</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-servicios py-5 text-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
        <div class="container">
            <h2 class="fw-bold mb-3">¿Necesitas Ayuda?</h2>
            <p class="lead mb-4">Contáctanos para más información sobre nuestros servicios</p>
            <a href="/contacto" class="btn btn-light btn-lg">
                <i class="fas fa-envelope"></i> Contactar Ahora
            </a>
        </div>
    </section>
</div>

@endsection