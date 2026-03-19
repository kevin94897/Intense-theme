<?php

/**
 * Template Name: Legal / Terms
 *
 * Lee el contenido del editor WP.
 * Usa regex para inyectar id="" en cada <h2> y construir el sidebar.
 */

get_header();

$raw_content = apply_filters('the_content', get_the_content());

// ── 1. Extraer todos los <h2> y generar sus slugs ────────────────────────────
$sections = [];
preg_match_all('/<h2[^>]*>(.*?)<\/h2>/is', $raw_content, $matches);

foreach ($matches[1] as $heading_html) {
    $title = wp_strip_all_tags($heading_html);
    $title = trim($title);
    if (!$title) continue;
    $id = sanitize_title($title);
    $sections[] = [
        'id'    => $id,
        'title' => $title,
    ];
}

// ── 2. Inyectar id="" en cada <h2> del contenido ────────────────────────────
$processed_content = preg_replace_callback(
    '/<h2([^>]*)>(.*?)<\/h2>/is',
    function ($m) {
        $attrs      = $m[1];
        $inner      = $m[2];
        $title      = wp_strip_all_tags($inner);
        $id         = sanitize_title(trim($title));

        // Evitar duplicar id si ya existe
        $attrs = preg_replace('/\s*id=["\'][^"\']*["\']/', '', $attrs);

        return '<h2 id="' . esc_attr($id) . '" class="legal-heading"' . $attrs . '>' . $inner . '</h2>';
    },
    $raw_content
);
?>

<main class="min-h-screen bg-cream">

    <!-- ── Page Header ──────────────────────────────────────────────── -->
    <section class="pt-20 pb-10 text-center px-4" data-aos="fade-up">
        <h1 class="heading-2 max-w-3xl mx-auto md:text-6xl text-4xl">
            Privacy Statement
        </h1>
        <p class="mt-4 text-dark max-w-2xl mx-auto font-light">
            The use of the website (the “Website”) is subject to the terms and conditions stated herein. Use of the Website constitutes an agreement by you (the “Client”) that your use is governed by these terms and conditions. In addition, when using particular Intense Peru S.A.C. (the “Company”) services, you will be subject to any guidelines or rules applicable to such services that may be posted from time to time.
        </p>
    </section>

    <!-- ── Two-column layout ────────────────────────────────────────── -->
    <div class="container mx-auto px-6 lg:px-8 py-16">
        <div class="legal-layout flex flex-col lg:flex-row gap-12 lg:gap-16">

            <!-- ══════════════════════════════════════════════════════
                 SIDEBAR NAV
            ══════════════════════════════════════════════════════ -->
            <?php if (!empty($sections)) : ?>
                <aside class="legal-sidebar lg:w-72 xl:w-80 shrink-0">
                    <nav class="legal-nav lg:sticky lg:top-28" aria-label="Secciones">
                        <ul class="border-t border-dark/10">
                            <?php foreach ($sections as $section) : ?>
                                <li class="border-b border-dark/8">
                                    <a
                                        href="#<?php echo esc_attr($section['id']); ?>"
                                        class="legal-nav__link group flex items-start gap-3 py-3.5 text-sm font-body text-dark/45 hover:text-dark transition-colors duration-200">
                                        <span class="legal-nav__arrow mt-0.5 shrink-0 w-4 h-4 flex items-center justify-center text-dark/25 group-hover:text-dark group-hover:translate-x-1 transition-all duration-200">
                                            <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                                                <path d="M1.5 6.5H11.5M11.5 6.5L7 2M11.5 6.5L7 11" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
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
            <div class="legal-content flex-1 min-w-0">
                <?php echo $processed_content; ?>
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

    /* ── Content typography ─────────────────────────────────────────── */
    .legal-content h1 {
        font-size: 1.375rem;
        font-weight: 600;
        color: var(--color-dark, #1a1a1a);
        margin-bottom: 1.25rem;
        line-height: 1.3;
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

    html {
        scroll-behavior: smooth;
    }
</style>

<script>
    (function() {
        const navLinks = document.querySelectorAll('.legal-nav__link');
        const headings = document.querySelectorAll('.legal-content h2.legal-heading[id]');

        if (!navLinks.length || !headings.length) return;

        // Verificar que los ids se inyectaron correctamente
        // console.log('Headings found:', [...headings].map(h => h.id));

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
                window.scrollTo({
                    top,
                    behavior: 'smooth'
                });
            });
        });
    })();
</script>

<?php get_footer(); ?>