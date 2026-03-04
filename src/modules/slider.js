import EmblaCarousel from 'embla-carousel'

export function initSliders() {
    const emblaNode = document.querySelector('.embla')
    if (!emblaNode) return

    const options = { loop: true }
    const emblaApi = EmblaCarousel(emblaNode, options)

    const prevBtn = document.querySelector('.embla__prev')
    const nextBtn = document.querySelector('.embla__next')

    if (prevBtn && nextBtn) {
        // Add click listeners
        prevBtn.addEventListener('click', () => emblaApi.scrollPrev(), false)
        nextBtn.addEventListener('click', () => emblaApi.scrollNext(), false)

        // Disable buttons when not loop and at edge (though loop is true here)
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
    }
}
