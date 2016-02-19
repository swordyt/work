<?php namespace App\Http\Controllers\Work\AutoTest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Set;
use App\Runner;
class SetController extends Controller {
public function getSet(Request $request){
	$set = new Set();
	$id=$request->input('id');
	if(empty($id)){
		return view("work.autotest.set.showset")->withSet($set);
	}
	$this->validate($request,[
		'id'=>'required|integer',
		]);
	$set=Set::find($id);
	if(!isset($set)||empty($set)){
		return view("work.autotest.set.showset")->withSet($set);
	}
	return view("work.autotest.set.showset")->withSet($set);
	}
	public function postAddset(Request $request){
		$this->validate($request,[
			'setid'=>'integer']);
		$setid=$request->input('setid');
		$set=new Set();
		if(!empty($setid)){
			$set=Set::find($setid);
		}
		$set->name=$request->input('setname');
		$set->save();
		$ids=explode(',', $request->input('requests'));
		Runner::where("setid","=",$setid)->where("state","=","static")->delete();
		for($i=1;$i<count($ids)-1;$i++){
			$runner=new Runner();
			$runner->setid=$set->id;
			$runner->requestid=$ids[$i];
			$runner->state="static";
			$runner->checkid=1;
			$runner->checkstate=0;
			$runner->save();
		}
		return view("work.autotest.set.showset")->withSet($set);
	}
}

