<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Category_product;
use App\Product;
use App\Images_product;
use App\Http\Controllers\Controller;
use DB;
use App\Type_send_product;
use App\Store;
use App\disableStore;
use App\Order;
use App\Notification_settings_store;
use App\options_desactives_store;
use Validator;
use Input;
use Illuminate\Http\Request;
use Session;
use App\Countrie;
use Auth;
use Hash;
use Image;
class ShymowShop extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categorys = Category_product::all();
		return view('logueado.agregar-producto',compact('categorys'));
	}
	public function shymowView(){
		$products = DB::select('SELECT images_products.path, images_products.name, images_products.active,products.id,products.title,products.description,products.price,products.stock,products.qualification,products.like,products.share,products.comments,products.profile_id FROM `products` LEFT JOIN images_products on images_products.product_id = products.id  WHERE products.active = true GROUP BY products.id ORDER BY products.id DESC LIMIT 5');
		// dd($products);	
		$count_data = count($products);
		return view('logueado.shymow-shop',compact('products','count_data'));
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		$type = $request->all();
		$messages = [
		    'required'    => 'Seleccione un tipo de envio',
		    'digits_between' 		  => 'Porfavor seleccione un campo'
		];
		$v = Validator::make($type, [
			'send-product' => 'required|digits_between:1,3',
	    ],$messages);

	    if ($v->fails())
	    {
		    return redirect('envio-producto')->withErrors($v)->withInput($request->all());
	    }
	    if (session::has('producto')) {
	    	if (session::has('informacion-producto')) {
	    		try {
	    			switch (session('informacion-producto')['garantia']) {
	    				case 'true':
	    					$garantia = true;
	    					break;
	    				case 'false':
	    					$garantia = false;
	    					break;
	    				
	    				default:
	    					$garantia = true;
	    					break;
	    			}
	    			$store_id = Store::userStore(Auth::user()->id)->first();
	    			$count_data = count($store_id);
	    			if($count_data > 0){
		    			$product = new Product();
			    			$product->title = session('producto')['title'];
			    			$product->store_id = $store_id->id;
			    			$product->category_product_id = session('producto')['category'];
			    			$product->type_product_id = session('producto')['type'];
			    			$product->first_spesification_id = session('producto')['first-spesification'];
			    			$product->last_spesification_id = session('producto')['last-spesification'];
			    			$product->description = session('informacion-producto')['description'];
			    			$product->price = session('informacion-producto')['precio'];
			    			$product->stock = session('informacion-producto')['stock'];
			    			$product->garantia = $garantia;
			    			$product->send_type = $request->input('send-product');
			    		$product->save();

			    		if (session::has('informacion-producto.dataOneImage')) {
			    			$imageRoot = session('informacion-producto')['dataOneImage'][0];

			    			$newImage = new Images_product();
			    				$newImage->name = $imageRoot[0];
			    				$newImage->path = $imageRoot[1];
			    				$newImage->product_id = $product->id;
			    			$newImage->save();

			    		}
			    		if (session::has('informacion-producto.dataTwoImage')) {
			    			$imageRoot = session('informacion-producto')['dataTwoImage'][0];

			    			$newImage = new Images_product();
			    				$newImage->name = $imageRoot[0];
			    				$newImage->path = $imageRoot[1];
			    				$newImage->product_id = $product->id;
			    			$newImage->save();
			    		}
			    		if (session::has('informacion-producto.dataThreeImage')) {
			    			$imageRoot = session('informacion-producto')['dataThreeImage'][0];

			    			$newImage = new Images_product();
			    				$newImage->name = $imageRoot[0];
			    				$newImage->path = $imageRoot[1];
			    				$newImage->product_id = $product->id;
			    			$newImage->save();
			    		}
			    		Session::forget('producto');								
		    			Session::forget('informacion-producto');
			    		return redirect('shymow-shop');
	    			}else{
	    				flash('Debes crear una tienda', 'danger');
	    				return redirect('perfil');
	    			}

	    		} catch (Exception $e) {
	    			Session::forget('producto');								
	    			Session::forget('informacion-producto');
	    			return required('perfil');							
	    		}
	    	}else{
	    		return redirect('informacion-producto');
	    	}
	    }else{
	    	return redirect('agregar-producto');
	    }

	}
	public function buyView($id){
		$products = Product::find($id)->productImage($id)->take(1)->get();
		$count = $products->count();
		$store = Store::userStore(Auth::user()->id)->first();
		// dd($store['original']['email_store']);
		return view('logueado.buy_product',compact('products','count','store'));
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
	}

	public function buySuccess(){
		if ($_GET['tx']) {
            $tx = $_GET['tx'];
            // Init cURL
            $request = curl_init();

            // Set request options
            curl_setopt_array($request, array
            (
              CURLOPT_URL => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
              CURLOPT_POST => TRUE,
              CURLOPT_POSTFIELDS => http_build_query(array
                (
                  'cmd' => '_notify-synch',
                  'tx' => $tx,
                  'at' => '8sZ-2VXDwHC1Q1tHVpt8zOGS3LU-eqiO-IOjbADksh8XTFwvG-4gvuwW3R8',
                )),
              CURLOPT_RETURNTRANSFER => TRUE,
              CURLOPT_HEADER => FALSE,
              // CURLOPT_SSL_VERIFYPEER => TRUE,
              // CURLOPT_CAINFO => 'cacert.pem',
            ));

            // Execute request and get response and status code
            $response = curl_exec($request);
            $status   = curl_getinfo($request, CURLINFO_HTTP_CODE);

            if($status == 200 AND strpos($response, 'SUCCESS') === 0)
            {
                // Remove SUCCESS part (7 characters long)
                $response = substr($response, 7);

                // URL decode
                $response = urldecode($response);

                // Turn into associative array
                preg_match_all('/^([^=\s]++)=(.*+)/m', $response, $m, PREG_PATTERN_ORDER);
                $response = array_combine($m[1], $m[2]);

                // Fix character encoding if different from UTF-8 (in my case)
                if(isset($response['charset']) AND strtoupper($response['charset']) !== 'UTF-8')
                {
                  foreach($response as $key => &$value)
                  {
                    $value = mb_convert_encoding($value, 'UTF-8', $response['charset']);
                  }
                  $response['charset_original'] = $response['charset'];
                  $response['charset'] = 'UTF-8';
                }

                // Sort on keys for readability (handy when debugging)
                ksort($response);

                if (isset($response['handling_amount'])) {
                	$response['handling_amount'] = floatval($response['handling_amount']);
                }
                if (isset($response['mc_gross'])) {
                	$response['mc_gross'] = floatval($response['mc_gross']);
                }
                if (isset($response['shipping'])) {
                	$response['shipping'] = floatval($response['shipping']);
                }
                if (isset($response['mc_fee'])) {
                	$response['mc_fee'] = floatval($response['mc_fee']);
                }
                if (isset($response['payment_fee'])) {
                	$response['payment_fee'] = floatval($response['payment_fee']);
                }
                if (isset($response['payment_gross'])) {
                	$response['payment_gross'] = floatval($response['payment_gross']);
                }

                if (isset($response['quantity'])) {
                	$response['quantity'] = (int) $response['quantity'];
                }
                $newOrder = new Order($response);
                	$newOrder->product_id = (int)$response['item_number'];
                	$newOrder->perfil_id = (int)Auth::user()->id;
                	$newOrder->quantity = (int)$response['quantity'];
                $newOrder->save();

                $product_id = (int)$response['item_number'];
                $data = [
                	"product_id" => $product_id,
                	"order_id" => $newOrder->id
                ];
                Session::put('success_buy', $data);
                return redirect('success_buy');
                
            }else{
            	return redirect('shymow-shop');
            }
        }else{
            return redirect('shymow-shop');
        }
	}

	public function successBuy(){
		if (!Session::has('success_buy'))
		{
		    return redirect('shymow-shop');
		}
		$information = Session::get('success_buy');
		$id = $information['product_id'];
		$order_id = $information['order_id'];
		$products = Product::find($id)->productImage($id)->take(1)->get();
		$count = $products->count();

		$monto = Order::monto($order_id)->first();
		$monto = $monto['original']['mc_gross'];
		// dd($store['original']['email_store']);
		return view('logueado.success_buy',compact('products','count','monto'));

	}
	public function buyCancel(){
		return redirect('shymow-shop');
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

	public function ajaxCategories($id, Request $request){
		$type = $request->input('type');
		//Funcion recorre la consulta
		function travelConsult($consultas){
			if (isset($consultas) && $consultas != null) {
				foreach ($consultas as $consulta) {
					echo '<a href="#" class="list-group-item" data-id="'.$consulta->id.'">'.$consulta->name.'</a>';
				}
			}else{
				echo '<a href="#" data-id="" class="list-group-item">Intentelo nuevamente</a>';
			}
		}
		if (isset($id)) {
			$id = (int) $id;
			if ($id > 0) {
				$type = $request->input('type');
				if (isset($type)) {
					switch ($type) {
						case 'product_type':
							$categorys = DB::select('SELECT * FROM `type_products` WHERE category_product_id = "'.$id.'"');
							travelConsult($categorys);
							break;
						case 'first-spesification':
							$categorys = DB::select('SELECT * FROM `first_spesifications` WHERE `type_product_id` = "'.$id.'"');
							travelConsult($categorys);
							break;
						case 'last-spesification':
							$categorys = DB::select('SELECT * FROM `last_spesifications` WHERE `first_spesification_id` = "'.$id.'"');
							travelConsult($categorys);
							break;
						default:
							echo '<a href="#" data-id="" class="list-group-item" data-id="">Intentelo nuevamente</a>';
							break;
					}
				}else{
					echo '<a href="#" data-id="" class="list-group-item" data-id="">Intentelo nuevamente</a>';
				}
			}else{
				echo '<a href="#" data-id="" class="list-group-item" data-id="">Intentelo nuevamente</a>';
			}
		}else{
			echo '<a href="#" data-id="" class="list-group-item" data-id="">Intentelo nuevamente</a>';
		}
	}

	public function informacionProductoPro(){
		return view('logueado.informacion_producto');
	}
	public function informacionProducto(Request $request){
		$producto = $request->all();
		$messages = [
			'title.required' => 'El titulo del producto es necesario',
		    'category.required'    => 'Seleccione una categoria para su producto',
		    'type.required'    => 'Seleccione un tipo de producto',
		    'required'    => 'Seleccione sub categorias para su producto',
		];
		$v = Validator::make($producto, [
			'title' => 'required',
			'category' => 'required',
			'type' => 'required',
			'first-spesification' => 'required',
			'last-spesification' => 'required',
	    ],$messages);

	    if ($v->fails())
	    {
	  
		    return redirect('agregar-producto')->withErrors($v)->withInput($request->only('title'));

	    }
	    Session(['producto' => $request->all()]);

	    return redirect('informacion-producto-pro');
	}

	public function envioProducto(Request $request){
		$informacion = $request->all();
		$messages = [
			'description.required' => 'Se requiere una descripción',
		    'precio.required'    => 'Inserte un precio valido',
		    'stock.required'    => 'Introdusca una cantidad de unidades',
		    'image'    => 'Introdusca formato de imagenes validos: png, jpg',
		    'required'    => 'Imagenes y datos requeridos',
		];
		$v = Validator::make($informacion, [
			'description' => 'required',
			'precio' => 'required',
			'stock' => 'required',
			'garantia' => 'required',
			'oneImage' => 'required| image',
			'twoImage' => 'image',
			'threeImage' => 'image',
	    ],$messages);

	    if ($v->fails())
	    {	
	        return redirect('informacion-producto')->withErrors($v)->withInput($request->except(['oneImage','twoeImage','threeImage']));
	    }

	    session(['informacion-producto' => $request->except(['oneImage','twoImage','threeImage'])]);

	    if ($request->hasFile('oneImage'))
		{
			if ($request->file('oneImage')->isValid())
			{
				$img = Input::file('oneImage');
			    $filename  = time() . '.' . $img->getClientOriginalExtension();
			    $path = public_path('img/productos/' . $filename);
			    $fullDestinationPath = 'img/productos/'.$filename;
				Image::make( $img->getRealPath() )->resize(320,220)->save($path);

			    // $file = $request->file('oneImage');
			    // $fileName  = time() . '-' . $file->getClientOriginalName();
			    // $destinationPath = 'img/productos/';
			    // $request->file('oneImage')->move($destinationPath, $fileName);
			    // $fullDestinationPath = $destinationPath.$fileName;

			    $oneDataImage = [$filename,$fullDestinationPath];
			    session::push('informacion-producto.dataOneImage', $oneDataImage);
			}
		}

		if ($request->hasFile('twoImage'))
		{
			if ($request->file('twoImage')->isValid())
			{
				$img = Input::file('twoImage');
			    $filename  = time() . '.' . $img->getClientOriginalExtension();
			    $path = public_path('img/productos/' . $filename);
			    $fullDestinationPath = 'img/productos/'.$filename;
				Image::make( $img->getRealPath() )->resize(320,220)->save($path);
			    // $file = $request->file('twoImage');
			    // $fileName  = time() . '-' . $file->getClientOriginalName();
			    // $destinationPath = 'img/productos/';
			    // $request->file('twoImage')->move($destinationPath, $fileName);
			    // $fullDestinationPath = $destinationPath.$fileName;

			    $oneDataImage = [$filename,$fullDestinationPath];
			    session::push('informacion-producto.dataTwoImage', $oneDataImage);
			}
		}

		if ($request->hasFile('threeImage'))
		{
			if ($request->file('threeImage')->isValid())
			{
				$img = Input::file('threeImage');
			    $filename  = time() . '.' . $img->getClientOriginalExtension();
			    $path = public_path('img/productos/' . $filename);
			    $fullDestinationPath = 'img/productos/'.$filename;
				Image::make( $img->getRealPath() )->resize(320,220)->save($path);
			    // $file = $request->file('threeImage');
			    // $fileName  = time() . '-' . $file->getClientOriginalName();
			    // $destinationPath = 'img/productos/';
			    // $request->file('threeImage')->move($destinationPath, $fileName);
			    // $fullDestinationPath = $destinationPath.$fileName;

			    $oneDataImage = [$filename,$fullDestinationPath];
			    session::push('informacion-producto.dataThreeImage', $oneDataImage);
			}
		}
		$types = Type_send_product::all();
		return view('logueado.informacion_envio_producto',compact('types'));
	}

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
			'password' => 'required',
	    ],$messages);

	    if ($v->fails())
	    {
		    return redirect('identificate')->withErrors($v)->withInput($request->all());
	    }
		if(Hash::check($request->input('password'),$user->password)) {
			Session::put('configuracion_shymow_shop', true);
			if (session::has('configuracion_shymow_shop'))
			{
        		return redirect('configurar-shymow-shop');
			}
   		}else{
   			return redirect('identificate');
   		}

	}
	public function generalConfigure(){
		$codes = DB::select('SELECT * FROM `code_phones`');
		$countries = Countrie::all()->lists('name','id');
		$store = Store::where('profile_id','=',Auth::id())->first();
		$myCountry = [];
		$myCode = [];
		if (count($store) > 0) {
			$myCountry = DB::select('SELECT * FROM `countries` WHERE name = "'.$store->pais.'"');
			$myCode = DB::select('SELECT * FROM `code_phones` WHERE phonecode = "'.$store->code_phone.'"');
			if (count($myCode) > 0) {
				$myCode = $myCode[0];
			}
		}
        return view('logueado.config-shymow-shop',compact('codes','countries','store','myCountry','myCode'));
	}
	public function processorNotificationConfig(Request $request){
		$data = $request->all();
		$messages = [
			'sale.required' => 'Notificación de venta efectuada requerdida',
			'label.required' => 'Notificación sobre etiquetas requerida',
			'share.required' => 'Notifiación sobre compartir requerida',
			'like.required' => 'Notificación de like en productos requerida',
			'message.required' => 'Notificación de mensajes requerida',
			'comment.required' => 'Notificación de comentarios requerida',
			'qualification.required' => 'Notifiación de calificación requerida',
			'notificacion_email.required' => 'Notificaciones a email requerida',
			'notificacion_email.integer' => 'Seleccione debidamente las opciones',
		];
		$v = Validator::make($data, [
			'sale' => 'required',
			'label' => 'required',
			'share' => 'required',
			'like' => 'required',
			'message' => 'required',
			'comment' => 'required',
			'qualification' => 'required',
			'notificacion_email' => 'required|integer',
	    ],$messages);

	    if ($v->fails())
	    {
		    return redirect()->back()->withErrors($v)->withInput($request->all());
	    }
	    function validateBool($data){
			if($data == "true"){
				return true;
			}else{
				return false;
			}
		}
	    $sound_notification = validateBool($request->input('sound_new_notification'));
	    $sound_message = validateBool($request->input('sound_new_message'));
	    $sound_sale = validateBool($request->input('sound_new_sale'));

    	$store = Store::where('profile_id','=',Auth::id())->first();
		if (count($store) > 0) {
			try {
				Notification_settings_store::where('store_id','=',$store->id)->update([
					"store_id" => $store->id,
					"sound_notification" => $sound_notification,
					"sound_new_message" => $sound_message,
					"sound_sale" => $sound_sale,
					"buy_notification" => $request->input('sale'),
					"label_notification" => $request->input('label'),
					"share_notification" => $request->input('share'),
					"like_notification" => $request->input('like'),
					"message_notification" => $request->input('message'),
					"comments_notification" => $request->input('comment'),
					"qualification_notification" => $request->input('qualification'),
					"email_notification" => $request->input('notificacion_email')
				]);

				flash('Configuración de notificaciones guardada', 'success');
	    		return redirect()->back();
			} catch (Exception $e) {
				
			}
		}

	    return redirect('close_shop');
	}
	public function processorGeneralConfig(Request $request){
		$data = $request->all();
		$messages = [
			'nombre.required' => 'Su nombre es requerido',
			'apellido.required' => 'Su apellido es requerido',
			'apellido.email' => 'Su email es requerido',
			'faddress.required' => 'Su direccion es requerida',
			'code.required' => 'Su código de area es requerida',
			'cp.required' => 'Su código postal es requerido',
			'celular.integer' => 'Introdusca un número valido',
		];
		$v = Validator::make($data, [
			'nombre' => 'required|min:1',
			'apellido' => 'required|min:1',
			'email' => 'required|email',
			'celular' => 'required|min:7|integer',
			'faddress' => 'required|min:5',
			'cp' => 'required',
			'code' => 'required',
			'ciudad' => 'required',
	    ],$messages);

	    if ($v->fails())
	    {
		    return redirect('configurar-shymow-shop')->withErrors($v)->withInput($request->all());
	    }

	    function validateBool($data){
			if($data == "true"){
				return true;
			}else{
				return false;
			}
		}

		$country = DB::select('SELECT * FROM countries WHERE id = "'.$request->input('ciudad').'"');

		if (count($country) > 0) {
			$country = $country[0];
		}else{
			flash('Intentlo nuevamente', 'danger');
			return redirect()->back();	
		}
		$store_exist = Store::where('profile_id','=',Auth::id())->first();
		if (count($store_exist) > 0) {
			try {
				$view_ciudad = validateBool($request->input('viewciudad'));
				$view_cp = validateBool($request->input('viewcp'));

				$store = Store::find($store_exist->id);
					$store->profile_id = Auth::user()->id;
					$store->first_name = $request->input('nombre');
					$store->last_name = $request->input('apellido');
					$store->email_store = $request->input('email');
					$store->phone = $request->input('celular');
					$store->address = $request->input('faddress');
					$store->further_office = $request->input('laddress');
					$store->cp = $request->input('cp');
					$store->pais = $country->name;
					$store->code_phone = $request->input('code');
					$store->view_cp = $view_cp;
					$store->view_country = $view_ciudad;
				$store->save();

				flash('Datos guardados', 'success');
				return redirect()->back();
			} catch (Exception $e) {
				flash('Intentlo nuevamente', 'danger');
				return redirect()->back();					
			}
		}else{

			try {
				$view_ciudad = validateBool($request->input('viewciudad'));
				$view_cp = validateBool($request->input('viewcp'));

				$store = new Store();
					$store->profile_id = Auth::user()->id;
					$store->first_name = $request->input('nombre');
					$store->last_name = $request->input('apellido');
					$store->email_store = $request->input('email');
					$store->phone = $request->input('celular');
					$store->address = $request->input('faddress');
					$store->further_office = $request->input('laddress');
					$store->cp = $request->input('cp');
					$store->code_phone = $request->input('code');
					$store->view_cp = $view_cp;
					$store->pais = $country->name;
					$store->view_country = $view_ciudad;
				$store->save();

				$notification_store = new Notification_settings_store();
					$notification_store->store_id = $store->id;
				$notification_store->save();

				flash('Datos guardados', 'success');
				return redirect()->back();
			} catch (Exception $e) {
				flash('Intentlo nuevamente', 'danger');
				return redirect()->back();					
			}
		}
	}

	public function outShymowShop(){
		if (Session::has('configuracion_shymow_shop'))
		{
		    Session::forget('configuracion_shymow_shop');
		}

		return redirect('perfil');
	}

	public function notificationShop(){
		$store = Store::where('profile_id','=',Auth::id())->first();
		if (count($store) > 0) {
			$notify = Notification_settings_store::where('store_id','=',$store->id)->first();
			$opt1 = true;
			$opt2 = true;
			$opt3 = true;
			$opt4 = true;
			if (count($notify)>0) {
				if ($notify->email_notification != "0") {
					$opt1 = false;
					if ($notify->email_notification != "1") {
						$opt2 = false;
					}
					if ($notify->email_notification != "2") {
						$opt3 = false;
					}
					if ($notify->email_notification != "3") {
						$opt4 = false;
					}
				}elseif($notify->email_notification != "1") {
					$opt2 = false;
					if ($notify->email_notification != "0") {
						$opt1 = false;
					}
					if ($notify->email_notification != "2") {
						$opt3 = false;
					}

					if ($notify->email_notification != "3") {
						$opt4 = false;
					}
				}elseif($notify->email_notification != "2") {
					$opt3 = false;
					if ($notify->email_notification != "0") {
						$opt1 = false;
					}
					if ($notify->email_notification != "1") {
						$opt2 = false;
					}

					if ($notify->email_notification != "3") {
						$opt4 = false;
					}
				}
				elseif($notify->email_notification != "3") {
					$opt4 = false;
					if ($notify->email_notification != "0") {
						$opt1 = false;
					}
					if ($notify->email_notification != "1") {
						$opt2 = false;
					}
					
					if ($notify->email_notification != "2") {
						$opt3 = false;
					}
				}
			}
			return view('.logueado.config-notification-shymow-shop',compact('notify','opt1','opt2','opt3','opt4'));
		}
	}
	public function closeShop(){
		$desactives = options_desactives_store::all();
		return view('.logueado.config-close-shop',compact('desactives'));
	}

	public function activeStore(){
		Store::where('profile_id','=',Auth::user()->id)->update(['active'=>true]);
		flash('Cuanta activada', 'success');
		return redirect()->back();
	}
	public function desactiveStore(Request $re){
		$desactives = options_desactives_store::all();
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
				$store = Store::where('profile_id','=',Auth::user()->id)->first();
				$desabilite = new disableStore();
				$desabilite->store_id = $store->id;
				$desabilite->description = $re->input('description');
				$desabilite->reasons = $reasons;
				$desabilite->save();

				Store::where('profile_id','=',Auth::user()->id)->update(['active'=>false]);
				flash()->overlay('Tu cuenta Shymow Shop fue desactivada', Auth::user()->name);
				return redirect('perfil');

			} catch (Exception $e) {
				flash('Intentelo nuevamente', 'danger');
				return redirect()->back();			
			}
		}
	}
}
