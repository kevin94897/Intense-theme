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
    <section class="relative md:h-screen min-h-[600px] flex items-center justify-center pt-20 aos-init aos-animate">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="Journeys Hero Background"
                class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-dark/40"></div>
        </div>

        <!-- Content -->
        <div class="container-site relative z-10 px-4 my-20 md:my-0" data-aos="fade-up">
            <h1 class="font-heading text-4xl md:text-6xl text-white mb-6 text-center">
                <?php the_title(); ?>
            </h1>
            <div
                class="font-body text-sm md:text-xl text-white max-w-3xl mx-auto font-light leading-relaxed text-center">
                <?php the_content(); ?>
            </div>
        </div>
    </section>

    <!-- 2. Explore Our Journeys (Filters & Grid) -->
    <section class="py-18 bg-cream">
        <div class="container-site">
            <div class="text-center mb-16">
                <h2 class="font-heading text-4xl md:text-5xl text-dark mb-12 md:mb-24" data-aos="fade-up">Explore Our
                    Journeys
                </h2>

                <!-- Filters -->
                <div id="journey-filters"
                    class="flex flex-nowrap md:flex-wrap items-center justify-start gap-6 md:gap-12 overflow-x-auto scrollbar-hide pb-4 md:pb-0"
                    data-aos="fade-up" data-aos-delay="100">
                    <button data-filter="all"
                        class="filter-btn active font-body text-sm font-light text-dark border-b-2 border-dark pb-1 text-center cursor-pointer min-w-[80px]">
                        All Journeys
                    </button>
                    <button data-filter="signature"
                        class="filter-btn font-body text-sm font-light text-dark/70 hover:text-dark transition-colors pb-1 text-center cursor-pointer min-w-[80px]">
                        Signature<br><span class="text-xs normal-case text-dark/60 font-normal">10+ days</span>
                    </button>
                    <button data-filter="design-it"
                        class="filter-btn font-body text-sm font-light text-dark/70 hover:text-dark transition-colors pb-1 text-center cursor-pointer min-w-[80px]">
                        Compact<br><span class="text-xs normal-case text-dark/60 font-normal">5-9 days</span>
                    </button>
                    <button data-filter="treasures"
                        class="filter-btn font-body text-sm font-light text-dark/70 hover:text-dark transition-colors pb-1 text-center cursor-pointer min-w-[80px]">
                        Escapes<br><span class="text-xs normal-case text-dark/60 font-normal">1-4 days</span>
                    </button>
                </div>
            </div>

            <!-- Grid of Itineraries -->
            <div class="relative">
                <!-- Loader overlay -->
                <div id="filter-loader" style="display:none"
                    class="absolute inset-0 z-20 flex items-center justify-center bg-cream/70 backdrop-blur-[2px] min-h-[300px]">
                    <div class="w-12 h-12 border-4 border-primary border-t-transparent rounded-full animate-spin"></div>
                </div>

                <div id="journey-grid"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 text-left min-h-[300px] transition-opacity duration-300">
                    <?php
                    // Todos los journeys (sin paginación) ordenados por número de días desc.
                    $journeys = get_posts([
                        'post_type' => 'journey',
                        'posts_per_page' => -1,
                        'post_status' => 'publish',
                    ]);

                    // Precalcular días una sola vez y ordenar (mayor a menor duración)
                    foreach ($journeys as $jp) {
                        $info = get_field('information', $jp->ID);
                        $jp->_days = (int) ($info['days'] ?? 0) ?: (int) get_post_meta($jp->ID, 'days', true);
                    }
                    usort($journeys, fn($a, $b) => $b->_days - $a->_days);

                    if ($journeys):
                        $index = 0;
                        foreach ($journeys as $journey_post):
                            $j_id = $journey_post->ID;
                            $features = get_field('features', $j_id);

                            // Data mapping
                            $image = get_the_post_thumbnail_url($j_id, 'large');
                            $title = get_the_title($j_id);
                            $days_val = $journey_post->_days;
                            $duration = $days_val ? $days_val . ' Days' : '';
                            $price_val = $features['price'] ?? '';
                            $price = $price_val ? 'USD ' . number_format($price_val) : '';
                            $link = get_permalink($j_id);
                            ?>

                            <div class="journey-card" data-days="<?php echo $days_val; ?>">
                                <?php
                                get_template_part('template-parts/components/card-itinerary', null, [
                                    'image' => $image,
                                    'title' => $title,
                                    'price' => $price,
                                    'duration' => $duration,
                                    'post_id' => $j_id,
                                    'link' => $link,
                                    'link_text' => 'Explore itinerary',
                                    'aos_delay' => ($index % 3) * 100,
                                    'badges' => [],
                                ]);
                                ?>
                            </div>

                            <?php
                            $index++;
                        endforeach;
                    else:
                        echo '<p class="col-span-full text-center py-10">No journeys found.</p>';
                    endif;
                    ?>
                </div>
            </div><!-- /.relative wrapper -->

        </div>
    </section>

    <!-- CTA Banner -->
    <?php get_template_part('template-parts/components/banner-cta'); ?>

    <!-- 4. Testimonials -->
    <?php get_template_part('template-parts/home/section-testimonials'); ?>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const filterBtns = document.querySelectorAll('#journey-filters .filter-btn');

        // Map filter slugs → day ranges
        const filterRanges = {
            'all': [0, Infinity],
            'signature': [10, Infinity],
            'design-it': [5, 9],
            'treasures': [1, 4],
        };

        const loader = document.getElementById('filter-loader');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                const grid = document.getElementById('journey-grid');

                // Mostrar loader
                loader.style.display = 'flex';
                grid.classList.add('opacity-40', 'pointer-events-none');

                // Update active styles de inmediato
                filterBtns.forEach(b => {
                    b.classList.remove('active', 'border-b-2', 'border-dark', 'text-dark');
                    b.classList.add('text-neutral-gray');
                });
                this.classList.add('active', 'border-b-2', 'border-dark', 'text-dark');
                this.classList.remove('text-neutral-gray');

                const filter = this.dataset.filter;
                const [min, max] = filterRanges[filter] ?? [0, Infinity];

                // Ceder al browser para pintar el loader antes de filtrar
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => {
                        const cards = document.querySelectorAll('#journey-grid .journey-card, #journey-grid .journey-card-item');
                        let visibleIndex = 0;
                        cards.forEach(card => {
                            const days = parseInt(card.dataset.days, 10) || 0;
                            const show = days >= min && days <= max;
                            if (show) {
                                card.querySelectorAll('[data-aos]').forEach(el => el.classList.add('aos-animate'));
                                card.style.display = '';
                                card.style.animationDelay = (visibleIndex * 60) + 'ms';
                                card.classList.remove('card-filter-in');
                                void card.offsetWidth; // reflow para reiniciar animación
                                card.classList.add('card-filter-in');
                                visibleIndex++;
                            } else {
                                card.style.display = 'none';
                                card.classList.remove('card-filter-in');
                            }
                        });

                        grid.classList.remove('opacity-40', 'pointer-events-none');
                        loader.style.display = 'none';
                    });
                });
            });
        });
    });
</script>

<style>
    @keyframes cardFadeUp {
        from {
            opacity: 0;
            transform: translateY(16px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card-filter-in {
        animation: cardFadeUp 500ms ease both;
    }
</style>

<?php get_footer(); ?>