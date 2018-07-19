@extends ('layout')
@section ('content')

  <div id="map" style="width: 100%; height: 75%;"></div>
  <div id="select_panel" style="width: 100%; height: 25%;background-color:#A3D1FF;">
    {{ Form::open(['url' => "/navi/$shop->id", 'method' => 'get', 'style'=>'width=100%;']) }}
      <ul class="nav navbar-nav" style="padding: 0px;width:100%;">
        <li>
          <div style="margin: 15px;">
            {{ Form::label('startPos', '出発地点') }}
            {{ Form::text('startPos', '{lat: 35.689032, lng: 139.698044}', ['placeholder' => '現在地', 'style' => 'width: 100%;height: 30px;margin-top:15px;']) }}
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
  <script src="{{ asset('assets/javascripts/shops/userAndShop.js') }}"></script>
  <script type="text/javascript">
    var shop_latlng = <?php echo json_encode($latlng); ?>; 
    console.log(shop_latlng);
    // 誤差円のオプション
    navigator.geolocation.getCurrentPosition(showUserAndShop,errorCallback);
  </script>

@endsection
