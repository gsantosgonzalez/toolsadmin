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
Route::get('tooltypes', function() {
	return ToolType::all();
});
Route::post('tooltypes', 'CatalogsController@addToolType');

//Areas
Route::get('areas', function() {
    return Area::all();
});
Route::post('areas', 'CatalogsController@addArea')->middleware('web');

//Responsibles
Route::get('employees', function() {
    return Employee::all();
});
Route::post('employees', 'CatalogsController@addEmployee');

//Frecuencies
Route::get('frecuencies', function() {
	return DB::table('cat_frecuencies')->get();
});
Route::post('frecuencies', 'CatalogsController@addFrecuency');

//Currencies
Route::get('currencies', function() {
	return DB::table('cat_currencies')->get();
});
Route::post('currencies', 'CatalogsController@addCurrency');

//Paymethods
Route::get('paymethods', function() {
	return DB::table('cat_paymethods')->get();
});
Route::post('paymethods', 'CatalogsController@addPaymethod');

//Computers
Route::get('computers', function() {
	return DB::table('cat_computers')->get();
});
Route::post('computers', 'CatalogsController@addComputer');

//Users
Route::get('users', function(){
	if (Auth::user() && Auth::user()->typeUser_id == 1){
		$typeUsers = DB::table('type_users')->get();
        return view('users/index')->with(['typeUsers' => $typeUsers]);
	}
	else {
		return redirect('login');
	}
})->name('users');
Route::post('getUsers', function() {
	$users = null;
    if (Auth::user() && Auth::user()->typeUser_id == 1){
		$users = App\User::all();
		$users->load('typeUser');
	}
	return $users;
});

