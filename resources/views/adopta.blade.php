@extends('layouts1.landing')

@section('title','Adopta')
@section('content')

<div class="page-container">
    <!-- Hero Section -->
    <section class="hero-section text-center text-white py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 300px; display: flex; align-items: center; justify-content: center;">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">🐾 Adopta una Mascota</h1>
            <p class="lead">Dale una segunda oportunidad a un animal que lo necesita</p>
        </div>
    </section>

    <!-- Mascotas Section -->
    <section class="adopta-section py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Mascotas Disponibles para Adoptar</h2>
            
            <div class="row g-4">
                <!-- Mascota 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card adopta-card h-100 shadow-sm border-0 hover-lift">
                        <img src="https://images.unsplash.com/photo-1558788353-f76d92427f16?w=400&h=300&fit=crop" class="card-img-top" alt="Rocky">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">🐕 Rocky</h5>
                            <p class="card-text text-muted">
                                <small>
                                    <i class="fas fa-venus"></i> Macho • 
                                    <i class="fas fa-birthday-cake"></i> 2 años
                                </small>
                            </p>
                            <p class="card-text">Perro juguetón y muy cariñoso. Perfecto para familias activas.</p>
                            <a href="#contacto" class="btn btn-success w-100">
                                <i class="fas fa-heart"></i> Quiero Adoptar
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Mascota 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card adopta-card h-100 shadow-sm border-0 hover-lift">
                        <img src="https://images.unsplash.com/photo-1517849845537-4d257902454a?w=400&h=300&fit=crop" class="card-img-top" alt="Luna">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">🐱 Luna</h5>
                            <p class="card-text text-muted">
                                <small>
                                    <i class="fas fa-mars"></i> Hembra • 
                                    <i class="fas fa-birthday-cake"></i> 1 año
                                </small>
                            </p>
                            <p class="card-text">Gata dulce y tranquila. Ideal para apartamentos.</p>
                            <a href="#contacto" class="btn btn-success w-100">
                                <i class="fas fa-heart"></i> Quiero Adoptar
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Mascota 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card adopta-card h-100 shadow-sm border-0 hover-lift">
                        <img src="https://images.unsplash.com/photo-1596495577886-d920f1fb7238?w=400&h=300&fit=crop" class="card-img-top" alt="Max">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">🐕 Max</h5>
                            <p class="card-text text-muted">
                                <small>
                                    <i class="fas fa-mars"></i> Macho • 
                                    <i class="fas fa-birthday-cake"></i> 3 años
                                </small>
                            </p>
                            <p class="card-text">Perro protector y noble. Gran compañero.</p>
                            <a href="#contacto" class="btn btn-success w-100">
                                <i class="fas fa-heart"></i> Quiero Adoptar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Proceso de Adopción -->
    <section class="proceso-section py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Proceso de Adopción</h2>
            
            <div class="row">
                <div class="col-md-3 text-center mb-4">
                    <div class="step-number bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px;">1</div>
                    <h5>Visita</h5>
                    <p class="text-muted">Conoce a la mascota</p>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <div class="step-number bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px;">2</div>
                    <h5>Solicitud</h5>
                    <p class="text-muted">Completa el formulario</p>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <div class="step-number bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px;">3</div>
                    <h5>Entrevista</h5>
                    <p class="text-muted">Conversamos contigo</p>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <div class="step-number bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px;">4</div>
                    <h5>¡Adopción!</h5>
                    <p class="text-muted">Lleva a tu nueva familia</p>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection