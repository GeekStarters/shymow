@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="col-sm-5 col-sm-offset-3 identificate padding-aut">
	<div class="header-identificate">
		<h2>Vuelve a ingresar tu contraseña</h2>
	</div>
	<div class="identificate-content">
		@foreach ($errors->all() as $error)
        	<p class="text-danger" style="color: #a94442;font-size:1em;">{{ $error}}</p>   
        @endforeach
		<p id="errors-validate" style="display:none;color: #a94442;"></p>
		<p>Para modificar informacion confidencial, <br> es necesario que confirmes tu contraseña</p>
		<div class="identificate-user">
			<img src="{{url(Auth::user()->img_profile)}}" alt="Shymow shop">
			<h2>{{Auth::user()->name}}</h2>
		</div>
		{!! Form::open(array('method' => 'post', 'url' => 'validacion','name'=>'identificate')) !!}
			<div class="identification">
				<span>{{Auth::user()->email}}</span>
				<div class="clearfix"></div>
				{!!Form::password('password',['class'=>'form-control'])!!}
				<button class="butto-formns">INICIAR SESIÓN</button>
				<!-- <a href="{{url('forgot_password')}}">Olvidé mi contraseña</a> -->
			</div>
		{!!Form::close()!!}
	</div>
</div>
@stop
@extends('logueado.layouts.content-float-chat')
@section('scripts')
<script>
	jQuery(document).ready(function($) {
		var validator = new FormValidator('identificate', [{
		    name: 'password',
		    display: 'Password',
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