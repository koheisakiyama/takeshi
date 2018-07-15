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

  var route = null;
  var stepLat = null; // ステップごとの緯度
  var stepLng = null; // ステップごとの経度
  var stepNum = 0; // ステップ番号
  var stepDistance = null; // ステップごとの距離
  var stepDuration = null; // ステップごとの時間
  var stepComment = null; // ステップごとの説明
  var steps = new Array();
  var s_ll = <?php echo json_encode($s_latlng); ?>; 
  var g_ll = <?php echo json_encode($g_latlng); ?>; 
  var mapOpt = {
    zoom : 15,        // 拡大倍率
    center : s_ll,  // 緯度・経度
    //mapTypeId: google.maps.MapTypeId.ROADMAP,
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
  navigator.geolocation.getCurrentPosition(startNavi, errorCallback,  getOpt);
  // 移動時の現在地の取得
  navigator.geolocation.watchPosition(setMarker, errorCallback, getOpt);
</script>

@endsection
