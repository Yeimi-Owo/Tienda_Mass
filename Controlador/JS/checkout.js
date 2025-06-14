// checkout.js - Animaciones para el formulario de checkout

document.addEventListener('DOMContentLoaded', function() {
  
    // Elementos del DOM
    const paymentMethods = document.querySelectorAll('input[name="metodo_pago"]');
    const paymentDetails = document.querySelectorAll('.payment-details');
    
    // Función para ocultar todos los detalles de pago
    function hideAllPaymentDetails() {
        paymentDetails.forEach(detail => {
            detail.classList.remove('show');
            // Pequeño delay para la animación suave
            setTimeout(() => {
                if (!detail.classList.contains('show')) {
                    detail.style.display = 'none';
                }
            }, 400);
        });
    }
    
    // Función para mostrar detalles específicos del método de pago
    function showPaymentDetails(methodId) {
        const detailsId = methodId + 'Details';
        const detailsElement = document.getElementById(detailsId);
        
        if (detailsElement) {
            // Mostrar el elemento
            detailsElement.style.display = 'block';
            
            // Pequeño delay para activar la animación
            setTimeout(() => {
                detailsElement.classList.add('show');
            }, 10);
            
            // Scroll suave hacia los detalles
            setTimeout(() => {
                detailsElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });
            }, 200);
        }
    }
    
    // Event listeners para los métodos de pago
    paymentMethods.forEach(method => {
        method.addEventListener('change', function() {
            if (this.checked) {
                // Ocultar todos los detalles primero
                hideAllPaymentDetails();
                
                // Mostrar los detalles del método seleccionado después de un pequeño delay
                setTimeout(() => {
                    showPaymentDetails(this.id);
                }, 200);
                
                // Añadir efecto visual al método seleccionado
                addSelectionEffect(this);
            }
        });
    });
    
    // Función para añadir efecto visual al método seleccionado
    function addSelectionEffect(selectedMethod) {
        // Remover efectos anteriores
        paymentMethods.forEach(method => {
            const label = method.nextElementSibling;
            label.style.transform = 'scale(1)';
        });
        
        // Añadir efecto al método seleccionado
        const selectedLabel = selectedMethod.nextElementSibling;
        selectedLabel.style.transform = 'scale(1.02)';
        
        // Efecto de pulso
        selectedLabel.style.animation = 'pulse 0.6s ease-in-out';
        
        // Remover la animación después de completarse
        setTimeout(() => {
            selectedLabel.style.animation = '';
        }, 600);
    }
    
    // Animaciones para los campos de formulario
    const formInputs = document.querySelectorAll('.form-control');
    
    formInputs.forEach(input => {
        // Efecto focus
        input.addEventListener('focus', function() {
            this.style.transform = 'scale(1.01)';
            this.style.boxShadow = '0 0 0 0.2rem rgba(255, 68, 68, 0.25)';
        });
        
        // Efecto blur
        input.addEventListener('blur', function() {
            this.style.transform = 'scale(1)';
        });
        
        // Validación en tiempo real
        input.addEventListener('input', function() {
            validateField(this);
        });
    });
    
    // Función de validación de campos
    function validateField(field) {
        const value = field.value.trim();
        const fieldType = field.type;
        const fieldName = field.name;
        
        // Remover clases de validación anteriores
        field.classList.remove('is-valid', 'is-invalid');
        
        let isValid = false;
        
        switch(fieldName) {
            case 'nombre':
                isValid = value.length >= 2;
                break;
            case 'correo':
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                isValid = emailRegex.test(value);
                break;
            case 'direccion':
                isValid = value.length >= 10;
                break;
            default:
                isValid = value.length > 0;
        }
        
        // Añadir clase de validación
        if (value.length > 0) {
            field.classList.add(isValid ? 'is-valid' : 'is-invalid');
        }
        
        return isValid;
    }
    
    // Animación para los botones
    const buttons = document.querySelectorAll('.btn');
    
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
        
        button.addEventListener('mousedown', function() {
            this.style.transform = 'translateY(0) scale(0.98)';
        });
        
        button.addEventListener('mouseup', function() {
            this.style.transform = 'translateY(-2px) scale(1)';
        });
    });
    
    // Validación del formulario antes del envío
    const form = document.querySelector('form');
    
    form.addEventListener('submit', function(e) {
        let isFormValid = true;
        const requiredFields = ['nombre', 'correo', 'direccion'];
        
        // Validar campos requeridos
        requiredFields.forEach(fieldName => {
            const field = document.querySelector(`[name="${fieldName}"]`);
            if (!validateField(field)) {
                isFormValid = false;
                field.focus();
            }
        });
        
        // Validar que se haya seleccionado un método de pago
        const selectedPaymentMethod = document.querySelector('input[name="metodo_pago"]:checked');
        if (!selectedPaymentMethod) {
            isFormValid = false;
            
            // Mostrar alerta personalizada
            showCustomAlert('Por favor seleccione un método de pago');
            
            // Scroll hacia los métodos de pago
            document.querySelector('.payment-methods').scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
        
        if (!isFormValid) {
            e.preventDefault();
            return false;
        }
        
        // Mostrar loading en el botón de envío
        const submitButton = document.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;
        
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Procesando...';
        submitButton.disabled = true;
        
        // Si hay algún error, restaurar el botón después de 3 segundos
        setTimeout(() => {
            if (submitButton.disabled) {
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
            }
        }, 3000);
    });
    
    // Función para mostrar alertas personalizadas
    function showCustomAlert(message) {
        // Crear el elemento de alerta si no existe
        let alertElement = document.getElementById('customAlert');
        
        if (!alertElement) {
            alertElement = document.createElement('div');
            alertElement.id = 'customAlert';
            alertElement.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: #ff4444;
                color: white;
                padding: 15px 20px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.3);
                z-index: 9999;
                font-weight: 500;
                transform: translateX(400px);
                transition: transform 0.3s ease;
                max-width: 300px;
            `;
            document.body.appendChild(alertElement);
        }
        
        // Establecer el mensaje
        alertElement.innerHTML = `
            <i class="fas fa-exclamation-triangle" style="margin-right: 8px;"></i>
            ${message}
        `;
        
        // Mostrar la alerta
        setTimeout(() => {
            alertElement.style.transform = 'translateX(0)';
        }, 10);
        
        // Ocultar después de 4 segundos
        setTimeout(() => {
            alertElement.style.transform = 'translateX(400px)';
        }, 4000);
    }
    
    // Animación de entrada para los elementos
    function animateOnLoad() {
        const sections = document.querySelectorAll('.mb-section');
        
        sections.forEach((section, index) => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                section.style.transition = 'all 0.6s ease';
                section.style.opacity = '1';
                section.style.transform = 'translateY(0)';
            }, index * 200);
        });
    }
    
    // Ejecutar animación de carga
    animateOnLoad();
    
    // Efecto parallax suave para el header
    window.addEventListener('scroll', function() {
        const header = document.querySelector('.checkout-header');
        const scrolled = window.pageYOffset;
        const rate = scrolled * -0.5;
        
        if (header) {
            header.style.transform = `translateY(${rate}px)`;
        }
    });
    
    // Añadir estilos CSS dinámicos para las animaciones
    const style = document.createElement('style');
    style.textContent = `
        @keyframes pulse {
            0% { transform: scale(1.02); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1.02); }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .form-control.is-valid {
            border-color: #28a745 !important;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25) !important;
        }
        
        .form-control.is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }
        
        .payment-method label:active {
            transform: scale(0.98) !important;
        }
        
        .btn:active {
            transform: scale(0.95) !important;
        }
        
        .form-control:invalid:focus {
            animation: shake 0.5s ease-in-out;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(26, 26, 26, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 10000;
        }
        
        .loading-spinner {
            color: #ff4444;
            font-size: 2rem;
        }
    `;
    document.head.appendChild(style);
    
    // Crear overlay de carga
    const loadingOverlay = document.createElement('div');
    loadingOverlay.className = 'loading-overlay';
    loadingOverlay.innerHTML = '<i class="fas fa-spinner fa-spin loading-spinner"></i>';
    document.body.appendChild(loadingOverlay);
    
    // Función para mostrar/ocultar loading
    window.showLoading = function() {
        loadingOverlay.style.display = 'flex';
    };
    
    window.hideLoading = function() {
        loadingOverlay.style.display = 'none';
    };
    
    // Auto-guardar datos del formulario en localStorage
    const autoSaveFields = ['nombre', 'correo', 'direccion'];
    
    autoSaveFields.forEach(fieldName => {
        const field = document.querySelector(`[name="${fieldName}"]`);
        if (field) {
            // Cargar datos guardados
            const savedValue = localStorage.getItem(`checkout_${fieldName}`);
            if (savedValue) {
                field.value = savedValue;
            }
            
            // Guardar en tiempo real
            field.addEventListener('input', function() {
                localStorage.setItem(`checkout_${fieldName}`, this.value);
            });
        }
    });
    
    // Limpiar localStorage al enviar el formulario exitosamente
    form.addEventListener('submit', function() {
        if (this.checkValidity()) {
            autoSaveFields.forEach(fieldName => {
                localStorage.removeItem(`checkout_${fieldName}`);
            });
        }
    });
    
    console.log('Checkout.js cargado correctamente - Todas las animaciones activas');
  });