<?php

use App\Area;
use App\Responsible;
use App\Tool;
use App\Type;

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

Route::get('/home', 'HomeController@index')->name('home');

// Tools
Route::get('tools', 'ToolsController@main')->name('tools');
Route::get('tools/create', 'ToolsController@create')->name('createTool');
Route::post('tools/update', 'ToolsController@update')->name('updateTool');
Route::post('tools', 'ToolsController@store');
Route::get('getTools', 'ToolsController@index')->name('getTools');

//Types
Route::get('/types', function() {
	return Type::all();
});

//Areas
Route::get('/areas', function() {
    return Area::all();
});

//Responsibles
Route::get('/responsibles', function() {
    return Responsible::all();
});