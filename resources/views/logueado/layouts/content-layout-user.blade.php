@extends('layouts.master')


@section('content')
	<div class="profiles">
		<nav class="nav-shymow">
			<ul class="nav navbar-nav navbar-right">
				<a href="{{url('/')}}">
					<img src="{{url('img/logo.png')}}" alt="shymow" style="max-width:200px; margin-right:20px; margin-left:20px;">
				</a>
				@if(Auth::check())
				 	<li class="dropdown">
	  					<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="{{ url(Auth::user()->img_profile) }}" alt=""> {{Auth::user()->name}} <b class="caret"></b></a>
	  					<ul class="dropdown-menu">
	  						<li class="dropdown-submenu">
						        <a class="test" tabindex="-1" href="#">Configuración <span class="caret"></span></a>
						        <ul class="dropdown-menu">
						     	  <li><a href="{{ url('identificate_perfil') }}">Editar perfil</a></li>
						          <li><a tabindex="-1" href="{{url('identificate')}}">Shymow Shop</a></li>
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
						     <li><a href="{{ url('agregar-producto') }}">Shymow Shop</a></li>
	  						<li><a href="{{ url('logout') }}">Cerrar sesión</a></li>
	  					</ul>
	  				</li>
	  			@endif
			</ul>
			<ul class="nav navbar-nav navbar-left" style="margin-right:20px !important; margin-left:20px !important;">
				 <!-- Buscador superior -->
				<form class="navbar-form navbar-left" role="search">
				  <div class="input-group" id="custom-templates">
				    <input id="typesearch" class="typeahead form-control" name="top_search" data-provide="typeahead" placeholder="Search" autocomplete="off" type="text">
				    <span class="input-group-addon" id="basic-addon2" style="padding:0;"><button style="border:none;padding:0px;"><img src="{{url('img/search.png')}}" alt="search" width="32" height="32"></button></span>
				  </div>
				  <a href="{{url('perfil')}}" class="btn btn-default"><span class="glyphicon glyphicon-user"></span></a href="index.html" class="btn btn-default">
				</form>

			</ul>
		</nav>
		<div class="container" style="margin-bottom: 80px">
			<div class="profiles-data-users">
				<div class="profile-header col-sm-12">
					<div class="header-port">
						<img src="{{ url($users->img_portada) }}" alt="shymow">
						@if(Auth::check())
							<a href="{{url('shymow-shop')}}" class="cart-shop"><i class="glyphicon glyphicon-shopping-cart"></i></a>
						@endif
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
								@if(Auth::check())
									<div class="collapse navbar-collapse navbar-ex1-collapse">
										<ul class="nav navbar-nav navbar-right">
											<li><a href="{{ url('perfil') }}">SOBRE MI</a></li>
											<li><a href="{{ url('favoritos') }}">FAVORITOS</a></li>
											<li><a href="{{ url('amigos') }}">MIS AMIGOS</a></li>
											<li><a href="{{ url('tendencias') }}">TENDENCIAS</a></li>
										</ul>
									</div><!-- /.navbar-collapse -->
								@endif
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
								<img src="{{ url($users->img_profile) }}">
							</div>
							<div class="data-profile">
								<div class="name-profile text-center">
									<h2>{{$users->name}}</h2>
								</div>
								<div class="profile-message text-center">
									<p>{{$users->mi_frase}}</p>
								</div>
								<div class="about-profile text-justify">
									<p>{{$users->descripcion}} </p>
								</div>
							</div>
							<div class="more-data">
								<ul>
									@if(isset($users->work) && $users->work != "")
										<li><span class="glyphicon glyphicon-user"></span> {{$users->work}}</li>
									@else
										<li><span class="glyphicon glyphicon-user"></span> Sin especificar</li>
									@endif
									<li><span class="glyphicon glyphicon-map-marker"></span> {{$users->provincia }}, {{$users->pais}}</li>
									<li><span class="glyphicon glyphicon-calendar"></span>
									{{ date('j F \of Y', strtotime($users->birthdate))}}</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="interesting col-sm-offset-4 col-sm-8">
						<div class="interesting-header">
							<h2>Mis intereses</h2>
						</div>
						<div class="interesting-body">
							<div class="hobbies">
								@if(isset($users->hobbies) && $users->hobbies != "")
									@foreach(explode(',',$users->hobbies) as $hobbie)
										<div class="like-me">{{$hobbie}}</div>
									@endforeach
								@else
									<h3>Este usuario no ha especificado sus hobbies</h3>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
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