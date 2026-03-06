<?php
/**
 * Banner Text Component
 * Similar to banner-cta but without a button.
 * Retrieves data from ACF field group "Banner Text".
 */

$banner_text = get_field('banner_text');

// Fallback defaults
$description = !empty($banner_text['text']) ? $banner_text['text'] : '';
$bg_image_url = !empty($banner_text['background_image']['url']) ? $banner_text['background_image']['url'] : get_template_directory_uri() . '/assets/images/default_banner.jpg';
?>
<section class="relative py-18 md:py-24 flex items-center justify-center text-center" data-aos="fade-in">
    <div class="absolute inset-0 z-0">
        <img src="<?php echo esc_url($bg_image_url); ?>" alt="<?php echo esc_attr(strip_tags($title)); ?>"
            class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-dark/60"></div>
    </div>
    <div class="container-site relative z-10 px-4" data-aos="fade-up" data-aos-delay="100">
        <?php if ($description): ?>
            <p class="font-body text-lg md:text-xl text-white mb-8 max-w-5xl mx-auto font-light leading-relaxed">
                <?php echo wp_kses_post($description); ?>
            </p>
        <?php endif; ?>
    </div>
</section>