<?php

/**
 * Componente: Story Card
 *
 * @package intense-nerd-theme
 */

$image       = $args['image']       ?? '';
$image_alt   = $args['image_alt']   ?? '';
$title       = $args['title']       ?? '';
$read_time   = $args['read_time']   ?? '';
$date        = $args['date']        ?? '';
$link        = $args['link']        ?? '#';
$aos_delay   = $args['aos_delay']   ?? 0;
?>

<article class="group relative flex flex-col gap-4 h-full" data-aos="fade-up" data-aos-delay="<?php echo esc_attr($aos_delay); ?>">
    <!-- Image -->
    <?php if ($image) : ?>
        <div class="relative overflow-hidden aspect-[4/3] w-full mb-2">
            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
        </div>
    <?php endif; ?>

    <!-- Title -->
    <?php if ($title) : ?>
        <h3 class="font-heading text-2xl lg:text-[28px] text-dark leading-snug group-hover:text-primary transition-colors duration-300">
            <a href="<?php echo esc_url($link); ?>" class="before:absolute before:inset-0">
                <?php echo esc_html($title); ?>
            </a>
        </h3>
    <?php endif; ?>

    <!-- Meta footer -->
    <div class="mt-auto pt-4 flex items-center justify-between text-neutral-gray text-sm font-body w-full">
        <div class="flex items-center gap-4">
            <!-- Read Time -->
            <?php if ($read_time) : ?>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-dark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <span class="text-neutral-black"><?php echo esc_html($read_time); ?></span>
                </div>
            <?php endif; ?>

            <?php if ($read_time && $date): ?>
                <span class="text-neutral-gray/50">|</span>
            <?php endif; ?>

            <!-- Date -->
            <?php if ($date) : ?>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-dark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <span class="text-neutral-black"><?php echo esc_html($date); ?></span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Arrow -->
        <svg class="w-12 h-6 text-dark transition-transform duration-300 group-hover:translate-x-2" viewBox="0 0 40 10" fill="none" stroke="currentColor" stroke-width="1.5">
            <line x1="0" y1="5" x2="38" y2="5"></line>
            <polyline points="34 1 39 5 34 9"></polyline>
        </svg>
    </div>
</article>