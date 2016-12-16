@extends('logueado.layouts.content-layout')


@section('content-logueo')
<div class="col-sm-offset-4 col-sm-8 friends">
	
	@include('flash::message')
	@if(count($user_contents) > 0)
		@foreach ($user_contents as $friend)
			<div class="col-sm-4">
				<div class="content-friends">
					<div class="sub-content-friends">
						<div class="img-friend">
							<img src="{{ $friend->img_profile }}" alt="shymow">
						</div>
						<div class="friend-social">
							<a href="#"><img src="img/profile/facebook-post.png" alt="shymow"></a>
							<a href="#"><img src="img/profile/twitter-post.png" alt="shymow"></a>
							<a href="#"><img src="img/profile/linkedin-post.png" alt="shymow"></a>
							<a href="#"><img src="img/profile/pinterest.png" alt="shymow"></a>
							<a href="#"><img src="img/profile/instagram-post.png" alt="shymow"></a>
							<a href="#"><img src="img/profile/youtube-post.png" alt="shymow"></a>
						</div>
						<div class="friend-name">
							<a href="#"><h2>{{ $friend->name }}</h2></a>
						</div>
					</div>
				</div>
			</div>
	    
		@endforeach

	@else
		<a href="{{url('all_users')}}"><h2>Agrega amigos</h2></a>
	@endif
</div>
@stop
@extends('logueado.layouts.content-modal')
@extends('logueado.layouts.content-float-chat')
@section('scripts')
<script>
	jQuery(document).ready(function($) {
		$('#flash-overlay-modal').modal();
	});
</script>
@stop