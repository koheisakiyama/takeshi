<!-- 出発点・検索に入力された値、目的地・選ばれた店情報の所在地　でルートを表示するviewファイル。  seina2018.6.27-->

@extends ('layout')
@section ('content')

<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('Google_API_Key') }}"></script> -->

  <!--<div id="map_canvas" style="width: 100%; height: 100%;"></div> -->
  <div id="map_canvas" style="width: 100%; height: 75%;"></div>
  <div id="directions_panel" class="pre-scrollable" style="width: 100%; height: 25%;background-color:#A3D1FF;"></div>
<!-- 
  <script src="{{ asset('assets/javascripts/shopRoad.js') }}"></script>
   -->

<script type="text/javascript">

  var map = null;     // 地図オブジェクト
  var marker = null;  // マーカーオブジェクト
  var watchId = null; // 監視対象の地図のID
  if (navigator.geolocation) {
    var id = navigator.geolocation.watchPosition(initMap, onError);
  } else {
    window.alert('Geolocation API対応ブラウザでアクセスしてください。');

  }
  // エラー時のコールバック関数
  function onError(error) {
      alert('コード: '        + error.code    + '\n' +
              'メッセージ: '    + error.message + '\n');
  }

  function initMap(position) {
  //出発地をidから引き出したlatlonに代入する

    var s_latlng = new google.maps.LatLng(<?php echo json_encode($s_latlng); ?>); 
    var g_latlng = new google.maps.LatLng(<?php echo json_encode($g_latlng); ?>); 
    var center = new google.maps.LatLng(<?php echo json_encode($s_latlng); ?>); 
    var current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer();

    // 地図初期化のオプション
    var mapOptions = {
        zoom: 17,
        center: center,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scaleControl: true,
    };
    // 地図を表示
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    // ルートを取得
    var request = {
      origin: s_latlng,        // 出発地点の緯度、経度
      destination: g_latlng,   // 到着地点の緯度、経度
      //travelMode: google.maps.DirectionsTravelMode.DRIVING // ルートの種類
      travelMode: google.maps.DirectionsTravelMode.WALKING // ルートの種類
    };
    directionsService.route(request, function(result, status) {
      directionsRenderer.setDirections(result); // 取得したルートをセット
      directionsRenderer.setMap(map); // ルートを地図に表示
      directionsRenderer.setPanel(document.getElementById('directions_panel')); // 道順を表示する k-koda
    });

    marker = new google.maps.Marker({
      position: current,
      map: map
    });
  }

</script>
@endsection
