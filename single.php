<?php

/**
 * Template para entradas del blog
 *
 * @package intense-nerd-theme
 */
get_header();
?>

<main id="main" class="site-main" role="main">

    <?php while (have_posts()) : the_post(); ?>

        <!-- Hero del artículo -->
        <?php if (has_post_thumbnail()) : ?>
            <div class="relative h-72 md:h-[500px] overflow-hidden">
                <?php the_post_thumbnail('hero-banner', [
                    'class'         => 'w-full h-full object-cover',
                    'loading'       => 'eager',
                    'fetchpriority' => 'high',
                    'alt'           => esc_attr(get_the_title()),
                ]); ?>
                <div class="absolute inset-0 bg-gradient-to-t from-dark/80 to-transparent flex items-end">
                    <div class="container-site pb-12">
                        <!-- Categoría -->
                        <?php
                        $categories = get_the_category();
                        if ($categories) :
                            $cat = $categories[0];
                        ?>
                            <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
                                class="inline-block body-small-it text-gold uppercase tracking-widest mb-3
                        hover:text-primary transition-colors duration-200">
                                <?php echo esc_html($cat->name); ?>
                            </a>
                        <?php endif; ?>
                        <h1 class="heading-2 text-cream max-w-3xl" data-aos="fade-up">
                            <?php the_title(); ?>
                        </h1>
                        <p class="body-small text-cream/70 mt-4">
                            <?php
                            printf(
                                /* translators: 1: author name, 2: date */
                                esc_html__('Por %1$s · %2$s', 'intense-nerd-theme'),
                                '<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '" class="hover:text-primary transition-colors">' . esc_html(get_the_author()) . '</a>',
                                esc_html(get_the_date())
                            );
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="bg-cream border-b border-neutral-gray py-16">
                <div class="container-site">
                    <h1 class="heading-2 text-dark max-w-3xl" data-aos="fade-up">
                        <?php the_title(); ?>
                    </h1>
                    <p class="body-small text-neutral-gray mt-4">
                        <?php
                        printf(
                            esc_html__('Por %1$s · %2$s', 'intense-nerd-theme'),
                            esc_html(get_the_author()),
                            esc_html(get_the_date())
                        );
                        ?>
                    </p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Contenido del artículo -->
        <div class="container-site py-16">
            <div class="max-w-2xl mx-auto">

                <article class="[&_h2]:heading-3-bold [&_h2]:text-dark [&_h2]:mb-4 [&_h2]:mt-10
                        [&_h3]:heading-3-small [&_h3]:text-dark [&_h3]:mb-3 [&_h3]:mt-8
                        [&_p]:body-medium-r [&_p]:text-neutral-black [&_p]:mb-5
                        [&_a]:text-primary [&_a]:underline [&_a:hover]:text-hover
                        [&_img]:w-full [&_img]:rounded-lg [&_img]:my-8
                        [&_blockquote]:border-l-4 [&_blockquote]:border-primary
                        [&_blockquote]:pl-6 [&_blockquote]:italic [&_blockquote]:text-neutral-gray
                        [&_ul]:list-disc [&_ul]:pl-6 [&_ul]:mb-4
                        [&_ol]:list-decimal [&_ol]:pl-6 [&_ol]:mb-4
                        [&_li]:body-small [&_li]:text-neutral-black [&_li]:mb-2"
                    data-aos="fade-up">
                    <?php the_content(); ?>
                </article>

                <!-- Tags -->
                <?php
                $tags = get_the_tags();
                if ($tags) :
                ?>
                    <div class="mt-12 flex flex-wrap gap-2" data-aos="fade-up">
                        <?php foreach ($tags as $tag) : ?>
                            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"
                                class="body-small text-neutral-black border border-neutral-gray rounded-full px-4 py-1
                        hover:bg-primary hover:text-white hover:border-primary transition-all duration-200">
                                #<?php echo esc_html($tag->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Navegación entre artículos -->
                <nav class="mt-16 grid grid-cols-2 gap-6 border-t border-neutral-gray pt-8" aria-label="<?php esc_attr_e('Artículos', 'intense-nerd-theme'); ?>">
                    <div>
                        <?php previous_post_link(
                            '<div class="body-small-it text-neutral-gray mb-1">' . esc_html__('← Anterior', 'intense-nerd-theme') . '</div><a href="%link" class="heading-3-small text-dark hover:text-primary transition-colors duration-200">%title</a>',
                            '%title'
                        ); ?>
                    </div>
                    <div class="text-right">
                        <?php next_post_link(
                            '<div class="body-small-it text-neutral-gray mb-1">' . esc_html__('Siguiente →', 'intense-nerd-theme') . '</div><a href="%link" class="heading-3-small text-dark hover:text-primary transition-colors duration-200">%title</a>',
                            '%title'
                        ); ?>
                    </div>
                </nav>

            </div>
        </div>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>