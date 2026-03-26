<?php

/**
 * Template Name: Nosotros
 *
 * ACF Fields (About Us group, Page ID 206):
 *   story (group)
 *     ├── message     (text)
 *     ├── image       (image array)
 *     ├── title       (text)
 *     └── description (wysiwyg)
 *   counter (group)
 *     └── list_of_values (repeater)
 *           ├── value (text)
 *           └── text  (text)
 *   meet_the_team (group)
 *     ├── image        (image array)
 *     ├── title        (text)
 *     ├── description  (text)
 *     └── team_members (gallery array)
 *   motivation (group)
 *     ├── title        (text)
 *     ├── image        (image array)
 *     └── list_of_purposes (repeater)
 *           ├── purpose_title       (text)
 *           └── purpose_description (textarea)
 *   alternative_text (group)
 *     ├── image   (image array)
 *     ├── title   (text)
 *     ├── text    (wysiwyg)
 *     └── message (text)
 *
 * @package intense-nerd-theme
 */
get_header();

$story           = get_field('story')            ?: [];
$counter         = get_field('counter')          ?: [];
$meet_the_team   = get_field('meet_the_team')    ?: [];
$motivation      = get_field('motivation')       ?: [];
$alternative_txt = get_field('alternative_text') ?: [];

$story_msg    = $story['message']     ?? '';
$story_img    = $story['image']       ?? [];
$story_title  = $story['title']       ?? '';
$story_desc   = $story['description'] ?? '';

$counter_list = $counter['list_of_values'] ?? [];

$team_img     = $meet_the_team['image']        ?? [];
$team_title   = $meet_the_team['title']        ?? '';
$team_desc    = $meet_the_team['description']  ?? '';
$team_gallery = $meet_the_team['team_members'] ?? [];

$motiv_title  = $motivation['title']            ?? '';
$motiv_img    = $motivation['image']            ?? [];
$motiv_list   = $motivation['list_of_purposes'] ?? [];

$alt_img      = $alternative_txt['image']   ?? [];
$alt_title    = $alternative_txt['title']   ?? '';
$alt_text     = $alternative_txt['text']    ?? '';
$alt_msg      = $alternative_txt['message'] ?? '';
?>

