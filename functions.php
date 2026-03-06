<?php

/**
 * Functions y definiciones del tema Intense Nerd
 *
 * @package intense-nerd-theme
 */

// ── Soporte del Tema ───────────────────────────────────────────────────────────
function intense_nerd_setup()
{
    // Hace que el tema traduzca textos
    load_theme_textdomain('intense-nerd-theme', get_template_directory() . '/languages');

    // Soporte de <title> automático
    add_theme_support('title-tag');

    // Soporte de imágenes destacadas
    add_theme_support('post-thumbnails');

    // Soporte de HTML5
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
    ]);

    // Soporte de logotipo personalizado
    add_theme_support('custom-logo', [
        'height' => 60,
        'width' => 200,
        'flex-height' => true,
        'flex-width' => true,
    ]);

    // Registrar menús de navegación
    register_nav_menus([
        'primary-menu' => __('Menú Principal', 'intense-nerd-theme'),
        'footer-menu' => __('Menú Footer', 'intense-nerd-theme'),
    ]);

    // Tamaños de imagen adicionales
    add_image_size('card-thumb', 600, 400, true);
    add_image_size('hero-banner', 1920, 800, true);
    add_image_size('gallery-sq', 600, 600, true);
}
add_action('after_setup_theme', 'intense_nerd_setup');

// ── Enqueue de Assets Vite ────────────────────────────────────────────────────
function intense_nerd_scripts()
{
    $dist = get_template_directory_uri() . '/dist';
    $is_dev = defined('VITE_DEV') && VITE_DEV;

    if ($is_dev) {
        // Modo desarrollo — Vite HMR desde localhost:5173
        echo '<script type="module" src="http://localhost:5173/@vite/client"></script>' . "\n";
        echo '<script type="module" src="http://localhost:5173/src/main.js"></script>' . "\n";
        return;
    }

    // Modo producción — leer manifest generado por Vite
    $manifest_path = get_template_directory() . '/dist/.vite/manifest.json';
    if (!file_exists($manifest_path)) {
        return;
    }

    $manifest = json_decode(file_get_contents($manifest_path), true);
    $entry = $manifest['src/main.js'] ?? null;
    if (!$entry) {
        return;
    }

    // Enqueue CSS
    $css_file = $entry['css'][0] ?? 'app.css';
    wp_enqueue_style(
        'intense-nerd-css',
        $dist . '/' . $css_file,
        [],
        null
    );

    // Enqueue JS
    wp_enqueue_script(
        'intense-nerd-js',
        $dist . '/' . $entry['file'],
        [],
        null,
        true
    );

    // Agregar type="module" al script
    add_filter('script_loader_tag', function ($tag, $handle) {
        if ($handle === 'intense-nerd-js') {
            return str_replace('<script ', '<script type="module" ', $tag);
        }
        return $tag;
    }, 10, 2);
}
add_action('wp_enqueue_scripts', 'intense_nerd_scripts');

// ── Widgets / Sidebars ────────────────────────────────────────────────────────
function intense_nerd_widgets_init()
{
    register_sidebar([
        'name' => __('Sidebar Principal', 'intense-nerd-theme'),
        'id' => 'sidebar-1',
        'description' => __('Sidebar visible en páginas de blog.', 'intense-nerd-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-8">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="heading-3-small text-dark mb-4">',
        'after_title' => '</h3>',
    ]);

    register_sidebar([
        'name' => __('Footer Widgets', 'intense-nerd-theme'),
        'id' => 'footer-1',
        'description' => __('Widgets en el footer del sitio.', 'intense-nerd-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="heading-3-small text-cream mb-4">',
        'after_title' => '</h4>',
    ]);
}
add_action('widgets_init', 'intense_nerd_widgets_init');

// ── Helper: Número de WhatsApp ────────────────────────────────────────────────
function intense_nerd_whatsapp_number()
{
    // Definir en wp-config.php o cambiar directamente aquí
    return defined('WHATSAPP_NUMBER') ? WHATSAPP_NUMBER : '51999999999';
}

// ── Helper: Obtener imagen de portada con fallback ────────────────────────────
function intense_nerd_get_thumbnail($post_id = null, $size = 'large')
{
    $post_id = $post_id ?? get_the_ID();
    if (has_post_thumbnail($post_id)) {
        return get_the_post_thumbnail_url($post_id, $size);
    }
    return get_template_directory_uri() . '/src/img/placeholder.jpg';
}

// ── Permitir SVG en la librería de medios ─────────────────────────────────────
function intense_nerd_allow_svg($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'intense_nerd_allow_svg');

// ── Eliminar emojis de WordPress (ahorra recursos) ───────────────────────────
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

// ── Desactivar Gutenberg en páginas (usar ACF) ───────────────────────────────
// Descomentar si se usa ACF para todo el contenido
// add_filter( 'use_block_editor_for_post', '__return_false' );

// ── Excerpt length personalizado ──────────────────────────────────────────────
function intense_nerd_excerpt_length($length)
{
    return 25; // palabras
}
add_filter('excerpt_length', 'intense_nerd_excerpt_length', 999);

function intense_nerd_excerpt_more($more)
{
    return '...';
}
add_filter('excerpt_more', 'intense_nerd_excerpt_more');

// ── Ocultar barra de administración en el frontend ────────────────────────────
add_filter('show_admin_bar', '__return_false');
