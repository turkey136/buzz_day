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

// common
mix.js('resources/js/app.js', 'public/js');
mix.postCss('resources/css/common/common_sidebar.css', 'public/css', []);
mix.postCss('resources/css/common/common.css', 'public/css', []);

// Top
mix.postCss('resources/css/top.css', 'public/css', []);


// Video Top
mix.js('resources/js/video/buzzTop.js', 'public/js');
mix.postCss('resources/css/video/buzzTop.css', 'public/css', []);

// Youtube
mix.js('resources/js/video/buzzTube.js', 'public/js');
mix.postCss('resources/css/video/buzzTube.css', 'public/css', []);

// Niconico
mix.js('resources/js/video/buzzNico.js', 'public/js');
mix.postCss('resources/css/video/buzzNico.css', 'public/css', []);

// 投資信託トップ
mix.js('resources/js/investmentTrust/investmentTrust.js', 'public/js');
mix.postCss('resources/css/investmentTrust/investmentTrust.css', 'public/css', []);

// 投信信託商品別
mix.js('resources/js/investmentTrust/investmentTrustStatistics.js', 'public/js');
mix.postCss('resources/css/investmentTrust/investmentTrustStatistics.css', 'public/css', []);

// 投資信託グラフ
mix.js('resources/js/investmentTrust/investmentTrustStatisticsGraph.js', 'public/js');
mix.postCss('resources/css/investmentTrust/investmentTrustStatisticsGraph.css', 'public/css', []);

// 小説
mix.postCss('resources/css/novel/novelTop.css', 'public/css', []);
mix.postCss('resources/css/novel/novelYomou.css', 'public/css', []);
mix.js('resources/js/novel/novelYomou.js', 'public/js');

// ポルノ
mix.postCss('resources/css/porn/pornTop.css', 'public/css', []);
mix.js('resources/js/porn/pornTop.js', 'public/js');


