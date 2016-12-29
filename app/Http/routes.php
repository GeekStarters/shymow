<?php
use App\Countrie;
use App\Interest;
use App\Type_send_product;
use App\Perfil;
use App\BusinessCategories;
use App\BusinessSubCategories;
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
Route::get('500', function()
{
    abort(500);
});
Route::controllers([
   'password' => 'Auth\PasswordController',
]);
route::get('forgot_password',function(){
    return view('auth.password');
});
Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'UsersDatas@confirm'
]);
Route::get("error",function(){
    return view('errors.500');
});
// SOCIAL LOGIN
Route::get('social/login/redirect/{provider}', ['uses' => 'Auth\AuthController@redirectToProvider', 'as' => 'social.login']);
Route::get('social/login/{provider}', 'Auth\AuthController@handleProviderCallback');

//SITIO
Route::get('/',function(){
    
    $countries = Countrie::lists('name','id');
    $interest = Interest::lists('name','id');
    $users = Perfil::where('active',true)
                    ->orderBy('id','DESC')->take(10)->get();
    $socialNet = ['facebook','twitter','linkedin','youtube','pinterest','instagram'];

    $subCategories = BusinessSubCategories::lists('name','id');
    $categories = BusinessCategories::lists('name','id');
    return view('home',compact('countries','interest','users','socialNet','subCategories','categories'));
});
Route::get('condiciones','NavigationController@condiciones');
Route::get('nosotros','NavigationController@nosotros');
Route::get('faq','NavigationController@faq');
Route::get('contacto','NavigationController@contacto');
Route::get('politicas_privacidad','NavigationController@politicasPrivacidad');
Route::get('politicas_cookie','NavigationController@politicasCookie');
Route::get('contratacion_premium','NavigationController@contratacionPremium');
Route::get('view_user/{name?}','NavigationController@viewUser');
//Ruta para retorno de ciudad y estado por medio de ajax
Route::get('state/{id}','NavigationController@state');
Route::get('city/{id}','NavigationController@city');
//Fin

Route::post('registro','RegistroController@store');
Route::get('registro','HomeController@registro');

// Registro Usuarios
Route::get('users','HomeController@users');
Route::get('data_users','HomeController@dataUser');
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
Route::get('searchAll','SearchController@getSearchData');

// Login
Route::post('login','AuthenticationController@index');

