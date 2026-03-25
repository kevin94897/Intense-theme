import EmblaCarousel from "embla-carousel";
import AutoScroll from "embla-carousel-auto-scroll";

export function initGallerySlider() {
  const emblaNodes = document.querySelectorAll(".journey-gallery-embla");
  if (emblaNodes.length === 0) return;

  emblaNodes.forEach((emblaNode) => {
    if (emblaNode.id === "teamEmbla") return;

    const wrapper =
      emblaNode.closest(".embla-gallery") ||
      emblaNode.closest(".embla-activities") ||
      emblaNode.parentElement;

    const viewportEl = emblaNode;
    const containerEl = viewportEl.querySelector(".embla__container");
    if (!containerEl) return;

    // ── Clonar slides si hay 3 o más ──
    const originalSlides = Array.from(containerEl.children);
    if (originalSlides.length >= 3) {
      originalSlides.forEach((slide) => {
        const clone = slide.cloneNode(true);
        clone.setAttribute("aria-hidden", "true");
        clone.dataset.cloned = "true";
        containerEl.appendChild(clone);
      });
    }

    // ── Opciones cinta ──
    const options = {
      loop: true,
      align: "start",
      containScroll: false,
      dragFree: true,
      duration: 20,
      watchDrag: true,
    };

    // ── Velocidad según tipo de wrapper ──
    const isGallery = wrapper?.classList.contains("embla-gallery");
    const isActivities = wrapper?.classList.contains("embla-activities");
    const speed = isGallery ? 1.2 : isActivities ? 0.9 : 1.0;

    const autoScrollPlugin = AutoScroll({
      speed,
      stopOnInteraction: false,
      stopOnMouseEnter: false, // lo manejamos manualmente abajo
      playOnInit: true,
    });

    const emblaApi = EmblaCarousel(viewportEl, options, [autoScrollPlugin]);

    // ── Helpers para pausar/reanudar ──
    const getAutoScroll = () => emblaApi.plugins()?.autoScroll;
    const pause = () => getAutoScroll()?.stop();
    const resume = () => getAutoScroll()?.play();

    // ── Hover (desktop) ──
    viewportEl.addEventListener("mouseenter", pause);
    viewportEl.addEventListener("mouseleave", resume);

    // ── Touch (mobile): pausa al tocar, reanuda al soltar ──
    viewportEl.addEventListener("touchstart", pause, { passive: true });
    viewportEl.addEventListener(
      "touchend",
      () => {
        // Pequeño delay para que termine la inercia del drag antes de reanudar
        setTimeout(resume, 1000);
      },
      { passive: true },
    );
    viewportEl.addEventListener("touchcancel", resume, { passive: true });

    // ── Botones prev / next (opcionales) ──
    const prevBtn = wrapper?.querySelector(".embla__prev");
    const nextBtn = wrapper?.querySelector(".embla__next");

    if (prevBtn && nextBtn) {
      prevBtn.addEventListener("click", () => {
        emblaApi.scrollPrev();
        getAutoScroll()?.reset();
      });
      nextBtn.addEventListener("click", () => {
        emblaApi.scrollNext();
        getAutoScroll()?.reset();
      });

      const enableButtons = () => {
        prevBtn.removeAttribute("disabled");
        nextBtn.removeAttribute("disabled");
      };
      emblaApi.on("init", enableButtons);
      emblaApi.on("select", enableButtons);
    }
  });
}
