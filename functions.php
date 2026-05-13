<?php

/**
 * Functions y definiciones del tema Intense Nerd
 *
 * @package intense-nerd-theme
 */

// ── Modo de prueba de emails ───────────────────────────────────────────────────
// Cambia a true para redirigir todos los emails internos a $INTENSE_TEST_EMAIL.
// Cambia a false para enviar a los correos reales del equipo.
define('INTENSE_EMAIL_TEST_MODE', true);
define('INTENSE_EMAIL_TEST_ADDRESS', 'kevin.gomez@nerd.pe');

// Correos reales del equipo (se usan cuando TEST_MODE = false)
define('INTENSE_TEAM_EMAILS', ['sales@intenseperu.com', 'roberto@intenseperu.com', 'sofia@intenseperu.com']);

// ── Soporte del Tema ───────────────────────────────────────────────────────────
function intense_nerd_setup()
{
  load_theme_textdomain('intense-nerd-theme', get_template_directory() . '/languages');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', [
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    'script',
    'style',
  ]);
  add_theme_support('custom-logo', [
    'height' => 60,
    'width' => 200,
    'flex-height' => true,
    'flex-width' => true,
  ]);
  register_nav_menus([
    'primary-menu' => __('Menú Principal', 'intense-nerd-theme'),
    'footer-menu' => __('Menú Footer', 'intense-nerd-theme'),
    'footer-explore' => __('Menú Footer Explore', 'intense-nerd-theme'),
    'footer-general' => __('Menú Footer General', 'intense-nerd-theme'),
  ]);
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
    wp_enqueue_script('intense-nerd-js', 'http://localhost:5174/src/main.js', [], null, true);
    add_filter('script_loader_tag', function ($tag, $handle) {
      if ($handle === 'intense-nerd-js') {
        $vite_client = '<script type="module" src="http://localhost:5174/@vite/client"></script>' . "\n";
        return $vite_client . str_replace('<script ', '<script type="module" crossorigin ', $tag);
      }
      return $tag;
    }, 10, 2);
    return;
  }

  $manifest_path = get_template_directory() . '/dist/.vite/manifest.json';
  if (!file_exists($manifest_path))
    return;

  $manifest = json_decode(file_get_contents($manifest_path), true);
  $entry = $manifest['src/main.js'] ?? null;
  if (!$entry)
    return;

  $css_file = $entry['css'][0] ?? 'app.css';
  wp_enqueue_style('intense-nerd-css', $dist . '/' . $css_file, [], null);

  wp_enqueue_script('intense-nerd-js', $dist . '/' . $entry['file'], [], null, true);

  add_filter('script_loader_tag', function ($tag, $handle) {
    if ($handle === 'intense-nerd-js') {
      return str_replace('<script ', '<script type="module" crossorigin ', $tag);
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

// ── Eliminar emojis de WordPress ─────────────────────────────────────────────
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

// ── Excerpt length personalizado ──────────────────────────────────────────────
function intense_nerd_excerpt_length($length)
{
  return 25;
}
add_filter('excerpt_length', 'intense_nerd_excerpt_length', 999);

function intense_nerd_excerpt_more($more)
{
  return '...';
}
add_filter('excerpt_more', 'intense_nerd_excerpt_more');

// ── Load More: Posts ──────────────────────────────────────────────────────────
add_action('wp_ajax_load_more_posts', 'load_more_posts_handler');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts_handler');

function load_more_posts_handler()
{
  $page = isset($_POST['page']) ? intval($_POST['page']) : 2;
  $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';

  $args = [
    'post_type' => 'post',
    'posts_per_page' => 8,
    'paged' => $page,
  ];
  if ($category)
    $args['category_name'] = $category;

  $query = new WP_Query($args);

  if ($query->have_posts()) {
    $count_offset = ($page - 1) * 8;
    while ($query->have_posts()):
      $query->the_post();
      $count_offset++;
      $pos = (($count_offset - 1) % 10) + 1;

      $classes = 'news-card h-full';
      if ($pos === 4)
        $classes = 'news-card large large-left';
      elseif ($pos === 5)
        $classes = 'news-card pos-5';
      elseif ($pos === 10)
        $classes = 'news-card large large-right';

      get_template_part('template-parts/content', 'blog-item', ['classes' => $classes]);
    endwhile;
    wp_reset_postdata();
  }
  wp_die();
}

// ── Load More: Journeys ───────────────────────────────────────────────────────
add_action('wp_ajax_load_more_journeys', 'load_more_journeys_handler');
add_action('wp_ajax_nopriv_load_more_journeys', 'load_more_journeys_handler');

function load_more_journeys_handler()
{
  $page = isset($_POST['page']) ? intval($_POST['page']) : 2;

  $args = [
    'post_type' => 'journey',
    'posts_per_page' => 9,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $page,
  ];

  $query = new WP_Query($args);

  if ($query->have_posts()) {
    $index = ($page - 1) * 9;
    while ($query->have_posts()):
      $query->the_post();
      $information = get_field('information');
      $features = get_field('features');

      $image = get_the_post_thumbnail_url(get_the_ID(), 'large');
      $title = get_the_title();
      $days_val = (int) ($information['days'] ?? 0);
      $duration = $days_val ? $days_val . ' Days' : '';
      $price_val = $features['price'] ?? '';
      $price = $price_val ? 'USD ' . number_format($price_val) : '';
      $link = get_permalink();
      ?>
      <div class="journey-card" data-days="<?php echo esc_attr($days_val); ?>">
        <?php
        get_template_part('template-parts/components/card-itinerary', null, [
          'image' => $image,
          'title' => $title,
          'price' => $price,
          'duration' => $duration,
          'post_id' => get_the_ID(),
          'link' => $link,
          'link_text' => 'Explore itinerary',
          'aos_delay' => ($index % 3) * 100,
          'badges' => [],
        ]);
        ?>
      </div>
      <?php
      $index++;
    endwhile;
    wp_reset_postdata();
  }
  wp_die();
}

// ── Customizer: Logo Dark ─────────────────────────────────────────────────────
function theme_customize_logo_dark($wp_customize)
{
  $wp_customize->add_setting('logo_dark', [
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
  ]);

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo_dark', [
    'label' => 'Logo Dark Version',
    'description' => 'Dark version logo for light backgrounds (white header, mobile drawer, emails). Upload the dark version.',
    'section' => 'title_tagline',
    'priority' => 9,
  ]));
}
add_action('customize_register', 'theme_customize_logo_dark');

// ── Customizer: Información de Contacto ───────────────────────────────────────
function theme_customize_contact_section($wp_customize)
{
  $wp_customize->add_section('contact_info_section', [
    'title' => 'Información de Contacto',
    'priority' => 30,
  ]);

  $fields = [
    'contact_phone' => ['label' => 'Teléfono', 'default' => '18006709510', 'type' => 'text'],
    'contact_phone_text' => ['label' => 'Texto Teléfono', 'default' => '1 800 670 9510 Toll Free (US, CAN)', 'type' => 'text'],
    'contact_whatsapp' => ['label' => 'WhatsApp (solo número con código país)', 'default' => '51 994 008 833', 'type' => 'text'],
    'contact_email' => ['label' => 'Correo', 'default' => 'sales@intenseperu.com', 'type' => 'text'],
  ];

  foreach ($fields as $key => $cfg) {
    $wp_customize->add_setting($key, ['default' => $cfg['default']]);
    $wp_customize->add_control($key, [
      'label' => $cfg['label'],
      'section' => 'contact_info_section',
      'type' => $cfg['type'],
    ]);
  }
}
add_action('customize_register', 'theme_customize_contact_section');

