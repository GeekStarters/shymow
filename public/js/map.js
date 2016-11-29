/*
 * Learning Google Maps Geocoding by example
 * Miguel Marnoto
 * 2015 - en.marnoto.com
 *
 */

jQuery(document).ready(function($) {
	var map;
	var marker;

	function initialize() {

		var mapOptions = {
			center: new google.maps.LatLng(40.680898,-8.684059),
			zoom: 7,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

	}

	// google.maps.event.addDomListener(window, 'load', initialize);


	function searchAddress($input) {

		var addressInput = document.getElementById($input).value;

		var geocoder = new google.maps.Geocoder();

		geocoder.geocode({address: addressInput}, function(results, status) {

		if (status == google.maps.GeocoderStatus.OK) {

	      var myResult = results[0].geometry.location;
	      $.ajax({
	      	url: '/add_local',
	      	type: 'POST',
	      	dataType: 'JSON',
	      	data: 
	     		{
	     			address: addressInput,
	     			lat:myResult.lat(),
	     			lng:myResult.lng(),
	     		},
	     	success:function(data){
	     		if (!data.error) {
	     			var html = "";
	     			html += "<li><a href='/view_local/";
	     			html += addressInput;
	     			html += "/";
	     			html += myResult.lat();
	     			html += "/";
	     			html += myResult.lng();
	     			html += "'>";
	     			html += addressInput;
	     			html += "</a><li>";
	     			$('#sucursales').append(html);
	     			$('#nothingLocal').slideUp('slow');
	     		}
	     	}
	      })
	      .fail(function() {
	      	console.log("error");
	      });
	      								
	      // createMarker(myResult);

	      // map.setCenter(myResult);

	      // map.setZoom(17);
		}
		});

	}

	function createMarker(latlng) {

	  if(marker != undefined && marker != ''){
	    marker.setMap(null);
	    marker = '';
	  }

	  marker = new google.maps.Marker({
	    map: map,
	    position: latlng
	  });
	}



	$('.bussines-add').click(function(event) {
		/* Act on the event */
		searchAddress("address-input");
	});
});