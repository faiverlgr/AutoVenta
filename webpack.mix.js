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
 mix.js('resources/assets/js/app.js', 'public/js')
 .sass('resources/assets/sass/app.scss', 'public/css');
 */

 mix.scripts([
     'resources/assets/js/jquery-3.3.1.js',
     'resources/assets/js/bootstrap.js',
     'resources/assets/js/adminlte.js'
    ], 'public/js/app.js')
 .sass('resources/assets/sass/app.scss', 'public/css');

