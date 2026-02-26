<?php

/**
 * Componente: Input con floating label
 *
 * Uso:
 *   get_template_part( 'template-parts/components/input-floating', null, [
 *     'id'       => 'nombre',
 *     'label'    => 'Nombre completo',
 *     'type'     => 'text',          // text | email | tel | password
 *     'name'     => 'nombre',
 *     'required' => true,
 *     'estado'   => '',              // '' | 'error' | 'success'
 *     'mensaje'  => '',              // mensaje de error/ayuda (opcional)
 *     'x_model'  => 'nombre',        // Alpine x-model (opcional)
 *     'x_blur'   => "validarCampo('nombre')", // Alpine @blur (opcional)
 *   ] )
 *
 * @package intense-nerd-theme
 */

$id       = $args['id']       ?? 'campo';
$label    = $args['label']    ?? '';
$type     = $args['type']     ?? 'text';
$name     = $args['name']     ?? $id;
$required = $args['required'] ?? false;
$estado   = $args['estado']   ?? '';   // '' | 'error' | 'success'
$mensaje  = $args['mensaje']  ?? '';
$x_model  = $args['x_model']  ?? '';
$x_blur   = $args['x_blur']   ?? '';

// Clase del wrapper según estado
$wrapper_class = 'input-wrapper';
if ($estado === 'error')   $wrapper_class .= ' has-error';
if ($estado === 'success') $wrapper_class .= ' has-success';
?>

<div class="<?php echo esc_attr($wrapper_class); ?>">

    <input
        type="<?php echo esc_attr($type); ?>"
        id="<?php echo esc_attr($id); ?>"
        name="<?php echo esc_attr($name); ?>"
        placeholder=" "
        class="input-field"
        <?php if ($required) echo 'required'; ?>
        <?php if ($x_model) echo 'x-model="' . esc_attr($x_model) . '"'; ?>
        <?php if ($x_blur)  echo '@blur="'   . esc_attr($x_blur)  . '"'; ?>>

    <?php if ($label) : ?>
        <label for="<?php echo esc_attr($id); ?>" class="input-label">
            <?php echo esc_html($label); ?>
            <?php if ($required) : ?>
                <span class="text-primary" aria-hidden="true"> *</span>
            <?php endif; ?>
        </label>
    <?php endif; ?>

    <?php if ($estado === 'error') : ?>
        <span class="absolute right-0 top-4 text-red-500 text-lg" aria-hidden="true">✕</span>
    <?php elseif ($estado === 'success') : ?>
        <span class="absolute right-0 top-4 text-sage text-lg" aria-hidden="true">✓</span>
    <?php endif; ?>

    <?php if ($mensaje) : ?>
        <p class="input-error-msg" <?php echo $estado === 'error' ? 'role="alert"' : ''; ?>>
            <?php echo esc_html($mensaje); ?>
        </p>
    <?php endif; ?>

</div>