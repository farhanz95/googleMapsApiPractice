<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

	<title>My Geocode App</title>

</head>
<body>

	<div class="container">
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
	</script>
	
</body>
</html>