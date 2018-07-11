<!-- 出発点・検索に入力された値、目的地・選ばれた店情報の所在地　でルートを表示するviewファイル。  seina2018.6.27-->

@extends ('layout')
@section ('content')

  <div id="map_canvas" style="width: 100%; height: 75%;"></div>
  <div id="directions_panel" class="pre-scrollable" style="width: 100%; height: 25%;background-color:#A3D1FF;"></div>
<!-- 
  <script src="{{ asset('assets/javascripts/shopRoad.js') }}"></script>
   -->

<script type="text/javascript">

  var map = null;     // 地図オブジェクト
  var marker = null;  // マーカーオブジェクト
  var watchId = null; // 監視対象の地図のID
  var current = null; // 現在地

  // 現在地取得のオプション
  var getOpt = {
    enableHighAccuracy : true,
    maximumAge         : 10000,
    timeout            : 9000,
  };
  
  navigator.geolocation.getCurrentPosition(
            initMap,
            onError, 
            getOpt
  );
  
  function initMap(position) {
  //出発地をidから引き出したlatlonに代入する
    current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    //var s_latlng = new google.maps.LatLng(<?php echo json_encode($s_latlng); ?>); 
    var s_latlng = current;
    var g_latlng = new google.maps.LatLng(<?php echo json_encode($g_latlng); ?>); 
    //var center = new google.maps.LatLng(<?php echo json_encode($s_latlng); ?>); 
    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer();

    // 地図初期化のオプション
    var mapOptions = {
        zoom: 17,
        //center: center,
        center: current,
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
      //console.log(result.routes[0].overview_path[1].lat());
    });

    // マーカーの作成と表示
    marker = new google.maps.Marker({ 
      position: current,
      map: map
    });
  }

  // 移動した時の現在地をマーカーで表示
  function setMarker(position){ 
    marker.setMap(null); // すで表示されているマーカーを削除
    current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    // マーカーの作成と表示
    marker = new google.maps.Marker({ 
      position: current,
      map: map
    });
  }
  // 移動時の現在地の取得
  navigator.geolocation.watchPosition(
            setMarker,
            onError, 
            getOpt
  );
  // エラー時のコールバック関数
  function onError(error) {
      alert('コード: '        + error.code    + '\n' +
              'メッセージ: '    + error.message + '\n');
  }


</script>
@endsection
