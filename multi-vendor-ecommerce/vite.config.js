import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/css/app_admin.css',
                'resources/css/home.css',
                'resources/js/app.js',
                'resources/js/homeslider.js', 
            ],
            refresh: true,
        }),
    ],

    // IMPORTANT FOR PRODUCTION BUILD
    build: {
        outDir: 'public/build',   // output folder
        manifest: true,           // required by Laravel
        emptyOutDir: true,        // clear old build
    },
});
