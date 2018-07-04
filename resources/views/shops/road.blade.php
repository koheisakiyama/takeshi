<!-- 出発点・検索に入力された値、目的地・選ばれた店情報の所在地　でルートを表示するviewファイル。  seina2018.6.27-->

@extends('layout')
@section('content')

<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('Google_API_Key') }}"></script> -->

  <div id="map_canvas" style="width: 100%; height: 600px;"></div>
<!-- 
  <script src="{{ asset('assets/javascripts/shopRoad.js') }}"></script>
   -->

<script type="text/javascript">

$(function() {
  //出発地をidから引き出したlatlonに代入する
  //php変数をjavascript変数に変換ができない・・・
     var lat1 =<?php echo json_encode($lat1); ?>;
     var lon1 =<?php echo json_encode($lon1); ?>;
     var lat2 =<?php echo json_encode($lat2); ?>;
     var lon2 =<?php echo json_encode($lon2); ?>;

    var latlng1 = new google.maps.LatLng(lat1, lon1); 
    var latlng2 = new google.maps.LatLng(lat2, lon2); 
    var map;
    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer();

    // 地図初期化のオプション
    var mapOptions = {
        zoom: 17,
        center: latlng1,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scaleControl: true,
    };
    // 地図を表示
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    // ルートを取得
    var request = {
      origin: latlng1,        // 出発地点の緯度、経度
      destination: latlng2,   // 到着地点の緯度、経度
      travelMode: google.maps.DirectionsTravelMode.WALKING // ルートの種類
    };
    directionsService.route(request, function(result, status) {
      directionsRenderer.setDirections(result); // 取得したルートをセット
      directionsRenderer.setMap(map); // ルートを地図に表示
    });
  });
</script>
@endsection
