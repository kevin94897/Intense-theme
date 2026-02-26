---
name: wp-tailwind-acf
description: >
  Skill para construir temas WordPress con Vite, Tailwind CSS v4, Alpine.js, AOS (Animate On Scroll),
  Zod (validación de formularios) y campos ACF (Advanced Custom Fields).
  Aplica un design system específico con tipografías HV Simplicite + Rubik, paleta de colores definida,
  componentes de botones, inputs, dropdowns y cards con estados hover/focus/error/success.

  Usar esta skill SIEMPRE que el usuario mencione: WordPress + Tailwind, tema WordPress con ACF,
  componentes PHP con clases Tailwind, plantillas de página WordPress, campos ACF en templates,
  Alpine.js en WordPress, Vite en WordPress, AOS animaciones scroll, validación Zod en formularios,
  vite.config.js para WordPress, o pida crear/modificar cualquier componente UI para un tema WordPress.
  También aplica cuando el usuario muestre archivos .php de temas WordPress o pida ayuda con
  template parts, page templates, loops de WP_Query, get_field() de ACF, o configuración del build.
---

# WordPress + Vite + Tailwind v4 + Alpine.js + AOS + Zod + ACF

## Stack Tecnológico

| Capa        | Tecnología                      | Rol                                             |
|-------------|----------------------------------|-------------------------------------------------|
| CMS         | WordPress (PHP 8+)               | Backend, contenido, routing                     |
| Bundler     | **Vite 5.x**                     | Dev server con HMR + build optimizado para prod |
| CSS         | **Tailwind CSS v4**              | Utility-first CSS, integración nativa con Vite  |
| JS          | **Alpine.js 3.x**                | Interactividad reactiva declarativa en HTML     |
| Animaciones | **AOS (Animate On Scroll)**      | Animaciones de entrada al hacer scroll          |
| Validación  | **Zod**                          | Validación de esquemas en formularios           |
| Campos      | ACF Pro                          | Custom Fields en WordPress                      |
| Tipografías | HV Simplicite + Rubik            | @font-face local o Google Fonts                 |
| Íconos      | Heroicons SVG inline             | SVG embebidos en PHP/HTML                       |

---

## Configuración del Build

### Estructura de archivos del tema

```
mi-tema/
├── style.css                    (header WordPress — solo metadatos)
├── functions.php                (enqueue del bundle Vite)
├── index.php / page.php / single.php / archive.php
├── header.php / footer.php
├── vite.config.js
├── package.json
├── src/
│   ├── main.js                  (entry point — importa Alpine, AOS, Zod, módulos)
│   ├── css/
│   │   └── app.css              (@import "tailwindcss" + @theme tokens)
│   ├── fonts/                   (HV Simplicite .woff2)
│   └── modules/
│       └── formularios.js       (esquemas Zod + funciones Alpine)
├── dist/                        (generado por Vite — no commitear)
├── template-parts/
│   ├── components/
│   └── sections/
└── page-templates/
```

### vite.config.js

```js
import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'
import { resolve } from 'path'

export default defineConfig({
  plugins: [
    tailwindcss(), // integración nativa Tailwind v4
  ],
  build: {
    outDir: 'dist',
    rollupOptions: {
      input: { main: resolve(__dirname, 'src/main.js') },
      output: {
        entryFileNames: '[name].js',
        assetFileNames: '[name][extname]', // app.css predecible para enqueue
      },
    },
    manifest: true, // genera dist/.vite/manifest.json
  },
  server: {
    port: 5173,
    strictPort: true,
    cors: true,
  },
})
```

### package.json

```json
{
  "name": "mi-tema",
  "private": true,
  "scripts": {
    "dev":   "vite",
    "build": "vite build"
  },
  "dependencies": {
    "alpinejs": "^3.14.0",
    "aos":      "^2.3.4",
    "zod":      "^3.23.0"
  },
  "devDependencies": {
    "@tailwindcss/vite": "^4.0.0",
    "tailwindcss":       "^4.0.0",
    "vite":              "^5.0.0"
  }
}
```

### src/css/app.css (Tailwind v4)

