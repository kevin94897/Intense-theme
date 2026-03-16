<?php

/**
 * Template Name: Destinations
 *
 * @package intense-nerd-theme
 */
get_header();
?>

<main id="main" class="site-main" role="main">

    <!-- A. Hero Section -->
    <section class="relative h-screen min-h-[600px] flex items-center justify-center pt-20" data-aos="fade-in">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_banner_destinations.webp"
                alt="Machu Picchu" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-neutral-black/40"></div>
        </div>

        <div class="container-site relative z-10 text-center px-4">
            <h1 class="font-heading text-white text-5xl md:text-[64px] leading-tight md:leading-[72px] mb-6"
                data-aos="fade-up" data-aos-delay="100">
                Peru - A Celebration of Life
            </h1>
            <p class="font-body text-white/90 text-lg md:text-xl font-light max-w-2xl mx-auto mb-10" data-aos="fade-up"
                data-aos-delay="200">
                Authentic journeys that immerse you in Peru’s vibrant culture and breathtaking natural wonders. </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4" data-aos="fade-up"
                data-aos-delay="300">
                <?php get_template_part('template-parts/components/btn-primary', null, [
                    'text' => 'Explore itineraries',
                    'href' => '#itineraries',
                ]); ?>
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="container-site">
            <p class="font-body text-lg md:text-xl text-dark mb-0 max-w-4xl mx-auto text-center" data-aos="fade-up"
                data-aos-delay="200">
                Savor the rich flavors and colonial heritage of the coast, explore the timeless Inca culture and majestic Machu Picchu in the Andes, and lose yourself in the lush biodiversity and vibrant wildlife of the Amazon. Three regions, one authentic, extraordinary & unforgettable journey.
            </p>
        </div>
    </section>

    
    <!-- C. Destinations -->
