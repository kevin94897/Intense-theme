<?php

/**
 * Template Name: Single Journey Page
 * Template Post Type: journey
 *
 * @package Intense_Theme
 */

get_header();

// Fetch common ACF groups to use throughout the template
$information = get_field('information');
$feature_group = get_field('features');
$journey_gallery = get_field('journey_gallery');
$itinerary_group = get_field('itinerary');
$faq_group = get_field('frequently_asked_questions');

// Nested fields within the itinerary group
$prices_group = $itinerary_group['prices_per_person'] ?? null;
$selected_hotels = $itinerary_group['hotels'] ?? null;
$selected_activities = $itinerary_group['activities'] ?? [];

// Ensure $selected_activities is always an array for the loop
if (!is_array($selected_activities)) {
    $selected_activities = $selected_activities ? [$selected_activities] : [];
}
$selected_activities = array_filter($selected_activities);

// ---- PRE-FETCH HOTELS AND ACTIVITIES FOR DISPLAY AND NAVIGATION ----
// Usa el orden personalizado de categorías definido en el meta box "Intense Tag Order".
// Fallback: wp_get_post_terms si el plugin no está activo.
if (function_exists('ito_get_ordered_categories')) {
    $journey_cats = ito_get_ordered_categories(get_the_ID());
} else {
    $journey_cats = wp_get_post_terms(get_the_ID(), 'category', [
        'fields' => 'all',
        'orderby' => 'name',
        'order' => 'ASC',
    ]);
}
$hotel_tabs = [];
$hotels_data = [];
$hotel_cat_counts = [];

$itinerary_tabs = [];
$activities_data = [];

if (!is_wp_error($journey_cats) && !empty($journey_cats)) {
    // Shared tabs
    foreach ($journey_cats as $cat) {
        $hotel_tabs[$cat->slug] = $cat->name;
        $itinerary_tabs[$cat->slug] = $cat->name;
    }

    // -- Fetch Hotels --
    $hotel_query = new WP_Query([
        'post_type' => 'hotel',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => [
            [
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => array_keys($hotel_tabs),
                'operator' => 'IN',
            ]
        ],
    ]);

    $cat_counters_h = [];
    while ($hotel_query->have_posts()) {
        $hotel_query->the_post();
        $h_id = get_the_ID();
        $h_terms = wp_get_post_terms($h_id, 'category', ['fields' => 'slugs']);
        $h_cats = is_wp_error($h_terms) ? [] : array_values(array_intersect($h_terms, array_keys($hotel_tabs)));
        $h_rating = get_field('rating', $h_id);
        $h_location = get_field('location', $h_id);
        $h_video = get_field('video', $h_id);
        $h_services = get_field('list_of_services', $h_id);
        $h_amenities = [];
        if ($h_services) {
            foreach ($h_services as $svc) {
                $h_amenities[] = [
                    'icon' => $svc['icon'] ? '<img src="' . esc_url($svc['icon']['url']) . '" class="min-w-5 min-h-5 w-full h-full" alt="' . esc_attr($svc['icon']['alt']) . '">' : '',
                    'text' => $svc['service'],
                ];
            }
        }

        $h_cat_indices = [];
        foreach ($h_cats as $slug) {
            if (!isset($cat_counters_h[$slug]))
                $cat_counters_h[$slug] = 0;
            $h_cat_indices[$slug] = $cat_counters_h[$slug]++;
            $hotel_cat_counts[$slug] = $cat_counters_h[$slug];
        }

        $hotels_data[] = [
            'id' => $h_id,
            'image' => get_the_post_thumbnail_url($h_id, 'large'),
            'title' => get_the_title(),
            'stars' => $h_rating['stars'] ?? 5,
            'web_ratings' => $h_rating['rating_web'] ?? [],
            'location' => $h_location,
            'description' => get_the_content(),
            'video_link' => $h_video ? $h_video['url'] : '#',
            'amenities' => $h_amenities,
            'cats' => $h_cats,
            'cat_indices' => $h_cat_indices,
        ];
    }
    wp_reset_postdata();
    $hotel_tabs = array_filter($hotel_tabs, fn($slug) => !empty($hotel_cat_counts[$slug]), ARRAY_FILTER_USE_KEY);

    // -- Fetch Activities --
    $act_query = new WP_Query([
        'post_type' => 'activity',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => [
            [
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => array_keys($itinerary_tabs),
                'operator' => 'IN',
            ]
        ],
    ]);

    while ($act_query->have_posts()) {
        $act_query->the_post();
        $act_id = get_the_ID();
        $act_terms = wp_get_post_terms($act_id, 'category', ['fields' => 'slugs']);
        $activities_data[] = [
            'id' => $act_id,
            'image' => get_the_post_thumbnail_url($act_id, 'large'),
            'title' => get_the_title(),
            'cats' => is_wp_error($act_terms) ? [] : $act_terms,
        ];
    }
    wp_reset_postdata();
    $used_slugs_act = [];
    foreach ($activities_data as $act) {
        foreach ($act['cats'] as $s) {
            $used_slugs_act[$s] = true;
        }
    }
    $itinerary_tabs = array_filter($itinerary_tabs, fn($slug) => isset($used_slugs_act[$slug]), ARRAY_FILTER_USE_KEY);
}
// --------------------------------------------------------
?>

