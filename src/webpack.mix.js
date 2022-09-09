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

mix.js('resources/js/app.js', 'public/js');
mix.postCss('resources/css/app.css', 'public/css', []);

// Youtube
mix.js('resources/js/buzzTube.js', 'public/js').version();
mix.postCss('resources/css/buzzTube.css', 'public/css', []).version();