<section class="py-16 bg-cream overflow-hidden">
    <div class="container-site">

        <!-- Header -->
        <div class="flex flex-col items-center gap-4 mb-14" data-aos="fade-up">
            <svg width="65" height="41" viewBox="0 0 65 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M31.9972 27.997L18.8042 20.418L31.9972 12.8391L45.1902 20.418L31.9972 27.997Z" stroke="#7B4424" stroke-width="1.12281"/>
                <path d="M31.9973 22.3832L28.3481 20.4183L31.9973 18.4534L35.6464 20.4183L31.9973 22.3832Z" fill="#B76739" stroke="#B76739" stroke-width="1.12281"/>
                <path d="M9.26025 0.488281L31.9971 13.4006L54.734 0.488281" stroke="#7B4424" stroke-width="1.12281"/>
                <path d="M54.7339 40.3481L31.997 27.4359L9.26017 40.3481" stroke="#7B4424" stroke-width="1.12281"/>
                <path d="M23.2954 3.29541L32.2779 8.90945L41.2603 3.29541" stroke="#B76739" stroke-width="1.12281"/>
                <path d="M41.2603 37.541L32.2778 31.927L23.2953 37.541" stroke="#B76739" stroke-width="1.12281"/>
                <path d="M64.2779 8.90942L44.0674 20.4182L64.2779 31.927" stroke="#B76739" stroke-width="1.12281"/>
                <path d="M0.277743 8.90942L20.4883 20.4182L0.277743 31.927" stroke="#B76739" stroke-width="1.12281"/>
            </svg>
            <h2 class="font-heading text-4xl md:text-5xl text-dark" data-aos="fade-up" data-aos-delay="100">
                Destinations
            </h2>
        </div>

        <!--
            LAYOUT PATTERN (mirrors the screenshot exactly):
            Col LEFT  → tall (360px) | short (240px) | tall (360px)
            Col RIGHT → short (240px) | tall (360px) | short (240px)
            Gap between cols + rows: 12px
            Both columns are equal width (grid-cols-2).
            On mobile the same 2-col layout is kept but heights shrink.
        -->
        <div class="grid grid-cols-2 gap-3">

            <!-- ── LEFT COLUMN ── -->
            <div class="flex flex-col gap-3">

                <!-- 1. Lima — TALL -->
                <!-- 1. Lima — TALL -->
                <div class="dest-card group relative overflow-hidden block w-full cursor-pointer"
                   style="height: clamp(260px, 38vw, 480px);"
                   data-aos="fade-up" data-aos-delay="200"
                   onclick="window.location.href='#'">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_01.webp"
                         alt="Lima"
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition-colors duration-500"></div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4 md:p-6 z-10 w-full h-full">
                        <h3 class="font-heading text-white text-xl md:text-3xl font-medium mb-3 md:mb-4 drop-shadow">
                            Lima
                        </h3>
                        <div>
                            <?php get_template_part('template-parts/components/btn-outline', null, [
                                'text'        => 'Explore Destination',
                                'href'        => '#',
                                'color'       => 'light',
                                'class_extra' => 'text-[10px] md:text-xs px-3 py-1.5 md:px-5 md:py-2 z-20 relative'
                            ]); ?>
                        </div>
                    </div>
                </div>

                <!-- 2. Nazca Lines — SHORT -->
                <div class="dest-card group relative overflow-hidden block w-full cursor-pointer"
                   style="height: clamp(180px, 26vw, 340px);"
                   data-aos="fade-up" data-aos-delay="350"
                   onclick="window.location.href='#'">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_03.webp"
                         alt="Nazca Lines & Paracas"
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition-colors duration-500"></div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-3 md:p-5 z-10 w-full h-full">
                        <h3 class="font-heading text-white text-base md:text-2xl font-medium mb-2 md:mb-3 drop-shadow">
                            Nazca Lines &amp; Paracas
                        </h3>
                        <div>
                            <?php get_template_part('template-parts/components/btn-outline', null, [
                                'text'        => 'Explore Destination',
                                'href'        => '#',
                                'color'       => 'light',
                                'class_extra' => 'text-[10px] md:text-xs px-3 py-1.5 md:px-5 md:py-2 z-20 relative'
                            ]); ?>
                        </div>
                    </div>
                </div>

                <!-- 3. Amazon — TALL -->
                <div class="dest-card group relative overflow-hidden block w-full cursor-pointer"
                   style="height: clamp(260px, 38vw, 480px);"
                   data-aos="fade-up" data-aos-delay="500"
                   onclick="window.location.href='#'">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_05.webp"
                         alt="Amazon Rainforest"
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition-colors duration-500"></div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4 md:p-6 z-10 w-full h-full">
                        <h3 class="font-heading text-white text-xl md:text-3xl font-medium mb-3 md:mb-4 drop-shadow">
                            Amazon Rainforest
                        </h3>
                        <div>
                            <?php get_template_part('template-parts/components/btn-outline', null, [
                                'text'        => 'Explore Destination',
                                'href'        => '#',
                                'color'       => 'light',
                                'class_extra' => 'text-[10px] md:text-xs px-3 py-1.5 md:px-5 md:py-2 z-20 relative'
                            ]); ?>
                        </div>
                    </div>
                </div>

            </div><!-- /LEFT COLUMN -->

            <!-- ── RIGHT COLUMN ── (inverted rhythm: short → tall → short) -->
            <div class="flex flex-col gap-3">

                <!-- 1. Arequipa — SHORT -->
                <div class="dest-card group relative overflow-hidden block w-full cursor-pointer"
                   style="height: clamp(180px, 26vw, 340px);"
                   data-aos="fade-up" data-aos-delay="275"
                   onclick="window.location.href='#'">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_04.webp"
                         alt="Arequipa & Colca Canyon"
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition-colors duration-500"></div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-3 md:p-5 z-10 w-full h-full">
                        <h3 class="font-heading text-white text-base md:text-2xl font-medium mb-2 md:mb-3 drop-shadow">
                            Arequipa &amp; Colca Canyon
                        </h3>
                        <div>
                            <?php get_template_part('template-parts/components/btn-outline', null, [
                                'text'        => 'Explore Destination',
                                'href'        => '#',
                                'color'       => 'light',
                                'class_extra' => 'text-[10px] md:text-xs px-3 py-1.5 md:px-5 md:py-2 z-20 relative'
                            ]); ?>
                        </div>
                    </div>
                </div>

                <!-- 2. Machu Picchu — TALL -->
                <div class="dest-card group relative overflow-hidden block w-full cursor-pointer"
                   style="height: clamp(200px, 28vw, 340px);"
                   data-aos="fade-up" data-aos-delay="425"
                   onclick="window.location.href='#'">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_02.webp"
                         alt="Machu Picchu & Cusco"
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition-colors duration-500"></div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4 md:p-6 z-10 w-full h-full">
                        <h3 class="font-heading text-white text-xl md:text-3xl font-medium mb-3 md:mb-4 drop-shadow">
                            Machu Picchu &amp; Cusco
                        </h3>
                        <div>
                            <?php get_template_part('template-parts/components/btn-outline', null, [
                                'text'        => 'Explore Destination',
                                'href'        => '#',
                                'color'       => 'light',
                                'class_extra' => 'text-[10px] md:text-xs px-3 py-1.5 md:px-5 md:py-2 z-20 relative'
                            ]); ?>
                        </div>
                    </div>
                </div>

                <!-- 3. Lake Titicaca — SHORT -->
                <div class="dest-card group relative overflow-hidden block w-full cursor-pointer"
                   style="height: clamp(180px, 26vw, 340px);"
                   data-aos="fade-up" data-aos-delay="575"
                   onclick="window.location.href='#'">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_06.webp"
                         alt="Lake Titicaca"
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition-colors duration-500"></div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-3 md:p-5 z-10 w-full h-full">
                        <h3 class="font-heading text-white text-base md:text-2xl font-medium mb-2 md:mb-3 drop-shadow">
                            Lake Titicaca
                        </h3>
                        <div>
                            <?php get_template_part('template-parts/components/btn-outline', null, [
                                'text'        => 'Explore Destination',
                                'href'        => '#',
                                'color'       => 'light',
                                'class_extra' => 'text-[10px] md:text-xs px-3 py-1.5 md:px-5 md:py-2 z-20 relative'
                            ]); ?>
                        </div>
                    </div>
                </div>

            </div><!-- /RIGHT COLUMN -->

        </div><!-- /grid -->

    </div>
</section>

    <!-- G. Banner CTA -->
    <?php get_template_part('template-parts/components/banner-cta'); ?>

        <!-- Testimonials -->
    <?php get_template_part('template-parts/home/section-testimonials'); ?>

</main>

<?php get_footer(); ?>