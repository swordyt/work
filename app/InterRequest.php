<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class InterRequest extends Model {
	use SoftDeletes;
	protected $table = 'InterRequests';
	protected $dates = ['deleted_at'];
	public function Fields(){
		return $this->hasMany("App\Field","requestid","id");
	}
}
