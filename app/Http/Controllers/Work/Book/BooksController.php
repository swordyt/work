<?php

namespace App\Http\Controllers\Work\Book;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use App\Book;
class BooksController extends Controller
{
   public function index(){
   	return view('work.books.index');
   }


    public function update(Request $request,$id)
    {

        if($id == 1){ 	//提交
        	$borrowRecord = new Book();
        	$borrowRecord->borrower = $request->input('username');
        	$borrowRecord->BorrowDate = $request->input('borrowDate');
        	$borrowRecord->BookName = $request->input('bookname');
        	$borrowRecord->remark = $request->input('remark');
        	$borrowRecord->manager_id = 1;
        	$borrowRecord->remember_token = $request->input('_token');
        	if(!$borrowRecord->save()){
        		return Redirect::back()->withInput()->withErrors('数据提交失败！');
        	};
        		return Redirect::back()->withInput()->withErrors('数据提交成功！');
        }
        if($id == 2){	//删除
        	return '删除成功';
        }
        if($id == 3){	//查看
        	return '查询成功';
        }
		return view('work.books.index')->withErrors($id);
    }
}
