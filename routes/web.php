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

Auth::routes();
/*Auth::routes([
   'register' =>    false, // Disable registration Routes...
   'verify' =>      false, // Disable email Verification Routes...
]);*/

Route::redirect('/', '/home', 301); // set landing page to '/home' by redirecting from '/' to '/home'

Route::get('/home', 'HomeController@home')->name('home');

// if we don't need to send data to the view, we can skip the controller and use route::view
Route::view('/links', 'links')->name('links'); 
Route::view('/settings', 'users/user_settings')->name('user_settings');

Route::get('/ris', 'SplitflapController@reizigersinformatie')->name('ris');
Route::get('/ris/bord-setup', 'SplitflapController@board_setup')->name('board-setup');
Route::post('/ris/splitflap', 'SplitflapController@store');
Route::post('/ris/preview', 'SplitflapController@preview');

Route::get('/map', 'MapController@trainmap')->name('map');

Route::get('/leden', 'MemberController@members')->name('members');
Route::get('/leden/toevoegen', 'MemberController@members')->name('add_members');

Route::get('/rollend', 'RollingStockController@rolling')->name('rolling');
Route::get('/rollend/toevoegen', 'RollingStockController@add_stock_page')->name('add_stock');
Route::post('/rollend/toevoegen', 'RollingStockController@add_stock');
Route::post('/rollend/update/{id}/{state}', 'RollingStockController@update_state');
Route::post('/rollend/verwijder/{id}', 'RollingStockController@delete');
Route::post('/rollend/comment/add/{id}', 'RollingStockController@add_comment');

Route::post('/user/update_settings', 'UserController@settings')->name('usersettings');
