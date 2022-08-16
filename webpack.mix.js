const mix = require('laravel-mix');

mix.disableNotifications()
// mix.js('resources/js/website/app.js', 'public/js/website');
mix.sass('resources/sass/website/app.sass', 'public/css/website').options({
    autoprefixer: { remove: false },
    stats: { children: true },
}).version();

mix.js('resources/js/app.js', 'public/js')
mix.js('resources/js/home.js', 'public/js')
mix.js('resources/js/restaurants.js', 'public/js')
    .vue()

