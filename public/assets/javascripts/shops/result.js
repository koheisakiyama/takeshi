// 現在地取得、検索でヒットしたshopsを回して地図上にマーカーを指
function displayShops(latlng) {
  initMap(latlng);
 // console.log("piyo");
  
  navigator.geolocation.getCurrentPosition(function(position){
      drawUserMarker(position);
      current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude); // 現在地の緯度経度取得
      //console.log(current);
      for(var i in shops) {
        var shopsLatLng = new google.maps.LatLng(shops[i].lat, shops[i].lon); //for文で店の緯度経度を繰り返し取り出す
        //console.log(shopsLatLng);
        var shopsMarker = new google.maps.Marker({ position:shopsLatLng, map:map}); //検索結果をマップ上にマーカーで示す。
        let distance = Math.floor(google.maps.geometry.spherical.computeDistanceBetween(current,shopsLatLng));
        //現在地と店の緯度経度から２点間距離を測る
        document.getElementById('shop_' + shops[i].id).innerHTML= distance; //jsファイルからビューファイルに数を渡す
      }
    },
    errorCallback,
    getOpt
  );
}