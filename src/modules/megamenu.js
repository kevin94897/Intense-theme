/**
 * ══════════════════════════════════════════════════════════
 *  MEGAMENU — Alpine.js
 *  Los panels del megamenu desktop viven en #megamenu-portal
 *  fuera del <header> para no interferir con el scroll.
 *  El estado compartido se gestiona via Alpine.$store('mega').
 * ══════════════════════════════════════════════════════════
 */

document.addEventListener("alpine:init", () => {
  // ── Store compartido (header ↔ portal) ────────────────────────
  Alpine.store("mega", {
    active: null,
    _closeTimer: null,

    toggle(key) {
      this.active = this.active === key ? null : key;
    },

    close() {
      this.active = null;
    },

    scheduleClose() {
      this._closeTimer = setTimeout(() => this.close(), 200);
    },

    cancelClose() {
      clearTimeout(this._closeTimer);
    },
  });

  // ── Componente del <header> ───────────────────────────────────
  Alpine.data("megaMenu", () => ({
    // Mobile
    mobileOpen: false,
    mobilePanel: null,
    loaded: {},

    // Getter para acceso al store desde el header
    get active() {
      return Alpine.store("mega").active;
    },

    // Desktop: delega al store
    toggle(key) {
      Alpine.store("mega").toggle(key);
      this.load(key, "desktop");
    },

    closeAll() {
      Alpine.store("mega").close();
    },
    scheduleClose() {
      Alpine.store("mega").scheduleClose();
    },
    cancelClose() {
      Alpine.store("mega").cancelClose();
    },

    // Mobile panel
    openMobilePanel(key) {
      this.mobilePanel = key;
      this.load(key, "mobile");
    },

    mobileClose() {
      this.mobileOpen = false;
      this.mobilePanel = null;
    },

    // AJAX
    async load(key, context = "desktop") {
      const cacheKey = key + "_" + context;
      if (this.loaded[cacheKey]) return;
      this.loaded[cacheKey] = true;

      const ajaxUrl =
        window.megaMenuConfig && window.megaMenuConfig.ajaxUrl
          ? window.megaMenuConfig.ajaxUrl
          : "/wp-admin/admin-ajax.php";

      const actions = {
        journeys: "mega_journeys",
        destinations: "mega_destinations",
        blog: "mega_blog",
      };

      const action = actions[key];
      if (!action) return;

      try {
        const fd = new FormData();
        fd.append("action", action);
        const res = await fetch(ajaxUrl, { method: "POST", body: fd });
        const json = await res.json();
        if (!json.success) return;

        const data = json.data;

        if (context === "desktop") {
          if (key === "journeys") {
            this._set("mega-grand-list", data.grand);
            this._set("mega-compact-list", data.compact);
            this._set("mega-short-list", data.short);
            this._set("mega-journey-cards", data.cards);
          }
          if (key === "destinations") {
            this._set("mega-destination-cards", data.cards);
          }
          if (key === "blog") {
            this._set("mega-blog-list", data.list);
            this._set("mega-blog-cards", data.cards);
          }
        }

        if (context === "mobile") {
          if (key === "journeys") {
            this._set("mob-grand-list", data.grand);
            this._set("mob-compact-list", data.compact);
            this._set("mob-short-list", data.short);
          }
          if (key === "destinations") {
            this._set("mob-destination-cards", data.mobile_cards || data.cards);
          }
          if (key === "blog") {
            this._set("mob-blog-list", data.mobile_list || data.list);
          }
        }
      } catch (e) {
        console.error("[MegaMenu] AJAX error:", e);
        this.loaded[cacheKey] = false;
      }
    },

    _set(id, html) {
      const el = document.getElementById(id);
      if (el && html) el.innerHTML = html;
    },

    init() {
      this.$watch("mobileOpen", (val) => {
        document.body.classList.toggle("mobile-menu-open", val);
      });
    },
  }));

  // ── Componente del portal (fuera del <header>) ────────────────
  Alpine.data("megaMenuPortal", () => ({
    get active() {
      return Alpine.store("mega").active;
    },
    cancelClose() {
      Alpine.store("mega").cancelClose();
    },
    scheduleClose() {
      Alpine.store("mega").scheduleClose();
    },
  }));
});

// ── Posicionar panels debajo del <header> dinámicamente ──────────
function positionMegaPanels() {
  const header = document.querySelector(".site-header");
  const panels = document.querySelectorAll(".mega-panel-portal");
  if (!header || !panels.length) return;
  const bottom = header.getBoundingClientRect().bottom;
  panels.forEach((p) => {
    p.style.top = bottom + "px";
  });
}

document.addEventListener("DOMContentLoaded", positionMegaPanels);
window.addEventListener("scroll", positionMegaPanels, { passive: true });
window.addEventListener("resize", positionMegaPanels, { passive: true });
