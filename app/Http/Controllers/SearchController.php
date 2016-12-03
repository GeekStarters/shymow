<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Countrie;
use App\State;
use App\Citie;
use App\Perfil;
use App\Interest;
use App\BusinessCategories;
use App\BusinessSubCategories;
use Validator;
use Auth;
use Illuminate\Http\Request;

class SearchController extends Controller {

	public function getSearchData(Request $request){
		$params = array();
		parse_str($request->input('data'), $params);
		
		$name = $params['search'];
		$type = $params['like'];
		$genero = $params['genero'];
		$social = $params['redes'];
		$stream = $params['stream'];
		$edad = $params['edad'];
		$paisId = $params['pais'];
		$provinciaId = $params['provincia'];
		$municipioId = $params['municipio'];
		$interes = $params['interes'];
		$comercio = $params['comercio'];
		$categoria = (int) $params['categoria'];



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

		
		if ($type == "0" || $type == "1") {
			$users = Perfil::user($name)->type($type)->genero($genero)->edad($edad)->pais($pais)->provincia($provincia)->municipio($municipio)->hobbie($interests['attributes']['name'])->redes($social)->stream($stream)->take(3)->get();
		}elseif($type == "2"){
			if (isset($comercio)) {
				if ($comercio != "all") {
					$users = DB::table('perfils')
					->select('perfils.name','perfils.qualification','perfils.like',DB::raw('YEAR(CURDATE())-YEAR(perfils.birthdate) as edad'),'perfils.pais','perfils.descripcion','perfils.id','perfils.email','perfils.birthdate','perfils.img_profile','perfils.redes','perfils.streamings','perfils.webs','perfils.blogs','perfils.mi_frase','empresas.id as empresas_id','empresas.profile_id as empresas_perfil_id','empresas.empresa','empresas.alias','empresas.actividad_comercial','empresas.local')
					->join('empresas','empresas.profile_id','=','perfils.id')
					->where('perfils.active',true)
					->where('empresas.active',true)
					->where('empresas.actividad_comercial',$comercio)
					->take(3)->get();
				}else{
					$users = DB::table('perfils')
					->select('perfils.name','perfils.qualification','perfils.like',DB::raw('YEAR(CURDATE())-YEAR(perfils.birthdate) as edad'),'perfils.pais','perfils.descripcion','perfils.id','perfils.email','perfils.birthdate','perfils.img_profile','perfils.redes','perfils.streamings','perfils.webs','perfils.blogs','perfils.mi_frase','empresas.id as empresas_id','empresas.profile_id as empresas_perfil_id','empresas.empresa','empresas.alias','empresas.actividad_comercial','empresas.local')
					->join('empresas','empresas.profile_id','=','perfils.id')
					->where('perfils.active',true)
					->where('empresas.active',true)
					->take(3)->get();
				}
			}elseif (isset($categoria)) {
				if ($categoria != "all") {
					$categoriaId = BusinessCategories::find($categoria);
					if (count($categoriaId) > 0) {
						$users = DB::table('perfils')
						->select('perfils.name','perfils.qualification','perfils.like',DB::raw('YEAR(CURDATE())-YEAR(perfils.birthdate) as edad'),'perfils.role','perfils.pais','perfils.descripcion','perfils.id','perfils.email','perfils.birthdate','perfils.img_profile','perfils.redes','perfils.streamings','perfils.webs','perfils.blogs','perfils.mi_frase','empresas.id as empresas_id','empresas.profile_id as empresas_perfil_id','empresas.empresa','empresas.alias','empresas.actividad_comercial','empresas.local')
						->join('empresas','empresas.profile_id','=','perfils.id')
						->where('perfils.active',true)
						->where('empresas.active',true)
						->where('empresas.actividad_comercial',$categoriaId->id)
						->take(3)->get();
					}else{
						return response()->json(['error'=>true]);
					}
				}else{
					$categoriaId = BusinessCategories::find($categoria);
					if (count($categoriaId) > 0) {
						$users = DB::table('perfils')
						->select('perfils.name','perfils.qualification','perfils.like',DB::raw('YEAR(CURDATE())-YEAR(perfils.birthdate) as edad'),'perfils.pais','perfils.descripcion','perfils.id','perfils.email','perfils.birthdate','perfils.img_profile','perfils.redes','perfils.streamings','perfils.webs','perfils.blogs','perfils.mi_frase','empresas.id as empresas_id','empresas.profile_id as empresas_perfil_id','empresas.empresa','empresas.alias','empresas.actividad_comercial','empresas.local')
						->join('empresas','empresas.profile_id','=','perfils.id')
						->where('perfils.active',true)
						->where('empresas.active',true)
						->take(3)->get();
					}else{
						return response()->json(['error'=>true]);
					}
				}
			}else{
				return redirect('/');
			}
		}elseif($type == "all"){
			$users = DB::table('perfils')
			->select('perfils.name','perfils.qualification','perfils.like','perfils.role',DB::raw('YEAR(CURDATE())-YEAR(perfils.birthdate) as edad'),'perfils.pais','perfils.descripcion','perfils.id','perfils.email','perfils.birthdate','perfils.img_profile','perfils.redes','perfils.streamings','perfils.webs','perfils.blogs','perfils.mi_frase','empresas.id as empresas_id','empresas.profile_id as empresas_perfil_id','empresas.empresa','empresas.alias','empresas.local','empresas.actividad_comercial')
			->leftJoin('empresas','empresas.profile_id','=','perfils.id')
			->where('perfils.active',true)
			->take(3)->get();
		}else{
			return response()->json(['error'=>true]);
		}
		dd($users);
		$socialNet = ['facebook','twitter','linkedin','youtube','pinterest','instagram'];
		return response()->json(['error'=>false,'data'=>$users,'redes'=>$socialNet]);
	}

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
		$comercio = $request->input('comercio');
		$categoria = (int) $request->input('categoria');

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
		if($edad == "all"){
			$edad = 0;
		}else{
			$edad = (int) $edad;
		}
		$paginate = 15;
		if ($type == "0" || $type == "1") {
			$users = Perfil::user($name)->type($type)->genero($genero)->edad($edad)->pais($pais)->provincia($provincia)->municipio($municipio)->hobbie($interests['attributes']['name'])->redes($social)->stream($stream)->leftJoin('user_likes', function($join)
			        {
			            $join->on('user_likes.user_id', '=', 'perfils.id')
			            ->where('user_likes.profil_id','=',Auth::id())
			            ->where('user_likes.like','=',true);
			        })->select('user_likes.profil_id','perfils.name','perfils.qualification','perfils.like','perfils.role',DB::raw('YEAR(CURDATE())-YEAR(perfils.birthdate) as edad'),'perfils.pais','perfils.descripcion','perfils.id','perfils.email','perfils.birthdate','perfils.img_profile','perfils.redes','perfils.streamings','perfils.webs','perfils.blogs','perfils.mi_frase')->paginate($paginate);
		}elseif($type == "2"){
			if (isset($comercio)) {
				if ($comercio != "all") {
					$users = DB::table('perfils')
					->select('user_likes.profil_id','perfils.name','perfils.qualification','perfils.like',DB::raw('YEAR(CURDATE())-YEAR(perfils.birthdate) as edad'),'perfils.pais','perfils.descripcion','perfils.id','perfils.email','perfils.birthdate','perfils.img_profile','perfils.redes','perfils.streamings','perfils.webs','perfils.blogs','perfils.mi_frase','empresas.id as empresas_id','empresas.profile_id as empresas_perfil_id','empresas.empresa','empresas.alias','empresas.actividad_comercial','empresas.local')
					->join('empresas','empresas.profile_id','=','perfils.id')
					->leftJoin('user_likes', function($join)
			        {
			            $join->on('user_likes.user_id', '=', 'perfils.id')
			            ->where('user_likes.profil_id','=',Auth::id())
			            ->where('user_likes.like','=',true);
			        })
					->where('perfils.active',true)
					->where('empresas.active',true)
					->where('empresas.actividad_comercial',$comercio)
					->paginate($paginate);
				}else{
					$users = DB::table('perfils')
					->select('user_likes.profil_id','perfils.name','perfils.qualification','perfils.like',DB::raw('YEAR(CURDATE())-YEAR(perfils.birthdate) as edad'),'perfils.pais','perfils.descripcion','perfils.id','perfils.email','perfils.birthdate','perfils.img_profile','perfils.redes','perfils.streamings','perfils.webs','perfils.blogs','perfils.mi_frase','empresas.id as empresas_id','empresas.profile_id as empresas_perfil_id','empresas.empresa','empresas.alias','empresas.actividad_comercial','empresas.local')
					->join('empresas','empresas.profile_id','=','perfils.id')
					->leftJoin('user_likes', function($join)
			        {
			            $join->on('user_likes.user_id', '=', 'perfils.id')
			            ->where('user_likes.profil_id','=',Auth::id())
			            ->where('user_likes.like','=',true);
			        })
					->where('perfils.active',true)
					->where('empresas.active',true)
					->paginate($paginate);
				}
			}elseif (isset($categoria)) {
				if ($categoria != "all") {
					$categoriaId = BusinessCategories::find($categoria);
					if (count($categoriaId) > 0) {
						$users = DB::table('perfils')
						->select('user_likes.profil_id','user_likes.profile_id','user_likes.user_id','perfils.name','perfils.qualification','perfils.like',DB::raw('YEAR(CURDATE())-YEAR(perfils.birthdate) as edad'),'perfils.role','perfils.pais','perfils.descripcion','perfils.id','perfils.email','perfils.birthdate','perfils.img_profile','perfils.redes','perfils.streamings','perfils.webs','perfils.blogs','perfils.mi_frase','empresas.id as empresas_id','empresas.profile_id as empresas_perfil_id','empresas.empresa','empresas.alias','empresas.actividad_comercial','empresas.local')
						->join('empresas','empresas.profile_id','=','perfils.id')
						->leftJoin('user_likes', function($join)
				        {
				            $join->on('user_likes.user_id', '=', 'perfils.id')
				            ->where('user_likes.profil_id','=',Auth::id())
				            ->where('user_likes.like','=',true);
				        })
						->where('perfils.active',true)
						->where('empresas.active',true)
						->where('empresas.actividad_comercial',$categoriaId->id)
						->paginate($paginate);
					}else{
						return redirect('/');
					}
				}else{
					$categoriaId = BusinessCategories::find($categoria);
					if (count($categoriaId) > 0) {
						$users = DB::table('perfils')
						->select('user_likes.profil_id','perfils.name','perfils.qualification','perfils.like',DB::raw('YEAR(CURDATE())-YEAR(perfils.birthdate) as edad'),'perfils.pais','perfils.descripcion','perfils.id','perfils.email','perfils.birthdate','perfils.img_profile','perfils.redes','perfils.streamings','perfils.webs','perfils.blogs','perfils.mi_frase','empresas.id as empresas_id','empresas.profile_id as empresas_perfil_id','empresas.empresa','empresas.alias','empresas.actividad_comercial','empresas.local')
						->join('empresas','empresas.profile_id','=','perfils.id')
						->leftJoin('user_likes', function($join)
				        {
				            $join->on('user_likes.user_id', '=', 'perfils.id')
				            ->where('user_likes.profil_id','=',Auth::id())
				            ->where('user_likes.like','=',true);
				        })
						->where('perfils.active',true)
						->where('empresas.active',true)
						->paginate($paginate);
					}else{
						return redirect('/');
					}
				}
			}else{
				return redirect('/');
			}
		}elseif($type == "all"){
			$users = DB::table('perfils')
			->select('user_likes.profil_id','perfils.name','perfils.qualification','perfils.like','perfils.role',DB::raw('YEAR(CURDATE())-YEAR(perfils.birthdate) as edad'),'perfils.pais','perfils.descripcion','perfils.id','perfils.email','perfils.birthdate','perfils.img_profile','perfils.redes','perfils.streamings','perfils.webs','perfils.blogs','perfils.mi_frase','empresas.id as empresas_id','empresas.profile_id as empresas_perfil_id','empresas.empresa','empresas.alias','empresas.local','empresas.actividad_comercial')
			->leftJoin('empresas','empresas.profile_id','=','perfils.id')
			->leftJoin('user_likes', function($join)
	        {
	            $join->on('user_likes.user_id', '=', 'perfils.id')
	            ->where('user_likes.profil_id','=',Auth::id())
	            ->where('user_likes.like','=',true);
	        })
			->where('perfils.active',true)
			->paginate($paginate);
		}else{
			return redirect('/');
		}

		$users->setPath('busqueda_inicio');
		$userslider = Perfil::where('active',true)
                    ->orderBy('id','DESC')->take(10)->get();
    	$socialNet = ['facebook','twitter','linkedin','youtube','pinterest','instagram'];

    	$subCategories = BusinessSubCategories::lists('name','id');
    	$categories = BusinessCategories::lists('name','id');

    	$localAll = [];
    	if ($type == "2" || $type == "all") {
    		foreach ($users as $user) {
    			if (isset($user->local)) {
    				$local = $user->local;
    				$locals = json_decode($local,true);
    				foreach ($locals as $sucursal) {
    					array_push($localAll, ['address'=>$sucursal['address'],'lat'=>$sucursal['lat'],'lng'=>$sucursal['lng'],'img' => $user->img_profile,'alias'=>$user->alias,'icon'=>"/img/".$user->actividad_comercial.".png" ]);
    				}
    			}
    		}
    	}

		// dd($users);
		return \View::make('logueado.home_busqueda',compact('countries','users','interest','userslider','socialNet','subCategories','categories','localAll'));
		
	}

	public function getAjaxUser(Request $request){
		echo "hola";
	}
}