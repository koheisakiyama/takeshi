@extends ('layout')

@section ('content')

  <div id="map" style="height:75%;width:100%"></div>
  <div class="result-list pre-scrollable" style="height:25%;">

  <script type="text/javascript">
    var shops = <? php echo json_encode($shops); ?> ;

  </script>
  <!--
    <input type="checkbox" id="navTgl">
    <label for="navTgl" class="open">≡</label>
    <label for="navTgl" class="close"></label>
    <div class="search-result">
    </div>
    -->
      <ul class="list-group search-result-list" style="margin-bottom:0px;">
        @foreach ($shops as $shop)
          <li class="list-group-item search-result-item" style="background-color: #F0F0F0">
            <p style="float: left; font-size: 18px; font-weight: bold; color: #4169E1">{{ $shop->name }}</p>
            <p style="float: left; font-size: 18px; margin-right: 15px;"></p>
            <p style="float: left; font-size: 16px;">{{ $shop->address }}</p>
            <p style="float: left; font-size: 18px; margin-right: 15px; margin-left: 15px;">/</p>
            <p style="float: left; font-size: 16px;">{{ $shop->time }}</p>
            <p style="font-size: 18px; margin-left: 15px; color: #F0F0F0">/</p>
          @if ( $shop->link == "なし")
            <p>URLないです</p>
          @else
            <a href="{{ $shop->link }}" style="font-size: 17px; color: #6495ED">店舗情報</a>
          @endif
            <a href="/navi/{{ $shop->id }}" style="font-size: 17px; color: #6495ED">ルート探索</a>
            
            <script type="text/javascript">
             var pro1 = new Promise(
              function (resolve, reject){
                currentll = new google.maps.LatLng(35.628776,139.739052);
                resolve(currentll);
              });
             pro1.then(function(currentll){
              let g_latlng = new google.maps.LatLng(shops -> lat,shops -> lon ); //shopsのlatlonが取り出せない〜〜が配列を取り出し、距離計算のcomputedistansebetweenがうまく発動すれば繰り返し処理はうまくいく・・・
              let distance = computeDistanceBetween(currentll,g_latlng);
              console.log(distance);
              });
            </script>
            
            <p>ーーーーーーーーーー現在地からの距離：mーーーーーーーーーー</p>
          </li>
        @endforeach
      </ul>
  </div>

  <script type="text/javascript">
    var areaLatLng = <?php echo json_encode($latlng); ?> ;
    //var latlng = <?php echo json_encode($latlng); ?> ;
    displayShops(areaLatLng);
  </script>

@endsection
