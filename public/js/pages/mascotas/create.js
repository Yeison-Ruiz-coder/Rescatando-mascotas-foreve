// Preview de múltiples imágenes al seleccionar
document.getElementById('fotos').addEventListener('change', function(e) {
    const preview = document.getElementById('preview-galeria');
    preview.innerHTML = '';

    if (e.target.files.length > 0) {
        const previewTitle = document.createElement('div');
        previewTitle.className = 'preview-title';
        previewTitle.innerHTML = `<small>Vista previa (${e.target.files.length} foto(s) seleccionada(s)):</small>`;
        preview.appendChild(previewTitle);

        const previewRow = document.createElement('div');
        previewRow.className = 'row g-2';
        preview.appendChild(previewRow);

        Array.from(e.target.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-4 col-md-3';
                col.innerHTML = `
                    <div class="preview-item position-relative">
                        <img src="${e.target.result}" 
                             class="preview-image" 
                             alt="Vista previa ${index + 1}">
                        ${index === 0 ? '<span class="preview-badge">Principal</span>' : ''}
                        <div class="preview-info">Foto ${index + 1}</div>
                    </div>
                `;
                previewRow.appendChild(col);
            }
            reader.readAsDataURL(file);
        });
    }
});

// Validación básica de imagen
document.getElementById('fotos').addEventListener('change', function(e) {
    const files = e.target.files;
    Array.from(files).forEach((file, index) => {
        // Validar tamaño
        if (file.size > 2 * 1024 * 1024) {
            alert(`La imagen "${file.name}" es demasiado grande. Máximo 2MB permitido.`);
            e.target.value = '';
            return;
        }

        // Validar tipo
        if (!file.type.match('image.*')) {
            alert(`"${file.name}" no es una imagen válida.`);
            e.target.value = '';
            return;
        }
    });
});