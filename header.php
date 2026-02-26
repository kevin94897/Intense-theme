<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <!-- Site Header -->
    <header class="site-header" role="banner">
        <!-- Top Header -->
        <div class="top-header border-b border-neutral-gray/30">
            <div class="container-site">
                <div class="flex items-center justify-end py-2 text-sm text-cream font-medium">
                    <div class="flex items-center divide-x divide-neutral-gray/50">
                        <a href="https://maps.app.goo.gl/9f48523849523849" class="pr-5 hover:text-primary transition-colors flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.08 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                            </svg>
                            1 800 670 9510 Toll Free (US, CAN)
                        </a>
                        <a href="mailto:hola@intensenerd.com" class="pr-5 hover:text-primary transition-colors flex items-center gap-2 pl-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail">
                                <rect width="20" height="16" x="2" y="4" rx="2" />
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                            </svg>
                            hola@intensenerd.com
                        </a>
                        <a href="https://wa.me/<?php echo esc_attr(intense_nerd_whatsapp_number()); ?>" target="_blank" rel="noopener noreferrer" class="pl-5 hover:text-primary transition-colors flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle">
                                <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
                            </svg>
                            +<?php echo esc_html(intense_nerd_whatsapp_number()); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-header">
            <div class="container-site">
                <nav class="flex items-center justify-between py-4" role="navigation" aria-label="<?php esc_attr_e('Navegación principal', 'intense-nerd-theme'); ?>">

                    <!-- Logotipo -->
                    <div class="flex items-center shrink-0">
                        <?php if (has_custom_logo()) : ?>
                            <div class="w-[140px] md:w-[120px] lg:w-[150px] [&_img]:w-full [&_img]:h-auto [&_img]:object-contain">
                                <?php the_custom_logo(); ?>
                            </div>
                        <?php else : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>"
                                rel="home"
                                class="flex items-center shrink-0"
                                aria-label="<?php bloginfo('name'); ?> — <?php esc_attr_e('Ir a inicio', 'intense-nerd-theme'); ?>">

                                <span class="font-heading text-2xl text-dark font-bold">
                                    <?php bloginfo('name'); ?>
                                </span>
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Menú Desktop -->
                    <div class="hidden lg:flex items-center gap-8">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'primary-menu',
                            'menu_class'     => 'nav-menu',
                            'container'      => false,
                            'fallback_cb'    => false,
                            'depth'          => 2,
                        ]);
                        ?>

                        <!-- CTA en header -->
                        <a href="<?php echo esc_url(home_url('/contacto/')); ?>"
                            class="btn btn-primary text-sm">
                            <?php esc_html_e('Contáctanos', 'intense-nerd-theme'); ?>
                        </a>
                    </div>

                    <!-- Botón Menú Móvil -->
                    <button
                        type="button"
                        class="lg:hidden flex flex-col gap-1.5 p-2 cursor-pointer"
                        data-menu-toggle
                        aria-label="<?php esc_attr_e('Abrir menú', 'intense-nerd-theme'); ?>"
                        aria-expanded="false"
                        aria-controls="mobile-menu">
                        <span class="block w-6 h-0.5 bg-neutral-black transition-all duration-200"></span>
                        <span class="block w-6 h-0.5 bg-neutral-black transition-all duration-200"></span>
                        <span class="block w-6 h-0.5 bg-neutral-black transition-all duration-200"></span>
                    </button>
                </nav>

                <!-- Menú Móvil -->
                <div id="mobile-menu"
                    class="lg:hidden overflow-hidden max-h-0 transition-all duration-300 [&.is-open]:max-h-screen"
                    data-mobile-menu>
                    <div class="py-4 border-t border-neutral-gray">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'primary-menu',
                            'menu_class'     => 'flex flex-col gap-4',
                            'container'      => false,
                            'fallback_cb'    => false,
                            'depth'          => 1,
                        ]);
                        ?>
                        <a href="<?php echo esc_url(home_url('/contacto/')); ?>"
                            class="btn btn-primary inline-block mt-4">
                            <?php esc_html_e('Contáctanos', 'intense-nerd-theme'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- /Site Header -->