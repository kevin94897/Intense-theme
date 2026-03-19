// ─── Entry Point del Tema ────────────────────────────────────────────────────
import './css/app.css'

import Alpine from 'alpinejs'
import AOS from 'aos'
import 'aos/dist/aos.css'
import EmblaCarousel from 'embla-carousel'

window.AOS = AOS
window.EmblaCarousel = EmblaCarousel

import { initFormularios } from './modules/formularios.js'
import { initSliders } from './modules/slider.js'
import bookingForm from './modules/bookingForm.js'

// ── AOS — Inicializar una sola vez ───────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    AOS.init({
        duration: 600,
        easing: 'ease-out',
        once: true,   // animar solo la primera vez
        offset: 80,   // px antes del viewport
    })

    initFormularios()
    initSliders()

    // Header scroll effect
    const header = document.querySelector('.site-header')
    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 10) {
                header.classList.add('scrolled')
            } else {
                header.classList.remove('scrolled')
            }
        }, { passive: true })
    }

    // Menú móvil — toggle
    const menuToggle = document.querySelector('[data-menu-toggle]')
    const mobileMenu = document.querySelector('[data-mobile-menu]')
    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', () => {
            const isOpen = mobileMenu.classList.toggle('is-open')
            menuToggle.setAttribute('aria-expanded', String(isOpen))
        })
    }
})

// ── Alpine.js ─────────────────────────────────────────────────────────────────
window.Alpine = Alpine
Alpine.data('bookingForm', bookingForm)
Alpine.start()
