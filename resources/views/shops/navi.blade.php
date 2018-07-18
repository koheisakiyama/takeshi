<!-- 出発点・検索に入力された値、目的地・選ばれた店情報の所在地　でルートを表示するviewファイル。  seina2018.6.27-->

@extends ('layout')
@section ('content')

  <div id="map" style="width: 100%; height: 75%;"></div>
  <div id="directions_panel" class="pre-scrollable" style="width: 100%; height: 25%;background-color:#A3D1FF;"></div>

  <div class="modal fade" id="naviModal" tabindex="-1">
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
  <div class="modal fade" id="naviComplete" tabindex="-1">
  	<div class="modal-dialog">
  		<div class="modal-content">
  			<div class="modal-body">
          <ul style="list-style:none;">
            <li><p>道案内を終了します。</p></li>
          </ul>
  			</div>
  			<div class="modal-footer">
  				<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
  			</div>
  		</div>
  	</div>
  </div>
  <script type="text/javascript">
  
    var route = null;
    var stepNum = 0; // ステップ番号
    var steps = new Array();
    var modeType = "walking";
    console.log(modeType);
    var s_ll = <?php echo json_encode($s_latlng); ?>; 
    var g_ll = <?php echo json_encode($g_latlng); ?>; 
    // 誤差円のオプション
    navigator.geolocation.getCurrentPosition(startNavi, errorCallback,  getOpt);
    // 移動時の現在地の取得
    navigator.geolocation.watchPosition(navigation, errorCallback, getOpt);
  </script>

@endsection
