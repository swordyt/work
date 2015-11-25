<?php

namespace App\Http\Controllers\Work\Flush;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
class CloudController extends Controller
{
   public function index(){
   	return view('work.flush.viewcloud');
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $access_tokenUrl = 'http://cdncs-api.fastweb.com.cn/oauth/access_token.json'; //获取token的接口地址
		$add_purgeUrl = 'http://cdncs-api.fastweb.com.cn/cont/add_purge.json';		//刷新CDN接口地址
		$appid = $request->input('appid');
		$appsecret = $request->input('appsecret');
		$grant_type = 'client_credentials';
		$files =$request->input('files');
		$dirs = $request->input('dirs');
		$access_token = "";
		$purgeData = null;
		$urls = array();

		/*验证appid、appsecret、files字段不为空！*/
		if(trim($appid) == ""||trim($appsecret)== ""){
			return view('work.flush.viewcloud')->withErrors('用户名或密码不能为空！');
		}
		if(trim($files) == ""){
			return view('work.flush.viewcloud')->withErrors('刷新地址不能为空！');
		}
		/***************************************************************************/
		
		$files = explode(',',$files);

		 $url = $access_tokenUrl;
		 $data = json_encode(array('grant_type'=>$grant_type,'appid'=>$appid,'appsecret'=>$appsecret));
		
		$contentToken = $this->doPost($url,$data);
		
		/*如果获取token的返回状态不为1，获取token失败。*/
		if($contentToken->status !=1){
			return Redirect::back()->withErrors($contentToken->info);
		}
		
		$access_token = $contentToken->result->access_token;
		$parm = null;
		for($i = 0;$i<count($files);$i++){
			$parm = array('item_id' => md5($files[$i]),'url_name'=>$files[$i]);
			$urls[$i] = $parm;
		}
		$purgeData = json_encode(array('urls'=>$urls,'access_token'=>$access_token));
		$content = $this->doPost($add_purgeUrl,$purgeData);
        return view('work.flush.viewcloud')->withErrors(array('Info:'.$content->info,
		'Status:'.$content->status,
		'File_result',
		'sucess_count:'.$content->file_result->sucess_count,
		'error_count:'.$content->file_result->error_count,
		'error_info:'.$content->file_result->error_info,
		'Dir_result',
		'sucess_count:'.$content->file_result->sucess_count,
		'error_count:'.$content->file_result->error_count,
		'error_info:'.$content->file_result->error_info));
		
    }
	/*提交POST请求*/
	private function doPost($url,$data){
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
