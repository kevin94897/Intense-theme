<!-- Footer -->
<footer class="bg-dark text-cream pt-16 pb-8" role="contentinfo">
    <div class="container-site">

        <!-- Footer Top: 4 Columns -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">

            <!-- Column 1: Get in Touch with Us -->
            <?php
            $phone = get_theme_mod('contact_phone', '18006709510');
            $phone_text = get_theme_mod('contact_phone_text', '1 800 670 9510 Toll Free (US, CAN)');
            $whatsapp = get_theme_mod('contact_whatsapp', '51994008833');
            $email = get_theme_mod('contact_email', 'sales@intenseperu.com');
            ?>

            <!-- Column 1: Get in Touch with Us -->
            <div>
                <h4 class="font-heading text-xl mb-6">Reservations</h4>

                <ul class="flex flex-col gap-4">

                    <!-- Phone -->
                    <li>
                        <a href="tel:<?php echo esc_attr($phone); ?>" class="flex items-center gap-3 text-cream/80 hover:text-primary transition-colors duration-200">

                            <svg class="w-5 h-5 fill-none stroke-current" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.54-4.24-7.136-7.136l1.292-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>

                            <span class="text-sm text-cream/80 hover:text-primary transition-colors duration-200">
                                <?php echo esc_html($phone_text); ?>
                            </span>
                        </a>
                    </li>

                    <!-- WhatsApp -->
                    <li>
                        <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>" target="_blank" rel="noopener" class="flex items-center gap-3 text-cream/80 hover:text-primary transition-colors duration-200">

                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347" />
                            </svg>

                            <span class="text-sm text-cream/80 hover:text-primary transition-colors duration-200">
                                +<?php echo esc_html($whatsapp); ?>
                            </span>
                        </a>
                    </li>

                    <!-- Email -->
                    <li>
                        <a href="mailto:<?php echo esc_attr($email); ?>" class="flex items-center gap-3 text-cream/80 hover:text-primary transition-colors duration-200">

                            <svg class="w-5 h-5 fill-none stroke-current" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>

                            <span class="text-sm text-cream/80 hover:text-primary transition-colors duration-200">
                                <?php echo esc_html($email); ?>
                            </span>
                        </a>
                    </li>

                </ul>
            </div>
            <!-- Column 2: Get in Touch with Us (Links) -->
            <div>
                <h4 class="font-heading text-xl mb-6">Explore Intense Peru</h4>
                <?php
                if (has_nav_menu('footer-explore')) {
                    wp_nav_menu([
                        'theme_location' => 'footer-explore',
                        'container'      => false,
                        'menu_class'     => 'flex flex-col gap-4',
                        'fallback_cb'    => false,
                        'link_before'    => '<span class="text-sm text-cream/80 hover:text-primary transition-colors duration-200">',
                        'link_after'     => '</span>',
                    ]);
                } else {
                    echo '<p class="text-sm text-cream/50">Asigna un menú en Apariencia > Menús.</p>';
                }
                ?>
            </div>

            <!-- Column 3: General -->
            <div>
                <h4 class="font-heading text-xl mb-6">General</h4>
                <?php
                if (has_nav_menu('footer-general')) {
                    wp_nav_menu([
                        'theme_location' => 'footer-general',
                        'container'      => false,
                        'menu_class'     => 'flex flex-col gap-4',
                        'fallback_cb'    => false,
                        'link_before'    => '<span class="text-sm text-cream/80 hover:text-primary transition-colors duration-200">',
                        'link_after'     => '</span>',
                    ]);
                } else {
                    echo '<p class="text-sm text-cream/50">Asigna un menú en Apariencia > Menús.</p>';
                }
                ?>
                <div class="pt-4">
                    <a href="<?php echo esc_url(site_url('/libro-de-reclamaciones')); ?>" class="flex flex-col items-start gap-1 text-cream/80 hover:text-primary transition-colors duration-200">
                        <svg width="94" height="59" viewBox="0 0 94 59" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="94" height="59" fill="url(#pattern0_3089_16234)" />
                            <defs>
                                <pattern id="pattern0_3089_16234" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0_3089_16234" transform="matrix(0.0031746 0 0 0.00505784 0 -0.00325531)" />
                                </pattern>
                                <image id="image0_3089_16234" width="315" height="199" preserveAspectRatio="none" xlink:href="data:image/png;base64,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" />
                            </defs>
                        </svg>

                    </a>
                </div>
            </div>

            <!-- Column 4: Stay connected -->
            <div>
                <h4 class="font-heading text-xl mb-6">Stay connected</h4>
                <p class="text-sm text-cream/80 mb-6 max-w-sm">
                    Subscribe to receive curated travel inspiration from Peru.
                </p>

                <form class="flex flex-col gap-6 mb-8 w-full max-w-sm" action="#" method="POST">
                    <div class="input-wrapper">
                        <!-- Custom inline styles to enforce white border logic for the dark footer -->
                        <input type="text" placeholder="Nombre" required class="w-full bg-transparent pb-2 text-sm outline-none transition-colors" style="border: none; border-bottom: 1px solid rgba(255,252,247,0.5); color: #fffcf7;" onfocus="this.style.borderBottom='1px solid #fffcf7'" onblur="this.style.borderBottom='1px solid rgba(255,252,247,0.5)'" />
                    </div>
                    <div class="input-wrapper">
                        <input type="email" placeholder="Email" required class="w-full bg-transparent pb-2 text-sm outline-none transition-colors" style="border: none; border-bottom: 1px solid rgba(255,252,247,0.5); color: #fffcf7;" onfocus="this.style.borderBottom='1px solid #fffcf7'" onblur="this.style.borderBottom='1px solid rgba(255,252,247,0.5)'" />
                    </div>
                    <div>
                        <button type="submit" class="w-full cursor-pointer btn-outline-light py-3 rounded-full text-sm font-medium transition-colors hover:bg-cream hover:text-dark">
                            Subscribe
                        </button>
                    </div>
                </form>

                <div class="flex items-center gap-4">
                    <span class="font-semibold text-sm">Follow us:</span>

                    <div class="flex gap-3">

                        <?php
                        $socials = [
                            'facebook'  => get_theme_mod('social_facebook'),
                            'instagram' => get_theme_mod('social_instagram'),
                            'twitter'   => get_theme_mod('social_twitter'),
                            'linkedin'  => get_theme_mod('social_linkedin'),
                        ];

                        foreach ($socials as $key => $url) :
                            if ($url) :
                        ?>

                                <a href="<?php echo esc_url($url); ?>"
                                    target="_blank"
                                    rel="noopener"
                                    aria-label="<?php echo esc_attr(ucfirst($key)); ?>"
                                    class="w-8 h-8 rounded-full flex items-center justify-center transition-colors duration-200">

                                    <?php if ($key === 'instagram') : ?>
                                        <!-- Instagram -->
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 24 24">
                                            <path d="M 8 3 C 5.239 3 3 5.239 3 8 L 3 16 C 3 18.761 5.239 21 8 21 L 16 21 C 18.761 21 21 18.761 21 16 L 21 8 C 21 5.239 18.761 3 16 3 L 8 3 z M 18 5 C 18.552 5 19 5.448 19 6 C 19 6.552 18.552 7 18 7 C 17.448 7 17 6.552 17 6 C 17 5.448 17.448 5 18 5 z M 12 7 C 14.761 7 17 9.239 17 12 C 17 14.761 14.761 17 12 17 C 9.239 17 7 14.761 7 12 C 7 9.239 9.239 7 12 7 z M 12 9 A 3 3 0 0 0 9 12 A 3 3 0 0 0 12 15 A 3 3 0 0 0 15 12 A 3 3 0 0 0 12 9 z" fill="#fffcf7"></path>
                                        </svg>

                                    <?php elseif ($key === 'facebook') : ?>
                                        <!-- Facebook -->
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 24 24">
                                            <path d="M12,2C6.477,2,2,6.477,2,12c0,5.013,3.693,9.153,8.505,9.876V14.65H8.031v-2.629h2.474v-1.749 c0-2.896,1.411-4.167,3.818-4.167c1.153,0,1.762,0.085,2.051,0.124v2.294h-1.642c-1.022,0-1.379,0.969-1.379,2.061v1.437h2.995 l-0.406,2.629h-2.588v7.247C18.235,21.236,22,17.062,22,12C22,6.477,17.523,2,12,2z" fill="#fffcf7"></path>
                                        </svg>

                                    <?php elseif ($key === 'twitter') : ?>
                                        <!-- Twitter / X -->
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 24 24">
                                            <path d="M22,3.999c-0.78,0.463-2.345,1.094-3.265,1.276c-0.027,0.007-0.049,0.016-0.075,0.023c-0.813-0.802-1.927-1.299-3.16-1.299 c-2.485,0-4.5,2.015-4.5,4.5c0,0.131-0.011,0.372,0,0.5c-3.353,0-5.905-1.756-7.735-4c-0.199,0.5-0.286,1.29-0.286,2.032 c0,1.401,1.095,2.777,2.8,3.63c-0.314,0.081-0.66,0.139-1.02,0.139c-0.581,0-1.196-0.153-1.759-0.617c0,0.017,0,0.033,0,0.051 c0,1.958,2.078,3.291,3.926,3.662c-0.375,0.221-1.131,0.243-1.5,0.243c-0.26,0-1.18-0.119-1.426-0.165 c0.514,1.605,2.368,2.507,4.135,2.539c-1.382,1.084-2.341,1.486-5.171,1.486H2C3.788,19.145,6.065,20,8.347,20 C15.777,20,20,14.337,20,8.999c0-0.086-0.002-0.266-0.005-0.447C19.995,8.534,20,8.517,20,8.499c0-0.027-0.008-0.053-0.008-0.08 c-0.003-0.136-0.006-0.263-0.009-0.329c0.79-0.57,1.475-1.281,2.017-2.091c-0.725,0.322-1.503,0.538-2.32,0.636 C20.514,6.135,21.699,4.943,22,3.999z" fill="#fffcf7"></path>
                                        </svg>

                                    <?php elseif ($key === 'linkedin') : ?>
                                        <!-- LinkedIn -->
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 24 24">
                                            <path d="M19,3H5C3.895,3,3,3.895,3,5v14c0,1.105,0.895,2,2,2h14c1.105,0,2-0.895,2-2V5C21,3.895,20.105,3,19,3z M9,17H6.477v-7H9 V17z M7.694,8.717c-0.771,0-1.286-0.514-1.286-1.2s0.514-1.2,1.371-1.2c0.771,0,1.286,0.514,1.286,1.2S8.551,8.717,7.694,8.717z M18,17h-2.442v-3.826c0-1.058-0.651-1.302-0.895-1.302s-1.058,0.163-1.058,1.302c0,0.163,0,3.826,0,3.826h-2.523v-7h2.523v0.977 C13.93,10.407,14.581,10,15.802,10C17.023,10,18,10.977,18,13.174V17z" fill="#fffcf7"></path>
                                        </svg>

                                    <?php endif; ?>

                                </a>

                        <?php
                            endif;
                        endforeach;
                        ?>

                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Section: Logos + Central Logo + Copyright -->
        <div class="flex flex-col lg:flex-row items-center justify-between lg:justify-start mb-8 gap-6 md:gap-10">
            <div class="flex flex-wrap items-center justify-center lg:justify-start gap-8 opacity-90">
                <?php if (have_rows('logos', 'option')): ?>
                    <?php while (have_rows('logos', 'option')): the_row();
                        $client_logo = get_sub_field('client_logo');
                        if ($client_logo && isset($client_logo['url'])):
                    ?>
                            <img src="<?php echo esc_url($client_logo['url']); ?>" alt="<?php echo esc_attr(isset($client_logo['alt']) ? $client_logo['alt'] : ''); ?>" class="h-8 md:h-12 w-auto object-contain" />
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php else: ?>

                <?php endif; ?>
            </div>
        </div>

        <div class="border-t border-cream/20 pt-10 pb-4 flex flex-col items-center gap-6">
            <!-- Central Intense Peru Logo text placeholder -->
            <div class="flex flex-col items-center text-cream">
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

            <p class="body-small text-xs text-cream/70 text-center">
                &copy; Intense Peru 2007 &ndash; <?php echo esc_html(date('Y')); ?> &middot; All rights reserved.
            </p>
        </div>

    </div>
</footer>
<!-- /Footer -->

<?php get_template_part('template-parts/components/whatsapp-btn'); ?>

<?php wp_footer(); ?>
</body>

</html>