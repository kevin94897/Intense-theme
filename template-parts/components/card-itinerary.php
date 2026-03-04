<?php

/**
 * Componente: Card Itinerary
 *
 * Uso:
 *   get_template_part( 'template-parts/components/card-itinerary', null, [
 *     'image'        => $imagen_url,
 *     'title'        => $titulo,
 *     'price'        => $precio,
 *     'duration'     => $duracion,
 *     'destinations' => $destinos,
 *     'link'         => $url,
 *     'link_text'    => 'Explore itineraries',
 *     'aos_delay'    => 0,
 *     'badges'       => ['New', 'Top seller'] // array
 *   ] )
 */

$image        = $args['image']        ?? '';
$title        = $args['title']        ?? '';
$price        = $args['price']        ?? '';
$duration     = $args['duration']     ?? '';
$destinations = $args['destinations'] ?? '';
$link         = $args['link']         ?? '#';
$link_text    = $args['link_text']    ?? 'Explore itineraries';
$aos_delay    = $args['aos_delay']    ?? 0;
$badges       = $args['badges']       ?? [];
?>

<article class="flex flex-col group w-full" data-aos="fade-up" data-aos-delay="<?php echo esc_attr($aos_delay); ?>">
    <!-- Image Wrapper -->
    <div class="relative w-full aspect-[4/5] overflow-hidden mb-6 rounded-sm">
        <?php if ($image) : ?>
            <a href="<?php echo esc_url($link); ?>" tabindex="-1" class="block w-full h-full">
                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
            </a>
        <?php endif; ?>

        <!-- Badges -->
        <?php if (!empty($badges)) : ?>
            <div class="absolute top-4 left-4 flex flex-wrap gap-2 pointer-events-none">
                <?php foreach ($badges as $badge) : ?>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-neutral-gray/50 backdrop-blur-md text-white font-body text-[13px] font-light tracking-wide shadow-sm">
                        <?php if (strtolower($badge) === 'new') : ?>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 3h12l4 6-10 13L2 9Z" />
                                <path d="M11 3 8 9l4 13 4-13-3-6" />
                                <path d="M2 9h20" />
                            </svg>
                        <?php elseif (strtolower($badge) === 'top seller') : ?>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6" />
                                <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18" />
                                <path d="M4 22h16" />
                                <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22" />
                                <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22" />
                                <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z" />
                            </svg>
                        <?php endif; ?>
                        <span><?php echo esc_html($badge); ?></span>
                    </span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Content -->
    <div class="flex flex-col flex-1">
        <!-- Title & Price -->
        <div class="flex flex-wrap justify-between items-baseline gap-2 mb-4 font-bold">
            <h3 class="font-heading text-lg md:text-xl leading-tight text-dark m-0 max-w-[65%]">
                <a href="<?php echo esc_url($link); ?>" class="hover:text-primary transition-colors">
                    <?php echo esc_html($title); ?>
                </a>
            </h3>
            <span class="font-heading text-lg md:text-xl text-dark shrink-0">
                <?php echo esc_html($price); ?>
            </span>
        </div>

        <!-- Meta -->
        <div class="flex items-start gap-4 mb-8">
            <!-- Duration -->
            <div class="flex items-center gap-2 shrink-0 pt-1">
                <svg class="text-dark/70 shrink-0" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M12 6v6l4 2" />
                </svg>
                <span class="font-body text-xs md:text-sm italic text-dark/80 font-medium whitespace-nowrap">
                    <?php echo esc_html($duration); ?>
                </span>
            </div>

            <!-- Divider -->
            <div class="w-px h-[24px] bg-neutral-black/30 shrink-0 mt-1"></div>

            <!-- Destinations -->
            <div class="flex items-start gap-2 pt-1">
                <svg class="text-dark/70 shrink-0 mt-[3px]" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                    <circle cx="12" cy="10" r="3" />
                </svg>
                <span class="font-body text-xs md:text-sm italic text-dark/80 leading-snug">
                    <?php echo esc_html($destinations); ?>
                </span>
            </div>
        </div>

        <!-- Button -->
        <div class="mt-auto">
            <a href="<?php echo esc_url($link); ?>" class="btn btn-outline w-full rounded-full border-neutral-black text-neutral-black hover:bg-neutral-black hover:text-white transition-colors duration-300 text-base py-3">
                <?php echo esc_html($link_text); ?>
            </a>
        </div>
    </div>
</article>