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
            <img src="https://images.unsplash.com/photo-1587595431973-160d0d94add1?q=80&w=2076&auto=format&fit=crop" alt="Machu Picchu" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-neutral-black/40"></div>
        </div>

        <div class="container-site relative z-10 text-center px-4">
            <h1 class="font-heading text-white text-5xl md:text-[64px] leading-tight md:leading-[72px] mb-6" data-aos="fade-up" data-aos-delay="100">
                Macchu Picchu & the Sacred Valley
            </h1>
            <p class="font-body text-white/90 text-lg md:text-xl font-light max-w-2xl mx-auto mb-10" data-aos="fade-up" data-aos-delay="200">
                A 6-day journey through the heart of the Incan Empire. Explore ancient ruins, vibrant markets, and breathtaking landscapes.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4" data-aos="fade-up" data-aos-delay="300">
                <?php get_template_part('template-parts/components/btn-primary', null, [
                    'text' => 'Explore itineraries',
                    'href' => '#itineraries',
                ]); ?>
                <?php get_template_part('template-parts/components/btn-outline', null, [
                    'text' => 'Design my trip',
                    'href' => '#design',
                    'class_extra' => 'border-white text-white hover:bg-white hover:text-neutral-black'
                ]); ?>
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="container-site">
            <p class="font-body text-lg md:text-xl text-dark mb-0 max-w-4xl mx-auto text-center" data-aos="fade-up" data-aos-delay="200">
                Proudly Peruvian, we believe the future is built by keeping the past alive. Every day, we honor and nurture our traditions, share their beauty with the world, and design unforgettable experiences that invite people from around the globe to discover — and celebrate — life in Peru.
            </p>
        </div>
    </section>

    <!-- B. Signature Destinations -->
    <section class="py-10 bg-cream">
        <div class="container-site text-left">
            <h2 class="font-heading text-4xl md:text-5xl text-dark mb-12" data-aos="fade-up" data-aos-delay="100">Signature Destinations</h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 auto-rows-[250px]">
                <!-- Item 1 (Span 2 cols, 2 rows) -->
                <div class="md:col-span-2 md:row-span-2 relative group overflow-hidden rounded-lg cursor-pointer" data-aos="fade-up" data-aos-delay="200">
                    <img src="https://images.unsplash.com/photo-1526392060635-9d6019884377?q=80&w=2070&auto=format&fit=crop" alt="Cusco" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-left">
                        <h3 class="font-heading text-white text-3xl font-bold">Cusco</h3>
                        <p class="font-body text-white/80 text-sm">The Imperial City</p>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="md:col-span-2 relative group overflow-hidden rounded-lg cursor-pointer" data-aos="fade-up" data-aos-delay="300">
                    <img src="https://images.unsplash.com/photo-1588523315626-d6216dd191bf?q=80&w=2076&auto=format&fit=crop" alt="Machu Picchu" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-left">
                        <h3 class="font-heading text-white text-2xl font-bold">Machu Picchu</h3>
                        <p class="font-body text-white/80 text-sm">The Lost City</p>
                    </div>
                </div>
                <!-- Item 3 -->
                <div class="relative group overflow-hidden rounded-lg cursor-pointer" data-aos="fade-up" data-aos-delay="400">
                    <img src="https://images.unsplash.com/photo-1533036665790-25e4ec7014b0?q=80&w=2070&auto=format&fit=crop" alt="Sacred Valley" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-left">
                        <h3 class="font-heading text-white text-xl font-bold">Sacred Valley</h3>
                    </div>
                </div>
                <!-- Item 4 -->
                <div class="relative group overflow-hidden rounded-lg cursor-pointer" data-aos="fade-up" data-aos-delay="500">
                    <img src="https://images.unsplash.com/photo-1629853920235-cbfe4017efad?q=80&w=2070&auto=format&fit=crop" alt="Arequipa" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-left">
                        <h3 class="font-heading text-white text-xl font-bold">Arequipa</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- C. Authentic Itineraries -->
    <section id="itineraries" class="py-20 bg-cream">
        <div class="container-site text-center">
            <span class="font-body text-sm italic text-primary uppercase tracking-wide mb-2 block" data-aos="fade-up">Journeys</span>
            <h2 class="font-heading text-4xl md:text-5xl text-dark mb-12" data-aos="fade-up" data-aos-delay="100">Our Authentic Itineraries</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 text-left">
                <?php
                $itineraries = [
                    ['title' => 'The Essential Peru', 'days' => '8 Days', 'price' => '$1,299', 'img' => 'https://images.unsplash.com/photo-1587595431973-160d0d94add1?q=80&w=800&auto=format&fit=crop'],
                    ['title' => 'Inca Trail Discovery', 'days' => '5 Days', 'price' => '$899', 'img' => 'https://images.unsplash.com/photo-1526392060635-9d6019884377?q=80&w=800&auto=format&fit=crop'],
                    ['title' => 'Amazon & Andes', 'days' => '12 Days', 'price' => '$2,499', 'img' => 'https://images.unsplash.com/photo-1533036665790-25e4ec7014b0?q=80&w=800&auto=format&fit=crop'],
                ];
                foreach ($itineraries as $index => $itin):
                ?>
                    <?php get_template_part('template-parts/components/card', null, [
                        'image'       => $itin['img'],
                        'image_alt'   => $itin['title'],
                        'category'    => $itin['days'],
                        'title'       => $itin['title'],
                        'description' => 'A beautifully curated experience designed to connect you deeply with the culture and landscapes of Peru.',
                        'link'        => '#',
                        'link_text'   => 'View itinerary',
                        'aos_delay'   => ($index * 100) + 200,
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
                    <img src="https://images.unsplash.com/photo-1508680197779-11ba183be121?q=80&w=2070&auto=format&fit=crop" alt="Local Culture" class="w-full h-auto rounded-lg shadow-xl object-cover aspect-[4/3]">
                </div>
                <div data-aos="fade-left">
                    <span class="font-body text-sm italic text-cream/80 uppercase tracking-wide mb-2 block">Why Choose Us</span>
                    <h2 class="font-heading text-4xl md:text-5xl font-bold mb-8">Venture Beyond</h2>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center shrink-0 mt-1">
                                <span class="text-white font-bold">1</span>
                            </div>
                            <div>
                                <h3 class="font-heading text-2xl font-bold mb-2">Expert Local Guides</h3>
                                <p class="font-body text-cream/80 font-light">Deeply knowledgeable locals who are passionate about sharing their heritage and stories.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center shrink-0 mt-1">
                                <span class="text-white font-bold">2</span>
                            </div>
                            <div>
                                <h3 class="font-heading text-2xl font-bold mb-2">Tailor-Made Experiences</h3>
                                <p class="font-body text-cream/80 font-light">Every itinerary is customized to match your pace, interests, and travel style perfectly.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center shrink-0 mt-1">
                                <span class="text-white font-bold">3</span>
                            </div>
                            <div>
                                <h3 class="font-heading text-2xl font-bold mb-2">Sustainable Tourism</h3>
                                <p class="font-body text-cream/80 font-light">We are deeply committed to protecting the environments and communities we visit.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- E. Gallery (Need again to scroll?) -->
    <section class="py-20 bg-cream">
        <div class="container-site text-center">
            <h2 class="font-heading text-3xl md:text-4xl text-dark mb-10" data-aos="fade-up">Need a reason to pack your bags?</h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                <?php for ($i = 1; $i <= 8; $i++):
                    // Random images related to travel/peru
                    $images = [
                        'https://images.unsplash.com/photo-1587595431973-160d0d94add1?q=80&w=600&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1526392060635-9d6019884377?q=80&w=600&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1533036665790-25e4ec7014b0?q=80&w=600&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1629853920235-cbfe4017efad?q=80&w=600&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1508680197779-11ba183be121?q=80&w=600&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1588523315626-d6216dd191bf?q=80&w=600&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1596423735880-5a3d70659a72?q=80&w=600&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1626084687537-8854dc6eb5dc?q=80&w=600&auto=format&fit=crop',
                    ];
                ?>
                    <a href="#" class="block aspect-square overflow-hidden group" data-aos="fade-up" data-aos-delay="<?php echo ($i % 4) * 100; ?>">
                        <img src="<?php echo $images[$i - 1]; ?>" alt="Gallery Image <?php echo $i; ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </a>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- F. Our Travelers Say -->
    <section class="py-24 bg-cream border-t border-neutral-gray/20">
        <div class="container-site">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Text / Testimonial -->
                <div class="order-2 lg:order-1" data-aos="fade-right">
                    <span class="font-body text-sm italic text-primary uppercase tracking-wide mb-4 block">Our Travelers Say</span>
                    <div class="flex text-gold mb-6">
                        <!-- 5 Stars -->
                        <?php for ($s = 0; $s < 5; $s++): ?>
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <blockquote class="font-heading text-3xl md:text-4xl text-dark leading-snug mb-8">
                        "This was truly the trip of a lifetime. The attention to detail from Intense Nerd Theme travel made every step of our journey magical and absolutely seamless from start to finish."
                    </blockquote>
                    <p class="font-body text-lg text-neutral-black font-bold mb-1">Sarah & Michael J.</p>
                    <p class="font-body text-sm text-neutral-gray">Traveled in October 2023</p>
                </div>
                <!-- Image -->
                <div class="order-1 lg:order-2" data-aos="fade-left">
                    <div class="relative rounded-lg overflow-hidden shadow-2xl aspect-[4/3] max-w-lg mx-auto lg:ml-auto">
                        <img src="https://images.unsplash.com/photo-1570535924719-f06b6f007cb4?q=80&w=2070&auto=format&fit=crop" alt="Llama in Machu Picchu" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- G. Banner CTA -->
    <section class="relative py-32 flex items-center justify-center text-center" data-aos="fade-in">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1444154865181-a75cb57ce19c?q=80&w=2050&auto=format&fit=crop" alt="Sunset Landscape" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-dark/60"></div>
        </div>
        <div class="container-site relative z-10 px-4" data-aos="fade-up" data-aos-delay="100">
            <h2 class="font-heading text-4xl md:text-5xl lg:text-[64px] leading-tight text-white mb-8 max-w-4xl mx-auto">
                Ready to explore the soul of the Incan Empire?
            </h2>
            <?php get_template_part('template-parts/components/btn-primary', null, [
                'text'        => 'Plan my trip',
                'href'        => '#',
                'class_extra' => 'px-10 py-4 text-base'
            ]); ?>
        </div>
    </section>

    <!-- H. Journal & Stories -->
    <section class="py-20 bg-cream">
        <div class="container-site">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
                <div>
                    <h2 class="font-heading text-4xl md:text-5xl text-dark" data-aos="fade-up">Journal & Stories</h2>
                </div>
                <div data-aos="fade-up" data-aos-delay="100">
                    <a href="#" class="font-body text-sm text-primary uppercase tracking-wide hover:text-hover transition-colors font-medium">Read all stories →</a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php
                $posts = [
                    ['title' => 'The Best Time to Visit Machu Picchu in 2024', 'cat' => 'Travel Tips', 'img' => 'https://images.unsplash.com/photo-1587595431973-160d0d94add1?q=80&w=600&auto=format&fit=crop'],
                    ['title' => 'A Culinary Guide to the Streets of Cusco', 'cat' => 'Food & Culture', 'img' => 'https://images.unsplash.com/photo-1629853920235-cbfe4017efad?q=80&w=600&auto=format&fit=crop'],
                    ['title' => 'Top 5 Lesser-Known Ruins in the Sacred Valley', 'cat' => 'Exploration', 'img' => 'https://images.unsplash.com/photo-1533036665790-25e4ec7014b0?q=80&w=600&auto=format&fit=crop'],
                ];
                foreach ($posts as $index => $post):
                ?>
                    <?php get_template_part('template-parts/components/card', null, [
                        'image'       => $post['img'],
                        'image_alt'   => $post['title'],
                        'category'    => $post['cat'],
                        'title'       => $post['title'],
                        'description' => 'Discover the incredible secrets hidden within the ancient passages and vibrant modern life...',
                        'link'        => '#',
                        'link_text'   => 'Read story',
                        'aos_delay'   => $index * 100,
                    ]); ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- I. Newsletter Pre-Footer -->
    <section class="py-20 bg-white border-t border-neutral-gray/20">
        <div class="container-site">
            <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center gap-12">
                <!-- Image Booklet -->
                <div class="w-full md:w-1/3" data-aos="fade-right">
                    <img src="https://images.unsplash.com/photo-1544816155-12df9643f363?q=80&w=600&auto=format&fit=crop" alt="Travel Booklet" class="w-full h-auto rounded-lg shadow-lg rotate-3">
                </div>
                <!-- Form -->
                <div class="w-full md:w-2/3 text-center md:text-left" data-aos="fade-left">
                    <h3 class="font-heading text-3xl font-bold text-dark mb-4">Get our Insider's Guide</h3>
                    <p class="font-body text-neutral-gray text-lg mb-8">Sign up to receive our exclusive e-book with the best tips and hidden gems of Peru, plus updates on new itineraries.</p>

                    <form class="flex flex-col sm:flex-row gap-4" @submit.prevent>
                        <!-- Using the floating input structure from SKILL.md -->
                        <div class="relative w-full sm:flex-1">
                            <input type="email" id="nl_email" placeholder=" " required
                                class="peer w-full border-b border-neutral-gray bg-transparent
                                        pt-5 pb-1 font-body text-base text-neutral-black
                                        hover:border-neutral-black
                                        focus:outline-none focus:border-neutral-black
                                        transition-colors duration-200">
                            <label for="nl_email"
                                class="absolute left-0 top-4 font-body text-base text-neutral-gray
                                        pointer-events-none transition-all duration-200
                                        peer-focus:top-0 peer-focus:text-xs peer-focus:text-neutral-black
                                        peer-[:not(:placeholder-shown)]:top-0
                                        peer-[:not(:placeholder-shown)]:text-xs">
                                Email address
                            </label>
                        </div>
                        <button type="submit" class="bg-primary hover:bg-hover text-white font-body text-sm font-medium px-8 py-3 rounded-full transition-colors duration-200 cursor-pointer shrink-0">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>