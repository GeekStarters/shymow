@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="col-md-12">
	<br>
	<div class="col-md-10 col-md-offset-1 out-padding create-product-container">
		<div class="create-product-header">
			<div class="col-md-4 active-background-product-agregate border-right-active">
				<a href="/configurar-shymow-shop">
					<h2 class="text-center">
						General
					</h2>
				</a>
			</div>
			<div class="col-md-4 active-background-product-agregate border-right-active">
				<a href="/notification_shop">
					<h2 class="text-center">
						Notificaciones
					</h2>
				</a>
			</div>
			<div class="col-md-4 " style="background: #F3F3F3;">
				<h2 class="text-center">
					Cerrar Shop
				</h2>
			</div>
			<div class="clearfix"></div>
		</div>
		{!! Form::open(array('name' => 'general-config', 'url' => 'desactive_store','method'=>'Post')) !!}
			<div class="create-product-content">
				<br><br>
					
				<div class="col-sm-10 col-sm-offset-1 shymow-shop-general">
					<div class="row">
						@include('flash::message')
						<p class="text-danger" id="errors-validate" style="color: #a94442 !important;font-size:1em;font-weight:bold;display:none;"></p>
						@foreach($errors->all(('<p class="text-danger" style="color: #a94442 !important;font-size:1em;font-weight:bold;">:message</p>') )as $message)
							{!!$message!!}
						@endforeach
					</div>
					<div class="row">
						<div class="row">
							<div class="col-md-12 header-config-shymow-notification">
								<hr>
									<h2 class="h2-header" style="margin-left:20px;">Cerrar cuenta Shymow Shop <i class="glyphicon glyphicon-pencil navbar-right"></i></h2>
								<hr>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h2 class="color-shymow">Darse de baja en el shop</h2>
							<p style="font-size:1.1em;">
								Si cierras tu Shop, se desactivarán tus productos, historiales de venta, clasificaciones y la mayor parte del contenido que publicastes en Shymow Shop
								<br>
								<br>
								Por favor complete la siguiente información
							</p>

							<h2 class="color-shymow">¿Por qué quieres darte de baja de Shymow Shop?</h2>
							@foreach($desactives as $desactive)
								<div class="checkbox">
									 <label style="color:#8E8E8E;">
									<input type="checkbox" name="opt{{$desactive->id}}" value="{{$desactive->id}}"> {{$desactive->name}}</label>
								</div>
							@endforeach

							<h2 class="color-shymow">¿En qué podemos mejorar?</h2>
							<textarea name="description"></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-12 next-right">
					<br>
					<br>
					<button type="submit" class="butto-danger navbar-right botton-margin">CERRAR MI CUENTA</button>
					<a href="{{url('out-config-shymow-shop')}}"  class="butto-blank navbar-right botton-margin">CANCELAR</a>
				</div>	
			</div>
		{!! Form::close() !!}
	</div>
</div>
@stop
@extends('logueado.layouts.content-float-chat')
@section('scripts')
<script>
		
</script>
@stop