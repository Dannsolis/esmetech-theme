<?php
/**
 * Tipos de contenido personalizado
 */

// Registrar tipo de contenido "Proyecto"
function esmetech_register_post_types() {
    register_post_type('proyecto',
        array(
            'labels' => array(
                'name' => 'Proyectos',
                'singular_name' => 'Proyecto',
                'add_new' => 'Añadir Proyecto',
                'add_new_item' => 'Añadir Nuevo Proyecto',
                'edit_item' => 'Editar Proyecto',
                'view_item' => 'Ver Proyecto'
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'proyectos'),
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon' => 'dashicons-portfolio',
            'show_in_rest' => true
        )
    );
}
add_action('init', 'esmetech_register_post_types');
?>