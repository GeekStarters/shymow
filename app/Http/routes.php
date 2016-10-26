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
    Route::get('/tendencia/{name}','InsideController@tendencia');
    Route::get('shymow-shop','ShymowShop@shymowView');
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

    Route::get('buy-product/{id}','ShymowShop@buyView');



    //CONFIGURAR SHYMOW SHOP

    Route::get('identificate',function(){
        return view('logueado.identificate');
    });
    Route::get('out-config-shymow-shop','ShymowShop@outShymowShop');
    Route::post('validacion','ShymowShop@validacion');
    Route::post('processor_general_config','ShymowShop@processorGeneralConfig');
    Route::post('processor_notification_config','ShymowShop@processorNotificationConfig');
    Route::post('create_store','ShymowShop@createNewStore');
    Route::get('configurar-shymow-shop','ShymowShop@generalConfigure');
    Route::get('notification_shop','ShymowShop@notificationShop');
    Route::get('close_shop','ShymowShop@closeShop');
    Route::get('buy_cancel','ShymowShop@buyCancel');
    Route::get('buy_success','ShymowShop@buySuccess');
    Route::get('success_buy','ShymowShop@successBuy');

    //Traer comentarios
    Route::get('/get_comment/{id}','PostController@getComment');

    //Crear comentario.
    Route::post('/create_comment/{id}','PostController@createComment');

    //Crear like.
    Route::post('/create_like/{post}','PostController@createLike');

    //Crear calificacion.
    Route::post('/create_qualification/{post_id}/{quaification}','PostController@createQualification');


    //Compartir view post.
    Route::get('/share_post/{post_id}/{id_user}','PostController@sharePost');

    //crear post compartido.
    Route::post('/create_share_post/','PostController@createSharePost');
    //Seguir post.
    Route::post('/follow_post','PostController@followPost');



    Route::get('/search_typeahead','InsideController@typeaSearch');

});