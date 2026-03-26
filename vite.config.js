import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'
import { resolve } from 'path'

function phpHMR() {
  return {
    name: 'php-hmr',
    handleHotUpdate({ file, server }) {
      if (file.endsWith('.php')) {
        server.ws.send({ type: 'full-reload' })
        return []
      }
    },
  }
}

export default defineConfig(({ command }) => ({
  // En desarrollo (serve), usamos base '/' para que las rutas asuman el host (que configuraremos con origin).
  // En producción (build), usamos './' para rutas relativas dentro de la carpeta dist.
  base: command === 'serve' ? '/' : './',
  plugins: [
    tailwindcss(), // integración nativa Tailwind v4
    phpHMR(),
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
