<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Countrie;
use App\State;
use App\Citie;
use App\Perfil;
use App\Interest;
use Validator;
use Illuminate\Http\Request;

class SearchController extends Controller {

	public function show(Request $request){
		$v = Validator::make($request->all(), [
	        'like' => 'required',
	        'genero' => 'required',
	        'redes' => 'required',
	        'stream' => 'required',
	        'edad' => 'required',
	        'pais' => 'required',
	        'provincia' => 'required',
	        'municipio' => 'required',
	        'interes' => 'required',
	    ]);

	    if ($v->fails())
	    {
	       return redirect('/');
	    }
		$name = $request->input('search');
		$type = $request->input('like');
		$genero = $request->input('genero');
		$social = $request->input('redes');
		$stream = $request->input('stream');
		$edad = $request->input('edad');
		$paisId = $request->input('pais');
		$provinciaId = $request->input('provincia');
		$municipioId = $request->input('municipio');
		$interes = $request->input('interes');

		if ($paisId != 'all') {
			$pais = DB::select('select name from countries where id ='.$paisId);
			$pais = $pais[0]->name;
		}else{
			$pais = "all";
		}
		if ($provinciaId != 'all') {
			$provincia = DB::select('select name from states where id ='.$provinciaId);
			$provincia = $provincia[0]->name;
		}else{
			$provincia = "all";
		}
		if ($municipioId != 'all') {
			$municipio = DB::select('select name from cities where id ='.$municipioId);
			$municipio = $municipio[0]->name;
		}else{
			$municipio = "all";
		}
		$countries = Countrie::lists('name','id');
		$interest = Interest::lists('name','id');

		$interests = Interest::find($interes);

		// dd($interests['attributes']['categories_id']);

		$users = Perfil::user($name)->type($type)->genero($genero)->edad($edad)->pais($pais)->provincia($provincia)->municipio($municipio)->hobbie($interests['attributes']['name'])->redes($social)->stream($stream)->paginate(4);

		$users->setPath('busqueda_inicio');
		// dd($results);
		$userslider = Perfil::where('active',true)
                    ->orderBy('id','DESC')->take(10)->get();
    	$socialNet = ['facebook','twitter','linkedin','youtube','pinterest','instagram'];
		return \View::make('logueado.home_busqueda',compact('countries','users','interest','userslider','socialNet'));
		
	}

	public function getAjaxUser(Request $request){
		echo "hola";
	}
}