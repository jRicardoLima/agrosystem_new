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

mix.copyDirectory('resources/views/admin/assets/plugins','public/front/assets/plugins')
    .copyDirectory('resources/views/admin/assets/dist','public/front/assets/dist')
    .copyDirectory('resources/views/admin/assets/scripts','public/front/assets/scripts')
