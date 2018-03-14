<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Marker Options</title>

<style>

/* Always set the map height explicitly to define the size of the div
 * element that contains the map. */
#map{
	height:400px;
	width:100%;
}
/* Optional: Makes the sample page fill the window. */
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}
#floating-panel {
  position: absolute;
  top: 10px;
  left: 25%;
  z-index: 5;
  background-color: #fff;
  padding: 5px;
  border: 1px solid #999;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}

</style>

</head>
<body>
	
	<div id="floating-panel">
	  <!-- <input onclick="clearMarkers();" type=button value="Hide Markers">
	  <input onclick="showMarkers();" type=button value="Show All Markers">
	  <input onclick="deleteMarkers();" type=button value="Delete Markers"> -->
	</div>

	<div id="map"></div>

	Latitude <input type="text" id="latitude-field">

	Longitude <input type="text" id="longitude-field">

	<!-- Replace the value of the key parameter with your own API key. -->
	<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAj-48PZXU7YOUvZ9JzPS-EnSbr7ZhhDRM&callback=initMap">
	</script>

	<script>

		// In the following example, markers appear when the user clicks on the map.
		// The markers are stored in an array.
		// The user can then click an option to hide, show or delete the markers.
		var map;
		var markers = [];

		function initMap() {
		  var haightAshbury = {lat: 37.769, lng: -122.446};

		  map = new google.maps.Map(document.getElementById('map'), {
		    zoom: 12,
		    center: haightAshbury,
		    mapTypeId: 'terrain'
		  });

		  // This event listener will call addMarker() when the map is clicked.
		  map.addListener('click', function(event) {
		  	deleteMarkers();
		  	document.getElementById('latitude-field').value = event.latLng.lat();
		  	document.getElementById('longitude-field').value = event.latLng.lng();
		    addMarker(event.latLng);
		  });

		  // Adds a marker at the center of the map.
		  addMarker(haightAshbury);
		}

		// Adds a marker to the map and push to the array.
		function addMarker(location) {
		  var marker = new google.maps.Marker({
		    position: location,
		    map: map
		  });
		  markers.push(marker);
		}

		// Sets the map on all markers in the array.
		function setMapOnAll(map) {
		  for (var i = 0; i < markers.length; i++) {
		    markers[i].setMap(map);
		  }
		}

		// Removes the markers from the map, but keeps them in the array.
		function clearMarkers() {
		  setMapOnAll(null);
		}

		// Shows any markers currently in the array.
		function showMarkers() {
		  setMapOnAll(map);
		}

		// Deletes all markers in the array by removing references to them.
		function deleteMarkers() {
		  clearMarkers();
		  markers = [];
		}

		</script>

</body>
</html>