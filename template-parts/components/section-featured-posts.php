<?php

/**
 * Featured Posts Section using content-blog-item
 */

$query_args = array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    // 'category_name'  => 'featured', // Optional: if you want to filter by a specific category
);

$featured_posts = new WP_Query($query_args);
?>

<section class="py-20 bg-cream">
    <div class="container-site">
        <div class="text-center mb-12">
            <h2 class="font-heading text-4xl md:text-5xl text-dark" data-aos="fade-up">Journeys & Stories</h2>
        </div>

        <div class="text-right mb-4" data-aos="fade-up" data-aos-delay="100">
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"
                class="font-body text-sm text-dark uppercase tracking-wide hover:text-hover transition-colors font-medium flex items-center justify-end gap-2 group">
                See All
                <svg class="w-12 h-6 text-dark transition-transform duration-300 group-hover:translate-x-2"
                    viewBox="0 0 40 10" fill="none" stroke="currentColor" stroke-width="1.5">
                    <line x1="0" y1="5" x2="38" y2="5"></line>
                    <polyline points="34 1 39 5 34 9"></polyline>
                </svg>
            </a>
        </div>

        <?php if ($featured_posts->have_posts()) : ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php while ($featured_posts->have_posts()) : $featured_posts->the_post(); ?>
                    <?php
                    // Render using the existing blog card template part
                    get_template_part('template-parts/content-blog-item', null, [
                        'classes' => 'news-card group flex flex-col h-full' // Add any wrapper classes needed
                    ]);
                    ?>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        <?php else : ?>
            <p class="text-center font-body text-dark/70">No featured posts found.</p>
        <?php endif; ?>
    </div>
</section>