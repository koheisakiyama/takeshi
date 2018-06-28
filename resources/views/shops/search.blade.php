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
      function initMap() {
        /* 地図の中心 20180628 kkoda*/
        var ll = {lat: 35.6284, lng: 139.736571};
        var map = new google.maps.Map(
          document.getElementById('map'), { center: ll, zoom: 14}
        );

        /* マーカーをつけるllを準備 20180628 kkoda */
        var arr = [];
        var markerPosi00 = {lat: 35.6123, lng:139.7724};
        var markerPosi01 = {lat: 35.6322, lng:139.7744};
        var markerPosi02 = {lat: 35.6212, lng:139.7274};
        arr[0] = markerPosi00;
        arr[1] = markerPosi01;
        arr[2] = markerPosi02;
        /* マーカーを表示 20180628 kkoda */
        for(let i = 0; i < arr.length; i++) {
          var marker = new google.maps.Marker({position:arr[i] , map:map});
        }
      }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('Google_API_Key') }}&callback=initMap"
    async defer></script>

  </body>

</html>
