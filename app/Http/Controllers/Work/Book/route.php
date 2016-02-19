<?php
Route::group(['prefix'=>'work','namespace'=>'Work'],function(){
	Route::controller('book','Book\BooksController');
});