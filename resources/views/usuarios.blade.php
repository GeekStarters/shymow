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
					<img src="img/reg_personal/personal.jpg" alt="shynow">
				</div>
				<div class="col-sm-6">
					<div class="content_personal">
						<h2>¡Bienvenid@!</h2>
						<p>Nos alegra que te hayas unido a nosotros <br><br>En Shymow lograrás conectarte de verdad con aquello que te importa o te interesa. <br><br> Podrás colgar los perfiles de tus redes sociales, guarda en favorito aquellas cuentas de otros usuarios que te interesan y compartirlos con el resto de la comunidad</p>
					</div>
					<br><br>
					<a href="{{ url('data_user') }}" class="butto-formns navbar-right">¡EMPECEMOS!</a>
				</div>
			</div>
		</div>
@endsection

