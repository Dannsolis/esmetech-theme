<?php
// Registrar menús para Esmetech
function esmetech_register_menus() {
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'esmetech'),
    ));
}
add_action('after_setup_theme', 'esmetech_register_menus');

// Habilitar soporte para logo personalizado
add_theme_support('custom-logo', array(
    'height' => 60,
    'width' => 200,
    'flex-height' => true,
    'flex-width' => true,
));

// Habilitar título dinámico
add_theme_support('title-tag');

// Habilitar soporte para menús
add_theme_support('menus');
?>