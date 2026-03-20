<?php

/**
 * Template Name: Home Page (Static Layout)
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
            <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_banner_home.webp"
                alt="Machu Picchu" class="w-full h-full object-cover"> -->
            <video src="<?php echo get_template_directory_uri(); ?>/assets/videos/intense_video_home_hero.mp4" autoplay
                muted loop class="w-full h-full object-cover"></video>
            <div class="absolute inset-0 bg-neutral-black/40"></div>
        </div>

        <div class="container-site relative z-10 text-center px-4">
            <h1 class="font-heading text-white text-4xl md:text-[64px] leading-tight md:leading-[72px] mb-6"
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
                <?php get_template_part('template-parts/components/btn-outline', null, [
                    'text' => 'Design my trip',
                    'href' => '#design',
                    'color' => 'light'
                ]); ?>
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
    <section class="py-10 bg-cream">
        <div class="container-site text-left">
            <h2 class="font-heading text-4xl md:text-5xl text-dark mb-12" data-aos="fade-up" data-aos-delay="100">
                Signature Destinations</h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 auto-rows-[250px]">
                <!-- Item 1 (Span 2 cols, 2 rows) -->
                <div class="md:col-span-2 md:row-span-2 relative group overflow-hidden rounded-lg cursor-pointer"
                    data-aos="fade-up" data-aos-delay="200">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_01.webp" alt="Cusco"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-left">
                        <h3 class="font-heading text-white text-3xl font-medium mb-2">Cusco</h3>
                        <?php get_template_part('template-parts/components/btn-outline', null, [
                            'text' => 'Explore destination',
                            'href' => '#',
                            'color' => 'light',
                        ]); ?>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="md:col-span-2 relative group overflow-hidden rounded-lg cursor-pointer" data-aos="fade-up"
                    data-aos-delay="300">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_02.webp"
                        alt="Machu Picchu"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-left">
                        <h3 class="font-heading text-white text-2xl font-medium mb-2">Machu Picchu</h3>
                        <?php get_template_part('template-parts/components/btn-outline', null, [
                            'text' => 'Explore destination',
                            'href' => '#',
                            'color' => 'light',
                        ]); ?>
                    </div>
                </div>
                <!-- Item 3 -->
                <div class="relative group overflow-hidden rounded-lg cursor-pointer" data-aos="fade-up"
                    data-aos-delay="400">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_03.webp"
                        alt="Sacred Valley"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-left">
                        <h3 class="font-heading text-white text-xl font-medium mb-2">Sacred Valley</h3>
                        <?php get_template_part('template-parts/components/btn-outline', null, [
                            'text' => 'Explore destination',
                            'href' => '#',
                            'color' => 'light',
                        ]); ?>
                    </div>
                </div>
                <!-- Item 4 -->
                <div class="relative group overflow-hidden rounded-lg cursor-pointer" data-aos="fade-up"
                    data-aos-delay="500">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_04.webp" alt="Arequipa"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-left">
                        <h3 class="font-heading text-white text-xl font-medium mb-2">Arequipa</h3>
                        <?php get_template_part('template-parts/components/btn-outline', null, [
                            'text' => 'Explore destination',
                            'href' => '#',
                            'color' => 'light',
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- C. Authentic Itineraries -->
    <section id="itineraries" class="py-20 bg-cream">
        <div class="container-site text-center">
            <div class="flex flex-col items-center gap-4">
                <svg width="65" height="41" viewBox="0 0 65 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M31.9972 27.997L18.8042 20.418L31.9972 12.8391L45.1902 20.418L31.9972 27.997Z"
                        stroke="#7B4424" stroke-width="1.12281" />
                    <path d="M31.9973 22.3832L28.3481 20.4183L31.9973 18.4534L35.6464 20.4183L31.9973 22.3832Z"
                        fill="#B76739" stroke="#B76739" stroke-width="1.12281" />
                    <path d="M9.26025 0.488281L31.9971 13.4006L54.734 0.488281" stroke="#7B4424"
                        stroke-width="1.12281" />
                    <path d="M54.7339 40.3481L31.997 27.4359L9.26017 40.3481" stroke="#7B4424" stroke-width="1.12281" />
                    <path d="M9.26025 0.488281L31.9971 13.4006L54.734 0.488281" stroke="#7B4424"
                        stroke-width="1.12281" />
                    <path d="M54.7339 40.3481L31.997 27.4359L9.26017 40.3481" stroke="#7B4424" stroke-width="1.12281" />
                    <path d="M23.2954 3.29541L32.2779 8.90945L41.2603 3.29541" stroke="#B76739"
                        stroke-width="1.12281" />
                    <path d="M41.2603 37.541L32.2778 31.927L23.2953 37.541" stroke="#B76739" stroke-width="1.12281" />
                    <path d="M64.2779 8.90942L44.0674 20.4182L64.2779 31.927" stroke="#B76739" stroke-width="1.12281" />
                    <path d="M0.277743 8.90942L20.4883 20.4182L0.277743 31.927" stroke="#B76739"
                        stroke-width="1.12281" />
                </svg>
                <h2 class="font-heading text-4xl md:text-5xl text-dark mb-12" data-aos="fade-up" data-aos-delay="100">
                    Authentic Itineraries</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 text-left">
                    <?php
                    $itineraries = [
                        [
                            'title' => '14D Grand discovery',
                            'days' => '14 Days',
                            'price' => 'USD 2,059',
                            'destinations' => 'Lima • Paracas • Nazca • Arequipa • Colca Canyon • Lake Titicaca • Sacred Valley • Machu Picchu & Cusco',
                            'img' => get_template_directory_uri() . '/assets/images/intense_02.webp',
                            'badges' => ['New', 'Top seller']
                        ],
                        [
                            'title' => 'Inca Trail Discovery',
                            'days' => '5 Days',
                            'price' => 'USD 899',
                            'destinations' => 'Cusco • Wayllabamba • Pacaymayo • Wiñay Wayna • Machu Picchu',
                            'img' => get_template_directory_uri() . '/assets/images/intense_03.webp',
                            'badges' => ['Top seller']
                        ],
                        [
                            'title' => 'Amazon & Andes',
                            'days' => '12 Days',
                            'price' => 'USD 2,499',
                            'destinations' => 'Lima • Puerto Maldonado • Amazon Basin • Cusco • Sacred Valley • Machu Picchu',
                            'img' => get_template_directory_uri() . '/assets/images/intense_04.webp',
                            'badges' => []
                        ],
                    ];
                    foreach ($itineraries as $index => $itin):
                    ?>
                        <?php get_template_part('template-parts/components/card-itinerary', null, [
                            'image' => $itin['img'],
                            'title' => $itin['title'],
                            'price' => $itin['price'],
                            'duration' => $itin['days'],
                            'destinations' => $itin['destinations'],
                            'link' => '#',
                            'link_text' => 'Explore itineraries',
                            'aos_delay' => ($index * 100) + 200,
                            'badges' => $itin['badges'],
                        ]); ?>
                    <?php endforeach; ?>
                </div>
            </div>
    </section>

    <!-- D. Venture Beyond (Why Choose Us) -->
    <section class="py-20 bg-sage text-white">
        <div class="container-site">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <div class="flex items-center gap-4 mb-12">
                        <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.707031 12.0156L38.3976 49.7062" stroke="white" stroke-width="2" />
                            <path d="M12.0146 0.70752L49.7053 38.3981" stroke="white" stroke-width="2" />
                            <path d="M0.707031 12.0156L38.3976 49.7062" stroke="white" stroke-width="2" />
                            <path d="M12.0146 0.70752L49.7053 38.3981" stroke="white" stroke-width="2" />
                            <path d="M12.0161 49.7056L49.7067 12.015" stroke="white" stroke-width="2" />
                            <path d="M0.707031 38.3979L38.3976 0.707343" stroke="white" stroke-width="2" />
                            <path d="M12.0161 49.7056L49.7067 12.015" stroke="white" stroke-width="2" />
                            <path d="M0.707031 38.3979L38.3976 0.707343" stroke="white" stroke-width="2" />
                            <rect x="23.3062" y="23.8213" width="3.76914" height="3.76914" fill="white" />
                        </svg>

                        <h2 class="font-heading text-4xl md:text-5xl font-medium">What Moves Us</h2>
                    </div>

                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_01.webp"
                        alt="Local Culture" class="w-full h-auto rounded-lg shadow-xl object-cover aspect-[4/3]">
                </div>
                <div data-aos="fade-left">
                    <!-- <span class="font-body text-sm italic text-cream/80 uppercase tracking-wide mb-2 block">Why Choose Us</span> -->
                    <div class="mb-12">
                        <h2 class="font-heading text-4xl md:text-5xl font-medium mb-6">Travel with Purpose</h2>

                        <div class="space-y-6">
                            <p class="font-body text-cream/80 font-light">Deeply knowledgeable locals who are passionate
                                about sharing their heritage and stories.</p>
                        </div>
                    </div>
                    <div class="mb-12">
                        <h2 class="font-heading text-4xl md:text-5xl font-medium mb-6">Venture Beyond</h2>

                        <div class="space-y-6">
                            <p class="font-body text-cream/80 font-light">Deeply knowledgeable locals who are passionate
                                about sharing their heritage and stories.</p>
                        </div>
                    </div>
                    <div class="mb-12">
                        <h2 class="font-heading text-4xl md:text-5xl font-medium mb-6">Venture Beyond</h2>

                        <div class="space-y-6">
                            <p class="font-body text-cream/80 font-light">Deeply knowledgeable locals who are passionate
                                about sharing their heritage and stories.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- E. Gallery (Need again to scroll?) -->
    <section class="py-20 bg-cream">
        <div
            class="flex flex-col md:flex-row items-center justify-center text-center gap-4 md:gap-12 mb-10 overflow-hidden">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_decoration_title.webp" alt=""
                class="mx-auto md:mb-10">
            <h2 class="font-heading text-3xl md:text-5xl text-dark md:mb-10 min-w-fit" data-aos="fade-up">Need a journey
                spark?</h2>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_decoration_title.webp" alt=""
                class="mx-auto mb-10 hidden md:block">
        </div>
        <div class="container-site text-center">

            <?php
            $images = [
                get_template_directory_uri() . '/assets/images/intense_gallery_01.webp', // 0
                get_template_directory_uri() . '/assets/images/intense_gallery_02.webp', // 1
                get_template_directory_uri() . '/assets/images/intense_gallery_03.webp', // 2
                get_template_directory_uri() . '/assets/images/intense_gallery_04.webp', // 3
                get_template_directory_uri() . '/assets/images/intense_gallery_05.webp', // 4
                get_template_directory_uri() . '/assets/images/intense_gallery_06.webp', // 5
                get_template_directory_uri() . '/assets/images/intense_gallery_07.webp', // 6
                get_template_directory_uri() . '/assets/images/intense_gallery_08.webp', // 7
            ];
            $gallery_cols = [
                // Col 1
                [['img' => $images[0], 'h' => '55%'], ['img' => $images[1], 'h' => '45%']],
                // Col 2
                [['img' => $images[2], 'h' => '45%'], ['img' => $images[3], 'h' => '55%']],
                // Col 3
                [['img' => $images[4], 'h' => '60%'], ['img' => $images[5], 'h' => '40%']],
                // Col 4
                [['img' => $images[6], 'h' => '45%'], ['img' => $images[7], 'h' => '55%']],
            ];
            ?>
            <!-- Use a responsive explicit height so percentage flex items work perfectly with gap -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 h-[1100px] md:h-[500px] lg:h-[600px] xl:h-[700px] w-full">
                <?php foreach ($gallery_cols as $colIndex => $col): ?>
                    <div class="flex flex-col gap-4 h-full w-full">
                        <?php foreach ($col as $itemIndex => $item): ?>
                            <!-- calc(h - 0.5rem) perfectly adjusts for the gap-4 (1rem / 2) between the 2 items -->
                            <a href="#" class="block w-full relative group overflow-hidden rounded-sm"
                                style="height: calc(<?php echo $item['h']; ?> - 0.5rem);" data-aos="fade-up"
                                data-aos-delay="<?php echo ($colIndex * 150) + ($itemIndex * 100); ?>">
                                <img src="<?php echo $item['img']; ?>" alt="Gallery Image"
                                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
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
                <a href="#"
                    class="font-body text-sm text-dark uppercase tracking-wide hover:text-hover transition-colors font-medium flex items-center gap-2">See
                    All <svg class="w-12 h-6 text-dark transition-transform duration-300 group-hover:translate-x-2"
                        viewBox="0 0 40 10" fill="none" stroke="currentColor" stroke-width="1.5">
                        <line x1="0" y1="5" x2="38" y2="5"></line>
                        <polyline points="34 1 39 5 34 9"></polyline>
                    </svg></a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mt-4">
                <?php
                $posts = [
                    [
                        'title' => 'Celebration of Love: A Magical Proposal in the Land of the Incas.',
                        'read_time' => '5-minute read',
                        'date' => '20 Dec 2023',
                        'img' => get_template_directory_uri() . '/assets/images/intense_journal_01.webp'
                    ],
                    [
                        'title' => 'A Culinary Guide to the Streets of Cusco',
                        'read_time' => '6-minute read',
                        'date' => '10 Feb 2024',
                        'img' => get_template_directory_uri() . '/assets/images/intense_journal_02.webp'
                    ],
                    [
                        'title' => 'Top 5 Lesser-Known Ruins in the Sacred Valley',
                        'read_time' => '4-minute read',
                        'date' => '05 Jan 2024',
                        'img' => get_template_directory_uri() . '/assets/images/intense_journal_03.webp'
                    ],
                ];
                foreach ($posts as $index => $post):
                ?>
                    <?php get_template_part('template-parts/components/card-story', null, [
                        'image' => $post['img'],
                        'image_alt' => $post['title'],
                        'title' => $post['title'],
                        'read_time' => $post['read_time'],
                        'date' => $post['date'],
                        'link' => '#',
                        'aos_delay' => $index * 100,
                    ]); ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- I. Newsletter Pre-Footer -->
    <section class="py-20">
        <div class="container-site">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <!-- Image Booklet -->
                <div class="w-full md:w-1/2" data-aos="fade-right">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_peru_travel.webp"
                        alt="Travel Booklet" class="w-full h-auto">
                </div>
                <!-- Form -->
                <div class="w-full md:w-1/2 text-center md:text-left" data-aos="fade-left">
                    <h3 class="font-heading text-3xl font-semibold text-dark mb-4">Intense Peru Travel Guides</h3>
                    <p class="font-body text-dark text-lg mb-8 font-light">Select a brochure and get one step closer to
                        your dream trip to Peru: exclusive, authentic and personalized.</p>

                    <?php get_template_part('template-parts/components/btn-outline', null, [
                        'text' => 'Choose a Brochure',
                        'href' => '#',
                        'color' => 'dark',
                        'class_extra' => 'px-10 py-4 text-base'
                    ]); ?>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>