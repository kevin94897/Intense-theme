<?php

/**
 * Component: Meet the Team
 * Slider con Embla Carousel
 *
 * Uso: get_template_part('template-parts/components/section-conocenos.php');
 *
 * Requiere un CPT "team" con campos ACF:
 *   - team_role    (text)
 *   - team_photo   (image) — opcional, fallback a featured image
 *
 * Si no usas CPT, reemplaza $team_query por un array estático de ejemplo.
 */

$team_query = new WP_Query([
    'post_type'      => 'team',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

// Fallback: si no hay CPT "team", usar datos estáticos para preview
$use_static = !$team_query->have_posts();
$static_members = [
    ['name' => 'Antonia',  'role' => 'Lead Guide',          'img' => get_template_directory_uri() . '/assets/images/intense_conocenos_slider_img_01.webp'],
    ['name' => 'Karen',    'role' => 'Operations Manager',  'img' => get_template_directory_uri() . '/assets/images/intense_conocenos_slider_img_02.webp'],
    ['name' => 'Karina',   'role' => 'Cultural Specialist', 'img' => get_template_directory_uri() . '/assets/images/intense_conocenos_slider_img_03.webp'],
    ['name' => 'Lucía',    'role' => 'Travel Consultant',   'img' => get_template_directory_uri() . '/assets/images/intense_conocenos_slider_img_01.webp'],
    ['name' => 'Valeria',  'role' => 'Guest Experience',    'img' => get_template_directory_uri() . '/assets/images/intense_conocenos_slider_img_02.webp'],
];
?>

<!-- ═══════════════════════════════════════════════════════
     MEET THE TEAM
════════════════════════════════════════════════════════ -->
<section class="team-section py-12 lg:py-20 overflow-hidden bg-cream">
    <div class="container-site mx-auto px-6 lg:px-8">

        <!-- Layout grid: texto izq | slider der -->
        <div class="team-layout grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            <!-- ── Columna izquierda: imagen grupal ─────────────────────── -->
            <div class="team-photo-wrap relative" data-aos="fade-right">
                <div class="team-photo-frame overflow-hidden rounded-2xl aspect-[3/4] lg:aspect-auto lg:h-[560px]">
                    <?php
                    // Reemplazar con la imagen real del equipo
                    $group_photo = get_template_directory_uri() . '/assets/images/intense_conocenos_img.webp';
                    // Si tienes el campo ACF global:
                    // $group_photo = get_field('team_group_photo', 'option') ?: $group_photo;
                    ?>
                    <img
                        src="<?php echo esc_url($group_photo); ?>"
                        alt="<?php esc_attr_e('Equipo Intense Peru', 'intense-nerd-theme'); ?>"
                        class="w-full h-full object-cover object-top"
                        loading="lazy">
                </div>
            </div>

            <!-- ── Columna derecha: texto + slider ──────────────────────── -->
            <div data-aos="fade-left" data-aos-delay="100">

                <!-- Encabezado -->
                <h2 class="font-heading text-4xl md:text-5xl font-medium mb-6">
                    Meet the Team Behind Intense Peru
                </h2>
                <p class="font-body text-dark font-light">
                    A proudly women-led workforce — over 50% local women — each bringing strong expertise and a firm commitment to supporting local communities and caring for the planet.
                </p>

                <!-- ── Embla Carousel ────────────────────────────────────── -->
                <div class="embla team-embla" id="teamEmbla">

                    <!-- Controles -->
                    <div class="flex items-center gap-3 my-2 justify-end">
                        <button
                            class="embla__prev team-arrow text-primary w-12 h-12 flex items-center justify-center cursor-pointer hover:border-dark hover:text-dark transition-colors"
                            aria-label="<?php esc_attr_e('Anterior', 'intense-nerd-theme'); ?>">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M10 3L5 8L10 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                        <button
                            class="embla__next team-arrow text-primary w-12 h-12 flex items-center justify-center cursor-pointer hover:border-dark hover:text-dark transition-colors"
                            aria-label="<?php esc_attr_e('Siguiente', 'intense-nerd-theme'); ?>">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M6 3L11 8L6 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>

                    <!-- Viewport -->
                    <div class="embla__viewport overflow-hidden">
                        <div class="embla__container flex gap-4 touch-pan-y">

                            <?php if ($use_static) : ?>
                                <?php foreach ($static_members as $member) : ?>
                                    <div class="embla__slide team-slide flex-[0_0_180px] lg:flex-[0_0_200px]">
                                        <?php echo intense_nerd_team_card($member['name'], $member['role'], $member['img']); ?>
                                    </div>
                                <?php endforeach; ?>

                            <?php else : ?>
                                <?php while ($team_query->have_posts()) : $team_query->the_post(); ?>
                                    <?php
                                    $name  = get_the_title();
                                    $role  = get_field('team_role') ?: get_post_meta(get_the_ID(), 'team_role', true);
                                    $photo = get_field('team_photo');
                                    $img   = $photo['url'] ?? intense_nerd_get_thumbnail(get_the_ID(), 'card-thumb');
                                    ?>
                                    <div class="embla__slide team-slide flex-[0_0_180px] lg:flex-[0_0_200px]">
                                        <?php echo intense_nerd_team_card($name, $role, $img); ?>
                                    </div>
                                <?php endwhile;
                                wp_reset_postdata(); ?>
                            <?php endif; ?>

                        </div>
                    </div><!-- /.embla__viewport -->

                    <!-- Dots -->
                    <div class="embla__dots flex gap-2 mt-5" id="teamEmblaDots"></div>

                </div><!-- /.embla -->

            </div><!-- /.col-right -->
        </div><!-- /.team-layout -->
    </div>
</section>

<?php
/**
 * Helper: render tarjeta de miembro
 */
function intense_nerd_team_card(string $name, string $role, string $img): string
{
    ob_start(); ?>
    <div class="team-card group relative overflow-hidden rounded-xl cursor-pointer select-none">
        <!-- Foto -->
        <div class="team-card__img overflow-hidden rounded-xl aspect-[3/4]">
            <img
                src="<?php echo esc_url($img); ?>"
                alt="<?php echo esc_attr($name); ?>"
                class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105"
                draggable="false"
                loading="lazy">
        </div>
        <!-- Overlay con nombre -->
        <div class="team-card__overlay absolute inset-x-0 bottom-0 p-4
                    bg-gradient-to-t from-dark/70 to-transparent
                    rounded-b-xl">
            <p class="font-body font-medium text-cream text-sm leading-tight"><?php echo esc_html($name); ?></p>
            <?php if ($role) : ?>
                <p class="font-body text-cream/70 text-xs mt-0.5"><?php echo esc_html($role); ?></p>
            <?php endif; ?>
        </div>
    </div>
<?php
    return ob_get_clean();
}
?>

<style>
    /* ── Team Section ────────────────────────────────────────── */
    .team-photo-frame img {
        will-change: transform;
    }

    .team-arrow {
        transition: background 0.2s, color 0.2s, border-color 0.2s;
    }

    .team-arrow:hover {
        background: transparent;
    }

    .team-arrow:disabled {
        opacity: 0.3;
        pointer-events: none;
    }

    /* Dot navigation */
    .embla__dot {
        width: 6px;
        height: 6px;
        border-radius: 9999px;
        background: currentColor;
        opacity: 0.25;
        transition: width 0.3s, opacity 0.3s;
        border: none;
        padding: 0;
        cursor: pointer;
    }

    .embla__dot--selected {
        width: 20px;
        opacity: 1;
    }

    /* Drag cursor */
    .embla__viewport.is-dragging {
        cursor: grabbing;
    }

    .embla__container {
        cursor: grab;
    }
</style>

<script>
    (function() {
        // Esperar a que Embla esté disponible (cargado en main.js/bundle)
        function initTeamSlider() {
            if (typeof EmblaCarousel === 'undefined') {
                // Reintentar hasta que esté disponible
                setTimeout(initTeamSlider, 100);
                return;
            }

            const wrap = document.getElementById('teamEmbla');
            if (!wrap) return;

            const viewport = wrap.querySelector('.embla__viewport');
            const prevBtn = wrap.querySelector('.embla__prev');
            const nextBtn = wrap.querySelector('.embla__next');
            const dotsWrap = document.getElementById('teamEmblaDots');

            const embla = EmblaCarousel(viewport, {
                loop: false,
                align: 'start',
                dragFree: true,
                containScroll: 'trimSnaps',
            });

            // ── Dots ──────────────────────────────────────────────────
            const snapCount = embla.scrollSnapList().length;
            let dots = [];

            function buildDots() {
                dotsWrap.innerHTML = '';
                dots = embla.scrollSnapList().map((_, i) => {
                    const btn = document.createElement('button');
                    btn.classList.add('embla__dot', 'text-dark');
                    btn.setAttribute('aria-label', 'Slide ' + (i + 1));
                    btn.addEventListener('click', () => embla.scrollTo(i));
                    dotsWrap.appendChild(btn);
                    return btn;
                });
                updateDots();
            }

            function updateDots() {
                const sel = embla.selectedScrollSnap();
                dots.forEach((d, i) => {
                    d.classList.toggle('embla__dot--selected', i === sel);
                });
            }

            // ── Botones ───────────────────────────────────────────────
            function updateButtons() {
                prevBtn.disabled = !embla.canScrollPrev();
                nextBtn.disabled = !embla.canScrollNext();
            }

            prevBtn.addEventListener('click', () => embla.scrollPrev());
            nextBtn.addEventListener('click', () => embla.scrollNext());

            // ── Eventos Embla ─────────────────────────────────────────
            embla.on('init', () => {
                buildDots();
                updateButtons();
            });
            embla.on('select', () => {
                updateDots();
                updateButtons();
            });
            embla.on('reInit', () => {
                buildDots();
                updateButtons();
            });

            // Cursor drag
            viewport.addEventListener('pointerdown', () => viewport.classList.add('is-dragging'));
            viewport.addEventListener('pointerup', () => viewport.classList.remove('is-dragging'));
        }

        // Iniciar cuando el DOM esté listo
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initTeamSlider);
        } else {
            initTeamSlider();
        }
    })();
</script>