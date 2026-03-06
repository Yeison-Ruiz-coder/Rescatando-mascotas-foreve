<!-- Imagen principal -->
<div class="card card-mascota mb-4">
    <div class="card-body p-0">
        @if($mascota->foto_principal)
        <img src="{{ Storage::url($mascota->foto_principal) }}"
             class="img-fluid imagen-principal w-100"
             alt="{{ $mascota->nombre_mascota }}"
             id="imagenPrincipal"
             style="max-height: 400px; object-fit: cover;">
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
            @foreach($mascota->galeria_fotos as $index => $foto)
            <div class="col-4">
                <img src="{{ Storage::url($foto) }}"
                     class="gallery-thumb img-thumbnail"
                     alt="Foto {{ $index + 1 }}"
                     style="height: 100px; width: 100%; object-fit: cover; cursor: pointer;"
                     onclick="cambiarImagenPrincipal('{{ Storage::url($foto) }}')">
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<script>
function cambiarImagenPrincipal(nuevaSrc) {
    const imgPrincipal = document.getElementById('imagenPrincipal');
    if (imgPrincipal) {
        imgPrincipal.src = nuevaSrc;
    }
}
</script>
