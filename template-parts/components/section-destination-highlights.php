<?php

/**
 * Destination Highlights Section
 */

$highlights = get_field('destination_highlights');
if ($highlights && !empty($highlights['features'])) :
    $features = $highlights['features'];
?>
    <!-- B. Content Section (Highlights) -->
    <section class="py-20 bg-cream">
        <div class="container-site">
            <div class="flex flex-wrap justify-center items-stretch max-w-4xl mx-auto gap-y-12 md:gap-y-16">
                <?php foreach ($features as $index => $feature) :
                    $image = $feature['image_feature'];
                    $title = $feature['title_feature'];
                ?>
                    <div class="w-1/2 md:w-1/3 flex flex-col items-center px-4 md:px-8 border-dark/20 border-r even:border-r-0 md:even:border-r md:nth-[3n]:border-r-0 last:border-r-0" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                        <?php if ($image) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>" class="h-16 w-auto object-contain mb-6">
                        <?php endif; ?>

                        <?php if ($title) : ?>
                            <span class="font-body text-dark text-sm md:text-base font-medium text-center leading-tight">
                                <?php echo esc_html($title); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>