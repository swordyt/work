<?php namespace App\Http\Controllers;
use DB;
class sqlController extends Controller {

	public function index($data)
	{

		return `/data1/www/script/query3 aaz_db "SELECT a.sRecommendMobile,b.sMobile,sRealname FROM aaz_db.t_user a inner JOIN user_db.t_user b
on a.iUserID=b.iAutoID and  a.iRecommendTime>=1447862400 and a.iRecommendTime<1447948800 and LENGTH(a.sRecommendMobile)=10;"`
	}

}