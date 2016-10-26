@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="col-md-12">
	<br>
	<div class="col-md-10 col-md-offset-1 out-padding create-product-container">
		<div class="create-product-header">
			<div class="col-md-4 active-background-product-agregate border-right-active">
				<h2 class="text-center">
					General
				</h2>
			</div>
			<div class="col-md-4 active-background-product-agregate border-right-active">
				<h2 class="text-center">
					Notificaciones
				</h2>
			</div>
			<div class="col-md-4">
				<h2 class="text-center">
					Cerrar Shop
				</h2>
			</div>
			<div class="clearfix"></div>
		</div>
		{!! Form::open(array('name' => 'notification_config', 'url' => 'processor_notification_config','method'=>'Post')) !!}
			<div class="create-product-content">
				<br><br>
					
				<div class="col-sm-10 col-sm-offset-1 shymow-shop-general">
					<div class="row">
						<p class="text-danger" id="errors-validate" style="color: #a94442 !important;font-size:1em;font-weight:bold;display:none;"></p>
						@foreach($errors->all(('<p class="text-danger" style="color: #a94442 !important;font-size:1em;font-weight:bold;">:message</p>') )as $message)
							{!!$message!!}
						@endforeach
					</div>
					<div class="row">
						<div class="row">
							<div class="col-md-12 header-config-shymow-notification">
								<hr>
									<h2 class="h2-header" style="margin-left:20px;">Notificaciones en Shymow Shop <i class="glyphicon glyphicon-pencil navbar-right"></i></h2>
								<hr>
								<p>Verás todas las notificaciones de Shymow Shop en tu imagen de perfil, ubicada en la parte superior derecha de tu pantalla</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<hr>
								<h2 class="h2-header" style="margin-left:20px;">Sonidos <i class="glyphicon glyphicon-pencil navbar-right"></i></h2>
							<hr>
						</div>	
					</div>
					<div class="col-md-12">
						{!! Form::checkbox('sound_new_notification', 'true') !!} <span style="color:#999999; font-size:1.1em;">Reproducir sonido al recibir notificación</span><br>
						{!! Form::checkbox('sound_new_message', 'true') !!} <span style="color:#999999; font-size:1.1em;">Reproducir sonido al recibir nuevo mensaje</span><br>
						{!! Form::checkbox('sound_new_sale', 'true') !!} <span style="color:#999999; font-size:1.1em;">Reproducir sonido al efectuar venta</span><br>
					</div>
					<div class="col-md-12">
						<hr>
							<h2 class="h2-header" style="margin-left:20px;">Notificaciones <i class="glyphicon glyphicon-pencil navbar-right"></i></h2>
						<hr>
					</div>
					<div class="col-md-11 col-md-offset-1 notification-config-shop">
						<div class="row">
							<div class="col-sm-1 col-xs-12">
								<img src="img/config_shymow_shop/01.png" style="margin:auto;display:block;" alt="Shymow Shop">
							</div>
							<div class="col-md-8">
								<p>Recibir una notificación cuando se haya efectuado una venta</p>
							</div>
							<div class="col-md-3">
								{!! Form::select('sale',['true' => 'activar','false' => 'desactivar'],'',['class'=>'form-control']) !!}
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-1 col-xs-12">
								<img src="img/config_shymow_shop/02.png" style="margin:auto;display:block;" alt="Shymow Shop">
							</div>
							<div class="col-md-8">
								<p>Recibir una notificación cuando alguien me etiquete</p>
							</div>
							<div class="col-md-3">
								{!! Form::select('label',['true' => 'activar','false' => 'desactivar'],'',['class'=>'form-control']) !!}
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-1 col-xs-12">
								<img src="img/config_shymow_shop/03.png" style="margin:auto;display:block;" alt="Shymow Shop">
							</div>
							<div class="col-md-8">
								<p>Recibir una notificación cuando alguien comparta mis productos publicados</p>
							</div>
							<div class="col-md-3">
								{!! Form::select('share',['true' => 'activar','false' => 'desactivar'],'',['class'=>'form-control']) !!}
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-1 col-xs-12">
								<img src="img/config_shymow_shop/04.png" style="margin:auto;display:block;" alt="Shymow Shop">
							</div>
							<div class="col-md-8">
								<p>Recibir una notificación cuando alguien indique que le gustan mis productos</p>
							</div>
							<div class="col-md-3">
								{!! Form::select('like',['true' => 'activar','false' => 'desactivar'],'',['class'=>'form-control']) !!}
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-1 col-xs-12">
								<img src="img/config_shymow_shop/05.png" style="margin:auto;display:block;" alt="Shymow Shop">
							</div>
							<div class="col-md-8">
								<p>Recibir una notificación cuando tenga un mensaje nuevo</p>
							</div>
							<div class="col-md-3">
								{!! Form::select('message',['true' => 'activar','false' => 'desactivar'],'',['class'=>'form-control']) !!}
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-1 col-xs-12">
								<img src="img/config_shymow_shop/06.png" style="margin:auto;display:block;" alt="Shymow Shop">
							</div>
							<div class="col-md-8">
								<p>Recibir una notificación cuando alguien comente mis productos</p>
							</div>
							<div class="col-md-3">
								{!! Form::select('comment',['true' => 'activar','false' => 'desactivar'],'',['class'=>'form-control']) !!}
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-1 col-xs-12">
								<img src="img/config_shymow_shop/07.png" style="margin:auto;display:block;" alt="Shymow Shop">
							</div>
							<div class="col-md-8">
								<p>Recibir una notificación cuando alguien califique mis productos</p>
							</div>
							<div class="col-md-3">
								{!! Form::select('qualification',['true' => 'activar','false' => 'desactivar'],'',['class'=>'form-control']) !!}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="row">
							<div class="col-md-12 header-config-shymow-notification">
								<hr>
									<h2 class="h2-header" style="margin-left:20px;">Notificaciones en tu correo <i class="glyphicon glyphicon-pencil navbar-right"></i></h2>
								<hr>
								<p>
									
									{!! Form::radio('notificacion_email', '0', true) !!} <span style="color:#999999; font-size:1.1em;">Todas las notificaciones</span><br>
									{!! Form::radio('notificacion_email', '1') !!} <span style="color:#999999; font-size:1.1em;">Notificaciones de venta, etiquetas, mensajes, comentarios y calificaciones</span><br>
									{!! Form::radio('notificacion_email', '1') !!} <span style="color:#999999; font-size:1.1em;">Solo notificaciones de tu cuenta, seguridad y privacidad</span><br>
									{!! Form::radio('notificacion_email', '1') !!} <span style="color:#999999; font-size:1.1em;">Solo notificaciones de venta</span><br>
								</p>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-12 next-right">
					<br>
					<br>
					<button type="submit" class="butto-formns navbar-right botton-margin">CONTINUAR</button>
					<a href="{{url('out-config-shymow-shop')}}"  class="butto-blank navbar-right botton-margin">CANCELAR</a>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
	<div class="row col-xs-12">
		<br>
	</div>
</div>
@stop