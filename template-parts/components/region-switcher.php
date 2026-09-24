<?php
/**
 * Selector de regiones (banderas) — administrable en Customize > Selector de Regiones.
 *
 * @param array $args {
 *     @type string $color     'light' (header transparente) o 'dark' (header blanco / drawer).
 *     @type bool   $drop_up   Abre la lista hacia arriba (drawer móvil).
 *     @type bool   $tooltip   Muestra el tooltip al pasar el mouse.
 * }
 */

if (!get_theme_mod('region_switcher_enabled', true)) {
    return;
}

$regions = intense_get_regions();
if (count($regions) < 2) {
    return;
}

$current = current(array_filter($regions, fn($r) => $r['current'])) ?: reset($regions);
$color = ($args['color'] ?? 'light') === 'dark' ? 'rs--dark' : 'rs--light';
$drop_up = !empty($args['drop_up']);
$show_tooltip = $args['tooltip'] ?? true;
$tooltip = get_theme_mod('region_switcher_tooltip', 'Explore our Regions');
?>
<div class="rs <?php echo esc_attr($color); ?> <?php echo $drop_up ? 'rs--up' : ''; ?>"
    x-data="{ regionOpen: false }" @click.outside="regionOpen = false" @keydown.escape="regionOpen = false">

    <button type="button" class="rs-trigger" @click="regionOpen = !regionOpen" :aria-expanded="regionOpen"
        aria-haspopup="true" aria-label="<?php echo esc_attr($tooltip); ?>">
        <img src="<?php echo esc_url($current['flag']); ?>" alt="" class="rs-flag" width="32" height="32">
        <svg class="rs-chevron" :class="regionOpen && 'is-open'" width="16" height="16" fill="none" stroke="currentColor"
            stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M6 9l6 6 6-6" />
        </svg>
        <?php if ($show_tooltip && $tooltip): ?>
            <span class="rs-tooltip" x-show="!regionOpen" role="tooltip"><?php echo esc_html($tooltip); ?></span>
        <?php endif; ?>
    </button>

    <div class="rs-menu" x-cloak x-show="regionOpen" x-transition.opacity.duration.150ms style="display:none;">
        <?php foreach ($regions as $region): ?>
            <?php if ($region['current']): ?>
                <span class="rs-item is-current" aria-current="true">
                    <img src="<?php echo esc_url($region['flag']); ?>" alt="" class="rs-flag" width="32" height="32">
                    <?php echo esc_html($region['label']); ?>
                </span>
            <?php else: ?>
                <a class="rs-item" href="<?php echo esc_url($region['url']); ?>">
                    <img src="<?php echo esc_url($region['flag']); ?>" alt="" class="rs-flag" width="32" height="32">
                    <?php echo esc_html($region['label']); ?>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<?php
// Estilos una sola vez por página (el componente se usa en header y drawer).
if (!defined('INTENSE_RS_STYLES')):
    define('INTENSE_RS_STYLES', true); ?>
    <style>
        .rs { position: relative; display: inline-flex; }
        .rs-trigger { position: relative; display: inline-flex; align-items: center; gap: 14px; background: none; border: 0; padding: 0; cursor: pointer; }
        .rs--light .rs-trigger { color: #fff; }
        .rs--dark .rs-trigger { color: var(--color-dark, #161616); }
        .rs-flag { width: 32px; height: 32px; border-radius: 9999px; object-fit: cover; flex-shrink: 0; box-shadow: 0 0 0 1px rgba(0, 0, 0, .12); }
        .rs--light .rs-trigger .rs-flag { box-shadow: 0 0 0 1px rgba(255, 255, 255, .85); }
        .rs-chevron { transition: transform .2s ease; }
        .rs-chevron.is-open { transform: rotate(180deg); }

        .rs-tooltip { position: absolute; bottom: calc(100% + 14px); left: 16px; transform: translateX(-50%); white-space: nowrap; background: rgba(22, 22, 22, .88); color: #fff; font-size: 0.9375rem; font-weight: 300; line-height: 1; padding: 10px 16px; border-radius: 4px; opacity: 0; visibility: hidden; transition: opacity .15s ease, visibility .15s ease; pointer-events: none; z-index: 60; }
        .rs-tooltip::after { content: ""; position: absolute; top: 100%; left: 50%; transform: translateX(-50%); border: 8px solid transparent; border-top-color: rgba(22, 22, 22, .88); }
        /* Header fijo al hacer scroll: no hay espacio arriba, el tooltip va debajo */
        .site-header.scrolled .rs-tooltip { bottom: auto; top: calc(100% + 14px); }
        .site-header.scrolled .rs-tooltip::after { top: auto; bottom: 100%; border-top-color: transparent; border-bottom-color: rgba(22, 22, 22, .88); }
        .rs-trigger:hover .rs-tooltip, .rs-trigger:focus-visible .rs-tooltip { opacity: 1; visibility: visible; }

        .rs-menu { position: absolute; top: calc(100% + 18px); right: -16px; min-width: 250px; background: #fff; border-radius: 6px; box-shadow: 0 12px 32px rgba(0, 0, 0, .14); padding: 12px 0; z-index: 60; }
        .rs--up .rs-menu { top: auto; bottom: calc(100% + 12px); }
        .rs-item { display: flex; align-items: center; gap: 22px; padding: 12px 28px; color: var(--color-dark, #161616); font-size: 1.0625rem; font-weight: 300; text-decoration: none; transition: background-color .15s ease; }
        a.rs-item:hover { background: var(--color-cream, #f7f3ee); }
        .rs-item.is-current { opacity: .35; cursor: default; }
    </style>
<?php endif; ?>
