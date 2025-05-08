import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // css files
                'resources/css/app.css',
                'resources/css/plugins/app/bootstrap.min.css',
                'resources/css/plugins/app/owl-carousel/owl.carousel.css',
                'resources/css/plugins/app/magnific-popup/magnific-popup.css',
                'resources/css/plugins/app/jquery.countdown.css',
                'resources/css/template/app/style.css',
                'resources/css/plugins/app/nouislider.css',
                'resources/css/template/app/custom.css',
                'resources/css/template/app/skins/skin-demo-25.css',
                'resources/css/template/app/demos/demo-25.css',

                // js files
                'resources/js/app.js',
                'resources/js/plugins/app/jquery.min.js',
                'resources/js/plugins/app/bootstrap.bundle.min.js',
                'resources/js/plugins/app/jquery.hoverIntent.min.js',
                'resources/js/plugins/app/jquery.waypoints.min.js',
                'resources/js/plugins/app/superfish.min.js',
                'resources/js/template/app/wNumb.js',
            //    'resources/js/plugins/bootstrap-input-spinner.js',
                'resources/js/plugins/app/jquery.elevateZoom.min.js',
                'resources/js/plugins/app/owl.carousel.min.js',
                'resources/js/plugins/app/jquery.plugin.min.js',
                'resources/js/plugins/app/jquery.magnific-popup.min.js',
                'resources/js/plugins/app/nouislider.min.js',
                'resources/js/template/app/main.js',
                'resources/js/template/app/cart.js',
                'resources/js/template/app/wishlist.js',
                'resources/js/template/app/form-validation.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        assetsInclude: ['**/*.png', '**/*.jpg', '**/*.jpeg', '**/*.gif', '**/*.svg']
    }
});
