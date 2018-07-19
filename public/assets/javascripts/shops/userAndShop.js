function showUserAndShop(position) {
  current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  var shopLatLng = new google.maps.LatLng(shop_latlng.lat, shop_latlng.lng);
  console.log(current.lat());
  initMap(current);
  // メソッドを実行
  var latLngBounds = new google.maps.LatLngBounds(current, shopLatLng);
  map.fitBounds(latLngBounds,15);
  userMarker = drawUserMarker(position);
  var shopMarker = new google.maps.Marker({ position:shopLatLng, map:map});
}
