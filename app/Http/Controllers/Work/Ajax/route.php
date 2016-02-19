<?php
Route::group(['prefix'=>'work','namespace'=>'Work'],function(){
	Route::controller('ajax','Ajax\AjaxController');
});