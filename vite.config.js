import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        sourcemap: false,
        rollupOptions: {
            output: {
                assetFileNames: (assetInfo) => {
                    if (/\.(ttf|eot|woff|woff2)$/.test(assetInfo.name)) {
                        return 'fonts/[name][extname]';
                    }
                    return 'assets/[name][extname]';
                },
            },
            input: {
                app: 'resources/js/app.js',
            },
        },
    },
    resolve: {
        alias: {
            jquery: 'jquery',
        },
    },
});
