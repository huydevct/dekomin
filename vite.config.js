import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
                'resources/js/vuejs/widgets/product_create_update.js',
            ],
            refresh: true,
        }),
    ],
});
