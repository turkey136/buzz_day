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
});
Route::get('/buzz_tube', function () {
    return view('buzzTube');
});
Route::get('/buzz_nico', function () {
    return view('buzzNico');
});

Route::get('/investment_trust', function () {
    return view('investmentTrust');
});

Route::get('/investment_trust_statistics', function () {
    return view('investmentTrustStatistics');
});

Route::get('/', function () {
    return view('top');
});
