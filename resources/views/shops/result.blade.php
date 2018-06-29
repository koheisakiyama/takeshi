<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
    <body>
  <div id="map"></div>
    <script>
      var map;
      function initMap() {
        var ll = {lat: 35.6284, lng: 139.736571};
        var map = new google.maps.Map(
          document.getElementById('map'), { center: ll, zoom: 14}
        );

        var markerPosi = {lat: 35.61, lng:139.7724};
        var marker = new google.maps.Marker({position: markerPosi, map:map});
        var markerPosi0 = {lat: 35.6100, lng:139.7724};
        var marker = new google.maps.Marker({position: markerPosi0, map:map});
      }
    </script>
<script>
console.log(env('DB_PASSWORD'))
</script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('Google_API_Key') }}&callback=initMap"
    async defer></script>
  </body>
</html>