# Intense Nerd Theme

<<<<<<< HEAD
Tema de WordPress personalizado construido con un moderno stack tecnológico para máxima velocidad y flexibilidad.

## 🚀 Tecnologías

Este tema utiliza:

*   **WordPress**: CMS base.
*   **Vite 5**: Herramienta de construcción ultrarrápida para assets.
*   **Tailwind CSS v4**: Framework de CSS utilitario con integración nativa en Vite.
*   **Alpine.js**: Framework ligero para comportamiento interactivo en el frontend.
*   **AOS (Animate On Scroll)**: Biblioteca para animaciones al hacer scroll.
*   **ACF (Advanced Custom Fields)**: Para gestión dinámica de contenido.
*   **Zod**: Validación de esquemas para datos.

## 🛠️ Requisitos previos

*   Node.js (v18.x o superior recomendado)
*   npm o yarn
*   Un entorno de desarrollo local de WordPress (Local, WP-Envy, Docker, etc.)

## 📥 Instalación y Configuración

1.  Clona el repositorio en tu carpeta de temas (`wp-content/themes/`):
    ```bash
    git clone https://github.com/kevin94897/Intense-theme.git
    ```
2.  Navega al directorio del tema:
    ```bash
    cd intense-nerd-theme
    ```
3.  Instala las dependencias:
    ```bash
    npm install
    ```

## 👩‍💻 Flujo de Desarrollo

El tema utiliza Vite para manejar los archivos en `src/` y compilarlos en `dist/`.

### Desarrollo local
Para iniciar el servidor de desarrollo de Vite con Hot Module Replacement (HMR):
```bash
npm run dev
```

### Producción
Para generar los archivos finales optimizados en la carpeta `dist/`:
```bash
npm run build
```

## 📁 Estructura del Proyecto

*   `src/`: Archivos fuente (JS, CSS, Fuentes).
*   `dist/`: Archivos compilados por Vite (no editar directamente).
*   `template-parts/`: Componentes y partes de plantillas reutilizables.
*   `functions.php`: Lógica core del tema y configuración de enqueues.
*   `style.css`: Metadatos del tema para WordPress.

## ✍️ Autor

*   **Intense Nerd** - [intensenerd.com](https://intensenerd.com)
=======
A custom WordPress theme built with React, Tailwind CSS, and Vite.

## 🚀 Features

- **React Integration**: Built-in support for React components within WordPress templates.
- **Tailwind CSS**: Utility-first CSS framework for rapid UI development.
- **Vite**: Extremely fast frontend tooling for instant server start and lightning-fast HMR.
- **ACF**: Ready for Advanced Custom Fields integration.

## 🛠️ Requirements

- Node.js (v18+ recommended)
- npm, yarn, or pnpm
- A local WordPress environment (e.g., Local by Flywheel)

## 📦 Installation & Setup

1. **Navigate to the theme root**: Make sure you are in `wp-content/themes/intense-nerd-theme/`.

2. **Install dependencies**:

   ```bash
   npm install
   ```

3. **Start the development server**:

   ```bash
   npm run dev
   ```

   _This will start Vite's dev server, providing Hot Module Replacement (HMR) for your React components and Tailwind CSS._

4. **Build for production**:
   ```bash
   npm run build
   ```
   _Run this command before deploying your theme. It generates optimized assets inside the `dist/` directory._

## 📂 Project Structure

- `src/`: Contains your React components (`src/sections`, `src/design-system`, etc.), and main stylesheets.
- `inc/`: PHP files for theme setup, Vite integration, and ACF fields (`inc/acf-fields.php`).
- `template-parts/`: Reusable HTML/PHP template blocks.
- `dist/`: Compiled production assets (generated automatically after running `npm run build`).

## ⚙️ How it works

The theme uses Vite to process React files (`.jsx`) and Tailwind CSS. The assets are enqueued in WordPress via `functions.php` (and the `inc` folder logic). During development, the PHP theme connects to Vite's dev server to provide HMR. Once you build for production, the compiled assets in `dist/` are loaded instead.
>>>>>>> 4edd3372701b156b86e1cc90e260aa1fdb864416
