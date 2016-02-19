<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'WelcomeController@index');   //首页

Route::get('home', 'HomeController@index');
#Route::get('home', function(){					//home页
#	return view('default');
#});
Route::group(['prefix'=>'sword','namespace'=>'Sword'],function(){
	Route::get('home',function(){
		return view('sword.home');
	});
});
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::get('work',function(){
	return view("work.sqlQuery.verification");
});
require(__DIR__.'/Controllers/Work/AutoTest/route.php');
require(__DIR__.'/Controllers/Work/Ajax/route.php');
require(__DIR__.'/Controllers/Work/Book/route.php');
require(__DIR__.'/Controllers/Work/Refresh/route.php');