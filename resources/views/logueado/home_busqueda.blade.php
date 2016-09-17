@extends('layouts.master')
@section('content')
    @extends('layouts.nav')
    <div class="all">
      <header><img src="img/header.png" alt="Header"></header>

      <div class="clearfix"></div>
      <section class="welcome col-lg-12">
        <img src="img/welcome-hands.png" alt="Hands" class="img-hand">

        <div class="row">

          <div class="col-sm-7 col-md-7">
              <div class="greeting">
                <div class="container">
                    <p>Felicitaciones,<br>ya eres parte de <br>
                    <span class="erashymow">#EraShymow</span>
                  </p>
                </div>
              </div>
          </div>
          <div class="col-sm-5 col-md-5">
            <div class="row">
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
                  {!! Form::model(Request::all(), array('url' => 'busqueda_inicio','method'=>'get','id'=>'buscador')) !!}
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
                        <div class="form-group">
                          <div class="col-sm-6">
                            {!! Form::radio('like', 'all', true);!!} {!! Form::label('Todo')!!} <br>
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
                      {!! Form::hidden('interest','',['id' => 'interest']) !!}
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group center-block">
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

                        {!! Form::hidden('redes','',['id' => 'redes']) !!}
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group center-block">
                      <div class="col-md-12">
                      <hr>
                        <label>Filtrar por plataforma de streaming</label>
                      </div>
                      <div class="center-block col-md-12 img-formulario" id="img-stream">  
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/twich.png" alt="twitch" data-stream="twitch" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/bambuser.png" alt="bambuser" data-stream="bambuser" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/lives.png" alt="lives" data-stream="lives" class="img-responsive">
                        <!-- </div> -->
                        {!! Form::hidden('stream','',['id' => 'stream']) !!}
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
          
          <div class="col-sm-9">
            <div class="text-center busquedas-header">
              <a name="search"></a>
              <h2>Resultados de la búsqueda</h2>
            </div>
            @foreach($users as $user)
              <div class="container-busquedas">
                <div class="sub-content-busqueda">

                  <div class="img-busqueda col-sm-3" style="padding:0px !important;"><img src="{{$user->img_profile}}" alt="shymow"></div>

                  <div class="busquedas-content col-sm-6" style="padding:0px !important;">
                    <div class="content-busqueda-header">
                      <span class="first-title">{{$user->username}}</span>
                       <span class="sub-title">{{$user->mi_frase}}</span>
                    </div>
                    <p>{{$user->descripcion}}</p>
                  </div>

                  <div class="busquedas-settings" style="padding:0px !important;">
                    <ul>
                      <li class="busquedas-qualification">
                        <div class="qualification-header">
                          Calificación
                        </div>
                        <div class="qualification">
                          <span class="glyphicon glyphicon-star"></span>
                          <span class="glyphicon glyphicon-star"></span>
                          <span class="glyphicon glyphicon-star"></span>
                          <span class="glyphicon glyphicon-star"></span>
                          <span class="glyphicon glyphicon-star"></span>
                        </div>
                      </li>
                      <div class="busquedas-sub-options">
                        <li class="busquedas-share">
                          <i class="fa fa-share-alt" aria-hidden="true"></i>
                        </li>
                        <li class="busquedas-like-me">
                          <span class="glyphicon glyphicon-heart"></span>
                        </li>
                      </div>
                    </ul>
                    <div class="busquedas-social">
                      <a href="#"><img src="img/profile/face-post.png" alt="shymow"></a>
                      <a href="#"><img src="img/profile/twitter-post.png" alt="shymow"></a>
                      <a href="#"><img src="img/profile/linkedin-post.png" alt="shymow"></a>
                      <a href="#"><img src="img/profile/pinterest-post.png" alt="shymow"></a>
                      <a href="" class="show-more">VER +</a>
                    </div>
                  </div>
                  
                </div>
              </div>
              <br>
            @endforeach
            
            {!! $users->appends(Request::all())->fragment('search')->render() !!}
          </div>
        </div>
      </div>


      <div class="container-fluid users">
        <section>
          <div class="row">
            <div class="col-md-12">
              <article class="grid_3 carousel-article text-center">
                 <h4>Últimos usuarios registrados:</h4>
                 <div style="position: relative;width: 220px; height: 90px;" class="caroufredsel_wrapper">
                    <div class="center-block" style="width:230px !important;">
                      <ul id="foo3" class="carousel-li">
                        <li>
                           <p>
                               Slider1, welcome to freshdesignweb blog, here is useful slider text example tutorial with demo and download link, hope you can learn more about web design. Regard, Graham Bill
                           </p>
                        </li><li>
                           <p>
                              Slider2, welcome to freshdesignweb blog, here is useful slider text example tutorial with demo and download link, hope you can learn more about web design. Regard, Graham Bill
                           </p>
                        </li><li>
                           <p>
                              Slider3, welcome to freshdesignweb blog, here is useful slider text example tutorial with demo and download link, hope you can learn more about web design.Regard, Graham Bill
                           </p>
                        </li>
                      </ul>
                      <div class="clearfix"></div>

                      <div style="display: block;" class="carousel-pagination" id="foo3_pag">
                        <a class="selected" href="#"><span>1</span></a><a class="" href="#"><span>2</span></a><a class="" href="#"><span>3</span></a>
                      </div>
                    </div>
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
            <a href="#">INICIO</a> |
            <a href="#">QUÉ ES SHYMOW</a> |
            <a href="#">F.A.Q</a> |
            <a href="#">CONTACTO</a> |
            <a href="#">TÉRMINOS Y CONDICIONES</a> |
            <a href="#">PÓLITICA DE PRIVACIDAD</a> |
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
  $("#foo3").carouFredSel({
    items: 1,
    auto: true,
    scroll: 1,
    pagination  : "#foo3_pag"
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
        $('#state').html(data);
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
        $('#city').html(data);
        if (data == "")
          $('#city').html('<option value="all">Municipios no encontrados</option>');
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
        $('#interest').attr('value',"");
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
        $('#redes').attr('value',"");
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
        $('#stream').attr('value',"");
        $(this).css({
          "background":"",
          "border-radius":""
        });
      }
      /* Act on the event */
  });
  </script>
@endsection