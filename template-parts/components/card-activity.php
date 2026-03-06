<?php
/**
 * Component: Card Activity
 * 
 * @param string $image URL of the image
 * @param string $title Activity title
 * @param string|null $advisor_text Optional text below title
 */

$image = $args['image'] ?? '';
$title = $args['title'] ?? '';
$advisor_text = $args['advisor_text'] ?? '';
?>
<div class="flex flex-col h-full hover:group">
    <div class="h-[300px] md:h-[350px] w-full rounded-2xl overflow-hidden mb-5">
        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>"
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
    </div>
    <div class="flex flex-col flex-1">
        <h4 class="font-body text-md md:text-lg font-normal text-dark mb-3">
            <?php echo esc_html($title); ?>
        </h4>

        <?php if ($advisor_text): ?>
            <p class="font-body text-[15px] font-light italic mt-auto text-neutral-gray pt-4">
                <?php echo esc_html($advisor_text); ?>
            </p>
        <?php endif; ?>
    </div>
</div>