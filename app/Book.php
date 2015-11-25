<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Book extends Model {
	protected $table = 'books'; //指定对应的数据库表
	protected $fillable = ['BookName','BorrowDate','manager_id','Borrower'];

}
