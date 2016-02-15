<?php namespace App\Http\Controllers\Work\Ajax;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Http\Request;
use Session;
use App\Set;
class AjaxController extends Controller {
public function getIndex(){

	}
	
public function getSet($id){
	$set=Set::find($id);
	$setMsgTmp=array(
		'setid'=>$set->id,
		'setname'=>$set->name,
		'reqnum'=>'4',
		'execnum'=>'5',
		'checkid'=>'003',
		'checkexecnum'=>'5',
	);
		return Response::json($setMsgTmp);
	}
public function getLogs($name){
	$content="";
	if($name == "debug"){
		$content=file_get_contents("/data1/www/autotest/logs/debug.log");
	}else if($name == "error"){
		$content=file_get_contents("/data1/www/autotest/logs/error.log");
	}else if($name == "info"){
		$content=file_get_contents("/data1/www/autotest/logs/info.log");
	}
		
		return $content;
	}
}
