<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel='stylesheet' type='text/css'>
    <script src="{{ asset('assets/javascripts/jquery-3.2.1.js') }}"></script>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 75%;
        margin: 0;
        padding: 0;
      }
      div.result-list{
        height: 25%;
        margin: 0;
        padding: 0;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body, div.row-fluid, div.container-fluid{
        height: 100%;
        margin: 0;
        padding: 0;
      }
       #navTgl:checked ~ .contents {
          -webkit-transform: translateY(250px);
        transform: translateY(250px);
      }
      #navTgl {
        display: none;
        overflow: hidden;
      }
      .open {
        z-index: 2;
        width: 50px;
        height: 50px;
        color: white;
        background-color: lightSeaGreen;
        font-size: 2em;
        line-height: 50px;
        text-align: center;
        -webkit-transition: background-color .6s, -webkit-transform .6s;
        transition: background-color .6s, transform .6s;
       }
       #navTgl:checked + .open {
        background-color: indianRed;
        -webkit-transform: translateY(-500px);
        transform: translateY(-500px);
       }
       .close {
        pointer-events: none;
        z-index: 1;
        width: 100%;
        height: 100%;
        transition: background-color .6s;
       }
       #navTgl:checked ~ .close {
        pointer-events: auto;
        background-color: rgba(0,0,0,.3);
       }

       .search-result {
          z-index: 1;
          position: fixed;
          overflow: auto;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          padding: 10px;
          background-color: rgba(0,0,0,.6);
          -webkit-transform: translateY(100%);
          transform: translateY(100%);
          -webkit-transition: -webkit-transform .6s;
          transition: transform .6s;
        }
        #navTgl:checked ~ .search-result {
          -webkit-transform: translateY(250px);
          transform: translateY(250px);
        }
        .search-result h3 {
          color: white;
          text-align: center;
        }
    </style>
  </head>

  <body>

    <div class="container-fluid">
      <div class="row-fluid">
        <div id="map" class="mapArea">
        </div>
        <div class="result-list pre-scrollable">
        <!--
          <input type="checkbox" id="navTgl">
          <label for="navTgl" class="open">≡</label>
          <label for="navTgl" class="close"></label>
          <div class="search-result">
          </div>
          -->
            <ul class="list-group search-result-list">
              @foreach ($shops as $shop)
                <li class="list-group-item search-result-item">
                  <p>{{ $shop->name }}</p>
                  <a href="/#">route</a>
                </li>
              @endforeach
            </ul>
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
