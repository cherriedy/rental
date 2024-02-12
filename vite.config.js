import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],

    optimizeDeps: {
        exclude: ['select2'],
    },

    // build: {
    //     commonjsOptions: {
    //         include: [/linked-dep/, /node_modules/],
    //     },
    // },

    // resolve: {
    //     alias: [{
    //         find: /^~.+/,
    //         replacement: (val) => {
    //             return val.replace(/^~/, "");
    //         },
    //     }, ],
    // },
});
