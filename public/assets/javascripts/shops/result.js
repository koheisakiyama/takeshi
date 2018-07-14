function initMap(position) {
  var mapLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  var ll = <?php echo json_encode($latlng); ?> ;
  var map = new google.maps.Map(
      document.getElementById('map'), 
      mapOpt
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
  };
}
