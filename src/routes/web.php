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
    return view('buzzTop');
})->name('buzzTop');
Route::get('/buzz_tube', function () {
    return view('buzzTube');
})->name('buzzTop.buzzTube');
Route::get('/buzz_nico', function () {
    return view('buzzNico');
})->name('buzzTop.buzzNico');

Route::get('/investment_trust', function () {
    return view('investmentTrust');
})->name('investment_trust');

Route::get('/investment_trust_statistics', function () {
    return view('investmentTrustStatistics');
})->name('investment_trust.investment_trust_statistics');

Route::get('/investment_trust_statistics_graph', function () {
    return view('investmentTrustStatisticsGraph');
})->name('investment_trust.investment_trust_statistics_graph');

Route::get('/sitemap.xml', 'App\Http\Controllers\SitemapController@sitemap')->name('sitemap.sitemap');

Route::get('/', function () {
    return view('top');
})->name('top');
