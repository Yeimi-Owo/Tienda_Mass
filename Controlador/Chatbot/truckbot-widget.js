(function() {
    'use strict';
    
    // Verificar que no se cargue dos veces
    if (window.MassBotLoaded) return;
    window.MassBotLoaded = true;
    
    console.log('🛒 Iniciando MassBot...');
    
    // CONFIGURACIÓN
    const BOT_CONFIG = {
        name: 'MassBot',
        company: 'Tienda Mass',
        phone: '+51-123-456-789',
        email: 'ventas@tiendamass.pe',
        whatsapp: '51987654321'
    };
    
    // RESPUESTAS DEL BOT
    const BOT_RESPONSES = {
        // Saludos
        'hola': '🛒 ¡Hola! Soy MassBot. ¿En qué puedo ayudarte con tus compras hoy?',
        'buenos dias': '🌅 ¡Buenos días! ¿Qué producto te gustaría comprar hoy?',
        'buenas tardes': '🌇 ¡Buenas tardes! ¿En qué puedo ayudarte con tu compra?',
        'buenas noches': '🌙 ¡Buenas noches! Siempre estamos aquí para ayudarte en cualquier momento',
        
        // Productos
        'producto': '📦 NUESTROS PRODUCTOS:\n• Teléfonos móviles\n• Lentes de sol\n• Ropa de marca\n• Accesorios para vehículos\n• Calzado deportivo',
        'catalogo': '📖 CATÁLOGO: Envíame tu WhatsApp y te mando el catálogo completo con precios actualizados',
        
        // Precios
        'precio': '💰 PRECIOS ACTUALES:\n• Teléfono móvil: $300\n• Lentes de sol: $50\n• Ropa de marca: Desde $30\n• Calzado deportivo: Desde $80\n¿Qué te interesa?',
        'costo': '💵 COSTOS:\n• Teléfono móvil: $300 c/u\n• Envío Lima: Gratis +$500\n• Envío provincias: $25\n• Instalación: $50 (opcional)',
        'oferta': '🎯 OFERTAS ESPECIALES:\n• 5% OFF por 5+ unidades\n• 10% OFF por 10+ unidades\n• Envío gratis en compras +$500',
        
        // Compras
        'comprar': '🛒 CÓMO COMPRAR:\n1. Dime qué necesitas\n2. Te doy precio final\n3. Pago: Tarjeta/Yape/Transferencia\n4. Envío en 24-48h',
        'pago': '💳 MÉTODOS DE PAGO:\n• Tarjetas Visa/Mastercard\n• Yape/Plin\n• Transferencia bancaria\n• Efectivo (solo Lima)\n• Facilidades de pago disponibles',
        'envio': '🚚 ENVÍOS:\n• Lima: 24-48 horas\n• Provincias: 3-5 días\n• Gratis en compras +$500\n• Seguimiento en tiempo real',
        
        // Contacto
        'contacto': `📞 CONTACTO DIRECTO:\n• Teléfono: ${BOT_CONFIG.phone}\n• Email: ${BOT_CONFIG.email}\n• WhatsApp: +${BOT_CONFIG.whatsapp}`,
        'telefono': `📱 TELÉFONO: ${BOT_CONFIG.phone}\nLlamadas de 8:00 AM a 6:00 PM`,
        'whatsapp': `💬 WHATSAPP: +${BOT_CONFIG.whatsapp}\nDisponible 24/7 para consultas rápidas`,
        'email': `📧 EMAIL: ${BOT_CONFIG.email}\nRespuesta en menos de 2 horas`,
        
        // Información
        'horario': '🕒 HORARIOS DE ATENCIÓN:\n• Lunes a Viernes: 8:00 AM - 6:00 PM\n• Sábados: 8:00 AM - 1:00 PM\n• MassBot: 24/7 siempre disponible',
        'ubicacion': '📍 UBICACIÓN:\n• Av. Principal 123, Lima\n• Zona comercial de tiendas\n• Estacionamiento disponible\n• Fácil acceso',
        
        // Ayuda
        'ayuda': '❓ PUEDO AYUDARTE CON:\n• Precios de productos\n• Stock disponible\n• Métodos de pago\n• Envíos y entregas\n• Ofertas especiales',
        'menu': '📋 OPCIONES DISPONIBLES:\n• "producto" - Ver productos disponibles\n• "precio" - Lista de precios\n• "envio" - Info de envíos\n• "contacto" - Datos de contacto'
    };
    
    // CREAR ESTILOS CSS
    const widgetCSS = `
        .truckbot-widget {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999999;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
        }
        
        .truckbot-button {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            border: none;
            border-radius: 50%;
            color: white;
            font-size: 28px;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(220, 38, 38, 0.4);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .truckbot-button:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 25px rgba(220, 38, 38, 0.6);
        }
        
        .truckbot-button:active {
            transform: scale(0.95);
        }
        
        .truckbot-chat {
            position: absolute;
            bottom: 75px;
            right: 0;
            width: 380px;
            height: 550px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            display: none;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }
        
        .truckbot-chat.active {
            display: flex;
            animation: chatSlideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        @keyframes chatSlideUp {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        .truckbot-header {
            background: linear-gradient(135deg, #1f2937, #374151);
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .truckbot-header-info h3 {
            margin: 0 0 4px 0;
            font-size: 18px;
            font-weight: 600;
        }
        
        .truckbot-header-info p {
            margin: 0;
            font-size: 12px;
            opacity: 0.8;
        }
        
        .truckbot-close {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }
        
        .truckbot-close:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .truckbot-messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background: linear-gradient(to bottom, #f8fafc, #f1f5f9);
        }
        
        .truckbot-messages::-webkit-scrollbar {
            width: 6px;
        }
        
        .truckbot-messages::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        .truckbot-messages::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        
        .truckbot-message {
            margin: 16px 0;
            max-width: 85%;
            animation: messageSlide 0.3s ease;
        }
        
        @keyframes messageSlide {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .truckbot-message.bot {
            margin-right: auto;
        }
        
        .truckbot-message.user {
            margin-left: auto;
        }
        
        .truckbot-message-content {
            padding: 14px 18px;
            border-radius: 18px;
            font-size: 14px;
            line-height: 1.5;
            word-wrap: break-word;
            white-space: pre-line;
        }
        
        .truckbot-message.bot .truckbot-message-content {
            background: white;
            color: #1f2937;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .truckbot-message.user .truckbot-message-content {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
        }
        
        .truckbot-input-container {
            padding: 20px;
            background: white;
            border-top: 1px solid #e5e7eb;
        }
        
        .truckbot-input-wrapper {
            display: flex;
            gap: 12px;
            align-items: flex-end;
        }
        
        .truckbot-input {
            flex: 1;
            padding: 14px 18px;
            border: 2px solid #e5e7eb;
            border-radius: 25px;
            outline: none;
            font-size: 14px;
            resize: none;
            max-height: 100px;
            min-height: 20px;
            transition: border-color 0.2s;
        }
        
        .truckbot-input:focus {
            border-color: #dc2626;
        }
        
        .truckbot-send {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            flex-shrink: 0;
        }
        
        .truckbot-send:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }
        
        .truckbot-send:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }
        
        .truckbot-typing {
            display: none;
            margin: 16px 0;
            max-width: 85%;
        }
        
        .truckbot-typing.active {
            display: block;
            animation: messageSlide 0.3s ease;
        }
        
        .truckbot-typing-content {
            background: white;
            border: 1px solid #e5e7eb;
            padding: 14px 18px;
            border-radius: 18px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .truckbot-typing-dots {
            display: flex;
            gap: 4px;
            align-items: center;
        }
        
        .truckbot-typing-dot {
            width: 8px;
            height: 8px;
            background: #6b7280;
            border-radius: 50%;
            animation: typingBounce 1.4s infinite ease-in-out;
        }
        
        .truckbot-typing-dot:nth-child(1) { animation-delay: -0.32s; }
        .truckbot-typing-dot:nth-child(2) { animation-delay: -0.16s; }
        
        @keyframes typingBounce {
            0%, 80%, 100% {
                transform: scale(0.8);
                opacity: 0.5;
            }
            40% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        @media (max-width: 480px) {
            .truckbot-widget {
                bottom: 15px;
                right: 15px;
                left: 15px;
            }
            
            .truckbot-chat {
                width: 100%;
                height: 70vh;
                max-height: 600px;
                right: 0;
                left: 0;
            }
            
            .truckbot-button {
                width: 56px;
                height: 56px;
                font-size: 24px;
            }
        }
    `;
    
    // Inyectar CSS
    const style = document.createElement('style');
    style.textContent = widgetCSS;
    document.head.appendChild(style);
    
    // Crear HTML del widget
    const widgetHTML = `
        <div class="truckbot-chat" id="truckbot-chat">
            <div class="truckbot-header">
                <div class="truckbot-header-info">
                    <h3>🛒 ${BOT_CONFIG.name}</h3>
                    <p>${BOT_CONFIG.company}</p>
                </div>
                <button class="truckbot-close" id="truckbot-close">✕</button>
            </div>
            
            <div class="truckbot-messages" id="truckbot-messages">
                <div class="truckbot-message bot">
                    <div class="truckbot-message-content">
                        🛒 ¡Hola! Soy ${BOT_CONFIG.name}, tu asistente de compras en Tienda Mass.
                        
  ¿Qué producto te gustaría comprar hoy? 
  Escribe "ayuda" para ver todo lo que puedo hacer por ti.
                    </div>
                </div>
            </div>
            
            <div class="truckbot-typing" id="truckbot-typing">
                <div class="truckbot-typing-content">
                    <div class="truckbot-typing-dots">
                        <div class="truckbot-typing-dot"></div>
                        <div class="truckbot-typing-dot"></div>
                        <div class="truckbot-typing-dot"></div>
                        <span style="margin-left: 8px; font-size: 12px; color: #6b7280;">${BOT_CONFIG.name} está escribiendo...</span>
                    </div>
                </div>
            </div>
            
            <div class="truckbot-input-container">
                <div class="truckbot-input-wrapper">
                    <textarea 
                        class="truckbot-input" 
                        id="truckbot-input" 
                        placeholder="Escribe tu mensaje aquí..."
                        rows="1"
                        maxlength="500"
                    ></textarea>
                    <button class="truckbot-send" id="truckbot-send">➤</button>
                </div>
            </div>
        </div>
        
        <button class="truckbot-button" id="truckbot-button">
            🛒
        </button>
    `;
    
    // Crear contenedor del widget
    const widgetContainer = document.createElement('div');
    widgetContainer.className = 'truckbot-widget';
    widgetContainer.innerHTML = widgetHTML;
    
    // Agregar al DOM cuando esté listo
    function initWidget() {
        document.body.appendChild(widgetContainer);
        setupEventListeners();
        console.log('✅ MassBot widget cargado exitosamente');
    }
    
    // Configurar event listeners
    function setupEventListeners() {
        const button = document.getElementById('truckbot-button');
        const chat = document.getElementById('truckbot-chat');
        const closeBtn = document.getElementById('truckbot-close');
        const input = document.getElementById('truckbot-input');
        const sendBtn = document.getElementById('truckbot-send');
        
        // Abrir/cerrar chat
        button.addEventListener('click', toggleChat);
        closeBtn.addEventListener('click', closeChat);
        
        // Enviar mensaje
        sendBtn.addEventListener('click', sendMessage);
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });
        
        // Auto-resize textarea
        input.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 100) + 'px';
        });
    }
    
    let chatOpen = false;
    
    function toggleChat() {
        const chat = document.getElementById('truckbot-chat');
        const input = document.getElementById('truckbot-input');
        
        chatOpen = !chatOpen;
        
        if (chatOpen) {
            chat.classList.add('active');
            setTimeout(() => input.focus(), 300);
        } else {
            chat.classList.remove('active');
        }
    }
    
    function closeChat() {
        const chat = document.getElementById('truckbot-chat');
        chat.classList.remove('active');
        chatOpen = false;
    }
    
    function sendMessage() {
        const input = document.getElementById('truckbot-input');
        const message = input.value.trim();
        
        if (!message) return;
        
        // Agregar mensaje del usuario
        addMessage(message, 'user');
        input.value = '';
        input.style.height = 'auto';
        
        // Mostrar typing indicator
        showTyping();
        
        // Simular delay de respuesta
        setTimeout(() => {
            hideTyping();
            const response = getBotResponse(message.toLowerCase());
            addMessage(response, 'bot');
        }, 1000 + Math.random() * 1000);
    }
    
    function addMessage(text, sender) {
        const messages = document.getElementById('truckbot-messages');
        const messageDiv = document.createElement('div');
        messageDiv.className = `truckbot-message ${sender}`;
        
        const contentDiv = document.createElement('div');
        contentDiv.className = 'truckbot-message-content';
        contentDiv.textContent = text;
        
        messageDiv.appendChild(contentDiv);
        messages.appendChild(messageDiv);
        
        // Scroll al final
        messages.scrollTop = messages.scrollHeight;
    }
    
    function showTyping() {
        const typing = document.getElementById('truckbot-typing');
        typing.classList.add('active');
        
        const messages = document.getElementById('truckbot-messages');
        messages.scrollTop = messages.scrollHeight;
    }
    
    function hideTyping() {
        const typing = document.getElementById('truckbot-typing');
        typing.classList.remove('active');
    }
    
    function getBotResponse(message) {
        // Buscar respuesta exacta
        for (const [key, response] of Object.entries(BOT_RESPONSES)) {
            if (message.includes(key)) {
                return response;
            }
        }
        
        return `🤔 No tengo información sobre "${message}".\n  
  Puedo ayudarte con:\n  
  • Productos disponibles\n  
  • Precios y ofertas\n  
  • Métodos de pago y envío\n  
  • Contáctanos para más información.`;
    }
    
    // Inicializar cuando el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initWidget);
    } else {
        initWidget();
    }
    
    // API pública
    window.MassBot = {
        open: function() {
            if (!chatOpen) toggleChat();
        },
        close: closeChat,
        toggle: toggleChat,
        sendMessage: function(msg) {
            if (msg) {
                const input = document.getElementById('truckbot-input');
                input.value = msg;
                sendMessage();
            }
        }
    };
})();
