@extends('layouts.master')

@section('bodyStyle')
 class="reg_personal"
@endsection

@section('content')
	<nav class="nav-shymow">
		<ul class="nav navbar-nav navbar-right">
			<img src="img/logo.png" alt="shymow" style="max-width:200px; margin-right:20px; margin-left:20px;">
		</ul>
	</nav>
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="registro">
					<h2>¿Dónde podemos verte?</h2>
					<p>Si cuentas con redes sociales, cuéntale al mundo cuáles son</p>
				</div>
				<br><br>
				@include('flash::message')
				<div class="alert alert-warning" role="alert">
					Ejemplo: https://facebook.com <br>
					https://www.youtube.com/
				</div>
			</div>
			@foreach ($errors->register->all() as $error)
                  <p class="text-danger" style="color:#950c0c;">
                    <b style="color:#950c0c;">{{ $error}}</b>             
                  </p>
            @endforeach
            {!! Form::open(array('url' => 'create_user','name'=>'steps_final')) !!}
			<div class="col-sm-5" style="border-right: 2px solid #CCCCCC;">
				<section class="reg_redes">
					<h3>¿Tienes redes sociales?</h3>
					<div class="alert alert-success alert-dismissible" role="alert">
					  <button style="padding: 0px;background: none;border: 0px;color: #000;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  <strong>Warning!</strong> 
					Redes validas: Facebook, Twitter, Youtube, Linkedin, Instagram, Snapchat, G+, Vine, Tumblr
					</div>
						<div class="form-group">
							{!! Form::text('social1','',['placeholder'=>'Red Social','class'=>'form-control']) !!}<button><span class="glyphicon glyphicon-plus"></span></button>
						</div>
						<div class="form-group">
							{!! Form::text('social2','',['placeholder'=>'Red Social','class'=>'form-control']) !!}<button><span class="glyphicon glyphicon-plus"></span></button>
						</div>
						<div class="form-group">
							{!! Form::text('social3','',['placeholder'=>'Red Social','class'=>'form-control']) !!}<button><span class="glyphicon glyphicon-plus"></span></button>
						</div>
						<div class="form-group">
							{!! Form::text('social4','',['placeholder'=>'Red Social','class'=>'form-control']) !!}<button><span class="glyphicon glyphicon-plus"></span></button>
						</div>
						<div class="form-group">
							{!! Form::text('social5','',['placeholder'=>'Red Social','class'=>'form-control']) !!}<button><span class="glyphicon glyphicon-plus"></span></button>
						</div>
				</section>
				<section class="reg_redes">
					<h3>¿Tienes página web?</h3>
						<div class="form-group">
							{!! Form::text('web1','',['placeholder'=>'http://','class'=>'form-control']) !!}<button><span class="glyphicon glyphicon-plus"></span></button>
						</div>	
				</section>
			</div>
			<div class="col-sm-5">
				<div class="reg_redes">
					<h3>¿Tienes cuenta Streaming?</h3>
					<div class="alert alert-success alert-dismissible" role="alert">
					  <button style="padding: 0px;background: none;border: 0px;color: #000;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  <strong>Warning!</strong><br> Twitch, Bambuser, Livestream
					</div>
						<div class="form-group">
							{!! Form::text('stream1','',['placeholder'=>'Streaming','class'=>'form-control']) !!}<button><span class="glyphicon glyphicon-plus"></span></button>
						</div>
						<div class="form-group">
							{!! Form::text('stream2','',['placeholder'=>'Streaming','class'=>'form-control']) !!}<button><span class="glyphicon glyphicon-plus"></span></button>
						</div>
						<div class="form-group">
							{!! Form::text('stream3','',['placeholder'=>'Streaming','class'=>'form-control']) !!}<button><span class="glyphicon glyphicon-plus"></span></button>
						</div>
						<div class="form-group">
							{!! Form::text('stream4','',['placeholder'=>'Streaming','class'=>'form-control']) !!}<button><span class="glyphicon glyphicon-plus"></span></button>
						</div>
						<div class="form-group">
							{!! Form::text('stream5','',['placeholder'=>'Streaming','class'=>'form-control']) !!}<button><span class="glyphicon glyphicon-plus"></span></button>
						</div>
				</div>
				<section class="reg_redes">
					<h3>¿Blog?</h3>
						<div class="form-group">
							{!! Form::text('blog1','',['placeholder'=>'http://','class'=>'form-control']) !!}<button><span class="glyphicon glyphicon-plus"></span></button>
						</div>
				</section>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 col-sm-offset-10 finish">
				<p><b>¿Tienes más redes sociales y las quieres vincular?</b><br><br>¡No te preocupes! podrás hacerlo en tu perfil después de finalizar el registro</p>
				<br><br>
				
                {!! Form::submit('FINALIZA',['class'=>'butto-formns navbar-right','style'=>'margin-bottom:20px']) !!}
                {!! Form::close() !!}

			</div>
		</div>
	</div>
@stop

@section('scripts')
	<script>
		$('.form-group button').click(function(e){
			e.preventDefault();
		});
	</script>
@stop



