    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <p>&copy; <?php echo date('Y'); ?> Esmetech. Todos los derechos reservados.</p>
                <p>Innovación tecnológica con inteligencia artificial</p>
            </div>
        </div>
    </footer>

    <!-- Chatbot Container -->
    <div class="chatbot-container">
        <button class="chatbot-toggle" id="chatbotToggle">
            💬
        </button>
        <div class="chatbot-window" id="chatbotWindow">
            <div class="chatbot-header">
                <strong>🤖 Asistente IA Esmetech</strong>
            </div>
            <div class="chatbot-messages" id="chatbotMessages">
                <div>¡Hola! Soy el asistente virtual de Esmetech. ¿En qué puedo ayudarte?</div>
            </div>
            <div class="chatbot-input-area">
                <input type="text" class="chatbot-input" id="chatbotInput" placeholder="Escribe tu mensaje...">
                <button class="chatbot-send" id="chatbotSend">Enviar</button>
            </div>
        </div>
    </div>

    <?php wp_footer(); ?>
</body>
</html>