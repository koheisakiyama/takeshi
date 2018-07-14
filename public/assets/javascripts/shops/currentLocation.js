// なぜ＄あるとうまく動くのか・・・・・・initMapしたら解決したが、＄マークがつくとinitMapしていなくても実行される理由はわからないまま。→＄がjqueryをつかって実行、の意味。
function currentLocation(position) {
  current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  initMap(current);
  userMarker = drawMarker(current);
}
function drawMarker(latlng) {
  var marker = new google.maps.Marker({
    icon: {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 4
          },
    map : map,             // 対象の地図オブジェクト
    position : current,   // 緯度・経度
  });
  return marker;
}
