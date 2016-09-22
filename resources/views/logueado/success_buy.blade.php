@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="col-md-12">
	<br>
	<div class="col-md-10 col-md-offset-1 out-padding create-product-container">
		@if($count > 0)
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
										<hr>
										<h3 class="text-success" style="font-family:gothamTwo;">Producto Adquirido</h3>
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
										Monto total:	<span id="precio">{{$monto}}</span>€
									</h2>
								</div>
							</div>
						</div>
						<div class="col-md-12 next-right">
							<br>
							<a href="{{url('shymow-shop')}}"  class="butto-danger navbar-right botton-margin">SHYMOW SHOP</a>
						</div>	
					</div>
				@endforeach
		@endif
	</div>
</div>
@stop
