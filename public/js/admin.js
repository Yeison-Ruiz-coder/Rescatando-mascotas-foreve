document.addEventListener('DOMContentLoaded', function() {
    // Elementos
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const sideMenu = document.getElementById('sideMenu');
    const closeMenu = document.getElementById('closeMenu');
    const menuOverlay = document.getElementById('menuOverlay');
    const mainContent = document.getElementById('mainContent');

    // Verificar que los elementos existen
    if (!hamburgerBtn || !sideMenu) return;

    // Abrir menú - AHORA CON ANIMACIÓN DEL BOTÓN
    hamburgerBtn.addEventListener('click', function() {
        // Toggle la clase 'open' en el botón para la animación
        this.classList.toggle('open');
        sideMenu.classList.toggle('open');

        if (menuOverlay) {
            menuOverlay.classList.toggle('active');
        }

        if (mainContent) {
            mainContent.classList.toggle('shifted');
        }

        // Prevenir scroll cuando el menú está abierto
        if (sideMenu.classList.contains('open')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    });

    // Cerrar menú - FUNCIÓN MEJORADA
    function closeMenuFunction() {
        hamburgerBtn.classList.remove('open'); // IMPORTANTE: quitar la clase del botón
        sideMenu.classList.remove('open');

        if (menuOverlay) {
            menuOverlay.classList.remove('active');
        }

        if (mainContent) {
            mainContent.classList.remove('shifted');
        }

        document.body.style.overflow = '';
    }

    // Solo agregar event listeners si los elementos existen
    if (closeMenu) {
        closeMenu.addEventListener('click', closeMenuFunction);
    }

    if (menuOverlay) {
        menuOverlay.addEventListener('click', closeMenuFunction);
    }

    // Submenús - VERSIÓN MEJORADA
    const menuItems = document.querySelectorAll('.menu-item.has-submenu');

    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); // Evita propagación

            const section = this.closest('.menu-section');
            if (!section) return;

            const submenu = section.querySelector('.submenu');
            if (!submenu) return;

            // Cerrar otros submenús (opcional - comentar si no quieres este comportamiento)
            document.querySelectorAll('.menu-section').forEach(s => {
                if (s !== section && s.classList.contains('open')) {
                    s.classList.remove('open');
                    const otherSubmenu = s.querySelector('.submenu');
                    if (otherSubmenu) {
                        otherSubmenu.classList.remove('open');
                    }
                }
            });

            // Abrir/cerrar este
            section.classList.toggle('open');
            submenu.classList.toggle('open');

            // Rotar flecha con CSS en lugar de JS
            const arrow = this.querySelector('.arrow');
            if (arrow) {
                arrow.style.transform = section.classList.contains('open') ? 'rotate(90deg)' : '';
            }
        });
    });

    // Búsqueda en el menú - VERSIÓN OPTIMIZADA
    const searchInput = document.getElementById('menuSearch');

    if (searchInput) {
        let searchTimeout;

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);

            searchTimeout = setTimeout(() => {
                const searchTerm = this.value.toLowerCase().trim();

                document.querySelectorAll('.menu-section').forEach(section => {
                    let sectionHasVisibleItems = false;
                    const menuItem = section.querySelector('.menu-item');

                    // Buscar en items del menú principal
                    if (menuItem) {
                        const menuText = menuItem.textContent.toLowerCase();
                        if (menuText.includes(searchTerm)) {
                            sectionHasVisibleItems = true;
                        }
                    }

                    // Buscar en submenús
                    section.querySelectorAll('.submenu-item').forEach(item => {
                        const itemText = item.textContent.toLowerCase();
                        if (itemText.includes(searchTerm)) {
                            item.style.display = 'flex';
                            sectionHasVisibleItems = true;
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    // Mostrar/ocultar sección completa
                    section.style.display = sectionHasVisibleItems ? 'block' : 'none';
                });

                // Si la búsqueda está vacía, restaurar todo
                if (searchTerm === '') {
                    document.querySelectorAll('.menu-section').forEach(section => {
                        section.style.display = 'block';
                    });
                    document.querySelectorAll('.submenu-item').forEach(item => {
                        item.style.display = 'flex';
                    });
                }
            }, 300); // Debounce para mejor rendimiento
        });
    }

    // Cerrar menú al hacer click en un enlace (solo en móvil)
    const menuLinks = document.querySelectorAll('.menu-item:not(.has-submenu), .submenu-item');

    menuLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 768 && sideMenu.classList.contains('open')) {
                closeMenuFunction();
            }
        });
    });

    // Cerrar menú con tecla ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && sideMenu.classList.contains('open')) {
            closeMenuFunction();
        }
    });

    // Ajustar main content cuando se redimensiona la ventana
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            if (window.innerWidth > 768 && sideMenu.classList.contains('open')) {
                // En desktop, mantener el menú abierto pero ajustar contenido
                if (mainContent) {
                    mainContent.style.marginLeft = '320px';
                }
            } else if (window.innerWidth <= 768 && sideMenu.classList.contains('open')) {
                // En móvil, resetear el margin
                if (mainContent) {
                    mainContent.style.marginLeft = '';
                }
            }
        }, 250);
    });
});
