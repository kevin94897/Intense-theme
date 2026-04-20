<?php

/**
 * Template Name: Contact Page
 */
get_header(); 

$image_faq = get_field('image_faq');
$raw_whatsapp = get_theme_mod('contact_whatsapp', '51994008833');
$clean_whatsapp = str_replace(array(' ', '-', '(', ')', '+'), '', $raw_whatsapp);
?>

<main id="primary" class="site-main bg-cream">

    <!-- ══════════════════════════════════════════════
         1. TITLE SECTION  (no hero image — light page)
    ══════════════════════════════════════════════ -->
    <section class="pt-20 pb-14 md:pt-28 md:pb-16 bg-cream text-center" data-aos="fade-up">
        <div class="container-site max-w-4xl">

            <h1 class="font-heading text-4xl md:text-6xl text-dark mb-6 leading-tight">
                <?php echo esc_html(get_the_title()); ?>
            </h1>

            <?php if (get_the_content()) : ?>
                <div class="font-body body-medium text-dark max-w-4xl mx-auto mb-4 leading-relaxed entry-content">
                    <?php the_content(); ?>
                </div>
            <?php endif; ?>

            <!-- Inline contact shortcuts -->

            <div class="flex flex-wrap justify-center items-center gap-2 md:gap-5 font-body body-small text-dark">
                <p class="font-body body-small text-dark">Prefer to talk? You can call us at</p>
                <a href="https://wa.me/<?php echo esc_attr($clean_whatsapp); ?>"
                    target="_blank" rel="noopener"
                    class="flex items-center gap-1.5 hover:text-primary transition-colors duration-200">
                    <svg width="26" height="27" viewBox="0 0 26 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_2764_34720)">
                            <path d="M3.25 23.625L5.0375 19.35C3.66997 17.3341 3.05789 14.8692 3.31613 12.4179C3.57437 9.96657 4.68518 7.6974 6.4401 6.03621C8.19502 4.37501 10.4734 3.43599 12.8477 3.39536C15.2219 3.35473 17.5289 4.21529 19.3355 5.81554C21.1422 7.41579 22.3244 9.64572 22.6603 12.0868C22.9962 14.528 22.4626 17.0125 21.1598 19.0741C19.857 21.1357 17.8744 22.6328 15.5842 23.2842C13.294 23.9357 10.8535 23.6969 8.72083 22.6125L3.25 23.625Z" stroke="#383838" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9.75 11.25C9.75 11.3992 9.80707 11.5423 9.90865 11.6477C10.0102 11.7532 10.148 11.8125 10.2917 11.8125C10.4353 11.8125 10.5731 11.7532 10.6747 11.6477C10.7763 11.5423 10.8333 11.3992 10.8333 11.25V10.125C10.8333 9.97582 10.7763 9.83274 10.6747 9.72725C10.5731 9.62176 10.4353 9.5625 10.2917 9.5625C10.148 9.5625 10.0102 9.62176 9.90865 9.72725C9.80707 9.83274 9.75 9.97582 9.75 10.125V11.25ZM9.75 11.25C9.75 12.7418 10.3207 14.1726 11.3365 15.2275C12.3523 16.2824 13.7301 16.875 15.1667 16.875M15.1667 16.875H16.25C16.3937 16.875 16.5314 16.8157 16.633 16.7102C16.7346 16.6048 16.7917 16.4617 16.7917 16.3125C16.7917 16.1633 16.7346 16.0202 16.633 15.9148C16.5314 15.8093 16.3937 15.75 16.25 15.75H15.1667C15.023 15.75 14.8852 15.8093 14.7836 15.9148C14.6821 16.0202 14.625 16.1633 14.625 16.3125C14.625 16.4617 14.6821 16.6048 14.7836 16.7102C14.8852 16.8157 15.023 16.875 15.1667 16.875Z" stroke="#383838" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                        <defs>
                            <clipPath id="clip0_2764_34720">
                                <rect width="26" height="27" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>

                    +<?php echo get_theme_mod('contact_whatsapp', '51994008833'); ?>
                </a>
                <span class="text-dark hidden sm:inline">/</span>
                <a href="tel:<?php echo esc_attr(get_theme_mod('contact_phone', '18006709510')); ?>"
                    class="flex items-center gap-1.5 hover:text-primary transition-colors duration-200">
                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.5077 21.6667C20.8386 21.6667 21.1144 21.5583 21.3351 21.3417C21.5557 21.125 21.666 20.8542 21.666 20.5292V17.8918C21.666 17.6015 21.5744 17.3442 21.3911 17.1199C21.2077 16.8955 20.9687 16.7472 20.6742 16.6749L18.3952 16.2083C18.1285 16.1722 17.8851 16.1844 17.665 16.2449C17.4449 16.3052 17.2466 16.4305 17.0702 16.6208L14.7535 18.9792C13.8869 18.4986 13.0911 17.9878 12.3661 17.4468C11.641 16.9059 10.9639 16.3208 10.3349 15.6916C9.72515 15.0722 9.15117 14.4164 8.61293 13.7239C8.0747 13.0315 7.58341 12.2819 7.13906 11.4749L9.51589 9.25845C9.68814 9.114 9.8083 8.92857 9.87637 8.70216C9.94444 8.47574 9.95347 8.21113 9.90345 7.90834L9.36612 5.32513C9.2883 5.0348 9.13961 4.79692 8.92006 4.61149C8.70068 4.42606 8.44375 4.33334 8.14927 4.33334H5.47018C5.14518 4.33334 4.87435 4.44366 4.65768 4.6643C4.44102 4.88494 4.33268 5.16074 4.33268 5.4917C4.33268 7.31802 4.78994 9.18677 5.70446 11.0979C6.61915 13.0091 7.89938 14.791 9.54514 16.4437C11.1911 18.0965 12.9731 19.3802 14.8911 20.2949C16.8092 21.2094 18.6813 21.6667 20.5077 21.6667ZM6.63693 10.4582C6.27438 9.64303 5.98757 8.83261 5.77649 8.02697C5.56543 7.22151 5.44942 6.44864 5.42848 5.70836C5.42848 5.62495 5.45628 5.55552 5.51189 5.50009C5.5675 5.44448 5.63693 5.41668 5.72016 5.41668H7.93693C8.04798 5.41668 8.13825 5.44448 8.20777 5.50009C8.2771 5.55552 8.32567 5.63885 8.35348 5.75007L8.84097 8.04593C8.86878 8.12916 8.8723 8.21944 8.85154 8.31676C8.83059 8.4139 8.78545 8.49027 8.71612 8.54588L6.63693 10.4582ZM15.7911 19.4751L17.8286 17.3959C17.8979 17.3264 17.9639 17.2813 18.0266 17.2605C18.089 17.2395 18.1619 17.243 18.2451 17.2708L20.2493 17.6876C20.3605 17.7154 20.4438 17.764 20.4993 17.8333C20.5549 17.9028 20.5827 17.9931 20.5827 18.1041V20.2792C20.5827 20.3624 20.5549 20.4319 20.4993 20.4875C20.4438 20.5431 20.3744 20.5709 20.291 20.5709C19.6757 20.5584 18.9548 20.4633 18.1284 20.2854C17.3022 20.1076 16.5231 19.8375 15.7911 19.4751Z" fill="#383838" />
                    </svg>

                    <?php echo esc_html(get_theme_mod('contact_phone_text', '1 800 670 9510 Toll Free (US, CAN)')); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════════════
         2. CONTACT FORM  — minimal, centered, full max-w-3xl
    ══════════════════════════════════════════════ -->
    <section class="pb-0 bg-cream">
        <div class="container-site !max-w-3xl mx-auto px-4" data-aos="fade-up" data-aos-delay="80">

            <form
                x-data="contactForm()"
                @submit.prevent="submitForm"
                class="space-y-10">

                <!-- First / Last Name -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10">
                    <div class="input-wrapper" :class="{ 'has-error': errors.firstName }">
                        <input type="text"
                            x-model="formData.firstName"
                            @blur="validateField('firstName')"
                            class="input-field" placeholder="First Name">
                        <label class="input-label">First Name</label>
                        <span x-show="errors.firstName" x-text="errors.firstName" class="input-error-msg"></span>
                    </div>
                    <div class="input-wrapper" :class="{ 'has-error': errors.lastName }">
                        <input type="text"
                            x-model="formData.lastName"
                            @blur="validateField('lastName')"
                            class="input-field" placeholder="Last Name">
                        <label class="input-label">Last Name</label>
                        <span x-show="errors.lastName" x-text="errors.lastName" class="input-error-msg"></span>
                    </div>
                </div>

                <!-- Telephone — full width -->
                <div class="input-wrapper">
                    <input type="tel"
                        x-model="formData.telephone"
                        class="input-field" placeholder="Telephone / Whatsapp (optional)">
                    <label class="input-label">Telephone / Whatsapp (optional)</label>
                </div>

                <!-- Email / Confirm Email -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10">
                    <div class="input-wrapper" :class="{ 'has-error': errors.email }">
                        <input type="email"
                            x-model="formData.email"
                            @blur="validateField('email')"
                            class="input-field" placeholder="Email">
                        <label class="input-label">Email</label>
                        <span x-show="errors.email" x-text="errors.email" class="input-error-msg"></span>
                    </div>
                    <div class="input-wrapper" :class="{ 'has-error': errors.confirmEmail }">
                        <input type="email"
                            x-model="formData.confirmEmail"
                            @blur="validateField('confirmEmail')"
                            class="input-field" placeholder="Confirm Email">
                        <label class="input-label">Confirm Email</label>
                        <span x-show="errors.confirmEmail" x-text="errors.confirmEmail" class="input-error-msg"></span>
                    </div>
                </div>

                <!-- Message — full width -->
                <div class="input-wrapper">
                    <textarea
                        x-model="formData.mensaje"
                        class="input-field"
                        rows="2"
                        placeholder="Message (optional)"></textarea>
                </div>

                <!-- Submit -->
                <div class="flex justify-center pt-2">
                    <button
                        type="submit"
                        class="btn-submit-intense"
                        :disabled="isSubmitting">
                        <span x-show="!isSubmitting">Send Message</span>
                        <span x-show="isSubmitting" class="flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                            </svg>
                            Sending...
                        </span>
                    </button>
                </div>

            </form>
        </div>
    </section>

    <!-- ══════════════════════════════════════════════
         3. FAQ  — image left | accordion right
    ══════════════════════════════════════════════ -->
    <section class="py-20 md:py-28 bg-cream">
        <div class="container-site">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-start">

                <!-- Left: Photo -->
                <div class="relative" data-aos="fade-right">
                    <div class="rounded-lg overflow-hidden shadow-xl aspect-4/3 md:aspect-auto md:h-full">
                        <?php if (!empty($image_faq)): ?>
                            <img
                                src="<?php echo esc_url($image_faq['url']); ?>"
                                alt="<?php echo esc_attr($image_faq['alt'] ?: get_the_title()); ?>"
                                class="w-full h-full object-cover">
                        <?php else: ?>
                            <img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_faq_contact_img.webp"
                                alt="Vicuñas in the Peruvian highlands"
                                class="w-full h-full object-cover">
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Right: FAQ accordion -->
                <div data-aos="fade-left">

                    <!-- Title row -->
                    <div class="flex items-center gap-4 mb-10 justify-center">
                        <svg width="42" height="27" viewBox="0 0 65 41" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                            <path d="M31.9972 27.997L18.8042 20.418L31.9972 12.8391L45.1902 20.418L31.9972 27.997Z" stroke="#7B4424" stroke-width="1.12281" />
                            <path d="M31.9973 22.3832L28.3481 20.4183L31.9973 18.4534L35.6464 20.4183L31.9973 22.3832Z" fill="#B76739" stroke="#B76739" stroke-width="1.12281" />
                            <path d="M9.26025 0.488281L31.9971 13.4006L54.734 0.488281" stroke="#7B4424" stroke-width="1.12281" />
                            <path d="M54.7339 40.3481L31.997 27.4359L9.26017 40.3481" stroke="#7B4424" stroke-width="1.12281" />
                            <path d="M23.2954 3.29541L32.2779 8.90945L41.2603 3.29541" stroke="#B76739" stroke-width="1.12281" />
                            <path d="M41.2603 37.541L32.2778 31.927L23.2953 37.541" stroke="#B76739" stroke-width="1.12281" />
                            <path d="M64.2779 8.90942L44.0674 20.4182L64.2779 31.927" stroke="#B76739" stroke-width="1.12281" />
                            <path d="M0.277743 8.90942L20.4883 20.4182L0.277743 31.927" stroke="#B76739" stroke-width="1.12281" />
                        </svg>
                        <h2 class="font-heading text-5xl md:text-6xl text-dark font-light">FAQ</h2>
                    </div>

                    <?php
                    $faqs_global = get_field('faqs', 'option');
                    $faqs        = array_slice( $faqs_global['list_of_questions'] ?? [], 0, 4 );
                    ?>

                    <div x-data="{ active: null }" class="divide-y divide-neutral-gray/30">
                        <?php foreach ($faqs as $i => $faq): ?>
                            <div>
                                <button
                                    type="button"
                                    @click="active === <?php echo $i; ?> ? active = null : active = <?php echo $i; ?>"
                                    class="w-full flex items-center justify-between gap-6 py-5 text-left group focus-visible:outline-none">

                                    <span
                                        class="font-body body-medium leading-snug transition-colors duration-200"
                                        :class="active === <?php echo $i; ?> ? 'text-primary' : 'text-dark/80 group-hover:text-dark'">
                                        <?php echo esc_html($faq['question']); ?>
                                    </span>

                                    <!-- Chevron -->
                                    <svg class="w-5 h-5 shrink-0 transition-all duration-300"
                                        :class="active === <?php echo $i; ?> ? 'rotate-180 text-primary' : 'text-dark/35 group-hover:text-dark/60'"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Answer -->
                                <div
                                    x-show="active === <?php echo $i; ?>"
                                    x-transition:enter="transition ease-out duration-250"
                                    x-transition:enter-start="opacity-0 -translate-y-1"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0"
                                    style="display:none;"
                                    class="pb-5 pr-8">
                                    <div class="font-body body-small text-dark/60 leading-relaxed">
                                        <?php echo wp_kses_post($faq['response']); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════════════
         4. SUCCESS MODAL
    ══════════════════════════════════════════════ -->
    <div
        x-data="{ show: false }"
        @ccp:quotesuccess.window="show = true"
        x-show="show"
        style="display:none;"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-dark/50 backdrop-blur-sm"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">

        <div
            x-show="show"
            @click.outside="show = false"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-3"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="bg-white rounded-lg shadow-2xl w-full max-w-sm mx-auto px-10 pt-10 pb-10 text-center relative">

            <!-- × close -->
            <button @click="show = false"
                class="absolute top-5 right-5 text-dark/30 hover:text-dark/60 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Luggage icon -->
            <div class="flex justify-center mb-7">
                <svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="7" y="21" width="44" height="31" rx="3.5" stroke="#423931" stroke-width="1.5" fill="none" />
                    <path d="M21 21V16.5a8.5 8.5 0 0117 0V21" stroke="#423931" stroke-width="1.5" stroke-linecap="round" fill="none" />
                    <line x1="29" y1="21" x2="29" y2="52" stroke="#423931" stroke-width="1.2" />
                    <line x1="7" y1="35" x2="51" y2="35" stroke="#423931" stroke-width="1.2" />
                    <circle cx="17" cy="54" r="2" fill="#423931" />
                    <circle cx="41" cy="54" r="2" fill="#423931" />
                </svg>
            </div>

            <h2 class="font-heading text-3xl md:text-4xl text-dark font-light mb-3 leading-snug">
                Thank you for<br>reaching out!
            </h2>
            <p class="font-body body-small text-dark/55 leading-relaxed mb-8 max-w-[210px] mx-auto">
                We've received your message and our travel designers will get back to you within 24 hours.
            </p>

            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="<?php echo esc_url(home_url('/')); ?>"
                    class="btn btn-outline px-6 py-2.5 rounded-full font-body body-small">
                    Back to Home
                </a>
                <a href="<?php echo esc_url(home_url('/journeys/')); ?>"
                    class="btn btn-primary px-6 py-2.5 rounded-full font-body body-small">
                    Explore Journeys
                </a>
            </div>

        </div>
    </div>

    <!-- Alpine.js component -->
    <script>
        function contactForm() {
            return {
                formData: {
                    firstName: '',
                    lastName: '',
                    telephone: '',
                    email: '',
                    confirmEmail: '',
                    mensaje: '',
                },
                errors: {},
                isSubmitting: false,

                validateField(field) {
                    const v = this.formData;
                    if (field === 'firstName')
                        this.errors.firstName = v.firstName.trim() ? '' : 'First name is required.';
                    if (field === 'lastName')
                        this.errors.lastName = v.lastName.trim() ? '' : 'Last name is required.';
                    if (field === 'email')
                        this.errors.email = /\S+@\S+\.\S+/.test(v.email) ?
                        '' : 'Please enter a valid email address.';
                    if (field === 'confirmEmail')
                        this.errors.confirmEmail = v.email === v.confirmEmail ?
                        '' : 'Emails do not match.';
                },

                validateAll() {
                    ['firstName', 'lastName', 'email', 'confirmEmail'].forEach(f => this.validateField(f));
                    return !Object.values(this.errors).some(e => e && e.length > 0);
                },

                async submitForm() {
                    if (!this.validateAll()) return;
                    this.isSubmitting = true;
                    try {
                        const body = new URLSearchParams({
                            action: 'intense_contact',
                            nonce:  intenseAjax.nonce,
                            ...this.formData,
                        });
                        const res  = await fetch(intenseAjax.ajaxUrl, { method: 'POST', body });
                        const json = await res.json();
                        if (!json.success) throw new Error(json.data?.message || 'Error');
                        window.dispatchEvent(new CustomEvent('ccp:quotesuccess'));
                    } catch (err) {
                        console.error('Form error:', err);
                    } finally {
                        this.isSubmitting = false;
                    }
                },
            };
        }
    </script>

</main>

<?php get_footer(); ?>