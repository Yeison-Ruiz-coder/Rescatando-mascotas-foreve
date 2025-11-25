<?php $__env->startSection('title','Home'); ?>

<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/index.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<h1>Index de prueba rescatando mascotas</h1>

<div class="page-container">
    <!-- Hero Section -->
    

     <!-- Hero Section -->
    <section class="hero-section text-white">
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-6 animate-fade-in-up">
                    <h1>Encuentra a tu compañero perfecto</h1>
                    <p>BIENVENIDOS A RESCATANDO MASCOTAS FOREVER!!
                    <p class="lead">Dale una segunda oportunidad a un animal que lo necesita. Miles de mascotas esperan un hogar lleno de amor.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#mascotas" class="btn btn-hero">Adoptar Ahora</a>
                        <a href="#proceso" class="btn btn-outline-light rounded-pill px-4">Conocer el Proceso</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center animate-fade-in-up delay-1">
                     <img src="https://media.istockphoto.com/id/2194197607/es/foto/madre-feliz-padre-linda-peque%C3%B1a-hija-abrazada-junto-con-perro-golden-retriever.jpg?s=612x612&w=0&k=20&c=t5RkkLVjmFiWOQB-VrstAweh-kVAJxebD-a5-g_2cwA=" class="card-img-top" alt="Max">
                    
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-number">1,200+</div>
                    <p>Mascotas Rescatadas</p>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-number">850+</div>
                    <p>Adopciones Exitosas</p>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-number">150+</div>
                    <p>Voluntarios Activos</p>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-number">5</div>
                    <p>Años de Experiencia</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mascotas Section -->
    <section id="mascotas" class="adopta-section py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title">Mascotas Disponibles para Adoptar</h2>
            <p class="text-center text-muted mb-5">Conoce a nuestros amigos que buscan un hogar lleno de amor y cuidado.</p>
            
            <div class="row g-4">
                <!-- Mascota 1 -->
                <div class="col-md-6 col-lg-4 animate-fade-in-up">
                    <div class="card adopta-card h-100">
                        <div class="position-relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1558788353-f76d92427f16?w=400&h=300&fit=crop" class="card-img-top" alt="Rocky">
                            <span class="position-absolute top-0 end-0 bg-success text-white px-3 py-2 m-3 rounded-pill">Disponible</span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">🐕 Rocky</h5>
                            <div class="d-flex mb-2">
                                <span class="badge bg-light text-dark me-2"><i class="fas fa-venus me-1"></i> Macho</span>
                                <span class="badge bg-light text-dark"><i class="fas fa-birthday-cake me-1"></i> 2 años</span>
                            </div>
                            <p class="card-text flex-grow-1">Perro juguetón y muy cariñoso. Le encanta correr y jugar al aire libre. Perfecto para familias activas.</p>
                            <div class="mt-auto">
                                <a href="#contacto" class="btn btn-adoptar w-100">
                                    <i class="fas fa-heart me-2"></i> Quiero Adoptar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mascota 2 -->
                <div class="col-md-6 col-lg-4 animate-fade-in-up delay-1">
                    <div class="card adopta-card h-100">
                        <div class="position-relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1517849845537-4d257902454a?w=400&h=300&fit=crop" class="card-img-top" alt="Luna">
                            <span class="position-absolute top-0 end-0 bg-success text-white px-3 py-2 m-3 rounded-pill">Disponible</span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">🐱 Luna</h5>
                            <div class="d-flex mb-2">
                                <span class="badge bg-light text-dark me-2"><i class="fas fa-mars me-1"></i> Hembra</span>
                                <span class="badge bg-light text-dark"><i class="fas fa-birthday-cake me-1"></i> 1 año</span>
                            </div>
                            <p class="card-text flex-grow-1">Gata dulce y tranquila. Le gusta acurrucarse y recibir mimos. Ideal para apartamentos.</p>
                            <div class="mt-auto">
                                <a href="#contacto" class="btn btn-adoptar w-100">
                                    <i class="fas fa-heart me-2"></i> Quiero Adoptar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mascota 3 -->
                <div class="col-md-6 col-lg-4 animate-fade-in-up delay-2">
                    <div class="card adopta-card h-100">
                        <div class="position-relative overflow-hidden">
                            <img src="https://plus.unsplash.com/premium_photo-1661892088256-0a17130b3d0d?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D=" class="card-img-top" alt="Max">
                            <span class="position-absolute top-0 end-0 bg-warning text-dark px-3 py-2 m-3 rounded-pill">En proceso</span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">🐕 Max</h5>
                            <div class="d-flex mb-2">
                                <span class="badge bg-light text-dark me-2"><i class="fas fa-mars me-1"></i> Macho</span>
                                <span class="badge bg-light text-dark"><i class="fas fa-birthday-cake me-1"></i> 3 años</span>
                            </div>
                            <p class="card-text flex-grow-1">Perro protector y noble. Fiel compañero que se adapta bien a diferentes entornos.</p>
                            <div class="mt-auto">
                                <a href="#contacto" class="btn btn-adoptar w-100">
                                    <i class="fas fa-heart me-2"></i> Quiero Adoptar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <a href="#" class="btn btn-outline-primary btn-lg">Ver Todas las Mascotas</a>
            </div>
        </div>
    </section>

    <!-- Proceso de Adopción -->
    <section id="proceso" class="proceso-section py-5">
        <div class="container">
            <h2 class="text-center section-title">Proceso de Adopción</h2>
            <p class="text-center text-muted mb-5">Seguimos un proceso cuidadoso para asegurar que cada mascota encuentre el hogar perfecto.</p>
            
            <div class="row">
                <div class="col-md-3 text-center mb-4 step-card">
                    <div class="step-number rounded-circle d-inline-flex align-items-center justify-content-center mb-3">1</div>
                    <h5>Conocimiento</h5>
                    <p class="text-muted">Conoce a la mascota y asegúrate de que es compatible con tu estilo de vida.</p>
                </div>
                <div class="col-md-3 text-center mb-4 step-card">
                    <div class="step-number rounded-circle d-inline-flex align-items-center justify-content-center mb-3">2</div>
                    <h5>Solicitud</h5>
                    <p class="text-muted">Completa nuestro formulario de adopción con tus datos y preferencias.</p>
                </div>
                <div class="col-md-3 text-center mb-4 step-card">
                    <div class="step-number rounded-circle d-inline-flex align-items-center justify-content-center mb-3">3</div>
                    <h5>Entrevista</h5>
                    <p class="text-muted">Conversamos contigo para conocer mejor tus expectativas y capacidades.</p>
                </div>
                <div class="col-md-3 text-center mb-4 step-card">
                    <div class="step-number rounded-circle d-inline-flex align-items-center justify-content-center mb-3">4</div>
                    <h5>¡Adopción!</h5>
                    <p class="text-muted">Firmamos los documentos y te llevas a tu nuevo miembro de la familia.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonios -->
    <section class="testimonials-section py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title">Historias de Éxito</h2>
            <p class="text-center text-muted mb-5">Conoce las experiencias de familias que han adoptado con nosotros.</p>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=100&h=100&fit=crop&crop=face" class="testimonial-img me-3" alt="María González">
                            <div>
                                <h5 class="mb-0">María González</h5>
                                <small class="text-muted">Adoptó a Luna hace 6 meses</small>
                            </div>
                        </div>
                        <p class="mb-0">"La experiencia de adopción fue maravillosa. El equipo fue muy profesional y Luna se ha adaptado perfectamente a nuestra familia. ¡No podríamos estar más felices!"</p>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face" class="testimonial-img me-3" alt="Carlos Rodríguez">
                            <div>
                                <h5 class="mb-0">Carlos Rodríguez</h5>
                                <small class="text-muted">Adoptó a Rocky hace 1 año</small>
                            </div>
                        </div>
                        <p class="mb-0">"Rocky ha cambiado nuestra vida por completo. Es el compañero perfecto para mis hijos y ha traído tanta alegría a nuestro hogar. Gracias por hacer posible esta adopción."</p>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop&crop=face" class="testimonial-img me-3" alt="Ana Martínez">
                            <div>
                                <h5 class="mb-0">Ana Martínez</h5>
                                <small class="text-muted">Adoptó a Simba hace 8 meses</small>
                            </div>
                        </div>
                        <p class="mb-0">"El proceso fue muy claro y me sentí acompañada en todo momento. Simba es un gato maravilloso y estoy muy agradecida por la oportunidad de darle un hogar."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-5 text-white" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);">
        <div class="container text-center">
            <h2 class="mb-4">¿Listo para cambiar una vida?</h2>
            <p class="lead mb-4">Cada adopción no solo salva una vida, sino que crea espacio para que podamos rescatar a otro animal necesitado.</p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="#mascotas" class="btn btn-light btn-lg px-4">Adoptar una Mascota</a>
                <a href="#" class="btn btn-outline-light btn-lg px-4">Ser Voluntario</a>
            </div>
        </div>
    </section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts1.landing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\crist\Desktop\RESCATANDO211\Rescatando-mascotas-foreve\resources\views/index.blade.php ENDPATH**/ ?>