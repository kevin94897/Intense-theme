<?php

/**
 * Template para páginas estáticas de WordPress
 *
 * @package intense-nerd-theme
 */
get_header();
?>

<main id="main" class="site-main" role="main">

    <?php while (have_posts()) : the_post(); ?>

        <!-- Page Hero (solo si tiene imagen destacada) -->
        <?php if (has_post_thumbnail()) : ?>
            <div class="relative h-64 md:h-96 overflow-hidden">
                <?php the_post_thumbnail('hero-banner', [
                    'class'       => 'w-full h-full object-cover',
                    'loading'     => 'eager',
                    'fetchpriority' => 'high',
                    'alt'         => esc_attr(get_the_title()),
                ]); ?>
                <div class="absolute inset-0 bg-dark/50 flex items-end">
                    <div class="container-site pb-12">
                        <h1 class="heading-2 text-cream" data-aos="fade-up">
                            <?php the_title(); ?>
                        </h1>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <!-- Título sin imagen -->
            <div class="bg-cream border-b border-neutral-gray py-16">
                <div class="container-site">
                    <h1 class="heading-2 text-dark" data-aos="fade-up">
                        <?php the_title(); ?>
                    </h1>
                </div>
            </div>
        <?php endif; ?>

        <!-- Contenido de la página -->
        <div class="container-site py-16">
            <div class="max-w-3xl mx-auto">

                <div class="prose prose-lg max-w-none
                    [&_h2]:heading-2-bold [&_h2]:text-dark [&_h2]:mb-4 [&_h2]:mt-10
                    [&_h3]:heading-3-bold [&_h3]:text-dark [&_h3]:mb-3 [&_h3]:mt-8
                    [&_p]:body-medium [&_p]:text-neutral-black [&_p]:mb-4
                    [&_a]:text-primary [&_a]:underline [&_a:hover]:text-hover
                    [&_ul]:list-disc [&_ul]:pl-6 [&_ul]:mb-4
                    [&_ol]:list-decimal [&_ol]:pl-6 [&_ol]:mb-4
                    [&_li]:body-small [&_li]:text-neutral-black [&_li]:mb-1"
                    data-aos="fade-up">
                    <?php the_content(); ?>
                </div>

                <!-- Paginación de páginas largas -->
                <?php
                wp_link_pages([
                    'before'      => '<nav class="mt-12 flex gap-4" aria-label="' . esc_attr__('Páginas del artículo', 'intense-nerd-theme') . '">',
                    'after'       => '</nav>',
                    'link_before' => '<span class="btn btn-outline text-sm">',
                    'link_after'  => '</span>',
                ]);
                ?>
            </div>
        </div>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>