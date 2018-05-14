<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('welcome');
});
*/
Route::domain('opm.matija-vuk.com')->group(function () {

	Route::get('/', 'LUFactorization@LUHome')->name('home');
	Route::get('/baza', 'LUFactorization@DohvatiIzBaze')->name('zadaci');
	Route::post('LU_Factorizaction/result', 'LUFactorization@Izracunaj')->name('izracunaj');
});