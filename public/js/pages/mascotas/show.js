function cambiarFotoPrincipal(rutaImagen, index) {
    // Cambiar la foto principal
    document.getElementById('foto-principal').src = rutaImagen;

    // Actualizar miniaturas activas
    document.querySelectorAll('.gallery-thumbnail').forEach(thumb => {
        thumb.classList.remove('active');
    });
    document.querySelectorAll('.gallery-thumbnail')[index].classList.add('active');
}

// Actualizar contador en el modal
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('carouselGaleria');
    if (carousel) {
        carousel.addEventListener('slid.bs.carousel', function(e) {
            const activeIndex = e.to;
            document.getElementById('current-photo').textContent = activeIndex + 1;
        });
    }
});