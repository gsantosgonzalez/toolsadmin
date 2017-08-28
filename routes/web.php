<?php

use App\Area;
use App\Responsible;
use App\Tool;
use App\Type;

use Illuminate\Support\Facades\DB;

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

//Dashboard
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::get('dashboard/tops', 'DashboardController@getTops')->name('getTops');

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

//Frecuencies
Route::get('/frecuencies', function() {
	return DB::table('frecuency')->get();
});