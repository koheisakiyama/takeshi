function displayShops(latlng) {
  const pro1 = new Promise(
    function (resolve, reject){
      // 地図とユーザーのマーカーの作成と表示
      navigator.geolocation.getCurrentPosition(
          function (position){
            if(null == latlng){
              center = new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
            } else {
              center =  new google.maps.LatLng(latlng);
            }
            initMap(center);
            drawUserMarker(position);
            resolve();
          },
          errorCallback,
          getOpt
      );
    }
  );

  pro1.then(
    function(){
      for(var i in shops) {
        var shopLatLng = new google.maps.LatLng(shops[i].lat, shops[i].lon);
        var shopMarker = new google.maps.Marker({ position:shopLatLng, map:map});
      }
    }
  );
}
