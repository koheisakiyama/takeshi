function drawUserMarker(current) {
  marker = new google.maps.Marker({
    icon: {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 4
          },
    map : map,             // 対象の地図オブジェクト
    position : current,   // 緯度・経度
  });
  return marker;
}
