<?php

/**
 * Template Name: Single Blog Post
 * Single post template matching the Blog page design system.
 */

get_header();

// Fallback if used outside the loop
if (! have_posts()) {
    wp_redirect(get_post_type_archive_link('post'));
    exit;
}

while (have_posts()) : the_post();

    $categories     = get_the_category();
    $primary_cat    = $categories ? $categories[0] : null;
    $reading_time   = ceil(str_word_count(strip_tags(get_the_content())) / 200);
    $featured_img   = get_the_post_thumbnail_url(get_the_ID(), 'full');
    $author_id      = get_the_author_meta('ID');
    $author_name    = get_the_author_meta('display_name');
    $author_bio     = get_the_author_meta('description');
    $author_avatar  = get_avatar_url($author_id, ['size' => 80]);
    $author_url     = get_author_posts_url($author_id);

    // Related posts (same category, exclude current)
    $related_args = [
        'post_type'           => 'post',
        'posts_per_page'      => 3,
        'post__not_in'        => [get_the_ID()],
        'orderby'             => 'rand',
    ];
    if ($primary_cat) {
        $related_args['category__in'] = [$primary_cat->term_id];
    }
    $related_query = new WP_Query($related_args);

?>

    <main class="min-h-screen bg-cream">

        <!-- ═══════════════════════════════════════
         HERO BANNER
    ═══════════════════════════════════════ -->
        <section class="relative h-screen min-h-[600px] flex items-center justify-center pt-20" data-aos="fade-in">

            <!-- Background: featured image or fallback -->
            <div class="absolute inset-0 z-0">
                <?php if ($featured_img) : ?>
                    <img src="<?php echo esc_url($featured_img); ?>"
                        alt="<?php the_title_attribute(); ?>"
                        class="w-full h-full object-cover"
                        style="animation: heroZoom 8s ease-out forwards;" />
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_banner_destinations.webp"
                        alt="<?php the_title_attribute(); ?>"
                        class="w-full h-full object-cover" />
                <?php endif; ?>
                <div class="absolute inset-0 bg-neutral-black/40"></div>
            </div>

            <!-- Content -->
            <div class="container-site relative z-10 text-center px-4">

                <?php if ($primary_cat) : ?>
                    <a href="<?php echo add_query_arg('category_name', $primary_cat->slug, get_post_type_archive_link('post')); ?>"
                        class="inline-block mb-5 text-xs font-body font-semibold tracking-widest uppercase text-white border border-white px-4 py-1.5 rounded-full hover:bg-white hover:text-dark transition-all duration-300"
                        data-aos="fade-up" data-aos-delay="50">
                        <?php echo esc_html($primary_cat->name); ?>
                    </a>
                <?php endif; ?>

                <h1 class="font-heading text-white text-4xl md:text-[56px] lg:text-[64px] leading-tight md:leading-[1.15] mb-6 max-w-4xl mx-auto"
                    data-aos="fade-up" data-aos-delay="100">
                    <?php the_title(); ?>
                </h1>

                <?php if (has_excerpt()) : ?>
                    <p class="font-body text-white text-lg md:text-xl font-light max-w-2xl mx-auto mb-10"
                        data-aos="fade-up" data-aos-delay="200">
                        <?php the_excerpt(); ?>
                    </p>
                <?php endif; ?>

                <!-- Meta row -->
                <div class="flex flex-wrap justify-center items-center gap-4 text-white text-lg font-body font-light"
                    data-aos="fade-up" data-aos-delay="300">
                    <time datetime="<?php echo get_the_date('c'); ?>">
                        <?php echo get_the_date('F j, Y'); ?>
                    </time>
                    <span class="w-px h-4 bg-white/30"></span>
                    <span><?php echo $reading_time; ?> min read</span>
                </div>

            </div>
        </section>


        <!-- ═══════════════════════════════════════
         CONTENT LAYOUT
         Sticky TOC (desktop) + Article body
    ═══════════════════════════════════════ -->
        <div class="container mx-auto px-4 py-14 md:py-20">
            <div class="flex gap-16 items-start max-w-6xl mx-auto">

                <!-- ── Sticky Sidebar (TOC + Share) ──────────────────────────── -->
                <aside class="hidden lg:flex flex-col gap-8 w-56 shrink-0 sticky top-28"
                    data-aos="fade-right" data-aos-delay="150">

                    <!-- Table of Contents (built by JS) -->
                    <div x-data="tocBuilder()" x-init="build()">
                        <p class="text-xs font-body font-semibold tracking-widest uppercase text-dark mb-4">
                            On this page
                        </p>
                        <nav id="toc-nav" class="flex flex-col gap-2">
                            <!-- Filled by JS -->
                        </nav>
                    </div>

                    <!-- Divider -->
                    <div class="h-px bg-dark/10"></div>

                    <!-- Share -->
                    <div>
                        <p class="text-xs font-body font-semibold tracking-widest uppercase text-dark mb-4">
                            Share
                        </p>
                        <div class="flex flex-col gap-2">
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>"
                                target="_blank" rel="noopener"
                                class="share-link group flex items-center gap-2.5 text-sm font-body text-dark/60 hover:text-dark transition-colors">
                                <span class="share-icon w-8 h-8 rounded-full border border-dark/15 flex items-center justify-center group-hover:border-dark/40 group-hover:bg-dark group-hover:text-cream transition-all duration-300">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.748l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                    </svg>
                                </span>
                                X / Twitter
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>"
                                target="_blank" rel="noopener"
                                class="share-link group flex items-center gap-2.5 text-sm font-body text-dark/60 hover:text-dark transition-colors">
                                <span class="share-icon w-8 h-8 rounded-full border border-dark/15 flex items-center justify-center group-hover:border-dark/40 group-hover:bg-dark group-hover:text-cream transition-all duration-300">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                    </svg>
                                </span>
                                LinkedIn
                            </a>
                            <button onclick="copyLink()"
                                class="share-link group flex items-center gap-2.5 text-sm font-body text-dark/60 hover:text-dark transition-colors text-left">
                                <span id="copy-icon" class="share-icon w-8 h-8 rounded-full border border-dark/15 flex items-center justify-center group-hover:border-dark/40 group-hover:bg-dark group-hover:text-cream transition-all duration-300">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M8 5H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-1M8 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2M8 5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2m0 0h2a2 2 0 0 1 2 2v3" />
                                    </svg>
                                </span>
                                <span id="copy-label">Copy link</span>
                            </button>
                        </div>
                    </div>

                </aside>

                <!-- ── Main Article ────────────────────────────────────────────── -->
                <article id="post-<?php the_ID(); ?>"
                    class="flex-1 min-w-0 max-w-2xl"
                    data-aos="fade-up">

                    <!-- Excerpt / standfirst -->
                    <?php if (has_excerpt()) : ?>
                        <p class="text-xl md:text-2xl font-body font-light text-dark/70 leading-relaxed mb-10 pb-10 border-b border-dark/10">
                            <?php the_excerpt(); ?>
                        </p>
                    <?php endif; ?>

                    <!-- Post body -->
                    <div class="prose-blog">
                        <?php the_content(); ?>
                    </div>

                    <!-- Tags -->
                    <?php
                    $tags = get_the_tags();
                    if ($tags) :
                    ?>
                        <div class="flex flex-wrap gap-2 mt-12 pt-10 border-t border-dark/10">
                            <?php foreach ($tags as $tag) : ?>
                                <a href="<?php echo get_tag_link($tag->term_id); ?>"
                                    class="text-xs font-body font-medium px-4 py-1.5 rounded-full bg-dark/5 text-dark/60 hover:bg-dark hover:text-cream transition-all duration-300">
                                    #<?php echo esc_html($tag->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Mobile Share -->
                    <div class="flex items-center gap-4 mt-8 lg:hidden">
                        <span class="text-xs font-body font-semibold tracking-widest uppercase text-dark/40">Share</span>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>"
                            target="_blank" rel="noopener"
                            class="w-9 h-9 rounded-full border border-dark/15 flex items-center justify-center hover:bg-dark hover:text-cream hover:border-dark transition-all duration-300 text-dark/60">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.748l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>"
                            target="_blank" rel="noopener"
                            class="w-9 h-9 rounded-full border border-dark/15 flex items-center justify-center hover:bg-dark hover:text-cream hover:border-dark transition-all duration-300 text-dark/60">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </a>
                    </div>

                </article>

            </div>
        </div>


        <!-- ═══════════════════════════════════════
         AUTHOR BIO
    ═══════════════════════════════════════ -->
        <?php if ($author_bio) : ?>
            <section class="border-t border-dark/10 py-14" data-aos="fade-up">
                <div class="container mx-auto px-4 max-w-3xl">
                    <div class="flex gap-6 items-start">
                        <a href="<?php echo esc_url($author_url); ?>">
                            <img src="<?php echo esc_url($author_avatar); ?>"
                                alt="<?php echo esc_attr($author_name); ?>"
                                class="w-16 h-16 rounded-full object-cover shrink-0" />
                        </a>
                        <div>
                            <p class="text-xs font-body font-semibold tracking-widest uppercase text-dark/40 mb-1">Written by</p>
                            <a href="<?php echo esc_url($author_url); ?>"
                                class="font-body font-semibold text-dark hover:text-primary transition-colors text-lg">
                                <?php echo esc_html($author_name); ?>
                            </a>
                            <p class="mt-2 text-sm font-body font-light text-dark/60 leading-relaxed max-w-lg">
                                <?php echo esc_html($author_bio); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- ── Back to Blog ──────────────────────────────────────────────────────── -->
        <div class="flex justify-center py-10" data-aos="fade-up">
            <a href="<?php echo get_post_type_archive_link('post'); ?>"
                class="btn btn-outline px-8 py-3 rounded-full text-sm transition-all hover:bg-primary hover:text-cream hover:border-primary">
                ← Back to all articles
            </a>
        </div>



        <!-- C. Authentic Itineraries -->
        <section id="itineraries" class="py-20 bg-cream">
            <div class="container-site text-center">
                <div class="flex flex-col items-center gap-4">
                    <svg width="65" height="41" viewBox="0 0 65 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M31.9972 27.997L18.8042 20.418L31.9972 12.8391L45.1902 20.418L31.9972 27.997Z"
                            stroke="#7B4424" stroke-width="1.12281" />
                        <path d="M31.9973 22.3832L28.3481 20.4183L31.9973 18.4534L35.6464 20.4183L31.9973 22.3832Z"
                            fill="#B76739" stroke="#B76739" stroke-width="1.12281" />
                        <path d="M9.26025 0.488281L31.9971 13.4006L54.734 0.488281" stroke="#7B4424"
                            stroke-width="1.12281" />
                        <path d="M54.7339 40.3481L31.997 27.4359L9.26017 40.3481" stroke="#7B4424" stroke-width="1.12281" />
                        <path d="M9.26025 0.488281L31.9971 13.4006L54.734 0.488281" stroke="#7B4424"
                            stroke-width="1.12281" />
                        <path d="M54.7339 40.3481L31.997 27.4359L9.26017 40.3481" stroke="#7B4424" stroke-width="1.12281" />
                        <path d="M23.2954 3.29541L32.2779 8.90945L41.2603 3.29541" stroke="#B76739"
                            stroke-width="1.12281" />
                        <path d="M41.2603 37.541L32.2778 31.927L23.2953 37.541" stroke="#B76739" stroke-width="1.12281" />
                        <path d="M64.2779 8.90942L44.0674 20.4182L64.2779 31.927" stroke="#B76739" stroke-width="1.12281" />
                        <path d="M0.277743 8.90942L20.4883 20.4182L0.277743 31.927" stroke="#B76739"
                            stroke-width="1.12281" />
                    </svg>
                    <h2 class="font-heading text-4xl md:text-5xl text-dark mb-12" data-aos="fade-up" data-aos-delay="100">
                        Related tours</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 text-left">
                        <?php
                        $itineraries = [
                            [
                                'title' => '14D Grand discovery',
                                'days' => '14 Days',
                                'price' => 'USD 2,059',
                                'destinations' => 'Lima • Paracas • Nazca • Arequipa • Colca Canyon • Lake Titicaca • Sacred Valley • Machu Picchu & Cusco',
                                'img' => get_template_directory_uri() . '/assets/images/intense_02.webp',
                                'badges' => ['New', 'Top seller']
                            ],
                            [
                                'title' => 'Inca Trail Discovery',
                                'days' => '5 Days',
                                'price' => 'USD 899',
                                'destinations' => 'Cusco • Wayllabamba • Pacaymayo • Wiñay Wayna • Machu Picchu',
                                'img' => get_template_directory_uri() . '/assets/images/intense_03.webp',
                                'badges' => ['Top seller']
                            ],
                            [
                                'title' => 'Amazon & Andes',
                                'days' => '12 Days',
                                'price' => 'USD 2,499',
                                'destinations' => 'Lima • Puerto Maldonado • Amazon Basin • Cusco • Sacred Valley • Machu Picchu',
                                'img' => get_template_directory_uri() . '/assets/images/intense_04.webp',
                                'badges' => []
                            ],
                        ];
                        foreach ($itineraries as $index => $itin):
                        ?>
                            <?php get_template_part('template-parts/components/card-itinerary', null, [
                                'image' => $itin['img'],
                                'title' => $itin['title'],
                                'price' => $itin['price'],
                                'duration' => $itin['days'],
                                'destinations' => $itin['destinations'],
                                'link' => '#',
                                'link_text' => 'Explore itineraries',
                                'aos_delay' => ($index * 100) + 200,
                                'badges' => $itin['badges'],
                            ]); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
        </section>

    </main>

    <style>
        /* ── Hero zoom animation ─────────────────────────────────── */
        @keyframes heroZoom {
            from {
                transform: scale(1.05);
            }

            to {
                transform: scale(1);
            }
        }

        /* ── Reading progress bar ────────────────────────────────── */
        #reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: var(--color-primary, #2d6a4f);
            z-index: 9999;
            transition: width 0.1s linear;
        }

        /* ── Article typography (prose-blog) ─────────────────────── */
        .prose-blog {
            color: var(--color-dark, #1a1a1a);
            font-family: var(--font-body, sans-serif);
            font-size: 1.0625rem;
            line-height: 1.8;
        }

        .prose-blog h2,
        .prose-blog h3,
        .prose-blog h4 {
            font-family: var(--font-heading, serif);
            font-weight: 700;
            color: var(--color-dark, #1a1a1a);
            margin-top: 2.5em;
            margin-bottom: 0.75em;
            scroll-margin-top: 6rem;
        }

        .prose-blog h2 {
            font-size: 1.625rem;
        }

        .prose-blog h3 {
            font-size: 1.25rem;
        }

        .prose-blog p {
            margin-bottom: 1.5em;
        }

        .prose-blog a {
            color: var(--color-primary, #2d6a4f);
            text-decoration: underline;
            text-decoration-thickness: 1px;
            text-underline-offset: 3px;
            transition: opacity .2s;
        }

        .prose-blog a:hover {
            opacity: .7;
        }

        .prose-blog ul,
        .prose-blog ol {
            padding-left: 1.5em;
            margin-bottom: 1.5em;
        }

        .prose-blog ul {
            list-style: disc;
        }

        .prose-blog ol {
            list-style: decimal;
        }

        .prose-blog li {
            margin-bottom: .4em;
        }

        .prose-blog blockquote {
            border-left: 3px solid var(--color-primary, #2d6a4f);
            padding: 1rem 1.5rem;
            margin: 2em 0;
            background: rgba(0, 0, 0, .03);
            border-radius: 0 .75rem .75rem 0;
            font-style: italic;
            color: var(--color-dark, #1a1a1a);
            font-size: 1.125rem;
        }

        .prose-blog img {
            width: 100%;
            border-radius: 1rem;
            margin: 2em 0;
            display: block;
        }

        .prose-blog figure {
            margin: 2em 0;
        }

        .prose-blog figcaption {
            text-align: center;
            font-size: .8125rem;
            color: rgba(26, 26, 26, .5);
            margin-top: .5em;
        }

        .prose-blog hr {
            border: none;
            border-top: 1px solid rgba(26, 26, 26, .1);
            margin: 2.5em 0;
        }

        .prose-blog pre {
            background: rgba(26, 26, 26, .05);
            border-radius: .75rem;
            padding: 1.25rem 1.5rem;
            overflow-x: auto;
            font-size: .875rem;
            margin: 2em 0;
        }

        .prose-blog code {
            font-size: .875em;
            background: rgba(26, 26, 26, .06);
            padding: .15em .4em;
            border-radius: .3em;
        }

        .prose-blog pre code {
            background: none;
            padding: 0;
        }

        /* ── TOC links ───────────────────────────────────────────── */
        .toc-link {
            display: block;
            font-size: 0.8125rem;
            font-family: var(--font-body, sans-serif);
            color: rgba(26, 26, 26, .45);
            padding: .25rem 0 .25rem .75rem;
            border-left: 2px solid rgba(26, 26, 26, .1);
            transition: all .2s;
            line-height: 1.4;
        }

        .toc-link:hover,
        .toc-link.active {
            color: var(--color-dark, #1a1a1a);
            border-left-color: var(--color-primary, #2d6a4f);
        }

        /* ── Related cards border utility ───────────────────────── */
        .border-dark\/8 {
            border-color: rgba(26, 26, 26, .08);
        }

        .border-dark\/20 {
            border-color: rgba(26, 26, 26, .2);
        }
    </style>


    <script>
        // ── Reading progress bar ──────────────────────────────────────────────────
        (function() {
            const bar = document.createElement('div');
            bar.id = 'reading-progress';
            document.body.prepend(bar);

            window.addEventListener('scroll', () => {
                const doc = document.documentElement;
                const total = doc.scrollHeight - doc.clientHeight;
                const pct = total > 0 ? (window.scrollY / total) * 100 : 0;
                bar.style.width = pct + '%';
            }, {
                passive: true
            });
        })();

        // ── Copy link ─────────────────────────────────────────────────────────────
        function copyLink() {
            const url = window.location.href;
            const onSuccess = () => {
                const label = document.getElementById('copy-label');
                const icon = document.getElementById('copy-icon');
                if (label) label.textContent = 'Copied!';
                if (icon) icon.classList.add('bg-dark', 'text-cream', 'border-dark');
                setTimeout(() => {
                    if (label) label.textContent = 'Copy link';
                    if (icon) icon.classList.remove('bg-dark', 'text-cream', 'border-dark');
                }, 2000);
            };

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(url).then(onSuccess);
            } else {
                const tempInput = document.createElement('input');
                tempInput.value = url;
                document.body.appendChild(tempInput);
                tempInput.select();
                try {
                    document.execCommand('copy');
                    onSuccess();
                } catch (err) {
                    console.error('Failed to copy link', err);
                }
                document.body.removeChild(tempInput);
            }
        }

        // ── Alpine TOC builder ────────────────────────────────────────────────────
        document.addEventListener('alpine:init', () => {
            Alpine.data('tocBuilder', () => ({
                build() {
                    const article = document.querySelector('.prose-blog');
                    const nav = document.getElementById('toc-nav');
                    if (!article || !nav) return;

                    const headings = article.querySelectorAll('h2, h3');
                    if (!headings.length) return;

                    headings.forEach((h, i) => {
                        if (!h.id) h.id = 'heading-' + i;
                        const a = document.createElement('a');
                        a.href = '#' + h.id;
                        a.textContent = h.textContent;
                        a.className = 'toc-link' + (h.tagName === 'H3' ? ' pl-5' : '');
                        a.addEventListener('click', e => {
                            e.preventDefault();
                            h.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        });
                        nav.appendChild(a);
                    });

                    // Intersection observer for active state
                    const links = nav.querySelectorAll('.toc-link');
                    const obs = new IntersectionObserver(entries => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                links.forEach(l => l.classList.remove('active'));
                                const active = nav.querySelector(`a[href="#${entry.target.id}"]`);
                                if (active) active.classList.add('active');
                            }
                        });
                    }, {
                        rootMargin: '-20% 0px -70% 0px'
                    });

                    headings.forEach(h => obs.observe(h));
                }
            }));
        });
    </script>

<?php endwhile; ?>

<?php get_footer(); ?>