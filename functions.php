<?php

/**
 * Functions y definiciones del tema Intense Nerd
 *
 * @package intense-nerd-theme
 */

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
    echo '<script type="module" src="http://localhost:5173/@vite/client"></script>' . "\n";
    echo '<script type="module" src="http://localhost:5173/src/main.js"></script>' . "\n";
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
      $destinations = $information['short_description'] ?? '';
      $link = get_permalink();
      ?>
      <div class="journey-card" data-days="<?php echo esc_attr($days_val); ?>">
        <?php
        get_template_part('template-parts/components/card-itinerary', null, [
          'image' => $image,
          'title' => $title,
          'price' => $price,
          'duration' => $duration,
          'destinations' => $destinations,
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
    'contact_whatsapp' => ['label' => 'WhatsApp (solo número con código país)', 'default' => '51994008833', 'type' => 'text'],
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
    if ($days >= 10)
      $grand[] = $post;
    elseif ($days >= 5)
      $compact[] = $post;
    elseif ($days >= 2)
      $short[] = $post;
  }

  $recent = get_posts(['post_type' => 'journey', 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC']);

  $render_list = function (array $items) {
    if (empty($items))
      return '<li><span class="text-dark/30 text-sm italic">—</span></li>';
    $out = '';
    foreach ($items as $p) {
      $out .= '<li><a href="' . esc_url(get_permalink($p)) . '" class="lg:text-sm text-xs font-body text-dark/70 hover:text-primary leading-none transition-colors underline-offset-2 hover:underline">' . esc_html($p->post_title) . '</a></li>';
    }
    return $out;
  };

  $render_cards = function (array $items) {
    $out = '';
    foreach ($items as $p) {
      $img = get_the_post_thumbnail_url($p->ID, 'full');
      $out .= '<div class="w-full shrink-0">';
      $out .= $img
        ? '<a href="' . esc_url(get_permalink($p)) . '" class="block mb-3 relative group"><div class="w-full h-[300px] shrink-0 bg-cover bg-center bg-no-repeat rounded-lg relative overflow-hidden group-hover:opacity-90 transition-opacity" style="background-image: url(\'' . esc_url($img) . '\');"></div></a>'
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
    $list_html .= '<li><a href="' . esc_url(get_permalink($p)) . '" class="text-sm font-body text-dark/70 hover:text-primary transition-colors underline-offset-2 hover:underline leading-snug">' . esc_html($p->post_title) . '</a></li>';
    $mobile_list .= '<li class="border-b border-dark/10"><a href="' . esc_url(get_permalink($p)) . '" class="flex py-4 font-body text-dark text-xs hover:text-primary transition-colors">' . esc_html($p->post_title) . '</a></li>';
  }

  foreach ($featured as $p) {
    $img = get_the_post_thumbnail_url($p->ID, 'full');
    $cards_html .= '<div>';
    $cards_html .= $img
      ? '<a href="' . esc_url(get_permalink($p)) . '" class="block mb-3 relative group"><div class="w-full h-[300px] shrink-0 bg-cover bg-center bg-no-repeat rounded-lg relative overflow-hidden group-hover:scale-105 transition-transform duration-500" style="background-image: url(\'' . esc_url($img) . '\');"></div></a>'
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
 * Logo adaptado al Design System para emails en base64.
 * Prioriza PNG para máxima compatibilidad con todos los clientes (Gmail, Outlook, etc).
 */
function intense_email_logo_src()
{
  static $cache = null;
  if ($cache !== null)
    return $cache;

  // 1. Intentamos usar el PNG del tema (máxima compatibilidad en correos)
  $theme_logo = get_template_directory() . '/assets/images/intense_logo.png';
  if (file_exists($theme_logo)) {
    $cache = 'data:image/png;base64,' . base64_encode(file_get_contents($theme_logo));
    return $cache;
  }

  // 2. Fallback: Usar el logo del Customizer si es imagen
  $custom_logo_id = get_theme_mod('custom_logo');
  if ($custom_logo_id) {
    $logo_path = get_attached_file($custom_logo_id);
    if ($logo_path && file_exists($logo_path)) {
      $mime = mime_content_type($logo_path);
      if (strpos($mime, 'image/') === 0) {
        $cache = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($logo_path));
        return $cache;
      }
    }
  }

  // URL fallback si nada funciona
  return 'http://intense.nerd-agencia.com/wp-content/uploads/2026/04/intense_logo.png';
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
          ★ &nbsp;Reply directly to this email — the <strong>Reply-To</strong> is already set to the client's address.
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
  $start_date = $data['start_date'] ? esc_html($data['start_date']) : '<em style="color:#776c60;">—</em>';
  $trip_length = $data['trip_length'] ? esc_html($data['trip_length']) . ' days' : '<em style="color:#776c60;">—</em>';
  $adults = esc_html($data['adults'] ?: '0');
  $children = esc_html($data['children'] ?: '0');
  $enfants = esc_html($data['enfants'] ?: '0');
  $hotel_cat = $data['hotel_cat'] ? esc_html($data['hotel_cat']) : '<em style="color:#776c60;">—</em>';
  $hear_about = $data['hear_about'] ? esc_html($data['hear_about']) : '<em style="color:#776c60;">—</em>';
  $mensaje = $data['mensaje'] ? nl2br(esc_html($data['mensaje'])) : '<em style="color:#776c60;">—</em>';
  $timestamp = current_time('d M Y · H:i');

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
          ★ &nbsp;Reply directly to this email — the <strong>Reply-To</strong> is already set to the client's address.
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
  $start_date = $data['start_date'] ? esc_html($data['start_date']) : '—';
  $trip_length = $data['trip_length'] ? esc_html($data['trip_length']) . ' days' : '—';
  $adults = esc_html($data['adults'] ?: '0');
  $children = esc_html($data['children'] ?: '0');
  $enfants = esc_html($data['enfants'] ?: '0');

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
  // $team_to = ['sales@intenseperu.com', 'karen@intenseperu.com', 'juanpablo@intenseperu.com'];
  $team_to = "kevin.gomez@nerd.pe";
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
    'mensaje'
  );

  $html_headers = [
    'Content-Type: text/html; charset=UTF-8',
    "Reply-To: {$first_name} {$last_name} <{$email}>",
  ];

  // 1. Email interno al equipo
  // $team_to = ['sales@intenseperu.com', 'karen@intenseperu.com', 'juanpablo@intenseperu.com'];
  $team_to = "kevin.gomez@nerd.pe";
  $sent = wp_mail(
    $team_to,
    "New Quote Request — {$first_name} {$last_name}",
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

// ── Gutenberg: solo en posts, Classic en el resto ─────────────────────────────
add_filter('use_block_editor_for_post_type', function ($use_block_editor, $post_type) {
  return $post_type === 'post';
}, 10, 2);