<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/buzz_top', function () {
    return view('video/buzzTop');
})->name('buzzTop');
Route::get('/buzz_tube', function () {
    return view('video/buzzTube');
})->name('buzzTop.buzzTube');
Route::get('/buzz_nico', function () {
    return view('video/buzzNico');
})->name('buzzTop.buzzNico');

Route::get('/investment_trust', function () {
    return view('investmentTrust/investmentTrustTop');
})->name('investment_trust');

Route::get('/investment_trust_statistics', function () {
    return view('investmentTrust/investmentTrustStatistics');
})->name('investment_trust.investment_trust_statistics');

Route::get('/investment_trust_statistics_graph', function () {
    return view('investmentTrust/investmentTrustStatisticsGraph');
})->name('investment_trust.investment_trust_statistics_graph');

Route::get('/novel', function () {
    return view('novel/novelTop');
})->name('novel.top');

Route::get('/novel/yomou', function () {
    return view('novel/novelYomou');
})->name('novel.yomou');

Route::get('/porn', function () {
    return view('porn/top');
})->name('porn.top');

Route::get('/etf', function () {
    return view('etf/etfTop');
})->name('etf.top');

Route::get('/gold', function () {
    return view('gold/goldTop');
})->name('gold.top');

Route::get('/sitemap.xml', 'App\Http\Controllers\SitemapController@sitemap')->name('sitemap.sitemap');

Route::get('/', function () {
    return view('top');
})->name('top');
