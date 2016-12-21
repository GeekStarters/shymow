@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="col-sm-12">
	
	@if(count($users)>0)
	<div class="row">
		<div class="col-md-6 col-sm-offset-2">
			<!-- {!! Form::open() !!}
				<div class="form-group">
					{!! Form::label('buscar','Buscar a:') !!}
					{!! Form::text('buscar','',['class'=>'form-control','placeholder'=>'Usuario']) !!}
				</div>
			{!! Form::close() !!} -->
		</div>
	</div>
	<div class="row">
    	@foreach($users as $user)
    		@if($user->id != Auth::id())
    			<div class="col-sm-5 col-md-3">
			    	<div class="thumbnail">
				      <img src="{{url($user->img_profile)}}" alt="{{$user->name}}">
				      <div class="caption">
				        <h3><a href="{{url('view_user/'.$user->id)}}">{{DataHelpers::getSubString($user->name, 15)}}</a></h3>
				        <p>
				        	<br>
				        	<ul>
				        		<li><b>País: </b>{{DataHelpers::getSubString($user->pais, 15)}}</li>
				        		<li><b>Estado: </b>{{DataHelpers::getSubString($user->provincia, 15)}}</li>
				        		<li><b>Municipio: </b>{{DataHelpers::getSubString($user->municipio, 10)}}</li>
				        		<li><b>Trabajo: </b>{{DataHelpers::getSubString($user->work, 15)}}</li>
				        	</ul>
				        	<br>
				        </p>
				        <p>
							<?php $countA = 0 ?>
				        	@if(count($user_contents) > 0)
			        			@foreach($user_contents as $friends)
			        				@if($friends->id == $user->id)
			        					<a href="{{url('add_friends/'.$user->id)}}" class="btn btn-danger" role="button">Eliminar</a>
			        					<?php $countA++ ?>
			        				@endif
			        			@endforeach
				        	@endif
				        	@if(count($user_pending) > 0)
			        			@foreach($user_pending as $pendings)
			        				@if($pendings->id == $user->id)
			        					<a href="{{url('add_friends/'.$user->id)}}" class="btn btn-warning" role="button">Cancelar</a>
			        					<?php $countA++ ?>

			        					@foreach($user_accept as $accept)
					        				@if($accept[0] == $pendings->id && $accept[1] == Auth::id())
					        					<a href="{{url('accept_friends/'.$user->id)}}" class="btn btn-default-ac" role="button">Aceptar</a>
					        					<?php $countA++ ?>
					        				@endif
					        			@endforeach
			        				@endif
			        			@endforeach
				        	@endif

				        	@if(count($user_declined) > 0 || $countA < 1)
			        			@foreach($user_declined as $declineds)
			        				@if($declineds->id == $user->id)
			        					<a href="{{url('add_friends/'.$user->id)}}" class="btn btn-default-s" role="button">Agregar</a>
			        					<?php $countA++ ?>
			        				@endif
			        			@endforeach
			        			@if($countA < 1)
		        					<a href="{{url('add_friends/'.$user->id)}}" class="btn btn-default-s" role="button">Agregar</a>
		        					<?php $countA++ ?>
		        				@endif
				        	@endif	   	
				        </p>
				      </div>
				    </div>
	  			</div>
    		@endif
	    @endforeach
	</div>
	{!! $users->render() !!}
	@else
    	<div class="row">
			<div class="col-md-6 col-sm-offset-2">
				<h3>No hay más usuarios</h3>
			</div>
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

		$('#flash-overlay-modal').modal();
	});
</script>
@stop