add_filter('get_terms_args', function ($args, $taxonomies) {
  if (in_array('post_tag', $taxonomies)) {
    $args['orderby'] = 'term_order';
    $args['order'] = 'ASC';
  }
  return $args;
}, 10, 2);

// ── Customizer: Redes Sociales ────────────────────────────────────────────────
function theme_customize_social_links($wp_customize)
{
  $wp_customize->add_section('social_links_section', [
    'title' => 'Redes Sociales',
    'priority' => 35,
  ]);

  $socials = [
    'facebook' => 'Facebook',
    'instagram' => 'Instagram',
    'twitter' => 'Twitter / X',
    'linkedin' => 'LinkedIn',
  ];

  foreach ($socials as $key => $label) {
    $wp_customize->add_setting("social_$key", ['default' => '']);
    $wp_customize->add_control("social_$key", [
      'label' => $label,
      'section' => 'social_links_section',
      'type' => 'url',
    ]);
  }
}
add_action('customize_register', 'theme_customize_social_links');

// ── Megamenu JS + AJAX URL ────────────────────────────────────────────────────
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script('megamenu-js', get_template_directory_uri() . '/src/modules/megamenu.js', [], '1.0.0', true);
  wp_localize_script('megamenu-js', 'megaMenuConfig', ['ajaxUrl' => admin_url('admin-ajax.php')]);
});

// ── Megamenu: Journeys ────────────────────────────────────────────────────────
add_action('wp_ajax_mega_journeys', 'intense_mega_journeys');
add_action('wp_ajax_nopriv_mega_journeys', 'intense_mega_journeys');

