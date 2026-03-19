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
 *           └── response   (textarea)
 *
 * Requiere: ACF Pro + Options Page registrada como 'faqs'
 */

get_header();

// ── Leer campos ACF desde Options Page ──────────────────────────────────────
$faqs_group   = get_field('faqs', 'option');
$title        = $faqs_group['title_faqs']       ?? get_the_title();
$description  = $faqs_group['description']      ?? '';
$questions    = $faqs_group['list_of_questions'] ?? [];

// ── Construir secciones para el sidebar (igual que page-legal) ───────────────
// Agrupamos por la inicial de cada pregunta si son muchas,
// o simplemente listamos todas las preguntas como ítems del sidebar.
?>

<main class="min-h-screen bg-cream">

    <!-- ── Page Header ──────────────────────────────────────────────── -->
    <section class="pt-20 pb-10 text-center px-4" data-aos="fade-up">
        <h1 class="heading-2 max-w-3xl mx-auto md:text-6xl text-4xl">
            <?php echo esc_html($title ?: get_the_title()); ?>
        </h1>
        <p class="mt-4 text-dark max-w-2xl mx-auto font-light">
            <?php echo esc_html($description); ?>
        </p>
    </section>

    <!-- ── Two-column layout ────────────────────────────────────────── -->
    <div class="container mx-auto px-6 lg:px-8 py-16">
        <div class="legal-layout flex flex-col lg:flex-row gap-12 lg:gap-16">

            <!-- ══════════════════════════════════════════════════════
                 SIDEBAR NAV
            ══════════════════════════════════════════════════════ -->
            <?php if (!empty($questions)) : ?>
                <aside class="legal-sidebar lg:w-72 xl:w-80 shrink-0">
                    <nav class="legal-nav lg:sticky lg:top-28" aria-label="Preguntas frecuentes">
                        <ul class="">
                            <?php foreach ($questions as $i => $item) :
                                $q_text = $item['question'] ?? '';
                                if (!$q_text) continue;
                                $q_id = 'faq-' . ($i + 1);
                            ?>
                                <li class="border-b border-dark/8">
                                    <a
                                        href="#<?php echo esc_attr($q_id); ?>"
                                        class="legal-nav__link group flex items-start gap-3 py-3.5 text-sm font-body text-dark/45 hover:text-dark transition-colors duration-200">
                                        <span class="legal-nav__arrow mt-0.5 shrink-0 w-4 h-4 flex items-center justify-center text-dark/25 group-hover:text-dark group-hover:translate-x-1 transition-all duration-200">
                                            <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                                                <path d="M1.5 6.5H11.5M11.5 6.5L7 2M11.5 6.5L7 11" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                        <span class="leading-snug"><?php echo esc_html($q_text); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                </aside>
            <?php endif; ?>

            <!-- ══════════════════════════════════════════════════════
                 CONTENT — Accordion FAQs
            ══════════════════════════════════════════════════════ -->
            <div class="legal-content faq-content flex-1 min-w-0">

                <?php if (empty($questions)) : ?>
                    <p class="text-sm text-dark/40 font-body">
                        <?php esc_html_e('No hay preguntas disponibles.', 'intense-nerd-theme'); ?>
                    </p>

                <?php else : ?>
                    <div class="faq-list">
                        <?php foreach ($questions as $i => $item) :
                            $q_text  = $item['question'] ?? '';
                            $a_text  = $item['response'] ?? '';
                            $q_id    = 'faq-' . ($i + 1);
                            if (!$q_text) continue;
                        ?>
                            <div
                                id="<?php echo esc_attr($q_id); ?>"
                                class="faq-item scroll-mt-28 border-b border-dark/8"
                                x-data="{ open: false }">
                                <!-- Pregunta (trigger) -->
                                <button
                                    @click="open = !open"
                                    :aria-expanded="open"
                                    class="faq-trigger w-full flex items-start justify-between gap-6 py-5 text-left group">
                                    <span class="faq-question text-sm font-body font-medium text-dark leading-snug group-hover:text-dark/70 transition-colors">
                                        <?php echo esc_html($q_text); ?>
                                    </span>
                                    <!-- Icono +/- -->
                                    <span class="faq-icon shrink-0 mt-0.5 w-5 h-5 flex items-center justify-center text-dark/30 transition-transform duration-300" :class="{ 'rotate-45': open }">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                                            <path d="M7 1V13M1 7H13" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" />
                                        </svg>
                                    </span>
                                </button>

                                <!-- Respuesta (collapsible) -->
                                <div
                                    x-show="open"
                                    x-collapse
                                    class="faq-answer">
                                    <p class="pb-5 pr-10 text-sm font-body text-dark/55 leading-relaxed">
                                        <?php echo nl2br(esc_html($a_text)); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div><!-- /.faq-content -->

        </div>
    </div>

</main>

<style>
    /* ── Sidebar: reutiliza estilos de page-legal ───────────────────── */
    .legal-nav__link.is-active {
        color: var(--color-dark, #1a1a1a);
    }

    .legal-nav__link.is-active .legal-nav__arrow {
        color: var(--color-dark, #1a1a1a);
        transform: translateX(4px);
    }

    /* ── FAQ accordion ──────────────────────────────────────────────── */
    .faq-trigger {
        background: none;
        border: none;
        cursor: pointer;
        padding-left: 0;
        padding-right: 0;
    }

    .faq-trigger:focus-visible {
        outline: 2px solid currentColor;
        outline-offset: 2px;
        border-radius: 4px;
    }

    .faq-icon {
        flex-shrink: 0;
    }

    /* Animación x-collapse si no está disponible, fallback */
    [x-cloak] {
        display: none !important;
    }

    html {
        scroll-behavior: smooth;
    }
</style>

<script>
    (function() {
        const navLinks = document.querySelectorAll('.legal-nav__link');
        const items = document.querySelectorAll('.faq-item[id]');

        if (!navLinks.length || !items.length) return;

        // Resaltar sidebar según item visible
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

        items.forEach(el => observer.observe(el));

        // Smooth scroll con offset de header
        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const id = link.getAttribute('href').slice(1);
                const target = document.getElementById(id);
                if (!target) return;

                // Abrir el accordion de destino via Alpine si está cerrado
                const alpineEl = target.querySelector('[x-data]') || target;
                if (alpineEl._x_dataStack) {
                    const data = Alpine.$data(alpineEl);
                    if (data && !data.open) data.open = true;
                }

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