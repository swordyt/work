<?php namespace App\Http\Controllers\Work\AutoTest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Http\Request;
use App\InterRequest;
use App\Field;
use Excel;
use Redirect;
class AutoTestController extends Controller {
	public function getIndex(){
		return view('work.autotest.request');
	}
	public function postCreaterequest(Request $request){
		$str="name,domain,url,method,".$request->input('field');
		$req=new InterRequest();
		$req->name=$request->input('name');
		$req->dataaddress=date("Ymdhis");
		if(!$req->save()){
			return Redirect::back();
		}
		$fields=explode(',', $str);
		foreach ($fields as $value) {
			$field = new Field();
			$field->name=$value;
			$field->requestid=$req->id;
			$field->save();
		}
		$data=array();
		$arr=array();
		for($j=0;$j<count($fields);$j++){
			$arr[$j]='null';
		}
		$data[0]=$fields;
		$data[1]=$arr;
		$this->SaveData($req->id,$data);
		return $this->getRequest($req->id);
	}
	public function getModfield($id){
		$field = Field::find($id);
		$request= InterRequest::find($field->requestid);
		$data=$this->LoadDataByID($request->id);
		for($i=0;$i<sizeof($data);$i++){
			unset($data[$i][strtolower($field->name)]);
		}
		$arr=array();
		$number=0;
		$arr[$number++]=array_keys($data[0]);
		foreach ($data as $value) {
			$arr[$number++]=array_values($value);
		}
		$field->delete();
		if(!$field->trashed()){
			return $this->getRequest($request->id);
		}
		$this->SaveData($request->id,$arr);
		return $this->getRequest($request->id);
	}
	public function getCreatefield(Request $request){
		$req=InterRequest::find($request->input('id'));
		$field=new Field();
		$field->name=$request->input('name');
		$field->requestid=$req->id;
		if(!$field->save()){
			return Redirect::back();
		}
		$data=$this->LoadDataByID($request->input('id'));
		$req=array();
		$number=0;
		$arr=array_keys($data[0]);
		$arr[sizeof($arr)]=$request->input('name');
		$req[$number++]=$arr;
		for($i=0;$i<sizeof($data);$i++){
			$data[$i][sizeof($data[$i])]="null";
		}
		for($j=0;$j<sizeof($data);$j++){
			$req[$number++]=array_values($data[$j]);
		}
		$this->SaveData($request->input('id'),$req);
		return $field->id;
	}
	public function getRequest($id){
		$data = $this->LoadDataByID($id);
		if(sizeof(InterRequest::find($id))<1){
			return view("work.autotest.request.showrequest")->withData($data)->withId($id);
		}
		return view("work.autotest.request.showrequest")->withData($data)->withId($id)->withFields(InterRequest::find($id)->Fields);
	}
	public function getModrequestdata(Request $request){
		$data=$this->LoadDataByID($request->input('id'));
		$req=array();
		$number=0;
		if(sizeof($data)<1){
			return $this->getRequest($request->input('id'));
		}
		$req[$number++]=array_keys($data[0]);
		for ($i=0; $i < sizeof($data); $i++) { 
			if($i == $request->input('row')){
				continue;
			}
			$req[$number++]=array_values($data[$i]);
		}
		$this->SaveData($request->input('id'),$req);
		return $this->getRequest($request->input('id'));

	}
	public function postAdddata(Request $request){
		$id=$request->input('id');
		$fields=InterRequest::find($id)->Fields;
		$arr=array();
		$req=array();
		$number=0;
		for($i=0;$i<sizeof($fields);$i++){
			$arr[$i]=$request->input($fields[$i]->name);
		}
		$data=$this->LoadDataByID($id);
		if(sizeof($data)<1){
			$key=array();
			foreach ($fields as $num=>$field) {
				$key[$num]=$field->name;
			}
			$req[0]=$key;
			$req[1]=$arr;
		}else{
			$req[$number++]=array_keys($data[0]);
			for($i=0;$i<sizeof($data);$i++){
				$req[$number++]=array_values($data[$i]);
			}
			$req[$number]=$arr;
		}
		$this->SaveData($id,$req);
		return $this->getRequest($id);
		
	}
	private function getDataPath($id){
		$reqEntity = InterRequest::find($id);
		if(!sizeof($reqEntity)>0){
			return false;
		}
		$filePath = 'storage/excel/'.iconv('UTF-8', 'GBK', $reqEntity->dataaddress.'.xlsx');
		return $filePath;
	}
	private function LoadDataByID($id){
		$filePath = $this->getDataPath($id);
		if(!$filePath){
			return false;
		}
		$reader = Excel::load($filePath);
		$data = $reader->all();
		$data=$data->toArray();
		return $data;
	}
	private function SaveData($id,$data){
		$reqEntity = InterRequest::find($id);
		if(file_exists(storage_path('excel').'/'.$reqEntity->dataaddress.'.xlsx')){
			unlink(storage_path('excel').'/'.$reqEntity->dataaddress.'.xlsx');
		}
		Excel::create($reqEntity->dataaddress,function($excel) use($data,$reqEntity){
			$excel->sheet('data',function($sheet) use($data){
				$sheet->rows($data);
			});
		})->store('xlsx',storage_path('excel'));
	}
	public function getDate(){
		return `tail -f /data1/logs/nginx/access.log`;
	}
}
