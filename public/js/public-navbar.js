// assets/js/public-navbar.js

document.addEventListener('DOMContentLoaded', function() {
    const publicHamburger = document.getElementById('publicHamburgerBtn');
    const publicSidebar = document.getElementById('publicSidebar');
    const publicOverlay = document.getElementById('publicSidebarOverlay');
    const publicCloseBtn = document.getElementById('publicSidebarClose');
    const publicMainContent = document.querySelector('.public-main-content');

    // Función para abrir sidebar
    function openPublicSidebar() {
        publicSidebar.classList.add('open');
        publicOverlay.classList.add('active');
        publicHamburger.classList.add('open');
        publicMainContent.classList.add('shifted');
        document.body.style.overflow = 'hidden'; // Prevenir scroll
    }

    // Función para cerrar sidebar
    function closePublicSidebar() {
        publicSidebar.classList.remove('open');
        publicOverlay.classList.remove('active');
        publicHamburger.classList.remove('open');
        publicMainContent.classList.remove('shifted');
        document.body.style.overflow = ''; // Restaurar scroll
    }

    // Event listeners
    if (publicHamburger) {
        publicHamburger.addEventListener('click', openPublicSidebar);
    }

    if (publicCloseBtn) {
        publicCloseBtn.addEventListener('click', closePublicSidebar);
    }

    if (publicOverlay) {
        publicOverlay.addEventListener('click', closePublicSidebar);
    }

    // Cerrar con tecla ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && publicSidebar.classList.contains('open')) {
            closePublicSidebar();
        }
    });

    // Manejo de submenús (si los hay)
    const publicMenuItems = document.querySelectorAll('.public-sidebar-item.has-submenu');
    
    publicMenuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const submenu = this.nextElementSibling;
            if (submenu && submenu.classList.contains('public-sidebar-submenu')) {
                this.classList.toggle('open');
                submenu.classList.toggle('open');
            }
        });
    });
});