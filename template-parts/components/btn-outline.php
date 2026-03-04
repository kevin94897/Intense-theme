<?php

/**
 * Componente: Botón Outline
 *
 * Uso:
 *   get_template_part( 'template-parts/components/btn-outline', null, [
 *     'text'        => 'Explorar itinerarios',
 *     'href'        => '/destinos/',
 *     'type'        => 'button',
 *     'class_extra' => '',
 *     'attrs'       => '',
 *   ] )
 *
 * @package intense-nerd-theme
 */

$text        = $args['text']        ?? __('Acción', 'intense-nerd-theme');
$href        = $args['href']        ?? '';
$type        = $args['type']        ?? 'button';
$color       = $args['color']       ?? 'dark'; // 'dark' or 'light'
$class_extra = $args['class_extra'] ?? '';
$attrs       = $args['attrs']       ?? '';

$outline_class = ($color === 'light') ? 'btn-outline-light' : 'btn-outline-dark';
$base_class = 'btn ' . $outline_class . ' ' . $class_extra;
?>

<?php if ($href) : ?>
    <a href="<?php echo esc_url($href); ?>"
        class="<?php echo esc_attr(trim($base_class)); ?>"
        <?php echo $attrs; ?>>
        <?php echo esc_html($text); ?>
    </a>
<?php else : ?>
    <button type="<?php echo esc_attr($type); ?>"
        class="<?php echo esc_attr(trim($base_class)); ?>"
        <?php echo $attrs; ?>>
        <?php echo esc_html($text); ?>
    </button>
<?php endif; ?>