// JavaScript para el menú hamburguesa responsive con prefijos
class ResponsiveHeader {
    constructor() {
        this.init();
    }

    init() {
        this.setupMobileMenu();
        this.setupTouchEvents();
        this.setupResizeHandler();
        this.setupAccessibility();
    }

    setupMobileMenu() {
        // Elementos del menú móvil con prefijos
        this.hamburgerBtn = document.querySelector('.am-hamburger');
        this.mobileMenuOverlay = document.querySelector('.am-mobile-overlay');
        this.closeMobileMenu = document.querySelector('.am-close-mobile-menu');
        this.mobileMenuTrigger = document.querySelector('.am-mobile-trigger');
        this.body = document.body;

        // Event listeners para abrir menú
        [this.hamburgerBtn, this.mobileMenuTrigger].forEach(btn => {
            if (btn) {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.openMobileMenu();
                });
            }
        });

        // Event listener para cerrar menú
        if (this.closeMobileMenu) {
            this.closeMobileMenu.addEventListener('click', () => {
                this.closeMobileMenuHandler();
            });
        }

        // Cerrar menú al hacer clic fuera
        if (this.mobileMenuOverlay) {
            this.mobileMenuOverlay.addEventListener('click', (e) => {
                if (e.target === this.mobileMenuOverlay) {
                    this.closeMobileMenuHandler();
                }
            });
        }

        // Cerrar menú con Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.mobileMenuOverlay?.classList.contains('am-active')) {
                this.closeMobileMenuHandler();
            }
        });

        // Cerrar menú al hacer clic en enlaces
        const mobileLinks = document.querySelectorAll('.am-mobile-nav-link, .am-submenu-link, .am-mobile-report-btn');
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                this.closeMobileMenuHandler();
            });
        });
    }

    setupTouchEvents() {
        // Mejorar feedback táctil en dispositivos móviles
        const touchElements = document.querySelectorAll('.am-mobile-nav-item, .am-mobile-nav-link, .am-submenu-link');
       
        touchElements.forEach(element => {
            element.addEventListener('touchstart', () => {
                element.classList.add('am-touch-active');
            }, { passive: true });

            element.addEventListener('touchend', () => {
                setTimeout(() => {
                    element.classList.remove('am-touch-active');
                }, 150);
            }, { passive: true });
        });
    }

    setupResizeHandler() {
        // Cerrar menú móvil al cambiar a desktop
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                if (window.innerWidth >= 768 && this.mobileMenuOverlay?.classList.contains('am-active')) {
                    this.closeMobileMenuHandler();
                }
            }, 100);
        });
    }

    setupAccessibility() {
        // Mejorar accesibilidad
        this.updateAriaAttributes();

        // Navegación por teclado en menú móvil
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Tab' && this.mobileMenuOverlay?.classList.contains('am-active')) {
                this.handleMobileMenuKeyboardNav(e);
            }
        });
    }

    openMobileMenu() {
        if (this.mobileMenuOverlay && this.hamburgerBtn) {
            this.mobileMenuOverlay.classList.add('am-active');
            this.hamburgerBtn.classList.add('am-active');
            this.body.classList.add('am-no-scroll');
            this.updateAriaAttributes(true);
           
            // Enfocar primer elemento del menú
            setTimeout(() => {
                const firstLink = this.mobileMenuOverlay.querySelector('.am-mobile-nav-link');
                firstLink?.focus();
            }, 100);
        }
    }

    closeMobileMenuHandler() {
        if (this.mobileMenuOverlay && this.hamburgerBtn) {
            this.mobileMenuOverlay.classList.remove('am-active');
            this.hamburgerBtn.classList.remove('am-active');
            this.body.classList.remove('am-no-scroll');
            this.updateAriaAttributes(false);
           
            // Devolver foco al botón que abrió el menú
            this.hamburgerBtn.focus();
        }
    }

    updateAriaAttributes(menuOpen = false) {
        if (this.hamburgerBtn) {
            this.hamburgerBtn.setAttribute('aria-expanded', menuOpen);
            this.hamburgerBtn.setAttribute('aria-label',
                menuOpen ? 'Cerrar menú de navegación' : 'Abrir menú de navegación');
        }

        if (this.mobileMenuOverlay) {
            this.mobileMenuOverlay.setAttribute('aria-hidden', !menuOpen);
        }
    }

    handleMobileMenuKeyboardNav(e) {
        const focusableElements = this.mobileMenuOverlay?.querySelectorAll(
            'a, button, input, select, textarea, [tabindex]:not([tabindex="-1"])'
        );
       
        if (!focusableElements || focusableElements.length === 0) return;

        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];

        if (e.shiftKey && document.activeElement === firstElement) {
            e.preventDefault();
            lastElement.focus();
        } else if (!e.shiftKey && document.activeElement === lastElement) {
            e.preventDefault();
            firstElement.focus();
        }
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    new ResponsiveHeader();
   
    // Inicializar modales de Bootstrap
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.addEventListener('shown.bs.modal', () => {
            const input = modal.querySelector('input');
            input?.focus();
        });
    });

    // Detectar dispositivo táctil
    if ('ontouchstart' in window || navigator.maxTouchPoints > 0) {
        document.body.classList.add('am-touch-device');
    }
});

