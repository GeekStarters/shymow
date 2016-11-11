@extends('layouts.master')


@section('content')
	<div class="profiles">
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
					          <li><a tabindex="-1" href="{{url('identificate')}}">Shymow Shop</a></li>
					        </ul>
					      </li>
					     <li><a href="{{ url('agregar-producto') }}">Shymow Shop</a></li>
					     <li><a href="{{ url('agregar-producto') }}">Editar perfil</a></li>
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
				</form>

			</ul>
		</nav>
		<div class="container" style="margin-bottom: 60px">
			<div class="profiles-data-users">
				<div class="profile-header col-sm-12">
					<div class="header-port">
						<img src="{{ url(Auth::user()->img_portada) }}" alt="shymow">
						<a href="{{url('shymow-shop')}}" class="cart-shop"><i class="glyphicon glyphicon-shopping-cart"></i></a>
					</div>
					<div class="header-nav">
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
									<ul class="nav navbar-nav navbar-right">
										<li><a href="{{ url('perfil') }}">SOBRE MI</a></li>
										<li><a href="{{ url('favoritos') }}">FAVORITOS</a></li>
										<li><a href="{{ url('amigos') }}">MIS AMIGOS</a></li>
										<li><a href="{{ url('tendencias') }}">TENDENCIAS</a></li>
									</ul>
								</div><!-- /.navbar-collapse -->
							</div>
						</nav>
					</div>
				</div>
				<!-- Content chat flotante -->
				
				<!-- End chat flotante -->
				<div class="profile-personal-data">
					<div class="profile-data-header col-sm-3">
						<div class="data-img-profile">
							<div class="img-profile">
								<img src="{{ url(Auth::user()->img_profile) }}">
							</div>
							<a href="{{url('/edit_img_user')}}">
								<div class="editar-foto text-center" data-toggle="modal" data-target=".bs-example-modal-lg">
									<span class="glyphicon glyphicon-camera"></span>
								</div>
							</a>
							<div class="data-profile">
								<div class="name-profile text-center">
									<h2>{{Auth::user()->username}}</h2>
								</div>
								<div class="profile-message text-center">
									<p>{{Auth::user()->mi_frase}} <span id="frase" class="glyphicon glyphicon-pencil color-edit"></p>
								</div>
								<div class="about-profile text-justify">
									<p>{{Auth::user()->descripcion}} <span id="descripcion_profile" class="glyphicon glyphicon-pencil color-edit"></p>
								</div>
							</div>
							<div class="more-data">
								<ul>
									@if(isset(Auth::user()->work) && Auth::user()->work != "")
										<li><span class="glyphicon glyphicon-user"></span> <span class="val">{{Auth::user()->work}}</span> <span id="work" class="glyphicon glyphicon-pencil color-edit"></li>
									@else
										<li><span class="glyphicon glyphicon-user"></span> <span class="val">Sin especificar</span> <span id="work" class="glyphicon glyphicon-pencil color-edit"></li>
									@endif
									<li><span class="glyphicon glyphicon-map-marker"></span> {{Auth::user()->provincia }}, {{Auth::user()->pais}} <span class="glyphicon glyphicon-pencil color-edit"></span></li>
									<li><span class="glyphicon glyphicon-calendar"></span>
									{{ date('j F \of Y', strtotime(Auth::user()->birthdate))}} <span class="glyphicon glyphicon-pencil color-edit"></span></li>
								</ul>
							</div>
						</div>
						<?php $archivo_actual = basename($_SERVER['REQUEST_URI']);
							$arreglo_actual = explode("?", $archivo_actual);
							$archivo_actual = $arreglo_actual[0];
						?>

						@if($archivo_actual == 'tendencias')
							@if(count($trends)>0)
								<div class="col-ms-3 popular">
									<h2>MÁS POPULAR</h2>
									<ul>
										@foreach($topTrends as $topTrend)
											<li class="hashtag-top">#{{$topTrend->name}}</li>
										@endforeach
									</ul>
								</div>
							@endif
						@endif
					</div>
					@if($archivo_actual == "perfil")
						<div class="interesting col-sm-offset-4 col-sm-5">
							<div class="interesting-header">
								<h2>Mis intereses</h2>
							</div>
							<div class="interesting-body">
								<div class="hobbies">
									@if(isset(Auth::user()->hobbies) && Auth::user()->hobbies != "")
										@foreach(explode(',',Auth::user()->hobbies) as $hobbie)
											<div class="like-me">{{$hobbie}}</div>
										@endforeach
									@else
										<h3>Este usuario no ha especificado sus hobbies</h3>
									@endif
								</div>
							</div>
						</div>
						<div class="more-interesting col-sm-3">
							<div class="interesting-header">
								<h2>Más de mis intereses</h2>
							</div>
							<div class="more-interesting-body">
								<p>
									Super héroes, Arrow, Flash, Supergirl, Bella y bestia, Gotham, Arquitectura, Playa, Peliculas, Vintage, Graffiti, Ilustración, Educación, Comedia, Universidad, Leer, Escritores, Fantasias, Actores, Comediantes
								</p>
							</div>

						</div>
					@endif
				</div>
			</div>
		</div>

		<div class="container">
			@yield('content-logueo')
		</div>

		
	</div>
@endsection

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