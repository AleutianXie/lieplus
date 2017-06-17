const { mix } = require('laravel-mix');

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

//mix.js('resources/assets/js/common.js', 'public/static/js')
//mix.js('resources/assets/js/cici.js', 'public/static/js').sourceMaps()
mix.js('resources/assets/js/cici.js', 'public/static/js')
.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/cici.scss', 'public/static/css')
   .sass('resources/assets/sass/app.scss', 'public/css');
