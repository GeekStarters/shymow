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
			<div class="col-md-4 border-right">
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
		{!! Form::open(array('url' => 'envio-producto','method'=>'POST','name'=>'information_product','files' => true)) !!}
			<div class="create-product-content">
				<br><br>
				<div class="col-md-offset-1 col-md-11 information-producto-header">
				@foreach ($errors->all() as $error)
                	<h2 class="text-danger" style="color: #a94442;font-size:1em;">{{ $error}}</h2>   
                @endforeach
				<h2 class="text-danger" style="display:none;color: #a94442;font-size:1em;" id="errors-validate"></h2>
					<h2>Sube hasta 3 fotos de tu producto</h2>
				</div>
				<br>
				<div class="clearfix"></div>
				<div class="col-md-10 col-md-offset-1 content-upload-img-information">
					<div class="information-producto-upload-img center-block col-md-4" id="oneImage">
						<div class="border-img-information">
							<img src="img/create_product/add_image.png" alt="upload">
							<h2>Agregar</h2>
							{!!Form::file('oneImage',["id"=>"input-one-image","style"=>"display:none;"]);!!}
						</div>
					</div>
					<div class="information-producto-upload-img center-block col-md-4">
						<div class="border-img-information" id="twoImage">
							<img src="img/create_product/add_image.png" alt="upload">
							<h2>Agregar</h2>
							{!!Form::file('twoImage',["id"=>"input-two-image","style"=>"display:none;"]);!!}
						</div>
					</div>
					<div class="information-producto-upload-img center-block col-md-4">
						<div class="border-img-information" id="threeImage">
							<img src="img/create_product/add_image.png" alt="upload">
							<h2>Agregar</h2>
							{!!Form::file('threeImage',["id"=>"input-three-image","style"=>"display:none;"]);!!}
						</div>
					</div>
					
					<div class="row" id="contentImages">
						<div class="center-block col-md-4" id="imageOne">
							<img class="img-responsive" alt="Shymow shop" id="content-one-image" style="display:none;">
						</div>
						<div class="center-block col-md-4" id="imageTwo">
							<img class="img-responsive" alt="Shymow shop" id="content-two-image" style="display:none;">
						</div>
						<div class="center-block col-md-4" id="imageThree">
							<img class="img-responsive" alt="Shymow shop" id="content-three-image" style="display:none;">
						</div>
					</div>
				</div>
				<div class="create-product-title">
					<div class="col-md-4 col-sm-12">
						<p>Descripción del producto</p>
						<span>Por ejemplo: colores disponibles, tallas, condición del producto</span>
					</div>
					<div class="col-md-8 col-sm-12">
							{!! Form::textarea('description','',['class'=>'form-control']); !!}
					</div>
				</div>
				<div class="col-md-12 information-producto-footer">
					<span>
						<label>Precio:</label>
						{!! Form::text('precio','',['class' => 'form-control']) !!}
					</span>
					<span>
						<label>Unidades disponibles:</label>
						{!! Form::number('stock','',['class' => 'form-control']) !!}
					</span>
					<span>
						<label>Garantia:</label>
						{!! Form::radio('garantia','true',true) !!} <span>Si</span>
						{!! Form::radio('garantia','false') !!} <span>No</span>
					</span>
					<div class="clearfix"></div>
				</div>
				<div class="col-md-12 next-right">
					<br>
					<br>
					<button class="butto-formns navbar-right botton-margin">CONTINUAR</button>
					<a href="{{ url('agregar-producto') }}" class="butto-formns navbar-right botton-margin" style="margin-right:20px;">REGRESAR</a>
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
		var validator = new FormValidator('information_product', [{
		    name: 'oneImage',
		    display: 'Imagen',
		    rules: 'required|is_file_type[gif,png,jpg]'
		}, {
		    name: 'twoImage',
		    display: 'Imagen',
		    rules: 'is_file_type[gif,png,jpg]'
		},{
		    name: 'threeImage',
		    display: 'Imagen',
		    rules: 'is_file_type[gif,png,jpg]'
		},{
		    name: 'description',
		    display: 'Descripción',
		    rules: 'required'
		}, {
		    name: 'precio',
		    display: 'Precio',
		    rules: 'required|decimal'
		}, {
		    name: 'stock',
		    display: 'Cantidad',
		    rules: 'required|is_natural'
		}, {
		    name: 'garantia',
		    display: 'Garantia',
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
		$('#oneImage').on('click', '.border-img-information img , .border-img-information h2', function(event) {
			event.preventDefault();
			/* Act on the event */
			$('#input-one-image').click();
		});
		$('#twoImage img, #twoImage h2').click(function(event) {
			/* Act on the event */
			event.preventDefault();
			$('#input-two-image').click();
		});
		$('#threeImage img,#threeImage h2').click(function(event) {
			/* Act on the event */
			event.preventDefault();
			$('#input-three-image').click();
		});
		$("#input-one-image").change(function(){
			var image = $('#content-one-image');
		    readURL(this,image);
		    image.fadeIn('slow');
		});
		$("#input-two-image").change(function(){
			var image = $('#content-two-image');
		    readURL(this,image);
		    image.fadeIn('slow');
		});
		$("#input-three-image").change(function(){
			var image = $('#content-three-image');
		    readURL(this,image);
		    image.fadeIn('slow');
		});
	});
	function readURL(input,image) {

	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	            image.attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
</script>
@stop