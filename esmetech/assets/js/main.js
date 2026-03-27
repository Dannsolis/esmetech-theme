// =========================================
// MENÚ MÓVIL ESMETECH
// =========================================
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-nav');
    
    // Abrir/cerrar menú móvil
    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function() {
            mainNav.classList.toggle('active');
            this.classList.toggle('active');
        });
    }
    
    // Submenús en móvil (click en padre)
    const menuItems = document.querySelectorAll('.main-menu li.menu-item-has-children > a');
    
    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            if (window.innerWidth <= 992) {
                e.preventDefault();
                const parentLi = this.parentElement;
                parentLi.classList.toggle('active');
            }
        });
    });
    
    // Cerrar menú al hacer clic en un enlace (móvil)
    const allLinks = document.querySelectorAll('.main-menu a');
    allLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 992 && !this.parentElement.classList.contains('menu-item-has-children')) {
                if (mainNav) mainNav.classList.remove('active');
                if (menuToggle) menuToggle.classList.remove('active');
            }
        });
    });
});

// =========================================
// CHATBOT - Mantener funcionalidad existente
// =========================================
document.addEventListener('DOMContentLoaded', function() {
    const chatbotToggle = document.getElementById('chatbotToggle');
    const chatbotWindow = document.getElementById('chatbotWindow');
    const chatbotSend = document.getElementById('chatbotSend');
    const chatbotInput = document.getElementById('chatbotInput');
    const chatbotMessages = document.getElementById('chatbotMessages');
    
    // Abrir/cerrar chatbot
    if (chatbotToggle && chatbotWindow) {
        chatbotToggle.addEventListener('click', () => {
            chatbotWindow.classList.toggle('active');
        });
    }
    
    // Enviar mensaje
    if (chatbotSend && chatbotInput && chatbotMessages) {
        chatbotSend.addEventListener('click', sendMessage);
        chatbotInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    }
    
    function sendMessage() {
        const message = chatbotInput.value.trim();
        if (message === '') return;
        
        // Mostrar mensaje del usuario
        const userMsg = document.createElement('div');
        userMsg.textContent = '👤 ' + message;
        userMsg.style.background = '#e3f2fd';
        userMsg.style.padding = '8px 12px';
        userMsg.style.borderRadius = '8px';
        userMsg.style.marginBottom = '10px';
        chatbotMessages.appendChild(userMsg);
        
        // Limpiar input
        chatbotInput.value = '';
        
        // Mostrar "escribiendo..."
        const typingMsg = document.createElement('div');
        typingMsg.textContent = '🤖 Escribiendo...';
        typingMsg.style.color = '#666';
        typingMsg.style.fontStyle = 'italic';
        chatbotMessages.appendChild(typingMsg);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
        
        // Simular respuesta (aquí iría la llamada a la IA)
        setTimeout(() => {
            chatbotMessages.removeChild(typingMsg);
            
            const botMsg = document.createElement('div');
            botMsg.textContent = '🤖 Gracias por tu mensaje. Un asesor te contactará pronto.';
            botMsg.style.background = '#f1f5f9';
            botMsg.style.padding = '8px 12px';
            botMsg.style.borderRadius = '8px';
            botMsg.style.marginBottom = '10px';
            chatbotMessages.appendChild(botMsg);
            chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
        }, 1000);
    }
});