<?php

namespace App\Http\Controllers\Work\Book;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect,Auth;
use App\Book;
use Validator;
class BooksController extends Controller
{
   public function index(){
   	return view('work.books.index');
   }
   public function show($id){
   		$records = Book::all();
      return view('work.books.show')->withRecords($records);
   }

    public function update(Request $request,$id)
    {

        if($id == 1){ 	//提交
        	$this->requestValidator($request);
        	if(!Auth::check() || Auth::user()->id != 1 ){
        		return Redirect::back()->withInput()->withErrors('数据提交失败,用户未认证！');
        	}
        	$borrowRecord = new Book();
        	$borrowRecord->um_number = $request->input('um_number');
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
        	$this->validate($request,['um_number' =>'required|alpha_num|max:50',]);
        	$records = Book::where('um_number','=',$request->input('um_number'))->get();
        	if(sizeof($records) > 0){
        		return view('work.books.show')->withRecords($records);
        	}
        	return Redirect::back()->withInput()->withErrors('查询无数据！');
        }
        if($id == 3){	//查看
        	$records = Book::all();
        	return view('work.books.show')->withRecords($records);
        }
		return view('work.books.index')->withErrors($id);
    }

    public function destroy($id){
    	 if(!Auth::check() || Auth::user()->id != 1 ){
        	return Redirect::back()->withInput()->withErrors('数据提交失败,用户未认证！');
        	}
    	$validate = Validator::make(['id'=>$id],['id'=>'integer']);
    	if($validate->passes()){
    		$book = Book::find($id);
    		$book->delete();
    		if($book->trashed()){
    			return Redirect::back()->withInput();
    		}

    	}
    	
    	return Redirect::back()->withInput()->withErrors('记录删除失败！');

    }
    protected function requestValidator($request){
    	$validate = $this->validate($request,[
    		'bookname'=>'required|string|max:100',
    		'remark' =>'alpha_dash|max:1000',
    		'um_number' =>'required|alpha_num|max:50',
    		'borrowDate'=>'required|date',
    		]);
    }

}
