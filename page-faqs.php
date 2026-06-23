<?php

/**
 * Template Name: FAQs
 *
 * Lee los datos desde ACF Options Page (faqs).
 * Estructura ACF:
 *   faqs (group)
 *     ├── title_faqs       (text)
 *     ├── description      (text)
 *     └── list_of_questions (repeater)
 *           ├── question   (text)
 *           └── response   (wysiwyg)
 *
 * Requiere: ACF Pro + Options Page registrada como 'faqs'
 */

get_header();

$faqs_group = get_field('faqs', 'option');
$title      = $faqs_group['title_faqs'] ?? get_the_title();
$description = $faqs_group['description'] ?? '';
$questions  = $faqs_group['list_of_questions'] ?? [];

// Build sections for sidebar
$sections = [];
foreach ($questions as $i => $item) {
    $q_text = trim($item['question'] ?? '');
    if (!$q_text) continue;
    $sections[] = [
        'id'    => 'faq-' . ($i + 1),
        'title' => $q_text,
    ];
}
?>

<main class="min-h-screen bg-cream">

    <!-- ── Page Header ──────────────────────────────────────────────── -->
    <section class="pt-20 pb-10 text-center px-4" data-aos="fade-up">
        <h1 class="heading-2 text-dark max-w-3xl mx-auto md:text-6xl text-4xl">
            <?php echo esc_html($title ?: get_the_title()); ?>
        </h1>
        <?php if ($description): ?>
            <div class="mt-8 text-dark max-w-2xl mx-auto font-light faq-wysiwyg">
                <?php echo wp_kses_post($description); ?>
            </div>
        <?php endif; ?>
    </section>

    <!-- ── Two-column layout ────────────────────────────────────────── -->
    <div class="container mx-auto px-6 lg:px-8 py-16">
        <div class="legal-layout flex flex-col lg:flex-row gap-12 lg:gap-16">

            <!-- ══════════════════════════════════════════════════════
                 SIDEBAR NAV
            ══════════════════════════════════════════════════════ -->
            <?php if (!empty($sections)): ?>
                <aside class="legal-sidebar lg:w-72 xl:w-80 shrink-0">
                    <nav class="legal-nav lg:sticky lg:top-28" aria-label="Preguntas frecuentes">
                        <ul class="border-t border-dark/10">
                            <?php foreach ($sections as $section): ?>
                                <li class="border-b border-dark/8">
                                    <a href="#<?php echo esc_attr($section['id']); ?>"
                                        class="legal-nav__link group flex items-start gap-3 py-3.5 text-sm font-body text-dark/45 hover:text-dark transition-colors duration-200">
                                        <span
                                            class="legal-nav__arrow mt-0.5 shrink-0 w-4 h-4 flex items-center justify-center text-dark/25 group-hover:text-dark group-hover:translate-x-1 transition-all duration-200">
                                            <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                                                <path d="M1.5 6.5H11.5M11.5 6.5L7 2M11.5 6.5L7 11" stroke="currentColor"
                                                    stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                        <span class="leading-snug"><?php echo esc_html($section['title']); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                </aside>
            <?php endif; ?>

            <!-- ══════════════════════════════════════════════════════
                 CONTENT
            ══════════════════════════════════════════════════════ -->
            <div class="legal-content faq-content flex-1 min-w-0">

                <?php if (empty($questions)): ?>
                    <p class="text-sm text-dark/40 font-body">
                        <?php esc_html_e('No hay preguntas disponibles.', 'intense-nerd-theme'); ?>
                    </p>
                <?php else: ?>
                    <?php foreach ($questions as $i => $item):
                        $q_text = trim($item['question'] ?? '');
                        $a_text = $item['response'] ?? '';
                        if (!$q_text) continue;
                        $q_id = 'faq-' . ($i + 1);
                        ?>
                        <h2 id="<?php echo esc_attr($q_id); ?>" class="legal-heading">
                            <?php echo esc_html($q_text); ?>
                        </h2>
                        <?php if ($a_text): ?>
                            <div class="faq-wysiwyg">
                                <?php echo wp_kses_post($a_text); ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>

        </div>
    </div>

