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
					<h2>¡Cuéntanos sobre tu empresa!</h2>
					<p>Queremos saber sobre tu empresa y cuál es su rumbo. Así mismo<br> otros usuarios podrán conocerla y ser futuros clientes</p>
				</div>
				<br><br>
				@include('flash::message')
				<div class="alert alert-warning" id="alert_" style="display: none" role="alert"></div>
			</div>
			@foreach ($errors->register->all() as $error)
              <span class="text-danger">
                <b>{{ $error}}</b> <br>            
              </span>
              @endforeach

			<div class="col-sm-3 out-padding">
				<section class="about-you-empresa out-padding">
					<h3>Sobre ti</h3>
					
					{!! Form::open(array('url' => 'empresa_social','method'=>'post','name'=>'form_validate')) !!}

					{!! Form::hidden('hobbies','',['id'=>'hobb']) !!}
						<div class="grup-form">
							{!! Form::label('Responsable de la empresa')!!}
							{!! Form::text('responsable_empresa','',['placeholder'=>'Nombre y apellido','class'=>'form-control', 'required' => 'required']) !!}
						</div>
						<div class="grup-form">
							{!! Form::label('E-mail')!!}
							{!! Form::email('email_empresa','',['placeholder'=>'Nombre y apellido','class'=>'form-control', 'required' => 'required']) !!}
						</div>
						<div class="grup-form">
							{!! Form::label('Fecha de nacimiento')!!} <br>
							{!! Form::number('dia','',['placeholder'=>'Día','class'=>'form-control date', 'required' => 'required']) !!}
							{!! Form::number('mes','',['placeholder'=>'Mes','class'=>'form-control date', 'required' => 'required']) !!}
							{!! Form::number('anio','',['placeholder'=>'Año','class'=>'form-control date', 'required' => 'required']) !!}
						</div>
						<div class="grup-form">
							{!! Form::label('Género')!!}
							{!! Form::select('genero', array('m' => 'Hombre', 'f' => 'Mujer','n'=>'Neutro'), 'hombre',['class'=>'form-control','required' => 'required']); !!}
						</div>
						<div class="grup-form">
							{!! Form::label('País')!!}
							{!! Form::select('pais',array('' => 'País') + ['205'=>'Spain'] + $countries,'',['class'=>'form-control','required' => 'required','id'=>'paisF']) !!}	
						</div>
						<div class="grup-form">
							{!! Form::label('Provincia')!!}

							{!! Form::select('provincia',array('' => 'Selecciona provincia'),'',['class'=>'form-control', 'required' => 'required','id'=>'statesF']); !!}
						</div>
						<div class="grup-form">
							{!! Form::label('Municipio')!!}
							
							{!! Form::select('municipio',array('' => 'Selecciona municipio'),'',['class'=>'form-control', 'required' => 'required','id'=>'citiesF']); !!}
						</div>
				</section>
			</div>
			<div class="col-sm-3 out-padding">
				<section class="about-you-empresa out-padding">
					<h3>Sobre la empresa</h3>
						<div class="grup-form">
							{!! Form::label('Nombre de la empresa')!!}
							{!! Form::text('empresa','',['placeholder'=>'Nombre','class'=>'form-control', 'required' => 'required']) !!}
						</div>
						<div class="grup-form">
							{!! Form::label('Alias')!!}
							{!! Form::text('alias','',['placeholder'=>'Alias','class'=>'form-control', 'required' => 'required']) !!}
						</div>
						<div class="grup-form">
							{!! Form::label('DNI / CIF')!!}
							{!! Form::text('dni','',['placeholder'=>'DNI / CIF','class'=>'form-control', 'required' => 'required']) !!}
						</div>
						<div class="grup-form">
							{!! Form::label('Actividad comercial')!!}

							{!! Form::select('empresa_comercio',array('' => 'Seleccionar') + $subCategories,'',['class'=>'form-control','required' => 'required']) !!}
						</div>
						<div class="grup-form">
							{!! Form::label('País')!!}
							{!! Form::select('paiscorp',array('' => 'País') + ['205'=>'Spain'] + $countries,'',['class'=>'form-control','required' => 'required','id'=>'paiscorp']) !!}
						</div>
						<div class="grup-form">
							{!! Form::label('Provincia')!!}

							{!! Form::select('provinciacorp',array('' => 'Selecciona provincia'),'',['class'=>'form-control', 'required' => 'required','id'=>'statecorp']); !!}
						</div>
						<div class="grup-form">
							{!! Form::label('Municipio')!!}
							
							{!! Form::select('municipiocorp',array('' => 'Selecciona municipio'),'',['class'=>'form-control', 'required' => 'required','id'=>'citycorp']); !!}
						</div>
				</section>
			</div>
			<div class="col-sm-6 out-padding">
				<div class="col-sm-12 hobbies-empresa out-padding">
					<h3>Intereses de tu empresa</h3>
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
		$('#paisF').change(function(event) {
			/* Act on the event */
			$('#statesF').html('<option>Cargando..</option>');
			$('#citiesF').html('<option>Selecciona municipio</option>');
			var id = $(this).val();
			$.ajax({
				url: 'state/'+id,
				type: 'GET',
				dataType: 'html',
				success: function(data){
					$('#statesF').html(data);
				}
			})
			.fail(function() {
				console.log("error");
			})
		});

		$('#statesF').change(function(event) {
			/* Act on the event */
			$('#citiesF').html('<option>Cargando..</option>');
			var id = $(this).val();
			$.ajax({
				url: 'city/'+id,
				type: 'GET',
				dataType: 'html',
				success: function(data){
					$('#citiesF').html(data);
					if (data == "")
						$('#citiesF').html('<option value="">Municipios no encontrados</option>');
				}
			})
			.fail(function() {
				console.log("error");
			})
		});

		$('#paiscorp').change(function(event) {
			/* Act on the event */
			$('#statecorp').html('<option>Cargando..</option>');
			$('#citycorp').html('<option>Selecciona municipio</option>');
			var id = $(this).val();
			$.ajax({
				url: 'state/'+id,
				type: 'GET',
				dataType: 'html',
				success: function(data){
					$('#statecorp').html(data);
				}
			})
			.fail(function() {
				console.log("error");
			})
		});

		$('#statecorp').change(function(event) {
			/* Act on the event */
			$('#citycorp').html('<option>Cargando..</option>');
			var id = $(this).val();
			$.ajax({
				url: 'city/'+id,
				type: 'GET',
				dataType: 'html',
				success: function(data){
					$('#citycorp').html(data);
					if (data == "")
						$('#citycorp').html('<option value="">Municipios no encontrados</option>');
				}
			})
			.fail(function() {
				console.log("error");
			})
		});
		
		var validator = new FormValidator('form_validate', [{
		    name: 'mes',
		    display: 'Mes',
		    rules: 'required'
		},{
		    name: 'anio',
		    display: 'Año',
		    rules: 'required'
		},{
		    name: 'genero',
		    display: 'Genero',
		    rules: 'required'
		},{
		    name: 'pais',
		    display: 'País',
		    rules: 'required'
		},{
		    name: 'provincia',
		    display: 'Provincia',
		    rules: 'required'
		},{
		    name: 'municipio',
		    display: 'Municipio',
		    rules: 'required'
		},{
		    name: 'responsable_empresa',
		    display: 'Responsable de empresa',
		    rules: 'required'
		},{
		    name: 'email_empresa',
		    display: 'Email responsable',
		    rules: 'required'
		},{
		    name: 'empresa',
		    display: 'Empresa',
		    rules: 'required'
		},{
		    name: 'alias',
		    display: 'Alías',
		    rules: 'required'
		},{
		    name: 'dni',
		    display: 'DNI',
		    rules: 'required'
		},{
		    name: 'empresa_comercio',
		    display: 'Comercio empresarial',
		    rules: 'required'
		},{
		    name: 'paiscorp',
		    display: 'País de la empresa',
		    rules: 'required'
		},{
		    name: 'provinciacorp',
		    display: 'Provincia de la empresa',
		    rules: 'required'
		},{
		    name: 'municipiocorp',
		    display: 'Municipio de la empresa',
		    rules: 'required'
		}], function(errors, event) {
		    if (errors.length > 0) {
		        var errorString = '';

		        for (var i = 0, errorLength = errors.length; i < errorLength; i++) {
		            errorString += errors[i].message + '<br />';
		        }

		        $('#alert_').slideDown('fast');
		        $('#alert_').html(errorString);
		    }
		});
		validator.setMessage('required', 'El %s es requerido');
	</script>
@stop



