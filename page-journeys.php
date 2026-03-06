<?php
/**
 * Template Name: Journeys Page
 *
 * @package Intense_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- 1. Hero Section -->
    <section class="relative h-[60vh] md:h-[80vh] flex items-center justify-center text-center">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="Journeys Hero Background"
                class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-dark/40"></div>
        </div>

        <!-- Content -->
        <div class="container-site relative z-10 px-4 mt-20 md:mt-0" data-aos="fade-up">
            <h1 class="font-heading text-4xl md:text-6xl text-white mb-6">
                <?php the_title(); ?>
            </h1>
            <div class="font-body text-lg md:text-xl text-white max-w-3xl mx-auto font-light leading-relaxed">
                <?php the_content(); ?>
            </div>
        </div>
    </section>

    <!-- 2. Explore Our Journeys (Filters & Grid) -->
    <section class="py-24 bg-cream">
        <div class="container-site">
            <div class="text-center mb-16">
                <h2 class="font-heading text-4xl md:text-5xl text-dark mb-10" data-aos="fade-up">Explore Our Journeys
                </h2>

                <!-- Mock Filters -->
                <div class="flex flex-wrap justify-start gap-6 md:gap-12" data-aos="fade-up" data-aos-delay="100">
                    <button class="font-body text-sm font-bold text-dark border-b-2 border-dark pb-1">All
                        Journeys</button>
                    <button
                        class="font-body text-sm font-medium text-neutral-gray hover:text-dark transition-colors pb-1">Signature<br><span
                            class="text-xs normal-case text-neutral-gray/60 font-normal">15-10 days</span></button>
                    <button
                        class="font-body text-sm font-medium text-neutral-gray hover:text-dark uppercase tracking-wide transition-colors pb-1">Design
                        it<br><span class="text-xs normal-case text-neutral-gray/60 font-normal">9-5
                            days</span></button>
                    <button
                        class="font-body text-sm font-medium text-neutral-gray hover:text-dark uppercase tracking-wide transition-colors pb-1">Treasures<br><span
                            class="text-xs normal-case text-neutral-gray/60 font-normal">4-2 days</span></button>
                </div>
            </div>

            <!-- Grid of Itineraries -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 text-left">
                <?php
                // Mock array combining front-page ones and a few extras to fill the grid like the design
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
                        'title' => '8D Andes Experience',
                        'days' => '8 Days',
                        'price' => 'USD 1,399',
                        'destinations' => 'Lima • Arequipa • Colca Canyon • Cusco • Sacred Valley • Machu Picchu',
                        'img' => get_template_directory_uri() . '/assets/images/intense_01.webp',
                        'badges' => ['New', 'Top seller']
                    ],
                    [
                        'title' => '5D Andean Getaway',
                        'days' => '5 Days',
                        'price' => 'USD 1,099',
                        'destinations' => 'Cusco • Sacred Valley • Machu Picchu',
                        'img' => get_template_directory_uri() . '/assets/images/intense_03.webp',
                        'badges' => ['New', 'Top seller']
                    ],
                    [
                        'title' => '8D Cusco Immersive',
                        'days' => '8 Days',
                        'price' => 'USD 1,299',
                        'destinations' => 'Cusco • Pisac • Ollantaytambo • Machu Picchu & Cusco',
                        'img' => get_template_directory_uri() . '/assets/images/intense_gallery_01.webp',
                        'badges' => ['New', 'Top seller']
                    ],
                    [
                        'title' => '6D Amazon Tambopata',
                        'days' => '6 Days',
                        'price' => 'USD 1,499',
                        'destinations' => 'Lima • Tambopata National Reserve',
                        'img' => get_template_directory_uri() . '/assets/images/intense_gallery_02.webp',
                        'badges' => ['New', 'Top seller']
                    ],
                    [
                        'title' => '8D Uyuni & Bolivia',
                        'days' => '8 Days',
                        'price' => 'USD 1,899',
                        'destinations' => 'La Paz • Salar de Uyuni • Potosi • Sucre • Isla del Sol • Copacabana',
                        'img' => get_template_directory_uri() . '/assets/images/intense_gallery_07.webp',
                        'badges' => ['New', 'Top seller']
                    ],
                    [
                        'title' => '4D Chachapoyas',
                        'days' => '4 Days',
                        'price' => 'USD 799',
                        'destinations' => 'Lima • Chachapoyas • Kuelap • Gocta Waterfall',
                        'img' => get_template_directory_uri() . '/assets/images/intense_gallery_06.webp',
                        'badges' => ['New', 'Top seller']
                    ],
                    [
                        'title' => '5D Trujillo & Chiclayo',
                        'days' => '5 Days',
                        'price' => 'USD 859',
                        'destinations' => 'Lima • Chiclayo • Trujillo',
                        'img' => get_template_directory_uri() . '/assets/images/intense_gallery_08.webp',
                        'badges' => ['New', 'Top seller']
                    ],
                    [
                        'title' => '4D Paracas Coast',
                        'days' => '4 Days',
                        'price' => 'USD 599',
                        'destinations' => 'Lima • Paracas • Ballestas Islands • Nazca Lines',
                        'img' => get_template_directory_uri() . '/assets/images/intense_04.webp',
                        'badges' => ['New', 'Top seller']
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
                        'aos_delay' => ($index % 3) * 100, // Stagger effect per row
                        'badges' => $itin['badges'],
                    ]); ?>
                <?php endforeach; ?>
            </div>

            <div class="mt-16 text-center" data-aos="fade-up">
                <?php get_template_part('template-parts/components/btn-secondary', null, [
                    'text' => 'Load More Journeys',
                    'href' => '#',
                    'class_extra' => 'px-12 text-base'
                ]); ?>
            </div>

        </div>
    </section>

    <!-- CTA Banner -->
    <?php get_template_part('template-parts/components/banner-cta'); ?>

    <!-- 4. Testimonials -->
    <?php get_template_part('template-parts/home/section-testimonials'); ?>

</main>

<?php get_footer(); ?>