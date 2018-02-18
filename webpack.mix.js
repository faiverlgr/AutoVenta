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
     'resources/assets/js/jquery-ui.js',
     'resources/assets/js/bootstrap.js',
     'resources/assets/js/adminlte.js',
     'resources/assets/js/vmisoft.js',
    ], 'public/js/app.js')
    .styles([
    'resources/assets/css/bootstrap.css',
    'resources/assets/css/font-awesome.css',
    'resources/assets/css/ionicons.css',
    'resources/assets/css/AdminLTE.css',
    'resources/assets/css/_all-skins.css',
    'resources/assets/css/jquery-ui.css',
    'resources/assets/css/vmisoft.css'
    ], 'public/css/app.css');