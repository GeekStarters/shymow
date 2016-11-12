@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="col-sm-12 edit_img">
	<div class="col-md-12 text-center block-center">
		<h2>Seleccionar foto</h2>
		{!! Form::open(['url'=>'/uploadProfileImg','method'=>'POST','files'=>'true']) !!}
			<div class="form-group" id="contentImgSelect">
				{!! Form::file('img',['style'=>'display:none','id'=>'imgProfile'])!!}
				<p id="avisoSelectImg" class="alert alert-warning" role="alert" style="display: none">Seleccione el área que desea colocar</p>
				@foreach ($errors->all() as $error)
	                <p class="text-danger">
	                  <b>{{ $error}}</b>             
	                </p>
                @endforeach
				<div class="text-center">
					<span id="displayImgProfile" class="glyphicon glyphicon-picture"></span>
				</div>

				<img src="" id="viewImgProfile" alt="shymow">

				<input type="hidden" name="x1" value="" />
				<input type="hidden" name="y1" value="" />
				<input type="hidden" name="x2" value="" />
				<input type="hidden" name="y2" value="" />
				<input type="hidden" name="width" value="" />
				<input type="hidden" name="height" value="" />
				<div class="clearfix"></div>
				<a class="btn btn-danger" href="/edit_img_user">Cancelar</a>
				<button class="btn btn-success" id="enviar">Cambiar</button>
			</div>
  		{!! Form::close() !!}
	</div>
	<div class="col-md-6"></div>
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


		$('#displayImgProfile').click(function(event) {
			/* Act on the event */
			$('#imgProfile').click();
		});

		$("#imgProfile").change(function(){
		    readURL(this,'#viewImgProfile');
		    $('#avisoSelectImg').fadeIn('slow');
		    $('#viewImgProfile').fadeIn('slow');
		    $('.edit_img button').fadeIn('slow');
		    $('.edit_img a').fadeIn('slow');
		    $('#displayImgProfile').fadeOut('slow');
		});

		function readURL(input,id) {

		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $(id).attr('src', e.target.result);
		        }

		        reader.readAsDataURL(input.files[0]);
		    }
		}

		var selection = $('#viewImgProfile').imgAreaSelect({
		    handles: true,
		    instance: true,
		    aspectRatio: '4:4',
		    onSelectEnd: function (img, selection) {
	            $('input[name="x1"]').val(selection.x1);
	            $('input[name="y1"]').val(selection.y1);
	            $('input[name="x2"]').val(selection.x2);
	            $('input[name="y2"]').val(selection.y2);            
	            $('input[name="width"]').val(selection.width);            
	            $('input[name="height"]').val(selection.height);            
	        }
		});
	});
</script>
@stop