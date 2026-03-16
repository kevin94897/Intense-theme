<?php
/**
 * Template Name: Design Your Trip
 *
 * @package intense-nerd-theme
 */
get_header();
?>

<main id="main" class="site-main" role="main">

    <!-- A. Hero Section -->
    <section class="relative h-screen min-h-[600px] flex items-center justify-center pt-20" data-aos="fade-in">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_banner_contact.webp"
                alt="Machu Picchu" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-neutral-black/40"></div>
        </div>

        <div class="container-site relative z-10 text-center px-4">
            <h1 class="font-heading text-white text-5xl md:text-[64px] leading-tight md:leading-[72px] mb-6"
                data-aos="fade-up" data-aos-delay="100">
                Let's Begin "Weaving" Your Journey
            </h1>
            <p class="font-body text-white/90 text-lg md:text-xl font-light max-w-2xl mx-auto mb-10" data-aos="fade-up"
                data-aos-delay="200">
                Share your preferences, pace, and dreams. Your custom-made journey starts here.
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4" data-aos="fade-up"
                data-aos-delay="300">
                <?php get_template_part('template-parts/components/btn-primary', null, [
                    'text' => 'Explore itineraries',
                    'href' => '#itineraries',
                ]); ?>
            </div>
        </div>
    </section>

    <!-- B. Form Section -->
    <section class="py-16 md:py-24 bg-cream">
        <div class="container-site max-w-3xl mx-auto px-4">

            <!-- Section Header -->
            <div class="text-center mb-12 md:mb-16" data-aos="fade-up">
                <div
            class="flex flex-col md:flex-row items-center justify-center text-center gap-4 md:gap-12 mb-10 overflow-hidden">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_decoration_title.webp" alt=""
                class="mx-auto md:mb-10">
            <h2 class="font-heading text-3xl md:text-5xl text-dark md:mb-10 min-w-fit" data-aos="fade-up">Start
                Designing Your Trip</h2>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/intense_decoration_title.webp" alt=""
                class="mx-auto mb-10 hidden md:block">
        </div>
                <p class="font-body text-sm md:text-[15px] text-dark/70 max-w-2xl mx-auto leading-relaxed">
                    Thank you for your interest in Intense Peru. Share a few details about your travel plans,
                    and our designers will create a personalized journey crafted with care and authenticity.
                </p>
            </div>

            <!-- Form -->
            <div class="max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                <form
                    x-data="bookingForm()"
                    @submit.prevent="submitForm"
                    class="space-y-8 md:space-y-10">

                    <!-- Name Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10">
                        <div class="relative">
                            <input type="text" x-model="formData.firstName" @input="validateField('firstName')"
                                class="w-full bg-transparent border-b border-neutral-gray pb-2 font-body text-sm text-dark focus:outline-none focus:border-primary transition-colors placeholder:text-dark/40"
                                placeholder="First Name">
                            <span x-show="errors.firstName" x-text="errors.firstName"
                                class="absolute left-0 -bottom-5 text-xs text-red-400 font-body"></span>
                        </div>
                        <div class="relative">
                            <input type="text" x-model="formData.lastName" @input="validateField('lastName')"
                                class="w-full bg-transparent border-b border-neutral-gray pb-2 font-body text-sm text-dark focus:outline-none focus:border-primary transition-colors placeholder:text-dark/40"
                                placeholder="Last Name">
                            <span x-show="errors.lastName" x-text="errors.lastName"
                                class="absolute left-0 -bottom-5 text-xs text-red-400 font-body"></span>
                        </div>
                    </div>

                    <!-- Email Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10">
                        <div class="relative">
                            <input type="email" x-model="formData.email" @input="validateField('email')"
                                class="w-full bg-transparent border-b border-neutral-gray pb-2 font-body text-sm text-dark focus:outline-none focus:border-primary transition-colors placeholder:text-dark/40"
                                placeholder="Email">
                            <span x-show="errors.email" x-text="errors.email"
                                class="absolute left-0 -bottom-5 text-xs text-red-400 font-body"></span>
                        </div>
                        <div class="relative">
                            <input type="email" x-model="formData.confirmEmail" @input="validateField('confirmEmail')"
                                class="w-full bg-transparent border-b border-neutral-gray pb-2 font-body text-sm text-dark focus:outline-none focus:border-primary transition-colors placeholder:text-dark/40"
                                placeholder="Confirm Email">
                            <span x-show="errors.confirmEmail" x-text="errors.confirmEmail"
                                class="absolute left-0 -bottom-5 text-xs text-red-400 font-body"></span>
                        </div>
                    </div>

                    <!-- Date & Trip Length Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10">
                        <div class="relative">
                            <div class="absolute right-0 top-0 bottom-2 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-dark/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input type="text"
                                onfocus="(this.type='date')" onblur="if(!this.value) this.type='text'"
                                x-model="formData.startDate" @input="validateField('startDate')"
                                class="w-full bg-transparent border-b border-neutral-gray pb-2 font-body text-sm text-dark focus:outline-none focus:border-primary transition-colors placeholder:text-dark/40 cursor-pointer"
                                placeholder="Start Date">
                            <span x-show="errors.startDate" x-text="errors.startDate"
                                class="absolute left-0 -bottom-5 text-xs text-red-400 font-body"></span>
                        </div>
                        <div class="relative">
                            <div class="absolute right-0 top-0 bottom-2 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-dark/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <select x-model="formData.tripLength" @change="validateField('tripLength')"
                                class="w-full bg-transparent border-b border-neutral-gray pb-2 font-body text-sm focus:outline-none focus:border-primary appearance-none rounded-none cursor-pointer"
                                :class="formData.tripLength ? 'text-dark' : 'text-dark/40'">
                                <option value="" disabled selected hidden>Trip Length</option>
                                <option value="1-4">1 to 4 days</option>
                                <option value="5-8">5 to 8 days</option>
                                <option value="9-14">9 to 14 days</option>
                                <option value="15+">15+ days</option>
                            </select>
                            <span x-show="errors.tripLength" x-text="errors.tripLength"
                                class="absolute left-0 -bottom-5 text-xs text-red-400 font-body"></span>
                        </div>
                    </div>

                    <!-- Passengers Row -->
                    <div class="grid grid-cols-3 gap-6 md:gap-10">
                        <div class="relative">
                            <div class="absolute right-0 top-0 bottom-2 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-dark/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <select x-model="formData.adults" @change="validateField('adults')"
                                class="w-full bg-transparent border-b border-neutral-gray pb-2 font-body text-sm focus:outline-none focus:border-primary appearance-none rounded-none cursor-pointer"
                                :class="(formData.adults && formData.adults !== '0') ? 'text-dark' : 'text-dark/40'">
                                <option value="0" disabled>Adults</option>
                                <option value="1">1 Adult</option>
                                <option value="2">2 Adults</option>
                                <option value="3">3 Adults</option>
                                <option value="4+">4+ Adults</option>
                            </select>
                            <span x-show="errors.adults" x-text="errors.adults"
                                class="absolute left-0 -bottom-5 text-xs text-red-400 font-body"></span>
                        </div>
                        <div class="relative">
                            <div class="absolute right-0 top-0 bottom-2 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-dark/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <select x-model="formData.children"
                                class="w-full bg-transparent border-b border-neutral-gray pb-2 font-body text-sm focus:outline-none focus:border-primary appearance-none rounded-none cursor-pointer"
                                :class="(formData.children && formData.children !== '0') ? 'text-dark' : 'text-dark/40'">
                                <option value="0" disabled>Children</option>
                                <option value="none">0 Children</option>
                                <option value="1">1 Child</option>
                                <option value="2">2 Children</option>
                                <option value="3+">3+ Children</option>
                            </select>
                        </div>
                        <div class="relative">
                            <div class="absolute right-0 top-0 bottom-2 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-dark/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <select x-model="formData.enfants"
                                class="w-full bg-transparent border-b border-neutral-gray pb-2 font-body text-sm focus:outline-none focus:border-primary appearance-none rounded-none cursor-pointer"
                                :class="(formData.enfants && formData.enfants !== '0') ? 'text-dark' : 'text-dark/40'">
                                <option value="0" disabled>Infants (&lt;1)</option>
                                <option value="none">0 Infants</option>
                                <option value="1">1 Infant</option>
                                <option value="2">2 Infants</option>
                            </select>
                        </div>
                    </div>

                    <!-- Hotel Category -->
                    <div class="pt-2">
                        <p class="font-body text-xs text-dark/40 uppercase tracking-widest mb-6">Hotel Category</p>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-6">

                            <!-- Boutique -->
                            <button type="button" @click="formData.hotelCategory = 'boutique'"
                                class="group flex flex-col items-center gap-2.5 px-3 py-2 rounded-md border transition-all duration-200"
                                :class="formData.hotelCategory === 'boutique'
                                    ? 'border-primary bg-primary/10'
                                    : 'border-neutral-gray hover:border-dark/40'">
                                <span class="font-body text-sm transition-colors"
                                    :class="formData.hotelCategory === 'boutique' ? 'text-primary font-medium' : 'text-neutral-gray'">
                                    Boutique
                                </span>
                                <div class="flex gap-0.5"
                                    :class="formData.hotelCategory === 'boutique' ? 'text-primary' : 'text-neutral-gray'">
                                    <template x-for="i in 5">
                                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </template>
                                </div>
                            </button>

                            <!-- Luxury -->
                            <button type="button" @click="formData.hotelCategory = 'luxury'"
                                class="group flex flex-col items-center gap-2.5 px-3 py-2 rounded-md border transition-all duration-200"
                                :class="formData.hotelCategory === 'luxury'
                                    ? 'border-primary bg-primary/10'
                                    : 'border-neutral-gray hover:border-dark/40'">
                                <span class="font-body text-sm transition-colors"
                                    :class="formData.hotelCategory === 'luxury' ? 'text-primary font-medium' : 'text-neutral-gray'">
                                    Luxury
                                </span>
                                <div class="flex gap-0.5"
                                    :class="formData.hotelCategory === 'luxury' ? 'text-primary' : 'text-neutral-gray'">
                                    <template x-for="i in 5">
                                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </template>
                                </div>
                            </button>

                            <!-- Superior -->
                            <button type="button" @click="formData.hotelCategory = 'superior'"
                                class="group flex flex-col items-center gap-2.5 px-3 py-2 rounded-md border transition-all duration-200"
                                :class="formData.hotelCategory === 'superior'
                                    ? 'border-primary bg-primary/10'
                                    : 'border-neutral-gray hover:border-dark/40'">
                                <span class="font-body text-sm transition-colors"
                                    :class="formData.hotelCategory === 'superior' ? 'text-primary font-medium' : 'text-neutral-gray'">
                                    Superior
                                </span>
                                <div class="flex gap-0.5"
                                    :class="formData.hotelCategory === 'superior' ? 'text-primary' : 'text-neutral-gray'">
                                    <template x-for="i in 4">
                                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </template>
                                </div>
                            </button>

                            <!-- Best Value -->
                            <button type="button" @click="formData.hotelCategory = 'value'"
                                class="group flex flex-col items-center gap-2.5 px-3 py-2 rounded-md border transition-all duration-200"
                                :class="formData.hotelCategory === 'value'
                                    ? 'border-primary bg-primary/10'
                                    : 'border-neutral-gray hover:border-dark/40'">
                                <span class="font-body text-sm transition-colors"
                                    :class="formData.hotelCategory === 'value' ? 'text-primary font-medium' : 'text-neutral-gray'">
                                    Best Value
                                </span>
                                <div class="flex gap-0.5"
                                    :class="formData.hotelCategory === 'value' ? 'text-primary' : 'text-neutral-gray'">
                                    <template x-for="i in 3">
                                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </template>
                                </div>
                            </button>

                        </div>
                        <span x-show="errors.hotelCategory" x-text="errors.hotelCategory"
                            class="block mt-2 text-xs text-red-400 font-body"></span>
                    </div>

                    <!-- WhatsApp & Hear about us -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10 pt-2">
                        <div class="relative">
                            <input type="text" x-model="formData.whatsapp"
                                class="w-full bg-transparent border-b border-neutral-gray pb-2 font-body text-sm text-dark focus:outline-none focus:border-primary transition-colors placeholder:text-dark/40"
                                placeholder="WhatsApp (optional)">
                        </div>
                        <div class="relative">
                            <div class="absolute right-0 top-0 bottom-2 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-dark/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <select x-model="formData.hearAboutUs"
                                class="w-full bg-transparent border-b border-neutral-gray pb-2 font-body text-sm focus:outline-none focus:border-primary appearance-none rounded-none cursor-pointer"
                                :class="formData.hearAboutUs ? 'text-dark' : 'text-dark/40'">
                                <option value="" disabled selected hidden>How did you hear about us</option>
                                <option value="google">Google Search</option>
                                <option value="friend">Friend / Family</option>
                                <option value="social">Social Media</option>
                                <option value="travel-agent">Travel Agent</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>

                    <!-- Message -->
                    <div class="pt-2">
                        <textarea rows="2" x-model="formData.mensaje"
                            class="w-full bg-transparent border-b border-neutral-gray pb-2 font-body text-sm text-dark focus:outline-none focus:border-primary transition-colors placeholder:text-dark/40 resize-none"
                            placeholder="Message (optional)"></textarea>
                    </div>

                    <!-- Submit -->
                    <div class="pt-4 flex justify-center">
                        <button type="submit"
                            class="px-10 py-2.5 rounded-full border border-dark/50 text-dark font-body text-sm hover:bg-primary hover:border-primary hover:text-white transition-all duration-300 flex items-center gap-2 disabled:opacity-40"
                            :disabled="isSubmitting">
                            <span x-show="!isSubmitting">Send Request</span>
                            <span x-show="isSubmitting" class="flex items-center gap-2" style="display:none;">
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
        </div>
    </section>

    <!-- ── SUCCESS MODAL ───────────────────────────────────────── -->
    <div
        x-data="{ open: false }"
        x-init="window.addEventListener('ccp:quoteSuccess', () => open = true)"
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm"
        style="display: none;">

        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            @click.outside="open = false"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-auto p-10 text-center relative">

            <!-- Close -->
            <button @click="open = false"
                class="absolute top-4 right-5 text-dark/30 hover:text-dark/60 transition-colors text-xl leading-none font-light">
                ×
            </button>

            <!-- Luggage Icon -->
            <div class="flex justify-center mb-6">
                <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- suitcase body -->
                    <rect x="8" y="20" width="40" height="30" rx="3" stroke="#1a1a1a" stroke-width="1.8" fill="none"/>
                    <!-- handle -->
                    <path d="M20 20V15a8 8 0 0116 0v5" stroke="#1a1a1a" stroke-width="1.8" stroke-linecap="round" fill="none"/>
                    <!-- center stripe -->
                    <line x1="28" y1="20" x2="28" y2="50" stroke="#1a1a1a" stroke-width="1.4"/>
                    <!-- horizontal strap -->
                    <line x1="8" y1="33" x2="48" y2="33" stroke="#1a1a1a" stroke-width="1.4"/>
                    <!-- wheels -->
                    <circle cx="16" cy="51" r="2" fill="#1a1a1a"/>
                    <circle cx="40" cy="51" r="2" fill="#1a1a1a"/>
                </svg>
            </div>

            <h3 class="font-heading text-2xl md:text-3xl text-dark font-light mb-3 leading-snug">
                Quote request<br>received!
            </h3>
            <p class="font-body text-sm text-dark/60 leading-relaxed mb-8 max-w-[220px] mx-auto">
                One of our travel designers will reach out within 24 hours to tailor this itinerary for you.
            </p>

            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="/"
                    class="px-6 py-2.5 rounded-full border border-dark/40 text-dark font-body text-sm hover:bg-dark hover:text-white transition-all duration-300">
                    Back to Home
                </a>
                <a href="/destinations"
                    class="px-6 py-2.5 rounded-full bg-primary text-white font-body text-sm hover:bg-hover transition-all duration-300">
                    Explore other journeys
                </a>
            </div>

        </div>
    </div>

    <!-- Alpine.js bookingForm component uses src/modules/bookingForm.js -->

    <!-- FAQ Section -->
    <section class="py-16 bg-cream border-t border-neutral-gray">
        <div class="container-site max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16 items-start">

                <!-- Left: Title -->
                <div class="lg:col-span-3 flex items-center gap-4" data-aos="fade-right">
                    <svg width="40" height="32" viewBox="0 0 65 41" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0 opacity-80">
                        <path d="M31.9972 27.997L18.8042 20.418L31.9972 12.8391L45.1902 20.418L31.9972 27.997Z" stroke="currentColor" class="text-hover" stroke-width="1.12281"/>
                        <path d="M31.9973 22.3832L28.3481 20.4183L31.9973 18.4534L35.6464 20.4183L31.9973 22.3832Z" fill="currentColor" stroke="currentColor" class="text-primary" stroke-width="1.12281"/>
                        <path d="M9.26025 0.488281L31.9971 13.4006L54.734 0.488281" stroke="currentColor" class="text-hover" stroke-width="1.12281"/>
                        <path d="M54.7339 40.3481L31.997 27.4359L9.26017 40.3481" stroke="currentColor" class="text-hover" stroke-width="1.12281"/>
                        <path d="M23.2954 3.29541L32.2779 8.90945L41.2603 3.29541" stroke="currentColor" class="text-primary" stroke-width="1.12281"/>
                        <path d="M41.2603 37.541L32.2778 31.927L23.2953 37.541" stroke="currentColor" class="text-primary" stroke-width="1.12281"/>
                        <path d="M64.2779 8.90942L44.0674 20.4182L64.2779 31.927" stroke="currentColor" class="text-primary" stroke-width="1.12281"/>
                        <path d="M0.277743 8.90942L20.4883 20.4182L0.277743 31.927" stroke="currentColor" class="text-primary" stroke-width="1.12281"/>
                    </svg>
                    <h2 class="font-heading text-4xl md:text-5xl font-light text-dark">FAQ</h2>
                </div>

                <!-- Right: Accordion -->
                <div class="lg:col-span-9" data-aos="fade-left"
                    x-data="{ active: null }">

                    <?php
                    $faqs = [
                        [
                            'q' => 'How do I book a trip with Intense Peru?',
                            'a' => 'Simply fill out our quote request form above with your travel dates, group size, and preferences. One of our travel designers will reach out within 24 hours to begin crafting your personalized itinerary.'
                        ],
                        [
                            'q' => 'What is included in the quoted price?',
                            'a' => 'Our quotes typically include accommodation, private transportation, guided tours, and entrance fees to all listed sites. International flights and personal expenses are generally not included unless specified. We will clearly outline every inclusion in your custom proposal.'
                        ],
                        [
                            'q' => 'Can I customize my itinerary after receiving the quote?',
                            'a' => 'Absolutely. Every journey we design is fully flexible. After reviewing your initial proposal, you can adjust destinations, pace, hotel categories, or activities as many times as needed until the itinerary feels exactly right for you.'
                        ],
                        [
                            'q' => 'How far in advance should I book?',
                            'a' => 'We recommend booking at least 2–3 months in advance, especially for peak season (June–August) and popular routes like the Inca Trail to Machu Picchu, which requires permits that sell out quickly. That said, we can often accommodate last-minute requests.'
                        ],
                        [
                            'q' => 'Do you offer private tours only?',
                            'a' => 'Yes. All Intense Peru experiences are exclusively private, ensuring you travel at your own pace with a dedicated guide who adapts the journey to your interests and energy each day.'
                        ],
                    ];
                    ?>

                    <ul class="divide-y divide-neutral-gray/50">
                        <?php foreach ($faqs as $i => $faq): ?>
                        <li>
                            <button
                                type="button"
                                @click="active === <?php echo $i; ?> ? active = null : active = <?php echo $i; ?>"
                                class="w-full flex items-center justify-between py-5 gap-6 text-left group focus:outline-none">

                                <span class="font-body text-sm md:text-[15px] transition-colors duration-200"
                                    :class="active === <?php echo $i; ?> ? 'text-primary' : 'text-dark/80 group-hover:text-dark'">
                                    <?php echo esc_html($faq['q']); ?>
                                </span>

                                <!-- Arrow: rotates to × when open -->
                                <span class="shrink-0 transition-transform duration-300"
                                    :class="active === <?php echo $i; ?> ? 'rotate-90' : ''">
                                    <svg class="w-8 h-4 transition-colors duration-200"
                                        :class="active === <?php echo $i; ?> ? 'text-primary' : 'text-primary/70 md:text-primary'"
                                        viewBox="0 0 32 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <line x1="0" y1="8" x2="26" y2="8" stroke="currentColor" stroke-width="1.2"/>
                                        <path d="M22 3l6 5-6 5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </button>

                            <!-- Answer -->
                            <div
                                x-show="active === <?php echo $i; ?>"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 -translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 -translate-y-2"
                                class="pb-5 pr-12">
                                <p class="font-body text-sm text-dark/60 leading-relaxed">
                                    <?php echo esc_html($faq['a']); ?>
                                </p>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>
        </div>
    </section>
    <!-- G. Banner CTA -->
    <?php get_template_part('template-parts/components/banner-cta'); ?>

    <!-- Testimonials -->
    <?php get_template_part('template-parts/home/section-testimonials'); ?>

</main>

<?php get_footer(); ?>