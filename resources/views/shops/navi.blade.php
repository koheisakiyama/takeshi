<!-- 出発点・検索に入力された値、目的地・選ばれた店情報の所在地　でルートを表示するviewファイル。  seina2018.6.27-->

@extends ('layout')
@section ('content')

  <div id="map_canvas" style="width: 100%; height: 75%;"></div>
  <div id="directions_panel" class="pre-scrollable" style="width: 100%; height: 25%;background-color:#A3D1FF;"></div>
  <div class="modal fade" id="sampleModal" tabindex="-1">
  	<div class="modal-dialog">
  		<div class="modal-content">
  			<div class="modal-body">
          <ul style="list-style:none;">
            <li><p><span id="step_comment"></span></p></li>
            <li><p>距離：<span id="step_distance"></span></p></li>
            <li><p>時間：<span id="step_duration"></span></p></li>
          </ul>
  			</div>
  			<div class="modal-footer">
  				<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
  			</div>
  		</div>
  	</div>
  </div>
<!-- 
  <script src="{{ asset('assets/javascripts/shopRoad.js') }}"></script>

   -->
<script type="text/javascript">

  var map = null;        // 地図オブジェクト
  var marker = null;     // マーカーオブジェクト
  var watchId = null;    // 監視対象の地図のID
  var current = null;    // 現在地
  var errPos = null;     // 位置測定の誤差 単位はメートル
  var errCir = null;     // 誤差の範囲
  var route = null;
  var stepLat = null; // ステップごとの緯度
  var stepLng = null; // ステップごとの経度
  var stepNum = 0; // ステップ番号
  var stepDistance = null; // ステップごとの距離
  var stepDuration = null; // ステップごとの時間
  var stepComment = null; // ステップごとの説明
  var s_ll = <?php echo json_encode($s_latlng); ?>; 
  var g_ll = <?php echo json_encode($g_latlng); ?>; 

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
  /*
  navigator.geolocation.getCurrentPosition(initMap, onError,  getOpt);
  
  function initMap(position) {
  //出発地をidから引き出したlatlonに代入する
    current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude); // 現在地の緯度経度取得
    errPos = position.coords.accuracy; // 位置の誤差を取得
    //var s_latlng = new google.maps.LatLng(<?php echo json_encode($s_latlng); ?>); 
    var s_latlng = current;
    //var g_latlng = new google.maps.LatLng(<?php echo json_encode($g_latlng); ?>); 
    //var center = new google.maps.LatLng(<?php echo json_encode($s_latlng); ?>); 
    var g_latlng = new google.maps.LatLng(g_ll); 
    var center = new google.maps.LatLng(s_ll); 
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
      //for(var i in route){
        //console.log(route[i].instructions);
      //}
      stepLat = route[0].start_location.lat(); // ステップの緯度を取得
      stepLng = route[0].start_location.lng(); // ステップの緯度を取得
      stepComment = route[0].instructions; // ステップの説明を取得
      stepDuration = route[0].duration.text; // ステップの時間を取得
      stepDistance = route[0].distance.text; // ステップの距離を取得
      //console.log(stepDuration);
      //console.log(stepDistance);
      $(function (){
        document.getElementById('step_comment').innerHTML=stepComment;
        document.getElementById('step_duration').innerHTML=stepDuration;
        document.getElementById('step_distance').innerHTML=stepDistance;
        console.log(stepComment);
        $('#sampleModal').modal();
      });
      stepLat = route[stepNum].start_location.lat(); // ステップの緯度を取得
      stepLng = route[stepNum].start_location.lng(); // ステップの緯度を取得
      stepComment = route[stepNum].instructions; // ステップの説明を取得
      stepDuration = route[stepNum].duration.text; // ステップの時間を取得
      stepDistance = route[stepNum].distance.text; // ステップの距離を取得
      stepNum++;
    });

    // マーカーの作成と表示
    marker = new google.maps.Marker({position: current, map: map});
    // 誤差を円で描く
    errCir = new google.maps.Circle(cirOpt);
    errCir.setMap(map);
  }

  // 移動した時の現在地をマーカーで表示
  function setMarker(position){ 
    marker.setMap(null); // すで表示されているマーカーを削除
    errCir.setMap(null); // すで表示されている円を削除
    current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude); // 現在地の緯度経度取得
    errPos = position.coords.accuracy; // 位置の誤差を取得
    // マーカーの作成と表示
    marker = new google.maps.Marker({position: current, map: map});
    // 誤差を円で描く
    errCir = new google.maps.Circle(cirOpt);
    errCir.setMap(map);


    // 2018/07/12 ここまで直線距離を計算する
    var diffLat = Math.pow(current.lat() - stepLat,2);
    var diffLng = Math.pow(current.lng() - stepLng,2);
    // 近かったらmodalを表示
    if (Math.sqrt(diffLat+diffLng) < 0.0001) {
      $(function (){
        //$('#sampleButton').click( function () {
          document.getElementById('step_comment').innerHTML=stepComment;
          document.getElementById('step_duration').innerHTML=stepDuration;
          document.getElementById('step_distance').innerHTML=stepDistance;
          console.log(stepComment);
          $('#sampleModal').modal();
        //});
      });
      stepLat = route[stepNum].start_location.lat(); // ステップの緯度を取得
      stepLng = route[stepNum].start_location.lng(); // ステップの緯度を取得
      stepComment = route[stepNum].instructions; // ステップの説明を取得
      stepDuration = route[stepNum].duration.text; // ステップの時間を取得
      stepDistance = route[stepNum].distance.text; // ステップの距離を取得
      stepNum++;
    }
  }
  // 移動時の現在地の取得
  navigator.geolocation.watchPosition(setMarker, onError, getOpt);
  // エラー時のコールバック関数
  function onError(error) {
      alert('コード: '        + error.code    + '\n' +
              'メッセージ: '    + error.message + '\n');
  }
  */
</script>
<script src="{{ asset('assets/javascripts/navi.js') }}"></script>
<!--
-->

@endsection
