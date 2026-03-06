import EmblaCarousel from 'embla-carousel'

export function initSliders() {
    const emblaNodes = document.querySelectorAll('.embla')
    if (emblaNodes.length === 0) return

    emblaNodes.forEach(emblaNode => {
        // Obtenemos su wrapper padre para buscar sus propios botones
        const wrapper = emblaNode.closest('.embla-gallery') || emblaNode.parentElement;
        
        const options = { loop: true }
        const emblaApi = EmblaCarousel(emblaNode, options)

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
        }
    });
}
