import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import { watch } from "vite-plugin-watch";

export default defineConfig({
    plugins: [
        watch({
            pattern: "app/{Data,Enums}/**/*.php",
            command: "php artisan typescript:transform --quiet",
        }),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue()
    ],
});
