@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="col-sm-12">
	
	@if(count($users)>0)
	<div class="row">
		<div class="col-md-6 col-sm-offset-2">
			{!! Form::open() !!}
				<div class="form-group">
					{!! Form::label('buscar','Buscar a:') !!}
					{!! Form::text('buscar','',['class'=>'form-control','placeholder'=>'Usuario']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
	<div class="row">
    	@foreach($users as $user)
    		@if($user->id != Auth::id())
    			<div class="col-sm-4 col-md-3">
			    	<div class="thumbnail">
				      <img src="{{url($user->img_profile)}}" alt="{{$user->name}}">
				      <div class="caption">
				        <h3><a href="{{url('view_user/'.$user->user_id)}}">{{$user->name}}</a></h3>
				        <p>
				        	<br>
				        	<ul>
				        		<li><b>País: </b>{{$user->pais}}</li>
				        		<li><b>Estado: </b>{{$user->provincia}}</li>
				        		<li><b>Municipio: </b>{{$user->municipio}}</li>
				        		<li><b>Trabajo: </b>{{$user->work}}</li>
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
			        				@endif
			        			@endforeach
				        	@endif

				        	@if(count($user_declined) > 0 || countA < 1)
			        			@foreach($user_declined as $declineds)
			        				@if($declineds->id == $user->id)
			        					<a href="{{url('add_friends/'.$user->id)}}" class="btn btn-default-s" role="button">Agregar</a>
			        					<?php $countA++ ?>
			        				@endif
			        			@endforeach
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
	});
</script>
@stop