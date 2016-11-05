<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Auth;
use App\Perfil;

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

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
