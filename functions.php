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
        'primary-menu'   => __('Menú Principal', 'intense-nerd-theme'),
        'footer-menu'    => __('Menú Footer', 'intense-nerd-theme'),
        'footer-explore' => __('Menú Footer Explore', 'intense-nerd-theme'),
        'footer-general' => __('Menú Footer General', 'intense-nerd-theme'),
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

add_action('wp_ajax_load_more_posts', 'load_more_posts_handler');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts_handler');

function load_more_posts_handler()
{
    $page     = isset($_POST['page']) ? intval($_POST['page']) : 2;
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';

    $args = [
        'post_type'      => 'post',
        'posts_per_page' => 8,
        'paged'          => $page,
    ];

    if ($category) {
        $args['category_name'] = $category;
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $count_offset = ($page - 1) * 8; // para mantener el patrón de clases

        while ($query->have_posts()) : $query->the_post();
            $count_offset++;
            $pos = (($count_offset - 1) % 10) + 1;

            $classes = 'news-card h-full';
            if ($pos === 4)       $classes = 'news-card large large-left';
            elseif ($pos === 5)   $classes = 'news-card pos-5';
            elseif ($pos === 10)  $classes = 'news-card large large-right';

            get_template_part('template-parts/content', 'blog-item', ['classes' => $classes]);
        endwhile;

        wp_reset_postdata();
    }

    wp_die(); // Obligatorio en handlers AJAX de WordPress
}


function theme_customize_contact_section($wp_customize)
{

    // Sección
    $wp_customize->add_section('contact_info_section', [
        'title' => 'Información de Contacto',
        'priority' => 30,
    ]);

    // Teléfono
    $wp_customize->add_setting('contact_phone', [
        'default' => '18006709510',
    ]);

    $wp_customize->add_control('contact_phone', [
        'label' => 'Teléfono',
        'section' => 'contact_info_section',
        'type' => 'text',
    ]);

    // Texto teléfono
    $wp_customize->add_setting('contact_phone_text', [
        'default' => '1 800 670 9510 Toll Free (US, CAN)',
    ]);

    $wp_customize->add_control('contact_phone_text', [
        'label' => 'Texto Teléfono',
        'section' => 'contact_info_section',
        'type' => 'text',
    ]);

    // WhatsApp
    $wp_customize->add_setting('contact_whatsapp', [
        'default' => '51994008833',
    ]);

    $wp_customize->add_control('contact_whatsapp', [
        'label' => 'WhatsApp (solo número con código país)',
        'section' => 'contact_info_section',
        'type' => 'text',
    ]);

    // Email
    $wp_customize->add_setting('contact_email', [
        'default' => 'sales@intenseperu.com',
    ]);

    $wp_customize->add_control('contact_email', [
        'label' => 'Correo',
        'section' => 'contact_info_section',
        'type' => 'text',
    ]);
}

add_action('customize_register', 'theme_customize_contact_section');


function theme_customize_social_links($wp_customize)
{

    $wp_customize->add_section('social_links_section', [
        'title' => 'Redes Sociales',
        'priority' => 35,
    ]);

    $socials = [
        'facebook'  => 'Facebook',
        'instagram' => 'Instagram',
        'twitter'   => 'Twitter / X',
        'linkedin'  => 'LinkedIn',
    ];

    foreach ($socials as $key => $label) {

        $wp_customize->add_setting("social_$key", [
            'default' => '',
        ]);

        $wp_customize->add_control("social_$key", [
            'label' => $label,
            'section' => 'social_links_section',
            'type' => 'url',
        ]);
    }
}

add_action('customize_register', 'theme_customize_social_links');

add_action('wp_enqueue_scripts', function () {

    wp_enqueue_script(
        'megamenu-js',
        get_template_directory_uri() . '/src/modules/megamenu.js',
        [],          // Alpine.js should already be enqueued by your theme
        '1.0.0',
        true         // footer = true
    );

    // Pass AJAX URL to JS
    wp_localize_script('megamenu-js', 'megaMenuConfig', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
    ]);
});

/**
 * ══════════════════════════════════════════════════════════
 *  MEGAMENU — AJAX HANDLERS
 *  Add this block to your functions.php
 * ══════════════════════════════════════════════════════════
 */

