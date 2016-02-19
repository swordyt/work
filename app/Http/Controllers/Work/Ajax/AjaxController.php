<?php namespace App\Http\Controllers\Work\Ajax;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Http\Request;
use Session;
use App\Set;
use App\Runner;

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
public function getLogs(Request $request){
	$type=$request->input('type');
	$id=$request->input('id');
	$content="";
	if($type == "debug"){
		$content=file_get_contents("/data1/www/autotest/logs/debug.log");
	}else if($type == "error"){
		$content=file_get_contents("/data1/www/autotest/logs/error.log");
	}else if($type == "info"){
		$content=file_get_contents("/data1/www/autotest/logs/info.log");
	}
	foreach(Runner::where("setid","=",$id)->where("state","=","static")->get() as $runner){
		$runner->state="wait";
		$runner->save();
	}

		return $content;
	}
public function getVerification(Request $request){
	$phone=$request->input("phone");
	if ( !isset($phone) || empty($phone)) {

		return view("work.sqlQuery.verification");
	}
	$this->validate($request,[
            'phone'=>'required|digits:11',
            ]);
	$server_name="10.59.72.32";
	$user_name="songyaoshun451";
	$password="songyaoshun451";
	$database="service_db";
	$sql="select sMessage from t_sms_log where sMobile=".$phone."  order by iAutoID desc limit 1";
	//链接数据库
	$conn=mysql_connect($server_name,$user_name,$password) or die;
	mysql_query("set names 'utf8'");
	mysql_select_db($database);
	//执行sql语句
	$result=mysql_query($sql,$conn);
	while($row=mysql_fetch_row($result)){
		return $row[0];
		}
	}
}
