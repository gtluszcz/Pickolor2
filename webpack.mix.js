let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/menu.js', 'public/js')
   .js('resources/assets/js/palette.js', 'public/js')
    .js('resources/assets/js/allpalettes.js', 'public/js')
    .js('resources/assets/js/allcolors.js', 'public/js')
    .js('resources/assets/js/home.js', 'public/js')
    .js('resources/assets/js/color.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/menu.scss', 'public/css')
   .sass('resources/assets/sass/home.scss', 'public/css')
   .sass('resources/assets/sass/palette.scss', 'public/css')
   .sass('resources/assets/sass/login.scss', 'public/css')
.sass('resources/assets/sass/allpalettes.scss', 'public/css')
    .sass('resources/assets/sass/allcolors.scss', 'public/css')
.sass('resources/assets/sass/color.scss', 'public/css')
.sass('resources/assets/sass/dark.scss', 'public/css');



