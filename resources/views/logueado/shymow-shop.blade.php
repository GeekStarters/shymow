@extends('logueado.layouts.content-layout-shop')

@section('content-logueo')
<div class="col-sm-12 favorits">
	@if($count_data > 0)
		<br>
		@foreach($products as $product)
			@include('flash::message')
			<div class="col-sm-6">
				<div class="content-post no-background">
					<div class="post-body tendencias-post shop-header-radius shop-background">
						<div class="post-media">
							@if($product->id_user == Auth::id())
								<a href="{{url('/delete_product/'.$product->id)}}" class="delete_post" style="position: absolute;right: 20px;top: 15px;">
									<i class="glyphicon glyphicon-remove"></i>
								</a>
							@endif
							<img src="{{url($product->path)}}" class="shop-border-radius" alt="shymow">
						</div>
						<div class="shop-content">
							<div class="col-sm-12 col-md-8">
								<h2 class="title-shop">{{DataHelpers::getSubString($product->title, 10)}}</h2>
								<p>{{DataHelpers::getSubString($product->description,50)}}</p>						
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
								<span class="post-qualification-product border-right-post-tendencias" data-user_id="{{$product->id_user}}">
									@if((int)$product->qualification < 5)
											@for ($i = 1; $i <= (int)$product->qualification; $i++)
												<a data-star="{{$i}}" class="glyphicon glyphicon-star qualification-popular" data-post="{{$product->id}}"></a>
											@endfor
											@for ($i = 1; $i <= 5-(int)$product->qualification; $i++)
												<a data-star="{{(int)$product->qualification+$i}}" class="glyphicon glyphicon-star qualification-no-popular" data-post="{{$product->id}}"></a>
											@endfor
									@else
											@for ($i = 1; $i <= (int)$product->qualification; $i++)
												<a data-star="{{$i}}" class="glyphicon glyphicon-star qualification-popular" data-post="{{$product->id}}"></a>
											@endfor
									@endif
									
									
								</span>
								<div class="dropup">
									<span class="post-share border-right-post-tendencias">
										  <span class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										    
											<span class="number-post">{{$product->share}}</span> <i class="fa fa-share-alt" aria-hidden="true"></i>
										  </span>
										  <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
										    <!-- <li><a href="#">Facebook</a></li>
										    <li><a href="#">Twitter</a></li> -->
										    <li role="separator" class="divider"></li>
										    <li><a data-post_id="{{$product->id}}" data-user_id="{{$product->id_user}}" class="share_product_shymow" data-toggle="modal" data-target="#myModal">Compartir</a></li>
										  </ul>
									</span>
								</div>
								@if($product->userLike == Auth::user()->id)
									<span class="like-me-product post-like-me-active border-right-post-tendencias" data-like="{{$product->id}}" data-user_id="{{$product->id_user}}">
										<span class="number-post">{{$product->like}}</span> <span class="glyphicon glyphicon-heart"></span>
									</span> 
								@else
									<span class="like-me-product post-like-me border-right-post-tendencias" data-like="{{$product->id}}" data-user_id="{{$product->id_user}}">
										<span class="number-post">{{$product->like}}</span> <span class="glyphicon glyphicon-heart"></span>
									</span> 
								@endif
								<span class="post-comment border-right-post-tendencias box-comment-product" data-trend="{{$product->id}}">
									<span class="number-post post_change">{{$product->comments}}</span> <span class="glyphicon glyphicon-comment"></span>
								</span>
		<br>
							</div>
							<br>
						</div>
					</div>
					<div class="box-comment-content">
						<div class="box-comment-header-product center-block" data-user_id="{{$product->id}}" style="width:90%;">
							<div class="form-group">
								<label>Comentario</label>
								<label class="text-danger"></label>
								{!! Form::open(['method' => 'get'])  !!}
									{!! Form::text('comment','',['class'=>'form-control']) !!}
								{!! Form::close() !!}
							</div>
						</div>
						<hr>
						<div class="box-comment-body no-background">
							@if($product->comments < 1)
								<h3 style="margin-left:10px; color:#CCC;margin-bottom: 10px; font-family:gothamTwo;">No existen comentarios</h3>
							@endif
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Compartir</h4>
      </div>
      {!! Form::open(['url' => '','method' => 'post','files' => false]) !!}

      	<div class="col-md-12" id="modal_container">
      		
      	</div>
	    <div class="clearfix"></div>

	    
	{!! Form::close() !!}
    </div>
  </div>
</div>
@stop
@section('scripts')
<script>
  jQuery(document).ready(function($) {
    $('#flash-overlay-modal').modal();
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
  });
</script>
@stop