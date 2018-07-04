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
      var ll = <?php echo json_encode($latlng); ?> ;
      //console.log(<?php echo json_encode($latlng); ?>);

      var map = new google.maps.Map(
        document.getElementById('map'), { center: ll, zoom: 14}
      );

      // phpからjson形式に変換
      var shops=<?php echo json_encode($shops); ?> ;
      jQuery.each( shops, function(index,shop) {
        var shop_ll = {lat:shop.lat, lng:shop.lon};
        var marker = new google.maps.Marker({ position:shop_ll, map:map});
      });
    }
  </script>

@endsection