function intense_mega_journeys()
{
  $all = get_posts(['post_type' => 'journey', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'ASC']);

  $grand = $compact = $short = [];
  foreach ($all as $post) {
    $days = (int) get_field('information_days', $post->ID) ?: (int) get_post_meta($post->ID, 'days', true);
    $post->_days = $days;
    if ($days >= 10)
      $grand[] = $post;
    elseif ($days >= 5)
      $compact[] = $post;
    elseif ($days >= 2)
      $short[] = $post;
  }

  $sort_by_days = fn($a, $b) => $b->_days - $a->_days;
  usort($grand, $sort_by_days);
  usort($compact, $sort_by_days);
  usort($short, $sort_by_days);

  $recent = get_posts(['post_type' => 'journey', 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC']);

  $render_list = function (array $items) {
    if (empty($items))
      return '<li><span class="text-dark/30 text-sm italic">—</span></li>';
    $out = '';
    foreach ($items as $p) {
      $out .= '<li><a href="' . esc_url(get_permalink($p)) . '" class="text-xs lg:text-sm font-body font-light text-dark/70 hover:text-primary leading-none transition-colors underline-offset-2 hover:underline">' . esc_html($p->post_title) . '</a></li>';
    }
    return $out;
  };

  $render_cards = function (array $items) {
    $out = '';
    foreach ($items as $p) {
      $img = get_the_post_thumbnail_url($p->ID, 'full');
      $out .= '<div class="w-full shrink-0">';
      $out .= $img
        ? '<a href="' . esc_url(get_permalink($p)) . '" class="block mb-3 relative group"><div class="w-full h-[300px] shrink-0 bg-cover bg-center bg-no-repeat relative overflow-hidden group-hover:opacity-90 transition-opacity" style="background-image: url(\'' . esc_url($img) . '\');"></div></a>'
        : '<a href="' . esc_url(get_permalink($p)) . '" class="block mb-2"><div class="w-full h-[300px] shrink-0 bg-dark/10 rounded-lg relative overflow-hidden"></div></a>';
      $out .= '<a href="' . esc_url(get_permalink($p)) . '" class="text-xs font-body text-dark hover:text-primary transition-colors underline-offset-2 hover:underline line-clamp-2 leading-snug">' . esc_html($p->post_title) . '</a>';
      $out .= '</div>';
    }
    return $out;
  };

  wp_send_json_success([
    'grand' => $render_list($grand),
    'compact' => $render_list($compact),
    'short' => $render_list($short),
    'cards' => $render_cards($recent),
  ]);
}

// ── Megamenu: Destinations ────────────────────────────────────────────────────
add_action('wp_ajax_mega_destinations', 'intense_mega_destinations');
add_action('wp_ajax_nopriv_mega_destinations', 'intense_mega_destinations');

function intense_mega_destinations()
{
  $posts = get_posts(['post_type' => 'destination', 'posts_per_page' => 6, 'orderby' => 'date', 'order' => 'DESC']);

  $out = $mobile_cards = $mobile_list = '';
  foreach ($posts as $p) {
    $img = get_the_post_thumbnail_url($p->ID, 'full');
    $url = esc_url(get_permalink($p));
    $name = esc_html($p->post_title);

    $out .= '<div>';
    $out .= $img
      ? '<a href="' . $url . '" class="block mb-3 relative group"><div class="w-full h-[300px] shrink-0 bg-cover bg-center bg-no-repeat relative overflow-hidden group-hover:scale-105 transition-transform duration-500" style="background-image: url(\'' . esc_url($img) . '\');"></div></a>'
      : '<a href="' . $url . '" class="block mb-2"><div class="w-full h-[300px] shrink-0 bg-dark/10 relative overflow-hidden"></div></a>';
    $out .= '<a href="' . $url . '" class="text-xs font-body text-dark hover:text-primary transition-colors underline-offset-2 hover:underline line-clamp-2 leading-snug">' . $name . '</a>';
    $out .= '</div>';

    $mobile_cards .= '<a href="' . $url . '" class="group block">';
    $mobile_cards .= $img
      ? '<div class="w-full h-[200px] shrink-0 overflow-hidden rounded-lg mb-2 relative"><div class="w-full h-full bg-cover bg-center bg-no-repeat group-hover:scale-105 transition-transform duration-500" style="background-image: url(\'' . esc_url($img) . '\');"></div></div>'
      : '<div class="w-full h-[200px] shrink-0 bg-dark/10 rounded-lg mb-1.5 relative overflow-hidden"></div>';
    $mobile_cards .= '<span class="text-xs font-body text-dark hover:text-primary transition-colors underline-offset-2 hover:underline line-clamp-2 leading-snug">' . $name . '</span></a>';

    $mobile_list .= '<li class="border-b border-dark/10"><a href="' . $url . '" class="flex py-4 font-body text-dark text-base hover:text-primary transition-colors">' . $name . '</a></li>';
  }

  wp_send_json_success(['cards' => $out, 'mobile_cards' => $mobile_cards, 'mobile_list' => $mobile_list]);
}

// ── Megamenu: Blog ────────────────────────────────────────────────────────────
add_action('wp_ajax_mega_blog', 'intense_mega_blog');
add_action('wp_ajax_nopriv_mega_blog', 'intense_mega_blog');

function intense_mega_blog()
{
  $list_posts = get_posts(['post_type' => 'post', 'posts_per_page' => 4, 'orderby' => 'date', 'order' => 'DESC']);
  $featured = get_posts(['post_type' => 'post', 'posts_per_page' => 4, 'post__in' => get_option('sticky_posts') ?: [0], 'orderby' => 'date', 'order' => 'DESC']);
  if (empty($featured))
    $featured = $list_posts;

  $list_html = $cards_html = $mobile_list = '';

  foreach ($list_posts as $p) {
    $list_html .= '<li><a href="' . esc_url(get_permalink($p)) . '" class="text-sm font-light font-body text-dark/70 hover:text-primary transition-colors underline-offset-2 hover:underline leading-snug">' . esc_html($p->post_title) . '</a></li>';
    $mobile_list .= '<li class="border-b border-dark/10"><a href="' . esc_url(get_permalink($p)) . '" class="flex py-4 font-body text-dark text-xs hover:text-primary transition-colors">' . esc_html($p->post_title) . '</a></li>';
  }

  foreach ($featured as $p) {
    $img = get_the_post_thumbnail_url($p->ID, 'full');
    $cards_html .= '<div>';
    $cards_html .= $img
      ? '<a href="' . esc_url(get_permalink($p)) . '" class="block mb-3 relative group"><div class="w-full h-[300px] shrink-0 bg-cover bg-center bg-no-repeat relative overflow-hidden group-hover:scale-105 transition-transform duration-500" style="background-image: url(\'' . esc_url($img) . '\');"></div></a>'
      : '<a href="' . esc_url(get_permalink($p)) . '" class="block mb-2"><div class="w-full h-[300px] shrink-0 bg-dark/10 rounded-lg relative overflow-hidden"></div></a>';
    $cards_html .= '<a href="' . esc_url(get_permalink($p)) . '" class="text-xs font-body text-dark hover:text-primary transition-colors underline-offset-2 hover:underline line-clamp-2 leading-snug">' . esc_html($p->post_title) . '</a>';
    $cards_html .= '</div>';
  }

  wp_send_json_success(['list' => $list_html, 'cards' => $cards_html, 'mobile_list' => $mobile_list]);
}

// ── Forms: Localizar ajaxUrl + nonce ─────────────────────────────────────────
add_action('wp_enqueue_scripts', function () {
  wp_localize_script('intense-nerd-js', 'intenseAjax', [
    'ajaxUrl' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('intense_forms_nonce'),
  ]);
}, 20);

// ══════════════════════════════════════════════════════════════════════════════
//  EMAIL HELPERS
// ══════════════════════════════════════════════════════════════════════════════

/**
 * URL del logo para emails. Usa siempre URLs externas — los clientes de email
 * (Gmail, Outlook) bloquean data: URIs y eliminan el atributo src.
 */
function intense_email_logo_src()
{
  static $cache = null;
  if ($cache !== null)
    return $cache;

  $cache = 'https://intenseperu.com/wp-content/uploads/2026/04/intense_logo_mails.png';
  return $cache;
}

/**
 * Footer HTML reutilizable para todos los templates de email.
 */
function intense_email_footer_html()
{
  return <<<HTML
  <tr>
    <td style="background:#423931;padding:26px 40px;text-align:center;">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center" style="padding-bottom:12px;">
            <a href="https://intenseperu.com" style="font-size:10px;color:rgba(255,255,255,0.55);text-decoration:none;letter-spacing:0.08em;text-transform:uppercase;margin:0 8px;">Website</a>
            <a href="https://intenseperu.com/journeys" style="font-size:10px;color:rgba(255,255,255,0.55);text-decoration:none;letter-spacing:0.08em;text-transform:uppercase;margin:0 8px;">Journeys</a>
            <a href="https://intenseperu.com/contact" style="font-size:10px;color:rgba(255,255,255,0.55);text-decoration:none;letter-spacing:0.08em;text-transform:uppercase;margin:0 8px;">Contact</a>
          </td>
        </tr>
        <tr>
          <td align="center" style="padding-bottom:10px;font-size:12px;color:rgba(255,255,255,0.55);">
            <span style="color:#dc973c;">1 800 670 9510</span> Toll Free (US, CAN) &nbsp;·&nbsp; <span style="color:#dc973c;">+51 994 008 833</span> WhatsApp
          </td>
        </tr>
        <tr><td align="center" style="font-size:11px;color:rgba(255,255,255,0.35);line-height:1.7;">sales@intenseperu.com · intenseperu.com</td></tr>
        <tr><td align="center" style="font-size:11px;color:rgba(255,255,255,0.35);line-height:1.7;padding-top:4px;">© Intense Peru 2007 – 2026. All rights reserved. Lima, Perú</td></tr>
      </table>
    </td>
  </tr>
HTML;
}

/**
 * Header HTML reutilizable: fondo oscuro + logo.
 */
function intense_email_header_html()
{
  $logo_src = intense_email_logo_src();
  return <<<HTML
  <tr>
    <td style="background:#423931;padding:24px 40px;text-align:center;">
      <img src="{$logo_src}" alt="Intense Peru" width="160" style="display:block;margin:0 auto;max-width:160px;height:auto;border:0;">
    </td>
  </tr>
HTML;
}

/**
 * Envuelve las filas <tr> de un email en la estructura base (DOCTYPE + tabla exterior).
 */
function intense_email_wrap($title, $rows_html)
{
  return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{$title}</title>
</head>
<body style="margin:0;padding:0;background:#fffcf7;font-family:Arial,Helvetica,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#fffcf7;padding:32px 16px;">
<tr><td align="center">
<table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#ffffff;">
{$rows_html}
</table>
</td></tr>
</table>
</body>
</html>
HTML;
}

// ══════════════════════════════════════════════════════════════════════════════
//  CONTACT FORM — Templates HTML
// ══════════════════════════════════════════════════════════════════════════════

/**
 * Email interno al equipo cuando llega un mensaje del formulario de contacto.
 */
function intense_email_contact_internal($data)
{
  $name = esc_html($data['first_name'] . ' ' . $data['last_name']);
  $email = esc_html($data['email']);
  $telephone = $data['telephone'] ? esc_html($data['telephone']) : '<em style="color:#776c60;">—</em>';
  $mensaje = nl2br(esc_html($data['mensaje']));
  $timestamp = current_time('d M Y · H:i');

  $rows = intense_email_header_html();
  $rows .= <<<HTML

  <tr>
    <td style="background:#b76739;padding:32px 40px;text-align:center;">
      <h1 style="color:#ffffff;font-size:24px;font-weight:normal;font-family:Georgia,serif;margin:0 0 6px;letter-spacing:0.04em;">New Contact Message</h1>
      <p style="color:rgba(255,255,255,0.85);font-size:13px;margin:0;line-height:1.5;">A visitor submitted the contact form on intenseperu.com</p>
    </td>
  </tr>

  <tr>
    <td style="padding:36px 40px;background:#ffffff;">

      <table width="100%" cellpadding="0" cellspacing="0" style="background:#fcf1eb;border:1px solid #e0c9bd;margin-bottom:20px;">
        <tr><td style="padding:12px 16px;font-size:13px;color:#b76739;">
          ★ &nbsp;Reply to this email is already set to the client's address.
        </td></tr>
      </table>

      <div style="display:inline-block;background:#fcf1eb;color:#b76739;font-size:10px;letter-spacing:0.1em;text-transform:uppercase;padding:4px 10px;margin-bottom:20px;">Contact Details</div>

      <table width="100%" cellpadding="0" cellspacing="0">
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Name</td>
            <td style="font-size:14px;color:#161616;">{$name}</td>
          </tr></table>
        </td></tr>
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Email</td>
            <td style="font-size:14px;color:#161616;"><a href="mailto:{$email}" style="color:#b76739;text-decoration:none;">{$email}</a></td>
          </tr></table>
        </td></tr>
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Phone / WhatsApp</td>
            <td style="font-size:14px;color:#161616;">{$telephone}</td>
          </tr></table>
        </td></tr>
      </table>

      <table width="100%" cellpadding="0" cellspacing="0" style="margin:20px 0;">
        <tr><td style="background:#fcf1eb;border-left:3px solid #b76739;padding:16px 20px;">
          <div style="font-size:10px;text-transform:uppercase;letter-spacing:0.12em;color:#b76739;margin-bottom:8px;">Message</div>
          <div style="font-size:14px;color:#161616;line-height:1.6;font-style:italic;">{$mensaje}</div>
        </td></tr>
      </table>

      <table width="100%" cellpadding="0" cellspacing="0"><tr><td style="height:1px;background:#c7c7c7;padding:0;font-size:0;">&nbsp;</td></tr></table>
      <br>
      <p style="font-size:12px;color:#776c60;margin:0;">Received: {$timestamp} &nbsp;·&nbsp; Source: Contact Form &nbsp;·&nbsp; intenseperu.com</p>

    </td>
  </tr>

HTML;
  $rows .= intense_email_footer_html();

  return intense_email_wrap('New Contact Message — Intense Peru', $rows);
}

/**
 * Auto-respuesta al cliente tras enviar el formulario de contacto.
 */
function intense_email_contact_autoreply($data)
{
  $first_name = esc_html($data['first_name']);
  $mensaje = nl2br(esc_html($data['mensaje']));

  $rows = intense_email_header_html();
  $rows .= <<<HTML

  <tr>
    <td style="background:#b76739;padding:32px 40px;text-align:center;">
      <h1 style="color:#ffffff;font-size:24px;font-weight:normal;font-family:Georgia,serif;margin:0 0 6px;letter-spacing:0.04em;">We received your message</h1>
      <p style="color:rgba(255,255,255,0.85);font-size:13px;margin:0;line-height:1.5;">Thank you for reaching out to Intense Peru</p>
    </td>
  </tr>

  <tr>
    <td style="padding:36px 40px;background:#ffffff;">

      <p style="font-size:15px;line-height:1.7;color:#161616;margin:0 0 14px;">Dear <strong>{$first_name}</strong>,</p>
      <p style="font-size:15px;line-height:1.7;color:#161616;margin:0 0 20px;">Thank you for contacting us. We have received your message and one of our travel advisors will get back to you within <strong>24 hours</strong>.</p>

      <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:20px;">
        <tr><td style="background:#fcf1eb;border-left:3px solid #b76739;padding:16px 20px;">
          <div style="font-size:10px;text-transform:uppercase;letter-spacing:0.12em;color:#b76739;margin-bottom:8px;">Your message</div>
          <div style="font-size:14px;color:#161616;line-height:1.6;font-style:italic;">{$mensaje}</div>
        </td></tr>
      </table>

      <p style="font-size:15px;line-height:1.7;color:#161616;margin:0 0 24px;">While you wait, feel free to explore our signature journeys and destinations — Peru has a lot of magic in store for you.</p>

      <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
        <tr><td align="center">
          <a href="https://intenseperu.com/journeys" style="display:inline-block;background:#b76739;color:#ffffff;text-decoration:none;padding:13px 32px;font-size:12px;letter-spacing:0.12em;text-transform:uppercase;">Explore Journeys</a>
        </td></tr>
      </table>

      <table width="100%" cellpadding="0" cellspacing="0"><tr><td style="height:1px;background:#c7c7c7;padding:0;font-size:0;">&nbsp;</td></tr></table>
      <br>

      <p style="font-size:15px;line-height:1.7;color:#161616;margin:0 0 14px;">If your request is urgent, you can reach us directly:</p>

      <table width="100%" cellpadding="0" cellspacing="0">
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Toll Free</td>
            <td style="font-size:14px;color:#b76739;font-weight:600;">1 800 670 9510 <span style="color:#776c60;font-weight:normal;font-size:12px;">(US, CAN)</span></td>
          </tr></table>
        </td></tr>
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">WhatsApp</td>
            <td style="font-size:14px;color:#b76739;font-weight:600;">+51 994 008 833</td>
          </tr></table>
        </td></tr>
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Email</td>
            <td style="font-size:14px;color:#161616;">sales@intenseperu.com</td>
          </tr></table>
        </td></tr>
      </table>

    </td>
  </tr>

HTML;
  $rows .= intense_email_footer_html();

  return intense_email_wrap('We received your message — Intense Peru', $rows);
}

// ══════════════════════════════════════════════════════════════════════════════
//  BOOKING FORM — Templates HTML
// ══════════════════════════════════════════════════════════════════════════════

/**
 * Email interno al equipo cuando llega una solicitud de cotización.
 */
function intense_email_booking_internal($data)
{
  $name = esc_html($data['first_name'] . ' ' . $data['last_name']);
  $email = esc_html($data['email']);
  $whatsapp = $data['whatsapp'] ? esc_html($data['whatsapp']) : '<em style="color:#776c60;">—</em>';
  $start_date = '<em style="color:#776c60;">—</em>';
  if (!empty($data['start_date'])) {
    $date_parts = preg_split('/[-\/]/', trim($data['start_date']));
    $start_date = count($date_parts) === 3
      ? esc_html(sprintf('%02d-%02d-%04d', $date_parts[0], $date_parts[1], $date_parts[2]))
      : esc_html($data['start_date']);
  }
  $trip_length = $data['trip_length'] ? esc_html($data['trip_length']) . ' days' : '<em style="color:#776c60;">—</em>';
  $adults = esc_html($data['adults'] ?: '0');
  $children = esc_html($data['children'] ?: '0');
  $enfants = esc_html($data['enfants'] ?: '0');
  $hotel_cat_map = [
    'boutique' => 'Boutique ★★★★★',
    'luxury'   => 'Luxury ★★★★★',
    'superior' => 'Superior ★★★★',
    'value'    => 'Best Value ★★★',
  ];
  $hotel_cat = isset($hotel_cat_map[$data['hotel_cat']])
    ? esc_html($hotel_cat_map[$data['hotel_cat']])
    : ($data['hotel_cat'] ? esc_html($data['hotel_cat']) : '<em style="color:#776c60;">—</em>');
  $hear_about = $data['hear_about'] ? esc_html($data['hear_about']) : '<em style="color:#776c60;">—</em>';
  $mensaje = $data['mensaje'] ? nl2br(esc_html($data['mensaje'])) : '<em style="color:#776c60;">—</em>';
  $timestamp = current_time('d M Y · H:i');
  $page_source = !empty($data['page_source']) ? esc_html($data['page_source']) : '<em style="color:#776c60;">—</em>';
  $page_url = !empty($data['page_url']) ? '<a href="' . esc_url($data['page_url']) . '" style="color:#b76739;text-decoration:none;">' . esc_html($data['page_url']) . '</a>' : '';

  $rows = intense_email_header_html();
  $rows .= <<<HTML

  <tr>
    <td style="background:#b76739;padding:32px 40px;text-align:center;">
      <h1 style="color:#ffffff;font-size:24px;font-weight:normal;font-family:Georgia,serif;margin:0 0 6px;letter-spacing:0.04em;">New Quote Request</h1>
      <p style="color:rgba(255,255,255,0.85);font-size:13px;margin:0;line-height:1.5;">A visitor submitted the booking form on intenseperu.com</p>
    </td>
  </tr>

  <tr>
    <td style="padding:36px 40px;background:#ffffff;">

      <table width="100%" cellpadding="0" cellspacing="0" style="background:#fcf1eb;border:1px solid #e0c9bd;margin-bottom:20px;">
        <tr><td style="padding:12px 16px;font-size:13px;color:#b76739;">
          ★ &nbsp;Reply to this email is already set to the client's address.
        </td></tr>
      </table>

      <div style="display:inline-block;background:#fcf1eb;color:#b76739;font-size:10px;letter-spacing:0.1em;text-transform:uppercase;padding:4px 10px;margin-bottom:20px;">Client Details</div>

      <table width="100%" cellpadding="0" cellspacing="0">
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="150" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Name</td>
            <td style="font-size:14px;color:#161616;">{$name}</td>
          </tr></table>
        </td></tr>
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="150" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Email</td>
            <td style="font-size:14px;color:#161616;"><a href="mailto:{$email}" style="color:#b76739;text-decoration:none;">{$email}</a></td>
          </tr></table>
        </td></tr>
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="150" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">WhatsApp</td>
            <td style="font-size:14px;color:#161616;">{$whatsapp}</td>
          </tr></table>
        </td></tr>
      </table>

      <br>
      <div style="display:inline-block;background:#fcf1eb;color:#b76739;font-size:10px;letter-spacing:0.1em;text-transform:uppercase;padding:4px 10px;margin-bottom:20px;">Trip Details</div>

      <table width="100%" cellpadding="0" cellspacing="0">
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="150" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Source</td>
            <td style="font-size:14px;color:#161616;">{$page_url}</td>
          </tr></table>
        </td></tr>
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="150" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Start Date</td>
            <td style="font-size:14px;color:#161616;">{$start_date}</td>
          </tr></table>
        </td></tr>
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="150" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Trip Length</td>
            <td style="font-size:14px;color:#161616;">{$trip_length}</td>
          </tr></table>
        </td></tr>
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="150" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Travelers</td>
            <td style="font-size:14px;color:#161616;">{$adults} adults &nbsp;·&nbsp; {$children} children &nbsp;·&nbsp; {$enfants} infants</td>
          </tr></table>
        </td></tr>
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="150" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Hotel Category</td>
            <td style="font-size:14px;color:#161616;">{$hotel_cat}</td>
          </tr></table>
        </td></tr>
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="150" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Heard about us</td>
            <td style="font-size:14px;color:#161616;">{$hear_about}</td>
          </tr></table>
        </td></tr>
      </table>

      <table width="100%" cellpadding="0" cellspacing="0" style="margin:20px 0;">
        <tr><td style="background:#fcf1eb;border-left:3px solid #b76739;padding:16px 20px;">
          <div style="font-size:10px;text-transform:uppercase;letter-spacing:0.12em;color:#b76739;margin-bottom:8px;">Message</div>
          <div style="font-size:14px;color:#161616;line-height:1.6;font-style:italic;">{$mensaje}</div>
        </td></tr>
      </table>

      <table width="100%" cellpadding="0" cellspacing="0"><tr><td style="height:1px;background:#c7c7c7;padding:0;font-size:0;">&nbsp;</td></tr></table>
      <br>
      <p style="font-size:12px;color:#776c60;margin:0;">Received: {$timestamp} &nbsp;·&nbsp; Source: Booking Form &nbsp;·&nbsp; intenseperu.com</p>

    </td>
  </tr>

HTML;
  $rows .= intense_email_footer_html();

  return intense_email_wrap('New Quote Request — Intense Peru', $rows);
}

/**
 * Auto-respuesta al cliente tras enviar el formulario de booking / cotización.
 */
function intense_email_booking_autoreply($data)
{
  $first_name = esc_html($data['first_name']);
  $start_date = '—';
  if (!empty($data['start_date'])) {
    $date_parts = preg_split('/[-\/]/', trim($data['start_date']));
    $start_date = count($date_parts) === 3
      ? esc_html(sprintf('%02d-%02d-%04d', $date_parts[0], $date_parts[1], $date_parts[2]))
      : esc_html($data['start_date']);
  }
  $trip_length = $data['trip_length'] ? esc_html($data['trip_length']) . ' days' : '—';
  $adults = esc_html($data['adults'] ?: '0');
  $children = esc_html($data['children'] ?: '0');
  $enfants = esc_html($data['enfants'] ?: '0');
  $hotel_cat_map = [
    'boutique' => 'Boutique ★★★★★',
    'luxury'   => 'Luxury ★★★★★',
    'superior' => 'Superior ★★★★',
    'value'    => 'Best Value ★★★',
  ];
  $hotel_cat = isset($hotel_cat_map[$data['hotel_cat']])
    ? esc_html($hotel_cat_map[$data['hotel_cat']])
    : ($data['hotel_cat'] ? esc_html($data['hotel_cat']) : '—');

  $rows = intense_email_header_html();
  $rows .= <<<HTML

  <tr>
    <td style="background:#b76739;padding:32px 40px;text-align:center;">
      <h1 style="color:#ffffff;font-size:24px;font-weight:normal;font-family:Georgia,serif;margin:0 0 6px;letter-spacing:0.04em;">Your quote request is on its way</h1>
      <p style="color:rgba(255,255,255,0.85);font-size:13px;margin:0;line-height:1.5;">We will get back to you within 24 hours</p>
    </td>
  </tr>

  <tr>
    <td style="padding:36px 40px;background:#ffffff;">

      <p style="font-size:15px;line-height:1.7;color:#161616;margin:0 0 14px;">Dear <strong>{$first_name}</strong>,</p>
      <p style="font-size:15px;line-height:1.7;color:#161616;margin:0 0 20px;">Thank you for trusting Intense Peru to plan your journey. We have received your quote request and one of our travel specialists will be in touch within <strong>24 hours</strong> with a personalized proposal.</p>

      <div style="display:inline-block;background:#fcf1eb;color:#b76739;font-size:10px;letter-spacing:0.1em;text-transform:uppercase;padding:4px 10px;margin-bottom:16px;">Your request summary</div>

      <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:24px;">
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="150" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Start Date</td>
            <td style="font-size:14px;color:#161616;">{$start_date}</td>
          </tr></table>
        </td></tr>
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="150" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Trip Length</td>
            <td style="font-size:14px;color:#161616;">{$trip_length}</td>
          </tr></table>
        </td></tr>
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="150" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Travelers</td>
            <td style="font-size:14px;color:#161616;">{$adults} adults &nbsp;·&nbsp; {$children} children &nbsp;·&nbsp; {$enfants} infants</td>
          </tr></table>
        </td></tr>
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="150" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Hotel Category</td>
            <td style="font-size:14px;color:#161616;">{$hotel_cat}</td>
          </tr></table>
        </td></tr>
      </table>

      <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
        <tr><td align="center">
          <a href="https://intenseperu.com/journeys" style="display:inline-block;background:#b76739;color:#ffffff;text-decoration:none;padding:13px 32px;font-size:12px;letter-spacing:0.12em;text-transform:uppercase;">Explore Our Journeys</a>
        </td></tr>
      </table>

      <table width="100%" cellpadding="0" cellspacing="0"><tr><td style="height:1px;background:#c7c7c7;padding:0;font-size:0;">&nbsp;</td></tr></table>
      <br>

      <p style="font-size:15px;line-height:1.7;color:#161616;margin:0 0 14px;">Need to reach us sooner?</p>

      <table width="100%" cellpadding="0" cellspacing="0">
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Toll Free</td>
            <td style="font-size:14px;color:#b76739;font-weight:600;">1 800 670 9510 <span style="color:#776c60;font-weight:normal;font-size:12px;">(US, CAN)</span></td>
          </tr></table>
        </td></tr>
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">WhatsApp</td>
            <td style="font-size:14px;color:#b76739;font-weight:600;">+51 994 008 833</td>
          </tr></table>
        </td></tr>
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Email</td>
            <td style="font-size:14px;color:#161616;">sales@intenseperu.com</td>
          </tr></table>
        </td></tr>
      </table>

    </td>
  </tr>

HTML;
  $rows .= intense_email_footer_html();

  return intense_email_wrap('Your quote request is on its way — Intense Peru', $rows);
}

// ══════════════════════════════════════════════════════════════════════════════
//  AJAX HANDLERS
// ══════════════════════════════════════════════════════════════════════════════

// ── FORM: Contacto ────────────────────────────────────────────────────────────
add_action('wp_ajax_intense_contact', 'intense_handle_contact');
add_action('wp_ajax_nopriv_intense_contact', 'intense_handle_contact');

function intense_handle_contact()
{
  check_ajax_referer('intense_forms_nonce', 'nonce');

  $first_name = sanitize_text_field($_POST['firstName'] ?? '');
  $last_name = sanitize_text_field($_POST['lastName'] ?? '');
  $telephone = sanitize_text_field($_POST['telephone'] ?? '');
  $email = sanitize_email($_POST['email'] ?? '');
  $mensaje = sanitize_textarea_field($_POST['mensaje'] ?? '');

  if (!$first_name || !$email) {
    wp_send_json_error(['message' => 'Missing required fields.'], 400);
  }

  $data = compact('first_name', 'last_name', 'email', 'telephone', 'mensaje');

  $html_headers = [
    'Content-Type: text/html; charset=UTF-8',
    "Reply-To: {$first_name} {$last_name} <{$email}>",
  ];

  // 1. Email interno al equipo
  $team_to = INTENSE_EMAIL_TEST_MODE ? INTENSE_EMAIL_TEST_ADDRESS : INTENSE_TEAM_EMAILS;
  $sent = wp_mail(
    $team_to,
    "New Contact Message — {$first_name} {$last_name}",
    intense_email_contact_internal($data),
    $html_headers
  );

  // 2. Auto-respuesta al cliente
  wp_mail(
    $email,
    'We received your message — Intense Peru',
    intense_email_contact_autoreply($data),
    ['Content-Type: text/html; charset=UTF-8']
  );

  $sent
    ? wp_send_json_success(['message' => 'Email sent.'])
    : wp_send_json_error(['message' => 'Could not send email.'], 500);
}

// ── FORM: Booking / Quote ─────────────────────────────────────────────────────
add_action('wp_ajax_intense_booking', 'intense_handle_booking');
add_action('wp_ajax_nopriv_intense_booking', 'intense_handle_booking');

function intense_handle_booking()
{
  check_ajax_referer('intense_forms_nonce', 'nonce');

  $first_name = sanitize_text_field($_POST['firstName'] ?? '');
  $last_name = sanitize_text_field($_POST['lastName'] ?? '');
  $email = sanitize_email($_POST['email'] ?? '');
  $whatsapp = sanitize_text_field($_POST['whatsapp'] ?? '');
  $start_date = sanitize_text_field($_POST['startDate'] ?? '');
  $trip_length = sanitize_text_field($_POST['tripLength'] ?? '');
  $adults = sanitize_text_field($_POST['adults'] ?? '');
  $children = sanitize_text_field($_POST['children'] ?? '');
  $enfants = sanitize_text_field($_POST['enfants'] ?? '');
  $hotel_cat = sanitize_text_field($_POST['hotelCategory'] ?? '');
  $hear_about = sanitize_text_field($_POST['hearAboutUs'] ?? '');
  $mensaje = sanitize_textarea_field($_POST['mensaje'] ?? '');
  $page_source = sanitize_text_field($_POST['pageSource'] ?? '');
  $page_url = esc_url_raw($_POST['pageUrl'] ?? '');

  if (!$first_name || !$email) {
    wp_send_json_error(['message' => 'Missing required fields.'], 400);
  }

  $data = compact(
    'first_name',
    'last_name',
    'email',
    'whatsapp',
    'start_date',
    'trip_length',
    'adults',
    'children',
    'enfants',
    'hotel_cat',
    'hear_about',
    'mensaje',
    'page_source',
    'page_url'
  );

  $html_headers = [
    'Content-Type: text/html; charset=UTF-8',
    "Reply-To: {$first_name} {$last_name} <{$email}>",
  ];

  // 1. Email interno al equipo
  $team_to = INTENSE_EMAIL_TEST_MODE ? INTENSE_EMAIL_TEST_ADDRESS : INTENSE_TEAM_EMAILS;
  $subject_src = $page_source ? " [{$page_source}]" : '';
  $sent = wp_mail(
    $team_to,
    "New Quote Request — {$first_name} {$last_name}{$subject_src}",
    intense_email_booking_internal($data),
    $html_headers
  );

  // 2. Auto-respuesta al cliente
  wp_mail(
    $email,
    'Your quote request is on its way — Intense Peru',
    intense_email_booking_autoreply($data),
    ['Content-Type: text/html; charset=UTF-8']
  );

  $sent
    ? wp_send_json_success(['message' => 'Email sent.'])
    : wp_send_json_error(['message' => 'Could not send email.'], 500);
}

// ── FORM: Brochure Download ───────────────────────────────────────────────────
add_action('wp_ajax_intense_brochure', 'intense_handle_brochure');
add_action('wp_ajax_nopriv_intense_brochure', 'intense_handle_brochure');

function intense_handle_brochure()
{
  check_ajax_referer('intense_forms_nonce', 'nonce');

  $first_name = sanitize_text_field($_POST['firstName'] ?? '');
  $email = sanitize_email($_POST['email'] ?? '');
  $brochure = esc_url_raw($_POST['brochure'] ?? '');

  if (!$first_name || !$email) {
    wp_send_json_error(['message' => 'Missing required fields.'], 400);
  }

  $data = compact('first_name', 'email', 'brochure');

  $html_headers = [
    'Content-Type: text/html; charset=UTF-8',
    "Reply-To: {$first_name} <{$email}>",
  ];

  // 0. Guardar en base de datos como CPT
  $post_id = wp_insert_post([
    'post_type' => 'brochure_lead',
    'post_title' => sprintf('%s — %s', $first_name, $email),
    'post_status' => 'publish',
  ]);

  if ($post_id && !is_wp_error($post_id)) {
    update_post_meta($post_id, 'first_name', $first_name);
    update_post_meta($post_id, 'email', $email);
    update_post_meta($post_id, 'brochure_url', $brochure);
  }

  // 1. Email interno al equipo
  $team_to = INTENSE_EMAIL_TEST_MODE ? INTENSE_EMAIL_TEST_ADDRESS : INTENSE_TEAM_EMAILS;
  $sent = wp_mail(
    $team_to,
    "New Brochure Download — {$first_name}",
    intense_email_brochure_internal($data),
    $html_headers
  );

  // 2. Auto-respuesta al cliente
  wp_mail(
    $email,
    'Your Peru Travel Guide — Intense Peru',
    intense_email_brochure_autoreply($data),
    ['Content-Type: text/html; charset=UTF-8']
  );

  $sent
    ? wp_send_json_success(['message' => 'Email sent.'])
    : wp_send_json_error(['message' => 'Could not send email.'], 500);
}

/**
 * Email interno al equipo cuando se descarga el brochure.
 */
function intense_email_brochure_internal($data)
{
  $name = esc_html($data['first_name']);
  $email = esc_html($data['email']);
  $brochure_url = esc_url($data['brochure']);
  $timestamp = current_time('d M Y · H:i');

  $rows = intense_email_header_html();
  $rows .= <<<HTML

  <tr>
    <td style="background:#b76739;padding:32px 40px;text-align:center;">
      <h1 style="color:#ffffff;font-size:24px;font-weight:normal;font-family:Georgia,serif;margin:0 0 6px;letter-spacing:0.04em;">New Brochure Download</h1>
      <p style="color:rgba(255,255,255,0.85);font-size:13px;margin:0;line-height:1.5;">A visitor requested the Peru Travel Guide</p>
    </td>
  </tr>

  <tr>
    <td style="padding:36px 40px;background:#ffffff;">
      <div style="display:inline-block;background:#fcf1eb;color:#b76739;font-size:10px;letter-spacing:0.1em;text-transform:uppercase;padding:4px 10px;margin-bottom:20px;">Download Details</div>

      <table width="100%" cellpadding="0" cellspacing="0">
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Name</td>
            <td style="font-size:14px;color:#161616;">{$name}</td>
          </tr></table>
        </td></tr>
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Email</td>
            <td style="font-size:14px;color:#161616;"><a href="mailto:{$email}" style="color:#b76739;text-decoration:none;">{$email}</a></td>
          </tr></table>
        </td></tr>
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Brochure URL</td>
            <td style="font-size:14px;color:#161616;"><a href="{$brochure_url}" style="color:#161616;word-break:break-all;">{$brochure_url}</a></td>
          </tr></table>
        </td></tr>
      </table>

      <table width="100%" cellpadding="0" cellspacing="0"><tr><td style="height:1px;background:#c7c7c7;padding:0;font-size:0;">&nbsp;</td></tr></table>
      <br>
      <p style="font-size:12px;color:#776c60;margin:0;">Received: {$timestamp} &nbsp;·&nbsp; Source: Brochure Modal &nbsp;·&nbsp; intenseperu.com</p>
    </td>
  </tr>

HTML;
  $rows .= intense_email_footer_html();

  return intense_email_wrap('New Brochure Download — Intense Peru', $rows);
}

/**
 * Auto-respuesta al cliente invitándolo a ver más tras descarga de brochure.
 */
function intense_email_brochure_autoreply($data)
{
  $first_name = esc_html($data['first_name']);

  $rows = intense_email_header_html();
  $rows .= <<<HTML

  <tr>
    <td style="background:#b76739;padding:32px 40px;text-align:center;">
      <h1 style="color:#ffffff;font-size:24px;font-weight:normal;font-family:Georgia,serif;margin:0 0 6px;letter-spacing:0.04em;">Your Peru Travel Guide</h1>
      <p style="color:rgba(255,255,255,0.85);font-size:13px;margin:0;line-height:1.5;">Thank you for downloading our brochure</p>
    </td>
  </tr>

  <tr>
    <td style="padding:36px 40px;background:#ffffff;">

      <p style="font-size:15px;line-height:1.7;color:#161616;margin:0 0 14px;">Dear <strong>{$first_name}</strong>,</p>
      <p style="font-size:15px;line-height:1.7;color:#161616;margin:0 0 20px;">Thank you for downloading our Travel Guide. We hope it inspires your next adventure. Peru has a lot of magic in store for you, and we're here whenever you're ready to start planning.</p>

      <p style="font-size:15px;line-height:1.7;color:#161616;margin:0 0 24px;">Feel free to explore our signature journeys and let us help you design your perfect trip.</p>

      <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
        <tr><td align="center">
          <a href="https://intenseperu.com/journeys" style="display:inline-block;background:#b76739;color:#ffffff;text-decoration:none;padding:13px 32px;font-size:12px;letter-spacing:0.12em;text-transform:uppercase;">Explore Journeys</a>
        </td></tr>
      </table>

      <p style="font-size:15px;line-height:1.7;color:#161616;margin:0;">If you have any questions, you can reply directly to this email. We'd be happy to talk to you.</p>

    </td>
  </tr>

HTML;
  $rows .= intense_email_footer_html();

  return intense_email_wrap('Your Peru Travel Guide — Intense Peru', $rows);
}

// ── CPT: Brochure Leads ───────────────────────────────────────────────────────
add_action('init', function () {
  register_post_type('brochure_lead', [
    'labels' => [
      'name' => 'DB Records',
      'singular_name' => 'DB Record',
      'menu_name' => 'DB Records',
    ],
    'public' => false,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_icon' => 'dashicons-download',
    'supports' => ['title'],
    'capability_type' => 'post',
    'capabilities' => [
      'create_posts' => 'do_not_allow', // Evita crear posts manualmente
    ],
    'map_meta_cap' => true,
  ]);
});

add_filter('manage_brochure_lead_posts_columns', function ($columns) {
  $new_columns = [];
  foreach ($columns as $key => $title) {
    if ($key === 'date') {
      $new_columns['email'] = 'Email';
      $new_columns['brochure'] = 'Brochure';
    }
    $new_columns[$key] = $title;
  }
  return $new_columns;
});

add_action('manage_brochure_lead_posts_custom_column', function ($column, $post_id) {
  if ($column === 'email') {
    echo esc_html(get_post_meta($post_id, 'email', true));
  }
  if ($column === 'brochure') {
    $url = get_post_meta($post_id, 'brochure_url', true);
    if ($url) {
      echo '<a href="' . esc_url($url) . '" target="_blank">Ver Link</a>';
    } else {
      echo '—';
    }
  }
}, 10, 2);

// ══════════════════════════════════════════════════════════════════════════════
//  NEWSLETTER — Template HTML
// ══════════════════════════════════════════════════════════════════════════════

function intense_email_newsletter_welcome($data)
{
  $first_name = esc_html($data['name'] ?: 'Traveler');

  $rows = intense_email_header_html();
  $rows .= <<<HTML

  <tr>
    <td style="background:#b76739;padding:32px 40px;text-align:center;">
      <h1 style="color:#ffffff;font-size:24px;font-weight:normal;font-family:Georgia,serif;margin:0 0 6px;letter-spacing:0.04em;">Welcome to Intense Peru</h1>
      <p style="color:rgba(255,255,255,0.85);font-size:13px;margin:0;line-height:1.5;">You're now part of our travel community</p>
    </td>
  </tr>

  <tr>
    <td style="padding:36px 40px;background:#ffffff;">

      <p style="font-size:15px;line-height:1.7;color:#161616;margin:0 0 14px;">Dear <strong>{$first_name}</strong>,</p>
      <p style="font-size:15px;line-height:1.7;color:#161616;margin:0 0 20px;">Thank you for subscribing to Intense Peru. You'll be among the first to receive <strong>curated travel inspiration</strong>, exclusive journey highlights, and insider stories from the heart of Peru.</p>

      <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:24px;">
        <tr><td style="background:#fcf1eb;border-left:3px solid #b76739;padding:16px 20px;">
          <div style="font-size:10px;text-transform:uppercase;letter-spacing:0.12em;color:#b76739;margin-bottom:8px;">What to expect</div>
          <div style="font-size:14px;color:#161616;line-height:1.8;">
            · Signature journey features &amp; new itineraries<br>
            · Destination spotlights — from Cusco to the Amazon<br>
            · Travel tips crafted by our expert designers<br>
            · Exclusive early access to special experiences
          </div>
        </td></tr>
      </table>

      <p style="font-size:15px;line-height:1.7;color:#161616;margin:0 0 24px;">In the meantime, explore our collection of private journeys — each one designed to reveal the real Peru at your own pace.</p>

      <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
        <tr><td align="center">
          <a href="https://intenseperu.com/journeys" style="display:inline-block;background:#b76739;color:#ffffff;text-decoration:none;padding:13px 32px;font-size:12px;letter-spacing:0.12em;text-transform:uppercase;">Explore Journeys</a>
        </td></tr>
      </table>

      <table width="100%" cellpadding="0" cellspacing="0"><tr><td style="height:1px;background:#c7c7c7;padding:0;font-size:0;">&nbsp;</td></tr></table>
      <br>

      <p style="font-size:15px;line-height:1.7;color:#161616;margin:0 0 14px;">Ready to start planning? Reach out anytime:</p>

      <table width="100%" cellpadding="0" cellspacing="0">
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Toll Free</td>
            <td style="font-size:14px;color:#b76739;font-weight:600;">1 800 670 9510 <span style="color:#776c60;font-weight:normal;font-size:12px;">(US, CAN)</span></td>
          </tr></table>
        </td></tr>
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">WhatsApp</td>
            <td style="font-size:14px;color:#b76739;font-weight:600;">+51 994 008 833</td>
          </tr></table>
        </td></tr>
        <tr><td style="border-top:1px solid #c7c7c7;padding:10px 0;">
          <table width="100%" cellpadding="0" cellspacing="0"><tr>
            <td width="130" style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#b76739;vertical-align:top;padding-top:2px;">Email</td>
            <td style="font-size:14px;color:#161616;">sales@intenseperu.com</td>
          </tr></table>
        </td></tr>
      </table>

    </td>
  </tr>

HTML;
  $rows .= intense_email_footer_html();

  return intense_email_wrap('Welcome to Intense Peru', $rows);
}

// ── CPT: Newsletter Leads ─────────────────────────────────────────────────────
add_action('init', function () {
  register_post_type('newsletter_lead', [
    'labels' => [
      'name' => 'Newsletter Subscribers',
      'singular_name' => 'Newsletter Subscriber',
      'menu_name' => 'Newsletter',
    ],
    'public' => false,
    'show_ui' => true,
    'show_in_menu' => 'edit.php?post_type=brochure_lead',
    'supports' => ['title'],
    'capability_type' => 'post',
    'capabilities' => ['create_posts' => 'do_not_allow'],
    'map_meta_cap' => true,
  ]);
});

add_filter('manage_newsletter_lead_posts_columns', function ($columns) {
  $new = [];
  foreach ($columns as $key => $title) {
    if ($key === 'date') {
      $new['subscriber_name'] = 'Name';
      $new['subscriber_email'] = 'Email';
    }
    $new[$key] = $title;
  }
  return $new;
});

add_action('manage_newsletter_lead_posts_custom_column', function ($column, $post_id) {
  if ($column === 'subscriber_name')
    echo esc_html(get_post_meta($post_id, 'subscriber_name', true));
  if ($column === 'subscriber_email')
    echo esc_html(get_post_meta($post_id, 'subscriber_email', true));
}, 10, 2);

// ── AJAX: Newsletter subscribe ────────────────────────────────────────────────
add_action('wp_ajax_nopriv_newsletter_subscribe', 'intense_newsletter_subscribe');
add_action('wp_ajax_newsletter_subscribe', 'intense_newsletter_subscribe');

function intense_newsletter_subscribe()
{
  check_ajax_referer('intense_forms_nonce', 'nonce');

  $name = sanitize_text_field(wp_unslash($_POST['name'] ?? ''));
  $email = sanitize_email(wp_unslash($_POST['email'] ?? ''));

  if (!$email || !is_email($email)) {
    wp_send_json_error(['message' => 'Please enter a valid email.']);
  }

  // Guardar en DB
  $post_id = wp_insert_post([
    'post_type' => 'newsletter_lead',
    'post_title' => $name ?: $email,
    'post_status' => 'publish',
  ]);

  if ($post_id && !is_wp_error($post_id)) {
    update_post_meta($post_id, 'subscriber_name', $name);
    update_post_meta($post_id, 'subscriber_email', $email);
  }

  // Email al equipo (solo juanpablo recibe notificaciones de newsletter)
  $team_to = INTENSE_EMAIL_TEST_MODE ? INTENSE_EMAIL_TEST_ADDRESS : 'roberto@intenseperu.com';
  $subject = 'New Newsletter Subscriber – ' . ($name ?: $email);
  $body = '<div style="font-family:sans-serif;font-size:15px;color:#1a1a1a;max-width:560px;margin:0 auto">';
  $body .= '<h2 style="font-size:20px;margin-bottom:16px">New Newsletter Subscriber</h2>';
  $body .= '<table style="border-collapse:collapse;width:100%">';
  $body .= '<tr><td style="padding:8px 0;border-bottom:1px solid #eee;width:120px;color:#666">Name</td><td style="padding:8px 0;border-bottom:1px solid #eee">' . esc_html($name) . '</td></tr>';
  $body .= '<tr><td style="padding:8px 0;color:#666">Email</td><td style="padding:8px 0">' . esc_html($email) . '</td></tr>';
  $body .= '</table></div>';

  $sent = wp_mail($team_to, $subject, $body, ['Content-Type: text/html; charset=UTF-8']);

  // Correo de bienvenida al suscriptor
  wp_mail(
    $email,
    'Welcome to Intense Peru — You\'re in!',
    intense_email_newsletter_welcome(['name' => $name, 'email' => $email]),
    ['Content-Type: text/html; charset=UTF-8']
  );

  $sent
    ? wp_send_json_success(['message' => 'Subscribed!'])
    : wp_send_json_error(['message' => 'Saved, but email could not be sent.'], 500);
}

// ── Gutenberg: solo en posts, Classic en el resto ─────────────────────────────
add_filter('use_block_editor_for_post_type', function ($use_block_editor, $post_type) {
  return $post_type === 'post';
}, 10, 2);

// ── Sitemap XML ───────────────────────────────────────────────────────────────
add_action('init', function () {
    add_rewrite_rule('^sitemap\.xml$', 'index.php?intense_sitemap=1', 'top');
});

add_filter('query_vars', function ($vars) {
    $vars[] = 'intense_sitemap';
    return $vars;
});

add_action('template_redirect', function () {
    if (!get_query_var('intense_sitemap')) return;

    $urls = [];

    $post_types = [
        'page'        => ['changefreq' => 'monthly', 'priority' => '0.8'],
        'post'        => ['changefreq' => 'weekly',  'priority' => '0.7'],
        'journey'     => ['changefreq' => 'monthly', 'priority' => '0.9'],
        'destination' => ['changefreq' => 'monthly', 'priority' => '0.8'],
    ];

    foreach ($post_types as $type => $meta) {
        $items = get_posts([
            'post_type'   => $type,
            'post_status' => 'publish',
            'numberposts' => -1,
        ]);
        foreach ($items as $item) {
            $urls[] = [
                'loc'        => get_permalink($item),
                'lastmod'    => get_post_modified_time('c', false, $item),
                'changefreq' => $meta['changefreq'],
                'priority'   => $meta['priority'],
            ];
        }
    }

    header('Content-Type: application/xml; charset=UTF-8');
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($urls as $url) {
        echo "  <url>\n";
        echo '    <loc>' . esc_url($url['loc']) . "</loc>\n";
        echo '    <lastmod>' . esc_html($url['lastmod']) . "</lastmod>\n";
        echo '    <changefreq>' . esc_html($url['changefreq']) . "</changefreq>\n";
        echo '    <priority>' . esc_html($url['priority']) . "</priority>\n";
        echo "  </url>\n";
    }
    echo '</urlset>';
    exit;
});

// ── Google Analytics ─────────────────────────────────────────────────────────
if (!INTENSE_EMAIL_TEST_MODE) {
    add_action('wp_head', function () {
        ?>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-KVWKRSGT0J"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', 'G-KVWKRSGT0J');
        </script>
        <?php
    }, 1);
}

// ── Google Fonts ──────────────────────────────────────────────────────────────
function intense_google_fonts() {
    wp_enqueue_style(
        'rubik-font',
        'https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&display=swap',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'intense_google_fonts');