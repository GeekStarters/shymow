<?php namespace App\Http\Middleware;

use Closure;
use Session;
class IdentificateStore {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (!Session::has('configuracion_shymow_shop')) {
			return redirect('identificate');
		}
		return $next($request);
	}

}
