let mix = require('laravel-mix');
require('dotenv').config(); 
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
   .js('resources/assets/js/admin.js', 'public/js')
   .js('resources/assets/js/adminlte.js', 'public/js')
   .js('resources/assets/js/judge.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/judge.scss', 'public/css')
   .sass('resources/assets/sass/admin.scss', 'public/css');
