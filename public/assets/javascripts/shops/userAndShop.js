function showUserAndShop(position) {
  console.log(position);
  current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  var shopLatLng = new google.maps.LatLng(shop_latlng.lat, shop_latlng.lng);
  initMap(current);
  // メソッドを実行
  var latLngBounds = new google.maps.LatLngBounds(current, shopLatLng);
  var dffDistance = measureDis(current, shopLatLng);
  if(dffDistance>1000.){
    map.fitBounds(latLngBounds,20);
  }
  userMarker = drawUserMarker(position);
  var shopMarker = new google.maps.Marker({ position:shopLatLng, map:map});
  console.log(map.getZoom());
}
