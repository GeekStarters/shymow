@extends('layouts.master')

@section('content')
@if(!Auth::check())
<div class="alert alert-warning alert-dismissible cookies" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Advertencia!</strong> Utilizamos cookies propias y de terceros para mejorar nuestros servicios y mostrarle publicidad relacionada con sus preferencias mediante el análisis de sus hábitos de navegación. Si continua navegando, consideramos que acepta su uso. Puede cambiar la configuración u obtener más información <a href="{{url('politicas_cookie')}}">aquí</a>..
</div>
@endif()

@if(Auth::check())

<nav class="nav-shymow">
  <ul class="nav navbar-nav navbar-right">
    <a href="{{url('/')}}">
      <img src="{{url('img/logo.png')}}" alt="shymow" style="max-width:200px; margin-right:20px; margin-left:20px;">
    </a>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="{{ url(Auth::user()->img_profile) }}" alt=""> {{Auth::user()->name}} <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li class="dropdown-submenu">
              <a class="test" tabindex="-1" href="#">Configuración <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li><a href="{{ url('identificate_perfil') }}">Editar perfil</a></li>
              @if(Auth::user()->role == "1" || Auth::user()->role == "2")
                  <li><a tabindex="-1" href="{{url('identificate')}}">Shymow Shop</a></li>
                @endif
              </ul>
            </li>
           <li><a href="{{ url('notification') }}">Notificaciones 
            <span class="notification-g">
            <span class="number-notify-g">
              2
            </span>
          </span>
          </a>
        </li>
         @if(Auth::user()->role == "1" || Auth::user()->role == "2")
           <li><a href="{{ url('agregar-producto') }}">Mi Shymow Shop</a></li>
           @endif
          <li><a href="{{ url('logout') }}">Cerrar sesión</a></li>
        </ul>
      </li>
  </ul>
  <ul class="nav navbar-nav navbar-left" style="margin-right:20px !important; margin-left:20px !important;">
     <!-- Buscador superior -->
    <form class="navbar-form navbar-left" role="search">
      <div class="input-group" id="custom-templates">
        <input id="typesearch" class="typeahead form-control" name="top_search" data-provide="typeahead" placeholder="Search" autocomplete="off" type="text">
        <span class="input-group-addon" id="basic-addon2" style="padding:0;"><button style="border:none;padding:0px;"><img src="{{url('img/search.png')}}" alt="search" width="32" height="32"></button></span>
      </div>
      <a href="{{url('/')}}" class="btn btn-default"><span class="glyphicon glyphicon-home"></span></a href="index.html" class="btn btn-default">
      <a href="{{url('perfil')}}" class="btn btn-default"><span class="glyphicon glyphicon-user"></span></a href="index.html" class="btn btn-default">
    </form>

  </ul>
