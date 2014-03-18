<?php
	echo "Hello World";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 100% }
    </style>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwk13t_Uy10Znq5j1usfq9RwLOTYYGXXg&libraries=drawing&sensor=false">
    </script>
    <script type="text/javascript">
		var tubestations = {};
		citymap['uxbridge'] = {
		  center: new google.maps.LatLng(51.546455, -0.477087),
		  line: 'Metropolitan Line'
		};
		var cityCircle;

		function initialize() {
		  // Create the map.
		  var mapOptions = {
			zoom: 10,
			center: new google.maps.LatLng(51.4973401,-0.1266612),
			mapTypeId: google.maps.MapTypeId.TERRAIN
		  };

		  var map = new google.maps.Map(document.getElementById('map-canvas'),
			  mapOptions);

		  // Construct the circle for each value in citymap.
		  // Note: We scale the population by a factor of 20.
		  for (var station in tubestations) {
			var populationOptions = {
			  strokeColor: '#FF0000',
			  strokeOpacity: 0.8,
			  strokeWeight: 2,
			  fillColor: '#FF0000',
			  fillOpacity: 0.35,
			  map: map,
			  center: citymap[city].center,
			  radius: 100
			};
			// Add the circle for this city to the map.
			cityCircle = new google.maps.Circle(populationOptions);
		  }
		}

		google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <div id="map-canvas"/>
  </body>
</html>