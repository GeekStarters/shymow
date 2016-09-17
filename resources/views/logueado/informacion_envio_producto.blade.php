@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="col-md-12">
	<br>
	<div class="col-md-10 col-md-offset-1 out-padding create-product-container">
		<div class="create-product-header">
			<div class="col-md-4 active-background-product-agregate border-right-active">
				<h2 class="text-center">
					Qué quieres publicar
				</h2>
			</div>
			<div class="col-md-4 active-background-product-agregate border-right-active">
				<h2 class="text-center">
					Describe tu producto
				</h2>
			</div>
			<div class="col-md-4">
				<h2 class="text-center">
					Confirma tu producto
				</h2>
			</div>
			<div class="clearfix"></div>
		</div>
		{!! Form::open(array('url' => 'crear-producto','name'=>'type-send')) !!}
			<div class="create-product-content">
				<br><br>
				<div class="col-md-offset-1 col-md-11 information-producto-header">
					@foreach ($errors->all() as $error)
	                	<h2 class="text-danger" style="color: #a94442;font-size:1em;">{{ $error}}</h2>   
	                @endforeach
					<h2 class="text-danger" style="display:none;color: #a94442;font-size:1em;" id="errors-validate"></h2>
					<h2>Envios</h2>
					@foreach($types as $type)
						<div class="form-group">
							{!! Form::radio('send-product',$type->id) !!} <span>{{$type->name}}</span>
						</div>
					@endforeach
				</div>
				<br>
				<div class="col-md-12 next-right">
					<br>
					<br>
					<button class="butto-formns navbar-right botton-margin">CONFIRMAR PUBLICACIÓN</button>

					<a href="{{ url('informacion-producto') }}" class="butto-formns navbar-right botton-margin" style="margin-right:20px;">REGRESAR</a>
				</div>	
			</div>
		{!! Form::close() !!}
	</div>
	<div class="col-md-1 create-product-support">
		<a href="{{url('ayuda_shop')}}"><img src="img/create_product/support.png" class="img-responsive" alt="Soporte"></a>
	</div>

	<div class="row">
		<div class="col-md-12 text-center create-product-footer">
			<p>
				¿Conoces las políticas de Shymow Shop? Has click aquí para conocerlas
				<a href="{{url('politicas_shop')}}">Politicas de Shymow Shop</a>
			</p>
		</div>
	</div>
</div>
@stop
@section('scripts')
<script>
	jQuery(document).ready(function($) {
		var validator = new FormValidator('type-send', [{
		    name: 'send-product',
		    display: 'Tipo de envio',
		    rules: 'required|less_than[4]'
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