```css
/* Tailwind v4: una directiva reemplaza las tres de v3 */
@import "tailwindcss";

/* Tokens del design system — generan clases automáticamente */
@theme {
  --color-primary:        #B76739;   /* botón principal, links activos */
  --color-hover:          #776C60;   /* hover preferido */
  --color-dark:           #423931;   /* fondo oscuro, dropdown seleccionado */
  --color-cream:          #FFFCF7;   /* fondo principal claro */
  --color-gold:           #DC973C;   /* acento dorado */
  --color-sage:           #5D7F6E;   /* acento verde, estado success */
  --color-neutral-black:  #161616;   /* texto principal */
  --color-neutral-gray:   #C7C7C7;   /* bordes, placeholders */

  --font-heading: "HV Simplicite", serif;
  --font-body:    "Rubik", sans-serif;
}

/* Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;1,400&display=swap');

/* HV Simplicite — fuente local */
@font-face {
  font-family: "HV Simplicite";
  src: url('../fonts/HVSimplicite-Regular.woff2') format('woff2');
  font-weight: 400;
  font-style: normal;
  font-display: swap;
}
@font-face {
  font-family: "HV Simplicite";
  src: url('../fonts/HVSimplicite-Bold.woff2') format('woff2');
  font-weight: 700;
  font-style: normal;
  font-display: swap;
}

body {
  font-family: var(--font-body);
  color: var(--color-neutral-black);
  background-color: var(--color-cream);
}
```

> **Tailwind v4**: NO existe `tailwind.config.js`. Los tokens van en `@theme {}`. Las clases `bg-primary`, `text-dark`, `font-heading`, etc. se generan automáticamente.

### src/main.js (entry point)

```js
import './css/app.css'

import Alpine from 'alpinejs'
import AOS    from 'aos'
import 'aos/dist/aos.css'

import { initFormularios } from './modules/formularios.js'

document.addEventListener('DOMContentLoaded', () => {
  // AOS — inicializar una sola vez
  AOS.init({
    duration: 600,
    easing:   'ease-out',
    once:     true,   // animar solo la primera vez
    offset:   80,     // px antes del viewport
  })

  initFormularios()
})

window.Alpine = Alpine
Alpine.start()
```

### functions.php — enqueue con HMR en dev / manifest en prod

```php
<?php
function mi_tema_scripts() {
  $dist    = get_template_directory_uri() . '/dist';
  $is_dev  = defined('WP_DEBUG') && WP_DEBUG;

  if ($is_dev) {
    // Modo desarrollo — Vite HMR
    echo '<script type="module" src="http://localhost:5173/@vite/client"></script>';
    echo '<script type="module" src="http://localhost:5173/src/main.js"></script>';
    return;
  }

  // Modo producción — leer manifest
  $manifest_path = get_template_directory() . '/dist/.vite/manifest.json';
  if (!file_exists($manifest_path)) return;

  $manifest = json_decode(file_get_contents($manifest_path), true);
  $entry    = $manifest['src/main.js'] ?? null;
  if (!$entry) return;

  wp_enqueue_style('tema-css',  $dist . '/' . ($entry['css'][0] ?? 'app.css'), [], null);
  wp_enqueue_script('tema-js',  $dist . '/' . $entry['file'], [], null, true);

  // Agregar type="module" al script
  add_filter('script_loader_tag', function($tag, $handle) {
    if ($handle === 'tema-js') {
      return str_replace('<script ', '<script type="module" ', $tag);
    }
    return $tag;
  }, 10, 2);
}
add_action('wp_enqueue_scripts', 'mi_tema_scripts');
```

---

## Design System

### 🎨 Colores

| Token CSS                 | Hex       | Clase generada             | Uso                         |
|---------------------------|-----------|----------------------------|-----------------------------|
| `--color-primary`         | `#B76739` | `bg-primary / text-primary`| Botones, links activos      |
| `--color-hover`           | `#776C60` | `bg-hover / text-hover`    | Hover preferido             |
| `--color-dark`            | `#423931` | `bg-dark / text-dark`      | Fondos oscuros, seleccionado|
| `--color-cream`           | `#FFFCF7` | `bg-cream`                 | Fondo principal             |
| `--color-gold`            | `#DC973C` | `bg-gold / text-gold`      | Acento dorado               |
| `--color-sage`            | `#5D7F6E` | `bg-sage / text-sage`      | Verde, estado success       |
| `--color-neutral-black`   | `#161616` | `text-neutral-black`       | Texto principal             |
| `--color-neutral-gray`    | `#C7C7C7` | `border-neutral-gray`      | Bordes, placeholders        |