// ── 1. Journeys megamenu ──────────────────────────────────────────────────
add_action('wp_ajax_mega_journeys',        'intense_mega_journeys');
add_action('wp_ajax_nopriv_mega_journeys', 'intense_mega_journeys');

function intense_mega_journeys()
{
    // Lists: all journeys grouped by days ACF field
    $all = get_posts([
        'post_type'      => 'journey',   // ← change to your CPT slug
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'ASC',
    ]);

    $grand   = [];  // 10–15 days
    $compact = [];  // 5–9 days
    $short   = [];  // 2–4 days

    foreach ($all as $post) {
        $days = (int) get_field('information_days', $post->ID); // ACF: information.days
        if (!$days) {
            // Try flat field name as fallback
            $days = (int) get_post_meta($post->ID, 'days', true);
        }
        if ($days >= 10) {
            $grand[]   = $post;
        } elseif ($days >= 5) {
            $compact[] = $post;
        } elseif ($days >= 2) {
            $short[]   = $post;
        }
    }

    // Recent 3 cards
    $recent = get_posts([
        'post_type'      => 'journey',
        'posts_per_page' => 3,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);

    $render_list = function (array $items) {
        $out = '';
        if (empty($items)) {
            return '<li><span class="text-dark/30 text-sm italic">—</span></li>';
        }
        foreach ($items as $p) {
            $days = (int) get_field('information_days', $p->ID) ?: (int) get_post_meta($p->ID, 'days', true);
            $out .= '<li>';
            $out .= '<a href="' . esc_url(get_permalink($p)) . '" '
                . 'class="text-sm font-body text-dark/70 hover:text-primary transition-colors underline-offset-2 hover:underline">'
                . ($days ? $days . 'D ' : '') . esc_html($p->post_title)
                . '</a></li>';
        }
        return $out;
    };

    $render_cards = function (array $items) {
        $out = '';
        foreach ($items as $p) {
            $img = get_the_post_thumbnail_url($p->ID, 'medium');
            $out .= '<div class="w-44 shrink-0">';
            if ($img) {
                $out .= '<a href="' . esc_url(get_permalink($p)) . '">'
                    . '<img src="' . esc_url($img) . '" alt="' . esc_attr($p->post_title) . '" '
                    . 'class="aspect-[3/4] w-full object-cover mb-2"></a>';
            } else {
                $out .= '<a href="' . esc_url(get_permalink($p)) . '" '
                    . 'class="block aspect-[3/4] w-full bg-dark/10 mb-2"></a>';
            }
            $out .= '<a href="' . esc_url(get_permalink($p)) . '" '
                . 'class="text-sm font-body text-dark hover:text-primary transition-colors underline-offset-2 hover:underline">'
                . esc_html($p->post_title) . '</a>';
            $out .= '</div>';
        }
        return $out;
    };

    wp_send_json_success([
        'grand'   => $render_list($grand),
        'compact' => $render_list($compact),
        'short'   => $render_list($short),
        'cards'   => $render_cards($recent),
    ]);
}


// ── 2. Destinations megamenu ──────────────────────────────────────────────
add_action('wp_ajax_mega_destinations',        'intense_mega_destinations');
add_action('wp_ajax_nopriv_mega_destinations', 'intense_mega_destinations');

function intense_mega_destinations()
{
    $posts = get_posts([
        'post_type'      => 'destination',   // ← change to your CPT slug
        'posts_per_page' => 6,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);

    $out = '';
    foreach ($posts as $p) {
        $img = get_the_post_thumbnail_url($p->ID, 'medium');
        $out .= '<div>';
        if ($img) {
            $out .= '<a href="' . esc_url(get_permalink($p)) . '">'
                . '<img src="' . esc_url($img) . '" alt="' . esc_attr($p->post_title) . '" '
                . 'class="aspect-[3/4] w-full object-cover mb-2"></a>';
        } else {
            $out .= '<a href="' . esc_url(get_permalink($p)) . '" '
                . 'class="block aspect-[3/4] w-full bg-dark/10 mb-2"></a>';
        }
        $out .= '<a href="' . esc_url(get_permalink($p)) . '" '
            . 'class="text-sm font-body text-dark hover:text-primary transition-colors underline-offset-2 hover:underline">'
            . esc_html($p->post_title) . '</a>';
        $out .= '</div>';
    }

    // Mobile cards: 2-col image grid
    $mobile_cards = '';
    foreach ($posts as $p) {
        $img = get_the_post_thumbnail_url($p->ID, 'medium');
        $mobile_cards .= '<a href="' . esc_url(get_permalink($p)) . '" class="group block">';
        if ($img) {
            $mobile_cards .= '<div class="aspect-square overflow-hidden mb-1.5">'
                . '<img src="' . esc_url($img) . '" alt="' . esc_attr($p->post_title) . '" '
                . 'class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"></div>';
        } else {
            $mobile_cards .= '<div class="aspect-square bg-dark/10 mb-1.5"></div>';
        }
        $mobile_cards .= '<span class="text-xs text-dark group-hover:text-primary transition-colors underline-offset-1 underline">'
            . esc_html($p->post_title) . '</span>';
        $mobile_cards .= '</a>';
    }

    // Mobile list (text links only)
    $mobile_list = '';
    foreach ($posts as $p) {
        $mobile_list .= '<li class="border-b border-dark/10">'
            . '<a href="' . esc_url(get_permalink($p)) . '" '
            . 'class="flex py-4 font-body text-dark text-base hover:text-primary transition-colors">'
            . esc_html($p->post_title) . '</a></li>';
    }

    wp_send_json_success(['cards' => $out, 'mobile_cards' => $mobile_cards, 'mobile_list' => $mobile_list]);
}


// ── 3. Blog megamenu ──────────────────────────────────────────────────────
add_action('wp_ajax_mega_blog',        'intense_mega_blog');
add_action('wp_ajax_nopriv_mega_blog', 'intense_mega_blog');

function intense_mega_blog()
{
    // Left list: 4 most recent posts ordered by date
    $list_posts = get_posts([
        'post_type'      => 'post',
        'posts_per_page' => 4,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);

    // Right cards: posts marked as "featured" (sticky) or fallback to latest 4
    $featured = get_posts([
        'post_type'      => 'post',
        'posts_per_page' => 4,
        'post__in'       => get_option('sticky_posts') ?: [0],
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);
    if (empty($featured)) {
        $featured = $list_posts;
    }

    // Render list
    $list_html = '';
    foreach ($list_posts as $p) {
        $list_html .= '<li>'
            . '<a href="' . esc_url(get_permalink($p)) . '" '
            . 'class="text-sm font-body text-dark/70 hover:text-primary transition-colors underline-offset-2 hover:underline leading-snug">'
            . esc_html($p->post_title)
            . '</a></li>';
    }

    // Render cards
    $cards_html = '';
    foreach ($featured as $p) {
        $img = get_the_post_thumbnail_url($p->ID, 'medium');
        $cards_html .= '<div>';
        if ($img) {
            $cards_html .= '<a href="' . esc_url(get_permalink($p)) . '">'
                . '<img src="' . esc_url($img) . '" alt="' . esc_attr($p->post_title) . '" '
                . 'class="aspect-[4/3] w-full object-cover mb-2"></a>';
        } else {
            $cards_html .= '<a href="' . esc_url(get_permalink($p)) . '" '
                . 'class="block aspect-[4/3] w-full bg-dark/10 mb-2"></a>';
        }
        $cards_html .= '<a href="' . esc_url(get_permalink($p)) . '" '
            . 'class="text-sm font-body text-dark hover:text-primary transition-colors underline-offset-2 hover:underline line-clamp-2 leading-snug">'
            . esc_html($p->post_title) . '</a>';
        $cards_html .= '</div>';
    }

    // Mobile list
    $mobile_list = '';
    foreach ($list_posts as $p) {
        $mobile_list .= '<li class="border-b border-dark/10">'
            . '<a href="' . esc_url(get_permalink($p)) . '" '
            . 'class="flex py-4 font-body text-dark text-xs hover:text-primary transition-colors">'
            . esc_html($p->post_title) . '</a></li>';
    }

    wp_send_json_success([
        'list'        => $list_html,
        'cards'       => $cards_html,
        'mobile_list' => $mobile_list,
    ]);
}