<main id="main" class="site-main" role="main">

    <!-- A. Hero Section -->
    <section class="relative h-screen min-h-[600px] flex items-center justify-center pt-20" data-aos="fade-in">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <?php if (has_post_thumbnail()) : ?>
                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>"
                    alt="<?php echo esc_attr(get_the_title()); ?>" class="w-full h-full object-cover">
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_banner_nosotros.webp"
                    alt="Machu Picchu" class="w-full h-full object-cover">
            <?php endif; ?>
            <div class="absolute inset-0 bg-neutral-black/40"></div>
        </div>

        <div class="container-site relative z-10 text-center px-4">
            <h1 class="font-heading text-white text-4xl md:text-[64px] leading-tight md:leading-[72px] mb-6"
                data-aos="fade-up" data-aos-delay="100">
                <?php echo esc_html(get_the_title()); ?>
            </h1>
            <?php
            $content = get_the_content();
            if ($content) : ?>
                <p class="font-body text-white/90 text-lg md:text-xl font-light max-w-2xl mx-auto mb-10" data-aos="fade-up"
                    data-aos-delay="200">
                    <?php echo wp_strip_all_tags($content); ?>
                </p>
            <?php endif; ?>
        </div>
    </section>

    <?php if ($story_msg) : ?>
        <section class="py-20">
            <div class="container-site">
                <p class="font-body text-lg md:text-xl text-dark mb-0 max-w-4xl mx-auto text-center" data-aos="fade-up"
                    data-aos-delay="200">
                    <?php echo esc_html($story_msg); ?>
                </p>
            </div>
        </section>
    <?php endif; ?>


    <!-- Our Story -->
    <?php if ($story_title || $story_desc || !empty($story_img)) : ?>
        <section class="pb-12 md:pb-20 bg-cream">
            <div class="container-site">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

                    <!-- Left: Photo -->
                    <div class="relative" data-aos="fade-right">
                        <?php if (!empty($story_img)) : ?>
                            <div class="rounded-2xl overflow-hidden shadow-xl">
                                <img src="<?php echo esc_url($story_img['url']); ?>"
                                    alt="<?php echo esc_attr($story_img['alt'] ?: $story_title); ?>"
                                    class="w-full h-full object-cover">
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Right: Content -->
                    <div data-aos="fade-left">
                        <?php if ($story_title) : ?>
                            <h2 class="font-heading text-4xl md:text-5xl font-medium mb-6"><?php echo esc_html($story_title); ?></h2>
                        <?php endif; ?>

                        <?php if ($story_desc) : ?>
                            <div class="font-body text-dark font-light prose prose-neutral max-w-none">
                                <?php echo apply_filters('the_content', $story_desc); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- STATS COUNTER BAR -->
    <?php if (!empty($counter_list)) : ?>
        <?php get_template_part('template-parts/components/section-counter', null, ['list_of_values' => $counter_list]); ?>
    <?php endif; ?>

    <!-- MEET THE TEAM -->
    <?php get_template_part('template-parts/components/section-meetus', null, [
        'title'        => $team_title,
        'description'  => $team_desc,
        'image'        => $team_img,
        'team_members' => $team_gallery
    ]); ?>

    <!-- D. Motivation (What Moves Us) -->
    <?php if ($motiv_title || !empty($motiv_list)) : ?>
        <section class="py-20 bg-sage text-white">
            <div class="container-site">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div data-aos="fade-right">
                        <div class="flex items-center gap-4 mb-12">
                            <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.707031 12.0156L38.3976 49.7062" stroke="white" stroke-width="2" />
                                <path d="M12.0146 0.70752L49.7053 38.3981" stroke="white" stroke-width="2" />
                                <path d="M12.0161 49.7056L49.7067 12.015" stroke="white" stroke-width="2" />
                                <path d="M0.707031 38.3979L38.3976 0.707343" stroke="white" stroke-width="2" />
                                <rect x="23.3062" y="23.8213" width="3.76914" height="3.76914" fill="white" />
                            </svg>
                            <h2 class="font-heading text-4xl md:text-5xl font-medium">
                                <?php echo esc_html($motiv_title ?: 'What Moves Us'); ?>
                            </h2>
                        </div>

                        <?php if (!empty($motiv_img)) : ?>
                            <img src="<?php echo esc_url($motiv_img['url']); ?>"
                                alt="<?php echo esc_attr($motiv_img['alt'] ?: $motiv_title); ?>"
                                class="w-full h-auto rounded-lg shadow-xl object-cover aspect-[4/3]">
                        <?php endif; ?>
                    </div>
                    <div data-aos="fade-left">
                        <?php if (!empty($motiv_list)) : ?>
                            <?php foreach ($motiv_list as $purpose) : ?>
                                <div class="mb-12">
                                    <?php if (!empty($purpose['purpose_title'])) : ?>
                                        <h2 class="font-heading text-4xl md:text-5xl font-medium mb-6">
                                            <?php echo esc_html($purpose['purpose_title']); ?>
                                        </h2>
                                    <?php endif; ?>
                                    <?php if (!empty($purpose['purpose_description'])) : ?>
                                        <div class="space-y-6">
                                            <div class="font-body text-cream/80 font-light">
                                                <?php echo apply_filters('the_content', $purpose['purpose_description']); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Alternative Text / Sofia -->
    <?php if ($alt_title || $alt_text || !empty($alt_img)) : ?>
        <section class="py-12 md:py-20 bg-cream">
            <div class="container-site">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

                    <!-- Left: Photo -->
                    <div class="relative" data-aos="fade-right">
                        <?php if (!empty($alt_img)) : ?>
                            <div class="rounded-2xl overflow-hidden shadow-xl">
                                <img src="<?php echo esc_url($alt_img['url']); ?>"
                                    alt="<?php echo esc_attr($alt_img['alt'] ?: $alt_title); ?>"
                                    class="w-full h-full object-cover">
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Right: Content -->
                    <div data-aos="fade-left">
                        <?php if ($alt_title) : ?>
                            <h2 class="font-heading text-4xl md:text-6xl font-medium mb-12"><?php echo esc_html($alt_title); ?></h2>
                        <?php endif; ?>

                        <?php if ($alt_text) : ?>
                            <div class="font-body text-dark font-light prose prose-neutral max-w-none">
                                <?php echo apply_filters('the_content', $alt_text); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($alt_msg) : ?>
                    <div class="mt-12" data-aos="fade-up">
                        <div class="font-body text-dark font-light">
                            <?php echo $alt_msg; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- G. Banner CTA -->
    <?php get_template_part('template-parts/components/banner-cta'); ?>

</main>

<?php get_footer(); ?>