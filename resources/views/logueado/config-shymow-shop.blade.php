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
			<div class="col-md-4 border-right">
				<a href="/notification_shop">
					<h2 class="text-center">
						Notificaciones
					</h2>
				</a>
			</div>
			<div class="col-md-4">
				<a href="/close_shop">
					<h2 class="text-center">
						Cerrar Shop
					</h2>
				</a>
			</div>
			<div class="clearfix"></div>
		</div>
		@if(!isset($store->active) || $store->active)

			{!! Form::open(array('name' => 'general-config', 'url' => 'processor_general_config','method'=>'Post')) !!}
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
						<div class="col-md-6">
							<div class="form-group">
								<label class="color-label">Nombre <i class="glyphicon glyphicon-pencil color-edit"></i></label>
								{!! Form::text('nombre',isset($store->first_name) ? $store->first_name : "",['class'=>'form-control']) !!}
								<span>&nbsp;</span>
							</div>
							<div class="form-group">
								<label class="color-label">Apellido <i class="glyphicon glyphicon-pencil color-edit"></i></label>
								{!! Form::text('apellido',isset($store->last_name) ? $store->last_name : "",['class'=>'form-control']) !!}
							</div>
							<div class="form-group">
								<label class="color-label">Correo electronico <i class="glyphicon glyphicon-pencil color-edit"></i></label>
								{!! Form::text('email',isset($store->email_store) ? $store->email_store : "",['class'=>'form-control']) !!}
								<span>Aquí recibirás los mensajes de tus compradores</span>
							</div>
							<div class="form-group">
								<label class="color-label" style="display:block;">Teléfono celular <i class="glyphicon glyphicon-pencil color-edit"></i></label>
								<select name="code" class="form-control" style="display:inline;width:30%;">
									@if(!empty($myCode))
										<option value="{{$myCode->phonecode}}">{{$myCode->iso}}(+{{$myCode->phonecode}})</option>
									@endif
									@foreach($codes as $code)
										<option value="{{$code->phonecode}}">{{$code->iso}}(+{{$code->phonecode}})</option>
									@endforeach
								</select>
								{!! Form::text('celular',isset($store->phone) ? $store->phone : "",['class'=>'form-control', 'style'=>'width:65%;display:inline;']) !!}
								<span>Aquí recibirás información de tus compradores</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="color-label">Direccion de despacho <i class="glyphicon glyphicon-pencil color-edit"></i></label>
								{!! Form::text('faddress',isset($store->address) ? $store->address : "",['class'=>'form-control']) !!}
								<span>Aquí recibirás los mensajes de tus compradores</span>
							</div>
							<div class="form-group">
								<label class="color-label">Direccion complementaria <i class="glyphicon glyphicon-pencil color-edit"></i></label>
								{!! Form::text('laddress',isset($store->further_office) ? $store->further_office : "",['class'=>'form-control']) !!}
								<span>Aquí recibirás los mensajes de tus compradores</span>
							</div>
							<div class="form-group">
								<label class="color-label" style="display:block;">Ciudad <i class="glyphicon glyphicon-pencil color-edit"></i></label>
								@if(!empty($myCountry))
									{!! Form::select('ciudad',array($myCountry[0]->id => $myCountry[0]->name) + $countries,'',['class'=>'form-control','required' => 'required','style'=>'width:60%;display:inline;']) !!}	
								@else
									{!! Form::select('ciudad',$countries,'',['class'=>'form-control', 'style'=>'width:60%;display:inline;']) !!}
								@endif
								{!! Form::checkbox('viewciudad', 'true', isset($store->view_country) ? $store->view_country : true) !!} <span style="color:#6E6E6E; font-size:1em;">Solo yo</span>
							</div>
							<div class="form-group">
								<label class="color-label" style="display:block;">Código postal <i class="glyphicon glyphicon-pencil color-edit"></i></label>
								{!! Form::text('cp',isset($store->cp) ? $store->cp : "",['class'=>'form-control','style'=>'width:60%;display:inline;']) !!} 
								{!! Form::checkbox('viewcp', 'true', isset($store->view_cp) ? $store->view_cp : true) !!} <span style="color:#6E6E6E; font-size:1em;">Solo yo</span>
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
		@else
			<a href="/active_store" class="btn btn-danger btn-lg text-center" style="text-align:center;margin:20px;">
				Activar cuenta
			</a>
		@endif
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
		    name: 'code',
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