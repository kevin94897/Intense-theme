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
                        <h2 class="font-heading text-4xl md:text-5xl text-dark text-left" data-aos="fade-up" data-aos-delay="100">
                            <span class="mb-2 block">Itineraries that Feature</span>
                            <?php the_title(); ?>
                        </h2>
                    </div>

                    <?php
                    $count = count($itineraries);
                    // Layout map: 'class' for desktop, 'mobile_h' for mobile height
                    $layout_map = [
                        1 => [
                            0 => ['class' => 'md:col-span-4 md:row-span-2 md:min-h-[500px]', 'mobile_h' => 'h-[400px]']
                        ],
                        2 => [
                            0 => ['class' => 'md:col-span-2 md:row-span-2', 'mobile_h' => 'h-[400px]'],
                            1 => ['class' => 'md:col-span-2 md:row-span-2', 'mobile_h' => 'h-[400px]']
                        ],
                        3 => [
                            0 => ['class' => 'md:col-span-2 md:row-span-2', 'mobile_h' => 'h-[400px]'],
                            1 => ['class' => 'md:col-span-2 md:row-span-1', 'mobile_h' => 'h-[250px]'],
                            2 => ['class' => 'md:col-span-2 md:row-span-1', 'mobile_h' => 'h-[250px]']
                        ],
                        4 => [
                            0 => ['class' => 'md:col-span-2 md:row-span-2', 'mobile_h' => 'h-[400px]'],
                            1 => ['class' => 'md:col-span-2 md:row-span-1', 'mobile_h' => 'h-[250px]'],
                            2 => ['class' => 'md:col-span-1 md:row-span-1', 'mobile_h' => 'h-[250px]'],
                            3 => ['class' => 'md:col-span-1 md:row-span-1', 'mobile_h' => 'h-[250px]']
                        ],
                        5 => [
                            0 => ['class' => 'md:col-span-2 md:row-span-2', 'mobile_h' => 'h-[400px]'],
                            1 => ['class' => 'md:col-span-2 md:row-span-1', 'mobile_h' => 'h-[250px]'],
                            2 => ['class' => 'md:col-span-1 md:row-span-1', 'mobile_h' => 'h-[250px]'],
                            3 => ['class' => 'md:col-span-1 md:row-span-1', 'mobile_h' => 'h-[250px]'],
                            4 => ['class' => 'md:col-span-4 md:row-span-1', 'mobile_h' => 'h-[250px]']
                        ],
                        6 => [
                            0 => ['class' => 'md:col-span-2 md:row-span-2', 'mobile_h' => 'h-[400px]'],
                            1 => ['class' => 'md:col-span-2 md:row-span-1', 'mobile_h' => 'h-[250px]'],
                            2 => ['class' => 'md:col-span-1 md:row-span-1', 'mobile_h' => 'h-[250px]'],
                            3 => ['class' => 'md:col-span-1 md:row-span-1', 'mobile_h' => 'h-[250px]'],
                            4 => ['class' => 'md:col-span-2 md:row-span-1', 'mobile_h' => 'h-[250px]'],
                            5 => ['class' => 'md:col-span-2 md:row-span-1', 'mobile_h' => 'h-[250px]']
                        ]
                    ];

                    // Fallback for more than 6 items: simple rows
                    $current_layout = $layout_map[$count] ?? null;
                    ?>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3 md:auto-rows-[300px]">

                        <?php foreach ($itineraries as $index => $itinerary) :
                            $itinerary_id    = $itinerary->ID;
                            $itinerary_title = get_the_title($itinerary_id);
                            $itinerary_link  = get_permalink($itinerary_id);

                            // Layout classes
                            if ($current_layout && isset($current_layout[$index])) {
                                $item_classes = $current_layout[$index]['class'];
                                $mobile_h     = $current_layout[$index]['mobile_h'];
                            } else {
                                // Default for N > 6
                                $item_classes = 'md:col-span-2 lg:col-span-4 md:row-span-1'; // Adjusted to fit 4-col base
                                if ($count > 6) {
                                    $item_classes = ($index % 3 === 0) ? 'md:col-span-2' : 'md:col-span-1';
                                }
                                $mobile_h = 'h-[300px]';
                            }

                            // Image & Tags logic
                            $itinerary_info = get_field('information', $itinerary_id);
                            $itinerary_hero_img = $itinerary_info['background_hero_image'] ?? null;
                            $itinerary_image = $itinerary_hero_img
                                ? (is_array($itinerary_hero_img) ? $itinerary_hero_img['url'] : $itinerary_hero_img)
                                : get_the_post_thumbnail_url($itinerary_id, 'large');

                            if (function_exists('ito_get_ordered_tags')) {
                                $itinerary_tags = ito_get_ordered_tags($itinerary_id);
                                $tags_string = !empty($itinerary_tags) ? implode(', ', array_column($itinerary_tags, 'name')) : '';
                            } else {
                                $tags_string = '';
                            }
                        ?>
                            <div class="dest-card group relative overflow-hidden w-full cursor-pointer <?php echo $item_classes; ?> <?php echo $mobile_h; ?> md:h-auto"
                                data-aos="fade-up" data-aos-delay="<?php echo 100 + ($index * 100); ?>"
                                onclick="window.location.href='<?php echo esc_url($itinerary_link); ?>'">

                                <?php if ($itinerary_image) : ?>
                                    <img src="<?php echo esc_url($itinerary_image); ?>"
                                        alt="<?php echo esc_attr($itinerary_title); ?>"
                                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 ease-out group-hover:scale-110">
                                <?php endif; ?>

                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-500"></div>

                                <div class="absolute inset-x-0 bottom-0 p-6 md:p-8 z-10 transform transition-transform duration-500 group-hover:-translate-y-2">
                                    <h3 class="font-heading text-white text-xl md:text-3xl font-medium drop-shadow-lg mb-2 leading-tight">
                                        <?php echo esc_html($itinerary_title); ?>
                                    </h3>

                                    <?php if (!empty($tags_string)) : ?>
                                        <p class="text-white/80 text-xs md:text-sm font-body mb-5 line-clamp-2 max-w-[400px]">
                                            <?php echo esc_html($tags_string); ?>
                                        </p>
                                    <?php endif; ?>

                                    <div class="opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                                        <?php get_template_part('template-parts/components/btn-outline', null, [
                                            'text'        => 'View Itinerary',
                                            'href'        => $itinerary_link,
                                            'color'       => 'light',
                                            'class_extra' => 'text-[10px] md:text-xs py-2 px-4'
                                        ]); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

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