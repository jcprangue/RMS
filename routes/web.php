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
*/


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/phpinfo', function(){
	return phpinfo();
});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/debug', 'HomeController@debug');

Route::group(['middleware' => 'App\Http\Middleware\GeneralMiddleware'], function()
{

	Route::get('/incoming', 'DocumentsController@index');
	Route::get('/incoming/records', 'DocumentsController@records');
	Route::post('/incoming/save', 'DocumentsController@save');
	Route::post('/incoming/edit', 'DocumentsController@edit');
	Route::post('/incoming/delete', 'DocumentsController@delete');
	Route::post('/incoming/filter', 'DocumentsController@filter');
	Route::post('/incoming/verifydocument', 'DocumentsController@changestatus');
	Route::post('/incoming/successverify', 'DocumentsController@showinfoverify');
	Route::get('/incoming/printreports/{id}', 'DocumentsController@print');
	Route::get('/getemployees', 'DocumentsController@employee_list');

});

Route::group(['middleware' => 'App\Http\Middleware\OutgoingMiddleware'], function()
{
	Route::get('/outgoing', 'OutgoingController@index');
	Route::get('/outgoing/records', 'OutgoingController@records');
	Route::post('/outgoing/save', 'OutgoingController@save');
	Route::post('/outgoing/saveadd', 'OutgoingController@saveadd');
	Route::post('/outgoing/editdata', 'OutgoingController@editdata');
	Route::post('/outgoing/delete', 'OutgoingController@delete');
	Route::post('/outgoing/filter', 'OutgoingController@filter');
	Route::post('/outgoing/incomingdata', 'OutgoingController@incomingdata');
	Route::get('/outgoing/printreports/{id}', 'OutgoingController@print');
});



Route::get('/dashboard/numdocs', 'HomeController@getnumdoc');
Route::get('/dashboard/chartdata', 'HomeController@getdata');
Route::get('/dashboard/chartdataout', 'HomeController@getdataout');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::get('/settings', 'SettingsController@index');
Route::get('/accessdenied',function(){
	 return view('denied');
});
Route::post('/settings/deletecategory', 'SettingsController@deletecat');
Route::post('/settings/deletecontractor', 'SettingsController@deletecontractor');




