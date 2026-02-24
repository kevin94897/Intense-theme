# Intense Nerd Theme

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
