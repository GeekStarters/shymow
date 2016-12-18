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
									<h2 class="h2-header" style="margin-left:20px;">Contraseña <i class="glyphicon glyphicon-pencil navbar-right"></i></h2>
								<hr>
									{!! Form::open(array('name' => 'password_change', 'url' => 'save-password','method'=>'Post')) !!}
										<p class="text-danger" id="errors-change_pass" style="color: #a94442 !important;font-size:1em;font-weight:bold;display:none;"></p>
					
										<div class="col-sm-12">
											<div class="form-group">
												<label class="color-label">Actual</label>
												{!! Form::password('last_password',['class'=>'form-control', 'required' => 'required','style'=>'width:50%;']) !!}
												<span>&nbsp;</span>
											</div>
											<div class="form-group">
												<label class="color-label">Nueva</label>
												{!! Form::password('password',['class'=>'form-control', 'required' => 'required','style'=>'width:50%;']) !!}
												<span>&nbsp;</span>
											</div>
											<div class="form-group">
												<label class="color-label">Repetir contraseña nueva</label><br>
												{!! Form::password('password_confirmation',['class'=>'form-control', 'required' => 'required','style'=>'width:50%;display:inline;']) !!}
												<span>&nbsp;</span>
												<div class="next-right" style="display: inline;">
													<button type="submit" class="butto-formns navbar-right botton-margin">GUARDAR</button>
													<a href="{{url('out_edit_profile')}}"  class="butto-blank navbar-right botton-margin">CANCELAR</a>
												</div>
											</div>
										</div>
									{!! Form::close() !!}
							</div>
						</div>
					</div>
					<div class="row">
						<hr>
							<h2 class="h2-header" style="margin-left:20px;">Recuperación de contraseña <i class="glyphicon glyphicon-pencil navbar-right"></i></h2>
						<hr>
						{!! Form::open(array('name' => 'recover_pass', 'url' => 'recover-password','method'=>'Post')) !!}
							<div class="col-sm-12">
								<p class="text-danger" id="errors-recover-pass" style="color: #a94442 !important;font-size:1em;font-weight:bold;display:none;"></p>
								<div class="form-group">
									<label class="color-label">Correo electrónico de recuperación</label>
									<br>
									{!! Form::text('recover_pass',Auth::user()->recover_pass,['class'=>'form-control', 'required' => 'required','style'=>'width:50%;display:inline']) !!}
									<span>&nbsp;</span>
									<div class="next-right" style="display: inline;">
										<button type="submit" class="butto-formns navbar-right botton-margin">GUARDAR</button>
										<a href="{{url('out_edit_profile')}}"  class="butto-blank navbar-right botton-margin">CANCELAR</a>
									</div>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
					<div class="row">
						<hr>
							<h2 class="h2-header" style="margin-left:20px;">Cerrar cuenta<i class="glyphicon glyphicon-pencil navbar-right"></i></h2>
						<hr>
						{!! Form::open(array('name' => 'delete_user', 'url' => 'desabilited-user','method'=>'Post')) !!}
							<div class="col-sm-12">
								<div class="form-group">
									<label class="color-label">Darse de baja</label>
									<p>Si cierras tu cuenta, se desactivara tu perfil, nombre y la <br> mayor parte del contenido que publicastes en Shymow</p>
									<p>Por favor completa la siguiente información</p>
									<span>&nbsp;</span>
								</div>
								<div class="form-group">
									<label class="color-label">¿Por qué quieres darte de baja de Shymow?</label> <br>
									@foreach($desactives as $desactive)
										<div class="checkbox">
											 <label style="color:#8E8E8E;">
											<input type="checkbox" name="opt{{$desactive->id}}" value="{{$desactive->id}}"> {{$desactive->name}}</label>
										</div>
									@endforeach
									
								</div>
								<div class="form-group">
									<label class="color-label">¿En qué podemos mejorar?</label><br>
									{!! Form::textarea('description','',['class'=>'form-control','style'=>'width:50%;display:inline;']) !!}
									<span>&nbsp;</span>
									<div class="next-right" style="display: inline;">
										<button type="submit" class="butto-formns navbar-right botton-margin">GUARDAR</button>
										<a href="{{url('out_edit_profile')}}"  class="butto-blank navbar-right botton-margin">CANCELAR</a>
									</div>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
			</div>
	</div>
</div>

<div class="row col-xs-12">
	<br>
</div>
@stop

@section('scripts')
<script>
	jQuery(document).ready(function($) {
		var validator = new FormValidator('password_change', [{
		    name: 'last_password',
		    display: 'Password anterior',
		    rules: 'required'
		},{
		    name: 'password',
		    display: 'Nuevo password',
		    rules: 'required'
		},{
		    name: 'password_confirmation',
		    display: 'Confirmación de password',
		    rules: 'required||matches[password]'
		}], function(errors, event) {
		    if (errors.length > 0) {
		        var errorString = '';

		        for (var i = 0, errorLength = errors.length; i < errorLength; i++) {
		            errorString += errors[i].message + '<br />';
		        }
		        $('#errors-change_pass').slideDown('fast');
		        $('#errors-change_pass').html(errorString);
		    }
		});

		var validator = new FormValidator('recover_pass', [{
		    name: 'recover_pass',
		    display: 'Email',
		    rules: 'required'
		}], function(errors, event) {
		    if (errors.length > 0) {
		        var errorString = '';

		        for (var i = 0, errorLength = errors.length; i < errorLength; i++) {
		            errorString += errors[i].message + '<br />';
		        }
		        $('#errors-recover-pass').slideDown('fast');
		        $('#errors-recover-pass').html(errorString);
		    }
		});
	});
		
</script>
@stop
@extends('logueado.layouts.content-float-chat')