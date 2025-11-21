<!-- Mascotas Section -->
<section id="mascotas" class="adopta-section">
    <div class="container">
        <h2 class="section-title">Mascotas Disponibles para Adoptar</h2>
        <p class="section-subtitle">Conoce a nuestros amigos que buscan un hogar lleno de amor y cuidado.</p>
        
        <div class="row g-4">
            @if(isset($mascotasRecientes) && $mascotasRecientes->count() > 0)
                @foreach($mascotasRecientes as $mascota)
                <div class="col-md-6 col-lg-4 animate-fade-in-up">
                    <div class="card adopta-card h-100">
                        <div class="position-relative overflow-hidden">
                            <img src="{{ $mascota->imagen_url ?? 'https://images.unsplash.com/photo-1558788353-f76d92427f16?w=400&h=300&fit=crop' }}" 
                                 class="card-img-top" 
                                 alt="{{ $mascota->Nombre_mascota }}">
                            <span class="position-absolute top-0 end-0 status-badge bg-success text-white px-3 py-2 m-3 rounded-pill">
                                {{ $mascota->estado }}
                            </span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">🐕 {{ $mascota->Nombre_mascota }}</h5>
                            <div class="d-flex mb-2">
                                <span class="badge-custom">
                                    <i class="fas fa-venus me-1"></i> {{ $mascota->sexo }}
                                </span>
                                <span class="badge-custom">
                                    <i class="fas fa-birthday-cake me-1"></i> {{ $mascota->Edad_aprox }} años
                                </span>
                            </div>
                            <p class="card-text flex-grow-1">{{ $mascota->descripcion ?? 'Mascota cariñosa buscando hogar.' }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('adopciones.solicitar', $mascota->id) }}" class="btn-adoptar">
                                    <i class="fas fa-heart me-2"></i> Quiero Adoptar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <!-- Mascotas de ejemplo (cuando no hay datos) -->
                <div class="col-md-6 col-lg-4 animate-fade-in-up">
                    <div class="card adopta-card h-100">
                        <div class="position-relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1558788353-f76d92427f16?w=400&h=300&fit=crop" class="card-img-top" alt="Rocky">
                            <span class="position-absolute top-0 end-0 status-badge bg-success text-white px-3 py-2 m-3 rounded-pill">Disponible</span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">🐕 Rocky</h5>
                            <div class="d-flex mb-2">
                                <span class="badge-custom"><i class="fas fa-venus me-1"></i> Macho</span>
                                <span class="badge-custom"><i class="fas fa-birthday-cake me-1"></i> 2 años</span>
                            </div>
                            <p class="card-text flex-grow-1">Perro juguetón y muy cariñoso. Perfecto para familias activas.</p>
                            <div class="mt-auto">
                                <a href="{{ route('public.mascotas.index') }}" class="btn-adoptar">
                                    <i class="fas fa-heart me-2"></i> Quiero Adoptar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Agrega más mascotas de ejemplo aquí -->
            @endif
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('public.mascotas.index') }}" class="btn-primary-custom">
                Ver Todas las Mascotas
            </a>
        </div>
    </div>
</section>