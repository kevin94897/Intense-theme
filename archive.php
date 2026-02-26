<?php

/**
 * Template para archivos — categorías, tags, fechas, autores
 *
 * @package intense-nerd-theme
 */
get_header();
?>

<main id="main" class="site-main" role="main">

    <!-- Archive Hero -->
    <div class="bg-dark py-20" data-aos="fade-up">
        <div class="container-site text-center">
            <?php the_archive_title('<h1 class="heading-2 text-cream">', '</h1>'); ?>
            <?php the_archive_description('<div class="body-large text-cream/70 mt-4 max-w-xl mx-auto">', '</div>'); ?>
        </div>
    </div>

    <!-- Posts Grid -->
    <div class="container-site py-16">

        <?php if (have_posts()) : ?>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                $i = 0;
                while (have_posts()) :
                    the_post();
                    $delay = ($i % 3) * 100;
                ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>
                        data-aos="fade-up" data-aos-delay="<?php echo esc_attr($delay); ?>">

                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                                <?php the_post_thumbnail('card-thumb', [
                                    'class'   => 'card-img',
                                    'loading' => 'lazy',
                                    'alt'     => esc_attr(get_the_title()),
                                ]); ?>
                            </a>
                        <?php endif; ?>

                        <div class="card-body">
                            <span class="body-small-it text-gold uppercase tracking-wide block mb-2">
                                <?php echo esc_html(get_the_date()); ?>
                            </span>
                            <h2 class="card-title mb-2">
                                <a href="<?php the_permalink(); ?>"
                                    class="text-neutral-black hover:text-primary transition-colors duration-200">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <p class="card-text mb-4"><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-outline text-sm">
                                <?php esc_html_e('Leer más', 'intense-nerd-theme'); ?>
                            </a>
                        </div>
                    </article>
                <?php
                    $i++;
                endwhile;
                ?>
            </div>

            <!-- Paginación -->
            <div class="mt-16 flex justify-center" data-aos="fade-up">
                <?php
                the_posts_pagination([
                    'mid_size'  => 2,
                    'prev_text' => '&larr; ' . __('Anterior', 'intense-nerd-theme'),
                    'next_text' => __('Siguiente', 'intense-nerd-theme') . ' &rarr;',
                ]);
                ?>
            </div>

        <?php else : ?>

            <div class="text-center py-24" data-aos="fade-up">
                <h2 class="heading-3 text-dark mb-4">
                    <?php esc_html_e('Sin artículos en esta categoría', 'intense-nerd-theme'); ?>
                </h2>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                    <?php esc_html_e('Ir al inicio', 'intense-nerd-theme'); ?>
                </a>
            </div>

        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>