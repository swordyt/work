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

#Route::get('home', 'HomeController@index');
Route::get('home', function(){					//home页
	return view('default');
});
Route::group(['prefix'=>'sword','namespace'=>'Fword'],function(){
	Route::get('home',function(){
		return view('sword.home');
	});
});
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::group(['prefix'=>'flush','namespace'=>'Flush'],function(){
	Route::get('/',function(){
		return view('flush.viewcc');
	});
	Route::get('cloud',function(){
		return view('flush.viewcloud');
	});
	Route::resource('cc','ChinacacheController');
	Route::post('cloud','CloudController@store');
});
Route::get('test',function(){
	return view('default');
});
Route::get('sql',"sqlController@index");
Route::get('date',function(){
	return view('date');
});