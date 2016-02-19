<?php
Route::group(['prefix'=>'work','namespace'=>'Work'],function(){
	Route::controller('autotest','AutoTest\AutoTestController');
});
Route::group(['prefix'=>'work','namespace'=>'Work\AutoTest'],function(){
	Route::controller('set','SetController');
});