</main>

<style>
    .legal-nav__link.is-active {
        color: var(--color-dark, #1a1a1a);
    }

    .legal-nav__link.is-active .legal-nav__arrow {
        color: var(--color-dark, #1a1a1a);
        transform: translateX(4px);
    }

    .legal-content h2.legal-heading {
        font-size: 0.9375rem;
        font-weight: 600;
        color: var(--color-dark, #1a1a1a);
        margin-top: 2rem;
        margin-bottom: 0.875rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(0, 0, 0, 0.08);
        line-height: 1.4;
        scroll-margin-top: 7rem;
    }

    .legal-content h2.legal-heading:first-of-type {
        margin-top: 0;
        padding-top: 0;
        border-top: none;
    }

    .legal-content p {
        font-size: 0.875rem;
        line-height: 1.8;
        color: rgba(26, 26, 26, 0.62);
        margin-bottom: 0.875rem;
    }

    .legal-content p:last-child {
        margin-bottom: 0;
    }

    .legal-content ul,
    .legal-content ol {
        margin: 0.5rem 0 1rem;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 0.375rem;
    }

    .legal-content ul li {
        list-style: none;
        padding-left: 1.25rem;
        position: relative;
        font-size: 0.875rem;
        line-height: 1.75;
        color: rgba(26, 26, 26, 0.62);
    }

    .legal-content ul li::before {
        content: '–';
        position: absolute;
        left: 0;
        opacity: 0.35;
    }

    .legal-content ol {
        padding-left: 1rem;
    }

    .legal-content ol li {
        font-size: 0.875rem;
        line-height: 1.75;
        color: rgba(26, 26, 26, 0.62);
    }

    .legal-content a {
        text-decoration: underline;
        text-underline-offset: 2px;
        color: inherit;
        opacity: 0.65;
        transition: opacity 0.2s;
    }

    .legal-content a:hover {
        opacity: 1;
    }

    .legal-content strong,
    .legal-content b {
        font-weight: 600;
        color: var(--color-dark, #1a1a1a);
    }

    .faq-wysiwyg p {
        font-size: 0.875rem;
        line-height: 1.8;
        color: rgba(26, 26, 26, 0.62);
        margin-bottom: 0.875rem;
    }

    .faq-wysiwyg p:last-child {
        margin-bottom: 0;
    }

    .faq-wysiwyg a {
        color: var(--color-primary, #b76739);
        text-decoration: underline;
    }

    .faq-wysiwyg strong {
        font-weight: 600;
        color: var(--color-dark, #1a1a1a);
    }

    .faq-wysiwyg ul,
    .faq-wysiwyg ol {
        padding-left: 1.25rem;
        margin-bottom: 0.75rem;
    }

    .faq-wysiwyg ul {
        list-style: disc;
    }

    .faq-wysiwyg ol {
        list-style: decimal;
    }

    .faq-wysiwyg li {
        margin-bottom: 0.25rem;
        font-size: 0.875rem;
        line-height: 1.75;
        color: rgba(26, 26, 26, 0.62);
    }

    html {
        scroll-behavior: smooth;
    }
</style>

<script>
    (function () {
        const navLinks = document.querySelectorAll('.legal-nav__link');
        const headings = document.querySelectorAll('.legal-content h2.legal-heading[id]');

        if (!navLinks.length || !headings.length) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                const id = entry.target.id;
                navLinks.forEach(link => {
                    link.classList.toggle('is-active', link.getAttribute('href') === '#' + id);
                });
            });
        }, {
            rootMargin: '-15% 0px -75% 0px',
            threshold: 0,
        });

        headings.forEach(h => observer.observe(h));

        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const id = link.getAttribute('href').slice(1);
                const target = document.getElementById(id);
                if (!target) return;
                const offset = 112;
                const top = target.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({ top, behavior: 'smooth' });
            });
        });
    })();
</script>

<?php get_footer(); ?>
