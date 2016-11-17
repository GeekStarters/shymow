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
			        	@if($user->user1 == Auth::id() || $user->user2 == Auth::id())
			        		@if($user->status == 1)
			        			<a href="{{url('add_friends/'.$user->user_id)}}" class="btn btn-danger" role="button">Eliminar</a>
			        		@elseif($user->status == 2)
			        			<a href="{{url('add_friends/'.$user->user_id)}}" class="btn btn-default-s" role="button">Agregar</a>
			        		@elseif($user->status == 0)
			        			<a href="{{url('add_friends/'.$user->user_id)}}" class="btn btn-warning" role="button">Cancelar</a>
			        		@endif
			        	@else
			        		<a href="{{url('add_friends/'.$user->user_id)}}" class="btn btn-default-s" role="button">Agregar</a>
			        	@endif			        	
			        </p>
			      </div>
			    </div>
  			</div>
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