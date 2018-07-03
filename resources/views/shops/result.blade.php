@extends ('layout')

@section ('content')

  <div id="map" style="height:75%;"></div>
  <div class="result-list pre-scrollable" style="height:75%;">
  <!--
    <input type="checkbox" id="navTgl">
    <label for="navTgl" class="open">≡</label>
    <label for="navTgl" class="close"></label>
    <div class="search-result">
    </div>
    -->
      <ul class="list-group search-result-list">
        @foreach ($shops as $shop)
          <li class="list-group-item search-result-item">
            <p>{{ $shop->name }}</p>
            <a href="/shops/road/{{ $shop->id }}">route</a>  
          </li>
        @endforeach
      </ul>
  </div>

  <script>
    function initMap() {
      /* 地図の中心 20180628 kkoda*/
      //var ll = {lat: 35.6284, lng: 139.736571}; //品川
      var ll = {lat: 35.65803, lng: 139.699447}; //渋谷
      var map = new google.maps.Map(
        document.getElementById('map'), { center: ll, zoom: 14}
      );

      // phpからjson形式に変換
      var shops=<?php echo json_encode($shops); ?> ;
      jQuery.each( shops, function(index,shop) {
        console.log(shop);
        var shop_ll = {lat:shop.lat, lng:shop.lon};
        var marker = new google.maps.Marker({ position:shop_ll, map:map});
      });
    }
  </script>

@endsection
