<?php
use App\Countrie;
use App\Interest;
use App\Type_send_product;
use Session as session;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// SOCIAL LOGIN
Route::get('social/login/redirect/{provider}', ['uses' => 'Auth\AuthController@redirectToProvider', 'as' => 'social.login']);
Route::get('social/login/{provider}', 'Auth\AuthController@handleProviderCallback');

//SITIO
Route::get('/',function(){
    $countries = Countrie::lists('name','id');
    $interest = Interest::lists('name','id');
    return view('home',compact('countries','interest'));
});
Route::get('nosotros','NavigationController@nosotros');
Route::get('faq','NavigationController@faq');
Route::get('contacto','NavigationController@contacto');

//Ruta para retorno de ciudad y estado por medio de ajax
Route::get('state/{id}','NavigationController@state');
Route::get('city/{id}','NavigationController@city');
//Fin

Route::post('registro','RegistroController@store');
Route::get('registro','HomeController@registro');

// Registro Usuarios
Route::get('users','HomeController@users');
Route::get('data_user','HomeController@dataUser');
Route::post('final_steps','RegistroController@final_steps');
Route::get('final_steps','HomeController@final_steps');
Route::post('create_user','RegistroController@create');


//Registro celebridad
Route::get('celebridad','HomeController@celebridad');
Route::get('datos_celebridad','HomeController@dataCelebridad');
Route::post('celebridad_social','RegistroController@celebridad_social');
Route::get('celebridad_social','HomeController@celebridad_social');
//Registro Empresa

Route::get('empresa','HomeController@empresa');
Route::get('datos_empresa','HomeController@dataEmpresa');
Route::post('empresa_social','RegistroController@empresaSocial');
Route::get('empresa_social','HomeController@empresaSocial');

Route::post('headsearch','SearchController@getAjaxUser');


// Login
Route::post('login','AuthenticationController@index');

Route::group(['middleware' => 'auth'], function()
{
    Route::get('favoritos',function()
    {
    	return view('logueado.favoritos');
    });
    Route::get('tendencias','InsideController@tendencias');

    Route::get('envio-producto',function(){
        if (session::has('informacion-producto')) {  
            $types = Type_send_product::all(); 
            return view('logueado.informacion_envio_producto',compact('types'));
        }else{
            return redirect('informacion-producto');
        }
    });
    Route::get('ayuda_shop',function(){
        return view('logueado.ayuda_shop');
    });
    Route::get('politicas_shop',function(){
        return view('logueado.politicas_shop');
    });
    Route::get('informacion-producto',function(){
        if (session::has('producto')) {  
            return view('logueado.informacion_producto');
        }else{
            return redirect('agregar-producto');
        }
    });
    Route::get('tendencia/{name}','InsideController@tendencia');
    Route::get('shymow-shop',function(){
        return view('logueado.shymow-shop');
    });
    Route::get('amigos','InsideController@amigos');
    Route::get('perfil','InsideController@perfil');

    Route::post('create_perfil_post','PostController@create');
    Route::get('logout', function()
    {
    	Auth::logout();
    	return redirect('/');
    });
    Route::get('busqueda_inicio','SearchController@show');



    //Shymow Shop

    Route::get('agregar-producto','ShymowShop@index');
    Route::get('buscar-categorias/{id}','ShymowShop@ajaxCategories');
    Route::post('informacion-producto','ShymowShop@informacionProducto');
    Route::post('envio-producto','ShymowShop@envioProducto');
    Route::post('crear-producto','ShymowShop@create');



    //CONFIGURAR SHYMOW SHOP

    Route::get('identificate',function(){
        return view('logueado.identificate');
    });
    Route::get('out-config-shymow-shop','ShymowShop@outShymowShop');
    Route::post('validacion','ShymowShop@validacion');
    Route::post('processor_general_config','ShymowShop@processorGeneralConfig');
    Route::get('configurar-shymow-shop','ShymowShop@generalConfigure');
});