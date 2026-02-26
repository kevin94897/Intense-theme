<?php

/**
 * Componente: Botón Primario
 *
 * Uso:
 *   get_template_part( 'template-parts/components/btn-primary', null, [
 *     'text'        => 'Explorar itinerarios',
 *     'href'        => '/contacto/',   // si se omite, renderiza <button>
 *     'type'        => 'button',       // 'submit' | 'button' | 'reset'
 *     'class_extra' => 'w-full',       // clases adicionales (opcional)
 *     'attrs'       => '',             // atributos HTML extra (opcional)
 *   ] )
 *
 * @package intense-nerd-theme
 */

$text        = $args['text']        ?? __('Acción', 'intense-nerd-theme');
$href        = $args['href']        ?? '';
$type        = $args['type']        ?? 'button';
$class_extra = $args['class_extra'] ?? '';
$attrs       = $args['attrs']       ?? '';

$base_class = 'btn btn-primary ' . $class_extra;
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