// public/js/pages/solicitud/edit.js

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.solicitud-form');
    const contenido = document.getElementById('contenido');
    const submitBtn = document.querySelector('.btn-submit');

    // Contador de caracteres para el textarea
    function createCharacterCounter() {
        const counter = document.createElement('div');
        counter.className = 'character-counter';
        counter.style.cssText = `
            text-align: right;
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 0.5rem;
        `;
        
        contenido.parentNode.appendChild(counter);
        
        function updateCounter() {
            const length = contenido.value.length;
            counter.textContent = `${length} caracteres`;
            
            if (length < 10) {
                counter.style.color = '#dc3545';
            } else if (length < 50) {
                counter.style.color = '#ffc107';
            } else {
                counter.style.color = '#28a745';
            }
        }
        
        contenido.addEventListener('input', updateCounter);
        updateCounter(); // Inicializar
    }

    if (contenido) {
        createCharacterCounter();
    }

    // Validación mejorada del formulario
    if (form) {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            const errors = [];
            
            // Validar contenido
            if (contenido.value.trim().length < 10) {
                isValid = false;
                errors.push('El contenido debe tener al menos 10 caracteres.');
                contenido.focus();
            }
            
            // Validar tipo
            const tipo = document.getElementById('tipo');
            if (!tipo.value) {
                isValid = false;
                errors.push('Debes seleccionar un tipo de solicitud.');
            }
            
            // Validar estado
            const estado = document.getElementById('estado');
            if (!estado.value) {
                isValid = false;
                errors.push('Debes seleccionar un estado.');
            }
            
            if (!isValid) {
                e.preventDefault();
                showErrors(errors);
            } else {
                // Mostrar estado de carga
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.classList.add('loading');
                    submitBtn.innerHTML = '<i class="fa-solid fa-spinner"></i> Guardando...';
                }
            }
        });
    }

    // Mostrar errores de forma elegante
    function showErrors(errors) {
        // Remover errores previos
        const existingAlerts = document.querySelectorAll('.validation-alert');
        existingAlerts.forEach(alert => alert.remove());
        
        const alert = document.createElement('div');
        alert.className = 'alert alert-error validation-alert';
        alert.style.cssText = `
            animation: slideDown 0.3s ease;
            margin-bottom: 1.5rem;
        `;
        
        let html = '<i class="fa-solid fa-exclamation-triangle"></i>';
        html += '<div><strong>Por favor corrige los siguientes errores:</strong><ul style="margin: 0.5rem 0 0 0; padding-left: 1.5rem;">';
        
        errors.forEach(error => {
            html += `<li>${error}</li>`;
        });
        
        html += '</ul></div>';
        alert.innerHTML = html;
        
        form.parentNode.insertBefore(alert, form);
        
        // Auto-remover después de 5 segundos
        setTimeout(() => {
            if (alert.parentNode) {
                alert.style.animation = 'slideUp 0.3s ease';
                setTimeout(() => alert.remove(), 300);
            }
        }, 5000);
    }

    // Efectos de focus mejorados
    const formControls = form.querySelectorAll('.form-control');
    
    formControls.forEach(control => {
        control.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        control.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
    });

    // Animación para cambios de estado
    const estadoSelect = document.getElementById('estado');
    if (estadoSelect) {
        estadoSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const estado = selectedOption.value;
            
            // Efecto visual al cambiar estado
            this.style.transform = 'scale(1.05)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 200);
            
            // Cambiar color del select según estado
            this.className = 'form-control';
            switch(estado) {
                case 'Aprobada':
                    this.classList.add('estado-aprobada');
                    break;
                case 'Rechazada':
                    this.classList.add('estado-rechazada');
                    break;
                case 'En Revisión':
                    this.classList.add('estado-revision');
                    break;
            }
        });
        
        // Disparar change event para aplicar estilos iniciales
        estadoSelect.dispatchEvent(new Event('change'));
    }

    // Prevenir envío accidental con Enter en textarea
    if (contenido) {
        contenido.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.ctrlKey) {
                form.dispatchEvent(new Event('submit'));
            }
        });
    }
});

// Agregar estilos adicionales para las validaciones
const additionalStyles = `
    .form-group.focused label {
        color: var(--color-fucsia);
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }
    
    .estado-aprobada {
        border-color: #28a745 !important;
        background: rgba(40, 167, 69, 0.05) !important;
    }
    
    .estado-rechazada {
        border-color: #dc3545 !important;
        background: rgba(220, 53, 69, 0.05) !important;
    }
    
    .estado-revision {
        border-color: #ffc107 !important;
        background: rgba(255, 193, 7, 0.05) !important;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideUp {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-20px);
        }
    }
    
    .fade-in {
        animation: fadeIn 0.5s ease;
    }
`;

const styleSheet = document.createElement('style');
styleSheet.textContent = additionalStyles;
document.head.appendChild(styleSheet);