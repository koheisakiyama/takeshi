@extends ('layout')
@section ('content')

  <div id="map" style="width: 100%; height: 75%;"></div>
  <div id="select_panel" style="width: 100%; height: 25%;background-color:#A3D1FF;">
    {{ Form::open(['url' => "/navi/$shop->id", 'method' => 'get', 'style'=>'width=100%;']) }}
      <ul class="nav navbar-nav" style="padding: 0px;width:100%;">
        <li>
          <div style="margin: 15px;width: 600px">
            <ul style="list-style:none;">
              <li>
                {{ Form::label('start', '出発地') }}
                {{ Form::text('startLocation', '', ['placeholder' => '出発地点の入力', 'id' => 'inputAddress']) }}
                {{ Form::button('緯度経度を取得', ['id' => 'btn', 'onclick' => 'buttonPush()']) }}
              <li>
                {{ Form::label('startLat', '緯度') }}
                {{ Form::text('startLat', "現在地の緯度", ['id' => 'startLat', 'placeholder' => '現在地Lat', 'style' => 'width: 60%;height: 30px;margin-top:15px;']) }}
              </li>
              <li>
                {{ Form::label('startLng', '経度') }}
                {{ Form::text('startLng', "現在地の経度", ['id' => 'startLng', 'placeholder' => '現在地Lng', 'style' => 'width: 60%;height: 30px;margin-top:15px;']) }}
              </li>
            </ul>
          </div>
        </li><!-- フリーワード検索ボックス -->
        <li style="margin: 15px;">
         {{ Form::label('modeType', '交通手段') }}
         <a>{{ Form::select('modeType', ['walking'=>'徒歩', 'driving'=>'自動車'], null, ['class' => 'form-control', 'style' => 'width: 100%;height: 30px;']) }}</a>
        </li>
        <li style="margin-left: 30px;">
          <a>{{ Form::submit('検索', ['class' => 'btn btn-primary navbar-form']) }}</a>
        </li><!-- 検索ボタン -->
      </ul>
    {{ Form::close() }}
  </div>

  <script type="text/javascript">
    var currentMarker = null;
    var shop_latlng = <?php echo json_encode(['lat'=>$shop->lat, 'lng'=>$shop->lon]); ?>; 
    ///console.log(shop_latlng);
    // 誤差円のオプション
    navigator.geolocation.getCurrentPosition(showUserAndShop,errorCallback);
    // ボタンが押された時の処理
    var buttonPush = function() {
      // フォームに入力された住所情報を取得
      var address = document.getElementById("inputAddress").value;
      // 取得した住所を引数に指定してcodeAddress()関数を実行
      getLatLng(address);
    }

  </script>

@endsection
