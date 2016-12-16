@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="col-sm-12 favorits">
	<div class="interesting-header">
	<br>
		<h2 class="title-trends text-center">{{$add }}</h2>
		<div id="position" data-lat="{{$latitud}}" data-lng="{{$longitud}}"></div>
		<br>
	</div>
	@if(isset($add))
		@if(isset($latitud))
			@if(isset($longitud))
				<div class="col-md-12">
					<a href="{{url('perfil')}}" class="btn btn-default">Perfil</a> 
					<a href="{{url('/delete_local/'.$add.'/'.$latitud.'/'.$longitud)}}" class="btn btn-danger">Eliminar</a>
					<br>
					<br>
					<div id="map" style="height: 500px;margin-bottom: 50px"></div>
				</div>

			@else
				<div class="col-md-12">
					<h2 class="text-center">No se encontro local</h2>
				</div>
			@endif
		@else
			<div class="col-md-12">
				<h2 class="text-center">No se encontro local</h2>
			</div>
		@endif
	@else
		<div class="col-md-12">
			<h2 class="text-center">No se encontro local</h2>
		</div>
	@endif
</div>
@stop
@extends('logueado.layouts.content-float-chat')
@section('scripts')
<script type="text/javascript" src="{{url('https://maps.googleapis.com/maps/api/js?key=AIzaSyDssPGqiz3lLJ8RoKvlXlUk2OGR97z4zVk')}}"></script>

<?php  ?>
<script>
	$('#flash-overlay-modal').modal();
	var latitude = $('#position').data('lat');
	var longitude = $('#position').data('lng');
	var title = $('.title-trends').text();
	function initMap() {
	  var myLatLng = {lat: latitude, lng: longitude};

	  var map = new google.maps.Map(document.getElementById('map'), {
	    zoom: 17,
	    center: myLatLng
	  });

	  var marker = new google.maps.Marker({
	    position: myLatLng,
	    map: map,
	    title: title
	  });
	}
	initMap();
</script>
@stop