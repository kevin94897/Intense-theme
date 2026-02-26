import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'
import { resolve } from 'path'

export default defineConfig(({ command }) => ({
  // En desarrollo (serve), usamos base '/' para que las rutas asuman el host (que configuraremos con origin).
  // En producción (build), usamos './' para rutas relativas dentro de la carpeta dist.
  base: command === 'serve' ? '/' : './',
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
    origin: 'http://localhost:5173', // Resuelve rutas relativas a assets (fuentes/imagenes) en dev mode
  },
}))