</nav>
  @endif
  <div class="all">
    <header><img src="img/header.png" alt="Header"></header>

    <div class="clearfix"></div>

    <section class="welcome col-lg-12">
      <img src="img/welcome-hands.png" alt="Hands" class="img-hand">

      <div class="row">

        <div class="col-sm-7 col-md-7">
          <div class="greeting">
            <div class="container">
              @if(Auth::check())
              <p>Felicitaciones,<br>ya eres parte de <br>
                @else
                <p>Bienvenido a la <br>
                  @endif
                  <span class="erashymow">#EraShymow</span>
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-5 col-md-5">
            <div class="row">
              <div class="col-md-9 container-registry">

                @if(!Auth::check())
                <!-- Registro -->
                <section class="registry">
                  <?php if (isset($_GET['users'])): ?>
                    <p class="text-success">
                      <b>{{$_GET['users']}}</b>
                    </p>
                  <?php endif ?>
                  <?php if (isset($_GET['error'])): ?>
                    <p class="text-success">
                      <b>{{$_GET['error']}}</b>
                    </p>
                  <?php endif ?>
                  <p><b style="font-size: 15px;color: #37B4AA !important;font-family:gothamTwo;">Regístrate y ¡sé parte de Shymow!
                  </b>
                </p>
                @foreach ($errors->register->all() as $error)
                <p class="text-danger">
                  <b>{{ $error}}</b>             
                </p>
                @endforeach

                <span id="startS"></span>
                {!! Form::open(array('url' => 'registro','method'=>'post','class' => 'welcome-registry')) !!}
                <div class="form-group">
                  {!! Form::text('name','',['class'=>'form-control', 'placeholder'=>'Nombre y Apellido','required' => 'required']) !!}
                </div>

                <div class="form-group">
                  {!! Form::text('email','',['class'=>'form-control', 'placeholder'=>'Correo Electrónico','required' => 'required']) !!}

                </div>
                <div class="row">
                  <div class="col-md-6">
                    {!! Form::password('password',['class'=>'form-control', 'placeholder'=>'Contraseña','required' => 'required']) !!}
                  </div>
                  {!! Form::submit('Regístrate',['class'=>'butto-formns']) !!}

                  <div class="col-md-12">
                    {!! Form::checkbox('condiciones','true',['required'=>'required']) !!}
                    <span style="color:#37B4AA">Acepto términos y condiciones </span><br>
                    <a href="{{url('condiciones')}}">Condiciones de uso</a>
                  </div>
                </div>
                {!! Form::close() !!}
              </section>
              <div class="clearfix"></div>

              <section class="registry">
                @foreach ($errors->login->all() as $error)
                <p class="text-danger">
                  <b>{{ $error}}</b>             
                </p>
                @endforeach
                {!! Form::open(array('url' => 'login', 'class'=>'welcome-registry')) !!}
                <div class="form-group">
                  {!! Form::text('email','',['class' => 'form-control','placeholder' => 'Correo Electrónico','required']) !!}
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::password('password',['class' => 'form-control','placeholder' => 'Contraseña','required']) !!}
                    </div>
                  </div>
                  <div class="col-md-6">
                    {!! Form::submit('Iniciar sesión',['class'=>'butto-formns']) !!}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12" style="color:#C5C5C5;">
                    {!! Form::checkbox('remember','true',['required'=>'required']) !!}
                    <span style="color:#37B4AA">Recordar mis datos</span>
                    | <a href="#" style="color:#37B4AA;">Olvidé mi contraseña</a>
                  </div>
                </div>

                <br>

                <a href="{{ route('social.login', ['facebook']) }}"><img src="img/facebook.png" alt="Redes"></a>
                <a href="{{ route('social.login', ['google']) }}"><img src="img/google+.png" alt="Redes"></a>
                <a href="{{ route('social.login', ['twitter']) }}"><img src="img/twitter.png" alt="Redes"></a>
                {!! Form::close() !!}
              </section>
              @endif
            </div>
          </div>
        </div>
        <div class="clearfix"></div>

        <div class="col-md-12 welcome-two">
          <div class="col-sm-7 col-md-7">
            <p>Con <span>Shymow</span> tienes a un sólo click perfiles de todo tipo: de tus intereses, personas, comercios, ofertas, personajes y celebridades</p><br>
            <p><b>¿A qué esperas para ser parte de Shymow?</b></p>
          </div>
        </div>
      </div>
    </section>
    <div class="clearfix"></div>
    <!-- Fin welcome -->
    <!-- Slider -->
    <section>
      <div id="carousel-id" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carousel-id" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-id" data-slide-to="1" class=""></li>
          <li data-target="#carousel-id" data-slide-to="2" class=""></li>
        </ol>
        <div class="carousel-inner">
          <div class="item active">
          <img alt="First slide" src="img/slider01.jpg">
          </div>
          <div class="item">
          <img alt="Third slide" src="img/slider02.jpg">
          </div>
          <div class="item">
          <img alt="Third slide" src="img/slider03.jpg">
          </div>
        </div>
        <a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
        <a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
      </div>
    </section>
    <section class="menu">
      <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="{{ url('/') }}">INICIO</a></li>
              <li><a href="{{ url('nosotros') }}">QUÉ ES SHYMOW</a></li>
              <li><a href="{{ url('faq') }}">F.A.Q</a></li>
              <li><a href="{{ url('contacto') }}">CONTACTO</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <form class="navbar-form navbar-left" role="search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for..." aria-describedby="basic-addon2">
                  <span class="input-group-addon" id="basic-addon2" style="padding:0;"><button style="border:none;padding:0px;"><img src="img/search.png" alt="search" width="38" height="32"></button></span>
                </div>
              </form>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div>
      </nav>
    </section>
    <div class="content">
      <div class="row">
        <div class="col-sm-3 col-md-3 contentSearch">
            <section class="header">
              <img src="img/finder.png" alt="Finder">
            </section>
            <section class="content-for">
              <div class="row">
                <br>
                <div class="col-md-12">
                  @if(Auth::check())
                    {!! Form::open(array('url' => 'busqueda_inicio','method'=>'get','id'=>'buscador')) !!}
                  @else
                    {!! Form::open(array('url' => '','method'=>'get','id'=>'buscadorOut')) !!}
                  @endif
                    <div class="input-group col-md-12">
                      {!! Form::text('search','',['placeholder'=>'Search for...','class'=>'form-control','aria-describedby'=>'basic-addon2','style'=>'padding:0','id'=>'searching']) !!}
                      <span class="input-group-addon" id="basic-addon2" style="padding:0;"><span style="border:none;padding:0px;"><img src="img/search.png" alt="search" width="38" height="32"></span></span>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="formulario">
                    <div class="form-group">
                      <div class="col-md-12">
                        {!! Form::label('Quiero encontrar:')!!}
                        <div class="form-group">
                          <div class="col-sm-6">

                            <div class="checkbox">
                              <label style="padding:0px !important; ">
                               <input type="radio" value="all" name="like" id="searchAll" checked="checked"> Todo 
                              </label>
                            </div>
                            

                            <div class="checkbox">
                              <label style="padding:0px !important; ">
                               <input type="radio" value="0" name="like" id="SearchPeople"> Personas 
                              </label>
                            </div>
                            

                            <div class="checkbox">
                              <label style="padding:0px !important; ">
                               <input type="radio" value="2" name="like" id="SearchBusiness"> Empresas 
                              </label>
                            </div>
                            

                            <div class="checkbox">
                              <label style="padding:0px !important; ">
                               <input type="radio" value="1" name="like" id="SearchCelebrities"> Celebridad 
                              </label>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            
                            <div class="checkbox">
                              <label style="padding:0px !important; ">
                               <input type="radio" value="3" name="like" id="userPic">Usuarios con foto 
                              </label>
                            </div>

                            <div class="checkbox">
                              <label style="padding:0px !important; ">
                               <input type="radio" value="4" name="like" id="searchYoutubers">Youtubers
                              </label>
                            </div>
                            <div class="checkbox">
                              <label style="padding:0px !important; ">
                               <input type="radio" value="5" name="like" id="userUp"> Perfiles actualizados 
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                    <br>
                      <div class="col-sm-12 col-md-6 padd-right" id="actComercial">
                        {!! Form::label('Act. comercial')!!}
                        {!! Form::select('comercio',array('all' => 'Todo') + $subCategories,'',['class'=>'form-control','required' => 'required','id'=>'comercio']) !!}
                        <hr>
                      </div>
                      <div class="col-sm-12 col-md-6 padd-left" id="searchcategories">
                        {!! Form::label('Categoría')!!}
                        {!! Form::select('categoria',array('all' => 'Todo') + $categories,'',['class'=>'form-control','required' => 'required','id'=>'categoria']) !!}
                        <hr>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-12 col-md-6 padd-right" id="searchGender">
                        {!! Form::label('Genero')!!}
                        {!! Form::select('genero',array('all' => 'Todo','m' => 'Hombre', 'f' => 'Mujer','n'=>'Neutro'),'',['class'=>'form-control','required' => 'required','id'=>'genero']) !!}
                        <hr>
                      </div>
                      <div class="col-sm-12 col-md-6 padd-left" id="searchEdad">
                        {!! Form::label('Edad')!!}
                        <select name="edad" id="" class="form-control">
                          <option value="all">Todo</option>
                          <option value="menores">-18</option>
                          <option value="18-25">18-25</option>
                          <option value="25-35">25-35</option>
                          <option value="35-45">35-45</option>
                          <option value="55-65">55-65</option>
                          <option value="tedad">+65</option>
                        </select>
                        <hr>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12 col-md-6 padd-right" id="interesting">
                        <label>Intereses</label>
                        {!! Form::select('interes',array('all' => 'Todo') + $interest,'',['class'=>'form-control','required' => 'required','id'=>'interes']) !!}
                        <hr>
                      </div>
                      <div class="col-sm-12 col-md-6 padd-left">
                        <label>País</label>
                        {!! Form::select('pais',array('all' => 'Todo') + $countries,'',['class'=>'form-control','required' => 'required','id'=>'paiss']) !!}
                        <hr>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12 col-md-6 padd-right">
                        <label>Provincia</label>
                        {!! Form::select('provincia',array('all' => 'Seleccione pais'),'',['class'=>'form-control', 'required' => 'required','id'=>'states']); !!}
                        <hr>
                      </div>
                      <div class="col-md-6 col-sm-12 padd-left">
                        <label>Municipio</label>
                        {!! Form::select('municipio',array('all' => 'Seleccione Provincia'),'',['class'=>'form-control', 'required' => 'required','id'=>'citys']); !!}
                        <hr>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                      <hr>
                    </div>

                    <div class="form-group center-block" id="buscado">
                      <div class="col-md-12">
                        <label>Lo más buscado</label>
                      </div>
                      <div class="center-block col-md-12 img-formulario" id="img-interest">  
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/deportes.png" alt="deportes" data-interest="1" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/restaurantes.png" data-interest="2" alt="restaurantes" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/entretenimiento.png" data-interest="3" alt="entretenimiento" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/compras.png" data-interest="4" alt="compras" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/amistad.png" data-interest="5" alt="amistad" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/musica.png" data-interest="6" alt="musica" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/celebridades.png" data-interest="7" alt="celebridades" class="img-responsive">
                        <!-- </div> -->
                      </div>
                      {!! Form::hidden('interest','all',['id' => 'interest']) !!}
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group center-block" id="filtroredes">
                      <div class="col-md-12">
                      <hr>
                        <label>Filtrar por red social</label>
                      </div>
                      <div class="text-center col-md-12 img-formulario-redes" id="img-redes">  
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/twitt.png" alt="twitter" data-redes="twitter" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/face.png" data-redes="facebook" alt="facebook" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/youtube.png" data-redes="youtube" alt="youtube" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/instagram.png" data-redes="instagram" alt="instagram" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/pinteres.png" data-redes="pinterest" alt="pinterest" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/vine.png" data-redes="vine" alt="vine" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/tumbrl.png" data-redes="tumblr" alt="tumblr" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/g+.png" alt="google" data-redes="plus" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/linkedin.png" data-redes="linkedin" alt="linkedin" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/snap.png" data-redes="snapchat"   alt="snapchat" class="img-responsive">
                        <!-- </div> -->

                        {!! Form::hidden('redes','all',['id' => 'redes']) !!}
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group center-block" id="filtrostream">
                      <div class="col-md-12">
                      <hr>
                        <label>Filtrar por plataforma de streaming</label>
                      </div>
                      <div class="center-block col-md-12 img-formulario" id="img-stream">  
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/twich.png" alt="twitch" data-stream="twitch" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/bambuser.png" alt="bambuser" data-stream="livestream" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/lives.png" alt="lives" data-stream="bambuser" class="img-responsive">
                        <!-- </div> -->
                        {!! Form::hidden('stream','all',['id' => 'stream']) !!}
                      </div>

                    </div>

                      <div class="col-md-12 center-block center-text">
                        <br>
                        @if(Auth::check())
                          {!! Form::submit('BUSCAR',['class'=>'butto-formns center-block']) !!}
                        @else
                          <button type="submit" class="butto-formns center-block" data-toggle="modal" data-target="#myModal" id="searchingData">
                            BUSCAR
                          </button>
                        @endif
                      </div>
                  {!! Form::close() !!}
                </div>
              </div>
            </section>
          </div>
        <div class="col-sm-9 col-md-9" id="contentArt">
          <section class="video">
            <video src="video/shymow.mp4" controls loop muted preload="auto" >
              <!-- poster="img/video.jpg" --> >
              HTML5 Video is required for this example
            </video> 
          </section>
          <section class="col-sm-12 col-md-12 articles">
            <div class="row">
              <div class="col-md-12 text-center">
                <div class="header"><h2>En <span>Shymow</span> encontrarás:</h2></div>
                <hr>
              </div>

              <section class="col-sm-12 col-md-12">
                <div class="notice">
                  <div class="col-md-3 imgArticle">
                    <img src="{{url('img/tendencias.jpg')}}" alt="Article" class="articleImg">
                    <div class="binieta">
                      <img src="img/binieta.png" alt="Binieta" class="img-responsive">
                    </div>
                  </div>
                  <div class="col-md-2"><img src="img/numeral.jpg" alt="numeral" class="decorator"></div>
                  <div class="col-md-7">
                    <div class="notice-text">
                      <h2>TENDENCIAS</h2>
                      <p>Enterate de las ultimas <br> tendencias en redes sociales</p><br>
                      <!-- <a href="#">Ver +</a> -->
                    </div>
                  </div>
                </div>
              </section>
              <div class="clearfix"></div>
              <br>
              <section class="col-sm-12 col-md-12">
                <div class="notice">
                  <div class="col-md-3 imgArticle">
                    <img src="{{url('img/interes.jpg')}}" alt="Article" class="articleImg">
                    <div class="binieta">
                      <img src="img/binieta.png" alt="Binieta" class="img-responsive">
                    </div>
                  </div>
                  <div class="col-md-2"><img src="img/corazon.jpg" alt="corazon" class="decorator"></div>
                  <div class="col-md-7">
                    <div class="notice-text">
                      <h2>INTERESES</h2>
                      <p>Encuentra perfiles de redes <br>sociales en tu ciudad</p>
                      <!-- <a href="#">Ver +</a> -->
                    </div>
                  </div>
                </div>
              </section>

              <div class="clearfix"></div>
              <br>

              <section class="col-sm-12 col-md-12">
                <div class="notice">
                 <div class="col-md-3 imgArticle">
                   <img src="{{url('img/destacados.jpg')}}" alt="Article" class="articleImg">
                   <div class="binieta">
                     <img src="img/binieta.png" alt="Binieta" class="img-responsive">
                   </div>
                 </div>
                 <div class="col-md-2"><img src="img/hands.jpg" alt="hands" class="decorator"></div>
                 <div class="col-md-7">
                   <div class="notice-text">
                     <h2>DESTACADOS</h2>
                     <p>Conoce los productos <br>mas ranqueados</p>
                     <!-- <a href="#">Ver +</a> -->
                   </div>
                 </div>
               </div>
             </section>
             <div class="clearfix"></div>
             <br>
             <section class="col-sm-12 col-md-12">
              <div class="notice">
               <div class="col-md-3 imgArticle">
                 <img src="{{url('img/celebridad.jpg')}}" alt="Article" class="articleImg">
                 <div class="binieta">
                   <img src="img/binieta.png" alt="Binieta" class="img-responsive">
                 </div>
               </div>
               <div class="col-md-2"><img src="img/estrella.jpg" alt="estrella" class="decorator"></div>
               <div class="col-md-7">
                 <div class="notice-text">
                   <h2>CELEBRIDADES</h2>
                   <p>Sigue las noticias de tus celebridades <br>favoritas</p>
                   <!-- <a href="#">Ver +</a> -->
                 </div>
               </div>
             </div>
           </section>
           <div class="clearfix"></div>
           <br>
         </div>
       </section>    
     </div>
   </div>
 </div>


<div class="container-fluid users">
  <section>
    <div class="row">
      <div class="col-md-12">
        <article class="grid_3 carousel-article text-center"><br>
          <h4 style="color: #61605F !important;font-family: gothamTwo;font-size: 2.5em;">Últimos usuarios registrados:</h4>

          <div class="container-slider">
            <a href="#"  id="nextview" class="control-slider"><i class="glyphicon glyphicon-chevron-left" style="left: -40px;"></i></a>
            <div id="w">
              <nav class="slidernav" style="display: none">
                <div id="navbtns" class="clearfix">
                  <a href="#" class="previous">prev</a>
                  <a href="#" class="next">next</a>
                </div>
              </nav>
                <div class="crsl-items" data-navigation="navbtns">
                  <div class="crsl-wrap">
                    @foreach($users as $user)
                      <div class="crsl-item">
                        <div class="thumbnail">
                          <img src="{{ url($user->img_profile) }}" alt="nyc subway">
                          <div class="social-icon">
                            @if(isset($user->redes))
                              @for($i=0; $i<count($socialNet);$i++)
                                @if(isset(json_decode($user->redes,true)[$socialNet[$i]]))
                                  @foreach( json_decode($user->redes,true)[$socialNet[$i] ] as $red)

                                  <a href="{{url($red)}}" target="_blank"><img src="{{url('img/profile/'.$socialNet[$i].'-post.png')}}" alt="shymow"></a>
                                  @endforeach
                                @endif
                              @endfor
                            @endif
                          </div>
                        </div>
                        
                        <h3><a href="#">{{$user->name}}</a></h3>
                      </div>
                    @endforeach
                  </div><!-- @end .crsl-wrap -->
                </div><!-- @end .crsl-items -->
            </div><!-- @end #w -->
            <a href="#" id="preview" class="control-slider"><i class="glyphicon glyphicon-chevron-right"></i></a>
          </div>
        </article><!-- slider text article end -->
      </div>
    </div>
  </section>
</div>
<div class="clearfix"></div>

<section class="paralax">
  <div class="col-xs-10 col-xs-offset-2 col-sm-10 col-sm-offset-2 col-md-5 col-md-offset-5 paralax-text">
    <h2>¿Estás list@ <br> para empezar?</h2><br><br>
    <div class="align-paralax-a">
     <a href="#">REGÍSTRATE</a>
     <a href="#">INICIA SESIÓN</a>
   </div>
 </div>
 <img src="img/paralax.jpg" alt="img">
</section>
<div class="footer">
  <div class="text-center">
    <div class="link">
      <a href={{url('/')}}>INICIO</a> |
      <a href={{url('/nosotros')}}>QUÉ ES SHYMOW</a> |
      <a href="#">CONTACTO</a> |
      <a href={{url('condiciones')}}>TÉRMINOS Y CONDICIONES</a> |
      <a href="{{url('politicas_privacidad')}}">PÓLITICA DE PRIVACIDAD</a> |
      <a href="#">LOGIN</a> |
      <br>
    </div>
    <p>2016 Shymow - Todos los derechos reservados</p>
    <div class="footer-img">
      <img src="img/twitt-footer.png" alt="shymow" class="img-responsive">
      <img src="img/face-footer.png" alt="shymow" class="img-responsive">
      <img src="img/youtube-footer.png" alt="shymow" class="img-responsive">
    </div>
  </div>
</div> 

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background: transparent;border: none;box-shadow: none;color:#FFF;">
      <div class="modal-body" >
        <div id="contentSearchModal"></div>
        <div class="modalFooter">
          <h2>Conoce más sobre tu búsqueda haciendo clic en</h2>
          <div class="col-xs-4"><hr></div>
          <div class="col-xs-4"><a href="#star" class="btn btn-default" id="initS">INICIAR SESIÓN</a></div>
          <div class="col-xs-4"><hr></div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div> 
</div>
@endsection


@section('scripts')
<script>

  $('#flash-overlay-modal').modal();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
 $('.crsl-items').carousel({
    visible: 3,
    itemMinWidth: 180,
    itemEqualHeight: 370,
    itemMargin: 9,
  });
  $('#preview').click(function(event) {
    /* Act on the event */
    $('#navbtns').find('.next').click();
  });
  $('#nextview').click(function(event) {
    /* Act on the event */
    $('#navbtns').find('.previous').click();
  });
  $("a[href=#]").on('click', function(e) {
    e.preventDefault();
  });
  $('#paiss').change(function(event) {
    /* Act on the event */
    $('#states').html('<option>Cargando..</option>');
    $('#citys').html('<option value="all">Selecciona municipio</option>');
    var id = $(this).val();
    $.ajax({
      url: 'state/'+id,
      type: 'GET',
      dataType: 'html',
      success: function(data){
        $('#states').html('<option value="all">Todo</option>'+data);
      }
    })
    .fail(function() {
      console.log("error");
    })
  });

  $('#states').change(function(event) {
    /* Act on the event */
    $('#citys').html('<option>Cargando..</option>');
    var id = $(this).val();
    $.ajax({
      url: 'city/'+id,
      type: 'GET',
      dataType: 'html',
      success: function(data){
        $('#citys').html('<option value="all">Todo</option>'+data);
        if (data == "")
          $('#citys').html('<option value="all">Municipios no encontrados</option>');
      }
    })
    .fail(function() {
      console.log("error");
    })
  });

  $('#states').change(function(event) {
    /* Act on the event */
    $('#citys').html('<option>Cargando..</option>');
    var id = $(this).val();
    $.ajax({
      url: 'city/'+id,
      type: 'GET',
      dataType: 'html',
      success: function(data){
        $('#citys').html(data);
        if (data == "")
          $('#citys').html('<option value="all">Municipios no encontrados</option>');
      }
    })
    .fail(function() {
      console.log("error");
    })
  });



  $('#img-interest img').on('click',function(event) {
    event.preventDefault();
    var interestSelect = $(this).data('interest');
    var interest = $('#interest').attr('value');
    $( "#img-interest img" ).each(function() {
      $( this ).css({
        "background":"",
        "border-radius":""
      });
    });
     if(interest != interestSelect){
        $('#interest').attr('value',interestSelect);

        $(this).css({
          "background":"#A841FF",
          "border-radius":"5px"
        });
      }else{
        $('#interest').attr('value',"all");
        $(this).css({
          "background":"",
          "border-radius":""
        });
      }
    /* Act on the event */
  });

   $('#img-redes img').on('click',function(event) {
      event.preventDefault();
      var redesSelect = $(this).data('redes');
      var redes = $('#redes').attr('value');
      $( "#img-redes img" ).each(function() {
        $( this ).css({
          "background":"",
          "border-radius":""
        });
      });
       if(redes != redesSelect){
        $('#redes').attr('value',redesSelect);

        $(this).css({
          "background":"#A841FF",
          "border-radius":"5px"
        });
      }else{
        $('#redes').attr('value',"all");
        $(this).css({
          "background":"",
          "border-radius":""
        });
      }
      /* Act on the event */
  });



  $('#img-stream img').on('click',function(event) {
      event.preventDefault();
      var streamSelect = $(this).data('stream');
      var stream = $('#stream').attr('value');
      $( "#img-stream img" ).each(function() {
        $( this ).css({
          "background":"",
          "border-radius":""
        });
      });
      if(stream != streamSelect){
        $('#stream').attr('value',streamSelect);

        $(this).css({
          "background":"#A841FF",
          "border-radius":"5px"
        });
      }else{
        $('#stream').attr('value',"all");
        $(this).css({
          "background":"",
          "border-radius":""
        });
      }
      /* Act on the event */
  });


  $('#searchAll').click(function(event) {
    /* Act on the event */
    $('#actComercial').slideDown('slow');
    $('#searchcategories').slideDown('slow');
    $('#searchcategories').css('visibility', 'visible');
    $('#searchGender').slideDown('slow');
    $('#searchEdad').slideDown('slow');
    $('#interesting').css('visibility', 'visible');

    $('#filtroredes').slideDown('slow');
    $('#filtrostream').slideDown('slow');
  });
  
  $('#SearchPeople, #searchYoutubers, #userPic, #userUp').click(function(event) {
    /* Act on the event */
    $('#actComercial').slideUp('slow');
    $('#searchcategories').slideDown('slow');

    $('#searchGender').slideDown('slow');
    $('#searchEdad').slideDown('slow');
    $('#interesting').css('visibility', 'visible');

    $('#filtroredes').slideDown('slow');
    $('#filtrostream').slideDown('slow');
  });
  $('#SearchBusiness').click(function(event) {
    /* Act on the event */
    $('#actComercial').slideDown('slow');
    // $('#searchcategories').slideUp('slow');
    $('#searchcategories').css('visibility', 'hidden');
    $('#actComercial').css('visibility', 'visible');


    $('#interesting').css('visibility', 'hidden');
    $('#searchGender').slideUp('slow');
    $('#searchEdad').slideUp('slow');
    $('#buscado').slideUp('slow');
    // $('#filtroredes').slideUp('slow');
    // $('#filtrostream').slideUp('slow');


  });

  $('#SearchCelebrities').click(function(event) {
    /* Act on the event */
    $('#actComercial').slideUp('slow');
    $('#searchcategories').slideDown('slow');

    $('#searchGender').slideDown('slow');
    $('#searchEdad').slideDown('slow');
    $('#interesting').css('visibility', 'visible');

    $('#filtroredes').slideDown('slow');
    $('#filtrostream').slideDown('slow');
  });

  $('#searchcategories').change(function(event) {
    /* Act on the event */
    $('#actComercial').css('visibility', 'hidden');
    $('#searchcategories').css('visibility', 'visible');
  });

  $('#actComercial').change(function(event) {
    /* Act on the event */
    $('#searchcategories').css('visibility', 'hidden');
    $('#actComercial').css('visibility', 'visible');
  });

  $('#searching').keyup(function(event) {
    $('#interesting').css('visibility', 'visible');

    var txt = $(this).val();
    if (txt.length > 0) {
      // $('#SearchPeople').prop('checked', true);
      $('#actComercial').slideUp('slow');
      $('#searchcategories').slideDown('slow');
      $('#SearchPeople').is('checked');
    }else{
      $('#actComercial').slideDown('slow');
      $('#searchcategories').slideDown('slow');
    }
  });

  $('#searching').select(function(event) {
    $('#interesting').css('visibility', 'visible');

    var txt = $(this).val();
    if (txt.length > 0) {
      // $('#SearchPeople').prop('checked', true);
      $('#actComercial').slideUp('slow');
      $('#searchcategories').slideDowb('slow');
      $('#SearchPeople').is('checked');
    }else{
      $('#actComercial').slideDown('slow');
      $('#searchcategories').slideDown('slow');
    }
  });

  // $("#searchingData"). contentSearchModal
  $("#buscadorOut").submit(function(event) {
    /* Act on the event */
    event.preventDefault();
    var form = $(this).serialize();
    var url = $(this).attr('action');
    $.ajax({
      url: '/searchAll',
      type: 'GET',
      dataType: 'JSON',
      data: {data: form},
      success: function(data){
        if(!data.error){
          if (data.data.length > 0) {
            for (var i = 0; i <= data.data.length; i++) {
              var user = data.data[i];

              var html = '<div class="container-busquedas">'+
              '<div class="sub-content-busqueda">'+
                '<div class="img-busqueda col-sm-3" style="padding:0px !important;"><img src="'+user.img_profile+'" alt="shymow"></div>'+

                '<div class="busquedas-content col-sm-6" style="padding:0px !important;">'+
                  '<div class="content-busqueda-header">'+
                    '<span class="first-title">'+user.name+'</span>'+
                     '<span class="sub-title"> '+user.pais+'</span>'+
                  '</div>'
                  '<p>{{$user->descripcion}}</p>'+
                '</div>'+

                '<div class="busquedas-settings" style="padding:0px !important;">'+
                    '<a href="{{url('view_user/'.$user->id)}}" class="show-more">VER +</a>'+
                  '</div>'+
                '</div>'+
                
              '</div>'+
            '</div>';
              if (i < 1) {
                $('#contentSearchModal').html('<div style="margin-bottom:10px;">'+html+'</div>');
              }else{
                $('#contentSearchModal').append('<div style="margin-bottom:10px;">'+html+'</div>');
              }
            }
          }else{
            $('#contentSearchModal').html('<div style="margin-bottom:10px;"><h2>No hay resultados</h2></div>');
          }
        }
      }
    })
    .fail(function() {
      $('#contentSearchModal').html('<h2>Ocurrio un error</h2>');
      console.log("error");
    });
    $('#initS').click(function(event) {
      /* Act on the event */
      $('#myModal').modal('hide');

      $('html,body').animate({
          scrollTop: $("#startS").offset().top
      }, 2000);
    });
  });
    // $('#buscador').submit(function(event) {
    //   /* Act on the event */
    //   event.preventDefault();
    //   var form = $(this).serialize();
    //   var url = $(this).attr('action');
    //   console.log(url+'/'+form);
    //   $.ajax({
    //     url: url+'/?'+form,
    //     type: 'get',
    //     dataType: 'html',
    //     success: function(data){
    //       $('#contentArt').html(data);
    //     }
    //   })
    //   .fail(function() {
    //     console.log("error");
    //   })
    // });
  </script>
@endsection
@extends('logueado.layouts.content-float-chat')
@section('scriptsTwo')
<script>
  $(document).ready(function(){
    $('.dropdown-submenu a.test').on("click", function(e){
      $(this).next('ul').toggle();
      e.stopPropagation();
      e.preventDefault();
    });
  });
</script> 
@stop