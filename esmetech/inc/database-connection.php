<?php
/**
 * Conexión a base de datos personalizada
 */

// Crear tablas al activar el tema
function esmetech_create_tables() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'esmetech_leads';
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        phone varchar(20),
        message text,
        status varchar(20) DEFAULT 'new',
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'esmetech_create_tables');

// Guardar lead
function esmetech_save_lead($name, $email, $phone, $message) {
    global $wpdb;
    
    return $wpdb->insert(
        $wpdb->prefix . 'esmetech_leads',
        array(
            'name' => sanitize_text_field($name),
            'email' => sanitize_email($email),
            'phone' => sanitize_text_field($phone),
            'message' => sanitize_textarea_field($message)
        ),
        array('%s', '%s', '%s', '%s')
    );
}

// Obtener leads
function esmetech_get_leads($limit = 50) {
    global $wpdb;
    
    $table = $wpdb->prefix . 'esmetech_leads';
    
    return $wpdb->get_results(
        "SELECT * FROM $table ORDER BY created_at DESC LIMIT $limit"
    );
}
?>