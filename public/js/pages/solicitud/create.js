// public/js/pages/solicitud/create.js
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.solicitud-form');
    const contenido = document.getElementById('contenido');
    const submitBtn = document.querySelector('.btn-submit');
    const fechaInput = document.getElementById('fecha_solicitud');

    // Contador de caracteres para el textarea
    function createCharacterCounter() {
        const counter = document.createElement('div');
        counter.className = 'character-counter';
        counter.style.cssText = `
            text-align: right;
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 0.5rem;
            font-weight: 500;
        `;
        
        contenido.parentNode.appendChild(counter);
        
        function updateCounter() {
            const length = contenido.value.length;
            counter.textContent = `${length} caracteres`;
            
            if (length < 10) {
                counter.style.color = '#dc3545';
                counter.innerHTML += ' - <strong>Mínimo 10 caracteres requeridos</strong>';
            } else if (length < 50) {
                counter.style.color = '#ffc107';
            } else {
                counter.style.color = '#28a745';
            }
        }
        
        contenido.addEventListener('input', updateCounter);
        updateCounter();
    }

    // Auto-seleccionar fecha actual
    function setCurrentDateTime() {
        if (fechaInput && !fechaInput.value) {
            const now = new Date();
            // Ajustar para zona horaria local
            const timezoneOffset = now.getTimezoneOffset() * 60000;
            const localDateTime = new Date(now - timezoneOffset).toISOString().slice(0, 16);
            fechaInput.value = localDateTime;
        }
    }

    // Validación mejorada del formulario
    function setupFormValidation() {
        if (!form) return;
        
        form.addEventListener('submit', function(e) {
            let isValid = true;
            const errors = [];
            
            // Validar contenido
            if (contenido.value.trim().length < 10) {
                isValid = false;
                errors.push('El contenido debe tener al menos 10 caracteres.');
                contenido.focus();
            }
            
            // Validar usuario
            const usuarioId = document.getElementById('usuario_id');
            if (!usuarioId.value) {
                isValid = false;
                errors.push('Debes seleccionar un solicitante.');
            }
            
            // Validar tipo
            const tipo = document.getElementById('tipo');
            if (!tipo.value) {
                isValid = false;
                errors.push('Debes seleccionar un tipo de solicitud.');
            }
            
            if (!isValid) {
                e.preventDefault();
                showValidationErrors(errors);
            } else {
                // Mostrar estado de carga
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.classList.add('loading');
                    submitBtn.innerHTML = '<i class="fa-solid fa-spinner"></i> Creando Solicitud...';
                }
            }
        });
    }

    // Mostrar errores de validación
    function showValidationErrors(errors) {
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
        
        // Scroll to alert
        alert.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        // Auto-remover después de 8 segundos
        setTimeout(() => {
            if (alert.parentNode) {
                alert.style.animation = 'slideUp 0.3s ease';
                setTimeout(() => alert.remove(), 300);
            }
        }, 8000);
    }

    // Mejorar experiencia de usuario
    function enhanceUX() {
        // Efectos de focus
        const formControls = form.querySelectorAll('.form-control');
        
        formControls.forEach(control => {
            control.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            control.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });

        // Prevenir envío accidental con Enter en textarea
        if (contenido) {
            contenido.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && e.ctrlKey) {
                    form.dispatchEvent(new Event('submit'));
                }
            });
        }
    }

    // Inicializar
    if (contenido) createCharacterCounter();
    setCurrentDateTime();
    setupFormValidation();
    enhanceUX();
});

// Agregar estilos adicionales para el contador
const additionalStyles = document.createElement('style');
additionalStyles.textContent = `
    .character-counter {
        transition: color 0.3s ease;
    }
    
    .form-group.focused label {
        color: var(--color-fucsia);
        transform: translateY(-2px);
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
`;
document.head.appendChild(additionalStyles);