### 🔤 Tipografía

| Token          | Fuente          | Size | Line-h | Peso    | Clases Tailwind                                  |
|----------------|-----------------|------|--------|---------|--------------------------------------------------|
| H1             | HV Simplicite   | 64px | 72px   | Regular | `font-heading text-[64px] leading-[72px]`        |
| H2             | HV Simplicite   | 64px | 72px   | Regular | `font-heading text-[64px] leading-[72px]`        |
| H3             | HV Simplicite   | 48px | 72px   | Regular | `font-heading text-5xl leading-[72px]`           |
| H3 Bold        | HV Simplicite   | 32px | 40px   | Bold    | `font-heading text-[32px] leading-10 font-bold`  |
| H3 Small       | HV Simplicite   | 20px | 32px   | Bold    | `font-heading text-xl leading-8 font-bold`       |
| Body XL        | Rubik           | 24px | 40px   | Regular | `font-body text-2xl leading-10`                  |
| Body Large     | Rubik           | 20px | 36px   | Light   | `font-body text-xl leading-9 font-light`         |
| Body Medium    | Rubik           | 18px | 32px   | Light   | `font-body text-lg leading-8 font-light`         |
| Body Medium R  | Rubik           | 18px | 32px   | Regular | `font-body text-lg leading-8`                    |
| Body Small     | Rubik           | 16px | 24px   | Regular | `font-body text-base leading-6`                  |
| Body Small It  | Rubik           | 14px | 20px   | Italic  | `font-body text-sm leading-5 italic`             |

---

### 🔘 Botones

```html
<!-- Primary -->
<button class="bg-primary hover:bg-hover text-white font-body text-sm font-medium
               px-6 py-3 rounded-full transition-colors duration-200 cursor-pointer">
  Explore itineraries
</button>

<!-- Secondary -->
<button class="bg-neutral-gray hover:bg-hover text-white font-body text-sm
               px-6 py-3 rounded-full transition-colors duration-200 cursor-pointer">
  Design my trip
</button>

<!-- Outline -->
<button class="border border-neutral-black hover:bg-neutral-black hover:text-white
               text-neutral-black font-body text-sm px-6 py-3 rounded-full
               transition-colors duration-200 cursor-pointer">
  Explore itineraries
</button>

<!-- WhatsApp circular -->
<a href="https://wa.me/NUMERO" target="_blank" rel="noopener"
   aria-label="Contactar por WhatsApp"
   class="inline-flex items-center justify-center w-14 h-14 rounded-full
          bg-primary hover:bg-hover transition-colors duration-200">
  <svg class="w-7 h-7 fill-white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
  </svg>
</a>
```

---

### 📝 Inputs — 5 estados (floating label)

```html
<!-- BASE — copiar y ajustar estado según contexto -->
<div class="relative w-full">
  <input type="text" id="campo" placeholder=" "
         class="peer w-full border-b border-neutral-gray bg-transparent
                pt-5 pb-1 font-body text-base text-neutral-black
                hover:border-neutral-black
                focus:outline-none focus:border-neutral-black
                transition-colors duration-200">
  <label for="campo"
         class="absolute left-0 top-4 font-body text-base text-neutral-gray
                pointer-events-none transition-all duration-200
                peer-focus:top-0 peer-focus:text-xs peer-focus:text-neutral-black
                peer-[:not(:placeholder-shown)]:top-0
                peer-[:not(:placeholder-shown)]:text-xs">
    First Name
  </label>
</div>

<!-- ERROR -->
<div class="relative w-full">
  <input class="peer w-full border-b border-red-500 bg-transparent
                pt-5 pb-1 font-body text-base text-red-500
                focus:outline-none" placeholder=" ">
  <label class="absolute left-0 top-0 text-xs font-body text-red-500 pointer-events-none">
    First Name
  </label>
  <span class="absolute right-0 top-4 text-red-500">✕</span>
  <p class="mt-1 font-body text-sm text-red-500">Please enter a valid email address.</p>
</div>

<!-- SUCCESS -->
<div class="relative w-full">
  <input class="peer w-full border-b border-sage bg-transparent
                pt-5 pb-1 font-body text-base text-sage
                focus:outline-none" placeholder=" ">
  <label class="absolute left-0 top-0 text-xs font-body text-sage pointer-events-none">
    First Name
  </label>
  <span class="absolute right-0 top-4 text-sage">✓</span>
</div>
```

