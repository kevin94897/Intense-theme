/**
 * ══════════════════════════════════════════════════════════
 *  MEGAMENU — Alpine.js component
 *  Enqueue this file in footer via wp_enqueue_script()
 *  Depends on: Alpine.js (already loaded in theme)
 * ══════════════════════════════════════════════════════════
 *
 *  PHP side: localize this script with:
 *
 *  wp_localize_script('megamenu-js', 'megaMenuConfig', [
 *      'ajaxUrl' => admin_url('admin-ajax.php'),
 *  ]);
 */

document.addEventListener("alpine:init", () => {
  Alpine.data("megaMenu", () => ({
    // ── Desktop mega ──────────────────────────────────────────
    active: null,
    loaded: {},
    _closeTimer: null,

    // ── Mobile drawer ─────────────────────────────────────────
    mobileOpen: false,
    mobilePanel: null, // 'journeys' | 'destinations' | 'blog' | null

    // ── Desktop: open / close ─────────────────────────────────
    toggle(key) {
      if (this.active === key) {
        this.closeAll();
      } else {
        this.active = key;
        this.load(key, "desktop");
      }
    },

    closeAll() {
      this.active = null;
    },

    scheduleClose() {
      this._closeTimer = setTimeout(() => this.closeAll(), 200);
    },

    cancelClose() {
      clearTimeout(this._closeTimer);
    },

    // ── Mobile: open drawer & slide to sub-panel ──────────────
    openMobilePanel(key) {
      this.mobilePanel = key;
      this.load(key, "mobile");
    },

    mobileClose() {
      this.mobileOpen = false;
      this.mobilePanel = null;
    },

    // ── Fetch via AJAX (once per key + context) ───────────────
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

    // ── Helper ────────────────────────────────────────────────
    _set(id, html) {
      const el = document.getElementById(id);
      if (el && html) el.innerHTML = html;
    },

    // ── Body scroll lock ──────────────────────────────────────
    init() {
      this.$watch("mobileOpen", (val) => {
        document.body.classList.toggle("mobile-menu-open", val);
      });
    },
  }));
});
