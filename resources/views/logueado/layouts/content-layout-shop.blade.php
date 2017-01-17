@extends('layouts.master')


@section('content')
	<div class="profiles">
		<nav class="nav-shymow">
			<ul class="nav navbar-nav navbar-right">
				<a href="{{url('/')}}">
					<img src="{{url('img/logo.png')}}" alt="shymow" style="max-width:200px; margin-right:20px; margin-left:20px;">
				</a>
			  	<li class="dropdown">
  					<a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
						<span style="position: relative;">
		  					<img src="{{ url(Auth::user()->img_profile) }}" alt="">
		  					<span id="n-img-p">
		  						@if(DataHelpers::knowNotificationNum()>0)
									<span class="notification-perfil">
										<span>
											{{DataHelpers::knowNotificationNum()}}
										</span>
									</span>
			  					@endif
		  					</span>
						</span>

	  					{{Auth::user()->name}} <b class="caret"></b>
  					</a>
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
					    <li>
					     	<a href="{{ url('my_notifications') }}">Notificaciones 
								<span class="notification-g">
									<span class="number-notify-g">
										{{DataHelpers::knowNotificationNum()}}
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
		<div class="container">
			<div class="profiles-data-users">
				<div class="profile-header col-sm-12">
					<div class="header-port">
						<img src="{{ url(Auth::user()->img_portada) }}" alt="shymow">

						<a href="{{url('perfil')}}" class="butto-formns button-perfil">VER PERFIL</a>
						<a href="{{url('shymow-shop')}}" class="cart-shop"><i class="glyphicon glyphicon-shopping-cart"></i></a>
					</div>
					<div class="shymow-shop-header-title">
						<div class="shymow-shop-header-content">
							<span class="circle-left"></span>
							<span>Shymow Shop</span>
							<span class="circle-right"></span>
						</div>
					</div>
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