<!DOCTYPE html>
<html>
  <head>
    <title>pay search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/bootstrap-multiselect.css')}}" rel='stylesheet' type='text/css'>
    <script src="{{ asset('assets/javascripts/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('assets/javascripts/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/javascripts/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets/javascripts/shops/errorCallback.js') }}"></script>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
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
        width: 150px;
        height: 30px;
        color: white;
        background-color: #A3D1FF;
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
    <header class="page-header" style="padding: 0; margin:0; height:10%;">
      <nav class="navbar navbar-inverse" style="background-color: #A3D1FF; border-color: #A3D1FF; margin:0;">
        <div class="container-fluid">
         {{ Form::open(['action' => 'ShopsController@result', 'method' => 'get']) }}
          <ul class="nav navbar-nav" style="padding: 0px;">
            <li class="active"><a href="#" style="padding: 0;background-color: #A3D1FF; margin:0;"><h1 style="margin: 10px;">pay search</h1></a></li>
            <li><a>@include ('shops.details.how')</a></li>
            <li><a>@include ('shops.details.what')</a></li>
            <li><a>@include ('shops.details.where')</a></li>
            <li>      
              <div style="margin: 15px;margin-right: 20px;">
                {{ Form::text('keyword', '', ['placeholder' => 'キーワードを入力してください', 'style' => 'width: 150%;height: 30px;']) }}
              </div>
            </li><!-- フリーワード検索ボックス -->
            <li style="margin-left: 50px;">
              <a>{{ Form::submit('検索', ['class' => 'btn btn-primary navbar-form']) }}</a>
            </li><!-- 検索ボタン -->
          </ul>
          {{ Form::close() }}
        </div>
      </nav>
    </header>

    <div class="container-fluid" style="height:90%;">
      <div class="row-fluid"> 
        <!-- jsファイルを作成　seina -->
        <script type="text/javascript">
          var current = null; // 現在地
          var center = {lat: 35.6284,lng: 139.736571};
          var map = null;        // 地図オブジェクト
          var userMarker = null; // マーカーオブジェクト
          var errPos = null;     // 位置測定の誤差 単位はメートル
          var errCir = null;     // 誤差の範囲
          // 現在地取得のオプション
          var getOpt = {
            enableHighAccuracy : true,
            maximumAge         : 30000,
            timeout            : 25000,
          };
          // 誤差円のオプション
          var cirOpt = {
            map: map,
            center: current,
            radius: errPos, // 単位はメートル
            strokeColor: '#0088ff',
            strokeOpacity: 0.8,
            strokeWeight: 1,
            fillColor: '#0088ff',
            fillOpacity: 0.2
          };
        </script>
        <! -- なぜかこの順番で読み込まないと動かない。。。 -->
        <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('Google_API_Key') }}"></script>
        <script src="{{ asset('assets/javascripts/shops/initMap.js') }}"></script>
        <script src="{{ asset('assets/javascripts/shops/currentLocation.js') }}"></script>
        <script src="{{ asset('assets/javascripts/shops/result.js') }}"></script>
        <script src="{{ asset('assets/javascripts/shops/navi.js') }}"></script>
        @yield ('content')

      </div>
    </div>
  </body>
</html>