Route::group(['middleware' => 'auth'], function()
{
    Route::get('favoritos','InsideController@favorites');
    Route::get('tendencias','InsideController@tendencias');

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

    Route::group(['middleware' => 'out_user'], function()
    {
        //CONFIGURAR SHYMOW SHOP
    
        Route::get('identificate',function(){
            return view('logueado.identificate');
        });
        Route::group(['middleware' => 'have_store'], function()
        {
            //Shymow Shop
            Route::get('agregar-producto','ShymowShop@index');
            Route::get('buscar-categorias/{id}','ShymowShop@ajaxCategories');
            Route::post('informacion-producto','ShymowShop@informacionProducto');
            Route::get('informacion-producto-pro','ShymowShop@informacionProductoPro');
            Route::post('envio-producto','ShymowShop@envioProducto');
            Route::post('crear-producto','ShymowShop@create');

            Route::group(['middleware' => 'identificate_store'], function()
            {
                Route::get('close_shop','ShymowShop@closeShop');
                Route::get('notification_shop','ShymowShop@notificationShop');
                Route::post('desactive_store','ShymowShop@desactiveStore');
            });
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
        });
    });
    Route::get('buy-product/{id}','ShymowShop@buyView');


    Route::post('validacion','ShymowShop@validacion');
    Route::get('buy_success','ShymowShop@buySuccess');
    Route::get('success_buy','ShymowShop@successBuy');
    Route::get('buy_cancel','ShymowShop@buyCancel');

    Route::group(['middleware' => 'identificate_store'], function()
    {
        Route::get('configurar-shymow-shop','ShymowShop@generalConfigure');
        Route::post('processor_general_config','ShymowShop@processorGeneralConfig');
        Route::post('processor_notification_config','ShymowShop@processorNotificationConfig');
        Route::get('out-config-shymow-shop','ShymowShop@outShymowShop');
        Route::get('active_store','ShymowShop@activeStore');
    });

    //Traer comentarios
    Route::get('/get_comment/{id}','PostController@getComment');
    Route::get('/get_comment-product/{id}','ShymowShop@getComment');

    //Crear comentario.
    Route::post('/create_comment/{id}','PostController@createComment');
    Route::post('/create_comment-product/{id}','ShymowShop@createComment');

    //Crear like.
    Route::post('/create_like/{post}','PostController@createLike');
    Route::post('/create_like_user/{post}','PerfilController@createLike');

    //Crear like product.
    Route::post('/create_like_product/{post}','ShymowShop@likeProduct');

    //Crear calificacion.
    Route::post('/create_qualification/{post_id}/{quaification}','PostController@createQualification');
    //Crear calificacion producto.
    Route::post('/create_qualification_product/{post_id}/{quaification}','ShymowShop@qualificationProduct');
    //Crear calificacion.
    Route::post('/create_qualification_user/{post_id}/{quaification}','PerfilController@createQualification');

    //Compartir view post.
    Route::get('/share_post/{post_id}/{id_user}','PostController@sharePost');
    //Compartir view product.
    Route::get('/share_product/{product_id}/{id_user}','ShymowShop@shareProduct');
    //Compartir usuario
    Route::get('/share_user/{id_user}','PerfilController@shareUser');

    //crear post compartido.
    Route::post('/create_share_product/','ShymowShop@createShareProduct');
    Route::post('/create_share_post/','PostController@createSharePost');
    Route::post('/create_share_user/','PerfilController@createShareUser');
    //Seguir post.
    Route::post('/follow_post','PostController@followPost');
    //Eliminar post
    Route::get('/delete_post/{post}','PostController@deletePost')->where('id', '[0-9]+');
    Route::get('/delete_product/{post}','ShymowShop@deleteProduct')->where('id', '[0-9]+');



    Route::get('/search_typeahead','InsideController@typeaSearch');
    Route::post('/delete_networks','PerfilController@destroyNetwork');

    Route::post('/add_networks','PerfilController@createNetwork');

    // CHAT
    Route::get('/messages','MessagesController@index');
    // Ajax new messaje
    Route::get('/create_new_message','MessagesController@store');
    // New Message Form
    Route::post('/new_message_form','MessagesController@create');

    //Cambiar el estado de vistos
    Route::post('/change_read','MessagesController@changeRead');

    //Get all messages chat
    Route::get('/all_messages','MessagesController@allMesagess');

    //Get All Chat Channel
    Route::get('/channels','MessagesController@channels');

    Route::post('set_message','MessagesController@setMessage');

    //Get All Chat Channel
    Route::get('/data_user','MessagesController@getUser');

    //Edit profile img
    Route::get('/edit_img_user','PerfilController@editImg');
    Route::get('/edit_img_cover','PerfilController@editCover');
    Route::post('/uploadProfileImg','PerfilController@uploadProfileImg');
    Route::post('/uploadCoverImg','PerfilController@uploadCoverImg');
    Route::post('/edit_data_profile','PerfilController@editDataProfile');
    Route::post('/editBorn','PerfilController@editBorn');
    Route::post('/editHome','PerfilController@editHome');
    Route::post('/edit_hobbies','PerfilController@editHobbies');


    //Friends
    Route::get('/all_users','FriendsController@index');
    //Add Friends
    Route::get('/add_friends/{id?}','FriendsController@create');
    // Users online friends
    Route::get('/online','FriendsController@online');
    // Users online friends detail
    Route::get('/online_detail/{id}','FriendsController@onlineDetail');

    Route::get('/accept_friends/{id?}','FriendsController@acceptFriends');

    //Add Local
    Route::post('/add_local','PerfilController@addLocal');

    //View Local
    Route::get('/view_local/{address?}/{lat?}/{lng?}','PerfilController@viewLocal');

    //Delete local
    Route::get('/delete_local/{address?}/{lat?}/{lng?}','PerfilController@delete_local');

    //Notification register
    Route::get('/notification_channel','NotificationController@registerChannel');
    //Notification identificate user
    Route::get('/save_notification','NotificationController@saveNotification');
    //Notification get messages
    Route::get('/notifyGetMessages','NotificationController@notifyGetMessages');

    Route::get('identificate_perfil',function(){
        return view('logueado.identificate_perfil');
    });


    // Autentificar user editar perfil
    Route::post('/validacion_perfil','PerfilController@validacion');
    // delete session
    Route::get('/out_edit_profile','PerfilController@outEditData');
    
    Route::group(['middleware' => 'edit_profile'], function()
    {
        //Edit profile
        Route::get('/edit-profile','PerfilController@editProfile');

        //Save general data profile
        Route::post('/save-general-profile','PerfilController@saveGeneralProfile');

        // Edit security
        Route::get('/edit-security','PerfilController@editSecurity');

        // Save new password
        Route::post('/save-password','PerfilController@savePass');

        //recover password
        Route::post('/recover-password','PerfilController@recoverPass');

        //desabilited user
        Route::post('/desabilited-user','PerfilController@desabilitedUser');

        //Notification
        Route::get('/notification','NotificationController@index');

        //Save config notification
        Route::post('/save_config_notification','NotificationController@saveConfNotification');
    });

    // My notifications
    Route::get('my_notifications','NotificationController@myNotifications');
    // My notifications type
    Route::get('get_notification_type','NotificationController@getNotificationType');
    //DELETE My notifications
    Route::post('delete_notification','NotificationController@deleteNotification');

    //Solicitudes amistad
    Route::get('solicitude_friendship','FriendsController@friendship');
});