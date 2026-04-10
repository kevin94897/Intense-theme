<?php

/**
 * Featured Posts Section using content-blog-item — Embla Slider
 */

$query_args = array(
    'post_type'      => 'post',
    'posts_per_page' => 9,
    'post_status'    => 'publish',
    // 'category_name'  => 'featured', // Optional: if you want to filter by a specific category
);

$featured_posts = new WP_Query($query_args);
?>

<section class="md:pb-20 pb-12 bg-cream overflow-hidden">
    <div class="container-site">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end md:mb-12 mb-6 gap-6">
            <div class="text-left">
                <h2 class="font-heading text-4xl md:text-5xl text-dark" data-aos="fade-up">Journeys & Stories</h2>
            </div>
            <div class="flex items-center gap-6" data-aos="fade-up" data-aos-delay="100">
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"
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

        <?php if ($featured_posts->have_posts()) : ?>
            <!-- Embla Wrapper -->
            <div class="embla-stories relative" data-aos="fade-up" data-aos-delay="200">
                <div class="embla overflow-hidden py-4">
                    <div class="embla__container flex -ml-6 md:-ml-10">
                        <?php while ($featured_posts->have_posts()) : $featured_posts->the_post(); ?>
                            <div class="embla__slide flex-[0_0_90%] sm:flex-[0_0_50%] lg:flex-[0_0_33.333%] min-w-0 pl-6 md:pl-10">
                                <?php
                                get_template_part('template-parts/content-blog-item', null, [
                                    'classes' => 'news-card group flex flex-col h-full'
                                ]);
                                ?>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>

                <!-- Navigation Controls -->
                <!-- <div class="flex items-center justify-center md:justify-start gap-12 mt-12">
                    <button class="embla__prev group cursor-pointer disabled:opacity-20 disabled:cursor-not-allowed transition-opacity" aria-label="Previous">
                        <svg class="w-16 h-5" viewBox="0 0 100 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <line x1="95" y1="12" x2="10" y2="12"></line>
                            <polyline points="20 4 10 12 20 20" class="transition-all duration-300 group-hover:-translate-x-1"></polyline>
                        </svg>
                    </button>
                    <button class="embla__next group cursor-pointer disabled:opacity-20 disabled:cursor-not-allowed transition-opacity" aria-label="Next">
                        <svg class="w-16 h-5" viewBox="0 0 100 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <line x1="5" y1="12" x2="90" y2="12"></line>
                            <polyline points="80 4 90 12 80 20" class="transition-all duration-300 group-hover:translate-x-1"></polyline>
                        </svg>
                    </button>
                </div> -->
            </div>
        <?php else : ?>
            <p class="text-center font-body text-dark/70">No featured posts found.</p>
        <?php endif; ?>
    </div>
</section>