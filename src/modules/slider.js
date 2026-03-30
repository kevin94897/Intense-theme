import EmblaCarousel from 'embla-carousel'

export function initSliders() {
    const emblaNodes = document.querySelectorAll('.embla')
    if (emblaNodes.length === 0) return

    emblaNodes.forEach(emblaNode => {
        // Skip #teamEmbla as it has its own initialization in section-conocenos.php
        if (emblaNode.id === 'teamEmbla') return

        // Obtenemos su wrapper padre para buscar sus propios botones
        const wrapper = emblaNode.closest('.embla-gallery') || emblaNode.closest('.embla-stories') || emblaNode.parentElement;
        
        const isStories = wrapper.classList.contains('embla-stories');
        const options = { 
            loop: true,
            align: isStories ? 'start' : 'center',
            containScroll: isStories ? 'trimSnaps' : false
        }
        
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
            
            // Initial call to set correct button states
            updateButtons();
        }
    });
}
