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
                            @if(isset($mascota->foto_principal) && $mascota->foto_principal)
                                <img src="{{ asset('storage/' . $mascota->foto_principal) }}"
                                     alt="{{ $mascota->nombre_mascota }}">
                            @elseif(isset($mascota->Foto) && $mascota->Foto)
                                {{-- Por compatibilidad con datos demo --}}
                                <img src="{{ asset('storage/' . $mascota->Foto) }}"
                                     alt="{{ $mascota->nombre_mascota ?? $mascota->Nombre_mascota ?? 'Mascota' }}">
                            @else
                                <div class="w-100 h-100 bg-gris-claro d-flex align-items-center justify-content-center">
                                    <i class="fas fa-paw fa-4x text-turquesa opacity-50"></i>
                                </div>
                            @endif
                            <div class="overlay-mascota"></div>

                            <!-- Badges flotantes -->
                            <div class="badges-container">
                                <span class="badge-moderno badge-especie-moderno">
                                    {{ $mascota->especie ?? $mascota->Especie ?? 'Mascota' }}
                                </span>
                                <span class="badge-moderno badge-genero-moderno">
                                    {{ $mascota->genero ?? $mascota->Genero ?? 'N/A' }}
                                </span>
                                <span class="badge-moderno badge-edad-moderno">
                                    {{ $mascota->edad_aprox ?? $mascota->Edad_aprox ?? '?' }} años
                                </span>
                            </div>
                        </div>

                        <!-- Contenido -->
                        <div class="card-body-moderno">
                            <h3 class="nombre-mascota">{{ $mascota->nombre_mascota ?? $mascota->Nombre_mascota ?? 'Mascota' }}</h3>

                            <p class="descripcion-mascota">
                                {{ Str::limit($mascota->descripcion ?? $mascota->Descripcion ?? 'Sin descripción disponible', 150) }}
                            </p>

                            <!-- Información de fundación -->
                            @if(isset($mascota->fundacion))
                                <div class="info-fundacion">
                                    <i class="fas fa-home"></i>
                                    <span>Rescatado por: {{ $mascota->fundacion->Nombre_1 ?? 'Fundación' }}</span>
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
                <!-- Mensaje cuando no hay mascotas -->
                <div class="col-12 text-center">
                    <p class="lead">Pronto tendremos mascotas disponibles para adopción.</p>
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
