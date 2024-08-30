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
                'resources/js/vuejs/widgets/product_create_update.js',
                'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
            ],
            refresh: true,
        }),
    ],
});
