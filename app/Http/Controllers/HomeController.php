<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Countrie;
use App\State;
use App\Citie;
use App\Perfil;
use App\BusinessCategories;
use App\BusinessSubCategories;
use DB;
use Illuminate\Http\Request;
use Validator;
use Session;

class HomeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
	{
		$this->middleware('guest');
		if(!Session::has('data_user')){
			return redirect('/');
		}
	}

	public function registro(){
		return view('registro');
	}
	public function users(){
		return view('usuarios');
	}
	public function dataUser(){
		$country = Countrie::lists('name','id');
		return view('usuarios_datos')->with('countries',$country);
	}
	public function celebridad(){
		return view('celebridad');
	}
	public function dataCelebridad(){
		$country = Countrie::lists('name','id');

		return view('datos_celebridad')->with('countries',$country);
	}
	public function empresa(){
		return view('empresa');
	}
	public function dataEmpresa(){
		$country = Countrie::lists('name','id');
		$subCategories = BusinessSubCategories::lists('name','id');
		return view('datos_empresa')->with('countries',$country)->with('subCategories',$subCategories);
	}
	public function empresaSocial(){
		return view('final_empresa');
	}


	// Retur view registro get
	public function final_steps(Request $request)
	{
		$country = Countrie::lists('name','id');
		if(Session::has('data_user')){
			if (isset(Session::get('data_user')['pais']) && isset(Session::get('data_user')['provincia']) ) {
				return view('users_steps_final');
			}else{
				return redirect('data_user')->with('countries',$country);
			}
		}else{
			return redirect('/');
		}
	}
	public function empresa_social(Request $request)
	{
		$country = Countrie::lists('name','id');
		if(Session::has('data_user')){
			if (isset(Session::get('data_user')['paiscorp']) && isset(Session::get('data_user')['dni']) ) {
				return view('final_empresa')->with('countries',$country);
			}else{
				return redirect('datos_empresa');
			}
		}else{
			return redirect('/');
		}
	}
	public function celebridad_social(Request $request)
	{
		$country = Countrie::lists('name','id');
		if(Session::has('data_user')){
			if (isset(Session::get('data_user')['pais']) && isset(Session::get('data_user')['apodo']) ) {
				return view('final_celebridad');
			}else{
				return redirect('datos_celebridad')->with('countries',$country);
			}
		}else{
			return redirect('/');
		}
	}
	

	
}
