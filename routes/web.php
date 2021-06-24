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

//Auth::routes();
Auth::routes([
   'register' =>    true, // Enable registration Routes...
   'verify' =>      false, // Disable email Verification Routes...
]);

// home routes
Route::redirect('/', '/home', 301); // set landing page to '/home' by redirecting from '/' to '/home'
Route::get('/home', 'HomeController@home')->name('home');

// splitflap routes
Route::get('/ritten', 'SplitflapController@splitflaps')->name('splitflaps');
Route::get('/ritten/export', 'SplitflapController@export')->name('export-splitflaps');
Route::get('/ritten/bord-setup', 'SplitflapController@board_setup')->name('board-setup');
Route::get('/ritten/bijwerken/{id}', 'SplitflapController@show_edit')->name('splitflap_edit');
Route::post('/ritten/preview', 'SplitflapController@preview');
Route::post('/ritten/splitflap', 'SplitflapController@store');
Route::post('/ritten/verwijder/{id}', 'SplitflapController@delete');
Route::post('/ritten/bijwerken/{id}', 'SplitflapController@update');
Route::post('/ritten/bijwerken', 'SplitflapController@update_leds')->name('update_leds');

// vehicle routes
Route::get('/rollend', 'Vehicles\VehicleViewsController@vehicles')->name('vehicles');
Route::get('/rollend/export', 'Vehicles\VehicleController@export')->name('export-vehicles');
Route::get('/rollend/toevoegen', 'Vehicles\VehicleViewsController@add_vehicle_page')->name('add_vehicle_page');
Route::get('/rollend/bijwerken/{id}', 'Vehicles\VehicleViewsController@show_edit')->name('show_edit');
Route::get('/rollend/eigenschappen/{id}', 'Vehicles\VehicleViewsController@show_properties')->name('show_properties');
Route::post('/rollend/toevoegen', 'Vehicles\VehicleAddController@add_vehicle')->name('add_vehicle');
Route::post('/rollend/bijwerken/{id}', 'Vehicles\VehicleController@edit');
Route::post('/rollend/verwijder/{id}', 'Vehicles\VehicleController@delete');
Route::post('/rollend/comment/add/{id}', 'Vehicles\VehicleController@add_comment');
Route::post('/rollend/img/toevoegen/{id}', 'Vehicles\VehiclePropertyController@upload_img');
Route::post('/rollend/exam/toevoegen/{id}', 'Vehicles\VehiclePropertyController@upload_exam');
Route::post('/rollend/doc/toevoegen/{id}', 'Vehicles\VehiclePropertyController@upload_doc');
Route::post('/rollend/prop/toevoegen/{id}', 'Vehicles\VehiclePropertyController@add_prop');

// miscellaneous routes
Route::post('/user/update_settings', 'UserController@settings')->name('usersettings');
Route::post('/markeer-als-gelezen', 'UserController@mark_read')->name('markNotification');
Route::get('/elliott', 'Elliott\ElliottController@index')->name('elliott');
Route::get('/planner', 'Planner\PlannerController@planner')->name('planner');
Route::get('/map', 'MapController@trainmap')->name('map');
Route::get('/leden', 'MemberController@members')->name('members');
Route::get('/leden/toevoegen', 'MemberController@members')->name('add_members');

// routes that point directly to their view
Route::view('/links', 'links')->name('links'); 
Route::view('/settings', 'users/user_settings')->name('user_settings');
Route::view('/profile', 'users/user_profile')->name('user_profile');