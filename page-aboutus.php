<?php

/**
 * Template Name: Nosotros
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
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_banner_nosotros.webp"
                alt="Machu Picchu" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-neutral-black/40"></div>
        </div>

        <div class="container-site relative z-10 text-center px-4">
            <h1 class="font-heading text-white text-5xl md:text-[64px] leading-tight md:leading-[72px] mb-6"
                data-aos="fade-up" data-aos-delay="100">
                "Weaving" Authentic Journeys since 2007
            </h1>
            <p class="font-body text-white/90 text-lg md:text-xl font-light max-w-2xl mx-auto mb-10" data-aos="fade-up"
                data-aos-delay="200">
                We are a boutique travel company "weaving" exclusive, authentic, sustainable, and tailor-made journeys that immerse travelers in Peru’s vibrant culture and awe-inspiring natural wonders </p>
        </div>
    </section>

    <section class="py-20">
        <div class="container-site">
            <p class="font-body text-lg md:text-xl text-dark mb-0 max-w-4xl mx-auto text-center" data-aos="fade-up"
                data-aos-delay="200">
                Deeply rooted in Peru, we carry our heritage in everything we do. We cherish the stories, traditions, and
                wisdom passed down through generations, and we feel proud to share their magic with the world. Every
                journey we create is an invitation to connect with the heart of Peru — to feel its spirit, celebrate its
                people, and discover the beauty that continues to shape our future.
            </p>
        </div>
    </section>


    <!-- Our Story -->
    <section class="pb-12 md:pb-20 bg-cream">
        <div class="container-site">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

                <!-- Left: Photo -->
                <div class="relative" data-aos="fade-right">
                    <div class="rounded-2xl overflow-hidden shadow-xl">
                        <img
                            src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_conocenos_our_story.webp"
                            alt="Vicuñas in the Peruvian highlands"
                            class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Right: FAQ accordion -->
                <div data-aos="fade-left">

                    <h2 class="font-heading text-4xl md:text-5xl font-medium mb-6">Our Story</h2>

                    <p class="font-body text-dark font-light">
                        Intense Peru began with a simple dream — to share Peru’s essence through authentic, high-quality experiences.Founded by Sofia Arce, the company evolved from offering group itineraries to creating private, tailor-made journeys for travelers seeking connection, comfort, and cultural depth.
                    </p>
                    <p class="font-body text-dark font-light">
                        Today, Intense Peru stands among Latin America’s leading boutique travel companies, crafting bespoke adventures that honor heritage, people, and nature. </p>

                </div>
            </div>
        </div>
    </section>

    <!--  STATS COUNTER BAR  -->
    <?php get_template_part('template-parts/components/section-counter'); ?>

    <?php get_template_part('template-parts/components/section-meetus'); ?>

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

    <!-- Our Story -->
    <section class="py-12 md:py-20 bg-cream">
        <div class="container-site">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

                <!-- Left: Photo -->
                <div class="relative" data-aos="fade-right">
                    <div class="rounded-2xl overflow-hidden shadow-xl">
                        <img
                            src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_conocenos_sofia.webp"
                            alt="Vicuñas in the Peruvian highlands"
                            class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Right: FAQ accordion -->
                <div data-aos="fade-left">

                    <h2 class="font-heading text-4xl md:text-6xl font-medium mb-12">Sofia</h2>

                    <p class="font-body text-dark font-light mb-6">
                        Born in northern Peru, Sofia learned early what it meant to live far from her roots.<br>
                        At just sixteen, she moved to the United States to study Economics and Finance at the University of Texas at Austin. After completing her degree and gaining professional experience, she returned to Peru to join a major international bank. Not long after, a new opportunity led her to Milan, where she pursued a master’s degree at Bocconi University. </p>
                    <p class="font-body text-dark font-light">
                        These years abroad shaped her deeply, nurturing a natural and heartfelt instinct to “promote” her country—proudly, spontaneously, and with genuine love.<br>And so, in 2007, Intense Peru was born: a project inspired by her desire to share the magic of an authentic destination, one where ancient culture and nature come together in a way that touches the human spirit.
                </div>
            </div>

            <div class="mt-12" data-aos="fade-up">
                <p class="font-body text-dark font-light mb-6"><b>Today, under Sofia's leadership, Intense Peru has grown into a renowned boutique travel agency</b>—and, just as importantly, into a family-run company that ensures its values and commitment will be passed down from one generation to the next.</p>
            </div>
        </div>
    </section>

    <!-- G. Banner CTA -->
    <?php get_template_part('template-parts/components/banner-cta'); ?>

</main>

<?php get_footer(); ?>