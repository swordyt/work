<?php namespace App\Http\Controllers\Work\AutoTest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Http\Request;
use App\InterRequest;
class AutoTestController extends Controller {
	public function getShowrequest($id){
		
	}
	public function getInter(){
		dd(InterRequest::all());
	}
}
