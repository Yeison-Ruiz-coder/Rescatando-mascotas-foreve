<!-- Mascotas Section -->
<section id="mascotas" class="adopta-section">
    <div class="container">
        <h2 class="section-title">Mascotas Disponibles para Adoptar</h2>
        <p class="section-subtitle">Conoce a nuestros amigos que buscan un hogar lleno de amor y cuidado.</p>
        
        <div class="row g-4">
            @if(isset($mascotasRecientes) && $mascotasRecientes->count() > 0)
                @foreach($mascotasRecientes as $mascota)
                <div class="col-xl-4 col-lg-6 mb-4 animate-fade-in-up">
                    <div class="card-mascota-moderna">
                        <!-- Imagen con overlay -->
                        <div class="card-imagen-container">
                            @if($mascota->Foto)
                            <img src="{{ asset('storage/' . $mascota->Foto) }}" 
                                 alt="{{ $mascota->Nombre_mascota }}">
                            @else
                            <div class="w-100 h-100 bg-gris-claro d-flex align-items-center justify-content-center">
                                <i class="fas fa-paw fa-4x text-turquesa opacity-50"></i>
                            </div>
                            @endif
                            <div class="overlay-mascota"></div>
                            
                            <!-- Badges flotantes -->
                            <div class="badges-container">
                                <span class="badge-moderno badge-especie-moderno">
                                    {{ $mascota->Especie }}
                                </span>
                                <span class="badge-moderno badge-genero-moderno">
                                    {{ $mascota->Genero }}
                                </span>
                                <span class="badge-moderno badge-edad-moderno">
                                    {{ $mascota->Edad_aprox }} años
                                </span>
                            </div>
                        </div>
                        
                        <!-- Contenido -->
                        <div class="card-body-moderno">
                            <h3 class="nombre-mascota">{{ $mascota->Nombre_mascota }}</h3>
                            
                            <p class="descripcion-mascota">
                                {{ Str::limit($mascota->Descripcion, 150) }}
                            </p>
                            
                            <!-- Información de fundación -->
                            @if($mascota->fundacion)
                            <div class="info-fundacion">
                                <i class="fas fa-home"></i>
                                <span>Rescatado por: {{ $mascota->fundacion->Nombre_1 }}</span>
                            </div>
                            @endif
                            
                            <!-- Botones -->
                            <div class="d-flex gap-2">
                                <a href="{{ route('public.mascotas.show', $mascota->id) }}" 
                                   class="btn-conocer-mas flex-fill">
                                   <i class="fas fa-heart me-2"></i>Conocer más
                                </a>
                                <a href="{{ route('public.adopciones.solicitar', $mascota->id) }}" 
                                   class="btn-adoptar-home">
                                   <i class="fas fa-home me-2"></i>Adoptar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <!-- Mascotas de ejemplo (cuando no hay datos) -->
                <div class="col-xl-4 col-lg-6 mb-4 animate-fade-in-up">
                    <div class="card-mascota-moderna">
                        <div class="card-imagen-container">
                            <img src="https://images.unsplash.com/photo-1558788353-f76d92427f16?w=400&h=300&fit=crop" 
                                 alt="Rocky">
                            <div class="overlay-mascota"></div>
                            <div class="badges-container">
                                <span class="badge-moderno badge-especie-moderno">Perro</span>
                                <span class="badge-moderno badge-genero-moderno">Macho</span>
                                <span class="badge-moderno badge-edad-moderno">2 años</span>
                            </div>
                        </div>
                        <div class="card-body-moderno">
                            <h3 class="nombre-mascota">Rocky</h3>
                            <p class="descripcion-mascota">
                                Perro juguetón y muy cariñoso. Perfecto para familias activas. Le encanta correr y jugar en el parque.
                            </p>
                            <div class="info-fundacion">
                                <i class="fas fa-home"></i>
                                <span>Rescatado por: Fundación Amigos Peludos</span>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn-conocer-mas flex-fill">
                                    <i class="fas fa-heart me-2"></i>Conocer más
                                </a>
                                <a href="#" class="btn-adoptar-home">
                                    <i class="fas fa-home me-2"></i>Adoptar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Segunda mascota de ejemplo -->
                <div class="col-xl-4 col-lg-6 mb-4 animate-fade-in-up">
                    <div class="card-mascota-moderna">
                        <div class="card-imagen-container">
                            <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=400&h=300&fit=crop" 
                                 alt="Luna">
                            <div class="overlay-mascota"></div>
                            <div class="badges-container">
                                <span class="badge-moderno badge-especie-moderno">Gato</span>
                                <span class="badge-moderno badge-genero-moderno">Hembra</span>
                                <span class="badge-moderno badge-edad-moderno">1 año</span>
                            </div>
                        </div>
                        <div class="card-body-moderno">
                            <h3 class="nombre-mascota">Luna</h3>
                            <p class="descripcion-mascota">
                                Gatita tranquila y cariñosa. Ideal para apartamentos. Le gusta dormir en lugares cálidos y acurrucarse.
                            </p>
                            <div class="info-fundacion">
                                <i class="fas fa-home"></i>
                                <span>Rescatado por: Refugio Felino</span>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn-conocer-mas flex-fill">
                                    <i class="fas fa-heart me-2"></i>Conocer más
                                </a>
                                <a href="#" class="btn-adoptar-home">
                                    <i class="fas fa-home me-2"></i>Adoptar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('public.mascotas.index') }}" class="btn-primary-custom">
                Ver Todas las Mascotas
            </a>
        </div>
    </div>
</section>