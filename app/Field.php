<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Field extends Model {
	use SoftDeletes;
	protected $table = 'Fields';
	protected $dates = ['deleted_at'];
	

}
