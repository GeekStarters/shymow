<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Category_product;
use App\Product;
use App\Images_product;
use App\Http\Controllers\Controller;
use DB;
use App\Type_send_product;
use Validator;
use Input;
use Illuminate\Http\Request;
use Session;
use App\Countrie;
use Auth;
use Hash;
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
	    			$product = new Product();
		    			$product->title = session('producto')['title'];
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

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
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

	    return view('logueado.informacion_producto');
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
			    $file = $request->file('oneImage');
			    $fileName  = time() . '-' . $file->getClientOriginalName();
			    $destinationPath = 'img/productos/';
			    $request->file('oneImage')->move($destinationPath, $fileName);
			    $fullDestinationPath = $destinationPath.$fileName;

			    $oneDataImage = [$fileName,$fullDestinationPath];
			    session::push('informacion-producto.dataOneImage', $oneDataImage);
			}
		}

		if ($request->hasFile('twoImage'))
		{
			if ($request->file('twoImage')->isValid())
			{
			    $file = $request->file('twoImage');
			    $fileName  = time() . '-' . $file->getClientOriginalName();
			    $destinationPath = 'img/productos/';
			    $request->file('twoImage')->move($destinationPath, $fileName);
			    $fullDestinationPath = $destinationPath.$fileName;

			    $oneDataImage = [$fileName,$fullDestinationPath];
			    session::push('informacion-producto.dataTwoImage', $oneDataImage);
			}
		}

		if ($request->hasFile('threeImage'))
		{
			if ($request->file('threeImage')->isValid())
			{
			    $file = $request->file('threeImage');
			    $fileName  = time() . '-' . $file->getClientOriginalName();
			    $destinationPath = 'img/productos/';
			    $request->file('threeImage')->move($destinationPath, $fileName);
			    $fullDestinationPath = $destinationPath.$fileName;

			    $oneDataImage = [$fileName,$fullDestinationPath];
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
		if (session::has('configuracion_shymow_shop')) {
			$codes = DB::select('SELECT * FROM `code_phones`');
			$countries = Countrie::all()->lists('name','id');
            return view('logueado.config-shymow-shop',compact('codes','countries'));
        }else{
            return redirect('identificate');
        }
	}

	public function processorGeneralConfig(Request $request){
		$data = $request->all();
		$messages = [
			'nombre.required' => 'Su nombre es requerido',
			'apellido.required' => 'Su apellido es requerido',
			'apellido.email' => 'Su email es requerido',
			'faddres.required' => 'Su direccion es requerida',
			'code.required' => 'Su código de area es requerida',
			'cp.required' => 'Su código postal es requerido',
			'celular.integer' => 'Introdusca un número valido',
		];
		$v = Validator::make($data, [
			'nombre' => 'required|min:8',
			'apellido' => 'required|min:8',
			'email' => 'required|email',
			'celular' => 'required|min:7|integer',
			'faddres' => 'required|min:10',
			'laddres' => 'min:10',
			'cp' => 'required',
			'code' => 'required',
			'ciudad' => 'required',
	    ],$messages);

	    if ($v->fails())
	    {
		    return redirect('configurar-shymow-shop')->withErrors($v)->withInput($request->all());
	    }
	}

	public function outShymowShop(){
		if (Session::has('configuracion_shymow_shop'))
		{
		    Session::forget('configuracion_shymow_shop');
		}

		return redirect('perfil');
	}

}
