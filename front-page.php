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
 *     │     ├── destinations  (post_object, multiple → CPT destination)
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
$signature_destinations  = get_field('signature_destinations')  ?: [];
$motivation              = get_field('motivation')              ?: [];
$gallery_group           = get_field('gallery')                 ?: [];

$hero_description        = $banner_hero['description'] ?? '';
$hero_btn1               = $banner_hero['button_1']    ?? [];
$hero_btn2               = $banner_hero['button_2']    ?? [];
$hero_video_field        = $banner_hero['video']       ?? null;
// Campo tipo file devuelve array; tipo url devuelve string
$hero_video_url          = is_array($hero_video_field)
    ? ($hero_video_field['url'] ?? '')
    : (string) $hero_video_field;
$hero_video_fallback     = get_template_directory_uri() . '/assets/videos/intense_video_home_hero.mp4';

$dest_posts              = $signature_destinations['destinations'] ?? [];
$journey_posts           = $signature_destinations['journeys']     ?? [];

$motivation_title        = $motivation['title']            ?? '';
$motivation_image        = $motivation['image']            ?? [];
$list_of_purposes        = $motivation['list_of_purposes'] ?? [];

$gallery_title           = $gallery_group['title']  ?? '';
$gallery_photos          = $gallery_group['photos'] ?? [];

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
            <?php if ($hero_description) : ?>
                <p class="font-body text-white/90 text-lg md:text-xl font-light max-w-2xl mx-auto mb-10"
                    data-aos="fade-up" data-aos-delay="200">
                    <?php echo esc_html($hero_description); ?>
                </p>
            <?php endif; ?>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4" data-aos="fade-up"
                data-aos-delay="300">
                <?php if (!empty($hero_btn1)) : ?>
                    <?php get_template_part('template-parts/components/btn-primary', null, [
                        'text' => $hero_btn1['title'] ?? 'Explore itineraries',
                        'href' => $hero_btn1['url']   ?? '#',
                    ]); ?>
                <?php endif; ?>
                <?php if (!empty($hero_btn2)) : ?>
                    <?php get_template_part('template-parts/components/btn-outline', null, [
                        'text'  => $hero_btn2['title'] ?? 'Design my trip',
                        'href'  => $hero_btn2['url']   ?? '#',
                        'color' => 'light',
                    ]); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="container-site">
            <p class="font-body text-lg md:text-xl text-dark mb-0 max-w-4xl mx-auto text-center" data-aos="fade-up"
                data-aos-delay="200">
                Proudly Peruvian, we believe the future is built by keeping the past alive. Every day, we honor and
                nurture our traditions, share their beauty with the world, and design unforgettable experiences that
                invite people from around the globe to discover — and celebrate — life in Peru.
            </p>
        </div>
    </section>

    <!-- B. Signature Destinations -->
    <?php if (!empty($dest_posts)) : ?>
        <section class="py-10 bg-cream">
            <div class="container-site text-left">
                <h2 class="font-heading text-4xl md:text-5xl text-dark mb-12" data-aos="fade-up" data-aos-delay="100">
                    Signature Destinations</h2>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 auto-rows-[250px]">
                    <?php
                    // Bento layout: item 0 → 2col×2row, item 1 → 2col×1row, items 2-3 → 1col×1row
                    $bento_classes = [
                        'md:col-span-2 md:row-span-2',
                        'md:col-span-2',
                        '',
                        '',
                    ];
                    $heading_sizes = [
                        'text-3xl',
                        'text-2xl',
                        'text-xl',
                        'text-xl',
                    ];
                    $aos_delays = [200, 300, 400, 500];

                    foreach ($dest_posts as $idx => $dest_post) :
                        if ($idx >= 4) break;
                        $thumb = get_the_post_thumbnail_url($dest_post->ID, 'large') ?: get_template_directory_uri() . '/assets/images/intense_01.webp';
                        $dest_title = get_the_title($dest_post->ID);
                        $dest_url   = get_permalink($dest_post->ID);
                    ?>
                        <div class="<?php echo $bento_classes[$idx]; ?> relative group overflow-hidden rounded-lg cursor-pointer"
                            data-aos="fade-up" data-aos-delay="<?php echo $aos_delays[$idx]; ?>">
                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($dest_title); ?>"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-6 left-6 text-left">
                                <h3 class="font-heading text-white <?php echo $heading_sizes[$idx]; ?> font-medium mb-2">
                                    <?php echo esc_html($dest_title); ?></h3>
                                <?php get_template_part('template-parts/components/btn-outline', null, [
                                    'text'  => 'Explore destination',
                                    'href'  => $dest_url,
                                    'color' => 'light',
                                ]); ?>
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

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 text-left">
                        <?php foreach ($journey_posts as $jidx => $journey_post) :
                            $j_id          = $journey_post->ID;
                            $j_title       = get_the_title($j_id);
                            $j_url         = get_permalink($j_id);
                            $j_thumb       = get_the_post_thumbnail_url($j_id, 'large') ?: get_template_directory_uri() . '/assets/images/intense_02.webp';
                            $j_days        = get_field('information_days', $j_id) ?? '';
                            $j_price       = get_field('information_price', $j_id) ?? '';
                            $j_dests       = wp_get_post_tags($j_id, ['fields' => 'names']);
                            $j_badges      = get_field('badges', $j_id) ?: [];
                        ?>
                            <?php get_template_part('template-parts/components/card-itinerary', null, [
                                'image'        => $j_thumb,
                                'title'        => $j_title,
                                'price'        => $j_price,
                                'duration'     => $j_days ? $j_days . ' Days' : '',
                                'destinations' => $j_dests,
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
                <div data-aos="fade-left">
                    <?php if (!empty($list_of_purposes)) : ?>
                        <?php foreach ($list_of_purposes as $purpose) : ?>
                            <div class="mb-12">
                                <?php if (!empty($purpose['purpose_title'])) : ?>
                                    <h2 class="font-heading text-4xl md:text-5xl font-medium mb-6">
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

    <!-- E. Gallery -->
    <section class="py-20 bg-cream">
        <div class="flex flex-col md:flex-row items-center justify-center text-center gap-4 md:gap-12 mb-10">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_decoration_title.webp" alt=""
                class="mx-auto md:mb-10">
            <h2 class="font-heading text-3xl md:text-5xl text-dark md:mb-10 min-w-fit" data-aos="fade-up">
                <?php echo esc_html($gallery_title ?: 'Need a journey spark?'); ?>
            </h2>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_decoration_title.webp" alt=""
                class="mx-auto mb-10 hidden md:block">
        </div>
        <div class="container-site text-center">
            <?php if (!empty($gallery_photos)) :
                // Split photos into 4 columns (2 items each), percentage heights alternate
                $photos      = array_slice($gallery_photos, 0, 8);
                $col_heights = [
                    [['h' => '55%'], ['h' => '45%']],
                    [['h' => '45%'], ['h' => '55%']],
                    [['h' => '60%'], ['h' => '40%']],
                    [['h' => '45%'], ['h' => '55%']],
                ];
            ?>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 h-[1100px] md:h-[500px] lg:h-[600px] xl:h-[700px] w-full">
                    <?php for ($col = 0; $col < 4; $col++) : ?>
                        <div class="flex flex-col gap-4 h-full w-full">
                            <?php for ($row = 0; $row < 2; $row++) :
                                $photo_idx = ($col * 2) + $row;
                                if (!isset($photos[$photo_idx])) continue;
                                $photo = $photos[$photo_idx];
                                $h     = $col_heights[$col][$row]['h'];
                            ?>
                                <a href="<?php echo esc_url($photo['url']); ?>"
                                    class="block w-full relative group overflow-hidden rounded-sm"
                                    style="height: calc(<?php echo $h; ?> - 0.5rem);"
                                    data-aos="fade-up"
                                    data-aos-delay="<?php echo ($col * 150) + ($row * 100); ?>">
                                    <img src="<?php echo esc_url($photo['sizes']['large'] ?? $photo['url']); ?>"
                                        alt="<?php echo esc_attr($photo['alt'] ?? 'Gallery Image'); ?>"
                                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                </a>
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
    <section class="py-20 bg-cream">
        <div class="container-site">
            <div class="text-center mb-12">
                <h2 class="font-heading text-4xl md:text-5xl text-dark" data-aos="fade-up">Journal & Stories</h2>
            </div>
            <div class="text-right" data-aos="fade-up" data-aos-delay="100">
                <a href="<?php echo esc_url(get_post_type_archive_link('post')); ?>"
                    class="font-body text-sm text-dark uppercase tracking-wide hover:text-hover transition-colors font-medium flex items-center gap-2">See
                    All <svg class="w-12 h-6 text-dark transition-transform duration-300 group-hover:translate-x-2"
                        viewBox="0 0 40 10" fill="none" stroke="currentColor" stroke-width="1.5">
                        <line x1="0" y1="5" x2="38" y2="5"></line>
                        <polyline points="34 1 39 5 34 9"></polyline>
                    </svg></a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mt-4">
                <?php
                $recent_posts = get_posts([
                    'post_type'      => 'post',
                    'posts_per_page' => 3,
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ]);
                foreach ($recent_posts as $pidx => $story_post) :
                    $story_img  = get_the_post_thumbnail_url($story_post->ID, 'large') ?: get_template_directory_uri() . '/assets/images/intense_journal_01.webp';
                    $read_time  = get_field('read_time', $story_post->ID) ?? '';
                    $story_date = get_the_date('d M Y', $story_post->ID);
                ?>
                    <?php get_template_part('template-parts/components/card-story', null, [
                        'image'     => $story_img,
                        'image_alt' => get_the_title($story_post->ID),
                        'title'     => get_the_title($story_post->ID),
                        'read_time' => $read_time,
                        'date'      => $story_date,
                        'link'      => get_permalink($story_post->ID),
                        'aos_delay' => $pidx * 100,
                    ]); ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- I. Travel Guides Download -->
    <section class="py-20">
        <div class="container-site">
            <div class="flex flex-col md:flex-row items-center gap-12">
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
                        <p class="font-body text-dark text-lg mb-8 font-light">
                            <?php echo esc_html($guides_description); ?>
                        </p>
                    <?php endif; ?>

                    <?php if (!empty($download_button)) : ?>
                        <?php get_template_part('template-parts/components/btn-outline', null, [
                            'text'        => $download_button['title'] ?? 'Choose a Brochure',
                            'href'        => $download_button['url']   ?? '#',
                            'color'       => 'dark',
                            'class_extra' => 'px-10 py-4 text-base',
                        ]); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>