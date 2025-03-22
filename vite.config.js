import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
     server: {
        port: 3000,
        open: true
    },
    build: {
        outDir: 'dist',  // Cambiar de 'public/build' a 'dist'
        assetsDir: 'assets',
        emptyOutDir: true
    }
});
