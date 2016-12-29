@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="col-sm-12">
	
	
	<div class="row">
		<div class="col-md-12">
			<a href="/all_users" class="btn btn-default">
				Agregar usuarios 
			</a>
			<!-- {!! Form::open() !!}
				<div class="form-group">
					{!! Form::label('buscar','Buscar a:') !!}
					{!! Form::text('buscar','',['class'=>'form-control','placeholder'=>'Usuario']) !!}
				</div>
			{!! Form::close() !!} -->
		</div>
	</div>
	<br>
	<div class="clearfix"></div>
	@if(count($user_pending)>0)
	<div class="row">
    	@foreach($user_pending as $user)
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
				        	<a href="{{url('accept_friends/'.$user->id)}}" class="btn btn-default-ac" role="button">Aceptar</a>
				        	<a href="{{url('add_friends/'.$user->id)}}" class="btn btn-warning" role="button">Cancelar</a>	
				        </p>
				      </div>
				    </div>
	  			</div>
    		@endif
	    @endforeach
	</div>
	@else
    	<div class="row">
			<div class="col-md-6 col-sm-offset-2">
				<h3>No hay Solicitud</h3>
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