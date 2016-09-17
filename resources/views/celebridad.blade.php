@extends('layouts.master')

@section('bodyStyle')
 class="reg_personal"
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
				<div class="col-sm-6 img-reg">
					<img src="img/reg_celebridad/celebridad.jpg" alt="shynow">
				</div>
				<div class="col-sm-6">
					<div class="content_personal">
						<h2>¡Bienvenid@!</h2>
						<p>¡Qué emoción eres una celebridad!<br>Nos alegra que seas parte de Shymow <br><br>

						En Shymow te conectarás con aquello que de verdad te importa o te interesa. <br><br>
						podrás colgar tus perfiles de redes sociales, notificar a tus seguidores todo lo que haces, eventos, productos, canales de streaming y otras cosas más que quieras mostrarle al mundo


						</p>
					</div>
					<br><br>
					<a href="{{ url('datos_celebridad') }}" class="butto-formns navbar-right">¡EMPECEMOS!</a>
				</div>
			</div>
		</div>
@endsection

