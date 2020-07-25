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

Route::get('/home', 'HomeController@home');

Route::get('/ris', 'HomeController@reizigersinformatie');
Route::get('/ris/board-setup', 'SplitflapController@board_setup')->name('ris/board-setup');
Route::get('/ris/board-info', 'SplitflapController@board_info')->name('ris/board-info');
Route::post('/ris/splitflap', 'SplitflapController@store');
Route::post('/ris/preview','SplitflapController@preview');

Route::get('/map', 'MapController@trainmap');

Route::view('/files', 'files');