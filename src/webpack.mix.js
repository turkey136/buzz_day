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

// Youtube
mix.js('resources/js/buzzTube.js', 'public/js');
mix.postCss('resources/css/buzzTube.css', 'public/css', []);

// Niconico
mix.js('resources/js/buzzNico.js', 'public/js');
mix.postCss('resources/css/buzzNico.css', 'public/css', []);

// Video Top
mix.js('resources/js/buzzTop.js', 'public/js');
mix.postCss('resources/css/buzzTop.css', 'public/css', []);
