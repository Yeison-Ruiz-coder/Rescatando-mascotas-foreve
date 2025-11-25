function cambiarImagenPrincipal(nuevaSrc) {
    const imagenPrincipal = document.getElementById('imagenPrincipal');
    if (imagenPrincipal) {
        imagenPrincipal.style.opacity = '0.7';
        
        setTimeout(() => {
            imagenPrincipal.src = nuevaSrc;
            imagenPrincipal.style.opacity = '1';
        }, 200);
    }
}

// Efecto hover para imágenes
document.addEventListener('DOMContentLoaded', function() {
    const imagenPrincipal = document.getElementById('imagenPrincipal');
    if (imagenPrincipal) {
        imagenPrincipal.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.02)';
        });
        
        imagenPrincipal.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    }
});