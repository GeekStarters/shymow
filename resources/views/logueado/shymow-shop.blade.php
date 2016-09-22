@extends('logueado.layouts.content-layout-shop')


@section('content-logueo')
<div class="col-sm-12 favorits">
	@if($count_data > 0)
		<br>
		@foreach($products as $product)
			<div class="col-sm-6">
				<div class="content-post no-background">
					<div class="post-body tendencias-post shop-header-radius shop-background">
						<div class="post-media">
							<img src="{{url($product->path)}}" class="shop-border-radius" alt="shymow">
						</div>
						<div class="shop-content">
							<div class="col-sm-12 col-md-8">
								<h2 class="title-shop">{{$product->title}}</h2>
								<p>{{$product->description}}</p>						
							</div>
							<div class="col-sm-12 col-md-4">
								<h2 class="price" style="float:right;">{{ceil($product->price)}}€</h2>
								<br>
								<br>
								<div class="clearfix"></div>
								<a href="buy-product/{{$product->id}}" class="butto-formns" style="float:right;">Comprar</a>						
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="clearfix"></div>
						<div class="post-footer block-center text-center">
							<div class="post-data-footer-face ">
								<span class="post-qualification">
									<div class="qualification-popular border-right-post-tendencias">
										<span class="glyphicon glyphicon-star"></span>
										<span class="glyphicon glyphicon-star"></span>
										<span class="glyphicon glyphicon-star"></span>
										<span class="glyphicon glyphicon-star"></span>
										<span class="glyphicon glyphicon-star"></span>
									</div>
								</span>
								<span class="post-share border-right-post-tendencias">
									<span class="number-post">120</span> <i class="fa fa-share-alt" aria-hidden="true"></i>
								</span>
								<span class="post-like-me border-right-post-tendencias">
									<span class="number-post">380</span> <span class="glyphicon glyphicon-heart"></span>
								</span>
								<span class="post-comment border-right-post-tendencias">
									<span class="number-post">52</span> <span class="glyphicon glyphicon-comment"></span>
								</span>
								<br>
							</div>
							<br>
						</div>
					</div>
					<br>
				</div>
			</div>
		@endforeach
		<div class="clearfix"></div>
		<br>
		<br>
		<br>
		<div class="search-more-favorit">
			<div class="left">
				<hr>
			</div>
			<div class="center">
				<div>
					<span>CARGAR +</span>
				</div>
			</div>
			<div class="right">
				<hr>
			</div>
		</div>
		<div class="clearfix"></div>
		<br>
		<br>
	@else
		<h2>No hay productos</h2>
	@endif
</div>
@stop