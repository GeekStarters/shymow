@extends('layouts.master')

@section('bodyStyle')
 class="reg_personal"
@endsection

@section('content')
		<nav class="nav-shymow">
				<ul class="nav navbar-nav navbar-right">
					<img src="{{url('img/logo.png')}}" alt="shymow" style="max-width:200px; margin-right:20px; margin-left:20px;">
				</ul>
			</nav>
			<br><br>
			<div class="container">
				<div class="row">
					<div class="col-sm-6 img-reg">
						<img src="{{url('img/reg_empresa/empresa.jpg')}}" alt="shynow">
					</div>
					<div class="col-sm-6">
						<div class="content_personal">
							<h2>¡Bienvenid@!</h2>
							<p>Nos alegra que tu empresa se haya vinculado a Shymow empresarial. <br><br>En Shymow tu empresa quedará conectada con muchas otras empresas, y con una red de usuarios que son clientes potenciales. <br><br>

							Podrás publicar los perfiles sociales, páginas web, blogs de tu empresa para darte a conocer.También podrás guardar en favoritos aquellas cuentas de otros usuarios que sean afines a tus intereses corporativos.


							</p>
							</div>
						<br><br>
						<a href="{{url('datos_empresa')}}" class="butto-formns navbar-right">¡EMPECEMOS!</a>
					</div>
				</div>
			</div>
@endsection

