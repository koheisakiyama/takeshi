<!-- 出発点・検索に入力された値、目的地・選ばれた店情報の所在地　でルートを表示するviewファイル。  seina2018.6.27-->

@extends('layout')
@section('content')

<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('Google_API_Key') }}"></script> -->

  <div id="map_canvas" style="width: 100%; height: 100%;"></div>
<!-- 
  <script src="{{ asset('assets/javascripts/shopRoad.js') }}"></script>
   -->

<script type="text/javascript">

$(function() {
  //出発地をidから引き出したlatlonに代入する

    var s_latlng = new google.maps.LatLng(<?php echo json_encode($s_latlng); ?>); 
    var g_latlng = new google.maps.LatLng(<?php echo json_encode($g_latlng); ?>); 
    var map;
    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer();

    // 地図初期化のオプション
    var mapOptions = {
        zoom: 17,
        center: s_latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scaleControl: true,
    };
    // 地図を表示
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    // ルートを取得
    var request = {
      origin: s_latlng,        // 出発地点の緯度、経度
      destination: g_latlng,   // 到着地点の緯度、経度
      travelMode: google.maps.DirectionsTravelMode.WALKING // ルートの種類
    };
    directionsService.route(request, function(result, status) {
      directionsRenderer.setDirections(result); // 取得したルートをセット
      directionsRenderer.setMap(map); // ルートを地図に表示
    });
  });
</script>
@endsection
