<?php namespace App\Http\Middleware;

use Closure;
use Session;
class CreateUser {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (!Session::has('create_user'))
        {
            return redirect('registro');
        }
		return $next($request);
	}

}
