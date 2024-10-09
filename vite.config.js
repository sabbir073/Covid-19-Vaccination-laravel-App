import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',  // Corrected path to the CSS file
                'resources/js/app.jsx',   // Ensure you're pointing to the correct JS/JSX file
            ],
            refresh: true,
        }),
        react(),
    ],
});
