<?php
/**
 * Template Name: Single Journey Page
 * Template Post Type: journey
 *
 * @package Intense_Theme
 */

get_header();

// Mock data for the layout
$journey_title = "4D Deep Mangora Beach";
$journey_subtitle = "From Machu Picchu to the Amazon. Each intense journey is designed to be a unique experience.";
$journey_price = "USD 1,499";

// Mock Gallery
$gallery_images = [
    get_template_directory_uri() . '/assets/images/intense_journey_gallery_slider_01.webp',
    get_template_directory_uri() . '/assets/images/intense_journey_gallery_slider_02.webp',
    get_template_directory_uri() . '/assets/images/intense_journey_gallery_slider_03.webp',
    get_template_directory_uri() . '/assets/images/intense_journey_gallery_slider_02.webp',
];
?>

<main id="primary" class="site-main">

    <!-- 1. Hero Section -->
    <section class="relative h-[60vh] md:h-[80vh] flex items-end justify-start pb-20">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="Journey Hero"
                class="w-full h-full object-cover">
            <!-- Add a gradient overlay for text readability -->
            <div class="absolute inset-0 bg-gradient-to-t from-dark/90 via-dark/40 to-transparent"></div>
        </div>

        <!-- Content -->
        <div class="container-site relative z-10 w-full" data-aos="fade-up">
            <div class="max-w-4xl text-white">
                <h1 class="font-heading text-4xl md:text-6xl mb-4 leading-tight">
                    <?php echo esc_html($journey_title); ?>
                </h1>
                <p class="font-body text-lg md:text-xl font-light mb-8 max-w-2xl">
                    <?php echo esc_html($journey_subtitle); ?>
                </p>
                <?php get_template_part('template-parts/components/btn-outline', null, [
                    'text' => 'Talk to us',
                    'href' => '#booking-form',
                    'color' => 'light',
                    'class_extra' => 'px-10 py-3 text-sm'
                ]); ?>
            </div>
        </div>
    </section>

    <!-- 2. Overview Section -->
    <section class="py-24 overflow-hidden">
        <div class="container-site max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-center">

                <!-- Left: Description -->
                <div>
                    <!-- Eyebrow: ruta del viaje -->
                    <!-- <div data-aos="fade-down" data-aos-duration="600" data-aos-delay="0"
                        class="flex items-center gap-3 mb-6">
                        <div class="h-px w-12 bg-[#bd7a4e]"></div>
                        <span class="font-body text-xs uppercase tracking-[0.3em] text-[#bd7a4e] font-medium">Mancora ·
                            Perú</span>
                    </div> -->

                    <h2 data-aos="fade-up" data-aos-duration="800" data-aos-delay="100"
                        class="font-heading text-4xl md:text-5xl text-dark mb-6 leading-tight">
                        Discover Mancora's Flavors & Coastal Bliss
                    </h2>

                    <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="200"
                        class="font-body text-neutral-black text-lg leading-relaxed font-light space-y-4 mb-10">
                        <p>Stay at Arennas de Mancora and indulge in four days of sun-soaked relaxation, fresh seafood,
                            craft cocktails, and the vibrant culinary traditions that make northern Peru a foodie
                            paradise.</p>
                    </div>

                    <!-- Stats row -->
                    <div data-aos="fade-right" data-aos-duration="700" data-aos-delay="350"
                        class="flex items-center gap-8 pt-8 border-t border-neutral-gray/20">
                        <div>
                            <span class="block font-body text-3xl md:text-4xl text-dark font-light">USD $379</span>
                            <span
                                class="block font-body text-[10px] text-neutral-gray uppercase tracking-widest mt-1">per
                                person</span>
                        </div>
                        <div class="w-px h-10 bg-neutral-gray/30"></div>
                        <div>
                            <span class="block font-body text-3xl md:text-4xl text-dark font-light">4</span>
                            <span
                                class="block font-body text-[10px] text-neutral-gray uppercase tracking-widest mt-1">days
                                / nights</span>
                        </div>
                        <div class="w-px h-10 bg-neutral-gray/30"></div>
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

                <!-- Right: Highlights con stagger de olas -->
                <div class="space-y-4">
                    <!-- Item 1 -->
                    <div data-aos="fade-left" data-aos-duration="700" data-aos-delay="100"
                        class="flex items-start gap-4 md:gap-6 p-5 transition-all duration-500">
                        <div class="text-primary">
                            <svg viewBox="0 0 67 67" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="w-[40px] md:w-[67px] h-auto">

                                <path d="M0.947266 15.9485L50.9461 65.9466" stroke="#5D7F6E" stroke-width="2.68001" />
                                <path d="M15.9492 0.949219L65.948 50.9473" stroke="#5D7F6E" stroke-width="2.68001" />
                                <path d="M0.947266 15.9485L50.9461 65.9466" stroke="#38464C" stroke-width="2.68001" />
                                <path d="M15.9492 0.949219L65.948 50.9473" stroke="#DC973C" stroke-width="2.68001" />
                                <path d="M15.9473 65.9446L65.9461 15.9465" stroke="#5D7F6E" stroke-width="2.68001" />
                                <path d="M0.947266 50.9456L50.9461 0.94748" stroke="#5D7F6E" stroke-width="2.68001" />
                                <path d="M15.9473 65.9446L65.9461 15.9465" stroke="#5D7F6E" stroke-width="2.68001" />
                                <path d="M0.947266 50.9456L50.9461 0.94748" stroke="#B76739" stroke-width="2.68001" />

                            </svg>
                        </div>
                        <div>
                            <h3 class="font-body text-base text-dark mb-2 transition-colors duration-300">
                                Beachfront Stay with Gourmet Touches</h3>
                            <p class="font-body text-sm font-light text-dark leading-relaxed">Unwind at Arennas
                                de Mancora, where elegant coastal design meets exceptional cuisine crafted with local
                                ingredients.</p>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div data-aos="fade-left" data-aos-duration="700" data-aos-delay="250"
                        class="flex items-start gap-4 md:gap-6 p-5 transition-all duration-500">
                        <div class="text-primary">
                            <svg viewBox="0 0 67 67" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="w-[40px] md:w-[67px] h-auto">

                                <path d="M0.947266 15.9485L50.9461 65.9466" stroke="#5D7F6E" stroke-width="2.68001" />
                                <path d="M15.9492 0.949219L65.948 50.9473" stroke="#5D7F6E" stroke-width="2.68001" />
                                <path d="M0.947266 15.9485L50.9461 65.9466" stroke="#38464C" stroke-width="2.68001" />
                                <path d="M15.9492 0.949219L65.948 50.9473" stroke="#DC973C" stroke-width="2.68001" />
                                <path d="M15.9473 65.9446L65.9461 15.9465" stroke="#5D7F6E" stroke-width="2.68001" />
                                <path d="M0.947266 50.9456L50.9461 0.94748" stroke="#5D7F6E" stroke-width="2.68001" />
                                <path d="M15.9473 65.9446L65.9461 15.9465" stroke="#5D7F6E" stroke-width="2.68001" />
                                <path d="M0.947266 50.9456L50.9461 0.94748" stroke="#B76739" stroke-width="2.68001" />

                            </svg>
                        </div>
                        <div>
                            <h3 class="font-body text-base text-dark mb-2 transition-colors duration-300">
                                Signature Northern Peruvian Cuisine</h3>
                            <p class="font-body text-sm font-light text-dark leading-relaxed">Enjoy fresh
                                ceviche, tiraditos, grilled seafood, and innovative fusion dishes—paired with refreshing
                                pisco cocktails and ocean views.</p>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div data-aos="fade-left" data-aos-duration="700" data-aos-delay="400"
                        class="flex items-start gap-4 md:gap-6 p-5 transition-all duration-500">
                        <div class="text-primary">
                            <svg viewBox="0 0 67 67" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="w-[40px] md:w-[67px] h-auto">

                                <path d="M0.947266 15.9485L50.9461 65.9466" stroke="#5D7F6E" stroke-width="2.68001" />
                                <path d="M15.9492 0.949219L65.948 50.9473" stroke="#5D7F6E" stroke-width="2.68001" />
                                <path d="M0.947266 15.9485L50.9461 65.9466" stroke="#38464C" stroke-width="2.68001" />
                                <path d="M15.9492 0.949219L65.948 50.9473" stroke="#DC973C" stroke-width="2.68001" />
                                <path d="M15.9473 65.9446L65.9461 15.9465" stroke="#5D7F6E" stroke-width="2.68001" />
                                <path d="M0.947266 50.9456L50.9461 0.94748" stroke="#5D7F6E" stroke-width="2.68001" />
                                <path d="M15.9473 65.9446L65.9461 15.9465" stroke="#5D7F6E" stroke-width="2.68001" />
                                <path d="M0.947266 50.9456L50.9461 0.94748" stroke="#B76739" stroke-width="2.68001" />

                            </svg>
                        </div>
                        <div>
                            <h3 class="font-body text-base text-dark mb-2 transition-colors duration-300">
                                Seasonal Whale-Watching Encounters</h3>
                            <p class="font-body text-sm font-light text-dark leading-relaxed">From July to
                                October, witness majestic humpback whales migrating along the warm northern coast—an
                                unforgettable experience available just minutes from Mancora's shores.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 3. Gallery (Embla Carousel) -->
    <section class="pb-20" data-aos="fade-in">
        <div class="embla-gallery w-full">
            <div class="embla overflow-hidden cursor-grab active:cursor-grabbing">
                <div class="embla__container flex">
                    <?php foreach ($gallery_images as $img): ?>
                        <div class="embla__slide flex-[0_0_80%] md:flex-[0_0_40%] lg:flex-[0_0_33.333%] min-w-0">
                            <img src="<?php echo esc_url($img); ?>" alt="Gallery Image"
                                class="w-full h-[300px] object-cover">
                            <p class="font-body text-base text-dark mb-2 transition-colors duration-300">The
                                Sillar Route</p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Main Body: Itinerary Layout -->
    <section class="py-20 bg-cream">
        <div class="container-site-wide mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">

                <!-- Left: Sticky Navigation -->
                <aside class="lg:col-span-3 lg:sticky lg:top-32" data-aos="fade-right">
                    <nav class="mb-8 font-body text-dark text-sm md:text-base">
                        <ul>
                            <li class="border-b border-neutral-gray/30">
                                <a href="#itinerary"
                                    class="flex items-center gap-4 py-4 hover:text-[#bd7a4e] transition-colors font-semibold text-dark">
                                    <svg class="w-5 h-5 shrink-0 text-neutral-gray" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                                    </svg>
                                    Itinerary
                                </a>
                            </li>
                            <li class="border-b border-neutral-gray/30">
                                <a href="#included"
                                    class="flex items-center gap-4 py-4 hover:text-[#bd7a4e] transition-colors">
                                    <svg class="w-5 h-5 shrink-0 text-neutral-gray" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Included / no included
                                </a>
                            </li>
                            <li class="border-b border-neutral-gray/30">
                                <a href="#price"
                                    class="flex items-center gap-4 py-4 hover:text-[#bd7a4e] transition-colors">
                                    <svg class="w-5 h-5 shrink-0 text-neutral-gray" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 8V7m0 1v8m0 0v1m0-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Price
                                </a>
                            </li>
                            <li class="border-b border-neutral-gray/30">
                                <a href="#hotels"
                                    class="flex items-center gap-4 py-4 hover:text-[#bd7a4e] transition-colors">
                                    <svg class="w-5 h-5 shrink-0 text-neutral-gray" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1">
                                        </path>
                                    </svg>
                                    Hotels
                                </a>
                            </li>
                            <li class="border-b border-neutral-gray/30">
                                <a href="#activities"
                                    class="flex items-center gap-4 py-4 hover:text-[#bd7a4e] transition-colors">
                                    <svg class="w-5 h-5 shrink-0 text-neutral-gray" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1">
                                        </path>
                                    </svg>
                                    Other Activities
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <?php get_template_part('template-parts/components/btn-primary', null, [
                        'text' => __('Free Quote Request', 'intense-nerd-theme'),
                        'href' => '#booking-form',
                        'class_extra' => 'w-full',
                    ]); ?>

                    <div class="text-center mt-6 text-[12px] font-body">
                        <p class="mb-1">Do you need help? contact us?</p>
                        <p class="font-medium text-dark mb-3">+51 994 008 833</p>
                        <div class="flex items-center justify-center gap-3">
                            <a href="#" aria-label="WhatsApp"
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
                            <a href="#" aria-label="Email" class="hover:text-dark transition-colors">
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
                <div class="lg:col-span-9">

                    <!-- Itinerary Accordion -->
                    <div id="itinerary" class="scroll-mt-32 mb-20" data-aos="fade-up">
                        <div class="space-y-6">
                            <?php
                            // Mock Itinerary Days matching the design
                            for ($i = 1; $i <= 4; $i++):
                                $open = ($i === 1) ? 'true' : 'false';
                                $day_title = ($i === 1) ? 'Arrival in Mancora' : 'Activities of Your Choice';
                                ?>
                                <div x-data="{ expanded: <?php echo $open; ?> }"
                                    class="border-b border-neutral-gray/20 pb-6 mb-6">
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

                                            <h4
                                                class="font-heading text-2xl md:text-3xl text-dark group-hover:text-[#bd7a4e] transition-colors">
                                                Day <?php echo $i; ?>: <?php echo $day_title; ?></h4>
                                        </div>
                                        <svg class="w-5 h-5 transform transition-transform duration-300 shrink-0 text-neutral-gray group-hover:text-dark"
                                            :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>

                                    <div x-show="expanded" x-collapse x-cloak>
                                        <div class="pt-8 pl-12 pr-4"> <!-- Indented content -->
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_gallery_0<?php echo $i; ?>.webp"
                                                alt="Day Image"
                                                class="w-full h-auto aspect-[21/9] object-cover rounded-lg mb-8 shadow-sm">

                                            <div class="flex items-center gap-3 mb-6">
                                                <svg class="w-6 h-6 text-dark shrink-0" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>
                                                <h5 class="font-body text-xl text-dark font-medium">Welcome to Mancora!</h5>
                                            </div>

                                            <p
                                                class="font-body text-neutral-black text-[15px] font-light leading-relaxed mb-6">
                                                Upon arrival in Talara airport , Upon arrival, private transfer to Arennas
                                                Mancora Hotel. Spend the day at leisure settling in and enjoying the
                                                pristine beach surroundings.
                                            </p>
                                            <p
                                                class="font-body text-neutral-black text-[15px] font-light leading-relaxed mb-10">
                                                Evening at leisure
                                            </p>

                                            <div class="flex items-center gap-4 mb-4">
                                                <div class="flex items-center gap-2 border-r border-neutral-gray/30 pr-4">
                                                    <svg class="w-6 h-6 text-dark" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                                        </path>
                                                    </svg>
                                                    <svg class="w-5 h-5 text-dark" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2v10z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <h6 class="font-heading text-xl md:text-2xl text-dark">Hotel & Meals</h6>
                                            </div>
                                            <div class="font-body text-neutral-black text-sm font-light space-y-2">
                                                <p><strong class="font-semibold text-dark">Overnight:</strong> Arennas
                                                    Mancora
                                                    Hotel</p>
                                                <p><strong class="font-semibold text-dark">Meals Included:</strong> None</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <!-- Included / Not Included -->
                    <div id="included" class="scroll-mt-32 mb-24" data-aos="fade-up">
                        <div class="mb-12 text-center">
                            <h3 class="font-heading text-3xl md:text-4xl text-dark">Included / Not Included</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-20">
                            <!-- Included -->
                            <div>
                                <h4 class="font-heading italic font-semibold text-dark text-xl mb-6">Included</h4>
                                <ul class="space-y-3 font-body text-neutral-black font-light text-lg">
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
                                            Lodging accommodations according to itinerary.
                                        </span>
                                    </li>
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
                                            Meals according to itinerary.
                                        </span>
                                    </li>
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
                                            Airport transfers.
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <!-- Not Included -->
                            <div>
                                <h4 class="font-heading italic font-semibold text-dark text-xl mb-6">Not Included</h4>
                                <ul class="space-y-3 font-body text-neutral-black font-light text-lg">
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
                                            International and domestic flights, and airport taxes.
                                        </span>
                                    </li>
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
                                            International and domestic flights, and airport taxes.
                                        </span>
                                    </li>
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
                                            International and domestic flights, and airport taxes.
                                        </span>
                                    </li>
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
                                            Drinks and tips.
                                        </span>
                                    </li>
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
                                            Transfers to/from Lima airport.
                                        </span>
                                    </li>
                                    <li class="flex gap-3 text-base md:text-lg leading-relaxed">
                                        <span class="mt-[0.3em] shrink-0">
                                            <svg viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg"
                                                class="w-6 h-auto">
                                                <rect y="6.70703" width="3" height="3" fill="#C45454" />
                                                <rect x="19" y="6.70703" width="3" height="3" fill="#C45454" />
                                                <path d="M4 14.707L18 0.707031" stroke="#C25454" stroke-width="2" />
                                                <path d="M4 0.707031L18 14.707" stroke="#C25454" stroke-width="2" />
                                            </svg>
                                        </span>
                                        <span class="min-w-0">
                                            Processing and wire transfer fees.
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Options -->
                    <div id="price" class="scroll-mt-32 mb-32" data-aos="fade-up">
                        <div class="text-center mb-10">
                            <h3 class="font-heading text-3xl md:text-4xl text-dark mb-4">Prices per Person</h3>
                            <p class="font-body text-xs text-[#626262] italic max-w-md mx-auto leading-relaxed">Based
                                on double occupancy, private tours, and selected hotels.<br>Rates may vary according to
                                season and partner availability.</p>
                        </div>
                        <div class="max-w-2xl mx-auto space-y-14">
                            <!-- Low Season -->
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b-2 border-dark text-dark">
                                        <th class="py-3 pr-6 font-normal">LOW SEASON</th>
                                        <th class="py-3 text-right font-normal">Price Per Person</th>
                                    </tr>
                                </thead>
                                <tbody class="font-body text-[15px] font-light text-[#626262]">
                                    <tr class="border-b border-neutral-gray/30">
                                        <td class="py-5 pr-6">Ocean Front Room (double occupancy)</td>
                                        <td class="py-5 text-right">USD 397</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- High Season -->
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b-2 border-dark text-dark">
                                        <th class="py-3 pr-6 font-normal">HIGH SEASON</th>
                                        <th class="py-3 text-right font-normal">Price Per Person</th>
                                    </tr>
                                </thead>
                                <tbody class="font-body text-[15px] font-light text-[#626262]">
                                    <tr class="border-b border-neutral-gray/30">
                                        <td class="py-5 pr-6">Ocean Front Room (double occupancy)</td>
                                        <td class="py-5 text-right">USD 505</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Hotels -->
                    <div id="hotels" class="scroll-mt-32 mb-20" data-aos="fade-up">
                        <div class="text-center mb-14">
                            <h3 class="font-heading text-4xl md:text-5xl text-dark">Hotels</h3>
                        </div>

                        <!-- Destination Group: Máncora -->
                        <div class="mb-10">
                            <h4
                                class="font-body font-semibold text-dark text-lg border-b-2 border-dark inline-block pb-0.5 mb-10">
                                Máncora</h4>

                            <?php
                            $icon_beach = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>';
                            $icon_spa = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>';
                            $icon_rest = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>';
                            $icon_bfast = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3v.01M12 3v.01M15 3v.01M21 21v-5a2 2 0 00-2-2H5a2 2 0 00-2 2v5h18z"></path></svg>';
                            $icon_pool = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>';
                            $icon_wifi = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>';
                            $icon_fitness = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>';

                            get_template_part('template-parts/components/card-hotel', null, [
                                'image' => get_template_directory_uri() . '/assets/images/intense_gallery_01.webp',
                                'title' => 'Kichic',
                                'stars' => 4,
                                'type' => 'Boutique',
                                'expedia' => '9.6',
                                'booking' => '9.7',
                                'location' => 'Máncora, Piura',
                                'description' => 'An adult-only boutique hotel in Las Pocitas, blending nature-inspired design with a peaceful seaside setting—ideal for relaxation, yoga, and fine dining by the Pacific.',
                                'video_link' => '#',
                                'amenities' => [
                                    ['icon' => $icon_beach, 'text' => 'Beachfront Location'],
                                    ['icon' => $icon_spa, 'text' => 'Spa services'],
                                    ['icon' => $icon_rest, 'text' => 'Restaurant bar'],
                                    ['icon' => $icon_bfast, 'text' => 'Free Breakfast'],
                                    ['icon' => $icon_pool, 'text' => 'Outdoor pool'],
                                    ['icon' => $icon_wifi, 'text' => 'Free WiFi'],
                                ]
                            ]);

                            get_template_part('template-parts/components/card-hotel', null, [
                                'image' => get_template_directory_uri() . '/assets/images/intense_gallery_02.webp',
                                'title' => 'Hotel Arennas Mancora',
                                'stars' => 5,
                                'type' => 'Resort',
                                'expedia' => '9.8',
                                'booking' => '9.4',
                                'location' => 'Máncora, Piura',
                                'description' => 'Elegant seaside hotel offering panoramic ocean views and exceptional Peruvian cuisine. Immersed in the cloud forest, blending luxury with the natural beauty of northern Peru.',
                                'video_link' => '#',
                                'amenities' => [
                                    ['icon' => $icon_beach, 'text' => 'Beachfront Location'],
                                    ['icon' => $icon_spa, 'text' => 'Spa services'],
                                    ['icon' => $icon_rest, 'text' => 'Restaurant bar'],
                                    ['icon' => $icon_bfast, 'text' => 'Free Breakfast'],
                                    ['icon' => $icon_pool, 'text' => 'Outdoor pool'],
                                    ['icon' => $icon_fitness, 'text' => 'Fitness center'],
                                ]
                            ]);
                            ?>
                        </div>
                    </div>

                    <!-- Other Activities -->
                    <div id="activities" class="scroll-mt-32 mb-20" data-aos="fade-up">
                        <div
                            class="flex flex-col md:flex-row items-center justify-center text-center gap-4 md:gap-6 mb-10 overflow-hidden">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_decoration_title.webp"
                                alt="" class="mx-auto md:mb-10">
                            <h2 class="font-heading text-3xl md:text-5xl text-dark md:mb-10 min-w-fit"
                                data-aos="fade-up">Other Activities</h2>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_decoration_title.webp"
                                alt="" class="mx-auto mb-10 hidden md:block">
                        </div>

                        <!-- Slider Wrapper -->
                        <div class="embla-activities relative">
                            <!-- Section Title & Navigation -->
                            <div class="flex items-center justify-between mb-8">
                                <h4 class="font-body font-semibold text-dark text-lg border-b-2 border-dark pb-0.5">Lima
                                </h4>

                                <div class="flex gap-6">
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

                            <!-- Viewport Embla -->
                            <div class="embla overflow-hidden cursor-grab active:cursor-grabbing pb-8">
                                <div class="embla__container flex flex-row -ml-6 md:-ml-8">
                                    <!-- Slide 1 -->
                                    <div
                                        class="embla__slide flex-[0_0_85%] md:flex-[0_0_45%] lg:flex-[0_0_33.333%] min-w-0 pl-6 md:pl-8">
                                        <?php get_template_part('template-parts/components/card-activity', null, [
                                            'image' => get_template_directory_uri() . '/assets/images/intense_gallery_02.webp',
                                            'title' => 'Lunch & Tour at Larco Café & Museum',
                                        ]); ?>
                                    </div>
                                    <!-- Slide 2 -->
                                    <div
                                        class="embla__slide flex-[0_0_85%] md:flex-[0_0_45%] lg:flex-[0_0_33.333%] min-w-0 pl-6 md:pl-8">
                                        <?php get_template_part('template-parts/components/card-activity', null, [
                                            'image' => get_template_directory_uri() . '/assets/images/intense_gallery_03.webp',
                                            'title' => 'Tasting Tour Lima',
                                        ]); ?>
                                    </div>
                                    <!-- Slide 3 -->
                                    <div
                                        class="embla__slide flex-[0_0_85%] md:flex-[0_0_45%] lg:flex-[0_0_33.333%] min-w-0 pl-6 md:pl-8">
                                        <?php get_template_part('template-parts/components/card-activity', null, [
                                            'image' => get_template_directory_uri() . '/assets/images/intense_gallery_04.webp',
                                            'title' => 'Peruvian Paso Horse Show and Lunch in Hacienda Los Ficus',
                                            'advisor_text' => 'Ask your Travel Advisor to add this experience'
                                        ]); ?>
                                    </div>
                                    <!-- Slide 4 -->
                                    <div
                                        class="embla__slide flex-[0_0_85%] md:flex-[0_0_45%] lg:flex-[0_0_33.333%] min-w-0 pl-6 md:pl-8">
                                        <?php get_template_part('template-parts/components/card-activity', null, [
                                            'image' => get_template_directory_uri() . '/assets/images/intense_gallery_01.webp',
                                            'title' => 'Private Culinary Experience in a Local Home',
                                            'advisor_text' => 'Ask your Travel Advisor to add this experience'
                                        ]); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- End Main Content Col -->

            </div> <!-- End Grid -->
        </div>
    </section>

    <!-- Banner Text -->
    <?php get_template_part('template-parts/components/banner-text'); ?>

    <!-- 5. General Testimonials -->
    <?php get_template_part('template-parts/home/section-testimonials'); ?>

    <!-- 6. General CTA -->
    <?php get_template_part('template-parts/components/banner-cta'); ?>

    <!-- 7. More Journeys (Related) -->
    <section class="py-24 bg-cream">
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
                // Mock array for related
                $itineraries = [
                    [
                        'title' => '8D Andes Experience',
                        'days' => '8 Days',
                        'price' => 'USD 1,399',
                        'destinations' => 'Lima • Arequipa • Colca Canyon • Cusco • Sacred Valley • Machu Picchu',
                        'img' => get_template_directory_uri() . '/assets/images/intense_01.webp',
                        'badges' => ['Top seller']
                    ],
                    [
                        'title' => '5D Andean Getaway',
                        'days' => '5 Days',
                        'price' => 'USD 1,099',
                        'destinations' => 'Cusco • Sacred Valley • Machu Picchu',
                        'img' => get_template_directory_uri() . '/assets/images/intense_03.webp',
                        'badges' => []
                    ],
                    [
                        'title' => '8D Cusco Immersive',
                        'days' => '8 Days',
                        'price' => 'USD 1,299',
                        'destinations' => 'Cusco • Pisac • Ollantaytambo • Machu Picchu & Cusco',
                        'img' => get_template_directory_uri() . '/assets/images/intense_gallery_01.webp',
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
                        'link_text' => 'Explore itinerary',
                        'aos_delay' => ($index % 3) * 100,
                        'badges' => $itin['badges'],
                    ]); ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- 8. Booking Form Section -->
    <section id="booking-form" class="py-24 bg-[#FAFAFA] border-t border-neutral-gray/20">
        <div class="container-site max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">

                <!-- Left: Form Info -->
                <div class="lg:col-span-4" data-aos="fade-right">
                    <h2 class="font-heading text-3xl md:text-4xl text-dark mb-8 font-light leading-tight">Free
                        Quote<br>Request</h2>
                    <p class="font-body text-dark text-lg font-light leading-relaxed">
                        Located in Arequipa's historic center, Cirqa lies steps from the Mai}
                    </p>
                </div>

                <!-- Right: Actually Form -->
                <div class="lg:col-span-8" data-aos="fade-left">
                    <form x-data="bookingForm()" @submit="submitForm" class="space-y-8 md:space-y-10">
                        <!-- Name Row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                            <div class="relative">
                                <input type="text" x-model="formData.firstName" @input="validateField('firstName')"
                                    class="w-full bg-transparent border-b border-[#a0948c] pb-2 font-body text-dark focus:outline-none focus:border-[#6B5A51] transition-colors placeholder:text-[#88786F]"
                                    placeholder="First Name">
                                <span x-show="errors.firstName" x-text="errors.firstName"
                                    class="absolute left-0 -bottom-5 text-xs text-red-500"></span>
                            </div>
                            <div class="relative">
                                <input type="text" x-model="formData.lastName" @input="validateField('lastName')"
                                    class="w-full bg-transparent border-b border-[#a0948c] pb-2 font-body text-dark focus:outline-none focus:border-[#6B5A51] transition-colors placeholder:text-[#88786F]"
                                    placeholder="Last Name">
                                <span x-show="errors.lastName" x-text="errors.lastName"
                                    class="absolute left-0 -bottom-5 text-xs text-red-500"></span>
                            </div>
                        </div>

                        <!-- Email Row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                            <div class="relative">
                                <input type="email" x-model="formData.email" @input="validateField('email')"
                                    class="w-full bg-transparent border-b border-[#a0948c] pb-2 font-body text-dark focus:outline-none focus:border-[#6B5A51] transition-colors placeholder:text-[#88786F]"
                                    placeholder="Email">
                                <span x-show="errors.email" x-text="errors.email"
                                    class="absolute left-0 -bottom-5 text-xs text-red-500"></span>
                            </div>
                            <div class="relative">
                                <input type="email" x-model="formData.confirmEmail"
                                    @input="validateField('confirmEmail')"
                                    class="w-full bg-transparent border-b border-[#a0948c] pb-2 font-body text-dark focus:outline-none focus:border-[#6B5A51] transition-colors placeholder:text-[#88786F]"
                                    placeholder="Confirm Email">
                                <span x-show="errors.confirmEmail" x-text="errors.confirmEmail"
                                    class="absolute left-0 -bottom-5 text-xs text-red-500"></span>
                            </div>
                        </div>

                        <!-- Date & Trip Length Row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                            <div class="relative">
                                <div class="absolute right-0 top-0 bottom-2 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-[#88786F]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')"
                                    x-model="formData.startDate" @input="validateField('startDate')"
                                    class="w-full bg-transparent border-b border-[#a0948c] pb-2 font-body text-dark focus:outline-none focus:border-[#6B5A51] transition-colors placeholder:text-[#88786F] cursor-pointer"
                                    placeholder="Star Date">
                                <span x-show="errors.startDate" x-text="errors.startDate"
                                    class="absolute left-0 -bottom-5 text-xs text-red-500"></span>
                            </div>
                            <div class="relative">
                                <div class="absolute right-0 top-0 bottom-2 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-[#88786F]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                <select x-model="formData.tripLength" @change="validateField('tripLength')"
                                    class="w-full bg-transparent border-b border-[#a0948c] pb-2 font-body text-dark focus:outline-none focus:border-[#6B5A51] appearance-none rounded-none cursor-pointer placeholder:text-[#88786F]"
                                    :class="{'text-[#88786F]': !formData.tripLength, 'text-dark': formData.tripLength}">
                                    <option value="" disabled selected hidden>Trip Length</option>
                                    <option value="1-4">1 to 4 days</option>
                                    <option value="5-8">5 to 8 days</option>
                                    <option value="9-14">9 to 14 days</option>
                                </select>
                                <span x-show="errors.tripLength" x-text="errors.tripLength"
                                    class="absolute left-0 -bottom-5 text-xs text-red-500"></span>
                            </div>
                        </div>

                        <!-- Passengers Row -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                            <div class="relative">
                                <div class="absolute right-0 top-0 bottom-2 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-[#88786F]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                <select x-model="formData.adults" @change="validateField('adults')"
                                    class="w-full bg-transparent border-b border-[#a0948c] pb-2 font-body text-dark focus:outline-none focus:border-[#6B5A51] appearance-none rounded-none cursor-pointer">
                                    <option value="0" disabled>Adults</option>
                                    <option value="1">1 Adult</option>
                                    <option value="2">2 Adults</option>
                                    <option value="3">3 Adults</option>
                                    <option value="4+">4+ Adults</option>
                                </select>
                                <span x-show="errors.adults" x-text="errors.adults"
                                    class="absolute left-0 -bottom-5 text-xs text-red-500"></span>
                            </div>
                            <div class="relative">
                                <div class="absolute right-0 top-0 bottom-2 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-[#88786F]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                <select x-model="formData.children"
                                    class="w-full bg-transparent border-b border-[#a0948c] pb-2 font-body text-dark focus:outline-none focus:border-[#6B5A51] appearance-none rounded-none cursor-pointer">
                                    <option value="0" disabled>Children</option>
                                    <option value="none">0 Children</option>
                                    <option value="1">1 Child</option>
                                    <option value="2">2 Children</option>
                                    <option value="3+">3+ Children</option>
                                </select>
                            </div>
                            <div class="relative">
                                <div class="absolute right-0 top-0 bottom-2 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-[#88786F]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                <select x-model="formData.enfants"
                                    class="w-full bg-transparent border-b border-[#a0948c] pb-2 font-body text-dark focus:outline-none focus:border-[#6B5A51] appearance-none rounded-none cursor-pointer">
                                    <option value="0" disabled>Enfants ( < 1 )</option>
                                    <option value="none">0 Enfants</option>
                                    <option value="1">1 Enfant</option>
                                    <option value="2">2 Enfants</option>
                                </select>
                            </div>
                        </div>

                        <!-- Hotel Category Row -->
                        <div class="pt-2 relative">
                            <p class="font-body text-sm text-[#88786F] mb-6">Hotel Category</p>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                                <!-- Boutique -->
                                <div class="cursor-pointer group" @click="setHotelCategory('boutique')">
                                    <span class="block font-body text-[15px] font-light mb-3 transition-colors"
                                        :class="formData.hotelCategory === 'boutique' ? 'text-dark font-medium' : 'text-[#88786F] group-hover:text-dark'">Boutique</span>
                                    <div class="flex justify-center gap-1.5 transition-colors"
                                        :class="formData.hotelCategory === 'boutique' ? 'text-dark' : 'text-[#a0948c] group-hover:text-dark'">
                                        <template x-for="i in 5"><svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg></template>
                                    </div>
                                </div>
                                <!-- Luxury -->
                                <div class="cursor-pointer group" @click="setHotelCategory('luxury')">
                                    <span class="block font-body text-[15px] font-light mb-3 transition-colors"
                                        :class="formData.hotelCategory === 'luxury' ? 'text-dark font-medium' : 'text-[#88786F] group-hover:text-dark'">Luxury</span>
                                    <div class="flex justify-center gap-1.5 transition-colors"
                                        :class="formData.hotelCategory === 'luxury' ? 'text-dark' : 'text-[#a0948c] group-hover:text-dark'">
                                        <template x-for="i in 5"><svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg></template>
                                    </div>
                                </div>
                                <!-- Superior -->
                                <div class="cursor-pointer group" @click="setHotelCategory('superior')">
                                    <span class="block font-body text-[15px] font-light mb-3 transition-colors"
                                        :class="formData.hotelCategory === 'superior' ? 'text-dark font-medium' : 'text-[#88786F] group-hover:text-dark'">Superior</span>
                                    <div class="flex justify-center gap-1.5 transition-colors"
                                        :class="formData.hotelCategory === 'superior' ? 'text-dark' : 'text-[#a0948c] group-hover:text-dark'">
                                        <template x-for="i in 4"><svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg></template>
                                    </div>
                                </div>
                                <!-- Best Value -->
                                <div class="cursor-pointer group" @click="setHotelCategory('value')">
                                    <span class="block font-body text-[15px] font-light mb-3 transition-colors"
                                        :class="formData.hotelCategory === 'value' ? 'text-dark font-medium' : 'text-[#88786F] group-hover:text-dark'">Best
                                        Value</span>
                                    <div class="flex justify-center gap-1.5 transition-colors"
                                        :class="formData.hotelCategory === 'value' ? 'text-dark' : 'text-[#a0948c] group-hover:text-dark'">
                                        <template x-for="i in 3"><svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg></template>
                                    </div>
                                </div>
                            </div>
                            <span x-show="errors.hotelCategory" x-text="errors.hotelCategory"
                                class="absolute left-0 -bottom-5 text-xs text-red-500"></span>
                        </div>

                        <!-- WhatsApp & Hear about us Row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 pt-6">
                            <div class="relative">
                                <input type="text" x-model="formData.whatsapp"
                                    class="w-full bg-transparent border-b border-[#a0948c] pb-2 font-body text-dark focus:outline-none focus:border-[#6B5A51] transition-colors placeholder:text-[#88786F]"
                                    placeholder="WhatsApp (optional)">
                            </div>
                            <div class="relative">
                                <div class="absolute right-0 top-0 bottom-2 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-[#88786F]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                <select x-model="formData.hearAboutUs"
                                    class="w-full bg-transparent border-b border-[#a0948c] pb-2 font-body text-dark focus:outline-none focus:border-[#6B5A51] appearance-none rounded-none cursor-pointer placeholder:text-[#88786F]"
                                    :class="{'text-[#88786F]': !formData.hearAboutUs, 'text-dark': formData.hearAboutUs}">
                                    <option value="" disabled selected hidden>How do you hear about us</option>
                                    <option value="google">Google Search</option>
                                    <option value="friend">Friend/Family</option>
                                    <option value="social">Social Media</option>
                                </select>
                            </div>
                        </div>

                        <!-- Mensaje Row -->
                        <div class="pt-4 relative">
                            <textarea rows="2" x-model="formData.mensaje"
                                class="w-full bg-transparent border-b border-[#a0948c] pb-2 font-body text-dark focus:outline-none focus:border-[#6B5A51] transition-colors placeholder:text-[#88786F] resize-none"
                                placeholder="Mensaje"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6 md:pt-10">
                            <button type="submit"
                                class="w-full md:w-auto px-12 py-3 rounded-full border border-dark text-dark font-body hover:bg-[#6B5A51] hover:text-white transition-colors flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
                                :disabled="isSubmitting">
                                <span x-show="!isSubmitting">Send Request</span>
                                <span x-show="isSubmitting" class="flex items-center gap-2" style="display: none;">
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

</main>

<?php get_footer(); ?>