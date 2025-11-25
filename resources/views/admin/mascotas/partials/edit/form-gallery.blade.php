<!-- Galería de Fotos -->
<div class="col-12">
    <label class="form-label">
        Galería de Fotos (Máximo 3 imágenes)
    </label>
    <div class="gallery-upload-container">
        <input type="file" class="form-control form-control-custom" id="fotos"
            name="fotos[]" multiple accept="image/*" max="3" onchange="previewGalleryImages(this)">
        <div class="form-help">
            <i class="fas fa-info-circle"></i> Puedes seleccionar hasta 3 imágenes adicionales para la galería
        </div>

        <!-- Preview de nuevas imágenes -->
        <div class="gallery-preview" id="galleryPreview"></div>

        <!-- Mostrar galería actual -->
    </div>
</div>

<script>
function previewGalleryImages(input) {
    const previewContainer = document.getElementById('galleryPreview');
    previewContainer.innerHTML = '';

    if (input.files && input.files.length > 0) {
        const files = Array.from(input.files).slice(0, 3); // Máximo 3 imágenes
        
        files.forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'gallery-preview-item fade-in';
                    previewItem.innerHTML = `
                        <img src="${e.target.result}" alt="Preview ${index + 1}">
                        <button type="button" class="remove-gallery-image" onclick="removeGalleryPreview(this)">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                    previewContainer.appendChild(previewItem);
                };
                
                reader.readAsDataURL(file);
            }
        });
    }
}

function removeGalleryPreview(button) {
    const previewItem = button.closest('.gallery-preview-item');
    previewItem.remove();
    
    // Actualizar el input file para reflejar los cambios
    updateFileInput();
}

function updateFileInput() {
    // Esta función podría implementarse para sincronizar el preview con el input file
    // usando DataTransfer API si necesitas una sincronización exacta
}
</script>