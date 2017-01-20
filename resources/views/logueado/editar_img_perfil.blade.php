@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="col-sm-12 edit_img">
	<div class="col-md-12 text-center block-center">
		<h2>Seleccionar foto</h2>
		<div class="alert alert-danger" role="alert">
			Tamaño recomendado 400 x 400 px
		</div>
		{!! Form::open(['url'=>'/uploadProfileImg','method'=>'POST','files'=>'true','id'=>'coords']) !!}
			<div class="form-group" id="contentImgSelect">
				{!! Form::file('img',['style'=>'display:none','id'=>'imgProfile'])!!}
				@foreach ($errors->all() as $error)
	                <p class="text-danger">
	                  <b>{{ $error}}</b>             
	                </p>
                @endforeach
				<div class="text-center">
					<span id="displayImgProfile" class="glyphicon glyphicon-picture"></span>
				</div>

				<img src="" id="viewImgProfile" alt="shymow" style="display: none">
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

		initJcrop();
        function initJcrop()
        {
            jcrop_api = $.Jcrop('#viewImgProfile');
        };

		$('body').on('click', '#displayImgProfile', function(event) {
			event.preventDefault();
			console.log('entre');
			$('#imgProfile').click();
		})



		$("#imgProfile").change(function(){
		    readURL(this,'#viewImgProfile');
		    $('#avisoSelectImg').fadeIn('slow');
		    // $('#viewImgProfile').fadeIn('slow');
		    $('.edit_img button').fadeIn('slow');
		    $('.edit_img a').fadeIn('slow');

		    $('#displayImgProfile').fadeOut('fast');

		    jcrop_api.setImage($('#viewImgProfile').attr('src')); 
		    $('#viewImgProfile').Jcrop({
		      onChange:   showCoords,
		      onSelect:   showCoords,
		      boxWidth: 400, 
		      boxHeight: 400,
		      bgColor: '',
		      aspectRatio: 4 / 4,
		      onRelease:  clearCoords
		    },function(){
		      jcrop_api = this;
		    });
		    $('#coords').on('change','input',function(e){
		      var x1 = $('input[name="x1"]').val(),
		          x2 = $('input[name="x2"]').val(),
		          y1 = $('input[name="y1"]').val(),
		          y2 = $('input[name="y2"]').val();
		      jcrop_api.setSelect([x1,y1,x2,y2]);
		    });

		});



		function readURL(input,id) {

		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $(id).attr('src', e.target.result);
		            jcrop_api.setImage(e.target.result); 
		        }

		        reader.readAsDataURL(input.files[0]);
		    }
		}


		// Simple event handler, called from onChange and onSelect
	  // event handlers, as per the Jcrop invocation above
	  function showCoords(c)
	  {
	    $('input[name="x1"]').val(Math.round(c.x));
	    $('input[name="y1"]').val(Math.round(c.y));
	    $('input[name="x2"]').val(Math.round(c.x2));
	    $('input[name="y2"]').val(Math.round(c.y2));
	    $('input[name="width"]').val(Math.round(c.w));
	    $('input[name="height"]').val(Math.round(c.h));
	  };

	  function clearCoords()
	  {
	    $('input[name="x1"]').val('');
	    $('input[name="y1"]').val('');
	    $('input[name="x2"]').val('');
	    $('input[name="y2"]').val('');
	    $('input[name="width"]').val('');
	    $('input[name="height"]').val('');
	  };


	});
</script>
@stop