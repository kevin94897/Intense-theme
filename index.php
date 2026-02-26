<?php

/**
 * Template principal — fallback para todos los tipos de contenido
 *
 * @package intense-nerd-theme
 */
get_header();
?>

<main id="main" class="site-main" role="main">
    <div class="container-site py-16">

        <?php if (have_posts()) : ?>

            <!-- Título de sección -->
            <header class="mb-12" data-aos="fade-up">
                <?php
                if (is_home() && ! is_front_page()) {
                    single_post_title('<h1 class="heading-2 text-dark">', '</h1>');
                } elseif (is_archive()) {
                    the_archive_title('<h1 class="heading-2 text-dark">', '</h1>');
                    the_archive_description('<div class="body-large text-neutral-gray mt-4">', '</div>');
                } elseif (is_search()) {
                    printf(
                        '<h1 class="heading-2 text-dark">%s <span class="text-primary">%s</span></h1>',
                        esc_html__('Resultados para:', 'intense-nerd-theme'),
                        esc_html(get_search_query())
                    );
                }
                ?>
            </header>

            <!-- Grid de posts -->
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
                            <!-- Categoría -->
                            <?php
                            $categories = get_the_category();
                            if ($categories) :
                                $cat = $categories[0];
                            ?>
                                <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
                                    class="body-small-it text-primary uppercase tracking-wide mb-2 block hover:text-hover transition-colors duration-200">
                                    <?php echo esc_html($cat->name); ?>
                                </a>
                            <?php endif; ?>

                            <!-- Título -->
                            <h2 class="card-title mb-2">
                                <a href="<?php the_permalink(); ?>"
                                    class="text-neutral-black hover:text-primary transition-colors duration-200">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <!-- Excerpt -->
                            <p class="card-text mb-4">
                                <?php the_excerpt(); ?>
                            </p>

                            <!-- Leer más -->
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
                    'mid_size'           => 2,
                    'prev_text'          => '&larr; ' . __('Anterior', 'intense-nerd-theme'),
                    'next_text'          => __('Siguiente', 'intense-nerd-theme') . ' &rarr;',
                    'before_page_number' => '<span class="sr-only">' . __('Página', 'intense-nerd-theme') . ' </span>',
                ]);
                ?>
            </div>

        <?php else : ?>

            <!-- Sin resultados -->
            <div class="text-center py-24" data-aos="fade-up">
                <h2 class="heading-3 text-dark mb-4">
                    <?php esc_html_e('No se encontró contenido', 'intense-nerd-theme'); ?>
                </h2>
                <p class="body-large text-neutral-gray mb-8">
                    <?php esc_html_e('Intenta con una búsqueda diferente o regresa al inicio.', 'intense-nerd-theme'); ?>
                </p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                    <?php esc_html_e('Ir al inicio', 'intense-nerd-theme'); ?>
                </a>
            </div>

        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>