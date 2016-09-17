<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Countrie;
use App\State;
use App\Citie;

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
	public function faq(){
		return view('faq');
	}
	public function contacto(){
		return view('nosotros');
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
