<?php namespace App\Http\Middleware;

use Closure;
use App\Store;
use Auth;
use Session;
class HaveStore {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$store_id = Store::where('profile_id','=',Auth::user()->id)->where('active',"=",true)->first();
	    $count_data = count($store_id);
		if ($count_data < 1)
        {
        	if (Session::has('configuracion_shymow_shop'))
			{
			    Session::forget('configuracion_shymow_shop');
			}
        	flash()->overlay('Debes crear una tienda', 'Información!');
	    	return redirect('perfil');
        }
		return $next($request);
	}

}
