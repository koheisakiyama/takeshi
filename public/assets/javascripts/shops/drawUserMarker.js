function drawUserMarker(position) {
  current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  marker = new google.maps.Marker({
    icon: {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 4
          },
    map : map,             // 対象の地図オブジェクト
    position : current,   // 緯度・経度
  });
  // 誤差を円で描く
  errPos = position.coords.accuracy; // 位置の誤差を取得
  errCir = new google.maps.Circle(cirOpt);
  errCir.setMap(map);
  return marker;
}
