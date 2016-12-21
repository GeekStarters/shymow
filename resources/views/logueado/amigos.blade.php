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
							@if(isset($friend->redes))
                              @for($i=0; $i<count($socialNet);$i++)
                                @if(isset(json_decode($friend->redes,true)[$socialNet[$i]]))
                                  @foreach( json_decode($friend->redes,true)[$socialNet[$i] ] as $red)

                                  <a href="{{url($red)}}" target="_blank"><img src="{{url('img/profile/'.$socialNet[$i].'-post.png')}}" alt="shymow"></a>
                                  @endforeach
                                @endif
                              @endfor
                            @endif
						</div>
						<div class="friend-name">
							@if(isset($friend->alias))
								<a href="{{url('view_user/'.$friend->user_id)}}"><h2>{{ $friend->alias }}</h2></a>
							@elseif(isset($friend->apodo))
								<a href="{{url('view_user/'.$friend->user_id)}}"><h2>{{ $friend->apodo }}</h2></a>
							@else
								<a href="{{url('view_user/'.$friend->user_id)}}"><h2>{{ $friend->name }}</h2></a>
							@endif
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