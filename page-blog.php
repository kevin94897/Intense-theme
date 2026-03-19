<?php

/**
 * Template Name: Blog
 */

get_header();

// 1. Get current category from URL
$current_cat = get_query_var('category_name') ?: ($_GET['category_name'] ?? '');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// 2. Main Query
$args = [
    'post_type'      => 'post',
    'posts_per_page' => 8,
    'paged'          => $paged,
];

if ($current_cat) {
    $args['category_name'] = $current_cat;
}

$blog_query = new WP_Query($args);
?>

<main class="min-h-screen bg-cream">

    <!-- ═══════════════════════════════════════
         HEADER
    ═══════════════════════════════════════ -->
    <section class="pt-20 pb-10 text-center px-4" data-aos="fade-up">
        <h1 class="heading-2 max-w-3xl mx-auto md:text-6xl text-4xl">
            Travel insights to inspire your<br>next journey
        </h1>
        <p class="mt-4 text-dark max-w-2xl mx-auto font-light">
            Curated stories, tips, and guides for travelers seeking unforgettable experiences.
        </p>
    </section>

    <!-- ── Filter Pills ─────────────────────────────────────────────────────────── -->
    <div class="flex flex-wrap justify-center gap-2 px-4 pb-10" data-aos="fade-up" data-aos-delay="100">
        <a href="<?php echo get_permalink(); ?>"
            class="filter-pill <?php echo !$current_cat ? 'active' : ''; ?> text-sm font-body font-medium px-5 py-2 rounded-full">
            All
        </a>
        <?php
        $categories = get_categories(['hide_empty' => true]);
        foreach ($categories as $cat) :
            $is_active = ($current_cat === $cat->slug);
        ?>
            <a href="<?php echo add_query_arg('category_name', $cat->slug, get_permalink()); ?>"
                class="filter-pill <?php echo $is_active ? 'active' : ''; ?> text-sm font-body font-medium px-5 py-2 rounded-full">
                <?php echo esc_html($cat->name); ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- ── News Grid with AJAX ────────────────────────────────────────────────── -->
    <div x-data="blogLoader({
        page: 1,
        maxPages: <?php echo $blog_query->max_num_pages; ?>,
        category: '<?php echo $current_cat; ?>',
        ajaxUrl: '<?php echo admin_url('admin-ajax.php'); ?>'
    })" class="container mx-auto px-4 pb-20">

        <div id="blog-posts-container" class="news-grid">
            <?php
            if ($blog_query->have_posts()) :
                $count = 0;
                while ($blog_query->have_posts()) : $blog_query->the_post();
                    $count++;
                    $pos = (($count - 1) % 10) + 1;

                    $classes = 'news-card h-full';
                    if ($pos === 4) {
                        $classes = 'news-card large large-left';
                    } elseif ($pos === 5) {
                        $classes = 'news-card pos-5';
                    } elseif ($pos === 10) {
                        $classes = 'news-card large large-right';
                    }

                    get_template_part('template-parts/content', 'blog-item', ['classes' => $classes]);
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <!-- ── See More Button ── -->
        <template x-if="page < maxPages">
            <div class="flex justify-center mt-12" data-aos="fade-up">
                <button
                    @click="loadMore()"
                    :disabled="loading"
                    class="btn btn-outline px-10 py-3 rounded-full text-sm transition-all hover:bg-primary hover:text-cream hover:border-primary disabled:opacity-50">
                    <span x-show="!loading">See more</span>
                    <span x-show="loading">Loading...</span>
                </button>
            </div>
        </template>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('blogLoader', (config) => ({
                page: config.page,
                maxPages: config.maxPages,
                category: config.category,
                ajaxUrl: config.ajaxUrl,
                loading: false,

                async loadMore() {
                    if (this.loading || this.page >= this.maxPages) return;

                    this.loading = true;
                    this.page++;

                    const formData = new FormData();
                    formData.append('action', 'load_more_posts');
                    formData.append('page', this.page);
                    formData.append('category', this.category);

                    try {
                        const response = await fetch(this.ajaxUrl, {
                            method: 'POST',
                            body: formData
                        });

                        if (!response.ok) throw new Error('Network response was not ok');

                        const html = await response.text();
                        if (html.trim()) {
                            const container = document.getElementById('blog-posts-container');
                            container.insertAdjacentHTML('beforeend', html);

                            // Re-init AOS for new elements if available
                            if (window.AOS) {
                                window.AOS.refreshHard();
                            }
                        } else {
                            this.maxPages = this.page; // No more posts
                        }
                    } catch (error) {
                        console.error('Error loading more posts:', error);
                        this.page--; // Revert page on error
                    } finally {
                        this.loading = false;
                    }
                }
            }));
        });
    </script>

    <?php if (!$blog_query->have_posts()) : ?>
        <div class="text-center py-20">
            <p class="body-medium text-dark/50">No posts found in this category.</p>
            <a href="<?php echo get_permalink(); ?>" class="btn btn-primary mt-6">View all posts</a>
        </div>
    <?php endif; ?>

    <?php get_template_part('template-parts/components/banner-cta'); ?>

</main>

<?php get_footer(); ?>