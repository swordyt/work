<?php namespace App\Http\Controllers\Work\Ajax;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Http\Request;

class AjaxController extends Controller {
protected $setMsgTmp=array(
	'setid'=>'001',
		'setname'=>'test',
		'reqnum'=>'4',
		'execnum'=>'5',
		'checkid'=>'003',
		'checkexecnum'=>'5',
	);
public function getIndex(){

	}
	
public function getSet($id){
	return Response::json($this->setMsgTmp);
	}
public function getModiyfield($id){

	}
public function getAddfield($name){

	}
public function postAdddata(Request $request){

	}
}
