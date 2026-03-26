jQuery(document).ready(function($) {
    // Variables del chatbot
    let chatbotToggle = $('#chatbotToggle');
    let chatbotWindow = $('#chatbotWindow');
    let chatbotInput = $('#chatbotInput');
    let chatbotSend = $('#chatbotSend');
    let chatbotMessages = $('#chatbotMessages');
    
    // Abrir/cerrar chatbot
    chatbotToggle.click(function() {
        chatbotWindow.toggleClass('active');
    });
    
    // Función para enviar mensaje
    function sendMessage() {
        let message = chatbotInput.val().trim();
        if (message === '') return;
        
        // Agregar mensaje del usuario
        chatbotMessages.append('<div><strong>Tú:</strong> ' + message + '</div>');
        chatbotInput.val('');
        
        // Scroll al final
        chatbotMessages.scrollTop(chatbotMessages[0].scrollHeight);
        
        // Mostrar indicador de escritura
        chatbotMessages.append('<div><em>🤖 Escribiendo...</em></div>');
        
        // Enviar a la IA
        $.ajax({
            url: esmetech_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'esmetech_ai_chat',
                message: message,
                nonce: esmetech_ajax.nonce
            },
            success: function(response) {
                // Eliminar indicador de escritura
                chatbotMessages.find('div:last').remove();
                
                if (response.success) {
                    chatbotMessages.append('<div><strong>IA:</strong> ' + response.data.reply + '</div>');
                } else {
                    chatbotMessages.append('<div><strong>IA:</strong> Lo siento, hubo un error. Por favor intenta de nuevo.</div>');
                }
                chatbotMessages.scrollTop(chatbotMessages[0].scrollHeight);
            },
            error: function() {
                chatbotMessages.find('div:last').remove();
                chatbotMessages.append('<div><strong>IA:</strong> Error de conexión. Verifica tu API key.</div>');
            }
        });
    }
    
    // Eventos del chatbot
    chatbotSend.click(sendMessage);
    chatbotInput.keypress(function(e) {
        if (e.which === 13) sendMessage();
    });
    
    // Scroll suave para enlaces internos
    $('a[href*="#"]').click(function(e) {
        let target = $(this.hash);
        if (target.length) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 800);
        }
    });
});