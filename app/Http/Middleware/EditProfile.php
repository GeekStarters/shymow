<?php namespace App\Http\Middleware;

use Closure;
use Session;
class EditProfile {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (!Session::has('configuracion_shymow_profile'))
        {
            return redirect('identificate_perfil');
        }
		return $next($request);
	}

}