---

### 📋 Dropdown Select (Alpine.js)

```html
<div class="relative w-full" x-data="{ open: false, selected: '' }">
  <label class="block font-body text-xs text-neutral-gray mb-1">First Name</label>

  <button type="button" @click="open = !open"
          class="w-full flex items-center justify-between border-b border-neutral-gray
                 pb-1 font-body text-base text-neutral-black bg-transparent
                 hover:border-neutral-black transition-colors duration-200">
    <span x-text="selected || 'Seleccionar'"></span>
    <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
         fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
    </svg>
  </button>

  <!-- Opciones — seleccionado: bg-dark (#423931) -->
  <div x-show="open"
       x-transition:enter="transition ease-out duration-150"
       x-transition:enter-start="opacity-0 -translate-y-1"
       x-transition:enter-end="opacity-100 translate-y-0"
       @click.outside="open = false"
       class="absolute z-20 w-full bg-white shadow-lg border border-neutral-gray mt-1">
    <template x-for="option in ['Opción 1', 'Opción 2', 'Opción 3']" :key="option">
      <div @click="selected = option; open = false"
           :class="selected === option ? 'bg-dark text-white' : 'text-neutral-black hover:bg-cream'"
           class="px-4 py-2 font-body text-base cursor-pointer transition-colors duration-150">
        <span x-text="option"></span>
      </div>
    </template>
  </div>
</div>
```

---

## AOS — Animaciones al hacer scroll

AOS se inicializa en `main.js`. En los templates PHP solo se usan atributos `data-aos`.

### Atributos disponibles

```html
<!-- Fade básico (más usado) -->
<section data-aos="fade-up">...</section>

<!-- Con delay — usar para grids (escalonar en múltiplos de 100ms) -->
<div data-aos="fade-up" data-aos-delay="0">Card 1</div>
<div data-aos="fade-up" data-aos-delay="100">Card 2</div>
<div data-aos="fade-up" data-aos-delay="200">Card 3</div>

<!-- Duración personalizada -->
<div data-aos="fade-right" data-aos-duration="800">Sidebar</div>
```

| `data-aos`  | Uso recomendado                    |
|-------------|------------------------------------|
| `fade-up`   | Secciones, cards, títulos          |
| `fade-right`| Imágenes o texto desde la izquierda|
| `fade-left` | Contraparte de fade-right          |
| `zoom-in`   | CTAs, badges, íconos destacados    |

### Patrón en loop PHP + AOS escalonado

```php
<?php if (have_rows('items')): $i = 0; ?>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <?php while (have_rows('items')): the_row();
      $delay = $i * 100;
    ?>
      <div class="bg-white border border-neutral-gray rounded-lg p-6
                  hover:border-primary transition-colors duration-200"
           data-aos="fade-up"
           data-aos-delay="<?= $delay ?>">
        <h3 class="font-heading text-[32px] leading-10 font-bold text-neutral-black mb-2">
          <?= esc_html(get_sub_field('titulo')); ?>
        </h3>
        <p class="font-body text-lg leading-8 font-light text-neutral-gray">
          <?= wp_kses_post(get_sub_field('descripcion')); ?>
        </p>
      </div>
    <?php $i++; endwhile; ?>
  </div>
<?php endif; ?>
```

---

## Zod — Validación de formularios

### src/modules/formularios.js

