<?php

namespace App\Http\Controllers\Work\Refresh;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect,Validator;
class RefreshController extends Controller
{
	public function getIndex(){
	   return view('work.refresh.chinacache');
	}
	public function getChinacache($id){

 		$validator = Validator::make(['id'=>$id],['id'=>'integer|min:0']);
		if($id == 0){
			return view('work.refresh.showchinacache');
		}else
		{
			$url='https://r.chinacache.com/content/refresh/'.$id.'?username=pinganfang-test&password=qa123!%40%23';
			$states = json_decode(file_get_contents($url));
			return view('work.refresh.showchinacache')->withStates($states);
		}
	}
    public function postChinacache(Request $request)
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
		
		$contents = $this->doPost1($url,$data);

        return view('work.refresh.chinacache')->withContents($contents);
    }
	private function doPost1($url,$data){
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

    public function getCdn(){
    	return view('work.refresh.cdn');
    }
    public function postCdn(Request $request){
    	$access_tokenUrl = 'http://cdncs-api.fastweb.com.cn/oauth/access_token.json'; //获取token的接口地址
		$add_purgeUrl = 'http://cdncs-api.fastweb.com.cn/cont/add_purge.json';		//刷新CDN接口地址
		$appid = '0fe872947f6d2d11c342c92d441747';
		$appsecret = '786031b278';
		$grant_type = 'client_credentials';
		$files =$request->input('files');
		$dirs = $request->input('dirs');
		$purgeData = null;
		$urls = array();
		$dir = array();
		/*验证appid、appsecret、files字段不为空！*/
		if(trim($appid) == ""||trim($appsecret)== ""){
			return view('work.refresh.cdn')->withErrors('用户名或密码不能为空！');
		}
		if(trim($files) != ""){
			$files = explode(',',$files);
			for($i = 0;$i<count($files);$i++){
				$parm = array('item_id' => md5($files[$i]),'url_name'=>$files[$i]);
				$urls[$i] = $parm;
			}
		}
		if(trim($dirs) !=""){
			$dirs = explode(',', $dirs);
			for($i = 0;$i<count($dirs);$i++){
				if(substr($dirs[$i],-1,1) != '/'){
					return view('work.refresh.cdn')->withErrors('目录必须已/结束。');
				}
				$parm = array('item_id' => md5($dirs[$i]),'url_name'=>$dirs[$i]);
				$dir[$i] = $parm;
			}

		}
		/***************************************************************************/
		
		
		
		 $url = $access_tokenUrl;
		 $data = json_encode(array('grant_type'=>$grant_type,'appid'=>$appid,'appsecret'=>$appsecret));
		
		$contentToken = $this->doPost2($url,$data);
		
		/*如果获取token的返回状态不为1，获取token失败。*/
		if($contentToken->status !=1){
			return Redirect::back()->withErrors($contentToken->info);
		}
		
		$access_token = $contentToken->result->access_token;  //获取到访问资源的token

		
		$purgeData = json_encode(array('files'=>$urls,'access_token'=>$access_token,'dirs'=>$dir));
		$contents = $this->doPost2($add_purgeUrl,$purgeData);
        return view('work.refresh.cdn')->withStates($contents);
		
    }
    /*提交POST请求*/
	private function doPost2($url,$data){
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(  
            'Content-Type: application/json; charset=utf-8',  
            'Content-Length: ' . strlen($data))  
        ); 
		ob_start();
		curl_exec($ch);
		$contents = json_decode(ob_get_contents());
        ob_end_clean();  
		return $contents;
	}
}
