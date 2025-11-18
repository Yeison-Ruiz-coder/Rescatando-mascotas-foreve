@extends('layouts1.landing')

@section('title','Rescata')
@section('content')

<div class="page-container">
    <!-- Hero Section -->
    <section class="hero-section text-center text-white py-5" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); min-height: 300px; display: flex; align-items: center; justify-content: center;">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">🆘 Reportar un Rescate</h1>
            <p class="lead">Ayuda a un animal en situación de calle</p>
        </div>
    </section>

    <!-- Rescates Section -->
    <section class="rescata-section py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Últimos Rescates</h2>
            
            <div class="row g-4">
                <!-- Rescate 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card rescata-card h-100 shadow-sm border-0 hover-lift">
                        <div class="card-header bg-danger text-white">
                            <small><i class="fas fa-calendar"></i> Hace 2 días</small>
                        </div>
                        <img src="https://images.unsplash.com/photo-1583511655857-d19db992cb74?w=400&h=250&fit=crop" class="card-img-top" alt="Rescate">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">🐕 Perro Abandonado</h5>
                            <p class="card-text text-muted">
                                <small><i class="fas fa-map-marker-alt"></i> Centro de la ciudad</small>
                            </p>
                            <p class="card-text">Perro pequeño desnutrido encontrado en las calles. Actualmente en cuidado veterinario.</p>
                            <span class="badge bg-success">En recuperación</span>
                        </div>
                    </div>
                </div>

                <!-- Rescate 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card rescata-card h-100 shadow-sm border-0 hover-lift">
                        <div class="card-header bg-warning text-dark">
                            <small><i class="fas fa-calendar"></i> Hace 1 semana</small>
                        </div>
                        <img src="https://images.unsplash.com/photo-1574158622682-e40e69881006?w=400&h=250&fit=crop" class="card-img-top" alt="Rescate">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">🐱 Gata con Gatitos</h5>
                            <p class="card-text text-muted">
                                <small><i class="fas fa-map-marker-alt"></i> Parque cercano</small>
                            </p>
                            <p class="card-text">Familia de gatos rescatada de un refugio improvisado. Madre e hijos en buen estado.</p>
                            <span class="badge bg-info">Disponible para adopción</span>
                        </div>
                    </div>
                </div>

                <!-- Rescate 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card rescata-card h-100 shadow-sm border-0 hover-lift">
                        <div class="card-header bg-success text-white">
                            <small><i class="fas fa-calendar"></i> Hace 3 semanas</small>
                        </div>
                        <img src="https://images.unsplash.com/photo-1587300411107-ec8621d67e37?w=400&h=250&fit=crop" class="card-img-top" alt="Rescate">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">🐕 Pastor Alemán</h5>
                            <p class="card-text text-muted">
                                <small><i class="fas fa-map-marker-alt"></i> Afueras de la ciudad</small>
                            </p>
                            <p class="card-text">Perro fuerte y obediente encontrado vagando. Actualmente ha sido adoptado.</p>
                            <span class="badge bg-secondary">Adoptado</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Formulario de Reporte -->
    <section class="reporte-section py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">¿Encontraste un Animal?</h2>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="p-5 bg-white rounded-3 shadow-sm">
                        <form class="reporte-form">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tipo_animal" class="form-label fw-500">Tipo de Animal</label>
                                    <select class="form-select form-select-lg" id="tipo_animal" required>
                                        <option value="">Selecciona una opción</option>
                                        <option value="perro">Perro</option>
                                        <option value="gato">Gato</option>
                                        <option value="otro">Otro</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ubicacion" class="form-label fw-500">Ubicación del Rescate</label>
                                    <input type="text" class="form-control form-control-lg" id="ubicacion" placeholder="Dirección o punto de referencia" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="descripcion_animal" class="form-label fw-500">Descripción del Animal</label>
                                <textarea class="form-control form-control-lg" id="descripcion_animal" rows="3" placeholder="Color, tamaño, características especiales..." required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="nombre_reportador" class="form-label fw-500">Tu Nombre</label>
                                <input type="text" class="form-control form-control-lg" id="nombre_reportador" placeholder="Tu nombre completo" required>
                            </div>

                            <div class="mb-3">
                                <label for="telefono_reportador" class="form-label fw-500">Tu Teléfono</label>
                                <input type="tel" class="form-control form-control-lg" id="telefono_reportador" placeholder="Tu teléfono de contacto" required>
                            </div>

                            <button type="submit" class="btn btn-danger btn-lg w-100">
                                <i class="fas fa-exclamation-circle"></i> Reportar Rescate
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tips Section -->
    <section class="tips-section py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Consejos para Rescatar un Animal</h2>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="tip-card p-4 border-start border-5 border-success">
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-shield-alt text-success"></i> Mantén la Seguridad
                        </h5>
                        <p>Si el animal está herido o es agresivo, llama a profesionales. No arriesgues tu integridad.</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="tip-card p-4 border-start border-5 border-info">
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-phone text-info"></i> Llama a Profesionales
                        </h5>
                        <p>Contacta con nuestra organización o las autoridades locales para ayuda profesional.</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="tip-card p-4 border-start border-5 border-warning">
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-water text-warning"></i> Ofrece Agua y Comida
                        </h5>
                        <p>Si es seguro, proporciona agua fresca y comida al animal para ganar su confianza.</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="tip-card p-4 border-start border-5 border-danger">
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-camera text-danger"></i> Toma Fotografías
                        </h5>
                        <p>Documenta el estado del animal con fotos. Esto nos ayuda a hacer seguimiento.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection