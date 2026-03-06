<?php
/**
 * Testimonial Card Component
 *
 * @param array $args {
 *     @type string $image  Image URL.
 *     @type string $quote  Testimonial text.
 *     @type string $author Author name.
 *     @type string $origin Author origin.
 *     @type string $date   Travel date.
 *     @type int    $stars  Number of stars (1-5).
 * }
 */

$image = $args['image'] ?? '';
$quote = $args['quote'] ?? '';
$author = $args['author'] ?? '';
$origin = $args['origin'] ?? '';
$date = $args['date'] ?? '';
$stars = $args['stars'] ?? 5;
?>
<div class="embla__slide flex-[0_0_100%] min-w-0">
    <div class="grid grid-cols-1 lg:grid-cols-[40%_60%] gap-8 items-center p-2">
        <!-- Image -->
        <div class="order-1 lg:order-1">
            <div class="relative rounded-lg overflow-hidden max-w-lg aspect-[4/3] lg:aspect-auto h-full">
                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($author); ?>"
                    class="w-full h-full object-cover text-transparent absolute inset-0 lg:static">
            </div>
        </div>
        <!-- Text / Testimonial -->
        <div class="order-2 lg:order-2">
            <div class="p-8 bg-white h-full flex flex-col justify-center">
                <div class="flex text-gold mb-6">
                    <!-- Stars -->
                    <?php for ($s = 0; $s < 5; $s++): ?>
                        <svg class="w-6 h-6 <?php echo $s < $stars ? 'fill-current' : 'fill-neutral-gray/30'; ?>"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    <?php endfor; ?>
                </div>
                <blockquote class="font-heading text-xl md:text-3xl text-dark leading-snug mb-8">
                    "
                    <?php echo esc_html($quote); ?>"
                </blockquote>
                <p class="font-body text-lg text-neutral-black font-medium mb-1">
                    <?php echo esc_html($author); ?>
                    <?php if ($origin)
                        echo ' - ' . esc_html($origin); ?>
                </p>
                <?php if ($date): ?>
                    <p class="font-body text-sm text-neutral-gray">
                        Traveled in
                        <?php echo esc_html($date); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>