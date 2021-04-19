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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/add_band', 'BandController@create');
Route::post('/store_band', 'BandController@store')->name('store_band');
Route::post('/events/search', 'EventController@search')->name('search');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('events', EventController::class);
