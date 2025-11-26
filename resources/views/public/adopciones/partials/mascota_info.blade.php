<div class="info-mascota-solicitud animacion-entrada">
    <div class="row align-items-center">
        <div class="col-md-3 text-center mb-3 mb-md-0">
            @if($mascota->Foto)
            <img src="{{ asset('storage/' . $mascota->Foto) }}" 
                 class="foto-mascota-solicitud" 
                 alt="{{ $mascota->Nombre_mascota }}">
            @else
            <div class="placeholder-foto-mascota">
                <i class="fas fa-paw"></i>
            </div>
            @endif
        </div>
        <div class="col-md-9">
            <h4 class="nombre-mascota-solicitud">{{ $mascota->Nombre_mascota }}</h4>
            <div class="mb-3">
                <span class="badge badge-especie me-1">{{ $mascota->Especie }}</span>
                <span class="badge badge-genero me-1">{{ $mascota->Genero }}</span>
                <span class="badge badge-edad">{{ $mascota->Edad_aprox }} años</span>
            </div>
            <p class="text-muted mb-0">
                <i class="fas fa-quote-left me-1 text-turquesa"></i>
                {{ Str::limit($mascota->Descripcion, 200) }}
            </p>
        </div>
    </div>
</div>