<?php

/**
 * Template part for displaying blog items in the listing grid
 */

$classes = $args['classes'] ?? 'news-card';
$is_large = strpos($classes, 'large') !== false;
$reading_time = (function_exists('get_field')) ? get_field('reading_time') : '5-minute read';
if (!$reading_time) $reading_time = '5-minute read';
?>

<article <?php post_class($classes); ?>>
    <?php if ($is_large) : ?>
        <a href="<?php the_permalink(); ?>" class="card-img-wrap block h-full">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large', ['class' => 'card-img']); ?>
            <?php else : ?>
                <img class="card-img" src="https://images.unsplash.com/photo-1501594907352-04cda38ebc29?w=900&q=80" alt="<?php the_title_attribute(); ?>" />
            <?php endif; ?>
            <div class="card-overlay"></div>
            <div class="card-body p-6 flex flex-col h-full">
                <h3 class="card-title font-display heading-3-small font-semibold leading-snug mb-2 mt-auto">
                    <?php the_title(); ?>
                </h3>
                <div class="card-meta flex items-center gap-3 text-xs font-body">
                    <span class="flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 6v6l4 2" />
                        </svg>
                        <?php echo esc_html($reading_time); ?>
                    </span>
                    <span class="flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <path d="M16 2v4M8 2v4M3 10h18" />
                        </svg>
                        <?php echo get_the_date(); ?>
                    </span>
                </div>
            </div>
        </a>

    <?php else : ?>
        <div class="card-img-wrap">
            <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium_large', ['class' => 'card-img']); ?>
                <?php else : ?>
                    <img class="card-img" src="https://images.unsplash.com/photo-1526392060635-9d6019884377?w=600&q=80" alt="<?php the_title_attribute(); ?>" />
                <?php endif; ?>
            </a>
        </div>
        <div class="pt-4 flex flex-col flex-1">
            <h3 class="font-display font-semibold leading-snug mb-3 flex-1 heading-3-small">
                <a href="<?php the_permalink(); ?>" class="hover:text-primary transition-colors">
                    <?php the_title(); ?>
                </a>
            </h3>
            <div class="card-meta flex items-center gap-3 text-xs text-ink/50 font-body mt-auto">
                <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 6v6l4 2" />
                    </svg>
                    <?php echo esc_html($reading_time); ?>
                </span>
                <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" />
                        <path d="M16 2v4M8 2v4M3 10h18" />
                    </svg>
                    <?php echo get_the_date(); ?>
                </span>
                <a href="<?php the_permalink(); ?>" class="ml-auto card-arrow text-base">
                    <svg width="53" height="17" viewBox="0 0 53 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M44.3477 1L51.2347 8.5M51.2347 8.5L44.3477 16M51.2347 8.5H1" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                </a>
            </div>
        </div>
    <?php endif; ?>
</article>