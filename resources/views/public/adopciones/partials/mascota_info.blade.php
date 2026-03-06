<div class="info-mascota-solicitud animacion-entrada">
    <div class="row align-items-center">
        <div class="col-md-3 text-center mb-3 mb-md-0">
            @if($mascota->foto_principal)
            <img src="{{ Storage::url($mascota->foto_principal) }}"
                 class="foto-mascota-solicitud"
                 alt="{{ $mascota->nombre_mascota }}">
            @else
            <div class="placeholder-foto-mascota">
                <i class="fas fa-paw"></i>
            </div>
            @endif
        </div>
        <div class="col-md-9">
            <h4 class="nombre-mascota-solicitud">{{ $mascota->nombre_mascota }}</h4>
            <div class="mb-3">
                <span class="badge badge-especie me-1">{{ $mascota->especie ?? 'No especificada' }}</span>
                <span class="badge badge-genero me-1">{{ $mascota->genero ?? 'No especificado' }}</span>
                <span class="badge badge-edad">{{ $mascota->edad_aprox ?? '?' }} años</span>

                <!-- Mostrar razas si existen -->
                @if($mascota->razas && $mascota->razas->count() > 0)
                    <span class="badge bg-secondary me-1">
                        @foreach($mascota->razas as $raza)
                            {{ $raza->nombre_raza }}@if(!$loop->last), @endif
                        @endforeach
                    </span>
                @endif
            </div>
            <p class="text-muted mb-0">
                <i class="fas fa-quote-left me-1 text-turquesa"></i>
                {{ Str::limit($mascota->descripcion ?? 'Sin descripción disponible', 200) }}
            </p>
        </div>
    </div>
</div>
