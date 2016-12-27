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
					<h2>¿Dónde apareces?</h2>
					<p>Si cuentas con redes sociales, cuéntale al mundo cuáles son</p>
				</div>
				<br><br>
				@include('flash::message')
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
		// REDES
		// var numredes = 1;
		// $('#moreRed').click(function(e){
		// 	e.preventDefault();
		// 	numredes = numredes+1;
		// 	$('#redescontent').append(
		// 		'<div class="form-group">'+
		// 			'<input type="text" class="form-control" name="social'+numredes+'" placeholder="Red Social"><button id="deleteRedes" class="reg_delete"><span class="glyphicon glyphicon-minus"></span></button>'+
		// 		'</div>'
		// 	);

		// 	$('#numRed').attr('value',numredes);
		// });
		// $('.reg_redes').on("click",'#deleteRedes',function(e){
		// 	e.preventDefault();
		// 	$(this).parent().remove();
		// 	numredes-=1;

		// 	$('#numRed').attr('value',numredes);
		// });

		// WEB
		// var numweb = 1;
		// $('#moreWeb').click(function(e){
		// 	e.preventDefault();
		// 	numweb = numweb+1;
		// 	$('#webcontent').append(
		// 		'<div class="form-group">'+
		// 			'<input type="text" class="form-control" name="social'+numweb+'" placeholder="http://"><button id="deleteWeb" class="reg_delete"><span class="glyphicon glyphicon-minus"></span></button>'+
		// 		'</div>'
		// 	);

		// 	$('#numWeb').attr('value',numweb);
		// });

		// $('.reg_redes').on("click",'#deleteWeb',function(e){
		// 	e.preventDefault();
		// 	$(this).parent().remove();
		// 	numweb-=1;
		// 	$('#numWeb').attr('value',numweb);
		// });

		// STREAM
		// var stream = 1;
		// $('#moreStream').click(function(e){
		// 	e.preventDefault();
		// 	stream = stream+1;
		// 	$('#streamcontent').append(
		// 		'<div class="form-group">'+
		// 			'<input type="text" class="form-control" name="social'+stream+'" placeholder="Streaming"><button id="deleteStream" class="reg_delete"><span class="glyphicon glyphicon-minus"></span></button>'+
		// 		'</div>'
		// 	);
		// 	$('#numStream').attr('value',stream);
		// });

		// $('.reg_redes').on("click",'#deleteStream',function(e){
		// 	e.preventDefault();
		// 	$(this).parent().remove();
		// 	stream-=1;

		// 	$('#numStream').attr('value',stream);
		// });

		// BLOG
		// var blog = 1;
		// $('#moreblog').click(function(e){
		// 	e.preventDefault();
		// 	blog = blog+1;
		// 	$('#blogcontent').append(
		// 		'<div class="form-group">'+
		// 			'<input type="text" class="form-control" name="social'+blog+'" placeholder="http://"><button id="deleteBlog" class="reg_delete"><span class="glyphicon glyphicon-minus"></span></button>'+
		// 		'</div>'
		// 	);

		// 	$('#numBlog').attr('value',blog);
		// });

		// $('.reg_redes').on("click",'#deleteBlog',function(e){
		// 	e.preventDefault();
		// 	$(this).parent().remove();
		// 	blog-=1;
		// 	$('#numBlog').attr('value',blog);
		// });

	</script>
@stop



