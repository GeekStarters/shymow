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
			<div class="col-md-4 border-right">
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
		{!! Form::open(array('name' => 'general-config', 'url' => 'save-general-profile','method'=>'Post')) !!}
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
							{!! Form::text('nombre',Auth::user()->fname,['class'=>'form-control', 'required' => 'required']) !!}
							<span>&nbsp;</span>
						</div>
						<div class="form-group">
							<label class="color-label">Apellido <i class="glyphicon glyphicon-pencil color-edit"></i></label>
							{!! Form::text('apellido',Auth::user()->lname,['class'=>'form-control', 'required' => 'required']) !!}
						</div>
						<div class="form-group">
							<label class="color-label">Correo electronico <i class="glyphicon glyphicon-pencil color-edit"></i></label>
							{!! Form::text('email',Auth::user()->email,['class'=>'form-control disabled ', 'required' => 'required']) !!}
							{!! Form::checkbox('view_email', 'true', Auth::user()->view_email) !!} <span style="color:#6E6E6E; font-size:1em;">Solo yo</span>
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
							{!! Form::text('celular',Auth::user()->phone,['class'=>'form-control', 'style'=>'width:65%;display:inline;', 'required' => 'required']) !!}
							{!! Form::checkbox('view_phone', 'true', Auth::user()->view_phone) !!} <span style="color:#6E6E6E; font-size:1em;">Solo yo</span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="grup-form">
							<label class="color-label">Fecha de nacimiento <i class="glyphicon glyphicon-pencil color-edit"></i></label>
							<div class="row">
								<div class="col-sm-4">
									{!! Form::number('dia',$d,['placeholder'=>'Día','class'=>'form-control date', 'required' => 'required']) !!}
								</div>
								<div class="col-sm-4">
									{!! Form::number('mes',$m,['placeholder'=>'Mes','class'=>'form-control date', 'required' => 'required']) !!}
								</div>
								<div class="col-sm-4">
									{!! Form::number('anio',$y,['placeholder'=>'Año','class'=>'form-control date', 'required' => 'required']) !!}
								</div>
							</div>
							{!! Form::checkbox('view_birth', 'true', Auth::user()->view_birth) !!} <span style="color:#6E6E6E; font-size:1em;">Solo yo</span>
						</div>	
						<br>
						<div class="form-group">
							<label class="color-label" style="display:block;">País <i class="glyphicon glyphicon-pencil color-edit"></i></label>
							@if(!empty($myCountry))
								{!! Form::select('pais',array($myCountry->id => $myCountry->name) + $countries,'',['class'=>'form-control','required' => 'required','style'=>'width:60%;display:inline;']) !!}	
							@else

								{!! Form::select('pais',array('' => 'País') + $countries,'',['class'=>'form-control','required' => 'required','style'=>'width:60%;display:inline;']) !!}	
							@endif
							{!! Form::checkbox('view_country', 'true', Auth::user()->view_country) !!} <span style="color:#6E6E6E; font-size:1em;">Solo yo</span>
							
						</div>
						<div class="form-group">
							<label class="color-label" style="display:block;">Genero <i class="glyphicon glyphicon-pencil color-edit"></i></label>
							{!! Form::select('genero', array('m' => 'Masculino', 'f' => 'Femenino'),Auth::user()->genero,['class'=>'form-control', 'required' => 'required','style'=>'width:60%;display:inline;']) !!}
							{!! Form::checkbox('view_gender', 'true', Auth::user()->view_gender) !!} <span style="color:#6E6E6E; font-size:1em;">Solo yo</span>
							
						</div>
						<br>
						<div class="form-group">
							<label class="color-label" style="display:block;">Código postal <i class="glyphicon glyphicon-pencil color-edit"></i></label>
							{!! Form::text('cp',Auth::user()->cp,['class'=>'form-control','style'=>'width:60%;display:inline;', 'required' => 'required']) !!} 
							{!! Form::checkbox('view_cp', 'true', Auth::user()->view_cp) !!} <span style="color:#6E6E6E; font-size:1em;">Solo yo</span>
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
		    name: 'pais',
		    display: 'Pais',
		    rules: 'required'
		},{
		    name: 'dia',
		    display: 'Dia',
		    rules: 'required'
		},{
		    name: 'mes',
		    display: 'Mes',
		    rules: 'required'
		},{
		    name: 'anio',
		    display: 'Año',
		    rules: 'required'
		},{
		    name: 'genero',
		    display: 'Genero',
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
@extends('logueado.layouts.content-float-chat')