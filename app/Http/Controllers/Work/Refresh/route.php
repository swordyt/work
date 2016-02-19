<?php
Route::group(['prefix'=>'work','namespace'=>'Work'],function(){
	Route::controller('refresh','Refresh\RefreshController');
});