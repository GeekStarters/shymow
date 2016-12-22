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
		
		$paisId = $params['pais'];
		$provinciaId = $params['provincia'];
		$municipioId = $params['municipio'];
		$interes = $params['interes'];
		$comercio = $params['comercio'];
		$categoria = (int) $params['categoria'];


		$edad = $params['edad'];
		$edadArray = explode("-",$edad);
		$edadOne = "";
		$edadTwo = "";
		$posicion_coincidencia = strpos($edad, "-");
		$menores = false;
		$mayores = false;
		$edades = false;
		$all = false;
		$oneEdad = (!empty($posicion_coincidencia)) ? true : false;
		if ($edad == "menores") {
			$menores = true;
		}elseif($edad == "tedad"){
			$mayores = true;
		}elseif ($oneEdad) {
			if (!empty($edadArray[0]) && !empty($edadArray[1])) {
				if (((int)$edadArray[0]) < ((int)$edadArray[1])) {
					$edades = true;
					$edadOne = $edadArray[0];
					$edadTwo = $edadArray[1];
				}else{
					return redirect('/');
				}
			}
		}elseif($edad == "all"){
			$all = true;
		}else{
			return redirect('/');
		}



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

		
		$pic = $type === '3' ? true : false; 
		$update = $type === '5' ? true : false; 
		$youtuber = $type === '4' ? true : false;

		if ($type == "0" || $type == "1" || $type == "3" || $type == "5" || $type == "4") {
			$users = Perfil::user($name)->type($type)->genero($genero)->edad($edadOne,$edadTwo,$menores,$mayores,$edades,$all)->pais($pais)->provincia($provincia)->municipio($municipio)->hobbie($interests['attributes']['name'])->redes($social)->stream($stream)->userUpdate($update)->youtubers($youtuber)->pic($pic)->get();
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
		$edadArray = explode("-",$edad);
		$edadOne = "";
		$edadTwo = "";
		$posicion_coincidencia = strpos($edad, "-");
		$menores = false;
		$mayores = false;
		$edades = false;
		$all = false;
		$oneEdad = (!empty($posicion_coincidencia)) ? true : false;
		if ($edad == "menores") {
			$menores = true;
		}elseif($edad == "tedad"){
			$mayores = true;
		}elseif ($oneEdad) {
			if (!empty($edadArray[0]) && !empty($edadArray[1])) {
				if (((int)$edadArray[0]) < ((int)$edadArray[1])) {
					$edades = true;
					$edadOne = $edadArray[0];
					$edadTwo = $edadArray[1];
				}else{
					return redirect('/');
				}
			}
		}elseif($edad == "all"){
			$all = true;
		}else{
			return redirect('/');
		}

		$edadF = 0;
		$edadS = 100;

		if ($menores) {
			$edadF = 0;
			$edadS = 18;
		}elseif($mayores){
			$edadF = 63;
			$edadS = 100;
		}elseif($all){
			$edadF = 0;
			$edadS = 100;
		}elseif($edades){
			$edadF = (int)$edadArray[0];
			$edadS = (int)$edadArray[1];
		}else{
			$edadF = 0;
			$edadS = 100;
		}

		$paisId = $request->input('pais');
		$provinciaId = $request->input('provincia');
		$municipioId = $request->input('municipio');
		$interes = $request->input('interes');
		$comercio = $request->input('comercio');
		$categoria = (int) $request->input('categoria');

		$ubication = [];
		

		if ($paisId != 'all') {
			$pais = DB::select('select name from countries where id ='.$paisId);
			if (count($pais) > 0) {
				$pais = $pais[0]->name;

				if (!empty($pais)) {
					$location = str_replace(' ', '+', $pais);
					$location = str_replace(',', '', $location);
					$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$location."&key=AIzaSyDssPGqiz3lLJ8RoKvlXlUk2OGR97z4zVk";
				    $ch = curl_init();
				    curl_setopt($ch, CURLOPT_URL, $url);
				    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
				    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				    $response = curl_exec($ch);
				  	curl_close($ch);
				  	$ubication = json_decode($response, true);
				}
			}
		}else{
			$pais = "all";
		}
		if ($provinciaId != 'all') {
			$provincia = DB::select('select name from states where id ='.$provinciaId);
			if (count($provincia) > 0) {
				$provincia = $provincia[0]->name;
			}
		}else{
			$provincia = "all";
		}
		if ($municipioId != 'all') {
			$municipio = DB::select('select name from cities where id ='.$municipioId);
			if (count($municipio)>0) {
				$municipio = $municipio[0]->name;
			}
		}else{
			$municipio = "all";
		}
		$lat = "";
		$lng = "";

		if (!isset($ubication['results'][0]['geometry']['location'])) {
			if (!empty($pais)) {
					$location = str_replace(' ', '+', $pais);
					$location = str_replace(',', '', $location);
					$url = "https://maps.googleapis.com/maps/api/geocode/json?address=Spain&key=AIzaSyDssPGqiz3lLJ8RoKvlXlUk2OGR97z4zVk";
				    $ch = curl_init();
				    curl_setopt($ch, CURLOPT_URL, $url);
				    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
				    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				    $response = curl_exec($ch);
				  	curl_close($ch);
				  	$ubication = json_decode($response, true);
				}
		}
		if (isset($ubication['results'][0]['geometry']['location'])) {
			$access = $ubication['results'][0]['geometry']['location'];
			$lat = (float) $access['lat'];
			$lng = (float) $access['lng'];
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

		$pic = $type === '3' ? true : false; 
		$update = $type === '5' ? true : false; 
		$youtuber = $type === '4' ? true : false;




		// dd($pic,$update,$youtuber);
		if ($type == "0" || $type == "1" || $type == "3" || $type == "5" || $type == "4") {
			$users = Perfil::user($name)->type($type)->genero($genero)->edad($edadOne,$edadTwo,$menores,$mayores,$edades,$all)->pais($pais)->provincia($provincia)->municipio($municipio)->hobbie($interests['attributes']['name'])->redes($social)->stream($stream)->userUpdate($update)->youtubers($youtuber)->pic($pic)->leftJoin('user_likes', function($join)
			        {
			            $join->on('user_likes.user_id', '=', 'perfils.id')
			            ->where('user_likes.profil_id','=',Auth::id())
			            ->where('user_likes.like','=',true);
			        })->select('user_likes.profil_id','perfils.name','perfils.update','perfils.qualification','perfils.like','perfils.role',DB::raw('YEAR(CURDATE())-YEAR(perfils.birthdate) as edad'),'perfils.pais','perfils.descripcion','perfils.id','perfils.email','perfils.birthdate','perfils.img_profile','perfils.redes','perfils.streamings','perfils.webs','perfils.blogs','perfils.mi_frase')->paginate($paginate);
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
					->where('perfils.pais', 'LIKE', '%'.$pais.'%')
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
						if ($pais != "all") {
							if ($provincia != "all") {
								if ($municipio != "all") {
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
									->where('perfils.pais',$pais)
									->where('perfils.provincia',$provincia)
									->where('perfils.municipio',$municipio)
									->whereRaw('YEAR(CURDATE())-YEAR(perfils.birthdate) >='.$edadF.' AND YEAR(CURDATE())-YEAR(perfils.birthdate) <='.$edadS)
									->paginate($paginate);
								}else{
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
									->where('perfils.pais',$pais)
									->where('perfils.provincia',$provincia)
									->whereRaw('YEAR(CURDATE())-YEAR(perfils.birthdate) >='.$edadF.' AND YEAR(CURDATE())-YEAR(perfils.birthdate) <='.$edadS)
									->paginate($paginate);
								}
							}else{
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
									->where('perfils.pais',$pais)
									->whereRaw('YEAR(CURDATE())-YEAR(perfils.birthdate) >='.$edadF.' AND YEAR(CURDATE())-YEAR(perfils.birthdate) <='.$edadS)
									->paginate($paginate);
							}
						}else{
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
							->whereRaw('YEAR(CURDATE())-YEAR(perfils.birthdate) >='.$edadF.' AND YEAR(CURDATE())-YEAR(perfils.birthdate) <='.$edadS)
							->paginate($paginate);
						}
						
					}else{
						return redirect('/');
					}
				}
			}else{
				return redirect('/');
			}
		}elseif($type == "all"){
			if ($pais != "all") {
				if ($provincia != "all") {
					if ($municipio != "all") {
						$users = DB::table('perfils')
						->select('user_likes.profil_id','perfils.name','perfils.qualification','perfils.like','perfils.role',DB::raw('YEAR(CURDATE())-YEAR(perfils.birthdate) as edad'),'perfils.pais','perfils.descripcion','perfils.id','perfils.email','perfils.birthdate','perfils.img_profile','perfils.redes','perfils.streamings','perfils.webs','perfils.blogs','perfils.mi_frase','perfils.is_youtuber','empresas.id as empresas_id','empresas.profile_id as empresas_perfil_id','empresas.empresa','empresas.alias','empresas.local','empresas.actividad_comercial')
						->leftJoin('empresas','empresas.profile_id','=','perfils.id')
						->leftJoin('user_likes', function($join)
				        {
				            $join->on('user_likes.user_id', '=', 'perfils.id')
				            ->where('user_likes.profil_id','=',Auth::id())
				            ->where('user_likes.like','=',true);
				        })
						->where('perfils.active',true)
						->where('perfils.pais',$pais)
						->where('perfils.provincia',$provincia)
						->where('perfils.municipio',$municipio)
						->whereRaw('YEAR(CURDATE())-YEAR(perfils.birthdate) >='.$edadF.' AND YEAR(CURDATE())-YEAR(perfils.birthdate) <='.$edadS)
						->paginate($paginate);
					}else{
						$users = DB::table('perfils')
						->select('user_likes.profil_id','perfils.name','perfils.qualification','perfils.like','perfils.role',DB::raw('YEAR(CURDATE())-YEAR(perfils.birthdate) as edad'),'perfils.pais','perfils.descripcion','perfils.id','perfils.email','perfils.birthdate','perfils.img_profile','perfils.redes','perfils.streamings','perfils.webs','perfils.blogs','perfils.mi_frase','perfils.is_youtuber','empresas.id as empresas_id','empresas.profile_id as empresas_perfil_id','empresas.empresa','empresas.alias','empresas.local','empresas.actividad_comercial')
						->leftJoin('empresas','empresas.profile_id','=','perfils.id')
						->leftJoin('user_likes', function($join)
				        {
				            $join->on('user_likes.user_id', '=', 'perfils.id')
				            ->where('user_likes.profil_id','=',Auth::id())
				            ->where('user_likes.like','=',true);
				        })
						->where('perfils.active',true)
						->where('perfils.pais',$pais)
						->where('perfils.provincia',$provincia)
						->whereRaw('YEAR(CURDATE())-YEAR(perfils.birthdate) >='.$edadF.' AND YEAR(CURDATE())-YEAR(perfils.birthdate) <='.$edadS)
						->paginate($paginate);
					}
				}else{
					$users = DB::table('perfils')
						->select('user_likes.profil_id','perfils.name','perfils.qualification','perfils.like','perfils.role',DB::raw('YEAR(CURDATE())-YEAR(perfils.birthdate) as edad'),'perfils.pais','perfils.descripcion','perfils.id','perfils.email','perfils.birthdate','perfils.img_profile','perfils.redes','perfils.streamings','perfils.webs','perfils.blogs','perfils.mi_frase','perfils.is_youtuber','empresas.id as empresas_id','empresas.profile_id as empresas_perfil_id','empresas.empresa','empresas.alias','empresas.local','empresas.actividad_comercial')
						->leftJoin('empresas','empresas.profile_id','=','perfils.id')
						->leftJoin('user_likes', function($join)
				        {
				            $join->on('user_likes.user_id', '=', 'perfils.id')
				            ->where('user_likes.profil_id','=',Auth::id())
				            ->where('user_likes.like','=',true);
				        })
						->where('perfils.active',true)
						->where('perfils.pais',$pais)
						->whereRaw('YEAR(CURDATE())-YEAR(perfils.birthdate) >='.$edadF.' AND YEAR(CURDATE())-YEAR(perfils.birthdate) <='.$edadS)
						->paginate($paginate);
				}
			}else{
				$users = DB::table('perfils')
				->select('user_likes.profil_id','perfils.name','perfils.qualification','perfils.like','perfils.role',DB::raw('YEAR(CURDATE())-YEAR(perfils.birthdate) as edad'),'perfils.pais','perfils.descripcion','perfils.id','perfils.email','perfils.birthdate','perfils.img_profile','perfils.redes','perfils.streamings','perfils.webs','perfils.is_youtuber','perfils.blogs','perfils.mi_frase','empresas.id as empresas_id','empresas.profile_id as empresas_perfil_id','empresas.empresa','empresas.alias','empresas.local','empresas.actividad_comercial')
				->leftJoin('empresas','empresas.profile_id','=','perfils.id')
				->leftJoin('user_likes', function($join)
		        {
		            $join->on('user_likes.user_id', '=', 'perfils.id')
		            ->where('user_likes.profil_id','=',Auth::id())
		            ->where('user_likes.like','=',true);
		        })
				->where('perfils.active',true)
				->whereRaw('YEAR(CURDATE())-YEAR(perfils.birthdate) >='.$edadF.' AND YEAR(CURDATE())-YEAR(perfils.birthdate) <='.$edadS)
				->paginate($paginate);
			}
			
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
		return \View::make('logueado.home_busqueda',compact('countries','users','interest','userslider','socialNet','subCategories','categories','localAll','lat','lng'));
		
	}

	public function getAjaxUser(Request $request){
		echo "hola";
	}
}