<main id="primary" class="site-main">

    <?php if ($information):
        $hero_img = $information['background_hero_image'] ?: get_the_post_thumbnail_url(get_the_ID(), 'full');
        $subtitle = $information['short_description'];
        $btn = $information['button_request'];
        ?>
        <!-- 1. Hero Section -->
        <section class="relative md:h-screen min-h-[600px] flex items-end justify-start pb-10 md:pb-20">
            <!-- Background Image -->
            <div class="absolute inset-0 z-0">
                <?php if ($hero_img): ?>
                    <img src="<?php echo esc_url(is_array($hero_img) ? $hero_img['url'] : $hero_img); ?>"
                        alt="<?php echo esc_attr(is_array($hero_img) ? $hero_img['alt'] : 'Journey Hero'); ?>"
                        class="absolute inset-0 w-full h-full object-cover block">
                <?php endif; ?>
                <!-- Add a gradient overlay for text readability -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
            </div>

            <!-- Content -->
            <div class="container-site relative z-10 w-full" data-aos="fade-up">
                <div class="max-w-4xl text-white">
                    <h1 class="font-heading text-4xl md:text-6xl mb-4 leading-tight">
                        <!-- <?php echo esc_html($information['days']) ? esc_html($information['days']) . ' - ' : ''; ?> -->
                        <?php the_title(); ?>
                    </h1>
                    <?php if ($subtitle): ?>
                        <p class="font-body text-lg md:text-xl font-light mb-8 max-w-2xl">
                            <?php echo esc_html($subtitle); ?>
                        </p>
                    <?php endif; ?>
                    <?php if ($btn && is_array($btn)):
                        get_template_part('template-parts/components/btn-outline', null, [
                            'text' => $btn['title'],
                            'href' => $btn['url'],
                            'target' => $btn['target'] ? $btn['target'] : '_self',
                            'color' => 'light',
                            'class_extra' => 'px-10 py-3 text-sm'
                        ]);
                    endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ($feature_group && (!empty($feature_group['title']) || !empty($feature_group['description']) || !empty($feature_group['features']))):
        $features = $feature_group['features'];
        ?>
        <!-- 2. Overview Section -->
        <section class="py-24 overflow-hidden">
            <div class="container-site max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-center">

                    <!-- Left: Description -->
                    <div>
                        <?php if (!empty($feature_group['title'])): ?>
                            <h2 data-aos="fade-up" data-aos-duration="800" data-aos-delay="100"
                                class="font-heading text-4xl md:text-5xl text-dark mb-6 leading-tight">
                                <?php echo esc_html($feature_group['title']); ?>
                            </h2>
                        <?php endif; ?>

                        <?php if (!empty($feature_group['description'])): ?>
                            <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="200"
                                class="font-body text-neutral-black text-lg leading-relaxed font-light space-y-4 mb-10">
                                <?php echo wp_kses_post($feature_group['description']); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Stats row -->
                        <div data-aos="fade-right" data-aos-duration="700" data-aos-delay="350"
                            class="flex items-center gap-8 pt-8 border-t border-neutral-gray/20">
                            <?php if (!empty($feature_group['price'])): ?>
                                <div>
                                    <span class="block font-body text-3xl md:text-4xl text-dark font-light">USD
                                        <?php echo esc_html(number_format((float) $feature_group['price'], 0, '.', ',')); ?></span>
                                    <span
                                        class="block font-body text-[10px] text-neutral-gray uppercase tracking-widest mt-1">per
                                        person</span>
                                </div>
                                <div class="w-px h-10 bg-neutral-gray/30"></div>
                            <?php endif; ?>

                            <?php if (!empty($information['days'])): ?>
                                <div>
                                    <span
                                        class="block font-body text-3xl md:text-4xl text-dark font-light"><?php echo esc_html($information['days']); ?>/<?php echo esc_html(str_pad($information['days'] - 1, 2, '0', STR_PAD_LEFT)); ?></span>
                                    <span
                                        class="block font-body text-[10px] text-neutral-gray uppercase tracking-widest mt-1">days
                                        / nights</span>
                                </div>
                                <div class="w-px h-10 bg-neutral-gray/30"></div>
                            <?php endif; ?>

                            <!-- Compass animation -->
                            <div data-aos="fade-in" data-aos-delay="600">
                                <svg class="w-9 h-9 text-[#bd7a4e] animate-[spin_25s_linear_infinite] opacity-70"
                                    viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <circle cx="24" cy="24" r="20" stroke-dasharray="4 3" />
                                    <polygon points="24,8 27,24 24,28 21,24" fill="currentColor" opacity="0.7" />
                                    <polygon points="24,40 27,24 24,20 21,24" fill="currentColor" opacity="0.2" />
                                    <circle cx="24" cy="24" r="3" fill="currentColor" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Highlights -->
                    <?php if (!empty($features) && is_array($features)): ?>
                        <div class="space-y-4">
                            <?php foreach ($features as $index => $item):
                                $delay = 100 + ($index * 150);
                                ?>
                                <div data-aos="fade-left" data-aos-duration="700" data-aos-delay="<?php echo $delay; ?>"
                                    class="flex items-start gap-4 md:gap-6 p-5 transition-all duration-500">
                                    <div class="text-primary">
                                        <svg width="67" class="w-[30px] md:w-[40px] h-auto" height="67" viewBox="0 0 67 67"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.947266 15.9482L50.9461 65.9463" stroke="#5D7F6E" stroke-width="2.68001" />
                                            <path d="M15.9482 0.949219L65.9471 50.9473" stroke="#5D7F6E" stroke-width="2.68001" />
                                            <path d="M0.947266 15.9482L50.9461 65.9463" stroke="#38464C" stroke-width="2.68001" />
                                            <path d="M15.9482 0.949219L65.9471 50.9473" stroke="#DC973C" stroke-width="2.68001" />
                                            <path d="M15.9463 65.9443L65.9451 15.9463" stroke="#5D7F6E" stroke-width="2.68001" />
                                            <path d="M0.947266 50.9453L50.9461 0.947236" stroke="#5D7F6E" stroke-width="2.68001" />
                                            <path d="M15.9463 65.9443L65.9451 15.9463" stroke="#5D7F6E" stroke-width="2.68001" />
                                            <path d="M0.947266 50.9453L50.9461 0.947236" stroke="#B76739" stroke-width="2.68001" />
                                            <rect x="30.9521" y="30.9473" width="4.99933" height="4.99925" fill="#423931" />
                                        </svg>

                                    </div>
                                    <div>
                                        <h3 class="font-body text-base text-dark mb-2 transition-colors duration-300">
                                            <?php echo esc_html($item['feature_title'] ?? ''); ?>
                                        </h3>
                                        <?php if (!empty($item['feature_description'])): ?>
                                            <p class="font-body text-sm font-light text-dark leading-relaxed">
                                                <?php echo esc_html($item['feature_description']); ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- 3. Gallery (Embla Carousel) -->
    <?php if ($journey_gallery && is_array($journey_gallery) && !empty($journey_gallery)): ?>
        <section class="" data-aos="fade-in">
            <div class="embla-gallery w-full">
                <div class="embla journey-gallery-embla overflow-hidden cursor-grab active:cursor-grabbing">
                    <div class="embla__container flex">
                        <?php foreach ($journey_gallery as $img): ?>
                            <div class="embla__slide min-w-0">
                                <div class="relative">
                                    <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>"
                                        class="w-full object-cover block">
                                    <!-- <div class="absolute inset-0 bg-primary/20"></div> -->
                                    <?php if (!empty($img['caption'])): ?>
                                        <p class="font-body text-sm font-light text-dark mt-3 px-2 text-left">
                                            <?php echo esc_html($img['caption']); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <?php if ($itinerary_group && !empty($itinerary_group['list_of_tours'])): ?>
        <!-- 4. Main Body: Itinerary Layout -->
        <section class="py-12 md:py-20 pb-28 lg:pb-20 bg-cream">
            <div class="container-site-wide mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 md:gap-18 items-start">

                    <!-- Left: Sticky Navigation -->
                    <aside class="hidden md:block lg:col-span-4 lg:sticky lg:top-32" data-aos="fade-right">
                        <nav class="mb-8 font-body text-dark text-sm md:text-base">
                            <ul>

                                <li class="border-b border-neutral-gray/30">
                                    <a href="#itinerary"
                                        class="flex items-center gap-4 py-4 hover:text-[#bd7a4e] transition-colors font-semibold text-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="18" viewBox="0 0 25 18"
                                            fill="none">
                                            <path
                                                d="M0 18V13.097C0.862069 12.7164 1.55651 12.1623 2.08333 11.4347C2.61015 10.7071 2.87356 9.89552 2.87356 9C2.87356 8.10448 2.61015 7.29291 2.08333 6.5653C1.55651 5.83769 0.862069 5.28358 0 4.90299V0H25V18H0ZM1.00575 17.0597H23.9943V0.940299H1.00575V4.36567C1.89176 4.85821 2.59219 5.51306 3.10704 6.33022C3.62189 7.14739 3.87931 8.03731 3.87931 9C3.87931 9.96269 3.62189 10.8526 3.10704 11.6698C2.59219 12.4869 1.89176 13.1418 1.00575 13.6343V17.0597ZM8.11782 13.5L20.546 10.4104C20.8573 10.3433 21.1087 10.1922 21.3003 9.95709C21.4919 9.72202 21.5517 9.47015 21.4799 9.20149C21.408 8.93284 21.2344 8.74813 20.9591 8.64739C20.6837 8.54664 20.4023 8.52985 20.1149 8.59702L16.4511 9.53731L10.704 4.5L9.33908 4.76866L12.7874 10.4104L8.69253 11.3507L6.89655 10.0746L6.17816 10.2761L8.11782 13.5Z"
                                                fill="#3E362F" />
                                        </svg>
                                        Itinerary
                                    </a>
                                </li>


                                <?php
                                $inc_not_inc = $itinerary_group['table_includednot_included'] ?? null;
                                if ($inc_not_inc && (!empty($inc_not_inc['included_list']) || !empty($inc_not_inc['not_included_list']))): ?>
                                    <li class="border-b border-neutral-gray/30">
                                        <a href="#included"
                                            class="flex items-center gap-4 py-4 hover:text-[#bd7a4e] transition-colors">
                                            <svg class="w-5 h-5 shrink-0 text-dark" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Included / not included
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($prices_group && !empty($prices_group['tables_for_prices'])): ?>
                                    <li class="border-b border-neutral-gray/30">
                                        <a href="#price"
                                            class="flex items-center gap-6 py-4 hover:text-[#bd7a4e] transition-colors">
                                            <svg width="21" height="21" viewBox="0 0 10 21" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.37348 21V18.4868C3.32703 18.3505 2.42801 17.9838 1.67643 17.3868C0.924842 16.7897 0.366032 15.9638 0 14.9091L1.13073 14.4103C1.48274 15.3351 1.96651 16.047 2.58205 16.5458C3.1976 17.0447 4.03256 17.2941 5.08693 17.2941C6.01442 17.2941 6.86178 17.0601 7.62903 16.5922C8.39627 16.1242 8.77989 15.3699 8.77989 14.3294C8.77989 13.4505 8.49754 12.7445 7.93283 12.2115C7.36813 11.6787 6.31151 11.1605 4.76299 10.6569C3.18621 10.1484 2.07642 9.56746 1.43363 8.91419C0.79063 8.26093 0.469131 7.41012 0.469131 6.36176C0.469131 5.21356 0.903999 4.29656 1.77373 3.61076C2.64347 2.92518 3.51005 2.55459 4.37348 2.499V0H5.59358V2.499C6.4383 2.58465 7.16376 2.82182 7.76995 3.21053C8.37614 3.59944 8.87862 4.15254 9.27739 4.86984L8.19333 5.43066C7.90233 4.89846 7.50193 4.46765 6.99213 4.13824C6.48213 3.80882 5.83293 3.64412 5.04453 3.64412C4.10281 3.64412 3.30822 3.89632 2.66075 4.40074C2.01308 4.90515 1.68924 5.55882 1.68924 6.36176C1.68924 7.12044 1.95522 7.7349 2.48719 8.20513C3.01895 8.67557 4.08411 9.1665 5.68265 9.67791C7.16406 10.1531 8.25403 10.7632 8.95254 11.5083C9.65085 12.2536 10 13.1892 10 14.3152C10 15.5552 9.5691 16.5403 8.7073 17.2703C7.84529 18.0004 6.80739 18.4106 5.59358 18.501V21H4.37348Z"
                                                    fill="#161616" />
                                            </svg>

                                            Prices
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if (!empty($hotels_data)): ?>
                                    <li class="border-b border-neutral-gray/30">
                                        <a href="#hotels"
                                            class="flex items-center gap-4 py-4 hover:text-[#bd7a4e] transition-colors">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5 24V9H6.1V19.3846H15.45V11.3077H27V24H25.9V20.5385H6.1V24H5ZM10.4975 17.2102C9.85054 17.2102 9.30137 16.9726 8.85 16.4974C8.39863 16.0222 8.17295 15.4453 8.17295 14.7666C8.17295 14.088 8.39946 13.5119 8.85247 13.0385C9.30549 12.565 9.85549 12.3283 10.5025 12.3283C11.1495 12.3283 11.6986 12.5659 12.15 13.0411C12.6014 13.5163 12.827 14.0932 12.827 14.7718C12.827 15.4505 12.6005 16.0265 12.1475 16.5C11.6945 16.9735 11.1445 17.2102 10.4975 17.2102ZM16.55 19.3846H25.9V12.4615H16.55V19.3846ZM10.5 16.0563C10.8399 16.0563 11.1294 15.931 11.3684 15.6802C11.6075 15.4294 11.727 15.1258 11.727 14.7692C11.727 14.4127 11.6075 14.109 11.3684 13.8583C11.1294 13.6075 10.8399 13.4821 10.5 13.4821C10.1601 13.4821 9.87062 13.6075 9.63155 13.8583C9.39248 14.109 9.27295 14.4127 9.27295 14.7692C9.27295 15.1258 9.39248 15.4294 9.63155 15.6802C9.87062 15.931 10.1601 16.0563 10.5 16.0563Z"
                                                    fill="#161616" />
                                            </svg>

                                            Hotels
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if (!empty($activities_data)): ?>
                                    <li class="border-b border-neutral-gray/30">
                                        <a href="#activities"
                                            class="flex items-center gap-4 py-4 hover:text-[#bd7a4e] transition-colors">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5 14.4868L10.0875 6L15.1751 14.4868H5ZM10.1105 26C8.93708 26 7.94471 25.6118 7.13339 24.8354C6.32226 24.0592 5.91669 23.1128 5.91669 21.9962C5.91669 20.8627 6.32226 19.9089 7.13339 19.1348C7.94471 18.3607 8.93708 17.9737 10.1105 17.9737C11.2837 17.9737 12.2759 18.3619 13.0873 19.1382C13.8986 19.9144 14.3043 20.864 14.3043 21.9868C14.3043 23.1097 13.8986 24.0592 13.0873 24.8354C12.2759 25.6118 11.2837 26 10.1105 26ZM10.1105 24.8597C10.9492 24.8597 11.6592 24.5815 12.2406 24.0252C12.8219 23.4689 13.1126 22.7894 13.1126 21.9868C13.1126 21.1842 12.8219 20.5048 12.2406 19.9485C11.6592 19.3922 10.9492 19.114 10.1105 19.114C9.27174 19.114 8.5617 19.3922 7.98036 19.9485C7.39903 20.5048 7.10836 21.1842 7.10836 21.9868C7.10836 22.7894 7.39903 23.4689 7.98036 24.0252C8.5617 24.5815 9.27174 24.8597 10.1105 24.8597ZM7.05801 13.3464H13.14L10.0875 8.31348L7.05801 13.3464ZM17.8104 26V17.9737H26.198V26H17.8104ZM19.0021 24.8597H25.0063V19.114H19.0021V24.8597ZM22.0042 14.4868C21.2694 13.9253 20.596 13.4042 19.984 12.9233C19.3721 12.4423 18.8454 11.9751 18.4039 11.5219C17.9624 11.0688 17.6194 10.6185 17.3749 10.1711C17.1306 9.72371 17.0084 9.25512 17.0084 8.76534C17.0084 8.08551 17.241 7.52408 17.7062 7.08105C18.1713 6.63822 18.7637 6.4168 19.4832 6.4168C19.9583 6.4168 20.4025 6.52827 20.8158 6.75121C21.2291 6.97414 21.6253 7.30931 22.0042 7.75671C22.3832 7.32394 22.7869 6.99239 23.2153 6.76204C23.6439 6.53188 24.0881 6.4168 24.5478 6.4168C25.2464 6.4168 25.8297 6.6499 26.2978 7.11612C26.7659 7.58252 27 8.15421 27 8.8312C27 9.30634 26.8778 9.76391 26.6333 10.2039C26.389 10.6441 26.046 11.0871 25.6043 11.533C25.1627 11.9788 24.6361 12.4423 24.0244 12.9233C23.4125 13.4042 22.7391 13.9253 22.0042 14.4868ZM22.0042 13.0066C23.3883 11.9831 24.3684 11.1534 24.9444 10.5175C25.5203 9.88156 25.8083 9.31651 25.8083 8.82236C25.8083 8.4584 25.6881 8.15649 25.4476 7.91664C25.2068 7.67698 24.904 7.55715 24.5389 7.55715C24.2823 7.55715 24.0321 7.63127 23.7885 7.77951C23.5446 7.92795 23.2072 8.20829 22.7764 8.62052L22.0042 9.34664L21.232 8.62052C20.7857 8.19365 20.4454 7.9097 20.2111 7.76868C19.9765 7.62766 19.7293 7.55715 19.4695 7.55715C19.0892 7.55715 18.7825 7.66605 18.5496 7.88386C18.3166 8.10166 18.2001 8.39986 18.2001 8.77846C18.2001 9.30188 18.4881 9.88156 19.0641 10.5175C19.6401 11.1534 20.6201 11.9831 22.0042 13.0066Z"
                                                    fill="#161616" />
                                            </svg>

                                            Other Activities
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($faq_group && !empty($faq_group['list_of_questions'])): ?>
                                    <li class="border-b border-neutral-gray/30">
                                        <a href="#faq"
                                            class="flex items-center gap-4 py-4 hover:text-[#bd7a4e] transition-colors">
                                            <svg class="w-5 h-5 shrink-0 text-dark" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                            FAQ
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>

                        <?php get_template_part('template-parts/components/btn-primary', null, [
                            'text' => __('Free Quote Request', 'intense-nerd-theme'),
                            'href' => '#booking-form',
                            'class_extra' => 'w-full',
                        ]); ?>

                        <?php
                        $raw_whatsapp = get_theme_mod('contact_whatsapp', '51994008833');
                        $clean_whatsapp = str_replace(array(' ', '-', '(', ')', '+'), '', $raw_whatsapp);
                        ?>

                        <div class="text-center mt-6 text-[12px] font-body">
                            <p class="mb-1">Do you need help? Contact Us</p>
                            <a href="https://wa.me/<?php echo esc_attr($clean_whatsapp); ?>" target="_blank"
                                rel="noopener noreferrer"
                                class="pr-5 pl-5 hover:text-primary transition-colors justify-center flex items-center gap-2">
                                <span class="md:block hidden">+<?php echo esc_html($raw_whatsapp); ?></span>
                            </a>
                            <div class="flex items-center justify-center gap-3">
                                <a href="https://wa.me/<?php echo esc_attr($clean_whatsapp); ?>" target="_blank"
                                    rel="noopener noreferrer" aria-label="WhatsApp"
                                    class="text-neutral-gray hover:text-green-500 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <g clip-path="url(#clip0_59_1135)">
                                            <path
                                                d="M3 21L4.65 17.2C3.38766 15.408 2.82267 13.217 3.06104 11.0381C3.29942 8.85915 4.32479 6.84211 5.94471 5.36549C7.56463 3.88887 9.66775 3.05418 11.8594 3.01807C14.051 2.98195 16.1805 3.7469 17.8482 5.16934C19.5159 6.59179 20.6071 8.57395 20.9172 10.7438C21.2272 12.9137 20.7347 15.1222 19.5321 16.9547C18.3295 18.7873 16.4994 20.118 14.3854 20.6971C12.2713 21.2762 10.0186 21.0639 8.05 20.1L3 21Z"
                                                stroke="#161616" stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M9 10C9 10.1326 9.05268 10.2598 9.14645 10.3536C9.24021 10.4473 9.36739 10.5 9.5 10.5C9.63261 10.5 9.75979 10.4473 9.85355 10.3536C9.94732 10.2598 10 10.1326 10 10V9C10 8.86739 9.94732 8.74021 9.85355 8.64645C9.75979 8.55268 9.63261 8.5 9.5 8.5C9.36739 8.5 9.24021 8.55268 9.14645 8.64645C9.05268 8.74021 9 8.86739 9 9V10ZM9 10C9 11.3261 9.52678 12.5979 10.4645 13.5355C11.4021 14.4732 12.6739 15 14 15M14 15H15C15.1326 15 15.2598 14.9473 15.3536 14.8536C15.4473 14.7598 15.5 14.6326 15.5 14.5C15.5 14.3674 15.4473 14.2402 15.3536 14.1464C15.2598 14.0527 15.1326 14 15 14H14C13.8674 14 13.7402 14.0527 13.6464 14.1464C13.5527 14.2402 13.5 14.3674 13.5 14.5C13.5 14.6326 13.5527 14.7598 13.6464 14.8536C13.7402 14.9473 13.8674 15 14 15Z"
                                                stroke="#161616" stroke-linecap="round" stroke-linejoin="round" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_59_1135">
                                                <rect width="24" height="24" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                                <a href="mailto:<?php echo get_theme_mod('contact_email', 'sales@intenseperu.com'); ?>"
                                    aria-label="Email" class="hover:text-dark transition-colors">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4.6155 19C4.15517 19 3.77083 18.8458 3.4625 18.5375C3.15417 18.2292 3 17.8448 3 17.3845V6.6155C3 6.15517 3.15417 5.77083 3.4625 5.4625C3.77083 5.15417 4.15517 5 4.6155 5H19.3845C19.8448 5 20.2292 5.15417 20.5375 5.4625C20.8458 5.77083 21 6.15517 21 6.6155V17.3845C21 17.8448 20.8458 18.2292 20.5375 18.5375C20.2292 18.8458 19.8448 19 19.3845 19H4.6155ZM12 12.1155L4 6.8845V17.3845C4 17.564 4.05767 17.7115 4.173 17.827C4.2885 17.9423 4.436 18 4.6155 18H19.3845C19.564 18 19.7115 17.9423 19.827 17.827C19.9423 17.7115 20 17.564 20 17.3845V6.8845L12 12.1155ZM12 11L19.6923 6H4.30775L12 11ZM4 6.8845V6V17.3845C4 17.564 4.05767 17.7115 4.173 17.827C4.2885 17.9423 4.436 18 4.6155 18H4V6.8845Z"
                                            fill="#161616" />
                                    </svg>

                                </a>
                            </div>
                        </div>
                    </aside>

                    <!-- Right: Content -->
                    <div class="lg:col-span-8 bg-cream">

                        <!-- Itinerary Accordion -->
                        <?php if ($itinerary_group && !empty($itinerary_group['list_of_tours'])):
                            $tours = $itinerary_group['list_of_tours'];
                            ?>
                            <div id="itinerary" class="scroll-mt-32 mb-20" data-aos="fade-up">
                                <div class="space-y-6">
                                    <?php foreach ($tours as $index => $tour):
                                        $open = ($index === 0) ? 'true' : 'false';
                                        ?>
                                        <div x-data="{ expanded: <?php echo $open; ?> }" x-init="$watch('expanded', value => value && setTimeout(() => { 
                                             const headerHeight = 100;
                                             const buffer = 24;
                                             const rect = $el.getBoundingClientRect();
                                             const elTop = rect.top + window.pageYOffset;
                                             const elHeight = rect.height;
                                             const viewHeight = window.innerHeight;
                                             const availableHeight = viewHeight - headerHeight;
                                             const targetTop = elHeight > availableHeight 
                                                 ? elTop - headerHeight - buffer 
                                                 : elTop - (availableHeight - elHeight) / 2 - headerHeight;
                                             window.scrollTo({ top: targetTop, behavior: 'smooth' });
                                         }, 300))" class="border-b border-neutral-gray/20 pb-6 mb-6">
                                            <button @click="expanded = !expanded"
                                                class="w-full flex items-center justify-between text-left transition-colors hover:text-[#bd7a4e] group">
                                                <div class="flex items-center gap-4">
                                                    <!-- Colored Icon Cross -->
                                                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M0 6.12292L19.23 25.3524" stroke="#5D7F6E" />
                                                        <path d="M5.76953 0.354126L24.9995 19.5836" stroke="#5D7F6E" />
                                                        <path d="M0 6.12292L19.23 25.3524" stroke="#38464C" />
                                                        <path d="M5.76953 0.354126L24.9995 19.5836" stroke="#DC973C" />
                                                        <path d="M5.76953 25.3517L24.9995 6.12223" stroke="#5D7F6E" />
                                                        <path d="M0 19.583L19.23 0.353548" stroke="#5D7F6E" />
                                                        <path d="M5.76953 25.3517L24.9995 6.12223" stroke="#5D7F6E" />
                                                        <path d="M0 19.583L19.23 0.353548" stroke="#B76739" />
                                                        <rect x="11.5391" y="11.8916" width="1.92279" height="1.92273"
                                                            fill="#423931" />
                                                    </svg>

                                                    <h4 class="font-heading text-2xl md:text-3xl text-dark group-hover:text-[#bd7a4e] transition-all duration-300 flex flex-wrap items-baseline gap-2"
                                                        :class="expanded ? 'scale-[1.02] text-[#bd7a4e]' : 'scale-100'">
                                                        <span>Day</span>
                                                        <span><?php echo $index + 1; ?>:</span>
                                                        <span><?php echo esc_html($tour['itinerary_title']); ?></span>
                                                    </h4>
                                                </div>
                                                <svg class="w-5 h-5 transform transition-transform duration-300 shrink-0 text-neutral-dark group-hover:text-primary"
                                                    :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </button>

                                            <div x-show="expanded" x-collapse x-cloak>
                                                <div class="pt-8 pr-4 contenido-journey"> <!-- Indented content -->
                                                    <?php if (!empty($tour['itinerary_image']) && is_array($tour['itinerary_image'])): ?>
                                                        <img src="<?php echo esc_url($tour['itinerary_image']['url']); ?>"
                                                            alt="<?php echo esc_attr($tour['itinerary_image']['alt']); ?>"
                                                            class="w-full h-auto object-cover rounded-lg mb-8 shadow-sm">
                                                    <?php endif; ?>

                                                    <?php if (!empty($tour['list_of_activities']) && is_array($tour['list_of_activities'])):
                                                        foreach ($tour['list_of_activities'] as $activity):
                                                            ?>
                                                            <div class="flex items-center gap-3 mb-4 mt-4 shadow-none">
                                                                <?php if (!empty($activity['icon']) || !empty($activity['icon_2'])): ?>
                                                                    <div class="flex items-center gap-2">
                                                                        <?php if (!empty($activity['icon'])): ?>
                                                                            <img src="<?php echo esc_url($activity['icon']['url']); ?>"
                                                                                alt="<?php echo esc_attr($activity['icon']['alt']); ?>"
                                                                                class="w-6 h-6 object-contain shrink-0">
                                                                        <?php endif; ?>
                                                                        <?php if (!empty($activity['icon_2'])): ?>
                                                                            <img src="<?php echo esc_url($activity['icon_2']['url']); ?>"
                                                                                alt="<?php echo esc_attr($activity['icon_2']['alt']); ?>"
                                                                                class="w-6 h-6 object-contain shrink-0">
                                                                        <?php endif; ?>
                                                                    </div>
                                                                <?php else: ?>
                                                                    <!-- <svg class="w-6 h-6 text-dark shrink-0" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                    </path>
                                                                </svg> -->
                                                                <?php endif; ?>
                                                                <h5 class="font-heading text-xl text-dark font-bold">
                                                                    <?php echo esc_html($activity['activity_title']); ?>
                                                                </h5>
                                                            </div>

                                                            <?php if (!empty($activity['activity_description'])): ?>
                                                                <div
                                                                    class="font-body text-neutral-black text-[15px] font-light leading-relaxed mb-6">
                                                                    <?php echo wp_kses_post($activity['activity_description']); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endforeach;
                                                    endif; ?>

                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($itinerary_group && !empty($itinerary_group['table_includednot_included'])):
                            $inc_not_inc = $itinerary_group['table_includednot_included'];
                            $included = isset($inc_not_inc['included_list']) ? $inc_not_inc['included_list'] : null;
                            $not_included = isset($inc_not_inc['not_included_list']) ? $inc_not_inc['not_included_list'] : null;
                            if (!empty($included) || !empty($not_included)):
                                ?>
                                <!-- Included / Not Included -->
                                <div id="included" class="scroll-mt-32 mb-24" data-aos="fade-up">
                                    <div class="mb-12 text-center">
                                        <h3 class="font-heading text-3xl md:text-4xl text-dark">Included / Not Included</h3>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-20">
                                        <!-- Included -->
                                        <?php if (!empty($included) && is_array($included)): ?>
                                            <div>
                                                <h4 class="font-heading italic font-semibold text-dark text-xl mb-6">Included</h4>
                                                <ul class="space-y-3 font-body text-neutral-black font-light text-lg">
                                                    <?php foreach ($included as $item): ?>
                                                        <li class="flex gap-3 text-base md:text-lg leading-relaxed">
                                                            <span class="mt-[0.3em] shrink-0">
                                                                <svg width="23" height="17" viewBox="0 0 23 17" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                                    <rect x="7.30212" y="2.05615" width="3.75789" height="3.75789"
                                                                        transform="rotate(45 7.30212 2.05615)" fill="#76A78E" />
                                                                    <path d="M0.702698 7.97068L7.5277 14.7114L21.7027 0.711426"
                                                                        stroke="#76A78E" stroke-width="2" />
                                                                </svg>
                                                            </span>
                                                            <span class="min-w-0">
                                                                <?php echo esc_html($item['item'] ?? ''); ?>
                                                            </span>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Not Included -->
                                        <?php if (!empty($not_included) && is_array($not_included)): ?>
                                            <div>
                                                <h4 class="font-heading italic font-semibold text-dark text-xl mb-6">Not Included</h4>
                                                <ul class="space-y-3 font-body text-neutral-black font-light text-lg">
                                                    <?php foreach ($not_included as $item): ?>
                                                        <li class="flex gap-3 text-base md:text-lg leading-relaxed">
                                                            <span class="mt-[0.3em] shrink-0">
                                                                <svg viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg"
                                                                    class="w-5 md:w-6 h-auto">
                                                                    <rect y="6.70703" width="3" height="3" fill="#C45454" />
                                                                    <rect x="19" y="6.70703" width="3" height="3" fill="#C45454" />
                                                                    <path d="M4 14.707L18 0.707031" stroke="#C25454" stroke-width="2" />
                                                                    <path d="M4 0.707031L18 14.707" stroke="#C25454" stroke-width="2" />
                                                                </svg>
                                                            </span>
                                                            <span class="min-w-0">
                                                                <?php echo esc_html($item['item'] ?? ''); ?>
                                                            </span>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif;
                        endif; ?>

                        <!-- Pricing Options -->
                        <?php if ($prices_group && !empty($prices_group['tables_for_prices'])): ?>
                            <div id="price" class="scroll-mt-24 mb-24" data-aos="fade-up">
                                <div class="text-center mb-10">
                                    <h3 class="font-heading text-3xl md:text-4xl text-dark mb-4">Pricing Options</h3>
                                    <?php if (!empty($prices_group['description'])): ?>
                                        <p class="font-body text-xs text-[#626262] italic max-w-sm mx-auto leading-relaxed">
                                            <?php echo esc_html($prices_group['description']); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                                <div class="max-w-2xl mx-auto space-y-14">
                                    <?php foreach ($prices_group['tables_for_prices'] as $table_row):
                                        $table = $table_row['prices_table'];
                                        if ($table && !empty($table['body'])):
                                            ?>
                                            <div class="overflow-x-auto">
                                                <table class="w-full text-left border-collapse">
                                                    <?php if (!empty($table['header'])): ?>
                                                        <thead>
                                                            <tr class="border-b-2 border-dark text-dark">
                                                                <?php foreach ($table['header'] as $index => $header): ?>
                                                                    <th
                                                                        class="py-3 <?php echo $index === 0 ? 'pr-6' : 'text-right'; ?> font-normal uppercase">
                                                                        <?php echo esc_html($header['c']); ?>
                                                                    </th>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        </thead>
                                                    <?php endif; ?>
                                                    <tbody class="font-body text-[15px] font-light text-[#626262]">
                                                        <?php foreach ($table['body'] as $row): ?>
                                                            <tr class="border-b border-neutral-gray/30">
                                                                <?php foreach ($row as $index => $cell): ?>
                                                                    <td class="py-5 <?php echo $index === 0 ? 'pr-6' : 'text-right'; ?>">
                                                                        <?php echo esc_html($cell['c']); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                                <?php if (!empty($table_row['notes'])): ?>
                                                    <div
                                                        class="mt-4 font-body text-md text-dark italic notes leading-relaxed font-light [&_p]:mb-4 last:[&_p]:mb-0">
                                                        <?php echo wp_kses_post($table_row['notes']); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif;
                                    endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Hotels -->
                        <?php if (!empty($hotels_data)): ?>
                            <?php $first_hotel_tab = array_key_first($hotel_tabs) ?? 'all'; ?>
                            <div id="hotels" class="scroll-mt-32 mb-20" data-aos="fade-up"
                                x-data="{ activeTab: '<?php echo esc_js($first_hotel_tab); ?>', visibleCount: 3, catCounts: {} }"
                                x-init="catCounts = JSON.parse($el.dataset.catCounts)"
                                data-cat-counts='<?php echo wp_json_encode($hotel_cat_counts); ?>'>

                                <div class="text-center mb-10">
                                    <h3 class="font-heading text-4xl md:text-5xl text-dark">Hotels</h3>
                                </div>

                                <!-- Category Tabs -->
                                <?php if (!empty($hotel_tabs)): ?>
                                    <div class="flex items-center gap-5 overflow-x-auto no-scrollbar pb-1 mb-10">
                                        <!-- <button
                                        @click="activeTab = 'all'; visibleCount = 3"
                                        :class="activeTab === 'all' ? 'text-dark border-b-2 border-[#bd7a4e] font-semibold' : 'text-neutral-gray hover:text-dark'"
                                        class="font-heading text-base pb-1 transition-colors whitespace-nowrap shrink-0 outline-none">
                                        All
                                    </button> -->
                                        <?php foreach ($hotel_tabs as $slug => $name): ?>
                                            <button @click="activeTab = '<?php echo esc_js($slug); ?>'; visibleCount = 3"
                                                :class="activeTab === '<?php echo esc_attr($slug); ?>' ? 'text-dark border-b-2 border-[#bd7a4e] font-semibold' : 'text-neutral-gray hover:text-dark'"
                                                class="font-heading text-base pb-1 transition-colors whitespace-nowrap shrink-0 outline-none">
                                                <?php echo esc_html($name); ?>
                                            </button>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="mb-10">
                                    <?php foreach ($hotels_data as $global_idx => $hotel): ?>
                                        <div class="hotel-item" data-cats="<?php echo esc_attr(implode(' ', $hotel['cats'])); ?>"
                                            data-global-idx="<?php echo $global_idx; ?>"
                                            data-cat-indices='<?php echo wp_json_encode($hotel['cat_indices']); ?>'
                                            x-show="$el.dataset.cats.split(' ').includes(activeTab) && (JSON.parse($el.dataset.catIndices)[activeTab] ?? 999) < visibleCount"
                                            x-transition>
                                            <?php get_template_part('template-parts/components/card-hotel', null, [
                                                'image' => $hotel['image'],
                                                'title' => $hotel['title'],
                                                'stars' => $hotel['stars'],
                                                'type' => 'Hotel',
                                                'web_ratings' => $hotel['web_ratings'],
                                                'location' => $hotel['location'],
                                                'description' => $hotel['description'],
                                                'video_link' => $hotel['video_link'],
                                                'amenities' => $hotel['amenities'],
                                            ]); ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <!-- See More -->
                                <div class="flex justify-center">
                                    <button @click="visibleCount += 3" x-show="visibleCount < (catCounts[activeTab] ?? 0)"
                                        class="btn btn-outline-dark text-md px-20">
                                        See more
                                    </button>
                                </div>

                            </div>
                        <?php endif; ?>

                        <!-- Other Activities -->
                        <?php if (!empty($activities_data)):
                            $first_itinerary_tab = array_key_first($itinerary_tabs) ?? ''; ?>
                            <div id="activities" class="scroll-mt-32" data-aos="fade-up"
                                x-data="{ activeTab: '<?php echo esc_attr($first_itinerary_tab); ?>' }"
                                x-init="$nextTick(() => window.filterActivities && window.filterActivities($refs.activitiesSlider, '<?php echo esc_attr($first_itinerary_tab); ?>'))">
                                <div
                                    class="flex flex-col md:flex-row items-center justify-center text-center gap-4 md:gap-6 overflow-hidden">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_decoration_title_short.webp"
                                        alt="" class="mx-auto md:mb-10">
                                    <h2 class="font-heading text-3xl md:text-5xl text-dark md:mb-10 min-w-fit"
                                        data-aos="fade-up">Other Activities</h2>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_decoration_title_short.webp"
                                        alt="" class="mx-auto mb-10 hidden md:block">
                                </div>

                                <!-- Slider Wrapper -->
                                <div class="embla-activities relative -mx-6 md:mx-0">
                                    <!-- Category Tabs + Navigation -->
                                    <div class="flex items-center justify-between gap-4 mb-8 px-4 md:px-0">

                                        <!-- Tabs: always show when itinerary has tour days -->
                                        <?php if (!empty($itinerary_tabs)): ?>
                                            <div class="flex items-center gap-5 overflow-x-auto no-scrollbar pb-1">
                                                <!-- <button
                                                @click="activeTab = 'all'; window.filterActivities($refs.activitiesSlider, 'all')"
                                                :class="activeTab === 'all' ? 'text-dark border-b-2 border-[#bd7a4e] font-semibold' : 'text-neutral-gray hover:text-dark'"
                                                class="font-heading text-base pb-1 transition-colors whitespace-nowrap shrink-0 outline-none">
                                                All
                                            </button> -->
                                                <?php foreach ($itinerary_tabs as $slug => $label): ?>
                                                    <button
                                                        @click="activeTab = '<?php echo esc_js($slug); ?>'; window.filterActivities($refs.activitiesSlider, '<?php echo esc_js($slug); ?>')"
                                                        :class="activeTab === '<?php echo esc_attr($slug); ?>' ? 'text-dark border-b-2 border-[#bd7a4e] font-semibold' : 'text-neutral-gray hover:text-dark'"
                                                        class="font-heading text-base pb-1 transition-colors whitespace-nowrap shrink-0 outline-none">
                                                        <?php echo esc_html($label); ?>
                                                    </button>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php else: ?>
                                            <div></div>
                                        <?php endif; ?>

                                        <!-- Prev / Next -->
                                        <div class="flex gap-6 shrink-0">
                                            <button
                                                class="embla__prev outline-none text-[#bd7a4e] hover:text-dark transition-colors disabled:opacity-30 disabled:cursor-not-allowed">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="w-8 h-8"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M15 18l-6-6 6-6" />
                                                </svg>
                                            </button>
                                            <button
                                                class="embla__next outline-none text-[#bd7a4e] hover:text-dark transition-colors disabled:opacity-30 disabled:cursor-not-allowed">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="w-8 h-8"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M9 18l6-6-6-6" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Loader overlay (shown while filter transitions) -->
                                    <div
                                        class="activities-loader absolute inset-x-0 top-0 bottom-8 z-10 flex items-center justify-center bg-cream/80 opacity-0 pointer-events-none transition-opacity duration-200 rounded-xl">
                                        <div
                                            class="w-9 h-9 border-2 border-[#bd7a4e] border-t-transparent rounded-full animate-spin">
                                        </div>
                                    </div>

                                    <!-- Viewport Embla -->
                                    <div class="embla overflow-hidden cursor-grab active:cursor-grabbing pb-4"
                                        x-ref="activitiesSlider">
                                        <div class="embla__container flex flex-row -ml-6 md:-ml-8">
                                            <?php foreach ($activities_data as $act): ?>
                                                <div class="embla__slide flex-[0_0_85%] md:flex-[0_0_45%] lg:flex-[0_0_33.333%] min-w-0 pl-6 md:pl-8"
                                                    data-category="<?php echo esc_attr(implode(' ', $act['cats'])); ?>">
                                                    <?php get_template_part('template-parts/components/card-activity', null, [
                                                        'image' => $act['image'],
                                                        'title' => $act['title'],
                                                    ]); ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-body text-sm text-[#626262] leading-relaxed font-light italic">Ask your
                                        Travel Advisor to add this experience</p>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div> <!-- End Main Content Col -->

                </div> <!-- End Grid -->
            </div>

            <!-- Mobile Bottom Action Bar & Drawer -->
            <div class="md:hidden" x-data="{ drawerOpen: false }" @keydown.escape.window="drawerOpen = false"
                x-init="$watch('drawerOpen', v => document.body.style.overflow = v ? 'hidden' : '')">

                <!-- Fixed Bottom Bar -->
                <div
                    class="fixed bottom-0 left-0 right-0 z-40 bg-white border-t border-neutral-gray/20 px-4 py-3 shadow-[0_-4px_24px_rgba(0,0,0,0.08)]">
                    <button @click="drawerOpen = true"
                        class="flex rounded-md items-center gap-2 px-4 py-3 btn btn-primary transition-all duration-200 shrink-0 w-full">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        Sections
                    </button>
                    <!-- <a href="#booking-form"
                        class="flex-1 text-center bg-dark text-white text-sm font-medium py-3 px-4 hover:opacity-80 transition-all rounded-md">
                        Free Quote Request
                    </a> -->
                </div>

                <!-- Overlay -->
                <div x-show="drawerOpen" x-transition:enter="transition-opacity ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" @click="drawerOpen = false" class="fixed inset-0 z-40 bg-black/40"
                    style="display:none;">
                </div>

                <!-- Bottom Drawer -->
                <div x-show="drawerOpen" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-y-0"
                    x-transition:leave-end="translate-y-full"
                    class="fixed bottom-0 left-0 right-0 z-50 bg-white rounded-t-2xl shadow-2xl" style="display:none;">

                    <!-- Handle -->
                    <div class="flex justify-center pt-3 pb-1">
                        <div class="w-10 h-1 bg-neutral-gray/30 rounded-full"></div>
                    </div>

                    <!-- Header -->
                    <div class="flex items-center justify-between px-6 py-4 border-b border-neutral-gray/20">
                        <span class="font-heading text-xl text-dark">Sections</span>
                        <button @click="drawerOpen = false" class="text-neutral-gray hover:text-dark transition-colors p-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Nav Links -->
                    <nav class="px-6 py-2 font-body text-dark">
                        <ul>
                            <li class="border-b border-neutral-gray/20">
                                <a href="#itinerary" @click="drawerOpen = false"
                                    class="flex items-center gap-4 py-4 hover:text-[#bd7a4e] transition-colors font-semibold">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="18" viewBox="0 0 25 18"
                                        fill="none">
                                        <path
                                            d="M0 18V13.097C0.862069 12.7164 1.55651 12.1623 2.08333 11.4347C2.61015 10.7071 2.87356 9.89552 2.87356 9C2.87356 8.10448 2.61015 7.29291 2.08333 6.5653C1.55651 5.83769 0.862069 5.28358 0 4.90299V0H25V18H0ZM1.00575 17.0597H23.9943V0.940299H1.00575V4.36567C1.89176 4.85821 2.59219 5.51306 3.10704 6.33022C3.62189 7.14739 3.87931 8.03731 3.87931 9C3.87931 9.96269 3.62189 10.8526 3.10704 11.6698C2.59219 12.4869 1.89176 13.1418 1.00575 13.6343V17.0597ZM8.11782 13.5L20.546 10.4104C20.8573 10.3433 21.1087 10.1922 21.3003 9.95709C21.4919 9.72202 21.5517 9.47015 21.4799 9.20149C21.408 8.93284 21.2344 8.74813 20.9591 8.64739C20.6837 8.54664 20.4023 8.52985 20.1149 8.59702L16.4511 9.53731L10.704 4.5L9.33908 4.76866L12.7874 10.4104L8.69253 11.3507L6.89655 10.0746L6.17816 10.2761L8.11782 13.5Z"
                                            fill="#3E362F" />
                                    </svg>
                                    Itinerary
                                </a>
                            </li>

                            <?php if ($inc_not_inc && (!empty($inc_not_inc['included_list']) || !empty($inc_not_inc['not_included_list']))): ?>
                                <li class="border-b border-neutral-gray/20">
                                    <a href="#included" @click="drawerOpen = false"
                                        class="flex items-center gap-4 py-4 hover:text-[#bd7a4e] transition-colors">
                                        <svg class="w-5 h-5 shrink-0 text-dark" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Included / Not included
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if ($prices_group && !empty($prices_group['tables_for_prices'])): ?>
                                <li class="border-b border-neutral-gray/20">
                                    <a href="#price" @click="drawerOpen = false"
                                        class="flex items-center gap-4 py-4 hover:text-[#bd7a4e] transition-colors">
                                        <svg width="21" height="21" viewBox="0 0 10 21" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M4.37348 21V18.4868C3.32703 18.3505 2.42801 17.9838 1.67643 17.3868C0.924842 16.7897 0.366032 15.9638 0 14.9091L1.13073 14.4103C1.48274 15.3351 1.96651 16.047 2.58205 16.5458C3.1976 17.0447 4.03256 17.2941 5.08693 17.2941C6.01442 17.2941 6.86178 17.0601 7.62903 16.5922C8.39627 16.1242 8.77989 15.3699 8.77989 14.3294C8.77989 13.4505 8.49754 12.7445 7.93283 12.2115C7.36813 11.6787 6.31151 11.1605 4.76299 10.6569C3.18621 10.1484 2.07642 9.56746 1.43363 8.91419C0.79063 8.26093 0.469131 7.41012 0.469131 6.36176C0.469131 5.21356 0.903999 4.29656 1.77373 3.61076C2.64347 2.92518 3.51005 2.55459 4.37348 2.499V0H5.59358V2.499C6.4383 2.58465 7.16376 2.82182 7.76995 3.21053C8.37614 3.59944 8.87862 4.15254 9.27739 4.86984L8.19333 5.43066C7.90233 4.89846 7.50193 4.46765 6.99213 4.13824C6.48213 3.80882 5.83293 3.64412 5.04453 3.64412C4.10281 3.64412 3.30822 3.89632 2.66075 4.40074C2.01308 4.90515 1.68924 5.55882 1.68924 6.36176C1.68924 7.12044 1.95522 7.7349 2.48719 8.20513C3.01895 8.67557 4.08411 9.1665 5.68265 9.67791C7.16406 10.1531 8.25403 10.7632 8.95254 11.5083C9.65085 12.2536 10 13.1892 10 14.3152C10 15.5552 9.5691 16.5403 8.7073 17.2703C7.84529 18.0004 6.80739 18.4106 5.59358 18.501V21H4.37348Z"
                                                fill="#161616" />
                                        </svg>
                                        Prices
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (!empty($hotels_data)): ?>
                                <li class="border-b border-neutral-gray/20">
                                    <a href="#hotels" @click="drawerOpen = false"
                                        class="flex items-center gap-4 py-4 hover:text-[#bd7a4e] transition-colors">
                                        <svg class="w-5 h-5 shrink-0 text-dark" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1" />
                                        </svg>
                                        Hotels
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (!empty($activities_data)): ?>
                                <li class="border-b border-neutral-gray/20">
                                    <a href="#activities" @click="drawerOpen = false"
                                        class="flex items-center gap-4 py-4 hover:text-[#bd7a4e] transition-colors">
                                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5 14.4868L10.0875 6L15.1751 14.4868H5ZM10.1105 26C8.93708 26 7.94471 25.6118 7.13339 24.8354C6.32226 24.0592 5.91669 23.1128 5.91669 21.9962C5.91669 20.8627 6.32226 19.9089 7.13339 19.1348C7.94471 18.3607 8.93708 17.9737 10.1105 17.9737C11.2837 17.9737 12.2759 18.3619 13.0873 19.1382C13.8986 19.9144 14.3043 20.864 14.3043 21.9868C14.3043 23.1097 13.8986 24.0592 13.0873 24.8354C12.2759 25.6118 11.2837 26 10.1105 26ZM10.1105 24.8597C10.9492 24.8597 11.6592 24.5815 12.2406 24.0252C12.8219 23.4689 13.1126 22.7894 13.1126 21.9868C13.1126 21.1842 12.8219 20.5048 12.2406 19.9485C11.6592 19.3922 10.9492 19.114 10.1105 19.114C9.27174 19.114 8.5617 19.3922 7.98036 19.9485C7.39903 20.5048 7.10836 21.1842 7.10836 21.9868C7.10836 22.7894 7.39903 23.4689 7.98036 24.0252C8.5617 24.5815 9.27174 24.8597 10.1105 24.8597ZM7.05801 13.3464H13.14L10.0875 8.31348L7.05801 13.3464ZM17.8104 26V17.9737H26.198V26H17.8104ZM19.0021 24.8597H25.0063V19.114H19.0021V24.8597ZM22.0042 14.4868C21.2694 13.9253 20.596 13.4042 19.984 12.9233C19.3721 12.4423 18.8454 11.9751 18.4039 11.5219C17.9624 11.0688 17.6194 10.6185 17.3749 10.1711C17.1306 9.72371 17.0084 9.25512 17.0084 8.76534C17.0084 8.08551 17.241 7.52408 17.7062 7.08105C18.1713 6.63822 18.7637 6.4168 19.4832 6.4168C19.9583 6.4168 20.4025 6.52827 20.8158 6.75121C21.2291 6.97414 21.6253 7.30931 22.0042 7.75671C22.3832 7.32394 22.7869 6.99239 23.2153 6.76204C23.6439 6.53188 24.0881 6.4168 24.5478 6.4168C25.2464 6.4168 25.8297 6.6499 26.2978 7.11612C26.7659 7.58252 27 8.15421 27 8.8312C27 9.30634 26.8778 9.76391 26.6333 10.2039C26.389 10.6441 26.046 11.0871 25.6043 11.533C25.1627 11.9788 24.6361 12.4423 24.0244 12.9233C23.4125 13.4042 22.7391 13.9253 22.0042 14.4868ZM22.0042 13.0066C23.3883 11.9831 24.3684 11.1534 24.9444 10.5175C25.5203 9.88156 25.8083 9.31651 25.8083 8.82236C25.8083 8.4584 25.6881 8.15649 25.4476 7.91664C25.2068 7.67698 24.904 7.55715 24.5389 7.55715C24.2823 7.55715 24.0321 7.63127 23.7885 7.77951C23.5446 7.92795 23.2072 8.20829 22.7764 8.62052L22.0042 9.34664L21.232 8.62052C20.7857 8.19365 20.4454 7.9097 20.2111 7.76868C19.9765 7.62766 19.7293 7.55715 19.4695 7.55715C19.0892 7.55715 18.7825 7.66605 18.5496 7.88386C18.3166 8.10166 18.2001 8.39986 18.2001 8.77846C18.2001 9.30188 18.4881 9.88156 19.0641 10.5175C19.6401 11.1534 20.6201 11.9831 22.0042 13.0066Z"
                                                fill="#161616" />
                                        </svg>
                                        Other Activities
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if ($faq_group && !empty($faq_group['list_of_questions'])): ?>
                                <li>
                                    <a href="#faq" @click="drawerOpen = false"
                                        class="flex items-center gap-4 py-4 hover:text-[#bd7a4e] transition-colors">
                                        <svg class="w-5 h-5 shrink-0 text-dark" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        FAQ
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>

                    <!-- CTA -->
                    <div class="px-6 pb-8 pt-4">
                        <?php get_template_part('template-parts/components/btn-primary', null, [
                            'text' => __('Free Quote Request', 'intense-nerd-theme'),
                            'href' => '#booking-form',
                            'class_extra' => 'w-full',
                        ]); ?>
                    </div>
                </div>
            </div><!-- End Mobile Bottom Action Bar -->

        </section>
    <?php endif; ?>
    <!-- Banner Text -->
    <?php get_template_part('template-parts/components/banner-text'); ?>

    <!-- 5. General Testimonials -->
    <?php get_template_part('template-parts/home/section-testimonials'); ?>

    <!-- 6. General CTA -->
    <?php get_template_part('template-parts/components/banner-cta'); ?>

    <!-- 7. More Journeys (Related) -->
    <section class="py-12 md:py-24 bg-cream">
        <div class="container-site">
            <div class="text-center mb-8">
                <div class="flex justify-center w-full mb-2">
                    <svg width="81" height="52" viewBox="0 0 81 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M40.1372 35.1196L23.5879 25.6125L40.1372 16.1055L56.6865 25.6125L40.1372 35.1196Z"
                            stroke="#5D7F6E" stroke-width="1.40845" />
                        <path d="M40.1372 28.077L35.5598 25.6122L40.1372 23.1475L44.7147 25.6122L40.1372 28.077Z"
                            fill="#5D7F6E" />
                        <path d="M11.6161 0.612305L40.1372 16.8095L68.6583 0.612305" stroke="#5D7F6E"
                            stroke-width="1.40845" />
                        <path d="M68.6583 50.6123L40.1372 34.4151L11.6161 50.6123" stroke="#5D7F6E"
                            stroke-width="1.40845" />
                        <path d="M11.6161 0.612305L40.1372 16.8095L68.6583 0.612305" stroke="#5D7F6E"
                            stroke-width="1.40845" />
                        <path d="M68.6583 50.6123L40.1372 34.4151L11.6161 50.6123" stroke="#5D7F6E"
                            stroke-width="1.40845" />
                        <path d="M29.2217 4.13379L40.4893 11.176L51.757 4.13379" stroke="#5D7F6E"
                            stroke-width="1.40845" />
                        <path d="M51.7569 47.0908L40.4893 40.0486L29.2217 47.0908" stroke="#5D7F6E"
                            stroke-width="1.40845" />
                        <path d="M80.6302 11.1758L55.2781 25.6124L80.6302 40.049" stroke="#5D7F6E"
                            stroke-width="1.40845" />
                        <path d="M0.34845 11.1758L25.7006 25.6124L0.34845 40.049" stroke="#5D7F6E"
                            stroke-width="1.40845" />
                    </svg>
                </div>
                <h2 class="font-heading text-4xl text-dark" data-aos="fade-up">Explore More Journeys</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-left">
                <?php
                $related_query = new WP_Query([
                    'post_type' => 'journey',
                    'posts_per_page' => 3,
                    'post__not_in' => [get_the_ID()],
                    'orderby' => 'rand',
                ]);
                $r_index = 0;
                while ($related_query->have_posts()):
                    $related_query->the_post();
                    $r_features = get_field('features');
                    $r_information = get_field('information');
                    $r_days_val = (int) ($r_information['days'] ?? 0);
                    $r_price_val = $r_features['price'] ?? '';
                    ?>
                    <?php get_template_part('template-parts/components/card-itinerary', null, [
                        'image' => get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_template_directory_uri() . '/assets/images/intense_01.webp',
                        'title' => get_the_title(),
                        'price' => $r_price_val ? 'USD ' . number_format($r_price_val) : '',
                        'duration' => $r_days_val ? $r_days_val . ' Days' : '',
                        'post_id' => get_the_ID(),
                        'link' => get_permalink(),
                        'link_text' => 'Explore itinerary',
                        'aos_delay' => ($r_index % 3) * 100,
                        'badges' => get_field('badges') ?: [],
                    ]); ?>
                    <?php $r_index++; endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </section>

    <!-- 8. Booking Form Section -->
    <section id="booking-form" class="py-24">
        <div class="container-site max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">

                <!-- Left: Form Info -->
                <div class="lg:col-span-4" data-aos="fade-right">
                    <h2 class="font-heading text-3xl md:text-4xl text-dark mb-8 font-light leading-tight">Free
                        Quote<br>Request</h2>
                    <!-- <p class="font-body text-dark text-lg font-light leading-relaxed">
                        Located in Arequipa's historic center, Cirqa lies steps from the Mai}
                    </p> -->
                </div>

                <!-- Right: Actually Form -->
                <div class="lg:col-span-8" data-aos="fade-left">
                    <form x-data="bookingForm()" @submit="submitForm" class="space-y-8 md:space-y-10"
                        data-page-source="<?php echo esc_attr(get_the_title()); ?>"
                        data-page-url="<?php echo esc_attr(get_permalink()); ?>">
                        <!-- Name Row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                            <div class="input-wrapper" :class="{ 'has-error': errors.firstName }">
                                <input type="text" x-model="formData.firstName" @input="validateField('firstName')"
                                    class="input-field" placeholder="First Name">
                                <span x-show="errors.firstName" x-text="errors.firstName"
                                    class="input-error-msg"></span>
                            </div>
                            <div class="input-wrapper" :class="{ 'has-error': errors.lastName }">
                                <input type="text" x-model="formData.lastName" @input="validateField('lastName')"
                                    class="input-field" placeholder="Last Name">
                                <span x-show="errors.lastName" x-text="errors.lastName" class="input-error-msg"></span>
                            </div>
                        </div>

                        <!-- Email Row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                            <div class="input-wrapper" :class="{ 'has-error': errors.email }">
                                <input type="email" x-model="formData.email" @input="validateField('email')"
                                    class="input-field" placeholder="Email">
                                <span x-show="errors.email" x-text="errors.email" class="input-error-msg"></span>
                            </div>
                            <div class="input-wrapper" :class="{ 'has-error': errors.confirmEmail }">
                                <input type="email" x-model="formData.confirmEmail"
                                    @input="validateField('confirmEmail')" class="input-field"
                                    placeholder="Confirm Email">
                                <span x-show="errors.confirmEmail" x-text="errors.confirmEmail"
                                    class="input-error-msg"></span>
                            </div>
                        </div>

                        <!-- Date & Trip Length Row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                            <div class="input-wrapper cursor-pointer" :class="{ 'has-error': errors.startDate }">
                                <div class="absolute right-0 top-0 bottom-2 flex items-center pointer-events-none"
                                    x-show="!formData.startDate">
                                    <svg class="w-5 h-5 text-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="text" readonly
                                    x-init="flatpickr($el, {
                                        dateFormat: 'd/m/Y',
                                        minDate: 'today',
                                        disableMobile: true,
                                        onChange(dates, dateStr) {
                                            formData.startDate = dateStr;
                                            validateField('startDate');
                                        }
                                    })"
                                    :value="formData.startDate"
                                    class="input-field cursor-pointer" placeholder="Start Date">
                                <span x-show="errors.startDate" x-text="errors.startDate" class="input-error-msg"></span>
                            </div>
                            <div class="input-wrapper" :class="{ 'has-error': errors.tripLength }">
                                <div class="absolute right-0 top-0 bottom-2 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <select x-model="formData.tripLength" @change="validateField('tripLength')"
                                    class="input-field" :class="formData.tripLength ? 'text-dark' : 'text-dark/40'"
                                    x-init="formData.tripLength = '<?php echo esc_js($information['days'] ?? ''); ?>'">
                                    <option value="" disabled>Trip Length (days)</option>
                                    <?php for ($d = 2; $d <= 20; $d++): ?>
                                    <option value="<?php echo $d; ?>"><?php echo $d; ?></option>
                                    <?php endfor; ?>
                                    <option value="20+">20+</option>
                                </select>
                                <span x-show="errors.tripLength" x-text="errors.tripLength" class="input-error-msg"></span>
                            </div>
                        </div>

                        <!-- Passengers Row -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                            <div>
                                <!-- <p class="font-body text-xs text-dark/40 uppercase tracking-widest mb-3">Adults</p> -->
                                <div class="input-wrapper" :class="{ 'has-error': errors.adults }">
                                    <div class="absolute right-0 top-0 bottom-2 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-dark" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                    <select x-model="formData.adults" @change="validateField('adults')"
                                        class="input-field" :class="formData.adults ? 'text-dark' : 'text-dark/40'">
                                        <option value="" disabled selected>Adults</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                    <span x-show="errors.adults" x-text="errors.adults" class="input-error-msg"></span>
                                </div>
                            </div>
                            <div>
                                <!-- <p class="font-body text-xs text-dark/40 uppercase tracking-widest mb-3">Children &lt;12 -->
                                </p>
                                <div class="input-wrapper" :class="{ 'has-error': errors.children }">
                                    <div class="absolute right-0 top-0 bottom-2 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-dark" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                    <select x-model="formData.children" @change="validateField('children')" class="input-field"
                                        :class="formData.children ? 'text-dark' : 'text-dark/40'">
                                        <option value="" disabled selected>Children &lt;12</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                    <span x-show="errors.children" x-text="errors.children" class="input-error-msg"></span>
                                </div>
                            </div>
                            <div>
                                <!-- <p class="font-body text-xs text-dark/40 uppercase tracking-widest mb-3">Infants &lt;1 -->
                                </p>
                                <div class="input-wrapper" :class="{ 'has-error': errors.enfants }">
                                    <div class="absolute right-0 top-0 bottom-2 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-dark" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                    <select x-model="formData.enfants" @change="validateField('enfants')" class="input-field"
                                        :class="formData.enfants ? 'text-dark' : 'text-dark/40'">
                                        <option value="" disabled selected>Infants &lt;1</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                    <span x-show="errors.enfants" x-text="errors.enfants" class="input-error-msg"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Hotel Category Row -->
                        <div class="pt-2 input-wrapper" :class="{ 'has-error': errors.hotelCategory }">
                            <p class="font-body text-xs text-dark/40 uppercase tracking-widest mb-6">Hotel Category</p>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-6">
                                <!-- Boutique -->
                                <button type="button" @click="setHotelCategory('boutique')"
                                    class="group flex flex-col items-center gap-2.5 px-3 py-2 rounded-md cursor-pointer border transition-all duration-200"
                                    :class="formData.hotelCategory === 'boutique'
                                        ? 'border-primary bg-primary/10'
                                        : 'border-dark hover:border-dark/40'">
                                    <span class="font-body text-sm transition-colors"
                                        :class="formData.hotelCategory === 'boutique' ? 'text-primary font-medium' : 'text-dark'">Boutique</span>
                                    <div class="flex gap-0.5"
                                        :class="formData.hotelCategory === 'boutique' ? 'text-primary' : 'text-neutral-gray'">
                                        <template x-for="i in 5"><svg class="w-3.5 h-3.5 fill-current"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg></template>
                                    </div>
                                </button>
                                <!-- Luxury -->
                                <button type="button" @click="setHotelCategory('luxury')"
                                    class="group flex flex-col items-center gap-2.5 px-3 py-2 rounded-md cursor-pointer border transition-all duration-200"
                                    :class="formData.hotelCategory === 'luxury'
                                        ? 'border-primary bg-primary/10'
                                        : 'border-dark hover:border-dark/40'">
                                    <span class="font-body text-sm transition-colors"
                                        :class="formData.hotelCategory === 'luxury' ? 'text-primary font-medium' : 'text-dark'">Luxury</span>
                                    <div class="flex gap-0.5"
                                        :class="formData.hotelCategory === 'luxury' ? 'text-primary' : 'text-neutral-gray'">
                                        <template x-for="i in 5"><svg class="w-3.5 h-3.5 fill-current"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg></template>
                                    </div>
                                </button>
                                <!-- Superior -->
                                <button type="button" @click="setHotelCategory('superior')"
                                    class="group flex flex-col items-center gap-2.5 px-3 py-2 rounded-md cursor-pointer border transition-all duration-200"
                                    :class="formData.hotelCategory === 'superior'
                                        ? 'border-primary bg-primary/10'
                                        : 'border-dark hover:border-dark/40'">
                                    <span class="font-body text-sm transition-colors"
                                        :class="formData.hotelCategory === 'superior' ? 'text-primary font-medium' : 'text-dark'">Superior</span>
                                    <div class="flex gap-0.5"
                                        :class="formData.hotelCategory === 'superior' ? 'text-primary' : 'text-neutral-gray'">
                                        <template x-for="i in 4"><svg class="w-3.5 h-3.5 fill-current"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg></template>
                                    </div>
                                </button>
                                <!-- Best Value -->
                                <button type="button" @click="setHotelCategory('value')"
                                    class="group flex flex-col items-center gap-2.5 px-3 py-2 rounded-md cursor-pointer border transition-all duration-200"
                                    :class="formData.hotelCategory === 'value'
                                        ? 'border-primary bg-primary/10'
                                        : 'border-dark hover:border-dark/40'">
                                    <span class="font-body text-sm transition-colors"
                                        :class="formData.hotelCategory === 'value' ? 'text-primary font-medium' : 'text-dark'">Best
                                        Value</span>
                                    <div class="flex gap-0.5"
                                        :class="formData.hotelCategory === 'value' ? 'text-primary' : 'text-neutral-gray'">
                                        <template x-for="i in 3"><svg class="w-3.5 h-3.5 fill-current"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg></template>
                                    </div>
                                </button>
                            </div>
                            <span x-show="errors.hotelCategory" x-text="errors.hotelCategory"
                                class="input-error-msg"></span>
                        </div>

                        <!-- WhatsApp & Hear about us Row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 pt-6">
                            <div class="input-wrapper">
                                <input type="text" x-model="formData.whatsapp" class="input-field"
                                    placeholder="WhatsApp (optional)">
                            </div>
                            <div class="input-wrapper">
                                <div class="absolute right-0 top-0 bottom-2 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-dark" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                <select x-model="formData.hearAboutUs" class="input-field"
                                    :class="{'text-dark/40': !formData.hearAboutUs, 'text-dark': formData.hearAboutUs}">
                                    <option value="" disabled selected hidden>How do you hear about us</option>
                                    <option value="google">Google Search</option>
                                    <option value="friend">Friend/Family</option>
                                    <option value="social">Social Media</option>
                                    <option value="travel-agent">Travel Agent</option>
                                    <option value="ai">Artificial Intelligence</option>
                                </select>
                            </div>
                        </div>

                        <!-- Mensaje Row -->
                        <div class="pt-4">
                            <p class="font-body text-xs text-dark/40 uppercase tracking-widest mb-3">Additional comments
                                (optional)</p>
                            <div class="input-wrapper">
                                <textarea rows="4" x-model="formData.mensaje" class="input-field"
                                    placeholder="Let us know if you have any special requests or would like to personalize your experience.&#10;If you are traveling with children, kindly indicate their exact ages at the time of travel."></textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6 md:pt-10 flex justify-center md:justify-start">
                            <button type="submit" class="btn-submit-intense w-full md:w-auto" :disabled="isSubmitting">
                                <span x-show="!isSubmitting">Send Request</span>
                                <span x-show="isSubmitting" class="flex items-center gap-2">
                                    <svg class="animate-spin h-4 w-4 text-current" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    Sending...
                                </span>
                            </button>
                            <p x-show="submitSuccess" style="display: none;"
                                class="mt-4 text-sm text-green-600 font-body">Request sent successfully! We will contact
                                you soon.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. FAQ -->
    <!-- FAQ Section -->
    <section class="py-16 bg-cream">
        <div class="container-site max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16 items-start">

                <!-- Left: Title -->
                <div class="lg:col-span-3 flex items-center gap-4" data-aos="fade-right">
                    <svg width="67" class="w-[30px] md:w-[40px] h-auto" height="67" viewBox="0 0 67 67" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.947266 15.9482L50.9461 65.9463" stroke="#5D7F6E" stroke-width="2.68001" />
                        <path d="M15.9482 0.949219L65.9471 50.9473" stroke="#5D7F6E" stroke-width="2.68001" />
                        <path d="M0.947266 15.9482L50.9461 65.9463" stroke="#38464C" stroke-width="2.68001" />
                        <path d="M15.9482 0.949219L65.9471 50.9473" stroke="#DC973C" stroke-width="2.68001" />
                        <path d="M15.9463 65.9443L65.9451 15.9463" stroke="#5D7F6E" stroke-width="2.68001" />
                        <path d="M0.947266 50.9453L50.9461 0.947236" stroke="#5D7F6E" stroke-width="2.68001" />
                        <path d="M15.9463 65.9443L65.9451 15.9463" stroke="#5D7F6E" stroke-width="2.68001" />
                        <path d="M0.947266 50.9453L50.9461 0.947236" stroke="#B76739" stroke-width="2.68001" />
                        <rect x="30.9521" y="30.9473" width="4.99933" height="4.99925" fill="#423931" />
                    </svg>

                    <h2 class="font-heading text-4xl md:text-5xl font-light text-dark">FAQ</h2>
                </div>

                <!-- Right: Accordion -->
                <div class="lg:col-span-9" data-aos="fade-left" x-data="{ active: null }">

                    <?php
                    $faqs_global = get_field('faqs', 'option');
                    $faqs = $faqs_global['list_of_questions'] ?? [];
                    ?>

                    <ul class="divide-y divide-neutral-gray/50">
                        <?php foreach ($faqs as $i => $faq): ?>
                            <li>
                                <button type="button"
                                    @click="active === <?php echo $i; ?> ? active = null : active = <?php echo $i; ?>"
                                    class="w-full flex items-center justify-between py-5 gap-6 text-left group focus:outline-none">

                                    <span class="font-body text-sm md:text-[15px] transition-colors duration-200"
                                        :class="active === <?php echo $i; ?> ? 'text-primary' : 'text-dark/80 group-hover:text-dark'">
                                        <?php echo esc_html($faq['question']); ?>
                                    </span>

                                    <!-- Arrow: rotates to × when open -->
                                    <span class="shrink-0 transition-transform duration-300"
                                        :class="active === <?php echo $i; ?> ? 'rotate-90' : ''">
                                        <svg class="w-8 h-4 transition-colors duration-200"
                                            :class="active === <?php echo $i; ?> ? 'text-primary' : 'text-primary/70 md:text-primary'"
                                            viewBox="0 0 32 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="0" y1="8" x2="26" y2="8" stroke="currentColor" stroke-width="1.2" />
                                            <path d="M22 3l6 5-6 5" stroke="currentColor" stroke-width="1.2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </button>

                                <!-- Answer -->
                                <div x-show="active === <?php echo $i; ?>"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 -translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 -translate-y-2" class="pb-5 pr-12">
                                    <div
                                        class="font-body text-sm text-dark/60 leading-relaxed [&_a]:text-primary [&_a]:underline [&_a:hover]:text-dark [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:mb-2 [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:mb-2 [&_b]:font-bold [&_strong]:font-bold [&_p]:mb-2 last:[&_p]:mb-0">
                                        <?php echo wp_kses_post($faq['response']); ?>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>
        </div>
    </section>


</main>

<style>
    /* ── Viewport ── */
    .journey-gallery-embla {
        overflow: hidden;
        /* Fade en los bordes para efecto cinta profesional */
        /* -webkit-mask-image: linear-gradient(to right,
                transparent 0%,
                black 8%,
                black 92%,
                transparent 100%);
        mask-image: linear-gradient(to right,
                transparent 0%,
                black 8%,
                black 92%,
                transparent 100%); */
    }

    /* ── Container ── */
    .journey-gallery-embla .embla__container {
        display: flex;
        flex-wrap: nowrap;
        /* Sin gap — pegados */
    }

    /* ── Slides: ancho reducido ~60% de 574px (aspect 574×283) ── */
    .journey-gallery-embla .embla__slide {
        flex: 0 0 auto;
        width: min(450px, 76vw);
        min-width: 0;
        box-sizing: border-box;
    }

    .journey-gallery-embla .embla__slide img {
        aspect-ratio: 574 / 283;
        object-fit: cover;
        width: 100%;
        display: block;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        opacity: 0;
        position: absolute;
        right: 0;
        width: 2rem;
        height: 100%;
        cursor: pointer;
    }

    .contenido-journey p {
        margin-bottom: 20px;
    }
</style>

<?php get_footer(); ?>