<div class="col-xl-4 col-lg-6 mb-4">
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
            
            <!-- Botón -->
            <a href="{{ route('public.mascotas.show', $mascota->id) }}" 
               class="btn-conocer-mas">
               <i class="fas fa-heart me-2"></i>Conocer a {{ $mascota->Nombre_mascota }}
            </a>
        </div>
    </div>
</div>