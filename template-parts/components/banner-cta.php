<?php

/**
 * CTA Banner Component
 * Fetches data from ACF field group "Banner CTA"
 */

$banner_cta = get_field('banner_cta');

// Defaults
$title = !empty($banner_cta['title']) ? $banner_cta['title'] : 'Looking for a deeper Andean and Altiplano experience?';
$description = !empty($banner_cta['description']) ? $banner_cta['description'] : 'Discover Bolivia with us — from the breathtaking Uyuni Salt Flats to vibrant La Paz and beyond.';

$button_text = 'Go to Intense Bolivia';
$button_url = '#';
$button_target = '';

if (!empty($banner_cta['button'])) {
    $button_text = $banner_cta['button']['title'];
    $button_url = $banner_cta['button']['url'];
    $button_target = !empty($banner_cta['button']['target']) ? $banner_cta['button']['target'] : '';
}

$bg_image_url = !empty($banner_cta['background_image']['url']) ? $banner_cta['background_image']['url'] : get_template_directory_uri() . '/assets/images/intense_cta_bolivia.webp';

?>
<section class="relative py-24 md:py-32 flex items-center justify-center text-center" data-aos="fade-in">
    <div class="absolute inset-0 z-0">
        <img src="<?php echo esc_url($bg_image_url); ?>" alt="<?php echo esc_attr(strip_tags($title)); ?>"
            class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-dark/60"></div>
    </div>
    <div class="container-site relative z-10 px-4" data-aos="fade-up" data-aos-delay="100">
        <h2
            class="font-heading text-3xl md:text-4xl lg:text-5xl leading-tight text-white mb-6 md:mb-8 max-w-6xl mx-auto">
            <?php echo esc_html($title); ?>
        </h2>
        <?php if ($description): ?>
            <p class="font-body text-lg text-white mb-8 max-w-4xl mx-auto font-light">
                <?php echo wp_kses_post($description); ?>
            </p>
        <?php endif; ?>

        <?php if ($button_url && $button_text): ?>
            <?php get_template_part('template-parts/components/btn-outline', null, [
                'text' => $button_text,
                'href' => $button_url,
                'target' => $button_target,
                'color' => 'light',
                'class_extra' => 'px-10 text-base'
            ]); ?>
        <?php endif; ?>
    </div>
</section>