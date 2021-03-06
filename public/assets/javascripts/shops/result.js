// 現在地取得、検索でヒットしたshopsを回して地図上にマーカーを指す
function displayShops(latlng) {
  const pro1 = new Promise(
    function (resolve, reject){
      // 地図とユーザーのマーカーの作成と表示
      navigator.geolocation.getCurrentPosition(
          function (position){
            current = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            if(null == latlng){
              center = current;
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
//検索結果の緯度経度にマーカを指し、それぞれの現在地からの距離を測定してビューファイルに投げる
  pro1.then(
    function(){
      for(var i in shops) {
        var shopLatLng = new google.maps.LatLng(shops[i].lat, shops[i].lon);
        // infoWindowの中に出てくる内容
        var content = '<div>'
                      +'<h3>'+shops[i].name+'</h3>'
                      + '<p>'
                        +'住所:<span>'+shops[i].address+'</span><br>'
                        +'詳細:<span><a href='+shops[i].link+'>'+shops[i].link+'</a></span><br>'
                        +'営業時間:<span>'+shops[i].time+'</span><br>'
                      +'</p>'
                    + '</div>';

        // shopMarkerの設定
        var shopMarkerOpt = {
                              position:shopLatLng, 
                              map:map,
                              titel:"TITLE",
                              summary:"summary",
                            }
        // infoWindowの設定
        var infoWindowOpt = {
                              lat: shops[i].lat,
                              lng: shops[i].lon,
                              content: content,
                            }
        let distance = Math.floor(google.maps.geometry.spherical.computeDistanceBetween(current,shopLatLng));
        //現在地と店の緯度経度から２点間距離を測る
        document.getElementById('shop_' + shops[i].id).innerHTML= distance; //jsファイルからビューファイルに数を渡す
        shopMarkers[shops[i].id] = new google.maps.Marker(shopMarkerOpt);
        infoWindows[shops[i].id] = new google.maps.InfoWindow(infoWindowOpt);
        // マーカーをクリックしたときの動き
        clickMarker(shops[i].id);
      }
  });
}

function clickMarker(i) {
  var shopMarker = shopMarkers[i];
  google.maps.event.addListener(shopMarker, 'click', function(){
    if(currentInfoWindow){
      currentInfoWindow.close();
    }
    infoWindows[i].open(map,shopMarkers[i]);
    currentInfoWindow = infoWindows[i];
  });
}

