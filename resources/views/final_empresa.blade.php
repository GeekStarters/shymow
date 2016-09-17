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
					<h2>¿Está tu empresa en redes sociales?</h2>
					<p>Si cuentas con redes sociales ¡vincúlalas! y dálas a conocer a todos los usuarios Shymow</p>
				</div>
				<br><br>
			</div>
			<div class="col-sm-5">
				<section class="reg_redes">
					<h3>¿Tienes redes sociales?</h3>
				
					{!! Form::open(array('url' => 'create_user','name'=>'steps_final')) !!}
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
				<div class="reg_redes" style="border-left: 2px solid #CCCCCC;padding-left:10px;">
					<h3>¿Tienes cuenta Streaming?</h3>
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
@endsection

