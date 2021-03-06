<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Book extends Model {
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = 'books'; //指定对应的数据库表
	protected $fillable = ['bookname','borrowdate','manager_id','borrower'];
}
