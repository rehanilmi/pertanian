import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss({
            // ⛔ Abaikan semua vendor (wajib!)
            scan: {
                include: ['resources/**/*.{php,js,vue,blade.php}'],
                exclude: ['vendor/**'], // <--- Ini penyelamat!
            },
        }),
    ],
});
