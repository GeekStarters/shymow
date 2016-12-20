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
					<h2>¡Cuéntanos más sobre ti!</h2>
					<p>Queremos saber qué tan grande eres y qué te gusta, así mismo <br> otros usuarios podrán conocerte.</p>
				</div>
				<br><br>
			</div>
			  @foreach ($errors->register->all() as $error)
              <p class="text-danger">
                <b>{{ $error}}</b>             
              </p>
              @endforeach
			{!! Form::open(array('url' => 'celebridad_social','method'=>'post')) !!}

			{!! Form::hidden('hobbies','',['id'=>'hobb']) !!}
				<div class="col-sm-4">
					<section class="about-you navbar-right">
						<h3>Sobre ti</h3>

							<div class="grup-form">
								{!! Form::label('Nombre artístico')!!}
								{!! Form::text('apodo','',['placeholder'=>'Nombre artístico','class'=>'form-control', 'required' => 'required']) !!}
							</div>
							<div class="grup-form">
								{!! Form::label('Fecha de nacimiento')!!} <br>
								{!! Form::number('dia','',['placeholder'=>'Día','class'=>'form-control date', 'required' => 'required']) !!}
								{!! Form::number('mes','',['placeholder'=>'Mes','class'=>'form-control date', 'required' => 'required']) !!}
								{!! Form::number('anio','',['placeholder'=>'Año','class'=>'form-control date', 'required' => 'required']) !!}
							</div>
							<div class="grup-form">
								{!! Form::label('Género')!!}
								{!! Form::select('genero', array('m' => 'Hombre', 'f' => 'Mujer'), 'hombre',['class'=>'form-control','required' => 'required']); !!}
							</div>
							<div class="grup-form">
								{!! Form::label('País')!!}
								{!! Form::select('pais',array('' => 'País') + $countries,'',['class'=>'form-control','required' => 'required','id'=>'pais']) !!}	
							</div>
							<div class="grup-form">
								{!! Form::label('Provincia')!!}

								{!! Form::select('provincia',array('' => 'Selecciona provincia'),'',['class'=>'form-control', 'required' => 'required','id'=>'state']); !!}
							</div>
							<div class="grup-form">
								{!! Form::label('Municipio')!!}
								
								{!! Form::select('municipio',array('' => 'Selecciona municipio'),'',['class'=>'form-control', 'required' => 'required','id'=>'city']); !!}
							</div>
							<div class="grup-form">
								<div class="checkbox">
								    <label>
								      <input type="checkbox" name="is_youtuber" value="true"> ¿Eres youtuber?
								    </label>
								  </div>
							</div>
						
					</section>
				</div>
				<div class="col-sm-8">
					<div class="col-sm-9 hobbies">
						<h3>¿Qué te gusta?</h3>
						<div class="like-me">Acampar</div>
						<div class="like-me">Coleccionismo</div>
						<div class="like-me">Filosofía</div>
						<div class="like-me">Moda</div>
						<div class="like-me">Lectura</div>
						<div class="like-me">Música</div>
						
						<div class="like-me">Anime</div>
						<div class="like-me">Compartir coche</div>
						<div class="like-me">Fotografía</div>
						<div class="like-me">Salud</div>
						<div class="like-me">Objetos perdidos</div>
						
						<div class="like-me">Party</div>
						<div class="like-me">Compras</div>
						<div class="like-me">Idiomas</div>
						<div class="like-me">Tecnología</div>
						<div class="like-me">Trueque de habilidades</div>
						
						<div class="like-me">Pintar</div>
						<div class="like-me">Teatro</div>
						<div class="like-me">Infantil</div>
						<div class="like-me">Motor</div>
						<div class="like-me">Serie</div>
						<div class="like-me">Pesca</div>
						<div class="like-me">Videojuegos</div>
						
						<div class="like-me">Conciertos</div>
						<div class="like-me">Cultura</div>
						<div class="like-me">Informatica</div>
						<div class="like-me">Ecologismo</div>
						<div class="like-me">Juegos de mesa</div>
						<div class="like-me">Arte</div>
						<div class="like-me">Deportes</div>
						<div class="like-me">Intercambio de idiomas</div>
						<div class="like-me">Cine</div>
						<div class="like-me">Excursionismo</div>
						
						<div class="like-me">Belleza</div>
						<div class="like-me">Viajar</div>
						<div class="like-me">Bailar</div>
						<div class="like-me">Animales</div>
						<div class="like-me">Aventuras</div>
						<div class="like-me">Voluntariado</div>
						
						<div class="like-me">Ciencia</div>
						<div class="like-me">Escribir</div>
						<div class="like-me">Jardinería</div>
						<div class="like-me">Política</div>
						<div class="like-me">Cocina</div>
						<div class="like-me">Exposiciones</div>

						<p><b>¿Tienes más intereses?</b> Al finalizar el registro podrás contarnos detalladamente</p>
					</div>
					<div class="col-sm-12">
						<br><br>
						 {!! Form::submit('SIGUIENTE',['class'=>'butto-formns navbar-right','style' => 'margin-bottom:20px']) !!}
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>

@stop

@section('scripts')
	<script>
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

		$('.like-me').on('click', function(e){
			$(this).text();

			var hobbie = $('#hobb');
			var dataHobbie = hobbie.text();
			var text = $(this).text();
			hobbieArray = [];


			if ($(this).hasClass('hobbie-selected')) {

				$(this).removeClass('hobbie-selected');
				$(this).addClass('like-me');
				var arrayhob = dataHobbie.split(",");
				if (arrayhob.length > 1) {
					text = dataHobbie.replace(','+text, '');
				}else{

					text = dataHobbie.replace(text, '');
				}
				hobbie.html(text);
				hobbie.attr('value',hobbie.text())
			}else{

				$(this).removeClass('like-me');
				$(this).addClass('hobbie-selected');
				if (dataHobbie == "") {
					hobbie.append(text);
					hobbie.attr('value',hobbie.text())
				}else{
					hobbie.append(','+text);
					hobbie.attr('value',hobbie.text())
				}
			}
		});	
		$('#pais').change(function(event) {
			/* Act on the event */
			$('#state').html('<option>Cargando..</option>');
			$('#city').html('<option>Selecciona municipio</option>');
			var id = $(this).val();
			$.ajax({
				url: 'state/'+id,
				type: 'GET',
				dataType: 'html',
				success: function(data){
					$('#state').html(data);
				}
			})
			.fail(function() {
				console.log("error");
			})
		});

		$('#state').change(function(event) {
			/* Act on the event */
			$('#city').html('<option>Cargando..</option>');
			var id = $(this).val();
			$.ajax({
				url: 'city/'+id,
				type: 'GET',
				dataType: 'html',
				success: function(data){
					$('#city').html(data);
					if (data == "")
						$('#city').html('<option value="">Municipios no encontrados</option>');
				}
			})
			.fail(function() {
				console.log("error");
			})
		});
		
	</script>
@stop

