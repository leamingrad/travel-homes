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
		var tubeStations = {
		<?php
			$string = file_get_contents("./res/station_locations.json");
			$json=json_decode($string,true);
			$stations = $json['stations'];
			$laststation = end($stations);
			foreach($stations as $station)
			{
				$identifier = str_replace(' ', '', $station['name']);
				$name = $station['name'];
				$coords = explode(',',$station['coordinates']);
				
				$station_string = '\''.$identifier.'\':{line:\''.$name.'\',center: new google.maps.LatLng('.$coords[1].','.$coords[0].')}';
				if ($station != $laststation)
				{
					$station_string .= ',';
				}
				
				echo $station_string;
			}
		?>
		};
		var cityCircle;

		function initialize() {
		  // Create the map.
		  var mapOptions = {
			zoom: 10,
			center: new google.maps.LatLng(51.4973401,-0.1266612),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		  };

		  var map = new google.maps.Map(document.getElementById('map-canvas'),
			  mapOptions);

		  // Construct the circle for each value in citymap.
		  // Note: We scale the population by a factor of 20.
		  for (var station in tubeStations) {
			var populationOptions = {
			  strokeColor: '#FF0000',
			  strokeOpacity: 0.8,
			  strokeWeight: 2,
			  fillColor: '#FF0000',
			  fillOpacity: 0.35,
			  map: map,
			  center: tubeStations[station].center,
			  radius: 1600
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