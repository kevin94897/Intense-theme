<?php

/**
 * Template Name: Home Page (Static Layout)
 *
 * ACF Fields (page ID 11):
 *   home (group)
 *     ├── banner_hero (group)
 *     │     ├── description   (text)
 *     │     ├── button_1      (link)
 *     │     └── button_2      (link)
 *     ├── signature_destinations (group)
 *     │     ├── destinations_list (repeater)
 *     │     │     ├── destination_image (image)
 *     │     │     ├── destination_title (text)
 *     │     │     └── destination_button (link)
 *     │     └── journeys      (post_object, multiple → CPT journey)
 *     ├── motivation (group)
 *     │     ├── title         (text)
 *     │     ├── image         (image)
 *     │     └── list_of_purposes (repeater, max 3)
 *     │           ├── purpose_title       (text)
 *     │           └── purpose_description (textarea)
 *     └── gallery (group)
 *           ├── title  (text)
 *           └── photos (gallery)
 *
 * ACF Fields (options page 'download-guides'):
 *   travel_guides (group)
 *     ├── guides_image     (image)
 *     ├── title            (text)
 *     ├── description      (text)
 *     └── download_button  (link)
 *
 * @package intense-nerd-theme
 */
get_header();

// ── ACF: Home fields ─────────────────────────────────────────────────────────
$banner_hero             = get_field('banner_hero')             ?: [];
$message_home            = get_field('message_home')            ?: '';
$signature_destinations  = get_field('signature_destinations')  ?: [];
$motivation              = get_field('motivation')              ?: [];
$journey_spark           = get_field('journey_spark')           ?: [];

$hero_btn1               = $banner_hero['button_1']    ?? [];
$hero_btn2               = $banner_hero['button_2']    ?? [];
$hero_video_field        = $banner_hero['video']       ?? null;
// Campo tipo file devuelve array; tipo url devuelve string
$hero_video_url          = is_array($hero_video_field)
    ? ($hero_video_field['url'] ?? '')
    : (string) $hero_video_field;
$hero_video_fallback     = get_template_directory_uri() . '/assets/videos/intense_video_home_hero.mp4';

$dest_list               = $signature_destinations['destinations_list'] ?? [];
$journey_posts           = $signature_destinations['journeys']     ?? [];

$motivation_title        = $motivation['title']            ?? '';
$motivation_image        = $motivation['image']            ?? [];
$list_of_purposes        = $motivation['list_of_purposes'] ?? [];

$spark_title             = $journey_spark['title']  ?? '';
$spark_journeys          = $journey_spark['journeys'] ?? [];

// ── ACF: Download options page ───────────────────────────────────────────────
$travel_guides           = get_field('travel_guides', 'option') ?: [];
$guides_image            = $travel_guides['guides_image']    ?? [];
$guides_title            = $travel_guides['title']           ?? '';
$guides_description      = $travel_guides['description']     ?? '';
$download_button         = $travel_guides['download_button'] ?? [];
?>