```js
import { z } from 'zod'

// ── Esquemas ────────────────────────────────────────────
export const schemaContacto = z.object({
  nombre: z.string()
    .min(2, 'El nombre debe tener al menos 2 caracteres')
    .regex(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/, 'Solo letras y espacios'),

  email: z.string()
    .email('Ingresa un correo electrónico válido'),

  telefono: z.string()
    .regex(/^\d{9}$/, 'El teléfono debe tener 9 dígitos')
    .optional().or(z.literal('')),

  mensaje: z.string()
    .min(10, 'Mínimo 10 caracteres')
    .max(1000, 'Máximo 1000 caracteres'),

  terminos: z.boolean()
    .refine(v => v === true, 'Debes aceptar los términos y condiciones'),
})

// ── Función Alpine (expuesta en window para uso en PHP) ─
export function initFormularios() {
  window.formularioContacto = function () {
    return {
      nombre: '', email: '', telefono: '', mensaje: '', terminos: false,
      errores: {},
      estado: 'idle', // idle | enviando | enviado | error

      // Validar campo a campo en @blur
      validarCampo(campo) {
        const result = schemaContacto.pick({ [campo]: true })
          .safeParse({ [campo]: this[campo] })
        if (!result.success) {
          this.errores[campo] = result.error.flatten().fieldErrors[campo]?.[0] ?? ''
        } else {
          delete this.errores[campo]
        }
      },

      // Validar todo al submit
      validarTodo() {
        const result = schemaContacto.safeParse({
          nombre: this.nombre, email: this.email,
          telefono: this.telefono, mensaje: this.mensaje,
          terminos: this.terminos,
        })
        if (!result.success) {
          const err = result.error.flatten().fieldErrors
          this.errores = Object.fromEntries(
            Object.entries(err).map(([k, v]) => [k, v[0] ?? ''])
          )
          return false
        }
        this.errores = {}
        return true
      },

      async enviar() {
        if (!this.validarTodo()) return
        this.estado = 'enviando'
        try {
          const res = await fetch('/wp-json/mi-tema/v1/contacto', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
              nombre: this.nombre, email: this.email,
              telefono: this.telefono, mensaje: this.mensaje,
            }),
          })
          this.estado = res.ok ? 'enviado' : 'error'
        } catch {
          this.estado = 'error'
        }
      },
    }
  }
}
```

### Template PHP del formulario (Alpine + Zod)

```php
<form x-data="formularioContacto()"
      @submit.prevent="enviar()"
      novalidate
      class="space-y-6 max-w-lg"
      data-aos="fade-up">

  <!-- Nombre -->
  <div class="relative">
    <input type="text" id="nombre" x-model="nombre" placeholder=" "
           @blur="validarCampo('nombre')"
           :class="errores.nombre
             ? 'border-red-500 text-red-500'
             : 'border-neutral-gray focus:border-neutral-black'"
           class="peer w-full border-b bg-transparent pt-5 pb-1
                  font-body text-base focus:outline-none transition-colors duration-200">
    <label for="nombre"
           :class="errores.nombre ? 'text-red-500' : 'text-neutral-gray peer-focus:text-neutral-black'"
           class="absolute left-0 top-4 font-body text-base pointer-events-none
                  transition-all duration-200
                  peer-focus:top-0 peer-focus:text-xs
                  peer-[:not(:placeholder-shown)]:top-0
                  peer-[:not(:placeholder-shown)]:text-xs">
      Nombre completo
    </label>
    <template x-if="errores.nombre">
      <p class="text-red-500 font-body text-sm mt-1" x-text="errores.nombre"></p>
    </template>
  </div>

  <!-- Email -->
  <div class="relative">
    <input type="email" id="email" x-model="email" placeholder=" "
           @blur="validarCampo('email')"
           :class="errores.email
             ? 'border-red-500 text-red-500'
             : 'border-neutral-gray focus:border-neutral-black'"
           class="peer w-full border-b bg-transparent pt-5 pb-1
                  font-body text-base focus:outline-none transition-colors duration-200">
    <label for="email"
           :class="errores.email ? 'text-red-500' : 'text-neutral-gray peer-focus:text-neutral-black'"
           class="absolute left-0 top-4 font-body text-base pointer-events-none
                  transition-all duration-200
                  peer-focus:top-0 peer-focus:text-xs
                  peer-[:not(:placeholder-shown)]:top-0
                  peer-[:not(:placeholder-shown)]:text-xs">
      Correo electrónico
    </label>
    <template x-if="errores.email">
      <p class="text-red-500 font-body text-sm mt-1" x-text="errores.email"></p>
    </template>
  </div>

  <!-- Mensaje -->
  <div class="relative">
    <textarea id="mensaje" x-model="mensaje" placeholder=" " rows="4"
              @blur="validarCampo('mensaje')"
              :class="errores.mensaje ? 'border-red-500' : 'border-neutral-gray focus:border-neutral-black'"
              class="peer w-full border-b bg-transparent pt-5 pb-1 resize-none
                     font-body text-base focus:outline-none transition-colors duration-200"></textarea>
    <label for="mensaje"
           class="absolute left-0 top-4 font-body text-base text-neutral-gray pointer-events-none
                  transition-all duration-200
                  peer-focus:top-0 peer-focus:text-xs
                  peer-[:not(:placeholder-shown)]:top-0
                  peer-[:not(:placeholder-shown)]:text-xs">
      Mensaje
    </label>
    <template x-if="errores.mensaje">
      <p class="text-red-500 font-body text-sm mt-1" x-text="errores.mensaje"></p>
    </template>
  </div>

  <!-- Términos -->
  <div>
    <label class="flex items-start gap-3 cursor-pointer">
      <input type="checkbox" x-model="terminos" class="mt-1 accent-primary">
      <span class="font-body text-sm text-neutral-black">
        Acepto los
        <a href="/terminos-y-condiciones/" target="_blank"
           class="text-primary hover:text-hover underline transition-colors">
          Términos y Condiciones
        </a>
      </span>
    </label>
    <template x-if="errores.terminos">
      <p class="text-red-500 font-body text-sm mt-1" x-text="errores.terminos"></p>
    </template>
  </div>

  <!-- Botón -->
  <button type="submit"
          :disabled="estado === 'enviando'"
          class="bg-primary hover:bg-hover disabled:opacity-60 disabled:cursor-not-allowed
                 text-white font-body text-sm px-8 py-3 rounded-full
                 transition-colors duration-200 cursor-pointer">
    <span x-text="estado === 'enviando' ? 'Enviando...' : 'Enviar'"></span>
  </button>

  <!-- Feedback -->
  <template x-if="estado === 'enviado'">
    <p class="text-sage font-body text-base" role="status" aria-live="polite">
      ✓ Mensaje enviado correctamente
    </p>
  </template>
  <template x-if="estado === 'error'">
    <p class="text-red-500 font-body text-base" role="alert" aria-live="assertive">
      ✕ Ocurrió un error. Intenta nuevamente.
    </p>
  </template>
</form>
```

