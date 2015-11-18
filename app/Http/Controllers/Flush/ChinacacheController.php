<?php

namespace App\Http\Controllers\Flush;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ChinacacheController extends Controller
{
	public function index(){
	   return view('flush.viewCCQurey');
	}
	public function update(Request $request,$id){
		
	}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = "http://r.chinacache.com/content/refresh"; //接口地址
		$name= $request->input('name');
		$password= $request->input('password');
		if(empty($name)){
			$name = 'pinganfang-test';
			$password = 'qa123!@#';
		}
		$urls=explode(',',$request->input('urls'));
		$dirs = explode(',',$request->input('dirs'));
		$callback = array('url'=>$request->input('url'),'email'=>$request->input('email'),'acptNotice'=>$request->input('acptNotice'));
		$task = json_encode(array('urls'=>$urls,'dirs'=>$dirs,'callback'=>$callback));
		$data = json_encode(array('username'=>$name,'password'=>$password,'task'=>$task));
		
		$content = $this->doPost($url,$data);

        return view('flush.viewcc')->withErrors($content);
    }
	private function doPost($url,$data){
			    $ch = curl_init();  
        curl_setopt($ch, CURLOPT_POST, 1);  
        curl_setopt($ch, CURLOPT_URL, $url);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(  
            'Content-Type: application/json; charset=utf-8',  
            'Content-Length: ' . strlen($data))  
        );  
        ob_start();  
        curl_exec($ch);  
		$error = ob_get_contents();
        $content = json_decode(ob_get_contents());  
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
		 ob_end_clean(); 
	switch($code){
		case 200:
		return array('状态码：200','r_id：'.$content->r_id);
		break;
		case 201:
		$u_id = array();
		$i = 0;
		foreach($content->invalids as $key=>$invalides){
			$u_id[$i] = 'u_id：'.$invalides->u_id;
			$i++;
		}
		$u_id[count($content->invalids)] = '状态码：201';
		return $u_id;
		break;
		case 202:
		break ;
		default:
		return array('状态码：'.$code,$error);
		break;			
	}
	}

    
}
