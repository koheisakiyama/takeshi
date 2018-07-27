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

  //mapをクリックしたときにマーカーをうち、マップ表示する。
  google.maps.event.addListener(map, 'click', mylistener);

  //クリックしたときの処理
  function mylistener(event){
      //marker作成
      if(currentMarker){
        currentMarker.setMap(null);
      }
      var markerPosition = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
      currentMarker = new google.maps.Marker({
        draggable:true,
        map: map,
        position: markerPosition,
      });
      console.log(markerPosition.lat());
      document.getElementById('startLat').value= markerPosition.lat();
      document.getElementById('startLng').value= markerPosition.lng();
      //jsファイルからビューファイルに数を渡す
  };
}
