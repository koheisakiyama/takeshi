@extends ('layout')

@section ('content')

  <div id="map" style="height:75%;width:100%"></div>
  <div class="result-list pre-scrollable" style="height:25%;">

  <script type="text/javascript">
    var shops = <?php echo json_encode($shops); ?>;
  </script>

  <!--
>>>>>>> search_test
    <input type="checkbox" id="navTgl">
    <label for="navTgl" class="open">≡</label>
    <label for="navTgl" class="close"></label>
    <div class="search-result">
    </div>
    -->
    <!-- //デフォルトで出発地を現在地に　//出発地とlatlngの差を求めて現在地からの距離を出す　//差をviewに表示する -->

      <ul class="list-group search-result-list" style="margin-bottom:0px;">
        @foreach ($shops as $shop)
          <li class="list-group-item search-result-item" id="result-item" style="background-color: #F0F0F0">
            <p style="float: left; font-size: 18px; font-weight: bold; color: #4169E1">{{ $shop->name }}</p>
            <p style="float: left; font-size: 18px; margin-right: 15px;"></p>
            <p style="float: left; font-size: 16px;">{{ $shop->address }}</p>
            <p style="float: left; font-size: 18px; margin-right: 15px; margin-left: 15px;">/</p>
            <p style="float: left; font-size: 16px;">{{ $shop->time }}</p>
            <p style="font-size: 18px; margin-left: 15px; color: #F0F0F0">/</p>
          @if ( $shop->link == "なし")
            <p>URLないです</p>
          @else
            <a href="{{ $shop->link }}" style="font-size: 17px; color: #6495ED" data-user="{{ Auth::user()->id }}" data-shop="{{ $shop->id }}" method="POST" class="post">店舗情報</a>
          @endif
            <a href="/select/{{ $shop->id }}" style="font-size: 17px; color: #6495ED">このお店に行きたい</a>
            <p style="float: left; font-size: 18px; margin-right: 15px;"></p>
            <p style="float: left; font-size: 16px;"> 現在地からの距離：<span id="shop_{{$shop->id}}"></span>m</p>
            <p style="float: left; font-size: 18px; margin-right: 15px;"></p>
          </li>
        @endforeach
      </ul>
      
  <script>
    //クリックされた時にhistoryデータベースに店舗情報を保存する処理
    $('.post').on('click', function(){
      post($(this).data('user'), $(this).data('shop'));
    });
  </script>

  <script type="text/javascript">
    var areaLatLng = <?php echo json_encode($latlng); ?>;
    var shops = <?php echo json_encode($shops); ?>;
    displayShops(areaLatLng);
  </script>

  </div>

@endsection
