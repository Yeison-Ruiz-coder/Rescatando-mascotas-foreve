<!-- Imagen principal -->
<div class="card mb-4">
    <div class="card-body p-0">
        @if($mascota->foto_principal)
        <img src="{{ Storage::url($mascota->foto_principal) }}"
             class="gallery-main-img w-100"
             alt="{{ $mascota->nombre_mascota }}"
             id="imagenPrincipal"
             style="max-height: 400px; object-fit: cover;">
        @else
        <div class="d-flex align-items-center justify-content-center bg-light"
             style="height: 400px;">
            <i class="fas fa-paw fa-5x text-secondary opacity-50"></i>
        </div>
        @endif
    </div>
</div>

<!-- Galería de fotos -->
@if($mascota->galeria_fotos && count($mascota->galeria_fotos) > 0)
<div class="card mb-4">
    <div class="card-header bg-turquesa text-white">
        <h6 class="mb-0"><i class="fas fa-images me-2"></i>Más Fotos</h6>
    </div>
    <div class="card-body">
        <div class="row g-2">
            @foreach($mascota->galeria_fotos as $index => $foto)
            <div class="col-4">
                <div class="thumbnail-container" style="cursor: pointer;">
                    <img src="{{ Storage::url($foto) }}"
                         class="gallery-thumbnail img-thumbnail w-100"
                         alt="Foto {{ $index + 1 }}"
                         style="height: 100px; object-fit: cover;"
                         onclick="cambiarImagenPrincipal('{{ Storage::url($foto) }}', this)">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<script>
function cambiarImagenPrincipal(nuevaSrc, elemento) {
    // Cambiar la imagen principal
    const imgPrincipal = document.getElementById('imagenPrincipal');
    if (imgPrincipal) {
        imgPrincipal.src = nuevaSrc;
    } else {
        // Si no hay imagen principal, crear una
        const contenedor = document.querySelector('.card-body.p-0');
        if (contenedor) {
            contenedor.innerHTML = `<img src="${nuevaSrc}" class="gallery-main-img w-100" alt="Imagen principal" id="imagenPrincipal" style="max-height: 400px; object-fit: cover;">`;
        }
    }

    // Remover la clase active de todas las miniaturas
    document.querySelectorAll('.gallery-thumbnail').forEach(thumb => {
        thumb.classList.remove('active', 'border', 'border-3', 'border-primary');
    });

    // Agregar la clase active a la miniatura clickeada
    elemento.classList.add('active', 'border', 'border-3', 'border-primary');
}
</script>

<style>
.gallery-thumbnail.active {
    opacity: 0.8;
}
</style>
