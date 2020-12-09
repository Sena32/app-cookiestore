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

mix.styles([
    'resources/css/global.css',
], 'public/css/global.css').version();

mix.styles([
    'resources/css/welcome.css',
], 'public/css/welcome.css').version();

mix.styles([
    'resources/css/style.css',
], 'public/css/style.css').version();

mix.js([
    'resources/js/app.js'
], 'public/js/app.js').version();

mix.js([
    'resources/js/bootstrap.js'
], 'public/js/bootstrap.js').version();
