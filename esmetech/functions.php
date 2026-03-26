<?php
/**
 * Esmetech Theme Functions
 */

// Setup theme
function esmetech_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'esmetech'),
        'footer' => __('Menú Footer', 'esmetech'),
    ));
}
add_action('after_setup_theme', 'esmetech_setup');

// Cargar scripts
function esmetech_scripts() {
    wp_enqueue_style('esmetech-style', get_stylesheet_uri(), array(), '1.0');
    wp_enqueue_script('esmetech-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0', true);
    
    wp_localize_script('esmetech-main', 'esmetech_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('esmetech_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'esmetech_scripts');

// Incluir archivos de funcionalidades
require_once get_template_directory() . '/inc/ai-integration.php';
require_once get_template_directory() . '/inc/database-connection.php';
require_once get_template_directory() . '/inc/custom-post-types.php';
?>
