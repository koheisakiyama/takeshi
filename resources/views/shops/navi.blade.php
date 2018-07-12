<!-- 出発点・検索に入力された値、目的地・選ばれた店情報の所在地　でルートを表示するviewファイル。  seina2018.6.27-->

@extends ('layout')
@section ('content')

  <div id="map_canvas" style="width: 100%; height: 75%;"></div>
  <div id="directions_panel" class="pre-scrollable" style="width: 100%; height: 25%;background-color:#A3D1FF;"></div>
<!-- 
  <script src="{{ asset('assets/javascripts/shopRoad.js') }}"></script>
   -->

<script type="text/javascript">

  var map = null;        // 地図オブジェクト
  var marker = null;     // マーカーオブジェクト
  var watchId = null;    // 監視対象の地図のID
  var current = null;    // 現在地
  var errPos = null;     // 位置測定の誤差 単位はメートル
  var route = null;
  var stepLatLng = null; // ステップごとの緯度経度
  var stepNum = 0;
  var stepComment = null;

  // 現在地取得のオプション
  var getOpt = {
    enableHighAccuracy : true,
    maximumAge         : 10000,
    timeout            : 9000,
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
  
  navigator.geolocation.getCurrentPosition(initMap, onError,  getOpt);
  
  function initMap(position) {
  //出発地をidから引き出したlatlonに代入する
    current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude); // 現在地の緯度経度取得
    errPos = position.coords.accuracy; // 位置の誤差を取得
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
        //scaleControl: true,
    };
    // 地図を表示
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    // ルートを取得
    var request = {
      origin:      s_latlng,   // 出発地点の緯度、経度
      destination: g_latlng,   // 到着地点の緯度、経度
      //travelMode: google.maps.DirectionsTravelMode.DRIVING // ルートの種類
      travelMode: google.maps.DirectionsTravelMode.WALKING // ルートの種類
    };
    directionsService.route(request, function(result, status) {
      directionsRenderer.setDirections(result); // 取得したルートをセット
      directionsRenderer.setMap(map); // ルートを地図に表示
      directionsRenderer.setPanel(document.getElementById('directions_panel')); // 道順を表示する k-koda
      route = result.routes[0].legs[0].steps;
      stepLatLng = route[0].start_location; // ステップの緯度を取得
      stepComment = route[0].instructions; // ステップの説明を取得
    });

    // マーカーの作成と表示
    marker = new google.maps.Marker({position: current, map: map});
    // 誤差を円で描く
    //new google.maps.Circle(cirOpt);
  }

  // 移動した時の現在地をマーカーで表示
  function setMarker(position){ 
    marker.setMap(null); // すで表示されているマーカーを削除
    current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude); // 現在地の緯度経度取得
    errPos = position.coords.accuracy; // 位置の誤差を取得
    // マーカーの作成と表示
    marker = new google.maps.Marker({position: current, map: map});
    // 誤差を円で描く
    //new google.maps.Circle(cirOpt);
    //
    var diffLat = current.lat() - stepLatLng.lat();
    var diffLng = current.lng() - stepLatLng.lng();
    console.log(Math.pow(diffLat,2));
    console.log(Mngh.pow(diffLng,2));
    // 2018/07/12 ここまで直線距離を計算するところまで
    //if ( < 0.0001) {
    //  function (){
    //  }
    //  stepNum++;
    //  stepLatLng = route[stepNum].start_location; // ステップの緯度を取得
    //  stepComment = route[stepNum].instructions; // ステップの説明を取得
    //}
  }
  // 移動時の現在地の取得
  navigator.geolocation.watchPosition(setMarker, onError, getOpt);
  // エラー時のコールバック関数
  function onError(error) {
      alert('コード: '        + error.code    + '\n' +
              'メッセージ: '    + error.message + '\n');
  }


</script>
@endsection
