<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

	<title>My Geocode App</title>

	<style>
		#map{
			height:400px;
			width:100%;
		}
	</style>

</head>
<body>

	<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAj-48PZXU7YOUvZ9JzPS-EnSbr7ZhhDRM&callback=initMap">
    </script>

	<div class="container">
		<div id="map"></div>
		<h2 id="text-center">Enter Location: </h2>
		<form id="location-form">
			<input type="text" id="location-input" class="form-control form-control-lg">
			<br>
			<button type="submit" class="btn btn-primary btn-block">Submit</button>
			<br>
		</form>
		<div class="card-block" id="formatted-address"></div>
		<br><br>
		<div class="card-block" id="address-components"></div>
		<br><br>
		<div class="card-block" id="geometry"></div>
	</div>

	<script>
		// Call Geocode
		//geocode();

		// Get Location Form
		var locationForm = document.getElementById('location-form');

		// listen for submit
		locationForm.addEventListener('submit', geocode);

		function geocode(e){
			// Prevent actual submit
			e.preventDefault();

			var location = document.getElementById('location-input').value;

			axios.get('https://maps.googleapis.com/maps/api/geocode/json',{
				params:{
					address:location,
					key:'AIzaSyAj-48PZXU7YOUvZ9JzPS-EnSbr7ZhhDRM'
				}
			})
			.then(function(response){
				// Log full response
				// console.log(response);

				initMap(response.data.results[0].geometry.location.lat,response.data.results[0].geometry.location.lng);

				// Formatted Address
				var formattedAddress = response.data.results[0].formatted_address;
				var formattedAddressOutput = `
				  <ul class="list-group">
					<li class="list-group-item">${formattedAddress}</li>
				  </ul>
				`;

				// Address Components
				var addressComponents = response.data.results[0].address_components;
				var addressComponentsOutput = '<ul class="list-group">';
				for(var i = 0;i < addressComponents.length;i++){
					addressComponentsOutput += `
						<li class="list-group-item"><strong>${addressComponents[i].types[0]}</strong>: ${addressComponents[i].long_name}</li>
					`;
				}
				addressComponentsOutput += '</ul>';

				// Geometry
				var lat = response.data.results[0].geometry.location.lat;
				var lng = response.data.results[0].geometry.location.lng;
				var geometryOutput = `
					<ul class="list-group">
						<li class="list-group-item"><strong>Latitude</strong> : 
						${lat}</li>
						<li class="list-group-item"><strong>Longitude</strong> : 
						${lng}</li>
					</ul>
				`;

				// Output to app
				document.getElementById('formatted-address').innerHTML = formattedAddressOutput;
				document.getElementById('address-components').innerHTML = addressComponentsOutput;
				document.getElementById('geometry').innerHTML = geometryOutput;

			})
			.catch(function(error){
				console.log(error);
			})
		}

		// In the following example, markers appear when the user clicks on the map.
		// The markers are stored in an array.
		// The user can then click an option to hide, show or delete the markers.
		var map;
		var markers = [];

		function initMap(latitude = 3.15640,longitude = 101.71287) {
		  // var haightAshbury = {lat:3.15640,lng:101.71287};
		  var haightAshbury = {lat:latitude,lng:longitude};

		  map = new google.maps.Map(document.getElementById('map'), {
		    zoom: 16,
		    center: haightAshbury,
		    mapTypeId: 'terrain'
		  });

		  // This event listener will call addMarker() when the map is clicked.
		  map.addListener('click', function(event) {
		  	deleteMarkers();

		    addMarker(event.latLng);

			var lat = event.latLng.lat();
			var lng = event.latLng.lng();

		    var geometryOutput = `
				<ul class="list-group">
					<li class="list-group-item"><strong>Latitude</strong> : 
					${lat}</li>
					<li class="list-group-item"><strong>Longitude</strong> : 
					${lng}</li>
				</ul>
			`;

			// Output to app
			document.getElementById('geometry').innerHTML = geometryOutput;

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