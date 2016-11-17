@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="col-sm-12 favorits">
	<div class="interesting-header">
	<br>
		<h2 class="title-trends text-center">#{{$name_trends->name }}</h2>
		<br>
	</div>
	@if(count($trends) > 0)
		<div class="col-sm-3" style="position:absolute;">
			<div class="popular-pic">
				<h2>FOTOS</h2>
				<div class="clearfix"></div>
				@if(count($images)< 1)
					No se encontraron
				@else 
					@foreach($images as $image)
						<div class="pic"><img src="{{url($image)}}" alt="" class="img-responsive"></div>
					@endforeach
				@endif
			</div>
		</div>
		@foreach($trends as $trend)
			<div class="col-sm-offset-3 col-sm-9">
				<div class="content-post no-background">
					<div class="post-body tendencias-post">
						<div class="post-header">

							<div class="post-follow">
								<a 
									@if($trend->follow)
										class="follow-post-active"
									@else
										class="follow-post-desactive"
									@endif 


									data-follow="{{$trend->id_post}}">
									<i class="glyphicon glyphicon-user"></i>
									<i class="glyphicon glyphicon-plus"></i>
								</a>
							</div>

							<div class="post-user">
								<div class="post-icono"><a href="{{url('view_user/'.$trend->profil_id)}}"><img src="{{url($trend->img_profile) }}" alt="shymow"></a></div>
								<div class="post-user"><a href="{{url('view_user/'.$trend->profil_id)}}">{{$trend->user }}</a></div>
								<div class="post-twitt"><span>@Robe_extremo</span></div>
							</div>
						</div>
						<br>
						<div class="clearfix"></div>
						<div class="post-description hashtag-post">
							{{$trend->description}}
							@if(isset($trend->path))
								<img src="{{url($trend->path)}}" class="img-responsive" alt="Shymow"></img>
							@endif
						</div>
						<div class="post-media">

							<!-- <img src="img/profile/star/golden-disc.jpg" alt="shymow"> -->
						</div>
						<div class="post-footer block-center text-center">
							<div class="post-data-footer-face ">
								<span class="post-qualification  border-right-post-tendencias">
									@if((int)$trend->qualification < 5)
											@for ($i = 1; $i <= (int)$trend->qualification; $i++)
												<a data-star="{{$i}}" class="glyphicon glyphicon-star qualification-popular" data-post="{{$trend->id_post}}"></a>
											@endfor
											@for ($i = 1; $i <= 5-(int)$trend->qualification; $i++)
												<a data-star="{{(int)$trend->qualification+$i}}" class="glyphicon glyphicon-star qualification-no-popular" data-post="{{$trend->id_post}}"></a>
											@endfor
									@else
											@for ($i = 1; $i <= (int)$trend->qualification; $i++)
												<a data-star="{{$i}}" class="glyphicon glyphicon-star qualification-popular" data-post="{{$trend->id_post}}"></a>
											@endfor
									@endif
									
									
								</span>
								<div class="dropup">
									<span class="post-share border-right-post-tendencias">
										  <span class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										    
											<span class="number-post">{{$trend->share}}</span> <i class="fa fa-share-alt" aria-hidden="true"></i>
										  </span>
										  <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
										    <li><a href="#">Facebook</a></li>
										    <li><a href="#">Twitter</a></li>
										    <li role="separator" class="divider"></li>
										    <li><a data-post_id="{{$trend->id_post}}" data-user_id="{{$trend->id_user}}" class="share_post_shymow" data-toggle="modal" data-target="#myModal">Compartir</a></li>
										  </ul>
									</span>
								</div>
								@if($trend->userLike == Auth::user()->id)
									<span class="like-me post-like-me-active border-right-post-tendencias" data-like="{{$trend->id_post}}">
										<span class="number-post">{{$trend->like}}</span> <span class="glyphicon glyphicon-heart"></span>
									</span> 
								@else
									<span class="like-me post-like-me border-right-post-tendencias" data-like="{{$trend->id_post}}">
										<span class="number-post">{{$trend->like}}</span> <span class="glyphicon glyphicon-heart"></span>
									</span> 
								@endif

								<span class="post-comment border-right-post-tendencias box-comment" data-trend="{{$trend->id_post}}">
									<span class="number-post post_change">{{$trend->posts}}</span> <span class="glyphicon glyphicon-comment"></span>
								</span>
								<br>
							</div>
							<br>
						</div>
					</div>
					<div class="box-comment-content">
						<div class="box-comment-header center-block" style="width:90%;">
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
							@if($trend->posts < 1)
								<h3 style="margin-left:10px; color:#CCC;margin-bottom: 10px; font-family:gothamTwo;">No existen comentarios</h3>
							@endif
						</div>
					</div>
					<br>
				</div>
			</div>
		@endforeach
		<div class="col-sm-9 col-sm-offset-3">
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
		</div>
	@else
		<div class="col-md-12">
			<h2 class="text-center">No hay tendencias</h2>
		</div>
	@endif

</div>
@stop
@extends('logueado.layouts.content-float-chat')
@section('scripts')
<script>
	jQuery(document).ready(function($) {
		
		Hashtag.setOptions({
		    templates: {
		        'fb': '<a href="{{url("tendencia")}}/{#n}">{#}</a>'
		    }
		});
		Hashtag.replaceTags('.hashtag-post','fb');
	});
</script>
@stop