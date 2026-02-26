<?php

/**
 * Página 404 — Contenido no encontrado
 *
 * @package intense-nerd-theme
 */
get_header();
?>

<main id="main" class="site-main" role="main">
    <div class="container-site py-32 text-center" data-aos="fade-up">

        <!-- Número 404 decorativo -->
        <p class="font-heading text-[160px] leading-none text-primary/20 select-none mb-8">
            404
        </p>

        <h1 class="heading-2 text-dark mb-4">
            <?php esc_html_e('Página no encontrada', 'intense-nerd-theme'); ?>
        </h1>

        <p class="body-large text-neutral-gray max-w-md mx-auto mb-10">
            <?php esc_html_e('Lo sentimos, la página que buscas no existe o fue movida. Intenta regresar al inicio.', 'intense-nerd-theme'); ?>
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                <?php esc_html_e('Ir al inicio', 'intense-nerd-theme'); ?>
            </a>
            <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn btn-outline">
                <?php esc_html_e('Contáctanos', 'intense-nerd-theme'); ?>
            </a>
        </div>

        <!-- Búsqueda -->
        <div class="mt-16 max-w-sm mx-auto" data-aos="fade-up" data-aos-delay="100">
            <p class="body-small text-neutral-gray mb-4">
                <?php esc_html_e('O busca lo que necesitas:', 'intense-nerd-theme'); ?>
            </p>
            <?php get_search_form(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>