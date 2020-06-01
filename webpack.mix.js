const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//     .js('resources/js/common.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');
mix.js(['resources/js/app.js', 'resources/js/common.js','resources/js/fixed_midashi.js', 'node_modules/flatpickr/dist/flatpickr.js'], 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .stylus('node_modules/flatpickr/src/style/flatpickr.styl', 'public/css');
