<!-- Imagen principal -->
<div class="card mb-4">
    <div class="card-body p-0">
        @if($mascota->Foto)
        <img src="{{ asset('storage/' . $mascota->Foto) }}" 
             class="gallery-main-img w-100" 
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
<div class="card mb-4">
    <div class="card-header">
        <h6 class="mb-0 text-white"><i class="fas fa-images me-2"></i>Más Fotos</h6>
    </div>
    <div class="card-body">
        <div class="row g-2">
            @foreach($mascota->galeria_fotos as $foto)
            <div class="col-4">
                <div class="thumbnail-container">
                    <img src="{{ asset('storage/' . $foto['ruta']) }}" 
                         class="gallery-thumbnail" 
                         alt="{{ $foto['titulo'] ?? 'Foto' }}"
                         onclick="cambiarImagenPrincipal('{{ asset('storage/' . $foto['ruta']) }}', this)">
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
    document.getElementById('imagenPrincipal').src = nuevaSrc;
    
    // Remover la clase active de todas las miniaturas
    document.querySelectorAll('.gallery-thumbnail').forEach(thumb => {
        thumb.classList.remove('active');
    });
    
    // Agregar la clase active a la miniatura clickeada
    elemento.classList.add('active');
}
</script>