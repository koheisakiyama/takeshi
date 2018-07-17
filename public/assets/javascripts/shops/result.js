function displayShops(latlng) {
  
  initMap(latlng);
  for(var i in shops) {
    var shopsLatLng = {lat:shops[i].lat, lng:shops[i].lon};
    var shopsMarker = new google.maps.Marker({ position:shopsLatLng, map:map});
  }
  navigator.geolocation.getCurrentPosition(drawUserMarker, errorCallback);
}

