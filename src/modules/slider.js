import EmblaCarousel from 'embla-carousel'

/**
 * Filters activity slides by category slug and reinitialises Embla.
 * Exposed as window.filterActivities for Alpine.js onclick handlers.
 *
 * @param {HTMLElement} sliderEl  The .embla viewport element (x-ref="activitiesSlider")
 * @param {string}      catSlug   Category slug to show, or 'all'
 */
window.filterActivities = function (sliderEl, catSlug) {
    if (!sliderEl) return

    const wrapper   = sliderEl.closest('.embla-activities')
    const loader    = wrapper?.querySelector('.activities-loader')
    const container = sliderEl.querySelector('.embla__container')
    if (!container) return

    // Cache all original slides on first call
    if (!sliderEl._allSlides) {
        sliderEl._allSlides = Array.from(container.querySelectorAll('.embla__slide'))
    }
    const allSlides = sliderEl._allSlides

    // Show loader
    if (loader) {
        loader.classList.remove('opacity-0', 'pointer-events-none')
        loader.classList.add('opacity-100', 'pointer-events-auto')
    }

    setTimeout(() => {
        // Rebuild container with only matching slides
        const matching = allSlides.filter(slide => {
            const cats = (slide.dataset.category || '').split(' ').filter(Boolean)
            return catSlug === 'all' || cats.includes(catSlug)
        })

        // Clear container and append only matching slides
        container.innerHTML = ''
        matching.forEach(s => {
            s.style.display = ''
            container.appendChild(s)
        })

        // Reinit Embla with the new slide set
        const api = sliderEl._emblaApi
        if (api) {
            api.reInit()
            api.scrollTo(0, true)
        }

        // Hide loader
        setTimeout(() => {
            if (loader) {
                loader.classList.remove('opacity-100', 'pointer-events-auto')
                loader.classList.add('opacity-0', 'pointer-events-none')
            }
        }, 180)
    }, 120)
}

export function initSliders() {
    const emblaNodes = document.querySelectorAll('.embla')
    if (emblaNodes.length === 0) return

    emblaNodes.forEach(emblaNode => {
        // Skip #teamEmbla as it has its own initialization in section-conocenos.php
        if (emblaNode.id === 'teamEmbla') return

        // Obtenemos su wrapper padre para buscar sus propios botones
        const wrapper = emblaNode.closest('.embla-gallery') || emblaNode.closest('.embla-stories') || emblaNode.closest('.embla-activities') || emblaNode.parentElement;

        const isStories    = wrapper.classList.contains('embla-stories');
        const isActivities = wrapper.classList.contains('embla-activities');

        const options = {
            loop:          true,
            align:         'start',
            containScroll: isStories ? 'trimSnaps' : false,
            dragFree:      isActivities ? false : false,
        }

        const emblaApi = EmblaCarousel(emblaNode, options)
        // Expose API on the DOM element for external access (e.g. filterActivities)
        emblaNode._emblaApi = emblaApi

        const prevBtn = wrapper.querySelector('.embla__prev')
        const nextBtn = wrapper.querySelector('.embla__next')

        if (prevBtn && nextBtn) {
            prevBtn.addEventListener('click', () => emblaApi.scrollPrev(), false)
            nextBtn.addEventListener('click', () => emblaApi.scrollNext(), false)

            const updateButtons = () => {
                if (!emblaApi.canScrollPrev()) {
                    prevBtn.setAttribute('disabled', 'disabled')
                } else {
                    prevBtn.removeAttribute('disabled')
                }

                if (!emblaApi.canScrollNext()) {
                    nextBtn.setAttribute('disabled', 'disabled')
                } else {
                    nextBtn.removeAttribute('disabled')
                }
            }

            emblaApi.on('select', updateButtons)
            emblaApi.on('init', updateButtons)
            
            // Initial call to set correct button states
            updateButtons();
        }
    });
}
