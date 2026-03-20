<?php

/**
 * Template Name: Destinations
 *
 * @package intense-nerd-theme
 */
get_header();
?>

<?php while (have_posts()) : the_post(); ?>
    <main id="main" class="site-main" role="main">

        <!-- A. Hero Section -->
        <section class="relative h-screen min-h-[600px] flex items-end justify-center pt-20" data-aos="fade-in">
            <!-- Background Image -->
            <div class="absolute inset-0 z-0">
                <?php
                // Usa la imagen destacada, o la predeterminada si no hay
                $hero_bg = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/assets/images/intense_banner_destinations.webp';
                ?>
                <img src="<?php echo esc_url($hero_bg); ?>"
                    alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-neutral-black/40"></div>
            </div>

            <div class="container-site relative z-10 text-left pb-20 px-4">
                <h1 class="font-heading text-white text-4xl md:text-[64px] leading-tight md:leading-[72px] mb-6"
                    data-aos="fade-up" data-aos-delay="100">
                    <?php the_title(); ?> </h1>
                <div class="font-body text-white/90 text-lg md:text-xl font-light max-w-2xl mb-10" data-aos="fade-up"
                    data-aos-delay="200">
                    <?php
                    if (has_excerpt()) {
                        the_excerpt();
                    } else {
                        echo apply_filters('the_content', wp_trim_words(get_the_content(), 30));
                    }
                    ?>
                </div>
                <div class="text-left" data-aos="fade-up" data-aos-delay="300">
                    <?php get_template_part('template-parts/components/btn-outline', null, [
                        'text' => 'Free Quote Request',
                        'color' => 'light',
                        'href' => '#',
                    ]); ?>
                </div>
            </div>
        </section>

        <!-- B. Content Section (Highlights) -->
        <?php get_template_part('template-parts/components/section-destination-highlights'); ?>


        <!-- C. Destinations -->
        <section class="pb-24 bg-cream overflow-hidden">
            <div class="container-site">

                <!-- Header -->
                <div class="flex flex-col items-start gap-4 mb-14" data-aos="fade-up">
                    <h2 class="font-heading text-4xl md:text-5xl text-dark max-w-xl text-left" data-aos="fade-up" data-aos-delay="100">
                        Itineraries that Feature
                        Amazon Rainforest
                    </h2>
                </div>

                <!--
            LAYOUT (matches screenshot):
            Row 1 → 1 card FULL WIDTH — tall (~55vh)
            Row 2 → 2 cards EQUAL WIDTH — medium height (~38vh)
            Gap: 12px
        -->
                <div class="flex flex-col gap-3">

                    <!-- ── ROW 1: Full-width tall card ── -->
                    <div class="dest-card group relative overflow-hidden w-full cursor-pointer"
                        style="height: clamp(280px, 50vw, 580px);"
                        data-aos="fade-up" data-aos-delay="200"
                        onclick="window.location.href='#'">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_01.webp"
                            alt="4D Amazing Tambopata"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/25 group-hover:bg-black/45 transition-colors duration-500"></div>
                        <div class="absolute inset-x-0 bottom-0 p-6 md:p-10 z-10">
                            <h3 class="font-heading text-white text-2xl md:text-4xl font-medium drop-shadow mb-1">
                                4D Amazing Tambopata
                            </h3>
                            <p class="text-white/70 text-xs md:text-sm font-body mb-4">Amazon Rainforest</p>
                            <div>
                                <?php get_template_part('template-parts/components/btn-outline', null, [
                                    'text'        => 'View Itinerary',
                                    'href'        => '#',
                                    'color'       => 'light',
                                    'class_extra' => 'text-[10px] md:text-xs px-4 py-1.5 md:px-5 md:py-2 z-20 relative'
                                ]); ?>
                            </div>
                        </div>
                    </div>

                    <!-- ── ROW 2: Two equal cards ── -->
                    <div class="grid grid-cols-2 gap-3">

                        <!-- Card 2 — bottom left -->
                        <div class="dest-card group relative overflow-hidden w-full cursor-pointer"
                            style="height: clamp(200px, 32vw, 400px);"
                            data-aos="fade-up" data-aos-delay="300"
                            onclick="window.location.href='#'">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_05.webp"
                                alt="4D Day Refugio Amazonas"
                                class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                            <div class="absolute inset-0 bg-black/25 group-hover:bg-black/45 transition-colors duration-500"></div>
                            <div class="absolute inset-x-0 bottom-0 p-4 md:p-8 z-10">
                                <h3 class="font-heading text-white text-lg md:text-3xl font-medium drop-shadow mb-1">
                                    4D Day Refugio Amazonas
                                </h3>
                                <p class="text-white/70 text-xs font-body mb-3 md:mb-4">Amazon Rainforest</p>
                                <div>
                                    <?php get_template_part('template-parts/components/btn-outline', null, [
                                        'text'        => 'View Itinerary',
                                        'href'        => '#',
                                        'color'       => 'light',
                                        'class_extra' => 'text-[10px] md:text-xs px-3 py-1.5 md:px-5 md:py-2 z-20 relative'
                                    ]); ?>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 — bottom right -->
                        <div class="dest-card group relative overflow-hidden w-full cursor-pointer"
                            style="height: clamp(200px, 32vw, 400px);"
                            data-aos="fade-up" data-aos-delay="400"
                            onclick="window.location.href='#'">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_06.webp"
                                alt="3D Day Refugio Amazonas"
                                class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                            <div class="absolute inset-0 bg-black/25 group-hover:bg-black/45 transition-colors duration-500"></div>
                            <div class="absolute inset-x-0 bottom-0 p-4 md:p-8 z-10">
                                <h3 class="font-heading text-white text-lg md:text-3xl font-medium drop-shadow mb-1">
                                    3D Day Refugio Amazonas
                                </h3>
                                <p class="text-white/70 text-xs font-body mb-3 md:mb-4">Amazon Rainforest</p>
                                <div>
                                    <?php get_template_part('template-parts/components/btn-outline', null, [
                                        'text'        => 'View Itinerary',
                                        'href'        => '#',
                                        'color'       => 'light',
                                        'class_extra' => 'text-[10px] md:text-xs px-3 py-1.5 md:px-5 md:py-2 z-20 relative'
                                    ]); ?>
                                </div>
                            </div>
                        </div>

                    </div><!-- /grid row 2 -->

                </div><!-- /flex col -->

            </div>
        </section>

        <!-- G. Banner CTA -->
        <?php get_template_part('template-parts/components/banner-cta'); ?>

        <!-- Testimonials -->
        <?php get_template_part('template-parts/home/section-testimonials'); ?>

        <!-- Featured Posts -->
        <?php get_template_part('template-parts/components/section-featured-posts'); ?>

    </main>
<?php endwhile; ?>

<?php get_footer(); ?>