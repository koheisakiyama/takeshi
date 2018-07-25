// 各
function displayShops(latlng) {
  initMap(latlng);
  console.log("piyo");
  
  navigator.geolocation.getCurrentPosition(function(position){
      drawUserMarker(position);
      current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude); // 現在地の緯度経度取得
      console.log(current);
      for(var i in shops) {
        var shopsLatLng = new google.maps.LatLng(shops[i].lat, shops[i].lon);
        console.log(shopsLatLng);
        var shopsMarker = new google.maps.Marker({ position:shopsLatLng, map:map});
        let distance = Math.floor(google.maps.geometry.spherical.computeDistanceBetween(current,shopsLatLng));
        document.getElementById('shop_' + shops[i].id).innerHTML= distance;
      }
    },
    errorCallback,
    getOpt
  );
}

