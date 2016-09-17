@extends('logueado.layouts.content-layout')


@section('content-logueo')
<div class="col-sm-offset-4 col-sm-8 favorits">
	<div class="interesting-header">
		<h2>Tendencias</h2>
	</div>
	<hr>
	@foreach($trends as $trend)
		<div class="col-sm-12">
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
							<div class="post-icono"><a href=""><img src="{{$trend->img_profile }}" alt="shymow"></a></div>
							<div class="post-user"><a href="">{{$trend->user }}</a></div>
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
								<span class="number-post">{{$trend->share}}</span> <i class="fa fa-share-alt" aria-hidden="true"></i>
							</span>
							<span class="post-like-me border-right-post-tendencias">
								<span class="number-post">{{$trend->like}}</span> <span class="glyphicon glyphicon-heart"></span>
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
		Hashtag.replaceTags('.hashtag-top','fb');
	});
</script>
@stop