
function drawUserMarker(position) {
  current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  
  userMarker = new google.maps.Marker({
    icon: {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 4,
          },
    map : map,             // 対象の地図オブジェクト
    position : current   // 緯度・経度
  });
  
  // 誤差を円で描く
  var errPos = null;     // 位置測定の誤差 単位はメートル
  var cirOpt = {
    map: map,
    center: current,
    radius: errPos, // 単位はメートル
    strokeColor: '#0088ff',
    strokeOpacity: 0.8,
    strokeWeight: 1,
    fillColor: '#0088ff',
    fillOpacity: 0.2
  };
  errPos = position.coords.accuracy; // 位置の誤差を取得
  errCir = new google.maps.Circle(cirOpt);
  errCir.setMap(map);
  return userMarker;
}
