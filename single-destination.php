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
        <?php
        $hero_title = get_the_title();
        $hero_bg = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/assets/images/intense_banner_destinations.webp';
        ?>
        <section class="relative h-screen min-h-[600px] flex items-end justify-center pt-20" data-aos="fade-in">
            <!-- Background Image -->
            <div class="absolute inset-0 z-0">
                <img src="<?php echo esc_url($hero_bg); ?>"
                    alt="<?php echo esc_attr($hero_title); ?>" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-neutral-black/20"></div>
            </div>

            <div class="container-site relative z-10 text-left pb-20 px-4">
                <h1 class="font-heading text-white text-4xl md:text-[64px] leading-tight md:leading-[72px] mb-6"
                    data-aos="fade-up" data-aos-delay="100">
                    <?php echo esc_html($hero_title); ?> </h1>
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
                <!-- <div class="text-left" data-aos="fade-up" data-aos-delay="300">
                    <?php get_template_part('template-parts/components/btn-outline', null, [
                        'text' => 'Free Quote Request',
                        'color' => 'light',
                        'href' => '#',
                    ]); ?>
                </div> -->
            </div>
        </section>

        <!-- B. Content Section (Highlights) -->
        <?php get_template_part('template-parts/components/section-destination-highlights'); ?>


        <!-- C. Destinations (Itineraries) -->
        <?php
        $itineraries_group = get_field('list_of_itineraries');
        $itineraries = $itineraries_group['itineraries'] ?? [];

        if ($itineraries) :
        ?>
            <section class="pb-24 bg-cream overflow-hidden">
                <div class="container-site">

                    <!-- Header -->
                    <div class="flex flex-col items-start gap-4 mb-14" data-aos="fade-up">
                        <h2 class="font-heading text-4xl md:text-5xl text-dark max-w-xl text-left" data-aos="fade-up" data-aos-delay="100">
                            Itineraries that Feature
                            <?php the_title(); ?>
                        </h2>
                    </div>

                    <!--
                    LAYOUT:
                    Row 1 → 1 card FULL WIDTH — tall
                    Row 2 → 2 cards EQUAL WIDTH — medium height
                    We loop through selected itineraries and follow this pattern.
                -->
                    <div class="flex flex-col gap-3">

                        <?php foreach ($itineraries as $index => $itinerary) :
                            $itinerary_id = $itinerary->ID;
                            $itinerary_title = get_the_title($itinerary_id);
                            $itinerary_link = get_permalink($itinerary_id);
                            
                            // Get Background Hero Image from Journey's ACF data, fallback to post thumbnail
                            $itinerary_info = get_field('information', $itinerary_id);
                            $itinerary_hero_img = $itinerary_info['background_hero_image'] ?? null;
                            $itinerary_image = $itinerary_hero_img 
                                ? (is_array($itinerary_hero_img) ? $itinerary_hero_img['url'] : $itinerary_hero_img) 
                                : get_the_post_thumbnail_url($itinerary_id, 'large');
                                
                            $itinerary_destination = get_the_title(); // Current destination

                            if ($index === 0) : // First one is tall and full width
                        ?>
                                <!-- ── ROW 1: Full-width tall card ── -->
                                <div class="dest-card group relative overflow-hidden w-full cursor-pointer"
                                    style="height: clamp(280px, 50vw, 580px);"
                                    data-aos="fade-up" data-aos-delay="200"
                                    onclick="window.location.href='<?php echo esc_url($itinerary_link); ?>'">
                                    <?php if ($itinerary_image) : ?>
                                        <img src="<?php echo esc_url($itinerary_image); ?>"
                                            alt="<?php echo esc_attr($itinerary_title); ?>"
                                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                                    <?php endif; ?>
                                    <div class="absolute inset-0 bg-black/25 group-hover:bg-black/45 transition-colors duration-500"></div>
                                    <div class="absolute inset-x-0 bottom-0 p-6 md:p-10 z-10">
                                        <h3 class="font-heading text-white text-2xl md:text-4xl font-medium drop-shadow mb-2">
                                            <?php echo esc_html($itinerary_title); ?>
                                        </h3>
                                        <?php if (function_exists('ito_get_ordered_tags')) :
                                            $itinerary_tags = ito_get_ordered_tags($itinerary_id);
                                            if (!empty($itinerary_tags)) : ?>
                                        <p class="text-white text-sm font-body mb-4 max-w-[350px]">
                                            <?php echo esc_html(implode(', ', array_column($itinerary_tags, 'name'))); ?>
                                        </p>
                                        <?php endif; endif; ?>
                                        <div>
                                            <?php get_template_part('template-parts/components/btn-outline', null, [
                                                'text'        => 'View Itinerary',
                                                'href'        => $itinerary_link,
                                                'color'       => 'light',
                                                'class_extra' => 'text-xs md:text-sm'
                                            ]); ?>
                                        </div>
                                    </div>
                                </div>

                                <?php if (count($itineraries) > 1) : ?>
                                    <div class="grid grid-cols-2 gap-3">
                                    <?php endif; ?>

                                <?php else : ?>
                                    <!-- Subsequent cards ── -->
                                    <div class="dest-card group relative overflow-hidden w-full cursor-pointer"
                                        style="height: clamp(200px, 32vw, 400px);"
                                        data-aos="fade-up" data-aos-delay="<?php echo 200 + ($index * 150); ?>"
                                        onclick="window.location.href='<?php echo esc_url($itinerary_link); ?>'">
                                        <?php if ($itinerary_image) : ?>
                                            <img src="<?php echo esc_url($itinerary_image); ?>"
                                                alt="<?php echo esc_attr($itinerary_title); ?>"
                                                class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                                        <?php endif; ?>
                                        <div class="absolute inset-0 bg-black/25 group-hover:bg-black/45 transition-colors duration-500"></div>
                                        <div class="absolute inset-x-0 bottom-0 p-4 md:p-8 z-10">
                                            <h3 class="font-heading text-white text-lg md:text-3xl font-medium drop-shadow mb-2">
                                                <?php echo esc_html($itinerary_title); ?>
                                            </h3>
                                            <p class="text-white text-sm font-body mb-4 max-w-[350px]">
                                            <?php echo esc_html(implode(', ', array_column($itinerary_tags, 'name'))); ?>
                                        </p>
                                            <div>
                                                <?php get_template_part('template-parts/components/btn-outline', null, [
                                                    'text'        => 'View Itinerary',
                                                    'href'        => $itinerary_link,
                                                    'color'       => 'light',
                                                    'class_extra' => 'text-xs md:text-sm'
                                                ]); ?>
                                            </div>
                                        </div>
                                    </div>
                            <?php endif;
                        endforeach;

                        if (count($itineraries) > 1) : ?>
                                    </div><!-- /grid row 2 -->
                        <?php endif; ?>

                    </div><!-- /flex col -->

                </div>
            </section>
        <?php endif; ?>


        <!-- G. Banner CTA -->
        <?php get_template_part('template-parts/components/banner-text'); ?>

        <!-- Testimonials -->
        <?php get_template_part('template-parts/home/section-testimonials'); ?>

        <!-- Featured Posts -->
        <?php get_template_part('template-parts/components/section-featured-posts'); ?>

    </main>
<?php endwhile; ?>

<?php get_footer(); ?>