<!DOCTYPE html>
<html class="scroll-smooth" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-cream'); ?>>
    <?php wp_body_open(); ?>

    <!-- Site Header -->
    <header class="site-header" role="banner">
        <!-- Top Header -->
        <div class="top-header">
            <div class="container-site">
                <div class="flex items-center justify-end py-2 text-sm text-white font-light tracking-wide">
                    <div class="flex items-center divide-x divide-neutral-gray/50">
                        <a href="https://maps.app.goo.gl/9f48523849523849"
                            class="pr-5 hover:text-primary transition-colors flex items-center gap-2">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.9307 16C15.2362 16 15.4908 15.9 15.6945 15.7C15.8982 15.5 16 15.25 16 14.95V12.5155C16 12.2475 15.9154 12.01 15.7463 11.803C15.5769 11.5958 15.3563 11.4589 15.0845 11.3923L12.9808 10.9615C12.7346 10.9282 12.5099 10.9394 12.3067 10.9952C12.1036 11.0509 11.9206 11.1666 11.7578 11.3422L9.61925 13.5193C8.81925 13.0756 8.08467 12.6041 7.4155 12.1048C6.74617 11.6054 6.12117 11.0653 5.5405 10.4845C4.97767 9.91283 4.44783 9.30742 3.951 8.66825C3.45417 8.02908 3.00067 7.33708 2.5905 6.59225L4.7845 4.54625C4.9435 4.41292 5.05442 4.24175 5.11725 4.03275C5.18008 3.82375 5.18842 3.5795 5.14225 3.3L4.64625 0.9155C4.57442 0.6475 4.43717 0.427917 4.2345 0.25675C4.032 0.0855838 3.79483 0 3.523 0H1.05C0.75 0 0.5 0.101833 0.3 0.305499C0.0999994 0.509166 0 0.76375 0 1.06925C0 2.75508 0.422084 4.48008 1.26625 6.24425C2.11058 8.00842 3.29233 9.65325 4.8115 11.1788C6.33083 12.7044 7.97575 13.8894 9.74625 14.7337C11.5167 15.5779 13.2449 16 14.9307 16ZM2.127 5.65375C1.79233 4.90125 1.52758 4.15317 1.33275 3.4095C1.13792 2.666 1.03083 1.95258 1.0115 1.26925C1.0115 1.19225 1.03717 1.12817 1.0885 1.077C1.13983 1.02567 1.20392 1 1.28075 1H3.327C3.4295 1 3.51283 1.02567 3.577 1.077C3.641 1.12817 3.68583 1.20508 3.7115 1.30775L4.1615 3.427C4.18717 3.50383 4.19042 3.58717 4.17125 3.677C4.15192 3.76667 4.11025 3.83717 4.04625 3.8885L2.127 5.65375ZM10.577 13.977L12.4577 12.0577C12.5217 11.9936 12.5827 11.9519 12.6405 11.9327C12.6982 11.9134 12.7654 11.9166 12.8423 11.9423L14.6923 12.327C14.7949 12.3527 14.8718 12.3975 14.923 12.4615C14.9743 12.5257 15 12.609 15 12.7115V14.7193C15 14.7961 14.9743 14.8602 14.923 14.9115C14.8718 14.9628 14.8077 14.9885 14.7307 14.9885C14.1627 14.977 13.4973 14.8892 12.7345 14.725C11.9718 14.5608 11.2527 14.3115 10.577 13.977Z"
                                    fill="currentColor" />
                            </svg>

                            <span class="md:block hidden"> 1 800 670 9510 Toll Free (US, CAN)</span>
                        </a>
                        <a href="https://wa.me/<?php echo esc_attr(intense_nerd_whatsapp_number()); ?>" target="_blank"
                            rel="noopener noreferrer"
                            class="pr-5 pl-5 hover:text-primary transition-colors flex items-center gap-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_2868_782)">
                                    <path
                                        d="M3 21L4.65 17.2C3.38766 15.4081 2.82267 13.217 3.06104 11.0381C3.29942 8.85918 4.32479 6.84214 5.94471 5.36552C7.56463 3.8889 9.66775 3.05421 11.8594 3.0181C14.051 2.98198 16.1805 3.74693 17.8482 5.16937C19.5159 6.59181 20.6071 8.57398 20.9172 10.7439C21.2272 12.9138 20.7347 15.1222 19.5321 16.9548C18.3295 18.7873 16.4994 20.118 14.3854 20.6971C12.2713 21.2762 10.0186 21.0639 8.05 20.1L3 21Z"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M9 10C9 10.1326 9.05268 10.2598 9.14645 10.3536C9.24021 10.4473 9.36739 10.5 9.5 10.5C9.63261 10.5 9.75979 10.4473 9.85355 10.3536C9.94732 10.2598 10 10.1326 10 10V9C10 8.86739 9.94732 8.74021 9.85355 8.64645C9.75979 8.55268 9.63261 8.5 9.5 8.5C9.36739 8.5 9.24021 8.55268 9.14645 8.64645C9.05268 8.74021 9 8.86739 9 9V10ZM9 10C9 11.3261 9.52678 12.5979 10.4645 13.5355C11.4021 14.4732 12.6739 15 14 15M14 15H15C15.1326 15 15.2598 14.9473 15.3536 14.8536C15.4473 14.7598 15.5 14.6326 15.5 14.5C15.5 14.3674 15.4473 14.2402 15.3536 14.1464C15.2598 14.0527 15.1326 14 15 14H14C13.8674 14 13.7402 14.0527 13.6464 14.1464C13.5527 14.2402 13.5 14.3674 13.5 14.5C13.5 14.6326 13.5527 14.7598 13.6464 14.8536C13.7402 14.9473 13.8674 15 14 15Z"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_2868_782">
                                        <rect width="24" height="24" fill="currentColor" />
                                    </clipPath>
                                </defs>
                            </svg>

                            <span
                                class="md:block hidden">+<?php echo esc_html(intense_nerd_whatsapp_number()); ?></span>
                        </a>
                        <a href="mailto:sales@intenseperu.com"
                            class="hover:text-primary transition-colors flex items-center gap-2 pl-5">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4.6155 19C4.15517 19 3.77083 18.8458 3.4625 18.5375C3.15417 18.2292 3 17.8448 3 17.3845V6.6155C3 6.15517 3.15417 5.77083 3.4625 5.4625C3.77083 5.15417 4.15517 5 4.6155 5H19.3845C19.8448 5 20.2292 5.15417 20.5375 5.4625C20.8458 5.77083 21 6.15517 21 6.6155V17.3845C21 17.8448 20.8458 18.2292 20.5375 18.5375C20.2292 18.8458 19.8448 19 19.3845 19H4.6155ZM12 12.1155L4 6.8845V17.3845C4 17.564 4.05767 17.7115 4.173 17.827C4.2885 17.9423 4.436 18 4.6155 18H19.3845C19.564 18 19.7115 17.9423 19.827 17.827C19.9423 17.7115 20 17.564 20 17.3845V6.8845L12 12.1155ZM12 11L19.6923 6H4.30775L12 11ZM4 6.8845V6V17.3845C4 17.564 4.05767 17.7115 4.173 17.827C4.2885 17.9423 4.436 18 4.6155 18H4V6.8845Z"
                                    fill="currentColor" />
                            </svg>

                            <span class="md:block hidden">sales@intenseperu.com</span>
                        </a>

                    </div>
                </div>
            </div>
        </div>

        <div class="main-header">
            <div class="container-site">
                <nav class="flex items-center justify-between py-4" role="navigation"
                    aria-label="<?php esc_attr_e('Navegación principal', 'intense-nerd-theme'); ?>">

                    <!-- Logotipo -->
                    <div class="flex items-center shrink-0">
                        <?php if (has_custom_logo()): ?>
                            <div
                                class="w-[140px] md:w-[120px] lg:w-[150px] [&_img]:w-full [&_img]:h-auto [&_img]:object-contain">
                                <?php the_custom_logo(); ?>
                            </div>
                        <?php else: ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="flex items-center shrink-0"
                                aria-label="<?php bloginfo('name'); ?> — <?php esc_attr_e('Ir a inicio', 'intense-nerd-theme'); ?>">

                                <span class="font-heading text-2xl text-dark font-medium">
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
                            'menu_class' => 'nav-menu tracking-wide',
                            'container' => false,
                            'fallback_cb' => false,
                            'depth' => 2,
                        ]);
                        ?>

                        <!-- CTA en header -->
                        <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn btn-primary text-sm">
                            <?php esc_html_e('Design your trip', 'intense-nerd-theme'); ?>
                        </a>
                    </div>

                    <!-- Botón CTA -->
                    <a href="<?php echo esc_url(home_url('/contacto/')); ?>"
                        class="btn btn-primary text-sm block lg:hidden">
                        <?php esc_html_e('Design your trip', 'intense-nerd-theme'); ?>
                    </a>

                    <!-- Botón Menú Móvil -->
                    <button type="button" class="lg:hidden flex flex-col gap-1 p-2 cursor-pointer" data-menu-toggle
                        aria-label="<?php esc_attr_e('Abrir menú', 'intense-nerd-theme'); ?>" aria-expanded="false"
                        aria-controls="mobile-menu">
                        <span class="block w-6 h-[2px] bg-white transition-all duration-200"></span>
                        <span class="block w-6 h-[2px] bg-white transition-all duration-200"></span>
                        <span class="block w-6 h-[2px] bg-white transition-all duration-200"></span>
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
                            'menu_class' => 'flex flex-col gap-4',
                            'container' => false,
                            'fallback_cb' => false,
                            'depth' => 1,
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