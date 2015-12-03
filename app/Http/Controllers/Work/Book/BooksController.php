<?php

namespace App\Http\Controllers\Work\Book;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect,Auth,DB,Validator;
use App\Book;
use App\User;
use App\Borrower;
class BooksController extends Controller
{

    public function __construct(){
        $this->middleware('specialauth',['only' => ['postAddbook', 'postAddborrow','postSearch','getEditbook','getDeletebook','getDeleteborrower','postEditbook']]);
        $this->middleware('auth',['only' => ['getShowborrowers','getShowbooks']]);
    }


   public function getIndex(){
   	return view('work.books.index')->withBooks(Book::all());
   }
   public function show($id){
   		$records = Book::all();
      return view('work.books.show')->withRecords($records);
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
    //增加新书籍
    public function postAddbook(Request $request){
        $this->validate($request,[
            'bookname'=>'required|max:200',
            'author'=>'max:50',
            'count'=>'required|integer',
            'introduction'=>'string',
            ]);
        $book = new Book();
        $book->bookname = $request->input('bookname');
        $book->count = $request->input('count');
        $book->author = $request->input('author');
        $book->introduction = $request->input('introduction');
        $book->user_id = Auth::user()->id;
        if(!$book->save()){
            return Redirect::back()->withErrors('数据无法被存储，请重新提交！');
        }
        return Redirect::back()->withErrors('数据提交成功！');
    }

    //获取所有已增加的书籍
    public function getShowbooks(){
        $books = Book::all();
        return view('work.books.showbooks')->withBooks($books);
    }
    //显示待编辑图书
    public function getShowbook($id){
        $validator = Validator::make(['id'=>$id],['id'=>'integer|min:0']);
       if( $validator->fails()){
            return Redirect::back()->withErrors($Validator->messages());
       }
        $books = DB::connection('work')->select('select * from books where id=?',[$id]);
        if(empty($books)){
           return Redirect::back()->withErrors("该图书不存在。");
        }
        $book = Book::find($id);
        return view('work.books.editbook')->withBook($book);
    }
    //编辑图书信息
    public function postEditbook(Request $request,$id){
       $validator = Validator::make(['id'=>$id],['id'=>'integer|min:0']);
       if( $validator->fails()){
            return Redirect::back()->withErrors($Validator->messages());
       }
        $books = DB::connection('work')->select('select * from books where id=?',[$id]);
        if(empty($books)){
           return Redirect::back()->withErrors("该图书不存在。");
        }
        $this->validate($request,[
            'bookname'=>'required|max:200',
            'author'=>'max:50',
            'count'=>'required|integer|min:0',
            'introduction'=>'string',
            ]);
        $book = Book::find($id);
        $book->bookname = $request->input('bookname');
        $book->author = $request->input('author');
        $book->count = $request->input('count');
        $book->introduction = $request->input('introduction');
        if(!$book->save()){
            return Redirect::back()->withErrors("图书编辑失败。");
        }
       return $this->getShowbooks();
    }
    //删除图书信息
    public function getDeletebook($id){
        $validator = Validator::make(['id'=>$id],['id'=>'integer|min:0']);
       if( $validator->fails()){
            return Redirect::back()->withErrors($Validator->messages());
       }
        $books = DB::connection('work')->select('select * from books where id=?',[$id]);
        if(empty($books)){
           return Redirect::back()->withErrors("该图书不存在。");
        }
        $book = Book::find($id);
        DB::table('borrowers')->where('book_id','=',$book->id)->delete();
        $borrowers = DB::select('select * from borrowers where book_id = ?',[$book->id]);
        if(!empty($borrowers)){
            return Redirect::back()->withErrors("清除该图书借阅记录时失败，请联系管理员！");
        }
        $book->delete();
        if(!$book->trashed()){
             return Redirect::back()->withErrors("删除失败！");
        }
        return Redirect::back()->withInput();
    }

    //获取增加新书籍页面
    public function getAddbook(){
        return view('work.books.addbook');
    }

/*
*插入借阅记录
*/
    public function postAddborrow(Request $request){
        $this->validate($request,[
            'id'=>'numeric|required',
            'borrowdate'=>'date|required',
            'um_number'=>'required|alpha_num|max:255',
            'remark'=>'string',
            ]);
        $book = Book::find($request->input('id'));
        //判断是否存在该书籍
        if(empty($book)){
            return Redirect::back()->withErrors('提交的数据有误，请重新提交！');
        };
        //判断该书籍当前的数量
        if($book->count < 1){
            return Redirect::back()->withErrors('《'.$book->bookname.'》'.'已无库存。');
        }
        //判断借阅者是否第一次借阅书籍
        $num = DB::select('select *  from users where um_number = ?',[$request->input('um_number')]);
        if(sizeof($num) < 1){
            $user = new User();
            $user->name = '匿名';
            $user->um_number = $request->input('um_number');
            $user->email = $request->input('um_number').'@pingan.com';
            $user->password = '$2y$10$XjY3gM9qnX67jHpgI2bNP.IKgFETFgZrDjEZgwhpnW6GpiwtVlLq2';
            if(!$user->save()){
                 return Redirect::back()->withErrors('数据无法被存储，请重新提交！');
            }
        }
        //当前被借阅书籍数量减1
        $book->count = $book->count -1;
        if(!$book->save()){
            return Redirect::back()->withErrors('数据存储失败，请联系管理员处理。');
        }
        //生成借阅记录
        $borrower = new Borrower();
        $borrower->book_id = $request->input('id');
        $borrower->borrowdate = $request->input('borrowdate');
        $borrower->manager_id = Auth::user()->id;
        $borrower->user_id = User::where('um_number','=',$request->input('um_number'))->get()[0]->id;
        $borrower->remark = htmlentities($request->input('remark'));
        if(!$borrower->save()){
             return Redirect::back()->withErrors('数据存储失败，请联系管理员处理。');
        }
        return Redirect::back()->withErrors('借阅成功，你可以使用'.$request->input('um_number').'@pingan.com账号，密码123456查看个人借阅记录。');
    }
    //获取借阅记录
    public function getShowborrowers(){
        if(Auth::user()->id == 1){
            $result = DB::select('select borrowers.id id,users.name name,users.um_number um_number,books.bookname bookname, books.author author, books.introduction introduction,borrowers.borrowdate borrowerdate ,borrowers.remark remark from borrowers INNER JOIN books ON books.id = borrowers.book_id INNER JOIN users on borrowers.user_id = users.id where borrowers.deleted_at is NULL and borrowers.manager_id = ?',[1]);
            return view('work.books.showborrowers')->withBorrowers($result);
        }
        $result = DB::select('select borrowers.id id,books.bookname  bookname, books.author  author ,books.introduction  introduction, borrowers.borrowdate borrowerdate, borrowers.remark ,remark from borrowers INNER JOIN books ON books.id = borrowers.book_id and borrowers.deleted_at is NULL and borrowers.user_id = ?',[Auth::user()->id]);
        return view('work.books.showborrowers')->withBorrowers($result);
    }

    public function postSearch(Request $request){
        $this->validate($request,['search'=>'required|alpha_num|max:255',]);
        $result = DB::select('select borrowers.id id,users.name name,users.um_number um_number,books.bookname bookname, books.author author, books.introduction introduction,borrowers.borrowdate borrowerdate ,borrowers.remark remark from borrowers INNER JOIN books ON books.id = borrowers.book_id INNER JOIN users on borrowers.user_id = users.id where borrowers.deleted_at is NULL and borrowers.manager_id = ? and users.um_number = ?',[1,$request->input('search')]);
            return view('work.books.showborrowers')->withBorrowers($result);
    }
    //删除借阅记录
    public function getDeleteborrower($id){
         $validator = Validator::make(['id'=>$id],['id'=>'integer|min:0']);
       if( $validator->fails()){
            return Redirect::back()->withErrors($Validator->messages());
       }
        $borrowers = DB::select('select * from borrowers where id=?',[$id]);
         if(empty($borrowers)){
           return Redirect::back()->withErrors("该图书不存在。");
        }
        $borrower = Borrower::find($id);
        $book = Book::find($borrower->book_id);
        $book->count = $book->count + 1;
        if(!$book->save()){
            return Redirect::back()->withErrors("归还图书失败！");
        }
        $borrower->delete();
        if(!$borrower->trashed()){
             return Redirect::back()->withErrors("归还图书失败，请联系管理员！");
        }
        return Redirect::back()->withInput();
    }
}
