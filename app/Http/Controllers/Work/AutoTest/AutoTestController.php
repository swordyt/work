<?php namespace App\Http\Controllers\Work\AutoTest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Http\Request;
use App\InterRequest;
use Excel;
#use Plus\PHPExcel\Classes\PHPExcel\Writer;
class AutoTestController extends Controller {
	public function getRequest($id){
		$data = $this->LoadDataByID($id);
		return view("work.autotest.request.showrequest")->withData($data);

	}
	public function getModrequestdata(Request $request){
		$filePath = $this->getDataPath($request->id);
		$reader = Excel::load($filePath);
		$data = $reader->all();
		
		$req=array();
		$number=0;
		for ($i=1; $i < sizeof($data); $i++) { 
			if($i == $request->input('row')){
				continue;
			}
			$req[$number++]=array_values($data[$i]);
		}
		$this->SaveData($request->input('id'),$req);
		// return $this->getRequest($request->input('id'));

	}
	private function getDataPath($id){
		$reqEntity = InterRequest::find($id);
		$filePath = storage_path().'/excel/'.iconv('UTF-8', 'GBK', $reqEntity->dataaddress.'.xlsx');
		return $filePath;
	}
	private function LoadDataByID($id){
		$filePath = $this->getDataPath($id);
		$reader = Excel::load($filePath);
		$data = $reader->all();
		$data=$data->toArray();
		return $data;
	}
	private function SaveData($id,$data){
		$reqEntity = InterRequest::find($id);
		// $path='rm '.storage_path('excel').'/'.$reqEntity->name.'.xlsx';
		// 	`$path`;
		Excel::create('data',function($excel) use($data,$reqEntity){
			$excel->sheet('data',function($sheet) use($data){
				// dd($data);
				$sheet->fromArray($data);
			});
		})->store('xls',storage_path('excel'));
	}
	public function getShowrequest(){
		$path='rm '.storage_path('excel').'/login.xlsx';
		`$path`;
	}
}
