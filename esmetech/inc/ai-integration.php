<?php
/**
 * Integración con OpenAI
 */

// Función para conectar con OpenAI
function esmetech_ai_chat($message) {
    $api_key = get_option('esmetech_openai_api_key', '');
    
    if (empty($api_key)) {
        return '⚠️ Por favor configura tu API key de OpenAI en Ajustes → Esmetech IA';
    }
    
    $url = 'https://api.openai.com/v1/chat/completions';
    
    $response = wp_remote_post($url, array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type' => 'application/json'
        ),
        'body' => json_encode(array(
            'model' => 'gpt-3.5-turbo',
            'messages' => array(
                array(
                    'role' => 'system', 
                    'content' => 'Eres un asistente virtual de Esmetech, una empresa de tecnología que ofrece soluciones con inteligencia artificial, desarrollo web y bases de datos. Responde de manera amigable y profesional.'
                ),
                array(
                    'role' => 'user', 
                    'content' => $message
                )
            ),
            'temperature' => 0.7,
            'max_tokens' => 500
        )),
        'timeout' => 30
    ));
    
    if (is_wp_error($response)) {
        return 'Error de conexión con OpenAI. Por favor intenta más tarde.';
    }
    
    $body = json_decode(wp_remote_retrieve_body($response), true);
    
    if (isset($body['choices'][0]['message']['content'])) {
        return $body['choices'][0]['message']['content'];
    }
    
    return 'No se pudo obtener respuesta de la IA. Verifica tu API key.';
}

// Handler AJAX para el chatbot
function esmetech_ajax_ai_chat() {
    // Verificar nonce de seguridad
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'esmetech_nonce')) {
        wp_send_json_error('Error de seguridad');
    }
    
    $message = sanitize_text_field($_POST['message']);
    $reply = esmetech_ai_chat($message);
    
    wp_send_json_success(array('reply' => $reply));
}
add_action('wp_ajax_esmetech_ai_chat', 'esmetech_ajax_ai_chat');
add_action('wp_ajax_nopriv_esmetech_ai_chat', 'esmetech_ajax_ai_chat');

// Página de configuración en el admin
function esmetech_ai_menu() {
    add_options_page(
        'Configuración IA Esmetech',
        'Esmetech IA',
        'manage_options',
        'esmetech-ai-settings',
        'esmetech_ai_settings_page'
    );
}
add_action('admin_menu', 'esmetech_ai_menu');

function esmetech_ai_settings_page() {
    // Guardar configuración
    if (isset($_POST['submit']) && check_admin_referer('esmetech_ai_settings')) {
        update_option('esmetech_openai_api_key', sanitize_text_field($_POST['openai_api_key']));
        echo '<div class="notice notice-success"><p>Configuración guardada correctamente.</p></div>';
    }
    
    $api_key = get_option('esmetech_openai_api_key', '');
    ?>
    <div class="wrap">
        <h1>Configuración de IA - Esmetech</h1>
        
        <div class="card" style="max-width: 600px; margin-top: 20px;">
            <h2>OpenAI API Key</h2>
            <p>Ingresa tu API key de OpenAI para activar el chatbot con inteligencia artificial.</p>
            
            <form method="post" action="">
                <?php wp_nonce_field('esmetech_ai_settings'); ?>
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="openai_api_key">API Key</label>
                        </th>
                        <td>
                            <input type="password" 
                                   name="openai_api_key" 
                                   id="openai_api_key" 
                                   value="<?php echo esc_attr($api_key); ?>" 
                                   class="regular-text"
                                   placeholder="sk-...">
                            <p class="description">
                                Obtén tu API key en 
                                <a href="https://platform.openai.com/api-keys" target="_blank">
                                    platform.openai.com/api-keys
                                </a>
                            </p>
                        </td>
                    </tr>
                </table>
                <?php submit_button('Guardar Configuración', 'primary', 'submit'); ?>
            </form>
        </div>
        
        <div class="card" style="max-width: 600px; margin-top: 20px;">
            <h3>📌 Instrucciones</h3>
            <ol>
                <li>Regístrate en <a href="https://platform.openai.com" target="_blank">OpenAI</a></li>
                <li>Ve a la sección "API Keys" y crea una nueva</li>
                <li>Copia la clave (comienza con "sk-") y pégala arriba</li>
                <li>Guarda los cambios</li>
                <li>El chatbot aparecerá automáticamente en tu sitio web</li>
            </ol>
        </div>
    </div>
    <?php
}
?>