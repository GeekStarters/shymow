@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="col-md-12">
	<br>
	<div class="col-md-10 col-md-offset-1 out-padding create-product-container">
		<div class="create-product-header">
			<div class="col-md-4 active-background-product-agregate border-right-active">
				<a href="/edit-profile">
					<h2 class="text-center">
						General
					</h2>
				</a>
			</div>
			<div class="col-md-4 active-background-product-agregate border-right-active">
				<a href="/edit-security">
					<h2 class="text-center">
						Seguridad
					</h2>
				</a>
			</div>
			<div class="col-md-4">
				<a href="/notification">
					<h2 class="text-center">
						Notificaciones
					</h2>
				</a>
			</div>
			<div class="clearfix"></div>
		</div>
		{!! Form::open(array('name' => 'notification_config', 'url' => 'save_config_notification','method'=>'Post')) !!}
			<div class="create-product-content">
				<br><br>
					
				<div class="col-sm-10 col-sm-offset-1 shymow-shop-general">
					<div class="row">
						@include('flash::message')
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
						{!! Form::checkbox('play_reseiver_notification', 'true',$config->play_reseiver_notification) !!} <span style="color:#999999; font-size:1.1em;">Reproducir sonido al recibir notificación</span><br>
						{!! Form::checkbox('play_reseiver_msg', 'true',$config->play_reseiver_msg) !!} <span style="color:#999999; font-size:1.1em;">Reproducir sonido al recibir nuevo mensaje</span><br>
					</div>
					<div class="col-md-12">
						<hr>
							<h2 class="h2-header" style="margin-left:20px;">Notificaciones <i class="glyphicon glyphicon-pencil navbar-right"></i></h2>
						<hr>
					</div>
					<div class="col-md-11 col-md-offset-1 notification-config-shop">
						<div class="row">
							<div class="col-sm-1 col-xs-12">
								<img src="img/config_shymow_shop/add_friends.png" style="margin:auto;display:block;" alt="Shymow Shop">
							</div>
							<div class="col-md-8">
								<p>Recibir una notificación cuando alguien me empiece a seguir</p>
							</div>
							<div class="col-md-3">
								{!! Form::select('follow_notification', ['1' => 'activada','0' => 'desactivada'],$config->follow_notification,['class'=>'form-control','required' => 'required']) !!}
								
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-1 col-xs-12">
								<img src="img/config_shymow_shop/delete_friend.png" style="margin:auto;display:block;" alt="Shymow Shop">
							</div>
							<div class="col-md-8">
								<p>Recibir una notificación cuando alguien me deje de seguir</p>
							</div>
							<div class="col-md-3">
								{!! Form::select('follow_out_notification',['1' => 'activada','0' => 'desactivada'],$config->follow_out_notification,['class'=>'form-control','required' => 'required']) !!}
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
								{!! Form::select('label_notification',['1' => 'activada','0' => 'desactivada'],$config->label_notification,['class'=>'form-control','required' => 'required']) !!}
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-1 col-xs-12">
								<img src="img/config_shymow_shop/03.png" style="margin:auto;display:block;" alt="Shymow Shop">
							</div>
							<div class="col-md-8">
								<p>Recibir una notificación cuando alguien comparta mis contenidos publicados</p>
							</div>
							<div class="col-md-3">
								{!! Form::select('share_notification',['1' => 'activada','0' => 'desactivada'],$config->share_notification,['class'=>'form-control','required' => 'required']) !!}
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-1 col-xs-12">
								<img src="img/config_shymow_shop/04.png" style="margin:auto;display:block;" alt="Shymow Shop">
							</div>
							<div class="col-md-8">
								<p>Recibir una notificación cuando alguien indique que le gustan mis contenidos</p>
							</div>
							<div class="col-md-3">
								{!! Form::select('like_notification',['1' => 'activada','0' => 'desactivada'],$config->like_notification,['class'=>'form-control','required' => 'required']) !!}
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
								{!! Form::select('message_notification',['1' => 'activada','0' => 'desactivada'],$config->message_notification,['class'=>'form-control','required' => 'required']) !!}
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-1 col-xs-12">
								<img src="img/config_shymow_shop/06.png" style="margin:auto;display:block;" alt="Shymow Shop">
							</div>
							<div class="col-md-8">
								<p>Recibir una notificación cuando alguien comente mis contenidos</p>
							</div>
							<div class="col-md-3">
								{!! Form::select('comments_notification',['1' => 'activada','0' => 'desactivada'],$config->comments_notification,['class'=>'form-control','required' => 'required']) !!}
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-1 col-xs-12">
								<img src="img/config_shymow_shop/07.png" style="margin:auto;display:block;" alt="Shymow Shop">
							</div>
							<div class="col-md-8">
								<p>Recibir una notificación cuando alguien califique mis contenidos</p>
							</div>
							<div class="col-md-3">
								{!! Form::select('qualification_notification',['1' => 'activada','0' => 'desactivada'],$config->qualification_notification,['class'=>'form-control','required' => 'required']) !!}
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-1 col-xs-12">
								<img src="img/config_shymow_shop/label.png" style="margin:auto;display:block;" alt="Shymow Shop">
							</div>
							<div class="col-md-8">
								<p>Recibir una notificación cuando se publiquen nuevos productos en mis comercios favoritos</p>
							</div>
							<div class="col-md-3">
								{!! Form::select('new_product_notification',['1' => 'activada','0' => 'desactivada'],$config->new_product_notification,['class'=>'form-control','required' => 'required']) !!}
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-1 col-xs-12">
								<img src="img/config_shymow_shop/trends.png" style="margin:auto;display:block;" alt="Shymow Shop">
							</div>
							<div class="col-md-8">
								<p>Recibir una notificación para las tendencias que sigo</p>
							</div>
							<div class="col-md-3">
								{!! Form::select('trends_notification',['1' => 'activada','0' => 'desactivada'],$config->trends_notification,['class'=>'form-control','required' => 'required']) !!}
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
									
									{!! Form::radio('reseiver_email', '0', $opt1) !!} <span style="color:#999999; font-size:1.1em;">Todas las notificaciones</span><br>
									{!! Form::radio('reseiver_email', '1', $opt2) !!} <span style="color:#999999; font-size:1.1em;">Todas las notificaciones acerca de ti o de actividad que te interese</span><br>
									{!! Form::radio('reseiver_email', '2',$opt3) !!} <span style="color:#999999; font-size:1.1em;">Solo notificaciones de tu cuenta, seguridad y privacidad</span><br>
								</p>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-12 next-right">
					<br>
					<br>
					<button type="submit" class="butto-formns navbar-right botton-margin">GUARDAR</button>
					<a href="{{url('out_edit_profile')}}"  class="butto-blank navbar-right botton-margin">CANCELAR</a>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
	<div class="row col-xs-12">
		<br>
	</div>
</div>
@stop