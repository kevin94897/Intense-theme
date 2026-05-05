<?php
/**
 * Template Name: Thank You Page
 */
get_header();
?>

<main id="primary" class="site-main bg-cream">

    <section class="pt-20 pb-14 md:pt-28 md:pb-16 bg-cream flex items-center justify-center min-h-[60vh]">
        <div class="container-site max-w-lg mx-auto text-center" data-aos="fade-up">

            <!-- Luggage icon -->
            <div class="flex justify-center mb-10">
                <svg width="68" height="68" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="7" y="21" width="44" height="31" rx="3.5" stroke="#423931" stroke-width="1.5"
                        fill="none" />
                    <path d="M21 21V16.5a8.5 8.5 0 0117 0V21" stroke="#423931" stroke-width="1.5" stroke-linecap="round"
                        fill="none" />
                    <line x1="29" y1="21" x2="29" y2="52" stroke="#423931" stroke-width="1.2" />
                    <line x1="7" y1="35" x2="51" y2="35" stroke="#423931" stroke-width="1.2" />
                    <circle cx="17" cy="54" r="2" fill="#423931" />
                    <circle cx="41" cy="54" r="2" fill="#423931" />
                </svg>
            </div>

            <h1 class="font-heading text-4xl md:text-5xl text-dark font-light mb-5 leading-snug">
                Thank you for<br>reaching out!
            </h1>

            <p class="font-body body-medium text-dark/70 leading-relaxed mb-10 max-w-sm mx-auto">
                We've received your message and our travel designers will get back to you within 24 hours.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo esc_url(home_url('/')); ?>"
                    class="btn btn-outline px-8 py-3 rounded-full font-body body-small">
                    Back to Home
                </a>
                <a href="<?php echo esc_url(home_url('/journeys/')); ?>"
                    class="btn btn-primary px-8 py-3 rounded-full font-body body-small">
                    Explore Journeys
                </a>
            </div>

        </div>

</main>

<?php get_footer(); ?>