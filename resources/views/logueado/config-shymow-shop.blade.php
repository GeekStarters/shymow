@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="col-md-12">
	<br>
	<div class="col-md-10 col-md-offset-1 out-padding create-product-container">
		<div class="create-product-header">
			<div class="col-md-4 border-right">
				<h2 class="text-center">
					General
				</h2>
			</div>
			<div class="col-md-4 border-right">
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
		{!! Form::open(array('name' => 'general-config', 'url' => 'processor_general_config','method'=>'Post')) !!}
			<div class="create-product-content">
				<br><br>
					
				<div class="col-sm-10 col-sm-offset-1 shymow-shop-general">
				<div class="row">
				<p class="text-danger" id="errors-validate" style="color: #a94442 !important;font-size:1em;font-weight:bold;display:none;"></p>
				@foreach($errors->all(('<p class="text-danger" style="color: #a94442 !important;font-size:1em;font-weight:bold;">:message</p>') )as $message)
					{!!$message!!}
				@endforeach
				</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="color-label">Nombre <i class="glyphicon glyphicon-pencil color-edit"></i></label>
							{!! Form::text('nombre','',['class'=>'form-control']) !!}
							<span>&nbsp;</span>
						</div>
						<div class="form-group">
							<label class="color-label">Apellido <i class="glyphicon glyphicon-pencil color-edit"></i></label>
							{!! Form::text('apellido','',['class'=>'form-control']) !!}
						</div>
						<div class="form-group">
							<label class="color-label">Correo electronico <i class="glyphicon glyphicon-pencil color-edit"></i></label>
							{!! Form::text('email','',['class'=>'form-control']) !!}
							<span>Aquí recibirás los mensajes de tus compradores</span>
						</div>
						<div class="form-group">
							<label class="color-label" style="display:block;">Teléfono celular <i class="glyphicon glyphicon-pencil color-edit"></i></label>
							<select name="code" class="form-control" style="display:inline;width:30%;">
								@foreach($codes as $code)
									<option value="{{$code->id}}">{{$code->iso}}(+{{$code->phonecode}})</option>
								@endforeach
							</select>
							{!! Form::text('celular','',['class'=>'form-control', 'style'=>'width:65%;display:inline;']) !!}
							<span>Aquí recibirás información de tus compradores</span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="color-label">Direccion de despacho <i class="glyphicon glyphicon-pencil color-edit"></i></label>
							{!! Form::text('faddress','',['class'=>'form-control']) !!}
							<span>Aquí recibirás los mensajes de tus compradores</span>
						</div>
						<div class="form-group">
							<label class="color-label">Direccion complementaria <i class="glyphicon glyphicon-pencil color-edit"></i></label>
							{!! Form::text('laddress','',['class'=>'form-control']) !!}
							<span>Aquí recibirás los mensajes de tus compradores</span>
						</div>
						<div class="form-group">
							<label class="color-label" style="display:block;">Ciudad <i class="glyphicon glyphicon-pencil color-edit"></i></label>
							{!! Form::select('ciudad',$countries,'',['class'=>'form-control', 'style'=>'width:60%;display:inline;']) !!}
							{!! Form::checkbox('viewciudad', 'true', true) !!} <span style="color:#6E6E6E; font-size:1em;">Solo yo</span>
						</div>
						<div class="form-group">
							<label class="color-label" style="display:block;">Código postal <i class="glyphicon glyphicon-pencil color-edit"></i></label>
							{!! Form::text('cp','',['class'=>'form-control','style'=>'width:60%;display:inline;']) !!} 
							{!! Form::checkbox('viewcp', 'true', true) !!} <span style="color:#6E6E6E; font-size:1em;">Solo yo</span>
						</div>
					</div>
				</div>
				<div class="col-md-12 next-right">
					<br>
					<br>
					<button type="submit" class="butto-formns navbar-right botton-margin">CONTINUAR</button>
					<a href="{{url('out-config-shymow-shop')}}"  class="butto-blank navbar-right botton-margin">CANCELAR</a>
				</div>	
		{!! Form::close() !!}
	</div>
</div>
@stop

@section('scripts')
<script>
	jQuery(document).ready(function($) {
		var validator = new FormValidator('general-config', [{
		    name: 'nombre',
		    display: 'Nombre',
		    rules: 'required'
		},{
		    name: 'apellido',
		    display: 'Apellido',
		    rules: 'required'
		},{
		    name: 'email',
		    display: 'Correo',
		    rules: 'required'
		},{
		    name: 'celular',
		    display: 'Celular',
		    rules: 'required'
		},{
		    name: 'cp',
		    display: 'Código postal',
		    rules: 'required'
		},{
		    name: 'codigo',
		    display: 'Código de area',
		    rules: 'required'
		},{
		    name: 'faddres',
		    display: 'Direccion',
		    rules: 'required'
		},{
		    name: 'ciudad',
		    display: 'Ciudad',
		    rules: 'required'
		}], function(errors, event) {
		    if (errors.length > 0) {
		        var errorString = '';

		        for (var i = 0, errorLength = errors.length; i < errorLength; i++) {
		            errorString += errors[i].message + '<br />';
		        }
		        $('#errors-validate').slideDown('fast');
		        $('#errors-validate').html(errorString);
		    }
		});
	});
		
</script>
@stop