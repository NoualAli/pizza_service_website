const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.js('resources/js/website/app.js', 'public/js/website');
mix.sass('resources/sass/website/app.sass', 'public/css/website').options({
    autoprefixer: { remove: false },
    stats: { children: true },
}).version();
