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
            <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
            <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
          </ul>
        </li>
        <li><a href="{{ url('logout') }}">Cerrar sesión</a></li>
      </ul>
    </li>
  </ul>
  <ul class="nav navbar-nav navbar-left" style="margin-right:20px !important; margin-left:20px !important;">
    <form class="navbar-form navbar-left" role="search">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-describedby="basic-addon2">
        <span class="input-group-addon" id="basic-addon2" style="padding:0;"><button style="border:none;padding:0px;"><img src="img/search.png" alt="search" width="32" height="32"></button></span>
      </div>
      <a href="{{url('/')}}" class="btn btn-default"><span class="glyphicon glyphicon-home"></span></a href="index.html" class="btn btn-default">
      @if(Auth::check())
        <a href="{{url('perfil')}}" class="btn btn-default"><span class="glyphicon glyphicon-user"></span></a href="index.html" class="btn btn-default">
      @endif
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
                {!! Form::open(array('url' => '','method'=>'get')) !!}
                @endif
                <div class="input-group col-md-12">
                  {!! Form::text('search','',['placeholder'=>'Search for...','class'=>'form-control','aria-describedby'=>'basic-addon2','style'=>'padding:0']) !!}
                  <span class="input-group-addon" id="basic-addon2" style="padding:0;"><span style="border:none;padding:0px;"><img src="img/search.png" alt="search" width="38" height="32"></span></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="formulario">
                <div class="form-group">
                  <div class="col-md-12">
                    {!! Form::label('Quiero encontrar:')!!}
                    {!! Form::token() !!}
                    <div class="form-group">
                      <div class="col-sm-6">
                        {!! Form::radio('like', 'value', true);!!} {!! Form::label('Todo')!!} <br>
                        {!! Form::radio('like', '0')!!} {!! Form::label('Personas')!!} <br>
                        {!! Form::radio('like', '2') !!} {!! Form::label('Empresas')!!} <br>
                        {!! Form::radio('like', '1') !!} {!! Form::label('Celebridad')!!}
                      </div>
                      <div class="col-sm-6">
                        {!! Form::radio('like', 'youtubers') !!} {!! Form::label('Youtubers')!!} <br>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <br>
                  <div class="col-sm-12 col-md-6 padd-right">
                    {!! Form::label('Act. comercial')!!}
                    {!! Form::select('comercio',array('all' => 'Todo'),'',['class'=>'form-control','required' => 'required','id'=>'comercio']) !!}
                    <hr>
                  </div>
                  <div class="col-sm-12 col-md-6 padd-left">
                    {!! Form::label('Categoría')!!}
                    {!! Form::select('categoria',array('all' => 'Todo'),'',['class'=>'form-control','required' => 'required','id'=>'categoria']) !!}
                    <hr>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-12 col-md-6 padd-right">
                    {!! Form::label('Genero')!!}
                    {!! Form::select('genero',array('all' => 'Todo','m' => 'Hombre', 'f' => 'Mujer'),'',['class'=>'form-control','required' => 'required','id'=>'genero']) !!}
                    <hr>
                  </div>
                  <div class="col-sm-12 col-md-6 padd-left">
                    {!! Form::label('Edad')!!}
                    <select name="edad" id="" class="form-control">
                      <option value="all">Todo</option>
                      @for($i = 1;$i<=99;$i++)
                      <option value="{{$i}}">{{$i}}</option>
                      @endfor
                    </select>
                    <hr>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 col-md-6 padd-right">
                    <label>Intereses</label>
                    {!! Form::select('interes',array('all' => 'Todo') + $interest,'',['class'=>'form-control','required' => 'required','id'=>'interes']) !!}
                    <hr>
                  </div>
                  <div class="col-sm-12 col-md-6 padd-left">
                    <label>País</label>
                    {!! Form::select('pais',array('all' => 'Todo') + $countries,'',['class'=>'form-control','required' => 'required','id'=>'pais']) !!}
                    <hr>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 col-md-6 padd-right">
                    <label>Provincia</label>
                    {!! Form::select('provincia',array('all' => 'Todo'),'',['class'=>'form-control', 'required' => 'required','id'=>'state']); !!}
                  </div>
                  <div class="col-md-6 col-sm-12 padd-left">
                    <label>Municipio</label>
                    {!! Form::select('municipio',array('all' => 'Todo'),'',['class'=>'form-control', 'required' => 'required','id'=>'city']); !!}
                  </div>
                </div>
                <div class="col-sm-12 col-md-12">
                  <hr>
                </div>

                <div class="form-group center-block">
                  <div class="col-md-12">
                    <label>Lo más buscado</label>
                  </div>
                  <div class="center-block col-md-12 img-formulario">  
                    <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                    <img src="img/deportes.png" alt="deportes" class="img-responsive">
                    <!-- </div> -->
                    <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                    <img src="img/restaurantes.png" alt="deportes" class="img-responsive">
                    <!-- </div> -->
                    <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                    <img src="img/entretenimiento.png" alt="deportes" class="img-responsive">
                    <!-- </div> -->
                    <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                    <img src="img/compras.png" alt="deportes" class="img-responsive">
                    <!-- </div> -->
                    <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                    <img src="img/amistad.png" alt="deportes" class="img-responsive">
                    <!-- </div> -->
                    <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                    <img src="img/musica.png" alt="deportes" class="img-responsive">
                    <!-- </div> -->
                    <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                    <img src="img/celebridades.png" alt="deportes" class="img-responsive">
                    <!-- </div> -->
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group center-block">
                  <div class="col-md-12">
                    <hr>
                    <label>Filtrar por red social</label>
                  </div>
                  <div class="text-center col-md-12 img-formulario-redes">  
                    <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                    <img src="img/twitt.png" alt="deportes" class="img-responsive">
                    <!-- </div> -->
                    <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                    <img src="img/face.png" alt="deportes" class="img-responsive">
                    <!-- </div> -->
                    <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                    <img src="img/youtube.png" alt="deportes" class="img-responsive">
                    <!-- </div> -->
                    <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                    <img src="img/instagram.png" alt="deportes" class="img-responsive">
                    <!-- </div> -->
                    <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                    <img src="img/pinteres.png" alt="deportes" class="img-responsive">
                    <!-- </div> -->
                    <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                    <img src="img/vine.png" alt="deportes" class="img-responsive">
                    <!-- </div> -->
                    <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                    <img src="img/tumbrl.png" alt="deportes" class="img-responsive">
                    <!-- </div> -->
                    <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                    <img src="img/g+.png" alt="deportes" class="img-responsive">
                    <!-- </div> -->
                    <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                    <img src="img/linkedin.png" alt="deportes" class="img-responsive">
                    <!-- </div> -->
                    <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                    <img src="img/snap.png" alt="deportes" class="img-responsive">
                    <!-- </div> -->
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group center-block">
                  <div class="col-md-12">
                    <hr>
                    <label>Filtrar por plataforma de streaming</label>
                  </div>
                  <div class="center-block col-md-12 img-formulario">  
                    <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                    <img src="img/twich.png" alt="deportes" class="img-responsive">
                    <!-- </div> -->
                    <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                    <img src="img/bambuser.png" alt="deportes" class="img-responsive">
                    <!-- </div> -->
                    <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                    <img src="img/lives.png" alt="deportes" class="img-responsive">
                    <!-- </div> -->
                  </div>
                  <div class="col-md-12 center-block center-text">
                    <br>
                    {!! Form::submit('BUSCAR',['class'=>'butto-formns center-block']) !!}
                  </div>
                </div>
                {!! Form::close() !!}
              </div>
            </div>
          </section>
        </div>
        <div class="col-sm-9 col-md-9" id="contentArt">
          <section class="video">
            <video src="video/shymow.mp4" controls loop muted preload="auto" poster="img/video.jpg" >
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
                    <img src="img/familia.jpg" alt="Article" class="articleImg">
                    <div class="binieta">
                      <img src="img/binieta.png" alt="Binieta" class="img-responsive">
                    </div>
                  </div>
                  <div class="col-md-2"><img src="img/numeral.jpg" alt="numeral" class="decorator"></div>
                  <div class="col-md-7">
                    <div class="notice-text">
                      <h2>TENDENCIAS</h2>
                      <p>Enterate de las ultimas <br> tendencias en redes sociales</p><br>
                      <a href="#">Ver +</a>
                    </div>
                  </div>
                </div>
              </section>
              <div class="clearfix"></div>
              <br>
              <section class="col-sm-12 col-md-12">
                <div class="notice">
                  <div class="col-md-3 imgArticle">
                    <img src="img/familia.jpg" alt="Article" class="articleImg">
                    <div class="binieta">
                      <img src="img/binieta.png" alt="Binieta" class="img-responsive">
                    </div>
                  </div>
                  <div class="col-md-2"><img src="img/corazon.jpg" alt="corazon" class="decorator"></div>
                  <div class="col-md-7">
                    <div class="notice-text">
                      <h2>INTERESES</h2>
                      <p>Encuentra perfiles de redes <br>sociales en tu ciudad</p>
                      <a href="#">Ver +</a>
                    </div>
                  </div>
                </div>
              </section>

              <div class="clearfix"></div>
              <br>

              <section class="col-sm-12 col-md-12">
                <div class="notice">
                 <div class="col-md-3 imgArticle">
                   <img src="img/familia.jpg" alt="Article" class="articleImg">
                   <div class="binieta">
                     <img src="img/binieta.png" alt="Binieta" class="img-responsive">
                   </div>
                 </div>
                 <div class="col-md-2"><img src="img/hands.jpg" alt="hands" class="decorator"></div>
                 <div class="col-md-7">
                   <div class="notice-text">
                     <h2>DESTACADOS</h2>
                     <p>Conoce los productos <br>mas ranqueados</p>
                     <a href="#">Ver +</a>
                   </div>
                 </div>
               </div>
             </section>
             <div class="clearfix"></div>
             <br>
             <section class="col-sm-12 col-md-12">
              <div class="notice">
               <div class="col-md-3 imgArticle">
                 <img src="img/familia.jpg" alt="Article" class="articleImg">
                 <div class="binieta">
                   <img src="img/binieta.png" alt="Binieta" class="img-responsive">
                 </div>
               </div>
               <div class="col-md-2"><img src="img/estrella.jpg" alt="estrella" class="decorator"></div>
               <div class="col-md-7">
                 <div class="notice-text">
                   <h2>CELEBRIDADES</h2>
                   <p>Sigue las noticias de tus celebridades <br>favoritas</p>
                   <a href="#">Ver +</a>
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
</div>
@endsection


@section('scripts')
<script>
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
  $('#pais').change(function(event) {
    /* Act on the event */
    $('#state').html('<option>Cargando..</option>');
    $('#city').html('<option>Selecciona municipio</option>');
    var id = $(this).val();
    $.ajax({
      url: 'state/'+id,
      type: 'GET',
      dataType: 'html',
      success: function(data){
        $('#state').html('<option value="all">Todo</option>'+data);
      }
    })
    .fail(function() {
      console.log("error");
    })
  });

  $('#state').change(function(event) {
    /* Act on the event */
    $('#city').html('<option>Cargando..</option>');
    var id = $(this).val();
    $.ajax({
      url: 'city/'+id,
      type: 'GET',
      dataType: 'html',
      success: function(data){
        $('#city').html('<option value="all">Todo</option>'+data);
        if (data == "")
          $('#city').html('<option value="all">Municipios no encontrados</option>');
      }
    })
    .fail(function() {
      console.log("error");
    })
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