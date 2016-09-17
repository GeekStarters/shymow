@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="col-sm-12 favorits">
	<div class="interesting-header">
	<br>
		<h2 class="title-trends text-center">#DeadPool</h2>
		<br>
	</div>
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
							<a href="">
								<i class="glyphicon glyphicon-user"></i>
								<i class="glyphicon glyphicon-plus"></i>
							</a>
						</div>

						<div class="post-user">
							<div class="post-icono"><a href="#"><img src="{{url($trend->img_profile)}}" alt="shymow"></a></div>
							<div class="post-user"><a href="#">{{$trend->user }}</a></div>
							<!-- <div class="post-twitt"><span>@Robe_extremo</span></div> -->
						</div>
					</div>
					<br>
					<div class="clearfix"></div>
					<div class="post-description hashtag-post">
						{{$trend->description}}

						@if(isset($trend->path))
							<img src="{{url($trend->path)}}" class="img-responsive" alt="Shymow">
						@endif
					</div>
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
								<span class="number-post">{{$trend->qualification}}</span> <i class="fa fa-share-alt" aria-hidden="true"></i>
							</span>
							<span class="post-like-me border-right-post-tendencias">
								<span class="number-post">{{$trend->like}}</span> <span class="glyphicon glyphicon-heart"></span>
							</span>
							<span class="post-comment border-right-post-tendencias">
								<span class="number-post">{{$trend->share}}</span> <span class="glyphicon glyphicon-comment"></span>
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

</div>
@stop
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