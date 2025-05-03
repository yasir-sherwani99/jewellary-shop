import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // css files
                'resources/css/app.css',
                'resources/css/plugins/bootstrap.min.css',
                'resources/css/plugins/owl-carousel/owl.carousel.css',
                'resources/css/plugins/magnific-popup/magnific-popup.css',
                'resources/css/plugins/jquery.countdown.css',
                'resources/css/template/style.css',
                'resources/css/plugins/nouislider.css',
                'resources/css/template/custom.css',
                'resources/css/template/skins/skin-demo-25.css',
                'resources/css/template/demos/demo-25.css',

                // js files
                'resources/js/app.js',
                'resources/js/plugins/jquery.min.js',
                'resources/js/plugins/bootstrap.bundle.min.js',
                'resources/plugins/jquery.hoverIntent.min.js',
                'resources/plugins/jquery.waypoints.min.js',
                'resources/plugins/superfish.min.js',
                'resources/plugins/bootstrap-input-spinner.js',
                'resources/plugins/jquery.elevateZoom.min.js',
                'resources/plugins/owl.carousel.min.js',
                'resources/plugins/jquery.plugin.min.js',
                'resources/plugins/jquery.magnific-popup.min.js',
                'resources/template/main.js',
                'resources/template/cart.js',
                'resources/template/wishlist.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        assetsInclude: ['**/*.png', '**/*.jpg', '**/*.jpeg', '**/*.gif', '**/*.svg']
    }
});
