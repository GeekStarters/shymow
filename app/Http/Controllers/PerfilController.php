<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Auth;
use App\Perfil;
use App\Empresa;
use App\Countrie;
use App\State;
use App\Citie;
use App\Post;
use App\Category_post;
use App\UserQualification;
use App\UserLikes;
use App\UserShare;
use App\usersDesabilited;
use App\Options_desactive;
use Image;
use DB;
use Hash;
use Input;
use Session;
use Carbon\Carbon;
class PerfilController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function validacion(Request $request){
		$password = $request->all();
		$user = DB::table('perfils')
	        ->select('password')
	        ->where('id', Auth::user()->id);
	    $user = $user->first();
		$messages = [
			'required' => 'Identifiquese por favor',
		];
		$v = Validator::make($password, [
			'password' => 'required|min:8',
	    ],$messages);

	    if ($v->fails())
	    {
		    return redirect('identificate_perfil')->withErrors($v)->withInput($request->all());
	    }
		if(Hash::check($request->input('password'),$user->password)) {
			Session::put('configuracion_shymow_profile', true);
			if (session::has('configuracion_shymow_profile'))
			{
        		return redirect('edit-profile');
			}
   		}else{
   			return redirect('identificate_perfil');
   		}

	}
	public function outEditData(){
		if (Session::has('configuracion_shymow_profile'))
		{
		    Session::forget('configuracion_shymow_profile');
		}

		return redirect('perfil');
	}
	public function desabilitedUser(Request $re){
		$desactives = Options_desactive::all();
		$reasons = "";
		$f = 0;
		if (count($desactives) > 0) {
			foreach ($desactives as $desactive) {
				if ($re->input('opt'.$desactive->id) != "") {
					if ($f<1) {
						$f++;
						$reasons .= $re->input('opt'.$desactive->id);
					}else{
						$reasons .= ",".$re->input('opt'.$desactive->id);
					}
					
				}
			}
			if (empty($reasons)) {
				flash('Debe seleccionar un motivo para dar de baja su cuenta', 'danger');
	    		return redirect()->back()->withInput();
			}

			try {
				$desabilite = new usersDesabilited();
				$desabilite->profile_id = Auth::user()->id;
				$desabilite->description = $re->input('description');
				$desabilite->reasons = $reasons;
				$desabilite->save();

				Perfil::where('id','=',Auth::user()->id)->update(['active'=>false]);
				flash()->overlay('Tu cuenta fue desactivada', Auth::user()->name);
				return redirect('logout');

			} catch (Exception $e) {
				flash('Intentelo nuevamente', 'danger');
				return redirect()->back();			
			}
		}
	}
	public function recoverPass(Request $request)
	{	
		$v = Validator::make($request->all(), [
	        'recover_pass' => 'required|unique:perfils,recover_pass,'.Auth::id(),
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors())->withInput();
	    }

	    try {
	    	Perfil::where('id','=',Auth::id())->update(['recover_pass'=>$request->input('recover_pass')]);
	    	flash('Correo actualizado', 'success');
	    	return redirect()->back()->withInput();
	    } catch (Exception $e) {
	    	flash('Intentelo nuevamente', 'danger');
	    	return redirect()->back()->withInput();
	    }
		return view('logueado.config-security',compact('desactives'));
	}
	public function editSecurity()
	{	
		$desactives = Options_desactive::all();
		return view('logueado.config-security',compact('desactives'));
	}
	public function savePass(Request $request)
	{	
		$v = Validator::make($request->all(), [
	        'last_password' => 'required|min:8',
	        'password' => 'required|min:8|confirmed',
	        'password_confirmation' => 'required|min:8',
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors())->withInput();
	    }

	    $password = $request->input('last_password');
	   if (!Hash::check($password,Auth::user()->password)){
	   		flash('Password no coincide con el actual', 'danger');
	    	return redirect()->back()->withInput();
	    }

	    $password = Hash::make($request->input('password'));
	    try {
	    	Perfil::where('id','=',Auth::id())->update(['password'=>$password]);
	    	flash('Password actualizado', 'success');
	    	return redirect()->back()->withInput();
	    } catch (Exception $e) {
	    	flash('Intentelo nuevamente', 'danger');
	    	return redirect()->back()->withInput();
	    }
		return view('logueado.config-security');
	}
	public function saveGeneralProfile(Request $request)
	{
		$v = Validator::make($request->all(), [
	        'nombre' => 'required',
	        'apellido' => 'required',
	        'email' => 'unique:perfils,email,'.Auth::id(),
	        'celular' => 'required',
	        'cp' => 'required',
	        'code' => 'required',
	        'pais' => 'required',
	        'dia' => 'required',
	        'mes' => 'required',
	        'anio' => 'required',
	        'genero' => 'required'
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors())->withInput();
	    }

	    $month = $request->input('mes');
	    $day = $request->input('dia');
	    $year = $request->input('anio');

	    $nombre = $request->input('nombre');
	    $apellido = $request->input('apellido');
	    $email = $request->input('email');
	    $celular = $request->input('celular');
	    $cp = $request->input('cp');
	    $code = $request->input('code');
	    $pais = $request->input('pais');
	    $genero = $request->input('genero');

	    $view_cp = $request->input('view_cp');
	    $view_gender = $request->input('view_gender');
	    $view_country = $request->input('view_country');
	    $view_birth = $request->input('view_birth');
	    $view_phone = $request->input('view_phone');
	    $view_email = $request->input('view_email');

	    $view_cp = $view_cp == "true" ? true : false;
	    $view_gender = $view_gender == "true" ? true : false;
	    $view_country = $view_country == "true" ? true : false;
	    $view_birth = $view_birth == "true" ? true : false;
	    $view_email = $view_email == "true" ? true : false;
	    $view_phone = $view_phone == "true" ? true : false;

	    $allname = $nombre." ".$apellido;

	    if (!checkdate ((int)$month , (int)$day , (int) $year )) {
	    	flash('Fecha no valida', 'danger');
	    	return redirect()->back();
	    }
	    $myCountry = DB::select('SELECT * FROM `countries` WHERE name = "'.Auth::user()->pais.'"');
		if (count($myCountry) > 0) {
			$myCountry = $myCountry[0]->name;
		}else{
			flash('País no valido', 'danger');
	    	return redirect()->back();
		}
	    $phone = $celular;
	    $date = date("Y-m-d",strtotime($year."-".$month."-".$day));     
	    try {
	    	Perfil::where('id','=',Auth::id())->update(['fname'=>$nombre,'lname'=>$apellido,'birthdate' => $date,'email' => $email,'phone'=>$phone,'code_phone'=>$code,'pais' => $myCountry,'genero' => $genero,'name' => $allname,'view_cp'=>$view_cp,'view_gender'=>$view_gender,'view_country'=>$view_country,'view_birth'=>$view_birth,'view_email'=>$view_email,'view_phone'=>$view_phone,'cp'=>$cp]);

	    	flash('Datos guardados', 'success');
	    	return redirect('perfil');
	    } catch (Exception $e) {
	    	flash('Ocurrio un error', 'danger');
	    	return redirect()->back();
	    }

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function editProfile()
	{
		$codes = DB::select('SELECT * FROM `code_phones`');
		$countries = Countrie::all()->lists('name','id');
		$myCountry = DB::select('SELECT * FROM `countries` WHERE name = "'.Auth::user()->pais.'"');
		if (count($myCountry) > 0) {
			$myCountry = $myCountry[0];
		}

		$date = Auth::user()->birthdate;
		$date = explode("-", $date);
		$y = $date[0];
		$m = $date[1];
		$d = $date[2];

		$myCode = [];
		if (!empty(Auth::user()->code_phone)) {
			$myCode = DB::select('SELECT * FROM `code_phones` WHERE phonecode = "'.Auth::user()->code_phone.'"');
			if (count($myCode) > 0) {
				$myCode = $myCode[0];
			}
		}
		return view('logueado.config-perfil',compact('codes','countries','myCountry','y','m','d','myCode'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	public function createLike($post){
		$count_user = DB::select('SELECT * FROM perfils WHERE active = true and id = '.$post);
		$user_id = Auth::user()->id;

		if (count($count_user)>0) {

			$like = DB::select('SELECT * FROM `user_likes` WHERE (`user_id` = '.$post.' and `profil_id` = '.$user_id.') and (`active` = true and `like` = true)');

			$like_edit = DB::select('SELECT * FROM `user_likes` WHERE (`user_id` = '.$post.' and `profil_id` = '.$user_id.') and (`active` = true and `like` = false)');

			if (count($like) < 1 and count($like_edit)<1) {
				$new_like = new UserLikes();
					$new_like->like = true;
					$new_like->user_id = $post;
					$new_like->profil_id = $user_id;
				$new_like->save();

				$count_like = DB::select('SELECT * FROM user_likes WHERE user_id = '.$post.' and (user_likes.like = true and user_likes.active = true)');

				$count_like = count($count_like);

				if ($count_like > 0) {
					$edit_user = Perfil::find($post);
						$edit_user->like = $count_like;
					try {
						$edit_user->save();
						echo "Like";
					} catch (Exception $e) {
						echo "error";
					}
				}
			}elseif (count($like_edit) > 0) {
				$like_id = $like_edit['0']->id;

				$edit_like = UserLikes::find($like_id);
					$edit_like->like = true;
				$edit_like->save();

				$count_like = DB::select('SELECT * FROM user_likes WHERE user_id = '.$post.' and (user_likes.like = true and user_likes.active = true)');
				
				try {
					$edit_user = Perfil::where('id','=',$post)->update(['like'=>count( $count_like)]);
					echo "like";
				} catch (Exception $e) {
					echo "error";
				}
			}

			if (count($like) > 0) {
				$like_id = $like['0']->id;

				$edit_like = UserLikes::find($like_id);
					$edit_like->like = false;
				$edit_like->save();

				$count_like = DB::select('SELECT * FROM user_likes WHERE user_id = '.$post.' and (user_likes.like = true and user_likes.active = true)');

				$edit_user = Perfil::where('id','=',$post)->update(["like"=>count($count_like)]);
		
				
				
				echo "like";
			}
		}
	}

	public function createShareUser(Request $request){
		$validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'category' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/perfil')
                        ->withErrors($validator);
        }

        $user_id =(int) $request->input('user_id');
        $new_description = $request->input('new_description');
        $category = (int)$request->input('category');

		$user_count = Perfil::where('id','=',$user_id)->where('active','=',true)->count();


		if ($user_count < 1) {
			flash('No se Compartio usuario', 'danger');
			return redirect('favoritos');
		}

		$newPost = new Post();
			$newPost->description = $new_description;
			$newPost->category_post_id = $category;
			$newPost->profil_id = Auth::user()->id;
			$newPost->type = 1;
		try {
			$newPost->save();

			$newShare = new UserShare();
				$newShare->user_id = $user_id;
				$newShare->profil_id = Auth::user()->id;
				$newShare->new_post_id = $newPost->id;
			$newShare->save();

			flash('Usuario compartido', 'success');
			return redirect('favoritos');
		} catch (Exception $e) {
			flash('sucedio un error', 'danger');
			return redirect('favoritos');
		}
	}
	public function shareUser($user_id){
		$user_count = Perfil::where('id','=',$user_id)->where('active','=',true)->count();
		if ($user_count < 1) {
			return response()->json(['error' => true, 'message' => "Al parecer ocurrio un error"]);
		}
		$user = Perfil::where('id','=',$user_id)->where('active','=',true)->get();
		$category = Category_post::all();
		$data_category = [];
		foreach ($category as $data) {
			array_push($data_category, ["id" => $data->id,"name" => $data->name]);
		}
		return response()->json(['error' => false,
								'message' => "Get user success",
								"user_name" => $user[0]->name,
								"img_profile" => $user[0]->img_profile,
								"user_id" => $user[0]->id,
								"category" => $data_category
								]);
		
	}
	public function createQualification($id,$qualification){
		//user ID
		$user_id = Auth::user()->id;
		//Verificar si el usuario a calificado user
		$exists_user_active = UserQualification::where('active','=',true)->where('user_id','=',$id)->where('profil_id',$user_id)->count();

		//Verifica si el usuario no ha calificado user
		$exists_user_false = UserQualification::where('active',false)->where('user_id',$id)->where('profil_id',$user_id)->count();

		//Id user

		//Verificamos si existe user
		$user_exist = Perfil::where('active',true)->where('id',$id)->count();

		//Pasamos la puntuacion a un entero
		if (!empty($qualification)) {
			$qualification = (int) $qualification;
		}

		if ($user_exist > 0) {
			//Validamos que no exista calificacion

			if ($exists_user_active < 1 && $exists_user_false < 1) {
				//Si no existe calificacion del user por este usuario la creamos
				$newQualification = new UserQualification();
					$newQualification->user_id = $id;
					$newQualification->profil_id = $user_id;
					$newQualification->qualification = $qualification;

				try {
					$newQualification->save();

					//Traemos todas las calificaciones
					$get_qualification_user = UserQualification::where('active',true)
												->where('user_id',$id)->get();
					//Creamos un arreglo
					$stack_qualification = [];

					//Recorremos el arreglo
					foreach ($get_qualification_user as $data) {
						//Guardamos la calificacion en el arreglo
						
						array_push($stack_qualification, $data->qualification);
					}
					//Sacamos el promedio de las calificaciones
					$media = array_sum($stack_qualification)/count($stack_qualification);
					$media = round($media);
					try {
						//Guardamos la nueva calificacion de user
							$saveNewQualificationPost = Perfil::where('active',true)->where('id',$id) ->update(['qualification' => $media]);
						//retornamos el promedio o el error
						return response()->json(['error' => false, 'qualification' => $media]);
					} catch (Exception $e) {
						return response()->json(['error' => true, 'description' => $e->getMessage()]);
					}
				} catch (Exception $e) {
					return response()->json(['error' => true, 'description' => $e->getMessage()]);
				}

				// Si el usuario ya califico editamos esa misma calificacion
			}elseif ($exists_user_active > 0 && $exists_user_false < 1) {
				//Guardamos lo editado
				try {
					$qualification_edit = UserQualification::where('active',true)->where('user_id',$id)->where('profil_id',$user_id)->update(['qualification' => $qualification]);

					//Traemos todas las calificaciones
					$get_qualification_post = UserQualification::where('active',true)
												->where('user_id',$id)->get();
					//Creamos un arreglo
					$stack_qualification = [];

					//Recorremos el arreglo
					foreach ($get_qualification_post as $data) {
						//Guardamos la calificacion en el arreglo
						array_push($stack_qualification, $data->qualification);
					}
					//Sacamos el promedio de las calificaciones
					$media = array_sum($stack_qualification)/count($stack_qualification);
					$media = round($media);
					try {
						//Guardamos la nueva calificacion de los posteos
							$saveNewQualificationPost = Perfil::where('active',true)->where('id',$id)->update(['qualification' => $media]);

						//retornamos el promedio o el error
						return response()->json(['error' => false, 'qualification' => $media]);
					} catch (Exception $e) {
						return response()->json(['error' => true, 'description' => $e->getMessage()]);
					}
				} catch (Exception $e) {
					return response()->json(['error' => true, 'description' => $e->getMessage()]);
				}

				//Si el usuario habia calificado antes pero esta desactivada la activamos y editamos
			}elseif ($exists_user_active < 1 && $exists_user_false > 0) {
				try {
					$qualification_edit = UserQualification::where('active',false)->where('user_id',$id)->where('profil_id',$user_id)->update(['qualification' => $qualification,'active' => true]);
					

					//Traemos todas las calificaciones
					$get_qualification_post = UserQualification::where('active',true)
												->where('user_id',$id)->get();
					//Creamos un arreglo
					$stack_qualification = [];

					//Recorremos el arreglo
					foreach ($get_qualification_post as $data) {
						//Guardamos la calificacion en el arreglo
						array_push($stack_qualification, $data->qualification);
					}
					//Sacamos el promedio de las calificaciones
					$media = array_sum($stack_qualification)/count($stack_qualification);
					$media = round($media);

					try {
						//Guardamos la nueva calificacion de los posteos
							$saveNewQualificationPost = Perfil::where('active',true)->where('id',$id) ->update(['qualification' => $media]);
						//retornamos el promedio o el error
						return response()->json(['error' => false, 'qualification' => $media]);
					} catch (Exception $e) {
						return response()->json(['error' => true, 'description' => $e->getMessage()]);
					}
				} catch (Exception $e) {
					return response()->json(['error' => true, 'description' => $e->getMessage()]);
				}
			}
		}

	
	}
	public function delete_local($address = null,$lat = null,$lng = null){
		if (isset($address)) {
			if (isset($lat)) {
				if (isset($lng)) {

				    $validator = false;
					$keyL = "";
					$building = Empresa::where('profile_id',Auth::id())->where('active',true)->get();
					if (count($building) > 0) {
						$local = $building[0]->local;
						if (isset($local) && $local != "") {
							$locals = json_decode($local,true);
							foreach ($locals as $key => $local) {
								if ($local['address'] == $address) {
									if ($local['lat'] == $lat){
										if ($local['lng'] == $lng){
											$validator = true;
											$keyL = $key;
										}
									}
								}
							}

							if ($validator) {
								unset($locals[$keyL]);
								asort($locals, 0);
								
								$locals = json_encode($locals);
								try {
									Empresa::where('profile_id',Auth::id())->update(['local' => $locals]);
									return redirect('perfil');
								} catch (Exception $e) {
									return redirect('perfil');
								}
								return redirect('perfil');
							}else{
								return redirect('perfil');
							}
						}
					}
				}else{
					return redirect('perfil');
				}
			}else{
				return redirect('perfil');
			}
		}else{
			return redirect('perfil');
		}
	}
	public function viewLocal($address = null,$lat = null,$lng = null){
		if (isset($address)) {
			if (isset($lat)) {
				if (isset($lng)) {
					$validator = false;
					$keyL = "";
					$building = Empresa::where('profile_id',Auth::id())->where('active',true)->get();
					if (count($building) > 0) {
						$local = $building[0]->local;
						if (isset($local) && $local != "") {
							$locals = json_decode($local,true);
							foreach ($locals as $key => $local) {
								if ($local['address'] == $address) {
									if ($local['lat'] == $lat){
										if ($local['lng'] == $lng){
											$validator = true;
											$keyL = $key;
										}
									}
								}
							}

							if ($validator) {
								$local = $locals[$keyL];
								$add = $local['address'];
								$latitud = $local['lat'];
								$longitud = $local['lng'];

								return view('logueado.view_local',compact('add','latitud','longitud'));
							}else{
								return redirect('perfil');
							}
						}
					}
				}else{
					return redirect('perfil');
				}
			}else{
				return redirect('perfil');
			}
		}else{
			return redirect('perfil');
		}
	}
	public function addLocal(Request $request){
		$v = Validator::make($request->all(), [
	        'address' => 'required',
	        'lat' => 'required',
	        'lng' => 'required',
	    ]);
	    if ($v->fails())
	    {
	        return response()->json(['error' => true]);
	    }

	    $lat = $request->input('lat');
	    $lng = $request->input('lng');
	    $address = $request->input('address');

	    $newLocal = [
	    	"address" => $address,
	    	"lat" => $lat,
	    	"lng" => $lng
	    ];
	    $building = Empresa::where('profile_id',Auth::id())->where('active',true)->get();
	    if (count($building) > 0) {
	    	if (isset($building[0]->local) && $building[0]->local != "") {
	    		$local = json_decode($building[0]->local,true);
	    		$countL = count($local); 
	    		$local[$countL] = $newLocal;
	    		$local = json_encode($local);

	    		// dd($local);
	    		try {
	    			Empresa::where('profile_id',Auth::id())->update(['local' => $local]);
	    			return response()->json(['error' => false]); 
	    		} catch (Exception $e) {
	    			return response()->json(['error' => true]);
	    		}
	    	}else{
	    		$newLocal = json_encode([$newLocal]);
	    		try {
	    			Empresa::where('profile_id',Auth::id())->update(['local' => $newLocal]);
	    		} catch (Exception $e) {
	    			return response()->json(['error' => true]);
	    		}
	    	}
	    }

	    return response()->json(['error' => false]);
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editDataProfile(Request $request)
	{
		$v = Validator::make($request->all(), [
	        'data' => 'required',
	        'type' => 'required',
	    ]);
	    if ($v->fails())
	    {
	        return response()->json(['error' => true]);
	    }

	    $data = $request->input('data');
	    $type = $request->input('type');
	    
	    try {
	    	switch ($type) {
	    		case 'frase':
	    			Perfil::where('id',Auth::id())->update(['mi_frase'=>$data]);
	    			return response()->json(['error' => false]);
	    			break;
	    		case 'descripcion':
	    			Perfil::where('id',Auth::id())->update(['descripcion'=>$data]);
	    			return response()->json(['error' => false]);
	    			break;
	    		case 'work':
	    			Perfil::where('id',Auth::id())->update(['work'=>$data]);
	    			return response()->json(['error' => false]);
	    			break;
	    		case 'phone':
	    			Perfil::where('id',Auth::id())->update(['phone'=>$data]);
	    			return response()->json(['error' => false]);
	    			break;
	    		default:
	    			return response()->json(['error' => true]);
	    			break;
	    	}
	    } catch (Exception $e) {
	    	return response()->json(['error' => true]);
	    }
	}

	public function editImg(){
		return view('logueado.editar_img_perfil');
	}
	public function editHobbies(Request $request){
		$v = Validator::make($request->all(), [
	        'hobbies' => 'required',
	    ]);

	    if ($v->fails())
	    {
	        flash('No se encontraron hobbies', 'danger');
	        return redirect()->back();
	    }

	    $hobbies = $request->input("hobbies");

	    try {
	    	Perfil::where('id',Auth::id())->update(["more_hobbies"=>$hobbies]);
	    	flash('Sus hobbies fueron guardados', 'success');
	    	return redirect()->back();
	    } catch (Exception $e) {
	    	
	    }
	}
	public function editHome(Request $request){
		$v = Validator::make($request->all(), [
	        'pais' => 'required',
	        'provincia' => 'required',
	        'municipio' => 'required',
	    ]);

	    if ($v->fails())
	    {
	        flash('Seleccione los datos correspondientes', 'danger');
	        return redirect()->back();
	    }
	    $countrie = (int) $request->input('pais');
	    $province = (int) $request->input('provincia');
	    $state = (int) $request->input('municipio');
	    try {
	    	$pais = Countrie::where('id',$countrie)->get();
	    	if (count($pais)>0) {
	    		$provincia = State::where('id',$province)->where('countrie_id',$pais[0]->id)->get();
	    		if (count($provincia) > 0) {
	    			$municipio = Citie::where('id',$state)->where('state_id',$provincia[0]->id)->get();
	    			if (count($municipio)>0) {
	    				try {
	    					Perfil::where('id',Auth::id())->update(["pais" => $pais[0]->name,"provincia"=>$provincia[0]->name,"municipio" => $municipio[0]->name]);

	    					flash('Residencia guardada con éxito', 'success');
        					return redirect()->back();
	    				} catch (Exception $e) {
	    					flash('Error al actualizar residencia', 'danger');
        					return redirect()->back();
	    				}
	    			}else{
	    				flash('Error al actualizar residencia', 'danger');
        				return redirect()->back();
	    			}
	    		}else{
	    			flash('Error al actualizar residencia', 'danger');
        			return redirect()->back();
	    		}
	    	}else{
	    		flash('Error al actualizar residencia', 'danger');
        		return redirect()->back();
	    	}
	    } catch (Exception $e) {
	    	
	    }
	}
	public function editBorn(Request $request){
		$messages = [
			"required" => "Seleccione los datos correspondientes",
		];
		$v = Validator::make($request->all(), [
	        'day' => 'required',
	        'month' => 'required',
	        'year' => 'required',
	    ],$messages);

	    if ($v->fails())
	    {
	        flash('Seleccione los datos correspondientes', 'danger');
	        return redirect()->back();
	    }

	    $day = (int) $request->input('day');
	    $month = (int) $request->input('month');
	    $year = (int) $request->input('year');


	    $date = date('Y-m-d', strtotime($year."-".$month."-".$day));
	    if(checkdate($month,$day,$year)){
	    	try {
	    		Perfil::where('id',Auth::id())->update(["birthdate" => $date]);
	    		flash('Fecha actualizada', 'success');
	    		return redirect()->back();
	    	} catch (Exception $e) {
	    		flash('Error al actualizar fecha', 'danger');
	    		return redirect()->back();
	    	}
	    }

	    flash('Fecha no valida', 'danger');
	    return redirect()->back();
	}
	public function editCover(){
		return view('logueado.editar_img_portada');
	}
	public function uploadCoverImg(Request $request){
		$messages = [
			"required" => "Seleccione una imagen y el campo que desea",
			"image" => "Seleccione una imagen valida"
		];
		$v = Validator::make($request->all(), [
	        'img' => 'required|image:jpeg,png',
	        'x1' => 'required',
	        'x2' => 'required',
	        'y1' => 'required',
	        'y2' => 'required',
	        'width' => 'required',
	        'height' => 'required',
	    ],$messages);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }

	    $img = Input::file('img');
	    $width = $request->input('width');
	    $height = $request->input('height');
	    $x1 = $request->input('x1');
	    $y1 = $request->input('y1');
	    $filename  = time() . '.' . $img->getClientOriginalExtension();
	    $path = public_path('img/profile/' . $filename);

		try {
			Image::make( $img->getRealPath() )->resize(700,300)->crop($width, $height, $x1, $y1)->resize(700,300)->save($path);
			Perfil::where('id',Auth::id())->update(['img_portada'=>'img/profile/' . $filename]);

			flash('Portada Cambiada con éxito', 'success');
			return redirect('perfil');
		} catch (Exception $e) {
			flash('Error al cambiar portada', 'danger');
			return redirect('perfil');
		}
	}
	public function uploadProfileImg(Request $request){
		$messages = [
			"required" => "Seleccione una imagen y el campo que desea",
			"image" => "Seleccione una imagen valida"
		];
		$v = Validator::make($request->all(), [
	        'img' => 'required|image:jpeg,png',
	        'x1' => 'required',
	        'x2' => 'required',
	        'y1' => 'required',
	        'y2' => 'required',
	        'width' => 'required',
	        'height' => 'required',
	    ],$messages);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }

	    $img = Input::file('img');
	    $width = $request->input('width');
	    $height = $request->input('height');
	    $x1 = $request->input('x1');
	    $y1 = $request->input('y1');
	    $filename  = time() . '.' . $img->getClientOriginalExtension();
	    $path = public_path('img/profile/' . $filename);

		try {
			Image::make( $img->getRealPath() )->resize(400,400)->crop($width, $height, $x1, $y1)->resize(400,400)->save($path);
			Perfil::where('id',Auth::id())->update(['img_profile'=>'img/profile/' . $filename]);
			flash('Foto de perfil cambiada con éxito', 'success');
			return redirect('perfil');
		} catch (Exception $e) {
			flash('Error al cambiar foto de perfil', 'danger');
			return redirect('perfil');
		}
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/**
	 * Crea Streams y redes sociales
	*/
	public function createNetwork(Request $request){
		$v = Validator::make($request->all(), [
	        'networks' => 'required',
	        'data' => 'required',
	    ]);

	    if ($v->fails())
	    {
	        return response()->json(['error' => true, 'message' => 'Error al crear']);
	    }
	    //Redes sociales

	    function creating($table,$this_network,$data){
	    	$redes_array = json_decode(Auth::user()->$table,true);
			if ($redes_array == null) {
				$redes_array = [];
			}
			//Saber si la clave retornada existe en los streams guardados
			if (array_key_exists($this_network,$redes_array)) {
				//Si existe guardar el arreglo de esa llave
				$new_array = $redes_array[$this_network];
				//Guardamos el nuevo dato en un arreglo
				$new_data = array_push($new_array, $data);
				$redes_array[$this_network] = $new_array;
				

				$union = $redes_array;
				// dd($union);
			}else{
				//Si no existe la llave se crea
				$new_red = [$this_network => [$data]];
				//Se unen los arreglos
				$union = array_merge($redes_array,$new_red);

				// dd($union);
			}

			// dd($union);
			$new_json = json_encode($union);
			try {
				$affectedRows = Perfil::where('id', Auth::user()->id)->update([$table => $new_json]);
				return response()->json(['error' => false, 'message' =>  $this_network.'creada']);
			} catch (Exception $e) {
				return response()->json(['error' => false, 'message' => 'Error']);
			}
	    }
	    function createWebBlog($table,$data){
	    	$redes_array = json_decode(Auth::user()->$table,true);
			if ($redes_array == null) {
				$redes_array = [];
			}

			//Si existe guardar el arreglo de esa llave
			$new_array = $redes_array;
			//Guardamos el nuevo dato en un arreglo
			$new_data = array_push($new_array, $data);
			$redes_array = $new_array;
			

			$union = $redes_array;
			// dd($union);	

			// dd($union);
			$new_json = json_encode($union);
			try {
				$affectedRows = Perfil::where('id', Auth::user()->id)->update([$table => $new_json]);
				return response()->json(['error' => false, 'message' =>  $table.'creada']);
			} catch (Exception $e) {
				return response()->json(['error' => false, 'message' => 'Error']);
			}
				
	    }
	    $socialNet = ['facebook','twitter','linkedin','youtube','pinterest','instagram','snapchat','plus','vine','tumblr'];
	    //Streams
		$streamNet = ['twitch','bambuser','livestream'];

		//Saber que red social trae
		$network = $request->input('networks');
		//Saber el valor que trae
		$data = $request->input('data');

		// dd($data,$network);
		//Saber si es red social
		if (in_array($network, $socialNet)) {
			creating('redes',$network,$data);
		//Saber si es stream
		}elseif(in_array($network, $streamNet)){
			creating('streamings',$network,$data);
		}

		if ($network == "web") {
			createWebBlog("webs",$data);
		}elseif($network == "blog"){
			createWebBlog("blogs",$data);
		}
	}

	/**
	 * Elimina los streams y redes sociales
	*/
	public function destroyNetwork(Request $request){
		$v = Validator::make($request->all(), [
	        'networks' => 'required',
	        'data' => 'required',
	    ]);

	    if ($v->fails())
	    {
	        return response()->json(['error' => true, 'message' => 'Error al eliminar']);
	    }
	    //Redes sociales
	    $socialNet = ['facebook','twitter','linkedin','youtube','pinterest','instagram','snapchat','plus','vine','tumblr'];
	    //Streams
		$streamNet = ['twitch','bambuser','livestream'];

		//Saber que red social trae
		$network = $request->input('networks');
		//Saber el valor que trae
		$data = $request->input('data');

		function deleteWebBlog($table,$value){
			if (isset(Auth::user()->$table)) {
				//Convertir el JSON guardado en arreglo
				$streams_array = json_decode(Auth::user()->$table,true);

				//Si existe guardar el arreglo
				$new_array = $streams_array;

				//Saber si existe el valor en el arreglo
				if (in_array($value, $new_array)) {
					$key = array_search($value,$new_array);
					unset($new_array[$key]);
					//Ordenar arreglo
					$clean_array = sort($new_array,0);
					//Verificar si lo ordeno
					if ($clean_array) {

						$new_json = json_encode($new_array);
						try {
							$affectedRows = Perfil::where('id', Auth::user()->id)->update([$table => $new_json]);
							return response()->json(['error' => false, 'message' => $table.' eliminado']);
						} catch (Exception $e) {
							return response()->json(['error' => false, 'message' => 'Error']);
						}
					}
				}
			}
		}

		if ($network == "web") {
			deleteWebBlog("webs",$data);
		}elseif($network == "blog"){
			deleteWebBlog("blogs",$data);
		}
		//Saber si es red social
		if (in_array($network, $socialNet)) {
			//Validar si existe redes sociales
			if (isset(Auth::user()->redes)) {
				//Convertir Redes sociales en
				$redes_array = json_decode(Auth::user()->redes,true);

				//Saber si la clave retornada existe en los streams guardados
				if (array_key_exists($network,$redes_array)) {
					//Si existe guardar el arreglo de esa llave
					$new_array = $redes_array[$network];

					//Saber si existe el valor en el arreglo
					if (in_array($data, $new_array)) {
						$key = array_search($data,$new_array);
						unset($new_array[$key]);
						//Ordenar arreglo
						$clean_array = sort($new_array,0);
						//Verificar si lo ordeno
						if ($clean_array) {
							//Guardar nuevo arreglo ordenado
							$redes_array[$network] = $new_array;
							// dd($redes_array);

							$new_json = json_encode($redes_array);
							try {
								$affectedRows = Perfil::where('id', Auth::user()->id)->update(['redes' => $new_json]);
								return response()->json(['error' => false, 'message' => 'Red eliminado']);
							} catch (Exception $e) {
								return response()->json(['error' => false, 'message' => 'Error']);
							}
						}
					}
				}
			}

			// dd($union);
		//Saber si es stream
		}elseif(in_array($network, $streamNet)){
			//Saber si este usuario tiene streams guardados
			if (isset(Auth::user()->streamings)) {
				//Convertir el JSON guardado en arreglo
				$streams_array = json_decode(Auth::user()->streamings,true);

				//Saber si la clave retornada existe en los streams guardados
				if (array_key_exists($network,$streams_array)) {
					//Si existe guardar el arreglo de esa llave
					$new_array = $streams_array[$network];

					//Saber si existe el valor en el arreglo
					if (in_array($data, $new_array)) {
						$key = array_search($data,$new_array);
						unset($new_array[$key]);
						//Ordenar arreglo
						$clean_array = sort($new_array,0);
						//Verificar si lo ordeno
						if ($clean_array) {
							//Guardar nuevo arreglo ordenado
							$streams_array[$network] = $new_array;
							// dd($streams_array);

							$new_json = json_encode($streams_array);
							try {
								$affectedRows = Perfil::where('id', Auth::user()->id)->update(['streamings' => $new_json]);
								return response()->json(['error' => false, 'message' => 'Streaming eliminado']);
							} catch (Exception $e) {
								return response()->json(['error' => false, 'message' => 'Error']);
							}
						}
					}
				}
			}
		}

	}

}
