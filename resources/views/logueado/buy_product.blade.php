@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="col-md-12">
	<br>
	<div class="col-md-10 col-md-offset-1 out-padding create-product-container">
		@if($count > 0)
			{!! Form::open(array('name' => 'buy', 'url' => 'https://www.sandbox.paypal.com/cgi-bin/webscr','method'=>'Post')) !!}
				<input type="hidden" name="cmd" value="_xclick">
			    <input type="hidden" name="business" value="melvingilberto-facilitator@gmail.com">
			    <!-- <input type="hidden" name="business" value="{{$store['original']['email_store']}}"> -->
			    <input type="hidden" name="no_shipping" value="2">
			    <input type="hidden" name="no_note" value="1">
			    <input type="hidden" name="currency_code" value="USD">
			    <input type="hidden" name="ES" value="AU">
			    <input type="hidden" name="bn" value="PP-BuyNowBF">
    			<input type="hidden" name="return" value="{{url('buy_success')}}">
    			<input type="hidden" name="cancel_return" value="{{url('buy_cancel')}}">
    			<input type="hidden" name="currency_code" value="EUR">
				@foreach($products as $product)

			    	<input type="hidden" name="item_number" value="{{$product->id}}">
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
											<h2 class="h2-header" style="margin-left:20px;">{{$product->title}}</h2>

			   								<input type="hidden" name="item_name" value="{{$product->title}}">
										<hr>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-5">
									<img src="{{url($product->path)}}" class="img-responsive" alt="Shymow shop">
								</div>
								<div class="col-md-7">
									<p style="font-size:1.1em;">
										{{$product->description}}
									</p>
									<br>
									<h2 class="price" style="font-size:2em !important;">
										Precio:	<span id="precio">{{$product->price}}</span>€
									</h2>

									<h2 class="price" style="font-size:2em !important;">
										Cantidad:	{{$product->stock}}
									</h2>
									<br>
									<div class="form-group">
										<label for="">Cantidad</label>
										{!! Form::number('quantity','1',['class'=>'form-control','required','id' => 'cantidad']) !!}
									</div>
									<div class="form-group">
										<h2 class="price" style="font-size:1.5em !important;">
										Monto:	<span id="monto">{{$product->price}}</span> €
			    						<!-- <input type="hidden" id="amount" name="amount" value="{{$product->price}}"> -->
			    						<input type="hidden" name="amount" value="{{$product->price}}">
									</h2>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 next-right">
							<br>
							<br>
							<button type="submit"   class="butto-blank navbar-right botton-margin">COMPRAR <i class="glyphicon glyphicon-shopping-cart"></i></button>
							<a href="{{url('shymow-shop')}}"  class="butto-danger navbar-right botton-margin">CANCELAR</a>
						</div>	
					</div>
				@endforeach
			{!! Form::close() !!}
		@endif
	</div>
</div>
@stop

@section('scripts')
<script>
	jQuery(document).ready(function($) {
		var price = parseInt($('#precio').text());
		$('#cantidad').keyup(function(event) {
			/* Act on the event */
			var cantidad = parseInt($(this).val());

			if(isNaN(cantidad)){
				cantidad = 1;
			}
			if(cantidad == 0){
				cantidad = 1;
			}

			var newMonto = cantidad*price;
			console.log(newMonto);
			$('#monto').text(newMonto);
			// $('#amount').attr('value',newMonto);

		});
		var validator = new FormValidator('buy', [{
		    name: 'nombre',
		    display: 'Nombre',
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