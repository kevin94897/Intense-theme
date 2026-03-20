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

    <?php $is_light_header = is_page_template('page-contact.php') || is_page_template('page-blog.php') || is_page_template('page-politics.php') || is_page_template('page-faqs.php'); ?>

    <!-- Site Header -->
    <header
        class="site-header <?php echo $is_light_header ? 'is-light relative bg-white' : 'absolute top-0 left-0 right-0 z-50'; ?>"
        role="banner"
        x-data="megaMenu()"
        @keydown.escape.window="closeAll()"
        @click.outside="closeAll()">

        <!-- Top Header -->
        <div class="top-header <?php echo $is_light_header ? 'bg-cream' : ''; ?>">
            <div class="container-site">
                <div class="flex items-center justify-end py-2 text-sm <?php echo $is_light_header ? 'text-dark' : 'text-white'; ?> font-light tracking-wide">
                    <div class="flex items-center divide-x divide-neutral-gray/50">
                        <a href="https://maps.app.goo.gl/9f48523849523849"
                            class="pr-5 hover:text-primary transition-colors flex items-center gap-2">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.9307 16C15.2362 16 15.4908 15.9 15.6945 15.7C15.8982 15.5 16 15.25 16 14.95V12.5155C16 12.2475 15.9154 12.01 15.7463 11.803C15.5769 11.5958 15.3563 11.4589 15.0845 11.3923L12.9808 10.9615C12.7346 10.9282 12.5099 10.9394 12.3067 10.9952C12.1036 11.0509 11.9206 11.1666 11.7578 11.3422L9.61925 13.5193C8.81925 13.0756 8.08467 12.6041 7.4155 12.1048C6.74617 11.6054 6.12117 11.0653 5.5405 10.4845C4.97767 9.91283 4.44783 9.30742 3.951 8.66825C3.45417 8.02908 3.00067 7.33708 2.5905 6.59225L4.7845 4.54625C4.9435 4.41292 5.05442 4.24175 5.11725 4.03275C5.18008 3.82375 5.18842 3.5795 5.14225 3.3L4.64625 0.9155C4.57442 0.6475 4.43717 0.427917 4.2345 0.25675C4.032 0.0855838 3.79483 0 3.523 0H1.05C0.75 0 0.5 0.101833 0.3 0.305499C0.0999994 0.509166 0 0.76375 0 1.06925C0 2.75508 0.422084 4.48008 1.26625 6.24425C2.11058 8.00842 3.29233 9.65325 4.8115 11.1788C6.33083 12.7044 7.97575 13.8894 9.74625 14.7337C11.5167 15.5779 13.2449 16 14.9307 16ZM2.127 5.65375C1.79233 4.90125 1.52758 4.15317 1.33275 3.4095C1.13792 2.666 1.03083 1.95258 1.0115 1.26925C1.0115 1.19225 1.03717 1.12817 1.0885 1.077C1.13983 1.02567 1.20392 1 1.28075 1H3.327C3.4295 1 3.51283 1.02567 3.577 1.077C3.641 1.12817 3.68583 1.20508 3.7115 1.30775L4.1615 3.427C4.18717 3.50383 4.19042 3.58717 4.17125 3.677C4.15192 3.76667 4.11025 3.83717 4.04625 3.8885L2.127 5.65375ZM10.577 13.977L12.4577 12.0577C12.5217 11.9936 12.5827 11.9519 12.6405 11.9327C12.6982 11.9134 12.7654 11.9166 12.8423 11.9423L14.6923 12.327C14.7949 12.3527 14.8718 12.3975 14.923 12.4615C14.9743 12.5257 15 12.609 15 12.7115V14.7193C15 14.7961 14.9743 14.8602 14.923 14.9115C14.8718 14.9628 14.8077 14.9885 14.7307 14.9885C14.1627 14.977 13.4973 14.8892 12.7345 14.725C11.9718 14.5608 11.2527 14.3115 10.577 13.977Z" fill="currentColor" />
                            </svg>
                            <span class="md:block hidden">1 800 670 9510 Toll Free (US, CAN)</span>
                        </a>
                        <a href="https://wa.me/<?php echo esc_attr(intense_nerd_whatsapp_number()); ?>" target="_blank" rel="noopener noreferrer"
                            class="pr-5 pl-5 hover:text-primary transition-colors flex items-center gap-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_2868_782)">
                                    <path d="M3 21L4.65 17.2C3.38766 15.4081 2.82267 13.217 3.06104 11.0381C3.29942 8.85918 4.32479 6.84214 5.94471 5.36552C7.56463 3.8889 9.66775 3.05421 11.8594 3.0181C14.051 2.98198 16.1805 3.74693 17.8482 5.16937C19.5159 6.59181 20.6071 8.57398 20.9172 10.7439C21.2272 12.9138 20.7347 15.1222 19.5321 16.9548C18.3295 18.7873 16.4994 20.118 14.3854 20.6971C12.2713 21.2762 10.0186 21.0639 8.05 20.1L3 21Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9 10C9 10.1326 9.05268 10.2598 9.14645 10.3536C9.24021 10.4473 9.36739 10.5 9.5 10.5C9.63261 10.5 9.75979 10.4473 9.85355 10.3536C9.94732 10.2598 10 10.1326 10 10V9C10 8.86739 9.94732 8.74021 9.85355 8.64645C9.75979 8.55268 9.63261 8.5 9.5 8.5C9.36739 8.5 9.24021 8.55268 9.14645 8.64645C9.05268 8.74021 9 8.86739 9 9V10ZM9 10C9 11.3261 9.52678 12.5979 10.4645 13.5355C11.4021 14.4732 12.6739 15 14 15M14 15H15C15.1326 15 15.2598 14.9473 15.3536 14.8536C15.4473 14.7598 15.5 14.6326 15.5 14.5C15.5 14.3674 15.4473 14.2402 15.3536 14.1464C15.2598 14.0527 15.1326 14 15 14H14C13.8674 14 13.7402 14.0527 13.6464 14.1464C13.5527 14.2402 13.5 14.3674 13.5 14.5C13.5 14.6326 13.5527 14.7598 13.6464 14.8536C13.7402 14.9473 13.8674 15 14 15Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_2868_782">
                                        <rect width="24" height="24" fill="currentColor" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <span class="md:block hidden">+<?php echo esc_html(intense_nerd_whatsapp_number()); ?></span>
                        </a>
                        <a href="mailto:sales@intenseperu.com" class="hover:text-primary transition-colors flex items-center gap-2 pl-5">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.6155 19C4.15517 19 3.77083 18.8458 3.4625 18.5375C3.15417 18.2292 3 17.8448 3 17.3845V6.6155C3 6.15517 3.15417 5.77083 3.4625 5.4625C3.77083 5.15417 4.15517 5 4.6155 5H19.3845C19.8448 5 20.2292 5.15417 20.5375 5.4625C20.8458 5.77083 21 6.15517 21 6.6155V17.3845C21 17.8448 20.8458 18.2292 20.5375 18.5375C20.2292 18.8458 19.8448 19 19.3845 19H4.6155ZM12 12.1155L4 6.8845V17.3845C4 17.564 4.05767 17.7115 4.173 17.827C4.2885 17.9423 4.436 18 4.6155 18H19.3845C19.564 18 19.7115 17.9423 19.827 17.827C19.9423 17.7115 20 17.564 20 17.3845V6.8845L12 12.1155ZM12 11L19.6923 6H4.30775L12 11ZM4 6.8845V6V17.3845C4 17.564 4.05767 17.7115 4.173 17.827C4.2885 17.9423 4.436 18 4.6155 18H4V6.8845Z" fill="currentColor" />
                            </svg>
                            <span class="md:block hidden"><span class="__cf_email__" data-cfemail="9eedfff2fbeddef7f0eafbf0edfbeefbecebb0fdf1f3">sales@intenseperu.com</span></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── Main Nav ─────────────────────────────────────────────── -->
        <div class="main-header">
            <div class="container-site">
                <nav class="flex items-center justify-between py-4" role="navigation"
                    aria-label="<?php esc_attr_e('Navegación principal', 'intense-nerd-theme'); ?>">

                    <!-- Logo -->
                    <div class="flex items-center shrink-0">
                        <?php if (has_custom_logo()): ?>
                            <div class="w-[140px] md:w-[120px] lg:w-[150px] [&_img]:w-full [&_img]:h-auto [&_img]:object-contain">
                                <?php the_custom_logo(); ?>
                            </div>
                        <?php else: ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="flex items-center shrink-0">
                                <span class="font-heading text-2xl text-dark font-medium"><?php bloginfo('name'); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Desktop Nav -->
                    <div class="hidden lg:flex items-center gap-8">

                        <?php
                        // Get the primary menu items to render manually with megamenu support
                        $menu_locations = get_nav_menu_locations();
                        $menu_obj = isset($menu_locations['primary-menu']) ? wp_get_nav_menu_object($menu_locations['primary-menu']) : null;
                        $menu_items = $menu_obj ? wp_get_nav_menu_items($menu_obj->term_id) : [];

                        if ($menu_items):
                            foreach ($menu_items as $item):
                                // Only top-level items
                                if ($item->menu_item_parent != 0) continue;

                                $classes     = implode(' ', $item->classes);
                                $has_journeys     = strpos($classes, 'mega-journeys') !== false;
                                $has_destinations = strpos($classes, 'mega-destinations') !== false;
                                $has_blog         = strpos($classes, 'mega-blog') !== false;
                                $has_mega         = $has_journeys || $has_destinations || $has_blog;

                                $mega_key = $has_journeys ? 'journeys' : ($has_destinations ? 'destinations' : ($has_blog ? 'blog' : ''));
                        ?>

                                <?php if ($has_mega): ?>
                                    <!-- Mega trigger: <?php echo esc_html($item->title); ?> -->
                                    <div class="relative" x-data>
                                        <button
                                            type="button"
                                            @click="toggle('<?php echo $mega_key; ?>')"
                                            :aria-expanded="active === '<?php echo $mega_key; ?>'"
                                            class="nav-link flex items-center gap-1 font-body text-sm tracking-wide transition-colors <?php echo $is_light_header ? 'text-dark hover:text-primary' : 'text-white hover:text-white/70'; ?>">
                                            <?php echo esc_html($item->title); ?>
                                            <svg class="w-3.5 h-3.5 transition-transform duration-200"
                                                :class="active === '<?php echo $mega_key; ?>' ? 'rotate-180' : ''"
                                                fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path d="M6 9l6 6 6-6" />
                                            </svg>
                                        </button>
                                    </div>

                                <?php else: ?>
                                    <!-- Regular link -->
                                    <a href="<?php echo esc_url($item->url); ?>"
                                        class="nav-link font-body text-sm tracking-wide transition-colors <?php echo $is_light_header ? 'text-dark hover:text-primary' : 'text-white hover:text-white/70'; ?>">
                                        <?php echo esc_html($item->title); ?>
                                    </a>
                                <?php endif; ?>

                        <?php endforeach;
                        endif; ?>

                        <!-- CTA -->
                        <a href="<?php echo esc_url(home_url('/design-your-trip/')); ?>" class="btn btn-primary text-sm">
                            <?php esc_html_e('Design your trip', 'intense-nerd-theme'); ?>
                        </a>
                    </div>

                    <!-- Tablet CTA -->
                    <a href="<?php echo esc_url(home_url('/design-your-trip/')); ?>"
                        class="btn btn-primary text-sm hidden sm:block lg:hidden">
                        <?php esc_html_e('Design your trip', 'intense-nerd-theme'); ?>
                    </a>

                    <!-- Mobile hamburger -->
                    <button
                        type="button"
                        class="lg:hidden flex flex-col justify-center gap-[5px] w-10 h-10 cursor-pointer <?php echo $is_light_header ? 'text-dark' : 'text-white'; ?>"
                        @click="mobileOpen = true"
                        aria-label="<?php esc_attr_e('Abrir menú', 'intense-nerd-theme'); ?>"
                        :aria-expanded="mobileOpen">
                        <span class="block w-6 min-h-[1.5px] bg-current transition-all duration-200"></span>
                        <span class="block w-6 min-h-[1.5px] bg-current transition-all duration-200"></span>
                        <span class="block w-4 min-h-[1.5px] bg-current transition-all duration-200"></span>
                    </button>
                </nav>
            </div>
        </div>

        <!-- ══════════════════════════════════════════════════════════
             MOBILE DRAWER  (full-screen, slide between views)
        ══════════════════════════════════════════════════════════ -->
        <div
            x-show="mobileOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="lg:hidden fixed inset-0 z-[100] bg-cream flex flex-col overflow-hidden"
            style="display:none;">

            <!-- ── Drawer header: replica del site header ── -->

            <!-- Contact row (top) -->
            <div class="container-site">
                <div class="flex items-center justify-end py-2 text-sm text-dark font-light tracking-wide">
                    <div class="flex items-center divide-x divide-neutral-gray/50">
                        <a href="https://maps.app.goo.gl/9f48523849523849"
                            class="pr-5 hover:text-primary transition-colors flex items-center gap-2">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.9307 16C15.2362 16 15.4908 15.9 15.6945 15.7C15.8982 15.5 16 15.25 16 14.95V12.5155C16 12.2475 15.9154 12.01 15.7463 11.803C15.5769 11.5958 15.3563 11.4589 15.0845 11.3923L12.9808 10.9615C12.7346 10.9282 12.5099 10.9394 12.3067 10.9952C12.1036 11.0509 11.9206 11.1666 11.7578 11.3422L9.61925 13.5193C8.81925 13.0756 8.08467 12.6041 7.4155 12.1048C6.74617 11.6054 6.12117 11.0653 5.5405 10.4845C4.97767 9.91283 4.44783 9.30742 3.951 8.66825C3.45417 8.02908 3.00067 7.33708 2.5905 6.59225L4.7845 4.54625C4.9435 4.41292 5.05442 4.24175 5.11725 4.03275C5.18008 3.82375 5.18842 3.5795 5.14225 3.3L4.64625 0.9155C4.57442 0.6475 4.43717 0.427917 4.2345 0.25675C4.032 0.0855838 3.79483 0 3.523 0H1.05C0.75 0 0.5 0.101833 0.3 0.305499C0.0999994 0.509166 0 0.76375 0 1.06925C0 2.75508 0.422084 4.48008 1.26625 6.24425C2.11058 8.00842 3.29233 9.65325 4.8115 11.1788C6.33083 12.7044 7.97575 13.8894 9.74625 14.7337C11.5167 15.5779 13.2449 16 14.9307 16ZM2.127 5.65375C1.79233 4.90125 1.52758 4.15317 1.33275 3.4095C1.13792 2.666 1.03083 1.95258 1.0115 1.26925C1.0115 1.19225 1.03717 1.12817 1.0885 1.077C1.13983 1.02567 1.20392 1 1.28075 1H3.327C3.4295 1 3.51283 1.02567 3.577 1.077C3.641 1.12817 3.68583 1.20508 3.7115 1.30775L4.1615 3.427C4.18717 3.50383 4.19042 3.58717 4.17125 3.677C4.15192 3.76667 4.11025 3.83717 4.04625 3.8885L2.127 5.65375ZM10.577 13.977L12.4577 12.0577C12.5217 11.9936 12.5827 11.9519 12.6405 11.9327C12.6982 11.9134 12.7654 11.9166 12.8423 11.9423L14.6923 12.327C14.7949 12.3527 14.8718 12.3975 14.923 12.4615C14.9743 12.5257 15 12.609 15 12.7115V14.7193C15 14.7961 14.9743 14.8602 14.923 14.9115C14.8718 14.9628 14.8077 14.9885 14.7307 14.9885C14.1627 14.977 13.4973 14.8892 12.7345 14.725C11.9718 14.5608 11.2527 14.3115 10.577 13.977Z" fill="currentColor" />
                            </svg>
                            <span class="md:block hidden">1 800 670 9510 Toll Free (US, CAN)</span>
                        </a>
                        <a href="https://wa.me/<?php echo esc_attr(intense_nerd_whatsapp_number()); ?>" target="_blank" rel="noopener noreferrer"
                            class="pr-5 pl-5 hover:text-primary transition-colors flex items-center gap-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_2868_782)">
                                    <path d="M3 21L4.65 17.2C3.38766 15.4081 2.82267 13.217 3.06104 11.0381C3.29942 8.85918 4.32479 6.84214 5.94471 5.36552C7.56463 3.8889 9.66775 3.05421 11.8594 3.0181C14.051 2.98198 16.1805 3.74693 17.8482 5.16937C19.5159 6.59181 20.6071 8.57398 20.9172 10.7439C21.2272 12.9138 20.7347 15.1222 19.5321 16.9548C18.3295 18.7873 16.4994 20.118 14.3854 20.6971C12.2713 21.2762 10.0186 21.0639 8.05 20.1L3 21Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9 10C9 10.1326 9.05268 10.2598 9.14645 10.3536C9.24021 10.4473 9.36739 10.5 9.5 10.5C9.63261 10.5 9.75979 10.4473 9.85355 10.3536C9.94732 10.2598 10 10.1326 10 10V9C10 8.86739 9.94732 8.74021 9.85355 8.64645C9.75979 8.55268 9.63261 8.5 9.5 8.5C9.36739 8.5 9.24021 8.55268 9.14645 8.64645C9.05268 8.74021 9 8.86739 9 9V10ZM9 10C9 11.3261 9.52678 12.5979 10.4645 13.5355C11.4021 14.4732 12.6739 15 14 15M14 15H15C15.1326 15 15.2598 14.9473 15.3536 14.8536C15.4473 14.7598 15.5 14.6326 15.5 14.5C15.5 14.3674 15.4473 14.2402 15.3536 14.1464C15.2598 14.0527 15.1326 14 15 14H14C13.8674 14 13.7402 14.0527 13.6464 14.1464C13.5527 14.2402 13.5 14.3674 13.5 14.5C13.5 14.6326 13.5527 14.7598 13.6464 14.8536C13.7402 14.9473 13.8674 15 14 15Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_2868_782">
                                        <rect width="24" height="24" fill="currentColor" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <span class="md:block hidden">+<?php echo esc_html(intense_nerd_whatsapp_number()); ?></span>
                        </a>
                        <a href="mailto:sales@intenseperu.com" class="hover:text-primary transition-colors flex items-center gap-2 pl-5">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.6155 19C4.15517 19 3.77083 18.8458 3.4625 18.5375C3.15417 18.2292 3 17.8448 3 17.3845V6.6155C3 6.15517 3.15417 5.77083 3.4625 5.4625C3.77083 5.15417 4.15517 5 4.6155 5H19.3845C19.8448 5 20.2292 5.15417 20.5375 5.4625C20.8458 5.77083 21 6.15517 21 6.6155V17.3845C21 17.8448 20.8458 18.2292 20.5375 18.5375C20.2292 18.8458 19.8448 19 19.3845 19H4.6155ZM12 12.1155L4 6.8845V17.3845C4 17.564 4.05767 17.7115 4.173 17.827C4.2885 17.9423 4.436 18 4.6155 18H19.3845C19.564 18 19.7115 17.9423 19.827 17.827C19.9423 17.7115 20 17.564 20 17.3845V6.8845L12 12.1155ZM12 11L19.6923 6H4.30775L12 11ZM4 6.8845V6V17.3845C4 17.564 4.05767 17.7115 4.173 17.827C4.2885 17.9423 4.436 18 4.6155 18H4V6.8845Z" fill="currentColor" />
                            </svg>
                            <span class="md:block hidden"><span class="__cf_email__" data-cfemail="9eedfff2fbeddef7f0eafbf0edfbeefbecebb0fdf1f3">sales@intenseperu.com</span></span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Logo + CTA + close (hamburger → X) -->
            <div class="flex items-center justify-between px-5 py-4">
                <!-- Logo -->
                <div class="shrink-0">
                    <?php if (has_custom_logo()): ?>
                        <div class="w-[110px] [&_img]:w-full [&_img]:h-auto [&_img]:object-contain [&_img]:brightness-0">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="font-heading text-xl text-dark font-medium">
                            <?php bloginfo('name'); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- CTA + Close button -->
                <div class="flex items-center gap-3">
                    <a href="<?php echo esc_url(home_url('/design-your-trip/')); ?>"
                        class="btn btn-primary text-sm">
                        <?php esc_html_e('Design your trip', 'intense-nerd-theme'); ?>
                    </a>
                    <!-- Hamburger → X  (3 lines collapse to X) -->
                    <button
                        type="button"
                        @click="mobileClose()"
                        aria-label="<?php esc_attr_e('Cerrar menú', 'intense-nerd-theme'); ?>"
                        class="flex flex-col justify-center gap-[5px] h-10 text-dark cursor-pointer">
                        <span class="block w-6 h-[1.5px] bg-current origin-center rotate-45 translate-y-[6.5px] transition-all duration-200"></span>
                        <span class="block w-6 h-[1.5px] bg-current opacity-0 transition-all duration-200"></span>
                        <span class="block w-6 h-[1.5px] bg-current origin-center -rotate-45 -translate-y-[6.5px] transition-all duration-200"></span>
                    </button>
                </div>
            </div>

            <!-- ── Slide container ── -->
            <div class="flex-1 relative overflow-hidden">

                <!-- VIEW 1: Main menu list -->
                <div
                    class="absolute inset-0 flex flex-col overflow-y-auto transition-transform duration-300"
                    :class="mobilePanel ? '-translate-x-full' : 'translate-x-0'">

                    <nav class="flex-1 px-6 pt-6">
                        <?php
                        $menu_locations = get_nav_menu_locations();
                        $menu_obj_m = isset($menu_locations['primary-menu']) ? wp_get_nav_menu_object($menu_locations['primary-menu']) : null;
                        $menu_items_m = $menu_obj_m ? wp_get_nav_menu_items($menu_obj_m->term_id) : [];

                        if ($menu_items_m):
                            foreach ($menu_items_m as $item_m):
                                if ($item_m->menu_item_parent != 0) continue;

                                $classes_m    = implode(' ', $item_m->classes);
                                $has_sub      = strpos($classes_m, 'mega-journeys') !== false
                                    || strpos($classes_m, 'mega-destinations') !== false
                                    || strpos($classes_m, 'mega-blog') !== false;

                                $panel_key_m = '';
                                if (strpos($classes_m, 'mega-journeys') !== false)     $panel_key_m = 'journeys';
                                elseif (strpos($classes_m, 'mega-destinations') !== false) $panel_key_m = 'destinations';
                                elseif (strpos($classes_m, 'mega-blog') !== false)     $panel_key_m = 'blog';
                        ?>
                                <div class="border-b border-dark/10">
                                    <?php if ($has_sub): ?>
                                        <button
                                            type="button"
                                            @click="openMobilePanel('<?php echo $panel_key_m; ?>')"
                                            class="w-full flex items-center justify-between py-5 text-left font-body text-dark text-base hover:text-primary transition-colors">
                                            <span><?php echo esc_html($item_m->title); ?></span>
                                            <!-- Chevron right -->
                                            <svg class="w-4 h-4 text-dark/40" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path d="M9 18l6-6-6-6" />
                                            </svg>
                                        </button>
                                    <?php else: ?>
                                        <a href="<?php echo esc_url($item_m->url); ?>"
                                            @click="mobileClose()"
                                            class="flex items-center justify-between py-5 font-body text-dark text-base hover:text-primary transition-colors">
                                            <?php echo esc_html($item_m->title); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                        <?php endforeach;
                        endif; ?>
                    </nav>
                </div>

                <!-- VIEW 2: Sub-panel — cubre todo el drawer incluyendo el header -->
                <div
                    class="fixed inset-0 z-[110] bg-cream flex flex-col transition-transform duration-300"
                    :class="mobilePanel ? 'translate-x-0' : 'translate-x-full'">

                    <!-- Sub-panel: back ← + logo + X -->
                    <div class="flex items-center justify-between px-5 py-4 shrink-0">
                        <button
                            type="button"
                            @click="mobilePanel = null"
                            class="text-dark hover:text-primary transition-colors cursor-pointer"
                            aria-label="Volver">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path d="M19 12H5M5 12l7 7M5 12l7-7" />
                            </svg>
                        </button>
                        <button
                            type="button"
                            @click="mobileClose()"
                            class="flex flex-col justify-center gap-[5px] h-10 text-dark cursor-pointer"
                            aria-label="Cerrar">
                            <span class="block w-6 h-[1.5px] bg-current origin-center rotate-45 translate-y-[6.5px]"></span>
                            <span class="block w-6 h-[1.5px] bg-current opacity-0"></span>
                            <span class="block w-6 h-[1.5px] bg-current origin-center -rotate-45 -translate-y-[6.5px]"></span>
                        </button>
                    </div>

                    <!-- Sub-panel content -->
                    <div class="flex-1 overflow-y-auto px-6 py-6">

                        <!-- JOURNEYS sub-panel -->
                        <div x-show="mobilePanel === 'journeys'">
                            <a href="<?php echo esc_url(home_url('/journeys/')); ?>"
                                @click="mobileClose()"
                                class="block font-body text-dark text-base font-medium mb-6 hover:text-primary transition-colors">
                                <?php esc_html_e('See All Journeys', 'intense-nerd-theme'); ?>
                            </a>

                            <div class="mb-6">
                                <h3 class="font-heading text-dark text-xl mb-3 pl-2">Grand discovery</h3>
                                <ul class="flex flex-col gap-3 pl-4" id="mob-grand-list">
                                    <li><span class="text-dark/30 text-sm">Loading…</span></li>
                                </ul>
                            </div>

                            <div class="mb-6">
                                <h3 class="font-heading text-dark text-xl mb-3 pl-2">Compact Journeys</h3>
                                <ul class="flex flex-col gap-3 pl-4" id="mob-compact-list">
                                    <li><span class="text-dark/30 text-sm">Loading…</span></li>
                                </ul>
                            </div>

                            <div>
                                <h3 class="font-heading text-dark text-xl mb-3 pl-2">Short Escapes</h3>
                                <ul class="flex flex-col gap-3 pl-4" id="mob-short-list">
                                    <li><span class="text-dark/30 text-sm">Loading…</span></li>
                                </ul>
                            </div>
                        </div>

                        <!-- DESTINATIONS sub-panel -->
                        <div x-show="mobilePanel === 'destinations'">
                            <a href="<?php echo esc_url(home_url('/destinations/')); ?>"
                                @click="mobileClose()"
                                class="block font-body text-dark text-base font-medium mb-6 hover:text-primary transition-colors">
                                <?php esc_html_e('See All Destinations', 'intense-nerd-theme'); ?>
                            </a>
                            <div class="grid grid-cols-2 gap-3" id="mob-destination-cards">
                                <?php for ($i = 0; $i < 6; $i++): ?>
                                    <div class="animate-pulse">
                                        <div class="aspect-square bg-dark/10 rounded-lg mb-1.5"></div>
                                        <div class="h-3 bg-dark/10 rounded w-2/3"></div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>

                        <!-- BLOG sub-panel -->
                        <div x-show="mobilePanel === 'blog'">
                            <a href="<?php echo esc_url(home_url('/blog/')); ?>"
                                @click="mobileClose()"
                                class="block font-body text-dark text-base font-medium mb-6 hover:text-primary transition-colors">
                                <?php esc_html_e('See All Posts', 'intense-nerd-theme'); ?>
                            </a>
                            <h3 class="font-heading text-dark text-xl mb-3 pl-2">Featured Blogs</h3>
                            <ul class="flex flex-col pl-4" id="mob-blog-list">
                                <li><span class="text-dark/30 text-xs">Loading…</span></li>
                            </ul>
                        </div>

                    </div>
                </div>

            </div><!-- /.slide container -->

            <!-- ── Bottom bar: Language selector ── -->
            <div class="shrink-0 flex items-center justify-between px-6 py-4 border-t border-dark/10 bg-cream">
                <span class="font-body text-dark/60 text-sm"><?php esc_html_e('Language', 'intense-nerd-theme'); ?></span>
                <?php
                // WPML language switcher if available, otherwise static fallback
                if (function_exists('icl_get_languages')):
                    $languages = icl_get_languages('skip_missing=0&orderby=code');
                    if (!empty($languages)):
                ?>
                        <div class="relative" x-data="{ langOpen: false }">
                            <button @click="langOpen = !langOpen"
                                class="flex items-center gap-1.5 font-body text-primary text-sm font-medium">
                                <?php foreach ($languages as $lang): if ($lang['active']): ?>
                                        <span><?php echo esc_html($lang['native_name']); ?></span>
                                <?php endif;
                                endforeach; ?>
                                <svg class="w-3.5 h-3.5 transition-transform" :class="langOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path d="M6 9l6 6 6-6" />
                                </svg>
                            </button>
                            <div x-show="langOpen" @click.outside="langOpen=false"
                                class="absolute bottom-full right-0 mb-2 bg-white border border-dark/10 rounded-xl shadow-lg overflow-hidden min-w-[120px]">
                                <?php foreach ($languages as $lang): ?>
                                    <a href="<?php echo esc_url($lang['url']); ?>"
                                        class="block px-4 py-2.5 text-sm font-body text-dark hover:text-primary hover:bg-cream transition-colors <?php echo $lang['active'] ? 'text-primary font-medium' : ''; ?>">
                                        <?php echo esc_html($lang['native_name']); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <span class="font-body text-primary text-sm font-medium">English
                            <svg class="inline w-3.5 h-3.5 ml-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M6 9l6 6 6-6" />
                            </svg>
                        </span>
                    <?php endif;
                else: ?>
                    <span class="font-body text-primary text-sm font-medium">English
                        <svg class="inline w-3.5 h-3.5 ml-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M6 9l6 6 6-6" />
                        </svg>
                    </span>
                <?php endif; ?>
            </div>

        </div><!-- /.mobile drawer -->

        <!-- ══════════════════════════════════════════════════════════
             MEGAMENU PANELS  (full-width, below header)
        ══════════════════════════════════════════════════════════ -->

        <!-- ── JOURNEYS megamenu ──────────────────────────────────── -->
        <div
            x-show="active === 'journeys'"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="mega-panel absolute left-0 right-0 bg-white shadow-2xl border-t border-gray-100 z-40"
            @mouseenter="cancelClose()"
            @mouseleave="scheduleClose()">

            <div class="container-site py-10">
                <div class="flex gap-8">

                    <!-- Col 1: Grand Discovery (10–15 days) -->
                    <div class="w-44 shrink-0">
                        <h3 class="font-heading text-dark text-lg mb-4">Grand discovery</h3>
                        <ul class="flex flex-col gap-2.5" id="mega-grand-list">
                            <li><span class="text-dark/30 text-sm">Loading…</span></li>
                        </ul>
                    </div>

                    <!-- Col 2: Compact Journeys (5–9 days) -->
                    <div class="w-44 shrink-0">
                        <h3 class="font-heading text-dark text-lg mb-4">Compact Journeys</h3>
                        <ul class="flex flex-col gap-2.5" id="mega-compact-list">
                            <li><span class="text-dark/30 text-sm">Loading…</span></li>
                        </ul>
                    </div>

                    <!-- Col 3: Short Escapes (2–4 days) -->
                    <div class="w-44 shrink-0">
                        <h3 class="font-heading text-dark text-lg mb-4">Short Escapes</h3>
                        <ul class="flex flex-col gap-2.5" id="mega-short-list">
                            <li><span class="text-dark/30 text-sm">Loading…</span></li>
                        </ul>
                    </div>

                    <!-- Spacer -->
                    <div class="flex-1"></div>

                    <!-- Right: 3 recent journey cards + See All -->
                    <div class="shrink-0 flex flex-col gap-3">
                        <div class="flex items-center justify-end mb-1">
                            <a href="<?php echo esc_url(home_url('/journeys/')); ?>"
                                class="flex items-center gap-2 text-sm font-body text-dark hover:text-primary transition-colors">
                                See All
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                        <div class="flex gap-4" id="mega-journey-cards">
                            <?php for ($i = 0; $i < 3; $i++): ?>
                                <div class="w-44 animate-pulse">
                                    <div class="aspect-[3/4] bg-dark/10 rounded-lg mb-2"></div>
                                    <div class="h-3 bg-dark/10 rounded w-3/4"></div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- ── DESTINATIONS megamenu ──────────────────────────────── -->
        <div
            x-show="active === 'destinations'"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="mega-panel absolute left-0 right-0 bg-white shadow-2xl border-t border-gray-100 z-40"
            @mouseenter="cancelClose()"
            @mouseleave="scheduleClose()">

            <div class="container-site py-10">
                <!-- See All row -->
                <div class="flex justify-end mb-6">
                    <a href="<?php echo esc_url(home_url('/destinations/')); ?>"
                        class="flex items-center gap-2 text-sm font-body text-dark hover:text-primary transition-colors">
                        See All
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
                <!-- 6-card grid -->
                <div class="grid grid-cols-6 gap-4" id="mega-destination-cards">
                    <?php for ($i = 0; $i < 6; $i++): ?>
                        <div class="animate-pulse">
                            <div class="aspect-[3/4] bg-dark/10 rounded-lg mb-2"></div>
                            <div class="h-3 bg-dark/10 rounded w-3/4"></div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>

        <!-- ── BLOG megamenu ──────────────────────────────────────── -->
        <div
            x-show="active === 'blog'"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="mega-panel absolute left-0 right-0 bg-white shadow-2xl border-t border-gray-100 z-40"
            @mouseenter="cancelClose()"
            @mouseleave="scheduleClose()">

            <div class="container-site py-10">
                <div class="flex gap-10">

                    <!-- Left col: recent posts list -->
                    <div class="w-64 shrink-0">
                        <h3 class="font-heading text-dark text-lg mb-4">Featured Blogs</h3>
                        <ul class="flex flex-col gap-3" id="mega-blog-list">
                            <li><span class="text-dark/30 text-sm">Loading…</span></li>
                        </ul>
                    </div>

                    <!-- Right: featured post cards + See All -->
                    <div class="flex-1 flex flex-col gap-3">
                        <div class="flex items-center justify-end mb-1">
                            <a href="<?php echo esc_url(home_url('/blog/')); ?>"
                                class="flex items-center gap-2 text-sm font-body text-dark hover:text-primary transition-colors">
                                See All
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                        <div class="grid grid-cols-4 gap-4" id="mega-blog-cards">
                            <?php for ($i = 0; $i < 4; $i++): ?>
                                <div class="animate-pulse">
                                    <div class="aspect-[4/3] bg-dark/10 rounded-lg mb-2"></div>
                                    <div class="h-3 bg-dark/10 rounded w-3/4"></div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- ── /BLOG megamenu ─────────────────────────────────────── -->

    </header>
    <!-- /Site Header -->