---

## Patrones PHP + ACF

### Template básico

```php
<?php
$titulo    = get_field('titulo');
$subtitulo = get_field('subtitulo');
$imagen    = get_field('imagen'); // array: ['url'], ['alt'], ['width'], ['height']
?>
<section class="bg-cream py-16 px-6" data-aos="fade-up">
  <div class="max-w-7xl mx-auto">
    <?php if ($titulo): ?>
      <h1 class="font-heading text-[64px] leading-[72px] text-neutral-black">
        <?= esc_html($titulo); ?>
      </h1>
    <?php endif; ?>
    <?php if ($subtitulo): ?>
      <p class="font-body text-xl leading-9 font-light text-neutral-gray mt-4">
        <?= wp_kses_post($subtitulo); ?>
      </p>
    <?php endif; ?>
    <?php if (!empty($imagen['url'])): ?>
      <img src="<?= esc_url($imagen['url']); ?>"
           alt="<?= esc_attr($imagen['alt'] ?? ''); ?>"
           width="<?= esc_attr($imagen['width'] ?? ''); ?>"
           height="<?= esc_attr($imagen['height'] ?? ''); ?>"
           class="w-full object-cover rounded-lg mt-8" loading="lazy">
    <?php endif; ?>
  </div>
</section>
```

### WP_Query con filtrado Alpine + AOS

