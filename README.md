# Intense Nerd Theme

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
