<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Countrie;
use App\State;
use App\Citie;
use App\Perfil;
use App\Post;
use Illuminate\Http\Request;
use Validator;
use Session;

class NavigationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function nosotros(){
		return view('nosotros');
	}
	public function politicasCookie(){
		return view('cookies');
	}
	public function contratacionPremium(){
		return view('contratacion_premium');
	}
	public function politicasPrivacidad(){
		return view('privacidad');
	}
	public function condiciones(){
		return view('condiciones');
	}
	public function faq(){
		return view('faq');
	}
	public function contacto(){
		return view('contacto');
	}
	public function viewUser($name = null){
		if ($name != null) {
			$users = Perfil::where('id',$name)
								->where('active',true)->first();
			if (count($users) > 0 && count($users) < 2) {
				$posts = Post::where('profil_id',$users->id)
								->where('active',true)->get();

			// dd($posts);
			$socialNet = ['facebook','twitter','linkedin','youtube','pinterest','instagram','snapchat','plus','vine','tumblr'];
			$streamNet = ['twitch','bambuser','livestream'];
			return view('logueado.ver_perfil',compact('users','posts','socialNet','streamNet'));
			}else{

			}
		}else{
			return view('logueado.agregar');
		}
	}
	// Funciones con Query Scope laravel return data ajax
	public function state($id){
		$state = State::stateOfCountry($id)->get();
		foreach ($state as $data) {
			echo '<option value="'.$data->id.'">'.$data->name.'</option>';
		}
	}
	public function city($id){
		$city = Citie::cityOfState($id)->get();
		foreach ($city as $data) {
			echo '<option value="'.$data->id.'">'.$data->name.'</option>';
		}
	}

}
