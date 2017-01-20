<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Session;
use Hash;
use App\Celebritie;
use App\Empresa;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use App\Citie;
use App\State;
use App\Notification_setting;
use App\Countrie;
use App\Perfil;
use Uuid;
use Auth;
use Mail;

class RegistroController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}
	
	public function index($id,$email,$passowrd)
	{
		return view('registro');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		$messages = [
		    'social1.url'    => 'Una de tus redes sociales no tiene un formato correcto',
		    'social2.url'    => 'Una de tus redes sociales no tiene un formato correcto',
		    'social3.url'    => 'Una de tus redes sociales no tiene un formato correcto',
		    'social4.url'    => 'Una de tus redes sociales no tiene un formato correcto',
		    'social5.url'    => 'Una de tus redes sociales no tiene un formato correcto',
		    'stream1.url'    => 'Uno de tus streaming no tiene formato correcto',
		    'stream2.url'    => 'Uno de tus streaming no tiene formato correcto',
		    'stream3.url'    => 'Uno de tus streaming no tiene formato correcto',
		    'stream4.url'    => 'Uno de tus streaming no tiene formato correcto',
		    'stream5.url'    => 'Uno de tus streaming no tiene formato correcto',
		    'blog1.url'    => 'La URL del blog que introduces no tiene formato correcto',
		    'web1.url'    => 'La URL de la web que introduces no tiene formato correcto',
		];

		$v = Validator::make($request->all(), [
	        'social1' => 'url',
	        'social2' => 'url',
	        'social3' => 'url',
	        'social4' => 'url',
	        'social5' => 'url',
	        'stream1' => 'url',
	        'stream2' => 'url',
	        'stream3' => 'url',
	        'stream4' => 'url',
	        'stream5' => 'url',
	        'blog1' => 'url',
	        'web1' => 'url'
	    ],$messages);

		$role = Session::get('data_user')['role'];
	    if ($v->fails())
	    {	
	    	switch ($role) {
	    		case 0:
	        			return redirect('final_steps')->withErrors($v, 'register')->withInput();
	    			break;
	    		case 1:
	    				return redirect('celebridad_social')->withErrors($v, 'register')->withInput();
	    			break;
	    		case 2:
	    				return redirect('empresa_social')->withErrors($v, 'register')->withInput();
	    			break;
	    		
	    		default:
	    				return redirect('registro');
	    			break;
	    	}
	        
	    }
	   	$is_youtuber = isset(Session::get('data_user')['is_youtuber']) ? true : false;
	   	$data_user = Session::get('data_user');
	    $socials = $request->input('social1').",".$request->input('social2').",".$request->input('social3').",".$request->input('social4').",".$request->input('social5');
	    $streamings = $request->input('stream1').",".$request->input('stream2').",".$request->input('stream3').",".$request->input('stream4').",".$request->input('stream5');

	    $date = date('Y-m-d', strtotime($data_user['anio']."-".$data_user['mes']."-".$data_user['dia']));
	    
	    $fecha = time() - strtotime($date);
		$edad = (int) floor($fecha / 31556926);
		// dd($edad);

		if (!Session::has('social_json')){
			session('social_json', '');
			session('stream_json', '');
		}


		// Session::forget('social_json');
		// dd(Session::get('social_json'));
		// exit();
	    // dd($data_user,$request->all());
	    function socialValidate($url){
	    	$urlHost = parse_url($url, PHP_URL_HOST);
	    	$domain = str_replace('www', '', $urlHost);
	    	$cleanDomain = explode('.',  $domain);
	    	$domainValor = $cleanDomain[1];

	    	if($cleanDomain[1] == 'com'){
	    		$domainValor = $cleanDomain[0];
	    	}

	    	$socialNet = ['facebook','twitter','linkedin','youtube','pinterest','instagram','snapchat','plus','vine','tumblr'];

	    	if(in_array($domainValor, $socialNet)){

	    		if(Session::has('social_json.'.$domainValor)){
	    			// dd(Session::get('social_json'));
	    			$getSocial = Session::pull('social_json');
	    			$count = count($getSocial[$domainValor]) +1;
	    			$nameArraySocial = (string)$count;

	    			// dd($count,$nameArraySocial);
	    			$getSocial[$domainValor][$nameArraySocial] = $url;

	    			Session::put('social_json',$getSocial);
	    			return true;
	    			// dd(Session::get('social_json'));
	    		}else{
	    			$count = Session::get('social_json');
	    			if ($count > 1) {
	    				$array = Session::pull('social_json');
	    				$array[$domainValor] =["1"=>$url];

	    			}else{
	    				$array = [$domainValor => ["1"=>$url]];
	    			}
	    			
	    			Session::put('social_json',$array);
	    			return true;
	    			// dd(Session::get('social_json'));
	    		}
	    	}else{
	    		return false;
	    	}
	    }
	    // dd(Session::get('social_json'));
	    // dd($data_user,$request->all());
	    for ($i=1; $i < 5; $i++) { 
	    	
		    $urlGet = $request->get('social'.$i);
		    if($urlGet != ""){
		    	if (!socialValidate($urlGet)) {
		    		flash('URL Red no valida', 'danger');
		    		Session::forget('social_json');
			    	switch ($role) {
			    		case 0:
			        			return redirect()->back()->withInput();
			    			break;
			    		case 1:
			    				return redirect()->back()->withInput();
			    			break;
			    		case 2:
			    				return redirect()->back()->withInput();
			    			break;
			    		
			    		default:
			    				return redirect('registro');
			    			break;
			    	}
		    	}
		    }
	    }
	    $jsonRedes = json_encode(Session::pull('social_json'));



	    //Stream json

	   	function streamValidate($url){
	    	$urlHost = parse_url($url, PHP_URL_HOST);
	    	$domain = str_replace('www', '', $urlHost);
	    	$cleanDomain = explode('.',  $domain);

	    	$domainValor = $cleanDomain[1];

	    	if($cleanDomain[1] == 'com'){
	    		$domainValor = $cleanDomain[0];
	    	}

	    	
	    	$streamNet = ['twitch','bambuser','livestream'];

	    	if(in_array($domainValor, $streamNet)){

	    		if(Session::has('stream_json.'.$domainValor)){
	    			// dd(Session::get('stream_json'));
	    			$getSocial = Session::pull('stream_json');
	    			$count = count($getSocial[$domainValor]) +1;
	    			$nameArraySocial = (string) $count;

	    			// dd($count,$nameArraySocial);
	    			$getSocial[$domainValor][$nameArraySocial] = $url;

	    			Session::put('stream_json',$getSocial);
	    			return true;
	    			// dd(Session::get('stream_json'));
	    		}else{
	    			$count = Session::get('stream_json');
	    			if ($count > 1) {
	    				$array = Session::pull('stream_json');
	    				$array[$domainValor] =["1"=>$url];

	    			}else{
	    				$array = [$domainValor => ["1"=>$url]];
	    			}
	    			
	    			// dd($array);
	    			Session::put('stream_json',$array);
	    			return true;
	    			// dd(Session::get('stream_json'));
	    		}
	    	}else{
	    		return false;
	    	}
	    }
	    // dd(Session::get('stream_json'));
	    // dd($data_user,$request->all());
	    for ($i=1; $i < 5; $i++) { 
	    	
		    $urlGet = $request->get('stream'.$i);
		    if($urlGet != ""){
	   			$valor =  streamValidate($urlGet);
	   			if (!streamValidate($urlGet)) {
	   				flash('URL Stream no valida', 'danger');
	   				Session::forget('stream_json');
		   			switch ($role) {
			    		case 0:
			        			return redirect()->back()->withInput();
			    			break;
			    		case 1:
			    				return redirect()->back()->withInput();
			    			break;
			    		case 2:
			    				return redirect()->back()->withInput();
			    			break;
			    		
			    		default:
			    				return redirect('registro');
			    			break;
			    	}
	   			}
		    }
	    }
	    $jsonStream = json_encode(Session::pull('stream_json'));
	    // dd($data_user);
	    $pais =Countrie::getCountry(Session::get('data_user')['pais'])->get();
	    $provincia =State::getState(Session::get('data_user')['provincia'])->get();
	    $municipio =Citie::getCity(Session::get('data_user')['municipio'])->get();


	    // dd(Session::get('data_user'));
	    // exit();



	    $pais = $pais[0]['name'];
	    $provincia = $provincia[0]['name'];
	    $municipio = $municipio[0]['name'];

	    $webs_get = $request->input('web1');
	    $blogs_get = $request->input('blog1');

	    if ($webs_get == "") {
	    	$webs_get = NULL;
	    }else{
	    	$webs_get = json_encode([$request->input('web1')]);
	    }
	    if($blogs_get == ""){
	    	$blogs_get = NULL;
	    }else{
	    	$blogs_get = json_encode([$request->input('blog1')]);
	    }
	    try {
	    	$user = new Perfil($data_user);
			    $user->redes = $jsonRedes;
			    $user->streamings = $jsonStream;
			    $user->blogs = $webs_get;
			    $user->webs = $blogs_get;
			    $user->birthdate = $date;
			    $user->role = $role;
			    $user->pais = $pais;
			    $user->provincia = $provincia;
			    $user->municipio = $municipio;
			    $user->edad = $edad;
			    $user->recover_pass = $data_user['email'];
			    $user->is_youtuber = $is_youtuber;
			    $user->identification = Uuid::generate(4);
			    $user->confirmation_code = Uuid::generate(4);
		    $user->save();
		    $notifications = new Notification_setting();
		    $notifications->perfil_id = $user->id;
		    $notifications->save();
		    if($role == 2){


			    $paisCorp =Countrie::getCountry(Session::get('data_user')['paiscorp'])->get();
			    $provinciaCorp =State::getState(Session::get('data_user')['provinciacorp'])->get();
			    $municipioCorp =Citie::getCity(Session::get('data_user')['municipiocorp'])->get();
			    
 				$paisCorp = $paisCorp[0]['name'];
	    		$provinciaCorp = $provinciaCorp[0]['name'];
	    		$municipioCorp = $municipioCorp[0]['name'];

		    	$empresa = new Empresa($data_user);
		    		$empresa->profile_id = $user->id;
		    		$empresa->actividad_comercial = Session::get('data_user')['empresa_comercio'];
		    		$empresa->responsable = Session::get('data_user')['responsable_empresa'];
		    		$empresa->email_responsable = Session::get('data_user')['email_empresa'];
		    		$empresa->empresa_pais = $paisCorp;
		    		$empresa->empresa_provincia = $provinciaCorp;
		    		$empresa->empresa_municipio = $municipioCorp;
		    	$empresa->save();
		    }

		    if($role == 1){
		    	$celebrity = new Celebritie();
		    		$celebrity->profile_id = $user->id;
		    		$celebrity->apodo = Session::get('data_user')['apodo'];
		    	$celebrity->save();

		    }
		    
		    $path = "http://".$_SERVER['HTTP_HOST']."/register/verify/".$user->confirmation_code;
	   		$destinatario = $user->email;
	   		$message = "Thanks for creating an account in shymow.
            Please follow the link below to verify your email address";

				$asunto = "Verify Your Email Address"; 
				$cuerpo = ' 
				<html> 
				<head> 
				   <title>Welcome</title> 
				</head> 
				<body> 
				<h1>Welcome to Shymow!</h1> 
				<p><b>Name: </b>'.$user->name.'</p>
				<p><b>Subject: </b>Accommodation message</p>
				<p>'.$message.'</p>
				<p><a href='.$path.'>Confirm account</a>;
				</body> 
				</html> 
				'; 

				//para el envío en formato HTML 
				$headers = "MIME-Version: 1.0\r\n"; 
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

				mail($destinatario,$asunto,$cuerpo,$headers);

	   		
	   		$tuser = [
	    		'email' => $user->email,
	    		'password' => Session::get('data_user')['pass']
			];
			Session::forget('data_user');
		    if (Auth::attempt($tuser,true))
			{	
				flash()->overlay('Debes conformar tu correo', Auth::user()->name);
		        return redirect()->intended('perfil');
			}else
			{
				return redirect()->intended('/');
			}



	    	return Redirect('/?users=Usuario creado');
	    } catch (Exception $e) {

	   		Session::forget('data_user');
	    	return redirect('/?users=Error al crear usuario');
	    }
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{


		$v = Validator::make($request->all(), [
	        'name' => 'required|min:10',
	        'email' => 'required|min:10|email|unique:perfils',
	        'password' => 'required|min:8',
	        'condiciones' => 'required',
	    ]);

	    if ($v->fails())
	    {	
	        return redirect('/')->withErrors($v, 'register')->withInput();
	    }

		$name = $request->input('name');
		$email = $request->input('email');
		$password = $request->input('password');
		$password = Hash::make($password);
		$pass = $request->input('password');
		$data_user = ['name' => $name,'email'=>$email,'password'=>$password,'pass'=>$pass];

		Session::put('data_user', $data_user);
		return view('registro');
	}
	public function final_steps(Request $request)
	{	
		if(Session::has('data_user')){
			$messages = [
				'required' => 'El campo :attribute es requerido',
			    'dia.numeric'    => 'El campo :attribute es numérico',
			    'dia.numeric'    => 'El campo :attribute es numérico',
			    'dia.numeric'    => 'El campo :attribute es numérico',
			];
			$v = Validator::make($request->all(), [
		        'dia' => 'required|numeric',
		        'mes' => 'required|numeric',
		        'anio' => 'required|numeric',
		        'genero' => 'required',
		        'pais' => 'required',
		        'provincia' => 'required',
		        'municipio' => 'required',
		    ],$messages);

		    if ($v->fails())
		    {	
		        return redirect()->back()->withErrors($v, 'register');
		    }


		    $dia = (int) $request->input('dia');
		    $mes = (int) $request->input('mes');
		    $anio = (int) $request->input('anio');
		    $genero = $request->input('genero');
		    $pais = $request->input('pais');
		    $provincia = $request->input('provincia');
		    $municipio = $request->input('municipio');
		    if (!($dia <= 0 || $dia > 31)) {
		    	if (!($mes <= 0 || $mes > 12)) {
		    		if ($anio > date("Y")-100 || $anio < date("Y")) {
		    			if (!checkdate ($mes, $dia,$anio)){
		    				flash('La fecha no es valida.', 'danger');
		    				return redirect('data_users');
		    			}
		    		}
		    	}else{
		    		flash('La fecha no es valida.', 'danger');
		    		return redirect('data_users');
		    	}
		    }else{
		    	flash('La fecha no es valida.', 'danger');
		    	return redirect('data_users');
		    }
		    $role = ['role' => 0];

		    $data_user = Session::get('data_user');

		    $data_user = array_merge($data_user, $role);
		    $resultado = array_merge($data_user, $request->all());
		    Session::put('data_user', $resultado);
		   

		   	return view('users_steps_final');
		}else{
		    return redirect('/');
		}
	}
	public function celebridad_social(Request $request)
	{
		if(Session::has('data_user')){
			$v = Validator::make($request->all(), [
		        'apodo' => 'required|min:3',
		        'dia' => 'required|numeric',
		        'mes' => 'required|numeric',
		        'anio' => 'required|numeric',
		        'genero' => 'required',
		        'pais' => 'required',
		        'provincia' => 'required',
		        'municipio' => 'required',
		    ]);

		    if ($v->fails())
		    {	
		        return redirect('datos_celebridad')->withErrors($v, 'register')->withInput();
		    }

		    $apodo = $request->input('apodo');
		    $dia = (int) $request->input('dia');
		    $mes = (int) $request->input('mes');
		    $anio = (int) $request->input('anio');
		    $genero = $request->input('genero');
		    $pais = $request->input('pais');
		    $provincia = $request->input('provincia');
		    $municipio = $request->input('municipio');
		    if (!($dia <= 0 || $dia > 31)) {
		    	if (!($mes <= 0 || $mes > 12)) {
		    		if ($anio > date("Y")-100 || $anio < date("Y")) {
		    			if (!checkdate ($mes, $dia,$anio)){
		    				flash('La fecha no es valida.', 'danger');
		    				return redirect('datos_celebridad');
		    			}
		    		}
		    	}else{
		    		flash('La fecha no es valida.', 'danger');
		    		return redirect('datos_celebridad');
		    	}
		    }else{
		    	flash('La fecha no es valida.', 'danger');
		    	return redirect('datos_celebridad');
		    }

		    $role = ['role' => 1];

		    $data_user = Session::get('data_user');

		    $data_user = array_merge($data_user, $role);
		    $resultado = array_merge($data_user, $request->all());
		    Session::put('data_user', $resultado);

		   	return view('final_celebridad');
		}else{
			return redirect('/');
		}
	}

	public function empresaSocial(Request $request)
	{
		if(Session::has('data_user')){

			$messages = [
				'responsable_empresa.required' => 'El nombre del responsable es obligatorio',
				'email_empresa.required' => 'El email del responsable obligatorio',
				'dia.required' => 'El día es obligatorio',
				'mes.required' => 'El mes es obligatorio',
				'anio.required' => 'El año es obligatorio',
				'genero.required' => 'El genero es obligatorio',
				'pais.required' => 'El país es obligatorio',
				'provincia.required' => 'La provincia es obligatoria',
				'municipio.required' => 'El municipio es obligatorio',
				'empresa.required' => 'El nombre de la empresa es obligatorio',
				'alias.required' => 'El alías de la empresa es obligatorio',
				'dni.required' => 'El DNI de la empresa es obligatorio',
				'empresa_comercio.required' => 'El comercio de la empresa es obligatorio',
				'paiscorp.required' => 'El país al que pertenece la empresa es obligatorio',
				'provinciacorp.required' => 'La provincia a la que pertenece la empresa es obligatoria',
				'municipiocorp.required' => 'El municipio a la que pertenece la empresa es obligatorio',
				'dia.numeric' => 'El día debe ser númerico',
				'mes.numeric' => 'El mes debe ser númerico',
				'anio.numeric' => 'El año debe ser númerico',
				'email_empresa.unique' => 'El email del responsable existe',
			];
			$v = Validator::make($request->all(), [
		        'responsable_empresa' => 'required',
		        'email_empresa' => 'required|email|unique:empresas,email_responsable',
		        'dia' => 'required|numeric',
		        'mes' => 'required|numeric',
		        'anio' => 'required|numeric',
		        'genero' => 'required',
		        'pais' => 'required',
		        'provincia' => 'required',
		        'municipio' => 'required',
		        'empresa' => 'required',
		        'alias' => 'required',
		        'dni' => 'required',
		        'empresa_comercio' => 'required',
		        'paiscorp' => 'required',
		        'provinciacorp' => 'required',
		        'municipiocorp' => 'required',
		    ],$messages);

		    if ($v->fails())
		    {	
		        return redirect()->back()->withErrors($v, 'register');
		    }

		    //DATOS EMPRESA

		    $empresa = $request->input('empresa');
		    $alias = $request->input('alias');
		    $dni = $request->input('dni');
		    $empresa_comercio = (int)$request->input('empresa_comercio');
		    $empresa_pais = $request->input('empresa_pais');
		    $empresa_provincia = $request->input('empresa_provincia');
		    $empresa_municipio = $request->input('empresa_municipio');


		    //Datos fecha 
		   	$dia = (int) $request->input('dia');
		    $mes = (int) $request->input('mes');
		    $anio = (int) $request->input('anio');
		    $genero = $request->input('genero');
		    $pais = $request->input('pais');
		    $provincia = $request->input('provincia');
		    $municipio = $request->input('municipio');
		    if (!($dia <= 0 || $dia > 31)) {
		    	if (!($mes <= 0 || $mes > 12)) {
		    		if ($anio > date("Y")-100 || $anio < date("Y")) {
		    			if (!checkdate ($mes, $dia,$anio)){
		    				flash('La fecha no es valida.', 'danger');
		    				return redirect('data_users');
		    			}
		    		}
		    	}else{
		    		flash('La fecha no es valida.', 'danger');
		    		return redirect('data_users');
		    	}
		    }else{
		    	flash('La fecha no es valida.', 'danger');
		    	return redirect('data_users');
		    }
		    $role = ['role' => 2];

		    $data_user = Session::get('data_user');

		    $data_user = array_merge($data_user, $role);
		    $resultado = array_merge($data_user, $request->all());
		    Session::put('data_user', $resultado);
		   	

		   	return view('final_empresa');
		}else{
			return redirect('/');
		}
	}

}
