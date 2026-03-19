<?php
/**
 * Template Name: Contact Page
 */
get_header(); ?>

<main id="primary" class="site-main bg-cream">

    <!-- ══════════════════════════════════════════════
         1. TITLE SECTION  (no hero image — light page)
    ══════════════════════════════════════════════ -->
    <section class="pt-20 pb-14 md:pt-28 md:pb-16 bg-cream text-center" data-aos="fade-up">
        <div class="container-site max-w-3xl">

            <h1 class="font-heading text-4xl md:text-6xl text-dark mb-6 leading-tight">
                Contact Us
            </h1>

            <p class="font-body body-medium text-dark/70 max-w-xl mx-auto mb-4 leading-relaxed">
                Thank you for your interest in Intense Peru.<br>
                Share a few details about your inquiry — our travel designers<br>will get back to you within 24 hours.
            </p>

            <!-- Inline contact shortcuts -->
            <p class="font-body body-small text-dark/50 mb-1">Prefer to talk? You can call us at</p>
            <div class="flex flex-wrap justify-center items-center gap-2 md:gap-5 font-body body-small text-dark/75">
                <a href="https://wa.me/<?php echo esc_attr(intense_nerd_whatsapp_number()); ?>"
                   target="_blank" rel="noopener"
                   class="flex items-center gap-1.5 hover:text-primary transition-colors duration-200">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" class="shrink-0 opacity-70">
                        <path d="M3 21l1.65-3.8C3.39 15.41 2.82 13.22 3.06 11.04 3.3 8.86 4.32 6.84 5.94 5.37 7.56 3.89 9.67 3.05 11.86 3.02c2.19-.04 4.32.72 5.99 2.15 1.67 1.42 2.76 3.4 3.07 5.57.31 2.17-.18 4.38-1.38 6.21-1.2 1.83-3.03 3.16-5.14 3.74-2.11.58-4.36.37-6.33-.52L3 21z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    +<?php echo esc_html(intense_nerd_whatsapp_number()); ?>
                </a>
                <span class="text-dark/25 hidden sm:inline">/</span>
                <a href="tel:18006709510"
                   class="flex items-center gap-1.5 hover:text-primary transition-colors duration-200">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none" class="shrink-0 opacity-70">
                        <path d="M14.93 16c.31 0 .56-.1.76-.3.2-.2.3-.45.3-.75v-2.43c0-.27-.08-.51-.25-.72-.17-.2-.39-.34-.66-.41l-2.1-.43c-.25-.03-.47-.02-.67.04-.2.06-.38.17-.54.35L9.62 13.52A11.04 11.04 0 0 1 2.48 6.39l2.19-2.04c.16-.17.27-.34.33-.55.06-.2.07-.45.03-.72L4.6.91C4.53.64 4.39.42 4.18.25 3.97.08 3.73 0 3.46 0H1.05C.75 0 .5.1.3.31.1.51 0 .76 0 1.07 0 2.76.42 4.48 1.27 6.24c.84 1.77 2.02 3.41 3.54 4.94 1.52 1.52 3.16 2.71 4.92 3.54 1.77.84 3.5 1.26 5.19 1.26z" fill="currentColor"/>
                    </svg>
                    1 800 670 9510 Toll Free (US, CAN)
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
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
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
                    <div class="rounded-2xl overflow-hidden shadow-xl">
                        <img
                            src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_faq_contact_img.webp"
                            alt="Vicuñas in the Peruvian highlands"
                            class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Right: FAQ accordion -->
                <div data-aos="fade-left">

                    <!-- Title row -->
                    <div class="flex items-center gap-4 mb-10 justify-center">
                        <svg width="42" height="27" viewBox="0 0 65 41" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                            <path d="M31.9972 27.997L18.8042 20.418L31.9972 12.8391L45.1902 20.418L31.9972 27.997Z" stroke="#7B4424" stroke-width="1.12281"/>
                            <path d="M31.9973 22.3832L28.3481 20.4183L31.9973 18.4534L35.6464 20.4183L31.9973 22.3832Z" fill="#B76739" stroke="#B76739" stroke-width="1.12281"/>
                            <path d="M9.26025 0.488281L31.9971 13.4006L54.734 0.488281" stroke="#7B4424" stroke-width="1.12281"/>
                            <path d="M54.7339 40.3481L31.997 27.4359L9.26017 40.3481" stroke="#7B4424" stroke-width="1.12281"/>
                            <path d="M23.2954 3.29541L32.2779 8.90945L41.2603 3.29541" stroke="#B76739" stroke-width="1.12281"/>
                            <path d="M41.2603 37.541L32.2778 31.927L23.2953 37.541" stroke="#B76739" stroke-width="1.12281"/>
                            <path d="M64.2779 8.90942L44.0674 20.4182L64.2779 31.927" stroke="#B76739" stroke-width="1.12281"/>
                            <path d="M0.277743 8.90942L20.4883 20.4182L0.277743 31.927" stroke="#B76739" stroke-width="1.12281"/>
                        </svg>
                        <h2 class="font-heading text-5xl md:text-6xl text-dark font-light">FAQ</h2>
                    </div>

                    <?php
                    $faqs = [
                        [
                            'q' => 'How do I book a trip with Intense Peru?',
                            'a' => 'Fill out our contact form with your travel dates, group size, and preferences. One of our travel designers will reach out within 24 hours to craft your personalized itinerary — no commitment required.',
                        ],
                        [
                            'q' => 'What is included in the quoted price?',
                            'a' => 'Our quotes typically include private accommodation, internal transportation, expert local guides, and entrance fees to all listed sites. International flights and personal expenses are not included unless specified. Every inclusion is clearly outlined in your custom proposal.',
                        ],
                        [
                            'q' => 'Can I customize my itinerary after receiving the quote?',
                            'a' => 'Absolutely. Every journey we design is completely flexible. After reviewing your initial proposal you can adjust destinations, pace, hotel category, or activities as many times as needed until it feels exactly right.',
                        ],
                        [
                            'q' => 'Do you offer group discounts?',
                            'a' => 'Yes. We offer special rates for groups of 6 or more travellers. Mention your group size in the contact form and we will include a dedicated group rate in your proposal.',
                        ],
                    ];
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
                                    <?php echo esc_html($faq['q']); ?>
                                </span>

                                <!-- Chevron -->
                                <svg class="w-5 h-5 shrink-0 transition-all duration-300"
                                     :class="active === <?php echo $i; ?> ? 'rotate-180 text-primary' : 'text-dark/35 group-hover:text-dark/60'"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
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
                                <p class="font-body body-small text-dark/60 leading-relaxed">
                                    <?php echo esc_html($faq['a']); ?>
                                </p>
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
            class="bg-white rounded-2xl shadow-2xl w-full max-w-sm mx-auto px-10 pt-10 pb-10 text-center relative">

            <!-- × close -->
            <button @click="show = false"
                class="absolute top-5 right-5 text-dark/30 hover:text-dark/60 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Luggage icon -->
            <div class="flex justify-center mb-7">
                <svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="7" y="21" width="44" height="31" rx="3.5" stroke="#423931" stroke-width="1.5" fill="none"/>
                    <path d="M21 21V16.5a8.5 8.5 0 0117 0V21" stroke="#423931" stroke-width="1.5" stroke-linecap="round" fill="none"/>
                    <line x1="29" y1="21" x2="29" y2="52" stroke="#423931" stroke-width="1.2"/>
                    <line x1="7" y1="35" x2="51" y2="35" stroke="#423931" stroke-width="1.2"/>
                    <circle cx="17" cy="54" r="2" fill="#423931"/>
                    <circle cx="41" cy="54" r="2" fill="#423931"/>
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
                firstName:    '',
                lastName:     '',
                telephone:    '',
                email:        '',
                confirmEmail: '',
                mensaje:      '',
            },
            errors:        {},
            isSubmitting:  false,

            validateField(field) {
                const v = this.formData;
                if (field === 'firstName')
                    this.errors.firstName    = v.firstName.trim()    ? '' : 'First name is required.';
                if (field === 'lastName')
                    this.errors.lastName     = v.lastName.trim()     ? '' : 'Last name is required.';
                if (field === 'email')
                    this.errors.email        = /\S+@\S+\.\S+/.test(v.email)
                        ? '' : 'Please enter a valid email address.';
                if (field === 'confirmEmail')
                    this.errors.confirmEmail = v.email === v.confirmEmail
                        ? '' : 'Emails do not match.';
            },

            validateAll() {
                ['firstName','lastName','email','confirmEmail'].forEach(f => this.validateField(f));
                return !Object.values(this.errors).some(e => e && e.length > 0);
            },

            async submitForm() {
                if (!this.validateAll()) return;
                this.isSubmitting = true;
                try {
                    // ── swap for your real wp_ajax / CF7 / REST endpoint ──
                    await new Promise(r => setTimeout(r, 1200));
                    // ─────────────────────────────────────────────────────
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