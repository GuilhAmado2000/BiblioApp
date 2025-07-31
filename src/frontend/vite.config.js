import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import VueDevTools from 'vite-plugin-vue-devtools'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    VueDevTools(),
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    }
  },
  server: {
    host: '0.0.0.0', // Allows access from outside the container
    port: 8080,
    strictPort: true,
    watch: {
      usePolling: true, // Enable polling for hot reload
    },
    hmr: {
      protocol: 'ws',
      host: 'localhost',
      clientPort: 8083 // Ensure HMR works outside the container
    },
  },
})
