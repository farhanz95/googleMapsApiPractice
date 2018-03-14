<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Google Map</title>

	<style>
		#map{
			height:400px;
			width:100%;
		}
	</style>
</head>
<body>
	
	<h1>My Google Map</h1>
	<div id="map"></div>

	<script>
		function initMap(){
			// Map options
			var options = {
				zoom: 14,
				center: {lat:3.15640,lng:101.71287}
			}

			// New map
			var map = new google.maps.Map(document.getElementById('map'), options);

			// Sets the map on all markers in the array.

			// Listen for click on map
			google.maps.event.addListener(map, 'click', function(event){
				// Add marker
				console.log(event.latLng);
				addMarker({coords:event.latLng});
			});

			// Add marker
			/*
			var marker = new google.maps.Marker({
				position:{lat:3.15640,lng:101.71287},
				map:map,
				icon:'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
			});

			var infoWindow = new google.maps.InfoWindow({
				content:'<h1>Unijaya Resources</h1>'
			});

			marker.addListener('click', function(){
				infoWindow.open(map, marker);
			});
			*/

			// Array of markers
			var markers = [
				{
					coords:{lat:3.15640,lng:101.71287},
					iconImage:'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
					content:'<h1>Unijaya Resources</h1>'
				},
				{
					coords:{lat:3.237546,lng:101.7060811}
				}
			];

			// Loop through markers
			for(var i = 0; i < markers.length; i++){
				// Add marker
				addMarker(markers[i]);
			}

			// Add Marker Function
			function addMarker(props){

				var marker = new google.maps.Marker({
					position:props.coords,
					map:map,
					//icon:props.iconImage
				});

				// Check for customicon
				if (props.iconImage) {
					// Set icon image
					marker.setIcon(props.iconImage);
				}

				// Check content
				if (props.content){
					var infoWindow = new google.maps.InfoWindow({
						content:props.content
					});

					marker.addListener('click', function(){
						infoWindow.open(map,marker);
					})

				}

			}


		}
	</script>

	<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAj-48PZXU7YOUvZ9JzPS-EnSbr7ZhhDRM&callback=initMap">
    </script>
	
</body>
</html>