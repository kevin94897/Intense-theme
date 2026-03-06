<?php

/**
 * Hotel Card Component
 *
 * @param array $args {
 *     @type string $image       URL of the hotel image.
 *     @type string $title       Name of the hotel.
 *     @type int    $stars       Number of stars (1-5).
 *     @type string $type        Type of accommodation (e.g. Boutique).
 *     @type string $expedia     Expedia rating.
 *     @type string $booking     Booking rating.
 *     @type string $location    Location string (e.g. Máncora, Piura).
 *     @type string $description Short description of the hotel.
 *     @type string $video_link  URL to the hotel video.
 *     @type array  $web_ratings Array of ratings from the rating_web repeater [['web_name' => 'Booking', 'rating_number' => '9.5']].
 *     @type array  $amenities   Array of amenities, e.g. [['icon' => 'svg', 'text' => 'Beachfront']].
 * }
 */

$image = $args['image'] ?? '';
$title = $args['title'] ?? 'Hotel Name';
$stars = intval($args['stars'] ?? 5);
$type = $args['type'] ?? 'Hotel';
$location = $args['location'] ?? 'Location';
$description = $args['description'] ?? 'Description of the hotel.';
$video_link = $args['video_link'] ?? '#';
$web_ratings = $args['web_ratings'] ?? [];
$amenities = $args['amenities'] ?? [];
?>

<div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start mb-12">
    <!-- Image -->
    <div class="md:col-span-5 lg:col-span-4">
        <div class="aspect-square w-full rounded-xl overflow-hidden shadow-sm">
            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>"
                class="w-full h-full object-cover">
        </div>
    </div>

    <!-- Content -->
    <div class="md:col-span-7 lg:col-span-8">
        <h4 class="font-heading text-xl md:text-2xl text-dark mb-3">
            <?php echo esc_html($title); ?>
        </h4>

        <!-- Ratings & Info Row -->
        <div class="flex flex-wrap items-center gap-3 font-body text-neutral-black text-sm mb-3">
            <!-- Stars -->
            <div class="flex items-center text-[#FFC700]">
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <svg class="w-4 h-4 <?php echo $i < $stars ? 'fill-current' : 'text-neutral-gray/30 fill-current'; ?>"
                        viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                <?php endfor; ?>
            </div>

            <!-- <span class="text-neutral-gray/50">|</span>
            <span>
                <?php echo esc_html($type); ?>
            </span> -->

            <?php if (!empty($web_ratings)) : ?>
                <?php foreach ($web_ratings as $rating_item) :
                    $web_name = $rating_item['web_name'] ?? '';
                    $score = $rating_item['rating_number'] ?? '';
                    if ($web_name && $score) :
                ?>
                        <span class="text-neutral-gray/50">|</span>
                        <span><?php echo esc_html($web_name); ?>
                            <?php echo esc_html($score); ?>
                        </span>
                <?php endif;
                endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Location -->
        <div class="flex items-center gap-2 font-body text-sm italic mb-6">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <?php echo esc_html($location); ?>
        </div>

        <!-- Description -->
        <p class="font-body text-neutral-black text-sm md:text-[15px] font-light leading-relaxed mb-6 max-w-4xl">
            <?php echo esc_html($description); ?>
        </p>

        <!-- Video Link -->
        <!-- <?php if ($video_link && $video_link !== '#'): ?> -->
        <a href="<?php echo esc_url($video_link); ?>"
            class="inline-flex items-center gap-2 font-body text-sm transition-colors italic mb-8" target="_blank">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                </path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Watch hotel video
        </a>
        <!-- <?php endif; ?> -->

        <!-- Amenities -->
        <?php if (!empty($amenities)): ?>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-y-4 gap-x-6">
                <?php foreach ($amenities as $amenity): ?>
                    <div class="flex items-center gap-3 font-body text-sm font-light">
                        <span class="w-5 h-5 flex items-center justify-center shrink-0">
                            <?php echo $amenity['icon']; // Assuming trusted SVG markup 
                            ?>
                        </span>
                        <?php echo esc_html($amenity['text']); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>