```php
<?php
$query = new WP_Query([
  'post_type'      => 'mi_cpt',
  'posts_per_page' => 12,
  'post_status'    => 'publish',
]);
?>
<div x-data="{ filtro: 'todo' }">
  <div class="flex gap-3 mb-8 flex-wrap" data-aos="fade-up">
    <button @click="filtro = 'todo'"
            :class="filtro === 'todo'
              ? 'bg-primary text-white'
              : 'border border-primary text-primary hover:bg-primary hover:text-white'"
            class="px-5 py-2 rounded-full font-body text-sm transition-colors duration-200">
      Todo
    </button>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php if ($query->have_posts()):
      $i = 0;
      while ($query->have_posts()): $query->the_post();
        $categoria = get_field('categoria', get_the_ID());
        $imagen    = get_the_post_thumbnail_url(get_the_ID(), 'full');
    ?>
      <div x-show="filtro === 'todo' || filtro === '<?= esc_js($categoria); ?>'"
           x-transition
           data-aos="fade-up"
           data-aos-delay="<?= ($i % 3) * 100 ?>"
           class="bg-white rounded-lg overflow-hidden border border-neutral-gray
                  hover:border-primary hover:shadow-md transition-all duration-200">
        <?php if ($imagen): ?>
          <img src="<?= esc_url($imagen); ?>"
               alt="<?= esc_attr(get_the_title()); ?>"
               class="w-full h-48 object-cover" loading="lazy">
        <?php endif; ?>
        <div class="p-5">
          <h4 class="font-heading text-[32px] leading-10 font-bold text-neutral-black">
            <?= esc_html(get_the_title()); ?>
          </h4>
        </div>
      </div>
    <?php $i++; endwhile; wp_reset_postdata(); endif; ?>
  </div>
</div>
```

---

## Reglas de Código

### PHP
- Siempre escapar: `esc_html()`, `esc_url()`, `esc_attr()`, `wp_kses_post()`
- `get_field()` con ID explícito en loops: `get_field('campo', get_the_ID())`
- `wp_reset_postdata()` siempre tras WP_Query custom
- Imágenes ACF retornan array `['url', 'alt', 'width', 'height']`
- Videos ACF pueden ser array `['url']` o string — verificar con `is_array()`

### Tailwind v4
- **NO** existe `tailwind.config.js` — tokens van en `@theme {}` del CSS
- **NO** usar `style=""` inline si existe clase equivalente
- Responsive mobile-first: `sm:` `md:` `lg:` `xl:` `2xl:`
- Siempre `transition-colors duration-200` en elementos con hover/focus

### Vite
- Entry point siempre: `src/main.js`
- CSS se importa desde JS: `import './css/app.css'`
- No commitear `/dist`
- Dev: HMR en `localhost:5173` | Prod: leer `dist/.vite/manifest.json`

### AOS
- Inicializar **una sola vez** en `main.js` con `AOS.init({ once: true })`
- Delay escalonado en grids: `$i * 100` ms
- No mezclar `data-aos` con Alpine `x-transition` en el mismo elemento

### Zod
- Esquemas en `src/modules/formularios.js`, no en el template
- Usar siempre `.safeParse()` — nunca `.parse()` (evita throw)
- Validar campo a campo en `@blur` + todo el form en submit
- Mensajes de error definidos en el esquema Zod, no en el template

### Alpine.js
- `x-data` en el contenedor más cercano con estado
- `:class` para condicionales — nunca `classList` manual
- `@click.outside` para cerrar dropdowns y modals
- `x-transition` para animaciones de Alpine (no mezclar con AOS)

### Accesibilidad
- Inputs con `<label for="">` asociado por id
- Botones icon-only con `aria-label`
- Imágenes decorativas: `alt=""` + `aria-hidden="true"`
- Feedback de formulario: `role="status"` (éxito) y `role="alert"` (error)

---

## Checklist antes de entregar cualquier componente

- [ ] ¿Usa la paleta del design system? (`bg-primary`, `text-dark`, etc.)
- [ ] ¿Tipografía correcta? (`font-heading` headings, `font-body` textos)
- [ ] ¿Datos ACF escapados en PHP? (`esc_html`, `esc_url`, `wp_kses_post`)
- [ ] ¿`wp_reset_postdata()` tras WP_Query?
- [ ] ¿Imágenes ACF verificadas como array `['url']`?
- [ ] ¿Secciones/cards con `data-aos` y delay escalonado?
- [ ] ¿Formularios con esquema Zod y `.safeParse()`?
- [ ] ¿CSS importado en `main.js`, no en `functions.php`?
- [ ] ¿`type="module"` en el script enqueued?
- [ ] ¿Responsive mobile-first?
- [ ] ¿`transition-colors duration-200` en todos los elementos interactivos?
- [ ] ¿Atributos de accesibilidad presentes?
