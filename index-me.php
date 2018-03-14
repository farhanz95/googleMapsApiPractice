<!DOCTYPE html>
<html>
  <head>
    <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
  </head>
  <body>
    <h3>My Google Maps Demo</h3>
    <div id="map"></div>
    <script>
      function initMap() {
        var uluru = {lat: 3.15621, lng: 101.71273};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAj-48PZXU7YOUvZ9JzPS-EnSbr7ZhhDRM&callback=initMap">
    </script>
  </body>
</html>

<!-- AIzaSyAj-48PZXU7YOUvZ9JzPS-EnSbr7ZhhDRM -->