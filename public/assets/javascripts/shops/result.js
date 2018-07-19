function displayShops(latlng) {
  
  initMap(latlng);
  for(var i in shops) {
    var shopLatLng = {lat:shops[i].lat, lng:shops[i].lon};
    var shopMarker = new google.maps.Marker({ position:shopLatLng, map:map});
  }
  navigator.geolocation.getCurrentPosition(drawUserMarker, errorCallback);
}

