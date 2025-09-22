import { defineConfig } from 'vite';

export default defineConfig({
  root: '.',
  build: {
    outDir: 'dist',
    rollupOptions: {
      input: {
        admin: 'src/admin/main.js'
      },
      output: {
        entryFileNames: '[name].js'
      }
    }
  }
});
