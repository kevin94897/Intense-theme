<?php

/**
 * Componente: Card reutilizable
 *
 * Uso:
 *   get_template_part( 'template-parts/components/card', null, [
 *     'image'       => $imagen_url,      // string URL
 *     'image_alt'   => $alt_text,        // string
 *     'category'    => $categoria,       // string (opcional)
 *     'title'       => $titulo,          // string
 *     'description' => $descripcion,     // string (opcional)
 *     'link'        => $url,             // string URL
 *     'link_text'   => 'Ver más',        // string (opcional)
 *     'aos_delay'   => 0,                // int ms (opcional)
 *   ] )
 *
 * @package intense-nerd-theme
 */

$image       = $args['image']       ?? '';
$image_alt   = $args['image_alt']   ?? '';
$category    = $args['category']    ?? '';
$title       = $args['title']       ?? '';
$description = $args['description'] ?? '';
$link        = $args['link']        ?? '#';
$link_text   = $args['link_text']   ?? __('Ver más', 'intense-nerd-theme');
$aos_delay   = $args['aos_delay']   ?? 0;
?>

<article class="card" data-aos="fade-up" data-aos-delay="<?php echo esc_attr($aos_delay); ?>">

    <?php if ($image) : ?>
        <a href="<?php echo esc_url($link); ?>" tabindex="-1" aria-hidden="true">
            <img src="<?php echo esc_url($image); ?>"
                alt="<?php echo esc_attr($image_alt); ?>"
                class="card-img"
                loading="lazy">
        </a>
    <?php endif; ?>

    <div class="card-body">

        <?php if ($category) : ?>
            <span class="body-small-it text-primary uppercase tracking-wide block mb-2">
                <?php echo esc_html($category); ?>
            </span>
        <?php endif; ?>

        <?php if ($title) : ?>
            <h3 class="card-title">
                <?php if ($link) : ?>
                    <a href="<?php echo esc_url($link); ?>"
                        class="text-neutral-black hover:text-primary transition-colors duration-200">
                        <?php echo esc_html($title); ?>
                    </a>
                <?php else : ?>
                    <?php echo esc_html($title); ?>
                <?php endif; ?>
            </h3>
        <?php endif; ?>

        <?php if ($description) : ?>
            <p class="card-text mt-2 mb-4">
                <?php echo wp_kses_post($description); ?>
            </p>
        <?php endif; ?>

        <?php if ($link) : ?>
            <a href="<?php echo esc_url($link); ?>" class="btn btn-outline text-sm mt-auto">
                <?php echo esc_html($link_text); ?>
            </a>
        <?php endif; ?>
    </div>
</article>