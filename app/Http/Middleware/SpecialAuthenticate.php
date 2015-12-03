<?php namespace App\Http\Middleware;

use Closure;
use Auth,Redirect;
class SpecialAuthenticate {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(!Auth::check() || Auth::user()->id != 1){
			return Redirect::back()->withErrors('用户未登陆或无执行该操作的权限。');
		}
		return $next($request);
	}

}
