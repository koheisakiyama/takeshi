function currentLocation(position) {
  current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  //console.log(current);
  initMap(current);
  userMarker = drawUserMarker(position);
}
