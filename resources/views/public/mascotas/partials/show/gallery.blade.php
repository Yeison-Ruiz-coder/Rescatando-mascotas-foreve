<!-- Imagen principal -->
<div class="card card-mascota mb-4">
    <div class="card-body p-0">
        @if($mascota->Foto)
        <img src="{{ asset('storage/' . $mascota->Foto) }}" 
             class="img-fluid imagen-principal w-100" 
             alt="{{ $mascota->Nombre_mascota }}"
             id="imagenPrincipal">
        @else
        <div class="d-flex align-items-center justify-content-center bg-gris-claro" 
             style="height: 400px;">
            <i class="fas fa-paw fa-5x text-turquesa opacity-50"></i>
        </div>
        @endif
    </div>
</div>

<!-- Galería de fotos -->
@if($mascota->galeria_fotos && count($mascota->galeria_fotos) > 0)
<div class="card card-mascota mb-4">
    <div class="card-header card-header-turquesa">
        <h6 class="mb-0"><i class="fas fa-images me-2"></i>Más Fotos</h6>
    </div>
    <div class="card-body">
        <div class="row g-2">
            @foreach($mascota->galeria_fotos as $foto)
            <div class="col-4">
                <img src="{{ asset('storage/' . $foto['ruta']) }}" 
                     class="gallery-thumb" 
                     alt="{{ $foto['titulo'] ?? 'Foto' }}"
                     onclick="cambiarImagenPrincipal('{{ asset('storage/' . $foto['ruta']) }}')">
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif