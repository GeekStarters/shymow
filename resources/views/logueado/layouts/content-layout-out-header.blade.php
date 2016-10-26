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
					          <li><a tabindex="-1" href="{{url('identificate')}}">Shymow shop</a></li>
					        </ul>
					      </li>
  						<li><a href="{{ url('add-shop') }}">Shymow Shop</a></li>
  						<li><a href="{{ url('logout') }}">Cerrar sesión</a></li>
  					</ul>
  				</li>
			</ul>
			<ul class="nav navbar-nav navbar-left" style="margin-right:20px !important; margin-left:20px !important;">
				 <!-- Buscador superior -->
				<form class="navbar-form navbar-left" role="search">
				  <div class="input-group" id="custom-templates">
				    <input class="typeahead form-control" name="top_search" data-provide="typeahead" placeholder="Search" autocomplete="off" type="text">
				    <span class="input-group-addon" id="basic-addon2" style="padding:0;"><button style="border:none;padding:0px;"><img src="img/search.png" alt="search" width="32" height="32"></button></span>
				  </div>
				</form>
			</ul>
		</nav>
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