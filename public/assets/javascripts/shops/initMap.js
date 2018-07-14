function initMap(position) {
  currentPos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  map = new google.maps.Map(
    document.getElementById('map'),
    mapOptions
   );
  map.setCenter(new google.maps.LatLng(currentPos));
  drawUserMarker(currentPos);
}