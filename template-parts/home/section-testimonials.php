<?php
/**
 * Testimonials Section Template Part
 * Used in front-page and page-journeys
 */

$testimonials_title = get_field('testimonials_title', 'option') ?: 'Our Travelers Say';
$testimonials_desc = get_field('testimonials_description', 'option') ?: 'Authentic stories from travelers who chose us to "Celebrate Life in Peru".';
$testimonials_list = get_field('list_of_testimonials', 'option');
?>

<section class="py-24 bg-cream border-t border-neutral-gray/20">
    <div class="container-site">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-4 md:mb-10">
            <h2 class="font-heading text-3xl md:text-5xl text-dark min-w-fit mb-4 md:mb-0" data-aos="fade-up">
                <?php echo esc_html($testimonials_title); ?>
            </h2>
            <?php if ($testimonials_desc): ?>
                <span class="font-body text-sm text-neutral-black font-normal md:max-w-xs italic">
                    <?php echo esc_html($testimonials_desc); ?>
                </span>
            <?php endif; ?>
        </div>

        <?php if (!empty($testimonials_list)): ?>
            <!-- Embla Carousel Wrapper -->
            <div class="relative embla-testimonials" data-aos="fade-up" data-aos-delay="100">
                <!-- Viewport -->
                <div class="embla overflow-hidden">
                    <div class="embla__container flex">
                        <?php foreach ($testimonials_list as $index => $testimonial):
                            $image_url = isset($testimonial['testimony_image']['url']) && $testimonial['testimony_image']['url'] ? $testimonial['testimony_image']['url'] : get_template_directory_uri() . '/assets/images/intense_05.webp';
                            ?>
                            <?php get_template_part('template-parts/components/card-testimonial', null, [
                                'image' => $image_url,
                                'quote' => $testimonial['testimony'],
                                'author' => $testimonial['author'],
                                'origin' => $testimonial['author_origin'],
                                'date' => $testimonial['date'],
                                'stars' => $testimonial['stars']
                            ]); ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Navigation Controls -->
                <div
                    class="flex items-center gap-4 mt-8 lg:mt-0 lg:absolute lg:bottom-8 lg:right-12 z-10 justify-center lg:justify-end">

                    <!-- Prev -->
                    <button class="embla__prev group cursor-pointer disabled:opacity-30 disabled:cursor-not-allowed"
                        aria-label="Anterior">

                        <svg class="w-20 h-6" viewBox="0 0 100 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">

                            <line x1="95" y1="12" x2="10" y2="12" class="transition-all duration-300 group-hover:x2-[0]" />
                            <polyline points="20 4 10 12 20 20"
                                class="transition-all duration-300 group-hover:-translate-x-1" />
                        </svg>

                    </button>

                    <!-- Next -->
                    <button class="embla__next group cursor-pointer disabled:opacity-30 disabled:cursor-not-allowed"
                        aria-label="Siguiente">

                        <svg class="w-20 h-6" viewBox="0 0 100 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">

                            <line x1="5" y1="12" x2="90" y2="12" class="transition-all duration-300 group-hover:x2-[100]" />
                            <polyline points="80 4 90 12 80 20"
                                class="transition-all duration-300 group-hover:translate-x-1" />
                        </svg>

                    </button>

                </div>

            </div>
        <?php endif; ?>
    </div>
</section>