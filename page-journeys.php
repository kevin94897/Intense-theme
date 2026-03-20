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
    <section class="relative h-screen min-h-[600px] flex items-center justify-center pt-20 aos-init aos-animate">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="Journeys Hero Background"
                class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-dark/40"></div>
        </div>

        <!-- Content -->
        <div class="container-site relative z-10 px-4 mt-20 md:mt-0" data-aos="fade-up">
            <h1 class="font-heading text-4xl md:text-6xl text-white mb-6 text-center">
                <?php the_title(); ?>
            </h1>
            <div class="font-body text-sm md:text-xl text-white max-w-3xl mx-auto font-light leading-relaxed text-center">
                <?php the_content(); ?>
            </div>
        </div>
    </section>

    <!-- 2. Explore Our Journeys (Filters & Grid) -->
    <section class="py-18 bg-cream">
        <div class="container-site">
            <div class="text-center mb-16">
                <h2 class="font-heading text-4xl md:text-5xl text-dark mb-12 md:mb-24" data-aos="fade-up">Explore Our Journeys
                </h2>

                <!-- Filters -->
                <div id="journey-filters" class="flex flex-nowrap md:flex-wrap items-start justify-start gap-6 md:gap-12 overflow-x-auto scrollbar-hide pb-4 md:pb-0" data-aos="fade-up" data-aos-delay="100">
                    <button data-filter="all" class="filter-btn active font-body text-sm font-medium text-dark border-b-2 border-dark pb-1 text-center cursor-pointer min-w-[80px]">
                        All Journeys
                    </button>
                    <button data-filter="signature" class="filter-btn font-body text-sm font-medium text-neutral-gray hover:text-dark transition-colors pb-1 text-center cursor-pointer min-w-[80px]">
                        Signature<br><span class="text-xs normal-case text-neutral-gray/60 font-normal">10+ days</span>
                    </button>
                    <button data-filter="design-it" class="filter-btn font-body text-sm text-neutral-gray hover:text-dark transition-colors pb-1 text-center cursor-pointer min-w-[80px]">
                        Design it<br><span class="text-xs normal-case text-neutral-gray/60 font-normal">5-9 days</span>
                    </button>
                    <button data-filter="treasures" class="filter-btn font-body text-sm font-medium text-neutral-gray hover:text-dark transition-colors pb-1 text-center cursor-pointer min-w-[80px]">
                        Treasures<br><span class="text-xs normal-case text-neutral-gray/60 font-normal">1-4 days</span>
                    </button>
                </div>
            </div>

            <!-- Grid of Itineraries -->
            <div id="journey-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 text-left">
                <?php
                $args = [
                    'post_type'      => 'journey',
                    'posts_per_page' => 9, // Adjust as needed
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ];

                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    $index = 0;
                    while ($query->have_posts()) : $query->the_post();
                        $information = get_field('information');
                        $features    = get_field('features');

                        // Data mapping
                        $image        = get_the_post_thumbnail_url(get_the_ID(), 'large');
                        $title        = get_the_title();
                        $days_val     = (int)($information['days'] ?? 0);
                        $duration     = $days_val ? $days_val . ' Days' : '';
                        $price_val    = $features['price'] ?? '';
                        $price        = $price_val ? 'USD ' . number_format($price_val) : '';
                        $destinations = $information['short_description'] ?? '';
                        $link         = get_permalink();
                ?>

                        <div class="journey-card" data-days="<?php echo $days_val; ?>">
                            <?php
                            get_template_part('template-parts/components/card-itinerary', null, [
                                'image'        => $image,
                                'title'        => $title,
                                'price'        => $price,
                                'duration'     => $duration,
                                'destinations' => $destinations,
                                'link'         => $link,
                                'link_text'    => 'Explore itinerary',
                                'aos_delay'    => ($index % 3) * 100,
                                'badges'       => [],
                            ]);
                            ?>
                        </div>

                <?php
                        $index++;
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p class="col-span-full text-center py-10">No journeys found.</p>';
                endif;
                ?>
            </div>

            <?php if ($query->found_posts > 9) : ?>
                <div class="mt-16 text-center" data-aos="fade-up">
                    <?php get_template_part('template-parts/components/btn-secondary', null, [
                        'text' => 'Load More Journeys',
                        'href' => '#',
                        'class_extra' => 'px-12 text-base'
                    ]); ?>
                </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- CTA Banner -->
    <?php get_template_part('template-parts/components/banner-cta'); ?>

    <!-- 4. Testimonials -->
    <?php get_template_part('template-parts/home/section-testimonials'); ?>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const filterBtns = document.querySelectorAll('#journey-filters .filter-btn');
        const cards = document.querySelectorAll('#journey-grid .journey-card');

        // Map filter slugs → day ranges
        const filterRanges = {
            'all': [0, Infinity],
            'signature': [10, Infinity],
            'design-it': [5, 9],
            'treasures': [1, 4],
        };

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {

                // Update active styles
                filterBtns.forEach(b => {
                    b.classList.remove('active', 'border-b-2', 'border-dark', 'text-dark');
                    b.classList.add('text-neutral-gray');
                });
                this.classList.add('active', 'border-b-2', 'border-dark', 'text-dark');
                this.classList.remove('text-neutral-gray');

                const filter = this.dataset.filter;
                const [min, max] = filterRanges[filter] ?? [0, Infinity];

                cards.forEach(card => {
                    const days = parseInt(card.dataset.days, 10) || 0;
                    const show = days >= min && days <= max;
                    card.style.display = show ? '' : 'none';
                });
            });
        });
    });
</script>

<?php get_footer(); ?>