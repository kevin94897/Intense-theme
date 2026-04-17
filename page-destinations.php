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
    <section class="relative md:h-screen min-h-[600px] flex items-center justify-center pt-10 md:pt-20"
        data-aos="fade-in">
        <div class="absolute inset-0 z-0">
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>"
                alt="Discover Peru" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-neutral-black/40"></div>
        </div>

        <div class="container-site relative z-10 text-center px-4">
            <h1 class="font-heading text-white text-4xl md:text-[64px] leading-tight md:leading-[72px] mb-6"
                data-aos="fade-up" data-aos-delay="100">
                <?php echo get_the_title(); ?>
            </h1>
            <p class="font-body text-white/90 text-lg md:text-xl font-light max-w-3xl mx-auto mb-10" data-aos="fade-up"
                data-aos-delay="200">
                <?php echo wp_strip_all_tags(get_the_content()); ?>
            </p>
            <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                <?php get_template_part('template-parts/components/btn-primary', null, [
                    'text' => 'Explore itineraries',
                    'href' => home_url('/journeys'),
                ]); ?>
            </div>
        </div>
    </section>

    <?php if (get_field('message')) : ?>
        <section class="py-20">
            <div class="container-site">
                <p class="font-body text-lg md:text-xl text-dark mb-0 max-w-4xl mx-auto text-center leading-relaxed"
                    data-aos="fade-up" data-aos-delay="200">
                    <?php echo get_field('message'); ?>
                </p>
            </div>
        </section>
    <?php endif; ?>

    <!-- C. Destinations -->
    <section class="pb-32 bg-cream overflow-hidden">
        <div class="container-site">

            <!-- Header -->
            <div class="flex flex-col items-center gap-4 mb-14" data-aos="fade-up">
                <svg width="65" height="41" viewBox="0 0 65 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M31.9972 27.997L18.8042 20.418L31.9972 12.8391L45.1902 20.418L31.9972 27.997Z" stroke="#7B4424" stroke-width="1.12281" />
                    <path d="M31.9973 22.3832L28.3481 20.4183L31.9973 18.4534L35.6464 20.4183L31.9973 22.3832Z" fill="#B76739" stroke="#B76739" stroke-width="1.12281" />
                    <path d="M9.26025 0.488281L31.9971 13.4006L54.734 0.488281" stroke="#7B4424" stroke-width="1.12281" />
                    <path d="M54.7339 40.3481L31.997 27.4359L9.26017 40.3481" stroke="#7B4424" stroke-width="1.12281" />
                    <path d="M23.2954 3.29541L32.2779 8.90945L41.2603 3.29541" stroke="#B76739" stroke-width="1.12281" />
                    <path d="M41.2603 37.541L32.2778 31.927L23.2953 37.541" stroke="#B76739" stroke-width="1.12281" />
                    <path d="M64.2779 8.90942L44.0674 20.4182L64.2779 31.927" stroke="#B76739" stroke-width="1.12281" />
                    <path d="M0.277743 8.90942L20.4883 20.4182L0.277743 31.927" stroke="#B76739" stroke-width="1.12281" />
                </svg>
                <h2 class="font-heading text-4xl md:text-5xl text-dark" data-aos="fade-up" data-aos-delay="100">
                    Destinations
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2"
                 style="--dest-col-h: clamp(600px, 80vw, 920px);">
                <?php
                $args = [
                    'post_type'      => 'destination',
                    'posts_per_page' => -1,
                    'post_status'    => 'publish',
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                ];
                $destinations_query = new WP_Query($args);

                if ($destinations_query->have_posts()) :
                    $all_destinations = $destinations_query->posts;
                    $left_col  = [];
                    $right_col = [];

                    foreach ($all_destinations as $i => $post) {
                        if ($i % 2 === 0) {
                            $left_col[]  = $post;
                        } else {
                            $right_col[] = $post;
                        }
                    }

                    // Intercambiar card 2 y card 3 de la columna derecha
                    if (isset($right_col[1]) && isset($right_col[2])) {
                        [$right_col[1], $right_col[2]] = [$right_col[2], $right_col[1]];
                    }
                ?>

                    <!-- ── LEFT COLUMN ── -->
                    <div class="flex flex-col gap-2 h-auto sm:h-[var(--dest-col-h)]">
                        <?php
                        $left_heights = ['45%', '30%', '25%'];

                        foreach ($left_col as $index => $post) :
                            setup_postdata($post);
                            $height = $left_heights[$index] ?? '33%';
                            $delay  = 200 + ($index * 150);
                        ?>
                            <div class="dest-card group relative overflow-hidden block w-full cursor-pointer flex-shrink-0"
                                style="height: <?php echo $height; ?>;"
                                data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>"
                                onclick="window.location.href='<?php the_permalink(); ?>'">

                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php the_post_thumbnail_url('large'); ?>"
                                        alt="<?php the_title_attribute(); ?>"
                                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                                <?php endif; ?>

                                <div class="absolute inset-0 bg-black/10 group-hover:bg-black/30 transition-colors duration-500"></div>

                                <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4 md:p-6 z-10 w-full h-full">
                                    <h3 class="font-heading text-white text-xl md:text-3xl font-medium mb-3 md:mb-4 drop-shadow">
                                        <?php the_title(); ?>
                                    </h3>
                                    <div>
                                        <?php get_template_part('template-parts/components/btn-outline', null, [
                                            'text'        => 'Explore Destination',
                                            'href'        => get_permalink(),
                                            'color'       => 'light',
                                            'class_extra' => 'text-xs md:text-sm px-3 py-1.5 md:px-5 md:py-2 z-20 relative',
                                        ]); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>

                    <!-- ── RIGHT COLUMN ── -->
                    <div class="flex flex-col gap-2 h-auto sm:h-[var(--dest-col-h)]">
                        <?php
                        $right_heights = ['30%', '25%', '45%'];

                        foreach ($right_col as $index => $post) :
                            setup_postdata($post);
                            $height = $right_heights[$index] ?? '33%';
                            $delay  = 275 + ($index * 150);
                        ?>
                            <div class="dest-card group relative overflow-hidden block w-full cursor-pointer flex-shrink-0"
                                style="height: <?php echo $height; ?>;"
                                data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>"
                                onclick="window.location.href='<?php the_permalink(); ?>'">

                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php the_post_thumbnail_url('large'); ?>"
                                        alt="<?php the_title_attribute(); ?>"
                                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                                <?php endif; ?>

                                <div class="absolute inset-0 bg-black/10 group-hover:bg-black/30 transition-colors duration-500"></div>

                                <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4 md:p-6 z-10 w-full h-full">
                                    <h3 class="font-heading text-white text-base md:text-2xl font-medium mb-2 md:mb-3 drop-shadow">
                                        <?php the_title(); ?>
                                    </h3>
                                    <div>
                                        <?php get_template_part('template-parts/components/btn-outline', null, [
                                            'text'        => 'Explore Destination',
                                            'href'        => get_permalink(),
                                            'color'       => 'light',
                                            'class_extra' => 'text-[10px] md:text-xs px-3 py-1.5 md:px-5 md:py-2 z-20 relative',
                                        ]); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>

                <?php else : ?>
                    <p class="col-span-2 text-center py-10">No destinations found.</p>
                <?php endif; ?>
            </div>

        </div>
    </section>
    <style>
        @media (max-width: 639px) {
            .dest-card {
                height: clamp(220px, 50vw, 320px) !important;
            }
        }
    </style>

    <!-- G. Banner Text -->
    <?php get_template_part('template-parts/components/banner-cta'); ?>

    <!-- Testimonials -->
    <?php get_template_part('template-parts/home/section-testimonials'); ?>

</main>

<?php get_footer(); ?>