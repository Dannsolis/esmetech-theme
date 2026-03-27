<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- BARRA SUPERIOR ESMETECH -->
<div class="top-bar-esmetech">
    <div class="container">
        <div class="top-bar-left">
            <span class="email">📧 info@esmetech.com</span>
            <a href="<?php echo home_url('/contacto'); ?>" class="contacto">📞 Contáctenos</a>
            <a href="https://wa.me/593999999999" class="whatsapp" target="_blank">💬 WhatsApp</a>
        </div>
        <div class="top-bar-right">
            <div class="idioma">
                <span>🌐 Español</span>
            </div>
            <a href="<?php echo wp_login_url(); ?>" class="login">🔐 Iniciar Sesión</a>
            <a href="<?php echo wp_registration_url(); ?>" class="registro">📝 Registrarse</a>
        </div>
    </div>
</div>

<!-- MENÚ PRINCIPAL ESMETECH -->
<header class="header-esmetech">
    <div class="container">
        <div class="logo">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-esmetech.png" alt="Esmetech">
                </a>
            <?php endif; ?>
        </div>
        
        <nav class="main-nav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class' => 'main-menu',
                'container' => false,
                'fallback_cb' => false
            ));
            ?>
        </nav>
        
        <div class="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>

<main class="main-content">