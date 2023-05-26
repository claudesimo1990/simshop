import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs';

const host = 'development.claude';
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'assets/css/app.css',
                'assets/js/alpine.js',
                'assets/js/app.js',
            ],
            refresh: true,
            server: {
                host,
                hmr: { host: 'colissend.development.claude' },
                https: {
                    key: fs.readFileSync(`/var/docker/colissend/nginx/config/ssl/${host}.key`),
                    cert: fs.readFileSync(`/var/docker/colissend/nginx/config/ssl/${host}.crt`),
                },
            },
        }),
    ]
});
