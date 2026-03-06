<?php

/**
 * FAQ Section Component
 *
 * @param array $args {
 *     @type string $title       The section title.
 *     @type string $description The section description.
 *     @type array  $faqs        Array of FAQs, each with 'question' and 'response'.
 * }
 * @package Intense_Theme
 */

$title = $args['title'] ?? 'FAQ';
$description = $args['description'] ?? '';
$faqs = $args['faqs'] ?? [];
?>
<section class="py-24 bg-cream" id="faq">
    <div class="container-site">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-24 items-start">

            <!-- Left Column: Title & Icon -->
            <div class="lg:col-span-4" data-aos="fade-right">
                <div class="flex flex-col gap-6 lg:sticky lg:top-32">
                    <div class="flex items-center gap-4">
                        <svg class="w-12 h-auto" viewBox="0 0 65 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M31.9972 27.997L18.8042 20.418L31.9972 12.8391L45.1902 20.418L31.9972 27.997Z" stroke="#7B4424" stroke-width="1.12281" />
                            <path d="M31.9973 22.3832L28.3481 20.4183L31.9973 18.4534L35.6464 20.4183L31.9973 22.3832Z" fill="#B76739" stroke="#B76739" stroke-width="1.12281" />
                            <path d="M9.26025 0.488281L31.9971 13.4006L54.734 0.488281" stroke="#7B4424" stroke-width="1.12281" />
                            <path d="M54.7339 40.3481L31.997 27.4359L9.26017 40.3481" stroke="#7B4424" stroke-width="1.12281" />
                            <path d="M23.2954 3.29541L32.2779 8.90945L41.2603 3.29541" stroke="#B76739" stroke-width="1.12281" />
                            <path d="M41.2603 37.541L32.2778 31.927L23.2953 37.541" stroke="#B76739" stroke-width="1.12281" />
                            <path d="M64.2779 8.90942L44.0674 20.4182L64.2779 31.927" stroke="#B76739" stroke-width="1.12281" />
                            <path d="M0.277743 8.90942L20.4883 20.4182L0.277743 31.927" stroke="#B76739" stroke-width="1.12281" />
                        </svg>
                        <h2 class="font-heading text-4xl lg:text-[40px] text-dark font-normal tracking-wide"><?php echo esc_html($title); ?></h2>
                    </div>
                    <?php if ($description) : ?>
                        <p class="font-body text-neutral-black text-lg font-light leading-relaxed">
                            <?php echo esc_html($description); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right Column: Accordion -->
            <div class="lg:col-span-8" data-aos="fade-up" data-aos-delay="100">
                <div x-data="{ activeAccordion: 0 }" class="w-full">
                    <?php foreach ($faqs as $index => $faq) : $idx = $index + 1; ?>
                        <!-- Item <?php echo $idx; ?> -->
                        <div class="border-b-2 border-neutral-gray/30">
                            <button @click="activeAccordion = activeAccordion === <?php echo $idx; ?> ? null : <?php echo $idx; ?>" class="w-full flex justify-between items-center py-6 text-left focus:outline-none group">
                                <span class="font-body text-base lg:text-lg font-medium text-dark group-hover:text-primary transition-colors duration-300"><?php echo esc_html($faq['question']); ?></span>
                                <span class="text-primary transition-transform duration-300 transform" :class="activeAccordion === <?php echo $idx; ?> ? 'rotate-180' : ''">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </span>
                            </button>
                            <div class="grid transition-[grid-template-rows,opacity] duration-300 ease-in-out" :class="activeAccordion === <?php echo $idx; ?> ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                                <div class="overflow-hidden">
                                    <div class="pb-8 pr-4 lg:pr-12 font-body font-light text-sm lg:text-[15px] leading-relaxed space-y-4">
                                        <?php echo wp_kses_post($faq['response']); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</section>