// なぜ＄あるとうまく動くのか・・・・・・initMapしたら解決したが、＄マークがつくとinitMapしていなくても実行される理由はわからないまま。→＄がjqueryをつかって実行、の意味。
function currentLocation(position) {
  current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  //console.log(current);
  initMap(current);
  userMarker = drawUserMarker(current);
}
