function displayShops(latlng) {
  initMap(latlng);
  for(var i in shops) {
    var shopsLatLng = {lat:shops[i].lat, lng:shops[i].lon};
    var shopsMarker = new google.maps.Marker({ position:shopsLatLng, map:map});
  }
  navigator.geolocation.getCurrentPosition(drawMarker,errorCallback);
}
function drawMarker(position) {
  current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
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
