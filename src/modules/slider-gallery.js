import EmblaCarousel from "embla-carousel";
import AutoScroll from "embla-carousel-auto-scroll";

/**
 * Clona los slides hasta que el contenido llene al menos `minFillMultiplier`
 * veces el ancho del viewport. Esto garantiza que Embla tenga suficiente
 * contenido para hacer loop infinito sin saltos visibles.
 */
function ensureEnoughSlides(containerEl, viewportEl, minFillMultiplier = 3) {
  const slides = Array.from(containerEl.querySelectorAll(".embla__slide"));
  if (slides.length === 0) return;

  const viewportWidth = viewportEl.offsetWidth || window.innerWidth;
  const totalSlidesWidth = slides.reduce(
    (acc, slide) => acc + slide.offsetWidth,
    0,
  );

  // Si los slides originales llenan suficiente espacio, no clonar
  if (totalSlidesWidth >= viewportWidth * minFillMultiplier) return;

  // Clonar rondas completas hasta tener suficiente contenido
  let filledWidth = totalSlidesWidth;
  while (filledWidth < viewportWidth * minFillMultiplier) {
    slides.forEach((slide) => {
      const clone = slide.cloneNode(true);
      clone.setAttribute("aria-hidden", "true");
      containerEl.appendChild(clone);
    });
    filledWidth += totalSlidesWidth;
  }
}

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

    // ── Clonar slides para garantizar loop infinito sin saltos ──
    const isGallery = wrapper?.classList.contains("embla-gallery");
    if (isGallery) {
      ensureEnoughSlides(containerEl, viewportEl, 3);
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
    const isActivities = wrapper?.classList.contains("embla-activities");
    const speed = isGallery ? 1.5 : isActivities ? 0.9 : 1.0;

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

    // ── Touch (mobile): pausa al tocar, reanuda cuando Embla termina de moverse ──
    viewportEl.addEventListener("touchstart", pause, { passive: true });
    viewportEl.addEventListener(
      "touchend",
      () => {
        // Reanudar solo después de que Embla termine la inercia del drag
        emblaApi.once("settle", resume);
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
