<?php namespace App\Http\Controllers\Work;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
class dateController extends Controller {

	public function index()
	{
		return view('query.sqlQuery');
	}

	public function store(Request $request){
		date_default_timezone_set("Asia/Shanghai");
		$startStr = $request->input('startdate');
		$endStr = $request->input('endtdate');
		if(!preg_match('/(\d){4}-(\d){2}-(\d){2}/', $startStr) && !preg_match('/(\d){4}-(\d){2}-(\d){2}/', $endStr)){
			return Redirect::back()->withErrors('您输入字符有误请重新输入!');

		}


		$startdate = strtotime($request->input('startdate').' 00:00:00');
		$enddate = strtotime($request->input('enddate').' 00:00:00');
		$str = '/data1/www/script/query3 aaz_db "SELECT a.iUserID,a.sRecommendMobile,b.sMobile,sRealname,from_unixtime(a.iRecommendTime) FROM aaz_db.t_user a inner JOIN user_db.t_user b on a.iUserID=b.iAutoID and  a.iRecommendTime>='.$startdate.' and a.iRecommendTime<'.$enddate.'  and LENGTH(a.sRecommendMobile)=10 order by a.iRecommendTime desc;"';
		$cmd = `$str`;
		$cmdArr = explode("+---------+------------------+-------------+-----------+---------------------------------+",$cmd);
		if(sizeof($cmdArr) < 3){
			return Redirect::back()->withErrors('数据为空！');
		}
		$cmdArr2 = preg_split("/\|([\n\r\t\v])+\|/", $cmdArr[2]);



		return Redirect::back()->withErrors($cmdArr2);
	}
}
