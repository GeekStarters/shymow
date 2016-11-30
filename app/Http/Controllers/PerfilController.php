<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Auth;
use App\Perfil;
use App\Empresa;
use Image;
use Input;
class PerfilController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