<main id="main" class="site-main" role="main">

    <!-- A. Hero Section -->
    <section class="relative h-screen min-h-[600px] flex items-center justify-center pt-20" data-aos="fade-in">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <video src="<?php echo esc_url($hero_video_url ?: $hero_video_fallback); ?>" autoplay
                muted loop playsinline class="w-full h-full object-cover"></video>
            <div class="absolute inset-0 bg-neutral-black/40"></div>
        </div>

        <div class="container-site relative z-10 text-center px-4">
            <h1 class="font-heading text-white text-4xl md:text-[64px] leading-tight md:leading-[72px] mb-6"
                data-aos="fade-up" data-aos-delay="100">
                <?php echo esc_html(get_the_title()); ?>
            </h1>
            <?php if (get_the_content()) : ?>
                <div class="font-body text-white/90 text-lg md:text-xl font-light max-w-xl mx-auto mb-10 entry-content-hero"
                    data-aos="fade-up" data-aos-delay="200">
                    <?php the_content(); ?>
                </div>
            <?php endif; ?>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4" data-aos="fade-up"
                data-aos-delay="300">
                <?php if (!empty($hero_btn1)) : ?>
                    <?php get_template_part('template-parts/components/btn-primary', null, [
                        'text' => $hero_btn1['title'] ?? 'Explore itineraries',
                        'href' => $hero_btn1['url']   ?? '#',
                        'class_extra' => 'w-[180px] md:w-auto',
                    ]); ?>
                <?php endif; ?>
                <?php if (!empty($hero_btn2)) : ?>
                    <?php get_template_part('template-parts/components/btn-outline', null, [
                        'text'  => $hero_btn2['title'] ?? 'Design my trip',
                        'href'  => $hero_btn2['url']   ?? '#',
                        'color' => 'light',
                        'class_extra' => 'w-[180px] md:w-auto',
                    ]); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Message -->
    <?php if ($message_home) : ?>
        <section class="py-20">
            <div class="container-site">
                <p class="font-body text-lg md:text-xl text-dark mb-0 max-w-4xl mx-auto text-center leading-relaxed" data-aos="fade-up"
                    data-aos-delay="200">
                    <?php echo nl2br(esc_html($message_home)); ?>
                </p>
            </div>
        </section>
    <?php endif; ?>

    <!-- B. Signature Destinations -->
    <?php if (!empty($dest_list)) : ?>
        <section class="py-10 bg-cream">
            <div class="container-site text-left">
                <div class="flex flex-col items-center md:items-start gap-4">
                    <svg class="block md:hidden" width="65" height="41" viewBox="0 0 65 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M31.9972 27.997L18.8042 20.418L31.9972 12.8391L45.1902 20.418L31.9972 27.997Z" stroke="#7B4424" stroke-width="1.12281" />
                        <path d="M31.9973 22.3832L28.3481 20.4183L31.9973 18.4534L35.6464 20.4183L31.9973 22.3832Z" fill="#B76739" stroke="#B76739" stroke-width="1.12281" />
                        <path d="M9.26025 0.488281L31.9971 13.4006L54.734 0.488281" stroke="#7B4424" stroke-width="1.12281" />
                        <path d="M54.7339 40.3481L31.997 27.4359L9.26017 40.3481" stroke="#7B4424" stroke-width="1.12281" />
                        <path d="M23.2954 3.29541L32.2779 8.90945L41.2603 3.29541" stroke="#B76739" stroke-width="1.12281" />
                        <path d="M41.2603 37.541L32.2778 31.927L23.2953 37.541" stroke="#B76739" stroke-width="1.12281" />
                        <path d="M64.2779 8.90942L44.0674 20.4182L64.2779 31.927" stroke="#B76739" stroke-width="1.12281" />
                        <path d="M0.277743 8.90942L20.4883 20.4182L0.277743 31.927" stroke="#B76739" stroke-width="1.12281" />
                    </svg>
                    <h2 class="font-heading text-4xl md:text-5xl text-dark mb-12 text-center md:text-left"
                        data-aos="fade-up" data-aos-delay="100">Signature Destinations</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-2 auto-rows-[300px]">
                    <?php
                    $bento_classes = [
                        'md:col-span-1 md:row-span-1',
                        'md:col-span-2 md:row-span-1',
                        'md:col-span-1 md:row-span-1',
                        'md:col-span-2 md:row-span-1',
                        'md:col-span-1 md:row-span-1',
                        'md:col-span-1 md:row-span-1',
                    ];

                    $aos_delays = [200, 300, 400, 500, 600, 700];

                    foreach ($dest_list as $idx => $dest_item) :
                        if ($idx >= 6) break;
                        $img_array  = $dest_item['destination_image'] ?? [];
                        $thumb      = !empty($img_array['sizes']['large']) ? $img_array['sizes']['large'] : (!empty($img_array['url']) ? $img_array['url'] : get_template_directory_uri() . '/assets/images/intense_01.webp');
                        $dest_title = $dest_item['destination_title'] ?? '';
                        $dest_btn   = $dest_item['destination_button'] ?? [];
                        
                        $dest_url   = $dest_btn['url'] ?? '#';
                        $dest_btn_text = $dest_btn['title'] ?? 'Explore destination';
                    ?>
                        <div class="<?php echo $bento_classes[$idx]; ?> relative group overflow-hidden rounded-sm cursor-pointer"
                            data-aos="fade-up" data-aos-delay="<?php echo $aos_delays[$idx]; ?>">
                            <img src="<?php echo esc_url($thumb); ?>"
                                alt="<?php echo esc_attr($dest_title); ?>"
                                class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <!-- <div class="absolute inset-0 bg-black/20"></div> -->
                            <div class="absolute bottom-4 left-4 md:bottom-6 md:left-6 text-left">
                                <h3 class="font-heading text-white text-2xl md:text-2xl font-medium mb-2">
                                    <?php echo esc_html($dest_title); ?>
                                </h3>
                                <?php if (!empty($dest_btn)) : ?>
                                    <?php get_template_part('template-parts/components/btn-outline', null, [
                                        'text'        => $dest_btn_text,
                                        'class_extra' => 'text-xs md:text-sm',
                                        'href'        => $dest_url,
                                        'color'       => 'light',
                                    ]); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- C. Authentic Itineraries -->
    <?php if (!empty($journey_posts)) : ?>
        <section id="itineraries" class="py-20 bg-cream">
            <div class="container-site text-center">
                <div class="flex flex-col items-center gap-4">
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
                    <h2 class="font-heading text-4xl md:text-5xl text-dark mb-12" data-aos="fade-up" data-aos-delay="100">
                        Authentic Itineraries</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-10 text-left">
                        <?php foreach ($journey_posts as $jidx => $journey_post) :
                            $j_id          = $journey_post->ID;
                            $j_title       = get_the_title($j_id);
                            $j_url         = get_permalink($j_id);
                            $j_thumb       = get_the_post_thumbnail_url($j_id, 'large') ?: get_template_directory_uri() . '/assets/images/intense_02.webp';
                            $j_features    = get_field('features', $j_id);
                            $j_information = get_field('information', $j_id);
                            $j_price_val   = $j_features['price'] ?? '';
                            $j_days_val    = (int) ($j_information['days'] ?? 0);
                            $j_badges      = get_field('badges', $j_id) ?: [];
                        ?>
                            <?php get_template_part('template-parts/components/card-itinerary', null, [
                                'image'        => $j_thumb,
                                'title'        => $j_title,
                                'price'        => $j_price_val ? 'USD ' . number_format((int) $j_price_val) : '',
                                'duration'     => $j_days_val ? $j_days_val . ' Days' : '',
                                'post_id'      => $j_id,
                                'link'         => $j_url,
                                'link_text'    => 'Explore itineraries',
                                'aos_delay'    => ($jidx * 100) + 200,
                                'badges'       => $j_badges,
                            ]); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
        </section>
    <?php endif; ?>

    <!-- D. Motivation (What Moves Us) -->
    <section class="py-20 bg-sage text-white">
        <div class="container-site">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <div class="flex items-center gap-4 mb-12">
                        <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.707031 12.0156L38.3976 49.7062" stroke="white" stroke-width="2" />
                            <path d="M12.0146 0.70752L49.7053 38.3981" stroke="white" stroke-width="2" />
                            <path d="M12.0161 49.7056L49.7067 12.015" stroke="white" stroke-width="2" />
                            <path d="M0.707031 38.3979L38.3976 0.707343" stroke="white" stroke-width="2" />
                            <rect x="23.3062" y="23.8213" width="3.76914" height="3.76914" fill="white" />
                        </svg>
                        <h2 class="font-heading text-4xl md:text-5xl font-medium">
                            <?php echo esc_html($motivation_title ?: 'What Moves Us'); ?>
                        </h2>
                    </div>

                    <?php if (!empty($motivation_image)) : ?>
                        <img src="<?php echo esc_url($motivation_image['url']); ?>"
                            alt="<?php echo esc_attr($motivation_image['alt'] ?: 'Local Culture'); ?>"
                            class="w-full h-auto rounded-lg shadow-xl object-cover aspect-[4/3]">
                    <?php endif; ?>
                </div>
                <div data-aos="fade-left" class="space-y-12">
                    <?php if (!empty($list_of_purposes)) : ?>
                        <?php foreach ($list_of_purposes as $purpose) : ?>
                            <div class="">
                                <?php if (!empty($purpose['purpose_title'])) : ?>
                                    <h2 class="font-heading text-3xl md:text-4xl font-medium mb-6">
                                        <?php echo esc_html($purpose['purpose_title']); ?>
                                    </h2>
                                <?php endif; ?>
                                <?php if (!empty($purpose['purpose_description'])) : ?>
                                    <div class="space-y-6">
                                        <p class="font-body text-cream/80 font-light">
                                            <?php echo nl2br(esc_html($purpose['purpose_description'])); ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- E. Journey Spark (Formerly Gallery) -->
    <section class="py-20 bg-cream">

        <div class="flex flex-col md:flex-row items-center justify-center text-center gap-4 md:gap-12 mb-10">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_decoration_title.webp" alt=""
                class="mx-auto md:mb-10">
            <h2 class="font-heading text-4xl md:text-5xl text-dark md:mb-10 min-w-fit" data-aos="fade-up">
                <?php echo esc_html($spark_title ?: 'Need a journey spark?'); ?>
            </h2>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_decoration_title.webp" alt=""
                class="mx-auto mb-10 hidden md:block">
        </div>

        <div class="container-site text-center">
            <?php if (!empty($spark_journeys)) :
                $journeys_items = array_slice($spark_journeys, 0, 8);
                $col_heights = [
                    [['h' => '55%'], ['h' => '45%']],
                    [['h' => '45%'], ['h' => '55%']],
                    [['h' => '60%'], ['h' => '40%']],
                    [['h' => '45%'], ['h' => '55%']],
                ];
            ?>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-2 h-[1100px] md:h-[500px] lg:h-[600px] xl:h-[700px] w-full">
                    <?php for ($col = 0; $col < 4; $col++) : ?>
                        <div class="flex flex-col gap-2 h-full w-full">
                            <?php for ($row = 0; $row < 2; $row++) :
                                $j_idx = ($col * 2) + $row;
                                if (!isset($journeys_items[$j_idx])) continue;
                                $item      = $journeys_items[$j_idx];
                                $img       = $item['journey_image'] ?? [];
                                $img_url   = !empty($img['sizes']['large']) ? $img['sizes']['large'] : (!empty($img['url']) ? $img['url'] : '');
                                $title     = $item['journey_title'] ?? '';
                                $btn       = $item['journey__button'] ?? [];
                                $btn_url   = $btn['url'] ?? '#';
                                $btn_title = $btn['title'] ?? 'Explore';
                                $h         = $col_heights[$col][$row]['h'];
                            ?>
                                <div class="gallery-item block w-full relative group overflow-hidden rounded-sm cursor-pointer"
                                    style="height: calc(<?php echo $h; ?> - 0.5rem);"
                                    data-aos="fade-up"
                                    data-aos-delay="<?php echo ($col * 150) + ($row * 100); ?>">
                                    <img src="<?php echo esc_url($img_url); ?>"
                                        alt="<?php echo esc_attr($title); ?>"
                                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    
                                    <!-- Hover Overlay -->
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                                    
                                    <!-- Hover Content -->
                                    <div class="absolute bottom-4 left-4 md:bottom-6 md:left-6 text-left opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0 z-10 w-[calc(100%-2rem)]">
                                        <h3 class="font-heading text-white text-xl md:text-2xl font-medium mb-3">
                                            <?php echo esc_html($title); ?>
                                        </h3>
                                        <?php if (!empty($btn_url)) : ?>
                                            <?php get_template_part('template-parts/components/btn-outline', null, [
                                                'text'        => $btn_title,
                                                'class_extra' => 'text-xs md:text-sm',
                                                'href'        => $btn_url,
                                                'color'       => 'light',
                                            ]); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Testimonials -->
    <?php get_template_part('template-parts/home/section-testimonials'); ?>

    <!-- G. Banner CTA -->
    <?php get_template_part('template-parts/components/banner-cta'); ?>

    <!-- H. Journal & Stories -->
    <section class="md:py-20 py-12 bg-cream overflow-hidden">
        <div class="container-site">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end md:mb-12 mb-6 gap-6">
                <div class="text-left">
                    <h2 class="font-heading text-4xl md:text-5xl text-dark" data-aos="fade-up">Journal & Stories</h2>
                </div>
                <div class="flex items-center gap-6" data-aos="fade-up" data-aos-delay="100">
                    <a href="<?php echo home_url('/blog'); ?>"
                        class="group font-body text-xs md:text-sm text-dark uppercase tracking-widest hover:text-primary transition-colors font-medium flex items-center gap-3">
                        See All
                        <svg class="w-10 h-4 text-dark transition-transform duration-300 group-hover:translate-x-1"
                            viewBox="0 0 40 10" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="0" y1="5" x2="38" y2="5"></line>
                            <polyline points="34 1 39 5 34 9"></polyline>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Embla Wrapper -->
            <div class="embla-stories relative" data-aos="fade-up" data-aos-delay="200">
                <div class="embla overflow-hidden py-4">
                    <div class="embla__container flex -ml-6 md:-ml-10">
                        <?php
                        $recent_posts = get_posts([
                            'post_type'      => 'post',
                            'posts_per_page' => 9,
                            'post_status'    => 'publish',
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                        ]);
                        foreach ($recent_posts as $pidx => $story_post) :
                            $story_img  = get_the_post_thumbnail_url($story_post->ID, 'large') ?: get_template_directory_uri() . '/assets/images/intense_journal_01.webp';
                            $read_time  = get_field('read_time', $story_post->ID) ?? '';
                            $story_date = get_the_date('d M Y', $story_post->ID);
                        ?>
                            <div class="embla__slide flex-[0_0_90%] sm:flex-[0_0_50%] lg:flex-[0_0_33.333%] min-w-0 pl-6 md:pl-10">
                                <?php get_template_part('template-parts/components/card-story', null, [
                                    'image'     => $story_img,
                                    'image_alt' => get_the_title($story_post->ID),
                                    'title'     => get_the_title($story_post->ID),
                                    'read_time' => $read_time,
                                    'date'      => $story_date,
                                    'link'      => get_permalink($story_post->ID),
                                    'aos_delay' => 0, // Delay handled by wrapper
                                ]); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Navigation Controls -->
                <!-- <div class="flex items-center justify-center md:justify-start gap-12 mt-12">
                    <button class="embla__prev group cursor-pointer disabled:opacity-20 disabled:cursor-not-allowed transition-opacity" aria-label="Previous">
                        <svg class="w-16 h-5" viewBox="0 0 100 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <line x1="95" y1="12" x2="10" y2="12" class="transition-all duration-300"></line>
                            <polyline points="20 4 10 12 20 20" class="transition-all duration-300 group-hover:-translate-x-1"></polyline>
                        </svg>
                    </button>
                    <button class="embla__next group cursor-pointer disabled:opacity-20 disabled:cursor-not-allowed transition-opacity" aria-label="Next">
                        <svg class="w-16 h-5" viewBox="0 0 100 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <line x1="5" y1="12" x2="90" y2="12" class="transition-all duration-300"></line>
                            <polyline points="80 4 90 12 80 20" class="transition-all duration-300 group-hover:translate-x-1"></polyline>
                        </svg>
                    </button>
                </div> -->
            </div>
        </div>
    </section>

    <!-- I. Travel Guides Download -->
    <section class="md:py-20 py-12 mb-12">
        <div class="container-site">
            <div class="flex flex-col-reverse md:flex-row items-center gap-12">
                <!-- Image -->
                <div class="w-full md:w-1/2" data-aos="fade-right">
                    <?php if (!empty($guides_image)) : ?>
                        <img src="<?php echo esc_url($guides_image['url']); ?>"
                            alt="<?php echo esc_attr($guides_image['alt'] ?: 'Travel Guides'); ?>"
                            class="w-full h-auto">
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_peru_travel.webp"
                            alt="Travel Booklet" class="w-full h-auto">
                    <?php endif; ?>
                </div>
                <!-- Text -->
                <div class="w-full md:w-1/2 text-center md:text-left" data-aos="fade-left">
                    <h3 class="font-heading text-3xl font-semibold text-dark mb-4">
                        <?php echo esc_html($guides_title ?: 'Intense Peru Travel Guides'); ?>
                    </h3>
                    <?php if ($guides_description) : ?>
                        <p class="font-body text-dark text-base md:text-lg mb-8 font-light">
                            <?php echo esc_html($guides_description); ?>
                        </p>
                    <?php endif; ?>

                    <?php if (!empty($download_button)) : ?>
                        <div x-data @click.prevent="$dispatch('ccp:openbrochure')" class="inline-block cursor-pointer">
                            <?php get_template_part('template-parts/components/btn-outline', null, [
                                'text'        => $download_button['title'] ?? 'Choose a Brochure',
                                'href'        => '#',
                                'color'       => 'dark',
                                'class_extra' => 'px-5 py-2 text-base',
                            ]); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════════════
         BROCHURE MODAL
    ══════════════════════════════════════════════ -->
    <div
        x-data="brochureModal()"
        @ccp:openbrochure.window="show = true"
        x-show="show"
        style="display:none;"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6 bg-dark/50 backdrop-blur-sm"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">

        <!-- Modal Container -->
        <div
            x-show="show"
            @click.outside="show = false"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-3"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="bg-white rounded-xl shadow-2xl w-full max-w-4xl mx-auto overflow-hidden relative flex flex-col md:flex-row">

            <!-- × close -->
            <button @click="show = false"
                class="absolute top-4 right-4 z-[101] text-dark/40 hover:text-dark transition-colors bg-white/50 backdrop-blur-sm rounded-full p-2 md:bg-transparent md:backdrop-blur-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Left Image -->
            <div class="hidden md:block w-full md:w-5/12 h-64 md:h-auto relative p-5">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_donwload_brochure_img.webp" alt="Peru Travel Guide" class="w-full h-full object-cover">
            </div>

            <!-- Right Content (Form) -->
            <div class="w-full md:w-7/12 p-8 md:p-14 flex flex-col justify-center">
                <h2 class="font-heading text-3xl md:text-4xl text-dark font-light mb-10 text-center leading-snug">
                    Download our Peru Travel<br>Guide
                </h2>

                <form @submit.prevent="submitForm" class="space-y-8">

                    <!-- Brochure Dropdown -->
                    <div class="input-wrapper" :class="{ 'has-error': errors.brochure }">
                        <select x-model="formData.brochure" @change="validateField('brochure')" class="input-field appearance-none cursor-pointer bg-transparent relative z-10 w-full text-dark" style="color: inherit;">
                            <option value="" disabled hidden></option>
                            <?php
                            $first_file_url = '';
                            if (!empty($travel_guides['files_to_download'])) :
                                foreach ($travel_guides['files_to_download'] as $item) :
                                    if (!empty($item['file_name']) && !empty($item['file_'])) :
                                        $file_url = is_array($item['file_']) ? ($item['file_']['url'] ?? '') : $item['file_'];
                                        if (!$file_url) continue;
                                        if (empty($first_file_url)) $first_file_url = $file_url;
                            ?>
                                        <option value="<?php echo esc_url($file_url); ?>"><?php echo esc_html($item['file_name']); ?></option>
                            <?php
                                    endif;
                                endforeach;
                            endif;
                            ?>
                        </select>
                        <label class="input-label !opacity-100 transition-all duration-300" :class="formData.brochure ? '!-translate-y-5 !text-xs' : ''">Choose a brochure</label>
                        <div class="absolute right-0 top-1/2 -translate-y-1/2 pointer-events-none text-dark/70 pr-2">
                            <svg class="w-5 h-5 border-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <span x-show="errors.brochure" x-text="errors.brochure" class="input-error-msg"></span>
                    </div>

                    <!-- First Name -->
                    <div class="input-wrapper" :class="{ 'has-error': errors.firstName }">
                        <input type="text"
                            x-model="formData.firstName"
                            @blur="validateField('firstName')"
                            class="input-field" placeholder="First Name">
                        <label class="input-label">First Name</label>
                        <span x-show="errors.firstName" x-text="errors.firstName" class="input-error-msg"></span>
                    </div>

                    <!-- Email -->
                    <div class="input-wrapper" :class="{ 'has-error': errors.email }">
                        <input type="email"
                            x-model="formData.email"
                            @blur="validateField('email')"
                            class="input-field" placeholder="Email">
                        <label class="input-label">Email</label>
                        <span x-show="errors.email" x-text="errors.email" class="input-error-msg"></span>
                    </div>

                    <!-- Submit -->
                    <div class="pt-6 flex justify-center w-full text-center">
                        <a href="#"
                            @click.prevent="submitForm()"
                            :class="{ 'opacity-50 pointer-events-none': isSubmitting }"
                            class="btn btn-outline-dark px-10 py-3 text-sm font-medium hover:bg-dark hover:text-white">
                            <span x-text="isSubmitting ? 'Sending...' : 'Get the Guide'"></span>
                        </a>
                    </div>

                    <div x-show="successMessage" x-transition class="text-primary font-body text-sm text-center mt-2">
                        Thank you! Your guide is on its way.
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        /* ─── Brochure Modal ───────────────────────────────────────────── */
        function brochureModal() {
            return {
                show: false,
                isSubmitting: false,
                successMessage: false,
                formData: {
                    brochure: '<?php echo esc_js($first_file_url ?? ''); ?>',
                    firstName: '',
                    email: ''
                },
                errors: {},
                validateField(field) {
                    const v = this.formData;
                    if (field === 'brochure') this.errors.brochure = v.brochure ? '' : 'Please select a brochure.';
                    if (field === 'firstName') this.errors.firstName = v.firstName.trim() ? '' : 'First name is required.';
                    if (field === 'email') this.errors.email = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.email) ? '' : 'Please enter a valid email address.';
                },
                validateAll() {
                    ['brochure', 'firstName', 'email'].forEach(f => this.validateField(f));
                    return Object.values(this.errors).every(e => !e);
                },
                async submitForm() {
                    if (!this.validateAll()) return;
                    this.isSubmitting = true;
                    try {
                        const fd = new FormData();
                        fd.append('action', 'intense_brochure');
                        fd.append('nonce', '<?php echo wp_create_nonce('intense_forms_nonce'); ?>');
                        fd.append('brochure', this.formData.brochure);
                        fd.append('firstName', this.formData.firstName);
                        fd.append('email', this.formData.email);

                        const res = await fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                            method: 'POST',
                            body: fd
                        });

                        // We do not strict check res.ok here in case there are warnings, but we do try to parse JSON
                        const json = await res.json().catch(() => null);

                        console.log('[Brochure] HTTP status:', res.status, res.ok ? 'OK' : 'FAIL');
                        console.log('[Brochure] Server response:', json);

                        if (!res.ok) {
                            throw new Error(json?.data?.message || 'Error processing request');
                        }

                        this.successMessage = true;

                        // Trigger file download
                        if (this.formData.brochure) {
                            const link = document.createElement('a');
                            link.href = this.formData.brochure;
                            link.setAttribute('download', '');
                            link.target = '_blank';
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                        }

                        this.formData = {
                            brochure: '<?php echo esc_js($first_file_url ?? ''); ?>',
                            firstName: '',
                            email: ''
                        };
                        setTimeout(() => {
                            this.show = false;
                            this.successMessage = false;
                        }, 3000);
                    } catch (err) {
                        console.error('Error:', err);
                    } finally {
                        this.isSubmitting = false;
                    }
                }
            }
        }

        // Listen for the custom button click (since we used the template part, the anchor won't submit the Alpine form directly)
        document.addEventListener('DOMContentLoaded', () => {
            document.body.addEventListener('click', (e) => {
                const trigger = e.target.closest('#hidden-brochure-submit-trigger');
                if (trigger) {
                    e.preventDefault();
                    document.getElementById('hidden-brochure-submit').click();
                }
            });
        });
    </script>

</main>

<?php get_footer(); ?>