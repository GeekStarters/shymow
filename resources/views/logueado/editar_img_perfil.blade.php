@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="col-sm-12 edit_img">
	<div class="col-md-12 text-center block-center">
		<h2>Seleccionar foto</h2>
		<div class="alert alert-danger" role="alert">
			Tamaño recomendado 400 x 400 px
		</div>
		{!! Form::open(['url'=>'/uploadProfileImg','method'=>'POST','files'=>'true']) !!}
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

				<img src="{{Auth::user()->img_profile}}" id="viewImgProfile" alt="shymow">
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

		    $('#displayImgProfile').css('visibility', 'hidden');

		  
			addImgAreaSelect($('#viewImgProfile'));
		    // adds an image area select instance
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

		function addImgAreaSelect( img ){
	        img.imgAreaSelect({
	                handles : true,
	                aspectRatio : '4:4',
	                fadeSpeed : 1,
	                show : true,
	                onSelectEnd: function (img, selection) {
			            $('input[name="x1"]').val(selection.x1);
			            $('input[name="y1"]').val(selection.y1);
			            $('input[name="x2"]').val(selection.x2);
			            $('input[name="y2"]').val(selection.y2);            
			            $('input[name="width"]').val(selection.width);            
			            $('input[name="height"]').val(selection.height);            
			        }
	        });
	        img.load(function(){ // display initial image selection 16:9
	                    var height = ( this.width / 4 ) * 4;	
	                    if( height <= this.height ){

	                            var diff = ( this.height - height ) / 2;
	                            var coords = { x1 : 0, y1 : diff, x2 : this.width, y2 : height + diff };
	                            $('input[name="x1"]').val(0);
					            $('input[name="y1"]').val(Math.round(diff));
					            $('input[name="x2"]').val(Math.round(this.width));
					            $('input[name="y2"]').val(Math.round(height + diff));            
					            $('input[name="width"]').val(Math.round(this.width));            
					            $('input[name="height"]').val(Math.round(height));   
	                    }   
	                    else{ // if new height out of bounds, scale width instead
	                            var width = ( this.height / 4 ) * 4; 
	                            var diff = ( this.width - width ) / 2;
	                            var coords = { x1 : diff, y1 : 0, x2 : width + diff, y2: this.height };
	                            $('input[name="x1"]').val(Math.round(diff));
					            $('input[name="y1"]').val(0);
					            $('input[name="x2"]').val(Math.round(width + diff));
					            $('input[name="y2"]').val(Math.round(this.height));            
					            $('input[name="width"]').val(Math.round(width));            
					            $('input[name="height"]').val(Math.round(this.height));    
	                    }   
	                $( this ).imgAreaSelect( coords );
	        });
		}
	});
</script>
@stop