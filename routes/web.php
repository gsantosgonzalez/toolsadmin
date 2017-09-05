<?php

use App\Area;
use App\Employee;
use App\Tool;
use App\ToolType;
use App\ContractTool;

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
Route::get('/tooltypes', function() {
	return ToolType::all();
});

//Areas
Route::get('/areas', function() {
    return Area::all();
});

//Responsibles
Route::get('/employees', function() {
    return Employee::all();
});

//Frecuencies
Route::get('/frecuencies', function() {
	return DB::table('frecuencies')->get();
});

//Users
Route::get('users', function(){
	if (Auth::user() && Auth::user()->typeUsers_id == 1){
		$typeUsers = DB::table('type_users')->get();
        return view('users/index')->with(['typeUsers' => $typeUsers]);
	}
	else {
		return redirect('login');
	}
})->name('users');

//Contracts
Route::get('contracts/all', 'ContractsController@getAll')->name('contract/all');
Route::get('contracts/byTool', 'ContractsController@getByTool')->name('contract/byTool');
Route::get('contracts/byArea', 'ContractsController@getByArea')->name('contract/byArea');
