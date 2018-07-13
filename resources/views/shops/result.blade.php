@extends ('layout')

@section ('content')

  <div id="map" style="height:75%;"></div>
  <div class="result-list pre-scrollable" style="height:25%;">
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
            <a href="/shops/road/{{ $shop->id }}" style="font-size: 17px; color: #6495ED">route</a>
          </li>
        @endforeach
      </ul>
  </div>

  <script>
      function initMap() {
      /* 地図の中心 20180628 kkoda*/

      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
          function(position) {
            var mapLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            
            // var mapOptions = {
            //   zoom : 14,          // 拡大倍率
            //   center : mapLatLng  // 緯度・経度
            // }; //反映されてなかったっぽい。
            
            var ll = <?php echo json_encode($latlng); ?> ;
            //console.log(<?php echo json_encode($latlng); ?>);

            var map = new google.maps.Map(
               document.getElementById('map'), { center: ll, zoom: 13}
            );

            // phpからjson形式に変換
            var shops=<?php echo json_encode($shops); ?> ;
          jQuery.each( shops, function(index,shop) {
            var shop_ll = {lat:shop.lat, lng:shop.lon};
            var marker = new google.maps.Marker({ position:shop_ll, map:map});
             });

            var marker = new google.maps.Marker({
              icon: {
                      path: google.maps.SymbolPath.CIRCLE,
                      scale: 4
                    },
              map : map,             // 対象の地図オブジェクト
              position : mapLatLng,   // 緯度・経度
            });
           
          },
          function(error) {
            switch(error.code) {
              case 1: // PERMISSION_DENIED
                alert("位置情報の利用が許可されていません");
                break;
              case 2: // POSITION_UNAVAILABLE
                alert("現在位置が取得できませんでした");
                break;
              case 3: // TIMEOUT
                alert("タイムアウトになりました");
                break;
              default:
                alert("その他のエラー(エラーコード:"+error.code+")");
                break;
            }
          }
        );
      } else {
        alert("この端末では位置情報が取得できません");
      }
    }
  </script>

@endsection
