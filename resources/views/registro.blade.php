@extends('layouts.master')

@section('bodyStyle')
 class="reg_general"
@endsection

@section('content')
	<nav class="nav-shymow">
		<ul class="nav navbar-nav navbar-right">
			<img src="img/logo.png" alt="shymow" style="max-width:200px; margin-right:20px; margin-left:20px;">
		</ul>
	</nav>
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 reg_header">
				<div class="header_reg">
					<h2>¿Quieres ser parte de Shymow?</h2>
				</div>
				<br>
				<p>¡Regístrate!</p>
			</div>
		</div>
		<div class="row">
			<div class="genera_content">
				<div class="col-sm-4 text-center"> 
					<img src="img/reg_general/carita.jpg" alt="shymow">
					<p>¿Buscas amigos?<br>Crea una cuenta <br> <b>Shymow Personal</b></p>
					<div class="clearfix"></div>
					<a href="{{ url('users') }}" class="butto-formns">REGÍSTRATE</a>

				</div>
				<div class="col-sm-4 text-center">
					<img src="img/reg_general/grafica.jpg" alt="shymow">
					<p>¿Eres empresario?<br>Crea una cuenta <br> <b>Shymow Empresarial</b></p>
					<div class="clearfix"></div>
					<a href="{{url('empresa')}}" class="butto-formns">REGÍSTRATE</a>
				</div>
				<div class="col-sm-4 text-center">
					<img src="img/reg_general/start.jpg" alt="shymow">
					<p>¿Buscas celebridad?<br>Crea una cuenta <br> <b>Shymow Celebrity</b></p>
					<div class="clearfix"></div>
					<a href="{{ url('celebridad') }}" class="butto-formns">REGÍSTRATE</a>
				</div>
				<div class="clearfix"></div>
				<br>
				<br>
				<br>
				<br>
				<br>
				<p style="position:relative;bottom:50px;line-height:1.2;" class="navbar-right">¡Un momento! Ya estoy registrado <a href="{{url('/')}}" style="color:#fff;background:#37B4AA;padding:5px 15px;border-radius:5px;font-size:.8em;">INICIA SESIÓN</a></p>
			</div>
		</div>
	</div>
@endsection

