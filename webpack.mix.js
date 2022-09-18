const mix = require('laravel-mix');
require('laravel-vue-i18n/mix');


mix.disableNotifications()
mix.sass('resources/sass/website/app.sass', 'public/website/css')
    .sass('resources/sass/website/custom.sass', 'public/website/css').options({
        autoprefixer: { remove: false },
        stats: { children: true },
    }).version();

mix.js('resources/js/website/echo-config.js', 'public/website/js')
mix.js('resources/js/website/default.js', 'public/website/js')
mix.js('resources/js/website/Pages/orders.js', 'public/website/js')
mix.js('resources/js/website/Pages/cart.js', 'public/website/js')
mix.js('resources/js/website/Pages/home.js', 'public/website/js')
mix.js('resources/js/website/Pages/restaurants.js', 'public/website/js')
mix.js('resources/js/website/Pages/restaurant.js', 'public/website/js')
    .vue()