// Manejo de formularios (opcional)
const loginForm = document.getElementById('loginForm');
const registerForm = document.getElementById('registerForm');

if (loginForm) {
    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        // Aquí tu lógica de login
        console.log('Login submitted');
    });
}

if (registerForm) {
    registerForm.addEventListener('submit', (e) => {
        e.preventDefault();
        // Aquí tu lógica de registro
        console.log('Register submitted');
    });
}

// Prevenir que los dropdowns se cierren al hacer clic dentro (para desktop)
document.addEventListener('DOMContentLoaded', () => {
    const dropdowns = document.querySelectorAll('.am-glass-dropdown');
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
   
    // --- 1. Lógica del Menú Hamburguesa ---
    const menuToggle = document.querySelector('.am-mobile-toggle');
    const hamburger = document.querySelector('.am-hamburger');
    const navContainer = document.querySelector('.am-nav-container');

    if (menuToggle && hamburger && navContainer) {
        menuToggle.addEventListener('click', function() {
            // Alterna la clase 'am-active' en el ícono hamburguesa (para el efecto de X)
            hamburger.classList.toggle('am-active');
           
            // Alterna la clase 'am-active' en el contenedor de los enlaces para MOSTRAR/OCULTAR el menú
            navContainer.classList.toggle('am-active');

            // Actualiza el estado ARIA para accesibilidad
            const isExpanded = navContainer.classList.contains('am-active');
            menuToggle.setAttribute('aria-expanded', isExpanded);
        });
    }

    // --- 2. Lógica del Scroll para el Header (Efecto Glassmorphism) ---
    const glassHeader = document.querySelector('.am-glass-header');
   
    if (glassHeader) {
        window.addEventListener('scroll', function() {
            // Añade la clase 'am-scrolled' cuando el usuario se desplaza más de 50px
            if (window.scrollY > 50) {
                glassHeader.classList.add('am-scrolled');
            } else {
                glassHeader.classList.remove('am-scrolled');
            }
        });
    }

    // --- 3. Lógica para cerrar el menú al hacer clic en un enlace (Opcional) ---
    const navLinks = document.querySelectorAll('.am-nav-links a');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Asegúrate de que el menú solo se cierre si está abierto en móvil (activo)
            if (navContainer.classList.contains('am-active')) {
                navContainer.classList.remove('am-active');
                hamburger.classList.remove('am-active');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        });
    });

    // --- 4. Lógica para dropdowns del submenú ---
    const subItems = document.querySelectorAll('.am-sub-item');
    subItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            const dropdown = this.querySelector('.am-glass-dropdown');
            if (dropdown) {
                dropdown.style.opacity = '1';
                dropdown.style.visibility = 'visible';
                dropdown.style.transform = 'translateY(8px)';
            }
        });

        item.addEventListener('mouseleave', function() {
            const dropdown = this.querySelector('.am-glass-dropdown');
            if (dropdown) {
                dropdown.style.opacity = '0';
                dropdown.style.visibility = 'hidden';
                dropdown.style.transform = 'translateY(15px)';
            }
        });
    });

    // --- 5. Efectos hover mejorados para elementos interactivos ---
    const interactiveElements = document.querySelectorAll('.am-nav-link, .am-sub-link, .am-user-container');
    interactiveElements.forEach(element => {
        element.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
        });

        element.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // --- 6. Animación de carga para botones ---
    const glassButtons = document.querySelectorAll('.am-btn-glass');
    glassButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Agregar efecto de carga
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Procesando...';
            this.disabled = true;

            // Restaurar después de 2 segundos (simulación)
            setTimeout(() => {
                this.innerHTML = originalText;
                this.disabled = false;
            }, 2000);
        });
    });
});

// --- 7. Funciones utilitarias adicionales ---
const AMNavbarUtils = {
    // Detectar si es dispositivo móvil
    isMobileDevice: function() {
        return window.innerWidth <= 768;
    },

    // Cerrar todos los menús dropdown
    closeAllDropdowns: function() {
        const dropdowns = document.querySelectorAll('.am-glass-dropdown');
        dropdowns.forEach(dropdown => {
            dropdown.style.opacity = '0';
            dropdown.style.visibility = 'hidden';
            dropdown.style.transform = 'translateY(15px)';
        });
    },

    // Toggle modo oscuro/claro (si lo implementas)
    toggleTheme: function() {
        document.body.classList.toggle('am-dark-theme');
        localStorage.setItem('am-theme', 
            document.body.classList.contains('am-dark-theme') ? 'dark' : 'light'
        );
    },

    // Inicializar tema guardado
    initTheme: function() {
        const savedTheme = localStorage.getItem('am-theme');
        if (savedTheme === 'dark') {
            document.body.classList.add('am-dark-theme');
        }
    }
};

// Inicializar utilidades cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    AMNavbarUtils.initTheme();
});

// Exportar para uso global (si es necesario)
window.AMNavbarUtils = AMNavbarUtils;

