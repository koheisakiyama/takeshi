<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel='stylesheet' type='text/css'>
    <script src="{{ asset('assets/js/jquery-3.2.1.js') }}"></script>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body, div.row, div.container, div.mapArea{
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>

  <body>


    <div class="container">
      <div class="row">
        <div class="result-list col-xs-2 col-sm-2 col-md-2 col-lg-2">
          <ul class="list-group">
              <li class="list-group-item">
                <p>{{ $shop->name }}</p>
                <a href="/#">route</a>
              </li>
          </ul>
        </div>
        <div id="map" class="mapArea col-xs-10 col-sm-10 col-md-10 col-lg-10">
        </div>
      </div>
    </div>
        <script>
          function initMap() {
            /* 地図の中心 20180628 kkoda*/
            var ll = {lat: 35.6284, lng: 139.736571};
            var map = new google.maps.Map(
              document.getElementById('map'), { center: ll, zoom: 14}
            );

            /* マーカーをつけるllを準備 20180628 kkoda */
            var arr = [];
            var markerPosi00 = {lat: 35.6123, lng:139.7424};
            var markerPosi01 = {lat: 35.622, lng:139.7274};
            var markerPosi02 = {lat: 35.62200, lng:139.7274};
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
